<?php

namespace LarsWiegers\TranslationExportForLaravel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TranslationExportForLaravelCommand extends Command
{
    public $signature = 'translations:export {language? : The language to export.} {--all : Export all languages to a single file.} {--directory : The directory to export translations from.}';

    public $description = 'My command';

    public function handle(): int
    {
        // read translations from the specified directory
        $directory = $this->option('directory') ?: lang_path();
        // if no language is specified, export all languages
        $language = $this->argument('language') ?: 'en';

        $translations = [];
        // load all translation files from the specified directory
        $files = File::allFiles($directory);
        $directories = File::directories($directory);

        $languages = array_map(function ($dir) {
            return basename($dir);
        }, $directories);
        $translations = $this->getTranslations($files, $directory, $language, $translations);

        // if --all option is used, export all languages to a single file
        if ($this->option('all')) {
            $exportFilePath = storage_path("{$language}.json");
            File::put($exportFilePath, json_encode($translations, JSON_PRETTY_PRINT));
            $this->info("Translations exported to {$exportFilePath}");
        } else {
            // otherwise export the specified language
            $exportFilePath = storage_path("{$language}.json");

            File::put($exportFilePath, json_encode($translations[$language], JSON_PRETTY_PRINT));
        }

        return 0;
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getTranslations(array $files, bool|array|string $directory, string $language, array $translations): array
    {
        foreach ($files as $key => $file) {
            $name = $file->getFilenameWithoutExtension();
            $relativePath = str_replace($directory.DIRECTORY_SEPARATOR, '', $file->getRealPath());

            if ($file->getExtension() === 'php') {
                $language = dirname($relativePath);

                $content = include $file->getRealPath();
                if (is_array($content)) {
                    $translations[$language][$name] = $content;
                } else {
                    $this->error("Error including PHP file: {$file->getRealPath()}");
                }
            } elseif ($file->getExtension() === 'json') {
                $language = basename($file->getFilename(), '.json');
                $content = json_decode(File::get($file->getRealPath()), true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $translations[$language][$name] = $content;
                } else {
                    $this->error("Error decoding JSON from file: {$file->getRealPath()}");
                }
            }
        }

        return $translations;
    }
}

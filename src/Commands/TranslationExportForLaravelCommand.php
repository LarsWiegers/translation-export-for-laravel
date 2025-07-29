<?php

namespace LarsWiegers\TranslationExportForLaravel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TranslationExportForLaravelCommand extends Command
{
    public $signature = 'translations:export {language? : The language to export.} {--all : Export all languages to a single file.}';

    public $description = 'My command';

    public function handle(): int
    {
        if ($this->option('all')) {
            return $this->exportAllLanguages();
        }

        if ($this->argument('language')) {
            return $this->exportLanguage($this->argument('language'));
        }

        $locales = collect(File::directories(lang_path()))
            ->map(fn ($dir) => basename($dir));

        foreach ($locales as $locale) {
            $this->exportLanguage($locale);
        }

        $this->comment('All done');

        return self::SUCCESS;
    }

    private function exportAllLanguages(): int
    {
        $translations = [];

        $locales = collect(File::directories(lang_path()))
            ->map(fn ($dir) => basename($dir));

        foreach ($locales as $locale) {
            $translations[$locale] = collect(File::allFiles(lang_path($locale)))
                ->filter(fn ($file) => $file->getExtension() === 'php')
                ->flatMap(function ($file) {
                    return include $file->getRealPath();
                });
        }

        File::put(lang_path('all.json'), json_encode($translations, JSON_PRETTY_PRINT));

        $this->comment('All languages exported to all.json');

        return self::SUCCESS;
    }

    private function exportLanguage(string $language): int
    {
        $translations = collect(File::allFiles(lang_path($language)))
            ->filter(fn ($file) => $file->getExtension() === 'php')
            ->flatMap(function ($file) {
                return include $file->getRealPath();
            });

        File::put(lang_path($language . '.json'), $translations->toJson(JSON_PRETTY_PRINT));

        $this->comment('Language ' . $language . ' exported to ' . $language . '.json');

        return self::SUCCESS;
    }
}

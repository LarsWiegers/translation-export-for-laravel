<?php

namespace LarsWiegers\TranslationExportForLaravel;

use LarsWiegers\TranslationExportForLaravel\Commands\TranslationExportForLaravelCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TranslationExportForLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('translation-export-for-laravel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_translation_export_for_laravel_table')
            ->hasCommand(TranslationExportForLaravelCommand::class);
    }
}

<?php

namespace LarsWiegers\TranslationExportForLaravel;

use Illuminate\Support\ServiceProvider;
use LarsWiegers\TranslationExportForLaravel\Commands\TranslationExportForLaravelCommand;

class TranslationExportForLaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TranslationExportForLaravelCommand::class,
            ]);
        }
    }
}

<?php

namespace LarsWiegers\TranslationExportForLaravel\Commands;

use Illuminate\Console\Command;

class TranslationExportForLaravelCommand extends Command
{
    public $signature = 'translation-export-for-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

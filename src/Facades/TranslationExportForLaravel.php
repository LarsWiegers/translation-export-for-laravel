<?php

namespace LarsWiegers\TranslationExportForLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LarsWiegers\TranslationExportForLaravel\TranslationExportForLaravel
 */
class TranslationExportForLaravel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \LarsWiegers\TranslationExportForLaravel\TranslationExportForLaravel::class;
    }
}

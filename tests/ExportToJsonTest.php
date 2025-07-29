<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

beforeEach(function () {
    File::deleteDirectory(lang_path());
    File::makeDirectory(lang_path());
});

it('can export translations to a json file', function () {
    // Arrange
    File::makeDirectory(lang_path('en'));
    File::copy(__DIR__ . '/translations/en/messages.php', lang_path('en/messages.php'));
    $expectedJson = json_encode(['hello' => 'world'], JSON_PRETTY_PRINT);

    // Act
    Artisan::call('translations:export');

    // Assert
    $exportedFilePath = lang_path('en.json');
    if (env('DEBUG_OUTPUT')) {
        echo "Exported JSON:\n" . File::get($exportedFilePath);
    }
    expect(File::exists($exportedFilePath))->toBeTrue();
    expect(json_decode(File::get($exportedFilePath), true))->toEqual(json_decode($expectedJson, true));
});

it('can export multiple translation files to a single json file', function () {
    // Arrange
    File::copyDirectory(__DIR__ . '/translations/en', lang_path('en'));
    $expectedJson = json_encode([
        'hello' => 'world',
        'failed' => 'These credentials do not match our records.',
        'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    ], JSON_PRETTY_PRINT);

    // Act
    Artisan::call('translations:export');

    // Assert
    $exportedFilePath = lang_path('en.json');
    if (env('DEBUG_OUTPUT')) {
        echo "Exported JSON:\n" . File::get($exportedFilePath);
    }
    expect(File::exists($exportedFilePath))->toBeTrue();
    expect(json_decode(File::get($exportedFilePath), true))->toEqual(json_decode($expectedJson, true));
});

it('can export multiple locales to their own json files', function () {
    // Arrange
    File::makeDirectory(lang_path('en'));
    File::copy(__DIR__ . '/translations/en/messages.php', lang_path('en/messages.php'));
    File::makeDirectory(lang_path('es'));
    File::copy(__DIR__ . '/translations/es/messages.php', lang_path('es/messages.php'));
    $expectedEnJson = json_encode(['hello' => 'world'], JSON_PRETTY_PRINT);
    $expectedEsJson = json_encode(['hello' => 'hola'], JSON_PRETTY_PRINT);

    // Act
    Artisan::call('translations:export');

    // Assert
    $exportedEnFilePath = lang_path('en.json');
    $exportedEsFilePath = lang_path('es.json');
    if (env('DEBUG_OUTPUT')) {
        echo "Exported EN JSON:\n" . File::get($exportedEnFilePath);
        echo "Exported ES JSON:\n" . File::get($exportedEsFilePath);
    }
    expect(File::exists($exportedEnFilePath))->toBeTrue();
    expect(File::exists($exportedEsFilePath))->toBeTrue();
    expect(json_decode(File::get($exportedEnFilePath), true))->toEqual(json_decode($expectedEnJson, true));
    expect(json_decode(File::get($exportedEsFilePath), true))->toEqual(json_decode($expectedEsJson, true));
});

it('can export all languages to a single json file', function () {
    // Arrange
    File::copyDirectory(__DIR__ . '/translations/en', lang_path('en'));
    File::copyDirectory(__DIR__ . '/translations/es', lang_path('es'));

    $expectedJson = json_encode([
        'en' => [
            'hello' => 'world',
            'failed' => 'These credentials do not match our records.',
            'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
        ],
        'es' => [
            'hello' => 'hola',
        ]
    ], JSON_PRETTY_PRINT);

    // Act
    Artisan::call('translations:export', ['--all' => true]);

    // Assert
    $exportedFilePath = lang_path('all.json');
    expect(File::exists($exportedFilePath))->toBeTrue();
    expect(json_decode(File::get($exportedFilePath), true))->toEqual(json_decode($expectedJson, true));
});

it('can export only a single language', function () {
    // Arrange
    File::makeDirectory(lang_path('en'));
    File::copy(__DIR__ . '/translations/en/messages.php', lang_path('en/messages.php'));
    File::makeDirectory(lang_path('es'));
    File::copy(__DIR__ . '/translations/es/messages.php', lang_path('es/messages.php'));
    $expectedEnJson = json_encode(['hello' => 'world'], JSON_PRETTY_PRINT);

    // Act
    Artisan::call('translations:export', ['language' => 'en']);

    // Assert
    $exportedEnFilePath = lang_path('en.json');
    $exportedEsFilePath = lang_path('es.json');
    if (env('DEBUG_OUTPUT')) {
        echo "Exported EN JSON:\n" . File::get($exportedEnFilePath);
    }
    expect(File::exists($exportedEnFilePath))->toBeTrue();
    expect(File::exists($exportedEsFilePath))->toBeFalse();
    expect(json_decode(File::get($exportedEnFilePath), true))->toEqual(json_decode($expectedEnJson, true));
});

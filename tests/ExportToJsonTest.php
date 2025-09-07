<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


it('can export translations to a json file', function () {
    // Arrange
    $expectedJson = [
        'auth' => [
            'failed' => 'These credentials do not match our records.',
            'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
        ],
        'messages' => [
            'hello' => 'world'
        ]
    ];

    // Act
    Artisan::call('translations:export', [
        '--directory' => __DIR__ . '/translations',
    ]);

    // Assert
    $exportedFilePath = storage_path('en.json');

    expect(File::exists($exportedFilePath))->toBeTrue()
        ->and(json_decode(File::get($exportedFilePath), true))->toEqual($expectedJson);
});

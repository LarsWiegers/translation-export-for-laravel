
# Gemini Context

This file provides context for the Gemini AI assistant to understand the project.

## Project Overview

- **Project Name:** `larswiegers/translation-export-for-laravel`
- **Description:** A Laravel package to export translations to various formats.
- **Author:** Lars Wiegers
- **License:** MIT

## Tech Stack

- **Language:** PHP 8.3+
- **Framework:** Laravel 10, 11, or 12
- **Key Dependencies:**
    - `spatie/laravel-package-tools`

## Development Environment

### Commands

- **Test:** `composer test`
- **Test with coverage:** `composer test-coverage`
- **Code Style Formatting:** `composer format`
- **Static Analysis:** `composer analyse`

### Tooling

- **Testing:** The project uses `pest` for testing.
- **Code Style:** `laravel/pint` is used for ensuring consistent code style.
- **Static Analysis:** `phpstan` is used for static analysis to find potential bugs.

## Laravel Integration

- **Service Provider:** `LarsWiegers\TranslationExportForLaravel\TranslationExportForLaravelServiceProvider`
- **Facade:** `LarsWiegers\TranslationExportForLaravel\Facades\TranslationExportForLaravel`

These are automatically discovered by Laravel.

## Important Files

- **`src/`**: The main source code of the package.
- **`config/translation-export-for-laravel.php`**: The configuration file for the package.
- **`database/migrations/`**: The database migrations.
- **`tests/`**: The tests for the package.
- **`README.md`**: The main documentation file.
- **`composer.json`**: The file containing the project's dependencies and scripts.

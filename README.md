# Export your translations to many outputs.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/larswiegers/translation-export-for-laravel.svg?style=flat-square)](https://packagist.org/packages/larswiegers/translation-export-for-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/larswiegers/translation-export-for-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/larswiegers/translation-export-for-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/larswiegers/translation-export-for-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/larswiegers/translation-export-for-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/larswiegers/translation-export-for-laravel.svg?style=flat-square)](https://packagist.org/packages/larswiegers/translation-export-for-laravel)

This package allows you to export your Laravel translations to JSON files.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/translation-export-for-laravel.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/translation-export-for-laravel)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require larswiegers/translation-export-for-laravel
```

## Usage

Export all translations for a single language:

```bash
php artisan translations:export en
```

Export all translations for all languages, each to their own file:

```bash
php artisan translations:export
```

Export all translations for all languages to a single file:

```bash
php artisan translations:export --all
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Lars Wiegers](https://github.com/LarsWiegers)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

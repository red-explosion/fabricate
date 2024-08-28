# Fabricate

[![Latest Version on Packagist](https://img.shields.io/packagist/v/red-explosion/fabricate.svg?style=flat-square)](https://packagist.org/packages/red-explosion/fabricate)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/red-explosion/fabricate/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/red-explosion/fabricate/actions/workflows/tests.yml?query=branch:main)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/red-explosion/fabricate/coding-standards.yml?label=code%20style&style=flat-square)](https://github.com/red-explosion/fabricate/actions/workflows/coding-standards.yml?query=branch:main)
[![Total Downloads](https://img.shields.io/packagist/dt/red-explosion/fabricate.svg?style=flat-square)](https://packagist.org/packages/red-explosion/fabricate)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require red-explosion/fabricate
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="fabricate-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="fabricate-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="fabricate-views"
```

## Usage

```php
$variable = new RedExplosion\Fabricate();
echo $variable->echoPhrase('Hello, Red Explosion!');
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

If you discover a security vulnerability, please send an e-mail to Ben Sherred via ben@redexplosion.co.uk. All security
vulnerabilities will be promptly addressed.

## Credits

- [Ben Sherred](https://github.com/bensherred)
- [All Contributors](../../contributors)

## License

Fabricate is open-sourced software licensed under the [MIT license](LICENSE.md).

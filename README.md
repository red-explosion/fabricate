<p align="center"><img src="/art/logo.svg" height="68" alt="Fabricate"></p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/red-explosion/fabricate.svg?style=flat-square)](https://packagist.org/packages/red-explosion/fabricate)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/red-explosion/fabricate/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/red-explosion/fabricate/actions/workflows/tests.yml?query=branch:main)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/red-explosion/fabricate/coding-standards.yml?label=code%20style&style=flat-square)](https://github.com/red-explosion/fabricate/actions/workflows/coding-standards.yml?query=branch:main)
[![Total Downloads](https://img.shields.io/packagist/dt/red-explosion/fabricate.svg?style=flat-square)](https://packagist.org/packages/red-explosion/fabricate)

## Introduction

After creating multiple projects over the years, we found that we were repeating the same steps over and over again.
Install these packages, add these files, delete the files etc. and it got to a point where it became tedious. That's
where Fabricate comes in.

Fabricate is an opinionated yet flexible package for building Laravel applications. It installs a number of recommended
packages, publishes stub files (such as architecture tests) and much more. Fabricate is designed to work with a blank
Laravel or any of the official starter kits.

## Installation

First, you should [create a new Laravel application](https://laravel.com/docs/11.x/installation). Fabricate is designed
to work with any of the Laravel starter kits or a blank Laravel application.

Once you have created a new Laravel application, you will need to install Fabricate using Composer:

```bash
composer require red-explosion/fabricate
```

After Composer has installed the Fabricate package, you should run the `fabricate:install` Artisan command. This
command installs additional packages, publishes stubs and fixes any linting errors. Fabricate publishes all of its code
to your application so that you have full control and visibility over its features and implementation.

```bash
php artisan fabricate:install
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

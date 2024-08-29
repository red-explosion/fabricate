# Project Name

## Holla 👋

Hello and welcome to the Project Name codebase. This README has been written to provide you with all the information
you need to get up and running with the project. Like any piece of software, things are constantly changing and it's
easy for information to become outdated.

At Red Explosion, we take pride in the code we write to help deliver our companies mission. We love what we do and we
take pride in our work. We're so excited to see what contributions you make to this project, but all we ask is that you
keep information such as installation steps, documentation and tests up to date 🙇

## Installation

Project Name is a regular Laravel application; it's build on top of Laravel 11 and uses X for the frontend. If you are
familiar with Laravel, you should feel right at home.

In terms of local development, you will need the following requirements:

- PHP 8.3
- Node.js 22
- Yarn

> [!NOTE]
> We recommend using either [Laravel Herd](https://herd.laravel.com/) or [Laravel Valet](https://laravel.com/docs/11.x/valet)
> for local development.

Once you meet these requirements, you can start by cloning the repository and installing the dependencies:

```bash
git clone git@github.com/red-explosion/project-name.git

cd project-name
```

Next, install the dependencies using [Composer](https://getcomposer.org) and [Yarn](https://yarnpkg.com):

```bash
composer install

yarn install
```

After that, set up your `.env` file:

```bash
cp .env.example .env

php artisan key:generate
```

Run the migrations:

```bash
php artisan migrate
```

Link the storage to the public folder:

```bash
php artisan storage:link
```

In a **separate terminal**, build the assets in watch mode:

```bash
yarn dev
```

Also in a **separate terminal**, run the queue worker:

```bash
php artisan queue:listen --queue=default
```

## Tooling

Red Explosion uses a few tools to ensure the code quality and consistency. [Pest](https://pestphp.com) is the testing
framework of choice, and we also use [PHPStan](https://phpstan.org) for static analysis.

For code style, we use [Laravel Pint](https://laravel.com/docs/11.x/pint) to ensure the code is consistent and follows
the Red Explosion project conventions. We also use [Rector](https://getrector.org) to ensure the code is up to date
with the latest PHP version.

You run these tools individually using the following commands:

```bash
# Lint the code using Pint
composer lint
composer test:lint

# Refactor the code using Rector
composer refactor
composer test:refactor

# Run PHPStan
composer test:types

# Run the test suite
composer test:unit

# Run all the tools
composer test
```

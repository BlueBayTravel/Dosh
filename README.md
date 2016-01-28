# Dosh

[![StyleCI](https://styleci.io/repos/50581478c/shield)](https://styleci.io/repos/50581478c)
[![Build Status](https://img.shields.io/travis/BlueBayTravel/Dosh.svg?style=flat-square)](https://travis-ci.org/BlueBayTravel/Dosh)

```php
// Parse a document.
$dosh = new Dosh(Dosh::GBP, 3);
$dosh->format('25.43'); // £25.430

// Dependency injection example.
$dosh->format("100");

// Change currency
$dosh = new Dosh(Dosh::USD);
$dosh->format("100"); // $100
````

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require bluebaytravel/dosh
```

### Laravel Installation

Add the service provider to `config/app.php` in the `providers` array.

```php
BlueBayTravel\Dosh\DoshServiceProvider::class
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in `config/app.php` to your aliases array.

```php
'Dosh' => BlueBayTravel\Dosh\Facades\Dosh::class
```

## License

Blue Bay Travel Dosh is licensed under [The MIT License (MIT)](LICENSE).

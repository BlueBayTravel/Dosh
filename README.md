# Dosh

[![StyleCI](https://styleci.io/repos/47688815/shield)](https://styleci.io/repos/47688815)
[![Build Status](https://img.shields.io/travis/BlueBayTravel/Phrontmatter.svg?style=flat-square)](https://travis-ci.org/BlueBayTravel/Phrontmatter)

```php
// Parse a document.
Phrontmatter::parse("---\nfoo: bar---\nThis is actual content!")->foo;
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

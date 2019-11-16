# PHPStan configuration for Phony

[![Current version image][version-image]][current version]

[current version]: https://packagist.org/packages/eloquent/phpstan-phony
[version-image]: https://img.shields.io/packagist/v/eloquent/phpstan-phony.svg?style=flat-square "This project uses semantic versioning"

## Installation

    composer require --dev eloquent/phpstan-phony

## Usage

Once installed, a simple include can be added to the PHPStan configuration:

```yaml
includes:
  - vendor/eloquent/phpstan-phony/phony.neon
```

## Features

This repo currently supports correct type information for the following Phony
mocking use cases:

```php
mock(ClassA::class)->get();
partialMock(ClassA::class)->get();
mockBuilder(ClassA::class)->get();
mockBuilder(ClassA::class)->full();
mockBuilder(ClassA::class)->partial();
mockBuilder(ClassA::class)->partialWith();

Phony::mock(ClassA::class)->get();
Phony::partialMock(ClassA::class)->get();
Phony::mockBuilder(ClassA::class)->get();
Phony::mockBuilder(ClassA::class)->full();
Phony::mockBuilder(ClassA::class)->partial();
Phony::mockBuilder(ClassA::class)->partialWith();

mock(ClassA::class)->methodA;
onStatic(mock(ClassA::class))->staticMethodA;
```

## License

For the full copyright and license information, please view the [LICENSE file].

[license file]: LICENSE

> # No longer maintained
>
> This package is no longer maintained. See [this statement] for more info.
>
> [this statement]: https://gist.github.com/ezzatron/713a548735febe3d76f8ca831bc895c0

# PHPStan configuration for Phony

[![Current version image][version-image]][current version]

[current version]: https://packagist.org/packages/eloquent/phpstan-phony
[version-image]: https://img.shields.io/packagist/v/eloquent/phpstan-phony.svg?style=flat-square "This project uses semantic versioning"

## Installation

    composer require --dev eloquent/phpstan-phony

## Usage

- When using [phpstan/extension-installer], no configuration is necessary.
- Alternatively, an include can be added to the PHPStan configuration:

```yaml
includes:
  - vendor/eloquent/phpstan-phony/phony.neon
```

[phpstan/extension-installer]: https://github.com/phpstan/extension-installer

## Features

This repo currently supports correct type information for the following Phony
mocking use cases:

```php
mock(ClassA::class)->get();
mock([ClassA::class, ClassB::class])->get();
partialMock(ClassA::class)->get();
partialMock([ClassA::class, ClassB::class])->get();
mockBuilder(ClassA::class)->get();
mockBuilder([ClassA::class, ClassB::class])->get();
mockBuilder(ClassA::class)->full();
mockBuilder([ClassA::class, ClassB::class])->full();
mockBuilder(ClassA::class)->partial();
mockBuilder([ClassA::class, ClassB::class])->partial();
mockBuilder(ClassA::class)->partialWith();
mockBuilder([ClassA::class, ClassB::class])->partialWith();

Phony::mock(ClassA::class)->get();
Phony::mock([ClassA::class, ClassB::class])->get();
Phony::partialMock(ClassA::class)->get();
Phony::partialMock([ClassA::class, ClassB::class])->get();
Phony::mockBuilder(ClassA::class)->get();
Phony::mockBuilder([ClassA::class, ClassB::class])->get();
Phony::mockBuilder(ClassA::class)->full();
Phony::mockBuilder([ClassA::class, ClassB::class])->full();
Phony::mockBuilder(ClassA::class)->partial();
Phony::mockBuilder([ClassA::class, ClassB::class])->partial();
Phony::mockBuilder(ClassA::class)->partialWith();
Phony::mockBuilder([ClassA::class, ClassB::class])->partialWith();

mock(ClassA::class)->methodA;
onStatic(mock(ClassA::class))->staticMethodA;
```

## License

For the full copyright and license information, please view the [LICENSE file].

[license file]: LICENSE

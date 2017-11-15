# PHPStan configuration for Phony

[![Current version image][version-image]][current version]
[![Current build status image][build-image]][current build status]
[![Current Windows build status image][windows-build-image]][current windows build status]

[build-image]: https://img.shields.io/travis/eloquent/phpstan-phony/master.svg?style=flat-square "Current build status for the master branch"
[current build status]: https://travis-ci.org/eloquent/phpstan-phony
[current version]: https://packagist.org/packages/eloquent/phpstan-phony
[current windows build status]: https://ci.appveyor.com/project/eloquent/phpstan-phony
[version-image]: https://img.shields.io/packagist/v/eloquent/phpstan-phony.svg?style=flat-square "This project uses semantic versioning"
[windows-build-image]: https://img.shields.io/appveyor/ci/eloquent/phpstan-phony/master.svg?label=windows&style=flat-square "Current Windows build status for the master branch"

## Installation

- Available as [Composer] package [eloquent/phpstan-phony].

[composer]: http://getcomposer.org/
[eloquent/phpstan-phony]: https://packagist.org/packages/eloquent/phpstan-phony

## Usage

Once installed, the appropriate include can be added to the PHPStan
configuration, based upon the Phony namespace in use:

```yaml
includes:
  - vendor/eloquent/phpstan-phony/etc/kahlan.neon     # for Eloquent\Phony\Kahlan
  - vendor/eloquent/phpstan-phony/etc/phpunit.neon    # for Eloquent\Phony\Phpunit
  - vendor/eloquent/phpstan-phony/etc/pho.neon        # for Eloquent\Phony\Pho
  - vendor/eloquent/phpstan-phony/etc/standalone.neon # for Eloquent\Phony
```

## Features

This repo currently supports correct type information for the following Phony
mocking use cases:

```php
$mock = mock(ClassA::class)->get();
$mock = partialMock(ClassA::class)->get();
$mock = mockBuilder(ClassA::class)->get();
$mock = mockBuilder(ClassA::class)->full();
$mock = mockBuilder(ClassA::class)->partial();
$mock = mockBuilder(ClassA::class)->partialWith();

$mock = Phony::mock(ClassA::class)->get();
$mock = Phony::partialMock(ClassA::class)->get();
$mock = Phony::mockBuilder(ClassA::class)->get();
$mock = Phony::mockBuilder(ClassA::class)->full();
$mock = Phony::mockBuilder(ClassA::class)->partial();
$mock = Phony::mockBuilder(ClassA::class)->partialWith();
```

## License

For the full copyright and license information, please view the [LICENSE file].

[license file]: LICENSE

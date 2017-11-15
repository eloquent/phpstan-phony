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

Once installed, add the appropriate include can be added to the PHPStan
configuration:

```yaml
includes:
  - vendor/eloquent/phpstan-phony/etc/<appropriate configuration>.neon
```

Which include to use depends on the Phony namespace in use:

- For `Eloquent\Phony\Kahlan`, use `vendor/eloquent/phpstan-phony/etc/kahlan.neon`.
- For `Eloquent\Phony\Pho`, use `vendor/eloquent/phpstan-phony/etc/pho.neon`.
- For `Eloquent\Phony\Phpunit`, use `vendor/eloquent/phpstan-phony/etc/phpunit.neon`.
- For `Eloquent\Phony`, use `vendor/eloquent/phpstan-phony/etc/standalone.neon`.

## License

For the full copyright and license information, please view the [LICENSE file].

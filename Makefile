SHELL := /bin/bash -o pipefail
.DEFAULT_GOAL := test

ifdef CI
_DEP_PREREQ += artifacts/logs/ci-install
endif

################################################################################
# Internal variables
################################################################################

# _SRC contains the paths to all PHP source files.
_SRC ?= $(shell find ./src -name '*.php' 2> /dev/null)

# _TEST_SRC contains the paths to all test files.
_TEST_SRC := $(shell find ./test -type f 2> /dev/null)

# This is used in lots of targets
_ALL_SRC := $(_SRC) $(_TEST_SRC)

################################################################################
# Commands (Phony Targets)
################################################################################

# Run all tests.
.PHONY: test
test: vendor
	php --version
	vendor/bin/kahlan

# Remove all files that match the patterns .gitignore.
.PHONY: clean-all
clean-all:: clean
	rm -rf ./vendor

# Remove files that match the patterns .gitignore, excluding the vendor folder.
.PHONY: clean
clean::
	@git check-ignore ./* | grep -v ^./vendor | xargs -t -n1 rm -rf

# Perform code linting, syntax formatting, etc.
.PHONY: lint
lint: artifacts/logs/php-cs-fixer artifacts/logs/phpstan artifacts/logs/composer-validate

# Perform pre-commit checks.
.PHONY: prepare
prepare: lint test

# Install CI dependencies
.PHONY: ci-install
ci-install: vendor

# Run the CI build.
.PHONY: ci
ci: lint test

################################################################################
# File Targets
################################################################################

.DELETE_ON_ERROR:

vendor: composer.json
ifeq (${TRAVIS_PHP_VERSION},nightly)
	composer install --ignore-platform-reqs
else
	composer install
endif

composer.json:
	composer init --no-interaction

artifacts/logs/php-cs-fixer: vendor $(_ALL_SRC)
	@mkdir -p "$(@D)"
	vendor/bin/php-cs-fixer fix | tee "$@"

artifacts/logs/phpstan: vendor $(_ALL_SRC)
	@mkdir -p "$(@D)"
	vendor/bin/phpstan analyze --configuration test/phpstan.neon --level=7 --no-progress . | tee "$@"

artifacts/logs/composer-validate: composer.json
	@mkdir -p "$(@D)"
	composer validate --no-check-publish | tee "$@"

artifacts/logs/ci-install:
	@mkdir -p "$(@D)"
	(phpenv config-rm xdebug.ini || true) | tee "$@"

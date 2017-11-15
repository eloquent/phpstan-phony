.PHONY: test
test: vendor
	php --version
	vendor/bin/kahlan --reporter=verbose

.PHONY: lint
lint: vendor
	vendor/bin/php-cs-fixer fix
	vendor/bin/phpstan analyze --configuration test/phpstan.neon --level=7 .

vendor: composer.lock
	composer install
	@touch $@

composer.lock: composer.json
	composer update
	@touch $@

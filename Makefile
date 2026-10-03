COMPOSE = docker compose
PHP = $(COMPOSE) exec -T php
.PHONY: install start stop reset test fixtures lint phpstan validate coverage generate
install:
	$(COMPOSE) build --pull
start:
	$(COMPOSE) up -d --wait
stop:
	$(COMPOSE) down
reset:
	$(PHP) php bin/console doctrine:fixtures:load --no-interaction
fixtures: reset
test:
	$(PHP) php bin/console doctrine:database:create --env=test --if-not-exists
	$(PHP) php bin/console doctrine:migrations:migrate --env=test --no-interaction
	$(COMPOSE) exec -T -e APP_ENV=test php vendor/bin/phpunit
lint:
	$(PHP) vendor/bin/php-cs-fixer fix --dry-run --diff
phpstan:
	$(PHP) vendor/bin/phpstan analyse --memory-limit=512M
validate:
	$(PHP) composer validate --strict
	$(PHP) php bin/validate.php
coverage:
	$(PHP) php bin/console pam:api:coverage
generate:
	$(PHP) php bin/console api:openapi:export --output=api/openapi.json
	$(PHP) php bin/generate.php

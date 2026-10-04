# Contributing

Use fictional data and public sources. Keep implementation changes to one operation or coherent group. Do not implement a domain through generic CRUD just because its routes exist in the inventory.

For an endpoint change:

1. Read its source and confirm the target product/version.
2. Update `api/pam-endpoints.yaml`, including request/response schemas and uncertainty notes.
3. Put domain behavior in `src/Pam/<Domain>` and return the actual HTTP shape.
4. Add integration tests in `tests/Compatibility` and link their file in the manifest. Include the operation ID in its contract test.
5. Export OpenAPI with `php bin/console api:openapi:export --output=api/openapi.json`, then run `php bin/generate.php`.
6. Run `make test`, `make lint`, `make phpstan`, and `make validate`.

CI rejects duplicate IDs/routes, missing sources, implemented operations without linked compatibility tests, manifest/OpenAPI disagreement and invalid OpenAPI structure. It also checks committed generated files are current. Do not mark an operation implemented while it still returns 501.

## Native development

PHP 8.5 and Composer are required. Use the optional `compose.dev.yaml` only for native development; it publishes PostgreSQL on localhost port 54329.

```bash
docker compose -f compose.yaml -f compose.dev.yaml up -d database
composer install
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console pam:fixtures:initialize
php bin/console doctrine:database:create --env=test --if-not-exists
php bin/console doctrine:migrations:migrate --env=test --no-interaction
vendor/bin/phpunit
vendor/bin/phpstan analyse
vendor/bin/php-cs-fixer fix --dry-run --diff
```

`doctrine:fixtures:load --no-interaction` replaces the local dataset. It is intentionally destructive only to this project's database. Tests truncate only the isolated `_test` database. Never point this application at a real environment.

The active backlog lives in [GitHub Issues](https://github.com/amoncif/pam-mock-server/issues). Keep compatibility limits and coverage in the manifest instead of maintaining a duplicate issue export.

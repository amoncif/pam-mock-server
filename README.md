# PAM Mock Server

PAM Mock Server is a self-hosted API for developing and testing integrations that normally communicate with CyberArk PAM.

It provides a local environment with fictional ACME users, safes, accounts and platforms. No CyberArk Vault is required. The goal is HTTP API compatibility, not to reproduce the CyberArk product.

This project is an independent open-source project and is not affiliated with, sponsored by, or endorsed by CyberArk.

## Start

```bash
git clone https://github.com/amoncif/pam-mock-server.git
cd pam-mock-server
docker compose up -d
```

The first start builds PHP and installs the locked dependencies. It takes a few minutes. Then open [Swagger](http://localhost:8080/api/docs). The health check is at `http://localhost:8080/health`. To wait until initialization finishes, use `docker compose up -d --wait`.

Requirements: Docker Engine or Docker Desktop with Compose v2. Ports bind to localhost. The database has no published port by default.

## Log in

```bash
curl -sS http://localhost:8080/PasswordVault/API/Auth/CyberArk/Logon \
  -H 'Content-Type: application/json' \
  -d '{"username":"pamadmin","password":"PamAdmin123!"}'
```

The response is a JSON string containing the token. Send its unquoted value in `Authorization`, without a Bearer prefix.

```bash
TOKEN=$(curl -sS http://localhost:8080/PasswordVault/API/Auth/CyberArk/Logon \
  -H 'Content-Type: application/json' \
  -d '{"username":"pamadmin","password":"PamAdmin123!"}' | python3 -c 'import sys,json; print(json.load(sys.stdin))')
curl -sS http://localhost:8080/mock/session -H "Authorization: $TOKEN"
curl -sS -X POST http://localhost:8080/PasswordVault/API/Auth/Logoff -H "Authorization: $TOKEN"
```

`/mock/session` is a project-only diagnostic route. It is not a CyberArk endpoint. After logoff the token returns 401. A valid token on Accounts, Safes or another stub returns 501 with `ErrorCode: PAMMOCK001`.

## Local users

| Provider | Username | Password |
|---|---|---|
| CyberArk | pamadmin | PamAdmin123! |
| CyberArk | auditor | Audit123! |
| CyberArk | psmoperator | PsmOperator123! |
| LDAP | john.ldap | LdapUser123! |
| Windows | windows.user | WindowsUser123! |
| RADIUS | radius.user | RadiusUser123! |

These are public local development credentials. See [all fixture users](docs/development-credentials.md), including disabled, locked and expired-password cases. SAML accepts a fixed local fixture assertion, included in the clients. Shared logon uses the local `appuser` identity.

## Current scope

The manifest contains 320 known operations. Eleven authentication routes are implemented. The other 309 are stubs. There are 13 users, 8 safes, 40 accounts, 8 project-created platforms and 26 memberships in the deterministic dataset. Seed data is not exposed through working Accounts or Safes APIs yet.

Implemented authentication: CyberArk, LDAP, Windows credential logon, RADIUS credential logon, SAML fixture logon, shared logon, first-generation CyberArk logon and their logout routes. Password replacement is available for CyberArk and LDAP. Sessions use random opaque tokens, hashed storage and a 20-minute fixed lifetime.

**Compatibility is not complete.** The inventory combines official authentication contracts with versioned public client references. Most stub success responses need official verification. OAuth, PKI/PKIPN, legacy SAML, Windows integrated negotiation and interactive RADIUS challenges are tracked as gaps, not working capabilities. See [compatibility](docs/compatibility.md) and [sources](docs/api-sources.md). No exhaustive PAM 15.2 compatibility claim is made.

## Commands

```bash
make install    # build the application image
make start      # start and wait for readiness
make stop
make reset      # replace this project's data with the original fixtures
make fixtures  # same reset operation
make test       # run compatibility tests in a separate PostgreSQL database
make lint
make phpstan
make validate
make coverage
make generate
```

`make reset` invalidates all sessions and restores fixture passwords. Normal restart preserves data. After changing code, run `docker compose up -d --build`. To change the port, run `PAM_HTTP_PORT=8081 docker compose up -d`.

For native PHP development, copy `.env.example` to `.env.local`, then start only PostgreSQL with `docker compose -f compose.yaml -f compose.dev.yaml up -d database`. Run `composer install` and the migration/fixture commands documented in [contributing](docs/contributing.md). PHP 8.5 is required by the locked toolchain.

## Clients

Import both files from [clients/postman](clients/postman), select the local environment and run the Authentication folder. Tokens are captured automatically. The collection includes invalid credentials and token reuse examples.

Open [clients/bruno](clients/bruno) as a collection and select `local`. Its Authentication folder is equivalent and executable. Both clients use `baseUrl`, `username`, `password` and `token`; provider-specific fixture variables are included. Future domains have their own folders. Swagger contains every known stub.

## Contribute

Read [contributing](docs/contributing.md), [architecture](docs/architecture.md) and the [roadmap](docs/roadmap.md). Work on one endpoint or coherent operation group per change. Record a public source before adding an endpoint. Add compatibility tests before marking it implemented. Run all checks and regenerate derived artifacts.

The code is licensed under Apache-2.0. Reference attribution is in [NOTICE](NOTICE) and [third-party notices](docs/third-party). Do not add real credentials, customer information, proprietary files or product branding.

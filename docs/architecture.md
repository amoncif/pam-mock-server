# Architecture

The runtime uses PHP 8.5, Symfony 7.4 LTS, API Platform 5 and PostgreSQL 18. Composer locks exact dependency versions. API Platform supplies Swagger and the OpenAPI model. Symfony controllers return the target HTTP payload directly so a token stays a JSON string, not a resource envelope.

`src/Pam/Authentication` owns credential validation and persisted users/sessions. `src/Shared/Api` owns manifest routing, compatibility path matching, OpenAPI decoration, error formatting and coverage. `src/Shared/Fixtures` owns the deterministic ACME dataset. Additional domain directories should be added when they gain behavior; empty abstraction layers are intentionally avoided.

`api/pam-endpoints.yaml` is the source of truth. It uses the JSON subset of YAML 1.2 so it can be read by both PHP and maintenance tools without a second data model. Every entry records a source URL, version/revision, confidence, parameters, request schema, response knowledge and implementation state. Runtime routes and Swagger are generated from this data. `api/openapi.json`, the Markdown inventory and client files are derived artifacts.

Exact method/path pairs are deduplicated case-insensitively. Equivalent placeholder names are normalized. The early routing subscriber provides IIS-like literal case and trailing-slash behavior without redirecting POST requests. Placeholder values keep their case. Unknown paths are 404; wrong methods are 405. Core operations dispatch to `src/Pam/Core`; unsupported operations retain the explicit 501 contract.

Authentication persists Argon2id password hashes and SHA-256 token digests. A token contains 48 cryptographically random bytes encoded as Base64. A PostgreSQL row lock serializes logon for one user. Sessions record the provider, timestamps, optional legacy connection number and expiry. Logout deletes the session. Token validation checks the user is still active. No LDAP, RADIUS, Vault, AD, SAML IdP or Windows server is contacted.

Core data uses persistent JSON documents in `lab_object`; authentication users and sessions use dedicated entities. `ObjectStore` centralizes persistence, and `CoreService` validates references, safe permissions and input. A PostgreSQL transaction and advisory lock serialize simulator operations, ensuring failed multi-object updates roll back. This deliberately simple local-lab design is not a scalable production vault. Account secrets are fictional plaintext stored only in private document fields; list/detail responses exclude them. Reset loads fixed password hashes, identifiers and dates from the same file; only newly created session tokens are intentionally random.

Docker Compose runs Nginx, PHP-FPM and PostgreSQL. Startup applies versioned migrations and seeds only an empty database. Nginx serves API Platform's local assets, so Swagger does not need an external CDN. The test database has a `_test` suffix and is separate from the development dataset.

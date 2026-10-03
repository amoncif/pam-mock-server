# Foundation delivery report

1. Repository: https://github.com/amoncif/pam-mock-server (public).
2. Development branch: `feat/authentication`. Stable default branch: `main`. Review: pull request #80.
3. Architecture: PHP 8.5, Symfony 7.4 LTS, API Platform 5, PostgreSQL 18, Nginx/PHP-FPM and Docker Compose. Authentication is a separate module. One sourced manifest drives routes, OpenAPI and coverage. Other domains expose no business behavior.
4. Startup: `git clone https://github.com/amoncif/pam-mock-server.git && cd pam-mock-server && docker compose up -d`. Wait for the initial image build and health check. `make start` waits for readiness.
5. Swagger: http://localhost:8080/api/docs. OpenAPI: http://localhost:8080/api/docs.jsonopenapi.
6. Local credentials: `pamadmin / PamAdmin123!`, `auditor / Audit123!`, `psmoperator / PsmOperator123!`, `john.ldap / LdapUser123!`, `windows.user / WindowsUser123!`, `radius.user / RadiusUser123!`. Full fake dataset and SAML instructions: [development credentials](development-credentials.md).
7. Implemented authentication operations are listed below.
8. Known inventory: 320 distinct method/path pairs after normalization and deduplication.
9. Implemented: 11 (3.44% of the known inventory).
10. Stubs: 309. Protected stubs validate the raw token and then return 501/PAMMOCK001. Invalid tokens return 401.
11. Sources: current official authentication documentation observed as PAM Self-Hosted 15.2; MIT-licensed Bruno Self-Hosted reference revision `966d9e9e77bbcf684becc424f04227d111e0191a` targeting 14.6; MIT-licensed psPAS revision `df2b7986421285eccb3a3454def15b99d2f99677`; official public script examples. See [source record](api-sources.md).
12. Validation: 32 PHPUnit integration tests with 2,475 assertions pass on native PHP 8.5.3 and container PHP 8.5.11 against PostgreSQL. Composer strict validation, PHPStan level 6, PHP-CS-Fixer, manifest validation and OpenAPI 3.1 validation pass. Postman/Newman: 22 requests and 22 assertions pass. Bruno CLI: 22 requests and 22 tests pass. Docker startup, health, Swagger and the manual login → token reuse → stub → logout → rejected reuse flow pass. GitHub's project CI passes. The separately installed GitGuardian check flags intentionally public fixture credentials; this is documented, not silently disabled.
13. Backlog: 339 published issues: 15 epics, 13 authentication stories, 309 operation-level stub stories and 2 explicit gap/audit stories. Published issue links are in `github-issues.json`. The requested labels and `v0.1 - PAM API Foundation` milestone are created.
14. Limits: this is a working foundation and authentication profile, not complete PAM authentication fidelity or a certified exhaustive 15.2 inventory. OAuth, PKI/PKIPN, legacy SAML, Windows integrated negotiation and RADIUS challenge continuation remain open. Most stub success schemas and exact provider error-code details still require verification. SAML-specific logout response, concurrency replacement and fixed expiry include explicit local assumptions. See [compatibility](compatibility.md).
15. Next section: Accounts, beginning with list/details and pagination/search/filter contracts. Accounts, Safes and other domains were not implemented in this delivery.

## Implemented routes

All use POST. Literal path case and an optional trailing slash are accepted.

| Operation | Path |
|---|---|
| CyberArk logon | `/PasswordVault/API/auth/Cyberark/Logon` |
| LDAP logon | `/PasswordVault/API/auth/LDAP/Logon` |
| Windows credential logon | `/PasswordVault/API/auth/Windows/Logon` |
| RADIUS credential logon | `/PasswordVault/API/auth/RADIUS/Logon` |
| Common logoff | `/PasswordVault/API/Auth/Logoff` |
| SAML fixture logon | `/PasswordVault/API/auth/SAML/Logon` |
| SAML logoff alias | `/PasswordVault/API/auth/SAML/Logoff` |
| Legacy CyberArk logon | `/PasswordVault/WebServices/auth/Cyberark/CyberArkAuthenticationService.svc/Logon` |
| Legacy CyberArk logoff | `/PasswordVault/WebServices/auth/Cyberark/CyberArkAuthenticationService.svc/Logoff` |
| Shared logon | `/PasswordVault/WebServices/auth/Shared/RestfulAuthenticationService.svc/Logon` |
| Shared logoff | `/PasswordVault/WebServices/auth/Shared/RestfulAuthenticationService.svc/Logoff` |

The additional `/mock/session` diagnostic route is project-specific and excluded from PAM inventory counts.

Main branch protection is enabled for administrators too. Force pushes and deletion are blocked. The checks and docker-smoke CI jobs are required for future merges.

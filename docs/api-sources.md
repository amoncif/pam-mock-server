# Public sources and clean-room record

Reviewed on 2026-10-03. Implementation uses public HTTP contracts only. No private software, customer data, reverse engineering or proprietary files were used. Descriptions in this repository are independently written.

## Official documentation — primary

- [REST API overview and Authorization header](https://docs.cyberark.com/pam-self-hosted/latest/en/content/webservices/implementing%20privileged%20account%20security%20web%20services%20.htm)
- [Authentication overview](https://docs.cyberark.com/pam-self-hosted/latest/en/content/webservices/rest%20web%20services%20api%20-%20authentication.htm)
- [Credential logon and first-generation contract](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/cyberark%20authentication%20-%20logon_v10.htm)
- [Credential logoff and first-generation contract](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/cyberark%20authentication%20-%20logoff_v10.htm)
- [SAML form logon](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/saml_%20authentication_%20logon_newgen.htm)
- [Shared logon](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/shared%20logon%20authentication%20-%20logon.htm)
- [Shared logoff](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/shared%20logon%20authentication%20-%20logoff.htm)
- [OAuth authentication](https://docs.cyberark.com/pam-self-hosted/latest/en/content/pas%20inst/oauth2-authentication.htm)
- [OAuth provider configuration](https://docs.cyberark.com/pam-self-hosted/latest/en/content/webservices/api-oauth2-auth-config_lp.htm)

The current pages identify PAM Self-Hosted 15.2. The `latest` URL is mutable; this review date and the observed version are recorded in the manifest. The pages remain owned by their publisher. Only contract facts are recorded, with no page text copied wholesale. Some direct HTTP fetches returned 404 while the public indexed documentation remained readable; this limits reproducible full-site enumeration.

## Public request references — secondary

1. [IAM-Jah/CyberArk-REST-API-Bruno](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno), revision `966d9e9e77bbcf684becc424f04227d111e0191a`. License inspected before extracting request facts: MIT, copyright Eli Hopkins. Only the Self-Hosted PAM subtree was considered. It identifies PVWA LTS 14.6 as its baseline. Attribution and the complete license are in `third-party/bruno-MIT.txt`. Query names, request field/type examples and request paths were extracted; descriptions and scripts were not imported into our clients.
2. [pspete/psPAS](https://github.com/pspete/psPAS), revision `df2b7986421285eccb3a3454def15b99d2f99677`. MIT license inspected before use; preserved in `third-party/psPAS-MIT.txt`. Public request targets supplement the first reference and expose version/transport differences. Runtime implementation code was written independently. Functions using a separate cloud `ApiURI` or VRM host were excluded.
3. [cyberark/epv-api-scripts](https://github.com/cyberark/epv-api-scripts). Apache-2.0 license inspected. Public examples corroborate ordinary logon and raw Authorization usage. No scripts were copied.
4. [Public Postman SAML example](https://www.postman.com/jeedem/cyberarkrestapi/request/mxhu2w3/logon). Consulted for comparison only; no collection or documentation was imported. Official form-body instructions take precedence over the example's query placement.

Each manifest operation links to its exact public reference. A reference-only entry is not represented as official verification. Known collection issues include malformed URL prefixes, parameter typos, bulk-action paths and repeated method/path entries. Equivalent routes were normalized and deduplicated. Review candidates are retained for further audit.

## Standards and framework sources

- [Symfony 7.4 LTS](https://symfony.com/releases/7.4). Selected for its maintenance window.
- Composer resolved stable mutually compatible packages on the review date; `composer.lock` records exact versions.
- [OpenAPI 3.1 schema](https://spec.openapis.org/oas/3.1/schema/2022-10-07), from the Apache-2.0 OpenAPI Specification project. Stored locally for offline CI validation. `bin/validate.php` resolves its local dynamic meta anchor explicitly for the validator. The original schema file is unchanged.

## License decision

Apache-2.0 is used for the original project code. It supplies an explicit patent grant and retains attribution obligations. MIT would also be suitable but does not provide the same explicit patent terms. GPL would impose stronger redistribution obligations than needed for this integration tool. Referenced MIT material retains its notice; merely recording interface facts does not grant rights in vendor software, documentation or trademarks.

## Platform identifiers

Public platform references use identifiers such as `WinDomain` and `UnixSSH` in examples, but availability varies by installation and marketplace content. This dataset uses only `Mock...` identifiers, all marked `project-created`. None is claimed to be an official or installed vendor platform. The fixture file contains no customer-specific identifiers.

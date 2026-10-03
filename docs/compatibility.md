# Compatibility profile and gaps

The mock is independent. It reproduces public HTTP contracts needed for local tests. It does not reproduce a Vault, enforce a vendor license or claim certification.

## Confirmed authentication contracts

The current official authentication documentation identifies the four JSON credential providers, the SAML form endpoint, shared logon, and first-generation CyberArk logon. The ordinary success token is a JSON string. Legacy CyberArk wraps it in `CyberArkLogonResult`; shared logon wraps it in `LogonResult`. Authorization carries the raw token. Common logout returns an empty JSON object; first-generation CyberArk logout returns an empty body. All are POST operations. Literal URL case and an optional final slash are accepted.

`username` and `password` must be non-empty strings. CyberArk and LDAP accept `newPassword`. `concurrentSession` defaults to false; both JSON booleans and true/false strings are accepted. The documented cap is 300. Legacy `connectionNumber` accepts integers from 0 to 100. Legacy `useRadiusAuthentication` selects the local RADIUS fixture.

## Explicit mock choices

These choices are tested locally but must not be presented as verified vendor behavior:

- Incorrect credentials and disabled/locked/expired users return 403. The two-field `ErrorCode`/`ErrorMessage` shape is preserved; state codes and English message text are provisional compatibility approximations. Missing fields/malformed JSON return 400. Missing, invalid or expired session tokens return 401. Unsupported providers return a project-specific 400 code. Wrong content types return 415.
- Non-concurrent logon replaces earlier sessions. A distinct legacy connection number preserves another connection. Session lifetime is fixed at creation (1200 seconds by default); last activity is recorded without sliding expiry. Limit overflow returns a project-specific 409 error.
- The SAML fixture is a fixed, publicly documented Base64 value. It is not a signed assertion from a real IdP, and arbitrary real assertions are rejected. Its POST media type and field names match the published API contract.
- Shared logon has no body and resolves the local `appuser`. No machine trust or real shared Vault user is configured. The returned token is already Base64 and is used unchanged.
- The SAML-specific logout alias is present in the public Bruno reference. Its `{}` response is a local assumption. Use common `/PasswordVault/API/Auth/Logoff` for the officially verified logout shape.
- The raw Authorization token profile deliberately rejects a `Bearer` prefix. This must not be confused with the separate OAuth bearer flow documented in newer PAM releases.

## Investigated but not implemented

- Current PAM documentation describes OAuth client-credentials access tokens issued by an external authorization server, sent as Bearer tokens with `X-CA-Authentication-Type: OAuth`. It is not another username/password Logon provider. This project's opaque token implementation does not claim to support it.
- The public psPAS client references PKI, PKIPN, integrated Windows logon and first-generation SAML. Their transport/certificate/negotiation contracts need a dedicated local emulation profile and stronger source verification. They are tracked in the advanced-authentication issue.
- RADIUS OTP/challenge continuation and browser/IIS session cookies are not emulated. The RADIUS credential endpoint works with the fake credential pair.
- Error code distinctions, password policy details, concurrent replacement behavior and exact session expiry rules need comparison with additional public contracts. There has been no test against a real CyberArk installation.

Authentication-provider configuration, OIDC configuration, FIDO2 registration and SSH-key management are configuration/user operations. They remain stubs in this phase.

## Inventory boundaries

The 320-operation manifest is a known-source inventory, not proof of all PAM 15.2 operations. Its core reference collection targets PVWA 14.6. A newer public psPAS revision adds additional self-hosted PVWA requests. Official current authentication pages were reviewed as version 15.2. Version applicability for many non-authentication operations remains open.

Most stub responses are not available in those request-only collections. The manifest explicitly records an unspecified target response and a real 501 runtime contract instead of making up success payloads. Request fields inferred from examples do not imply an exhaustive set of required fields. Paths from community sources can also contain errors; source disagreements are listed in `inventory-review-candidates.json` for continued review.

Only PVWA paths under `/PasswordVault` belong in this manifest. Separate PTA server APIs, VRM host APIs, Privilege Cloud APIs and the products excluded in the brief are not included. PVWA-proxied PTA paths are listed as stubs. Case and placeholder normalization do not create additional counted operations.

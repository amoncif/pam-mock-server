# API inventory

Generated from `api/pam-endpoints.yaml`. Run `make generate` after changing the manifest and exporting OpenAPI.

This is the union of reviewed public PVWA references. It is not certified as exhaustive for PAM 15.2. Each entry records evidence and uncertainty. Authentication-provider configuration APIs remain stubs. Separate PTA-host, cloud-only and VRM-host services are excluded.

## auth.cyberark.logon

`POST /PasswordVault/API/auth/Cyberark/Logon` — **implemented**

- Category: Authentication
- Operation: Logon CyberArk
- Authentication: none
- Request media type: application/json
- Request fields: `username` (string), `password` (string), `concurrentSession` (boolean), `newPassword` (string)
- Parameters:
- Response contracts: 200 string; 400 object; 401 object; 403 object; 409 object; 415 object;
- Known errors: PASWS013E, PASWS006E, ITATS004E, ITATS005E, ITATS006E, ITATS009E, PAMMOCK409
- Source: [official-documentation](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/cyberark%20authentication%20-%20logon_v10.htm)
- Source version: PAM Self-Hosted 15.2, accessed 2026-10-03
- Confidence: official-contract

Local fixture authentication; no external identity service. Error text and policy choices are documented in docs/compatibility.md.

## auth.ldap.logon

`POST /PasswordVault/API/auth/LDAP/Logon` — **implemented**

- Category: Authentication
- Operation: Logon LDAP
- Authentication: none
- Request media type: application/json
- Request fields: `username` (string), `password` (string), `concurrentSession` (boolean), `newPassword` (string)
- Parameters:
- Response contracts: 200 string; 400 object; 401 object; 403 object; 409 object; 415 object;
- Known errors: PASWS013E, PASWS006E, ITATS004E, ITATS005E, ITATS006E, ITATS009E, PAMMOCK409
- Source: [official-documentation](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/cyberark%20authentication%20-%20logon_v10.htm)
- Source version: PAM Self-Hosted 15.2, accessed 2026-10-03
- Confidence: official-contract

Local fixture authentication; no external identity service. Error text and policy choices are documented in docs/compatibility.md.

## auth.logoff

`POST /PasswordVault/API/Auth/Logoff` — **implemented**

- Category: Authentication
- Operation: Logoff session
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 200 object; 400 object; 401 object; 403 object; 409 object;
- Known errors: PASWS013E, PASWS006E, ITATS004E, ITATS005E, ITATS006E, ITATS009E, PAMMOCK409
- Source: [official-documentation](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/cyberark%20authentication%20-%20logoff_v10.htm)
- Source version: PAM Self-Hosted 15.2, accessed 2026-10-03
- Confidence: official-contract

Local fixture authentication; no external identity service. Error text and policy choices are documented in docs/compatibility.md.

## auth.radius.logon

`POST /PasswordVault/API/auth/RADIUS/Logon` — **implemented**

- Category: Authentication
- Operation: Logon RADIUS
- Authentication: none
- Request media type: application/json
- Request fields: `username` (string), `password` (string), `concurrentSession` (boolean)
- Parameters:
- Response contracts: 200 string; 400 object; 401 object; 403 object; 409 object; 415 object;
- Known errors: PASWS013E, PASWS006E, ITATS004E, ITATS005E, ITATS006E, ITATS009E, PAMMOCK409
- Source: [official-documentation](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/cyberark%20authentication%20-%20logon_v10.htm)
- Source version: PAM Self-Hosted 15.2, accessed 2026-10-03
- Confidence: official-contract

Local fixture authentication; no external identity service. Error text and policy choices are documented in docs/compatibility.md.

## auth.saml.logoff

`POST /PasswordVault/API/auth/SAML/Logoff` — **implemented**

- Category: Authentication
- Operation: Logoff SAML
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 200 object; 400 object; 401 object; 403 object; 409 object;
- Known errors: PASWS013E, PASWS006E, ITATS004E, ITATS005E, ITATS006E, ITATS009E, PAMMOCK409
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Logoff/SAML%20-%20Logoff.bru)
- Source version: PAM Self-Hosted 15.2, accessed 2026-10-03
- Confidence: reference-only

Local fixture authentication; no external identity service. Error text and policy choices are documented in docs/compatibility.md. SAML-specific logout response is a local assumption; use common Auth/Logoff for the official verified contract.

## auth.saml.logon

`POST /PasswordVault/API/auth/SAML/Logon` — **implemented**

- Category: Authentication
- Operation: Logon SAML
- Authentication: none
- Request media type: application/x-www-form-urlencoded
- Request fields: `SAMLResponse` (string), `apiUse` (boolean), `concurrentSession` (boolean)
- Parameters:
- Response contracts: 200 string; 400 object; 401 object; 403 object; 409 object; 415 object;
- Known errors: PASWS013E, PASWS006E, ITATS004E, ITATS005E, ITATS006E, ITATS009E, PAMMOCK409
- Source: [official-documentation](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/saml_%20authentication_%20logon_newgen.htm)
- Source version: PAM Self-Hosted 15.2, accessed 2026-10-03
- Confidence: official-contract

Local fixture authentication; no external identity service. Error text and policy choices are documented in docs/compatibility.md.

## auth.windows.logon

`POST /PasswordVault/API/auth/Windows/Logon` — **implemented**

- Category: Authentication
- Operation: Logon Windows
- Authentication: none
- Request media type: application/json
- Request fields: `username` (string), `password` (string), `concurrentSession` (boolean)
- Parameters:
- Response contracts: 200 string; 400 object; 401 object; 403 object; 409 object; 415 object;
- Known errors: PASWS013E, PASWS006E, ITATS004E, ITATS005E, ITATS006E, ITATS009E, PAMMOCK409
- Source: [official-documentation](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/cyberark%20authentication%20-%20logon_v10.htm)
- Source version: PAM Self-Hosted 15.2, accessed 2026-10-03
- Confidence: official-contract

Local fixture authentication; no external identity service. Error text and policy choices are documented in docs/compatibility.md.

## auth.legacy.logoff

`POST /PasswordVault/WebServices/auth/Cyberark/CyberArkAuthenticationService.svc/Logoff` — **implemented**

- Category: Authentication
- Operation: Logoff CyberArk
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 200 unspecified; 400 object; 401 object; 403 object; 409 object;
- Known errors: PASWS013E, PASWS006E, ITATS004E, ITATS005E, ITATS006E, ITATS009E, PAMMOCK409
- Source: [official-documentation](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/cyberark%20authentication%20-%20logoff_v10.htm)
- Source version: PAM Self-Hosted 15.2, accessed 2026-10-03
- Confidence: official-contract

Local fixture authentication; no external identity service. Error text and policy choices are documented in docs/compatibility.md.

## auth.legacy.logon

`POST /PasswordVault/WebServices/auth/Cyberark/CyberArkAuthenticationService.svc/Logon` — **implemented**

- Category: Authentication
- Operation: Logon CyberArk
- Authentication: none
- Request media type: application/json
- Request fields: `username` (string), `password` (string), `newPassword` (string), `useRadiusAuthentication` (boolean), `connectionNumber` (integer)
- Parameters:
- Response contracts: 200 object; 400 object; 401 object; 403 object; 409 object; 415 object;
- Known errors: PASWS013E, PASWS006E, ITATS004E, ITATS005E, ITATS006E, ITATS009E, PAMMOCK409
- Source: [official-documentation](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/cyberark%20authentication%20-%20logon_v10.htm)
- Source version: PAM Self-Hosted 15.2, accessed 2026-10-03
- Confidence: official-contract

Local fixture authentication; no external identity service. Error text and policy choices are documented in docs/compatibility.md.

## auth.shared.logoff

`POST /PasswordVault/WebServices/auth/Shared/RestfulAuthenticationService.svc/Logoff` — **implemented**

- Category: Authentication
- Operation: Logoff Shared
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 200 object; 400 object; 401 object; 403 object; 409 object;
- Known errors: PASWS013E, PASWS006E, ITATS004E, ITATS005E, ITATS006E, ITATS009E, PAMMOCK409
- Source: [official-documentation](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/shared%20logon%20authentication%20-%20logoff.htm)
- Source version: PAM Self-Hosted 15.2, accessed 2026-10-03
- Confidence: official-contract

Local fixture authentication; no external identity service. Error text and policy choices are documented in docs/compatibility.md.

## auth.shared.logon

`POST /PasswordVault/WebServices/auth/Shared/RestfulAuthenticationService.svc/Logon` — **implemented**

- Category: Authentication
- Operation: Logon Shared
- Authentication: none
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 200 object; 400 object; 401 object; 403 object; 409 object;
- Known errors: PASWS013E, PASWS006E, ITATS004E, ITATS005E, ITATS006E, ITATS009E, PAMMOCK409
- Source: [official-documentation](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/shared%20logon%20authentication%20-%20logon.htm)
- Source version: PAM Self-Hosted 15.2, accessed 2026-10-03
- Confidence: official-contract

Local fixture authentication; no external identity service. Error text and policy choices are documented in docs/compatibility.md.

## account.groups.get.account.group.by.safe

`GET /PasswordVault/API/AccountGroups` — **stub**

- Category: Account Groups
- Operation: Get Account Group by Safe
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `Safe`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Groups/Get%20Account%20Group%20by%20Safe.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## account.groups.add.account.group

`POST /PasswordVault/API/AccountGroups` — **stub**

- Category: Account Groups
- Operation: Add Account Group
- Authentication: token
- Request media type: application/json
- Request fields: `GroupName` (string), `GroupPlatformID` (string), `Safe` (string)
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Groups/Add%20Account%20Group.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## account.groups.get.account.group.members

`GET /PasswordVault/API/AccountGroups/{groupID}/Members` — **stub**

- Category: Account Groups
- Operation: Get Account Group Members
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `groupID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Groups/Get%20Account%20Group%20Members.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## account.groups.add.member.to.account.group

`POST /PasswordVault/API/AccountGroups/{groupID}/Members` — **stub**

- Category: Account Groups
- Operation: Add Member to Account Group
- Authentication: token
- Request media type: application/json
- Request fields: `AccountID` (string)
- Parameters: path `groupID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Groups/Add%20Member%20to%20Account%20Group.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## account.groups.delete.member.from.account.group

`DELETE /PasswordVault/API/AccountGroups/{groupID}/Members/{accountID}` — **stub**

- Category: Account Groups
- Operation: Delete Member from Account Group
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `groupID`, path `accountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Groups/Delete%20Member%20from%20Account%20Group.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## account.groups.get.account.group.get.228

`GET /PasswordVault/API/Safes/{Safe}/AccountGroups` — **stub**

- Category: Account Groups
- Operation: Get Account Group
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `Safe`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/AccountGroups/Get-PASAccountGroup.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.get.accounts

`GET /PasswordVault/API/Accounts` — **partial**

- Category: Accounts
- Operation: Get Accounts
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `search`, query `searchType`, query `sort`, query `offset`, query `limit`, query `filter`, query `savedfilter`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Get%20Accounts.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.add.account

`POST /PasswordVault/API/Accounts` — **partial**

- Category: Accounts
- Operation: Add Account
- Authentication: token
- Request media type: application/json
- Request fields: `name` (string), `address` (string), `userName` (string), `platformId` (string), `safeName` (string), `secretType` (string), `secret` (string), `platformAccountProperties` (object), `secretManagement` (object), `remoteMachinesAccess` (object)
- Parameters:
- Response contracts: 201 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Add%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.ad.hoc.connect.using.psm

`POST /PasswordVault/API/Accounts/AdHocConnect` — **stub**

- Category: Accounts
- Operation: Ad-Hoc Connect Using PSM
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Ad-Hoc%20Connect%20Using%20PSM.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## accounts.get.advanced.search.properties

`GET /PasswordVault/API/Accounts/AdvancedSearchProperties` — **stub**

- Category: Accounts
- Operation: Get Advanced Search Properties
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `search`, query `searchType`, query `sort`, query `offset`, query `limit`, query `filter`, query `savedfilter`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Get%20Advanced%20Search%20Properties.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.stop.cpmtask.post.305

`POST /PasswordVault/API/Accounts/Cancel/Bulk` — **stub**

- Category: Accounts
- Operation: Stop CPMTask
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Stop-PASCPMTask.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.unlock.account.post.308

`POST /PasswordVault/API/Accounts/CheckIn/Bulk` — **stub**

- Category: Accounts
- Operation: Unlock Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Unlock-PASAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.resume.dependent.account.post.302

`POST /PasswordVault/API/Accounts/dependentAccounts/Resume/Bulk` — **stub**

- Category: Accounts
- Operation: Resume Dependent Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Resume-PASDependentAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.set.linked.account.post.304

`POST /PasswordVault/API/Accounts/Link/Bulk` — **stub**

- Category: Accounts
- Operation: Set Linked Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Set-PASLinkedAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.add.personal.admin.account.post.231

`POST /PasswordVault/api/Accounts/PersonalAdminAccount` — **stub**

- Category: Accounts
- Operation: Add Personal Admin Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Add-PASPersonalAdminAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.resume.cpmauto.management.post.300

`POST /PasswordVault/API/Accounts/Resume/Bulk` — **stub**

- Category: Accounts
- Operation: Resume CPMAuto Management
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Resume-PASCPMAutoManagement.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.clear.linked.account.post.299

`POST /PasswordVault/API/Accounts/Unlink/Bulk` — **stub**

- Category: Accounts
- Operation: Clear Linked Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Clear-PASLinkedAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.unlock.account.post.309

`POST /PasswordVault/API/Accounts/Unlock/Bulk` — **stub**

- Category: Accounts
- Operation: Unlock Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Unlock-PASAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.delete.account

`DELETE /PasswordVault/API/Accounts/{accountID}` — **partial**

- Category: Accounts
- Operation: Delete Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Delete%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.get.account.details

`GET /PasswordVault/API/Accounts/{accountID}` — **partial**

- Category: Accounts
- Operation: Get Account Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Get%20Account%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.update.account

`PATCH /PasswordVault/API/Accounts/{accountID}` — **partial**

- Category: Accounts
- Operation: Update Account
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `accountID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Update%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.set.dependent.linked.account.post.238

`POST /PasswordVault/api/Accounts/{AccountID}/account-dependents/{dependentAccountId}/link-accounts` — **stub**

- Category: Accounts
- Operation: Set Dependent Linked Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `AccountID`, path `dependentAccountId`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Set-PASDependentLinkedAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.clear.dependent.linked.account.delete.232

`DELETE /PasswordVault/api/Accounts/{AccountID}/account-dependents/{dependentAccountId}/link-accounts/{extraPasswordIndex}` — **stub**

- Category: Accounts
- Operation: Clear Dependent Linked Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `AccountID`, path `dependentAccountId`, path `extraPasswordIndex`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Clear-PASDependentLinkedAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.get.account.activity.get.296

`GET /PasswordVault/api/Accounts/{AccountID}/Activities` — **partial**

- Category: Accounts
- Operation: Get Account Activity
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `AccountID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Get-PASAccountActivity.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.stop.cpmtask.post.306

`POST /PasswordVault/API/Accounts/{Accountid}/Cancel` — **partial**

- Category: Accounts
- Operation: Stop CPMTask
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `Accountid`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Stop-PASCPMTask.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.change.credentials.immediately

`POST /PasswordVault/API/Accounts/{accountID}/Change` — **partial**

- Category: Accounts
- Operation: Change Credentials Immediately
- Authentication: token
- Request media type: application/json
- Request fields: `ChangeEntireGroup` (boolean)
- Parameters: path `accountID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Change%20Credentials%20Immediately.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.check.in.an.exclusive.account

`POST /PasswordVault/API/Accounts/{accountID}/CheckIn` — **partial**

- Category: Accounts
- Operation: Check In an Exclusive Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Check%20In%20an%20Exclusive%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.get.all.dependent.accounts.of.a.specific.account

`GET /PasswordVault/API/Accounts/{accountID}/dependentAccounts` — **stub**

- Category: Accounts
- Operation: Get All Dependent Accounts of a Specific Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`, query `search`, query `filter`, query `failed`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Dependent%20Accounts/Get%20All%20Dependent%20Accounts%20of%20a%20Specific%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.add.dependent.account

`POST /PasswordVault/API/Accounts/{accountID}/dependentAccounts` — **stub**

- Category: Accounts
- Operation: Add Dependent Account
- Authentication: token
- Request media type: application/json
- Request fields: `name` (string), `platformId` (string), `platformAccountProperties` (object), `secretManagement` (object)
- Parameters: path `accountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Dependent%20Accounts/Add%20Dependent%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.bulk.sync.dependent.account.secret

`POST /PasswordVault/API/Accounts/{accountID}/dependentAccounts/Sync/Bulk` — **stub**

- Category: Accounts
- Operation: Bulk Sync Dependent Account Secret
- Authentication: token
- Request media type: application/json
- Request fields: `bulkItems` (array)
- Parameters: path `accountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Dependent%20Accounts/Bulk%20Sync%20Dependent%20Account%20Secret.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.delete.dependent.account

`DELETE /PasswordVault/API/Accounts/{accountID}/dependentAccounts/{dependentAccountID}` — **stub**

- Category: Accounts
- Operation: Delete Dependent Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`, path `dependentAccountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Dependent%20Accounts/Delete%20Dependent%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.get.dependent.account.details

`GET /PasswordVault/API/Accounts/{accountID}/dependentAccounts/{dependentAccountID}` — **stub**

- Category: Accounts
- Operation: Get Dependent Account Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`, path `dependentAccountID`, query `extendedDetails`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Dependent%20Accounts/Get%20Dependent%20Account%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.update.dependent.account

`PUT /PasswordVault/API/Accounts/{accountID}/dependentAccounts/{dependentAccountID}` — **stub**

- Category: Accounts
- Operation: Update Dependent Account
- Authentication: token
- Request media type: application/json
- Request fields: `name` (string), `platformAccountProperties` (object), `secretManagement` (object)
- Parameters: path `accountID`, path `dependentAccountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Dependent%20Accounts/Update%20Dependent%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.stop.cpmtask.post.307

`POST /PasswordVault/API/Accounts/{Accountid}/DependentAccounts/{dependentAccountid}/Cancel` — **stub**

- Category: Accounts
- Operation: Stop CPMTask
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `Accountid`, path `dependentAccountid`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Stop-PASCPMTask.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.set.dependent.linked.account.post.239

`POST /PasswordVault/api/Accounts/{AccountID}/dependentAccounts/{dependentAccountId}/Link` — **stub**

- Category: Accounts
- Operation: Set Dependent Linked Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `AccountID`, path `dependentAccountId`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Set-PASDependentLinkedAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.resume.dependent.account

`POST /PasswordVault/API/Accounts/{accountID}/dependentAccounts/{dependentAccountID}/Resume` — **stub**

- Category: Accounts
- Operation: Resume Dependent Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`, path `dependentAccountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Dependent%20Accounts/Resume%20Dependent%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.sync.dependent.account.secret

`POST /PasswordVault/API/Accounts/{accountID}/dependentAccounts/{dependentAccountID}/Sync` — **stub**

- Category: Accounts
- Operation: Sync Dependent Account Secret
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`, path `dependentAccountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Dependent%20Accounts/Sync%20Dependent%20Account%20Secret.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.clear.dependent.linked.account.delete.233

`DELETE /PasswordVault/api/Accounts/{AccountID}/dependentAccounts/{dependentAccountId}/Unlink` — **stub**

- Category: Accounts
- Operation: Clear Dependent Linked Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `AccountID`, path `dependentAccountId`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Clear-PASDependentLinkedAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.get.just.in.time.access

`POST /PasswordVault/API/Accounts/{accountID}/grantAdministrativeAccess` — **stub**

- Category: Accounts
- Operation: Get Just in Time Access
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Get%20Just%20in%20Time%20Access.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.link.an.account

`POST /PasswordVault/API/Accounts/{accountID}/LinkAccount` — **stub**

- Category: Accounts
- Operation: Link an Account
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `accountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Linked%20Accounts/Link%20an%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## accounts.unlink.an.account

`DELETE /PasswordVault/API/Accounts/{accountID}/LinkAccount/{extraPassIndex}` — **stub**

- Category: Accounts
- Operation: Unlink an Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`, path `extraPassIndex`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Linked%20Accounts/Unlink%20an%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.get.password.value

`POST /PasswordVault/API/Accounts/{accountID}/Password/Retrieve` — **partial**

- Category: Accounts
- Operation: Get Password Value
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `accountID`
- Response contracts: 200 string; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Get%20Password%20Value.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.change.credentials.in.the.vault

`POST /PasswordVault/API/Accounts/{accountID}/Password/Update` — **partial**

- Category: Accounts
- Operation: Change Credentials in the Vault
- Authentication: token
- Request media type: application/json
- Request fields: `NewCredentials` (string)
- Parameters: path `accountID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Change%20Credentials%20in%20the%20Vault.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.connect.using.psm

`POST /PasswordVault/API/Accounts/{accountID}/PSMConnect` — **partial**

- Category: Accounts
- Operation: Connect Using PSM
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `accountID`
- Response contracts: 200 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Connect%20Using%20PSM.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.reconcile.credentials

`POST /PasswordVault/API/Accounts/{accountID}/Reconcile` — **partial**

- Category: Accounts
- Operation: Reconcile Credentials
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Reconcile%20Credentials.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.resume.cpmauto.management.post.301

`POST /PasswordVault/API/Accounts/{Accountid}/Resume` — **partial**

- Category: Accounts
- Operation: Resume CPMAuto Management
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `Accountid`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Resume-PASCPMAutoManagement.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.revoke.just.in.time.access

`POST /PasswordVault/API/Accounts/{accountID}/RevokeAdministrativeAccess` — **stub**

- Category: Accounts
- Operation: Revoke Just in Time Access
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Revoke%20Just%20in%20Time%20Access.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.generate.password

`POST /PasswordVault/API/Accounts/{accountID}/Secret/Generate` — **partial**

- Category: Accounts
- Operation: Generate Password
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 200 string; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Generate%20Password.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.retrieve.private.ssh.key.account

`POST /PasswordVault/API/Accounts/{accountID}/Secret/Retrieve` — **partial**

- Category: Accounts
- Operation: Retrieve Private SSH Key Account
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `accountID`
- Response contracts: 200 string; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Retrieve%20Private%20SSH%20Key%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.get.secret.versions

`GET /PasswordVault/API/Accounts/{accountID}/Secret/Versions` — **partial**

- Category: Accounts
- Operation: Get Secret Versions
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`, query `showTemporary`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Get%20Secret%20Versions.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.change.credentials.and.set.next.password

`POST /PasswordVault/API/Accounts/{accountID}/SetNextPassword` — **partial**

- Category: Accounts
- Operation: Change Credentials and Set Next Password
- Authentication: token
- Request media type: application/json
- Request fields: `ChangeImmediately` (boolean), `NewCredentials` (string)
- Parameters: path `accountID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Change%20Credentials%20and%20Set%20Next%20Password.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.unlock.account

`POST /PasswordVault/API/Accounts/{accountID}/Unlock` — **partial**

- Category: Accounts
- Operation: Unlock Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Unlock%20Account.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.verify.credentials

`POST /PasswordVault/API/Accounts/{accountID}/Verify` — **partial**

- Category: Accounts
- Operation: Verify Credentials
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Account%20Actions/Verify%20Credentials.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## accounts.get.all.bulk.account.uploads.for.user

`GET /PasswordVault/API/bulkactions/accounts` — **stub**

- Category: Accounts
- Operation: Get All Bulk Account Uploads for User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `filter`, query `limit`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Bulk%20Upload%20of%20Accounts/Get%20All%20Bulk%20Account%20Uploads%20for%20User.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.create.bulk.upload.of.accounts

`POST /PasswordVault/API/bulkactions/accounts` — **stub**

- Category: Accounts
- Operation: Create Bulk Upload of Accounts
- Authentication: token
- Request media type: application/json
- Request fields: `source` (string), `accountsList` (array)
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Bulk%20Upload%20of%20Accounts/Create%20Bulk%20Upload%20of%20Accounts.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.get.bulk.account.upload.result

`GET /PasswordVault/API/bulkactions/accounts/{ID}` — **stub**

- Category: Accounts
- Operation: Get Bulk Account Upload Result
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Bulk%20Upload%20of%20Accounts/Get%20Bulk%20Account%20Upload%20Result.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.get.all.dependent.accounts.in.the.system

`GET /PasswordVault/API/dependentAccounts` — **stub**

- Category: Accounts
- Operation: Get All Dependent Accounts in the System
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `search`, query `offset`, query `limit`, query `filter`, query `IncludeDeleted`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Dependent%20Accounts/Get%20All%20Dependent%20Accounts%20in%20the%20System.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.delete.discovered.accounts

`DELETE /PasswordVault/API/DiscoveredAccounts` — **stub**

- Category: Accounts
- Operation: Delete Discovered Accounts
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Discovered%20Accounts/Delete%20Discovered%20Accounts.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.get.discovered.accounts

`GET /PasswordVault/API/DiscoveredAccounts` — **stub**

- Category: Accounts
- Operation: Get Discovered Accounts
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `filter`, query `search`, query `searchType`, query `offset`, query `limit`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Discovered%20Accounts/Get%20Discovered%20Accounts.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.add.discovered.accounts

`POST /PasswordVault/API/DiscoveredAccounts` — **stub**

- Category: Accounts
- Operation: Add Discovered Accounts
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Discovered%20Accounts/Add%20Discovered%20Accounts.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## accounts.clear.discovered.account.post.297

`POST /PasswordVault/api/DiscoveredAccounts/Delete/Bulk` — **stub**

- Category: Accounts
- Operation: Clear Discovered Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Clear-PASDiscoveredAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.get.discovered.account.details

`GET /PasswordVault/API/DiscoveredAccounts/{accountID}` — **stub**

- Category: Accounts
- Operation: Get Discovered Account Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Discovered%20Accounts/Get%20Discovered%20Account%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.clear.discovered.account.delete.298

`DELETE /PasswordVault/API/DiscoveredAccounts/{accountID}` — **stub**

- Category: Accounts
- Operation: Clear Discovered Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Clear-PASDiscoveredAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.publish.discovered.account.post.236

`POST /PasswordVault/api/DiscoveredAccounts/{id}/Onboard` — **stub**

- Category: Accounts
- Operation: Publish Discovered Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `id`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Publish-PASDiscoveredAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.get.linked.account.get.235

`GET /PasswordVault/api/ExtendedAccounts/{id}/LinkedAccounts` — **stub**

- Category: Accounts
- Operation: Get Linked Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `id`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Get-PASLinkedAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.get.account.detail.get.234

`GET /PasswordVault/api/ExtendedAccounts/{id}/overview` — **stub**

- Category: Accounts
- Operation: Get Account Detail
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `id`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Get-PASAccountDetail.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.add.account.post.229

`POST /PasswordVault/WebServices/PIMServices.svc/Account` — **stub**

- Category: Accounts
- Operation: Add Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Add-PASAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.get.account.get.294

`GET /PasswordVault/WebServices/PIMServices.svc/Accounts` — **stub**

- Category: Accounts
- Operation: Get Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Get-PASAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.remove.account.delete.237

`DELETE /PasswordVault/WebServices/PIMServices.svc/Accounts/{AccountID}` — **stub**

- Category: Accounts
- Operation: Remove Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `AccountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Remove-PASAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.set.account.put.303

`PUT /PasswordVault/WebServices/PIMServices.svc/Accounts/{AccountID}` — **stub**

- Category: Accounts
- Operation: Set Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `AccountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Set-PASAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.get.account.activity

`GET /PasswordVault/WebServices/PIMServices.svc/Accounts/{accountID}/Activities` — **stub**

- Category: Accounts
- Operation: Get Account Activity
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Accounts/Get%20Account%20Activity.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## accounts.get.account.get.295

`GET /PasswordVault/WebServices/PIMServices.svc/Accounts/{AccountID}` — **stub**

- Category: Accounts
- Operation: Get Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `AccountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Get-PASAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## accounts.add.pending.account.post.230

`POST /PasswordVault/WebServices/PIMServices.svc/PendingAccounts` — **stub**

- Category: Accounts
- Operation: Add Pending Account
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Accounts/Add-PASPendingAccount.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## applications.get.applications

`GET /PasswordVault/WebServices/PIMServices.svc/Applications` — **stub**

- Category: Applications
- Operation: Get Applications
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `Location`, query `IncludeSublocations`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Applications/Get%20Applications.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## applications.add.application

`POST /PasswordVault/WebServices/PIMServices.svc/Applications` — **stub**

- Category: Applications
- Operation: Add Application
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Applications/Add%20Application.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## applications.delete.application

`DELETE /PasswordVault/WebServices/PIMServices.svc/Applications/{applicationID}` — **stub**

- Category: Applications
- Operation: Delete Application
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `applicationID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Applications/Delete%20Application.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## applications.get.application.details

`GET /PasswordVault/WebServices/PIMServices.svc/Applications/{applicationID}` — **stub**

- Category: Applications
- Operation: Get Application Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `applicationID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Applications/Get%20Application%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## applications.get.application.authentication.methods

`GET /PasswordVault/WebServices/PIMServices.svc/Applications/{applicationID}/Authentications` — **stub**

- Category: Applications
- Operation: Get Application Authentication Methods
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `applicationID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Applications/Get%20Application%20Authentication%20Methods.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## applications.add.application.authentication.method

`POST /PasswordVault/WebServices/PIMServices.svc/Applications/{applicationID}/Authentications` — **stub**

- Category: Applications
- Operation: Add Application Authentication Method
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `applicationID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Applications/Add%20Application%20Authentication%20Method.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## applications.delete.application.authentication.method

`DELETE /PasswordVault/WebServices/PIMServices.svc/Applications/{applicationID}/Authentications/{authID}` — **stub**

- Category: Applications
- Operation: Delete Application Authentication Method
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `applicationID`, path `authID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Applications/Delete%20Application%20Authentication%20Method.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.reset.theme.delete.249

`DELETE /PasswordVault/API/ActiveThemes` — **stub**

- Category: Configuration
- Operation: Reset Theme
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Customization/Reset-PASTheme.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.get.theme.get.314

`GET /PasswordVault/API/ActiveThemes` — **stub**

- Category: Configuration
- Operation: Get Theme
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Customization/Get-PASTheme.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.enable.theme.post.244

`POST /PasswordVault/API/ActiveThemes` — **stub**

- Category: Configuration
- Operation: Enable Theme
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Customization/Enable-PASTheme.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.get.allowed.referrer

`GET /PasswordVault/api/Configuration/AccessRestriction/AllowedReferrers` — **stub**

- Category: Configuration
- Operation: Get Allowed Referrer
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/General/Get%20Allowed%20Referrer.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.add.allowed.referrer

`POST /PasswordVault/api/Configuration/AccessRestriction/AllowedReferrers` — **stub**

- Category: Configuration
- Operation: Add Allowed Referrer
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/General/Add%20Allowed%20Referrer.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## configuration.get.auth.methods

`GET /PasswordVault/api/Configuration/AuthenticationMethods` — **stub**

- Category: Configuration
- Operation: Get Auth Methods
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/Get%20Auth%20Methods.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.add.auth.method

`POST /PasswordVault/api/Configuration/AuthenticationMethods` — **stub**

- Category: Configuration
- Operation: Add Auth Method
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/Add%20Auth%20Method.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## configuration.delete.auth.method

`DELETE /PasswordVault/api/Configuration/AuthenticationMethods/{authID}` — **stub**

- Category: Configuration
- Operation: Delete Auth Method
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `authID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/Delete%20Auth%20Method.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.get.specific.auth.method

`GET /PasswordVault/api/Configuration/AuthenticationMethods/{authID}` — **stub**

- Category: Configuration
- Operation: Get Specific Auth Method
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `authID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/Get%20Specific%20Auth%20Method.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.update.auth.method

`PUT /PasswordVault/api/Configuration/AuthenticationMethods/{authID}` — **stub**

- Category: Configuration
- Operation: Update Auth Method
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `authID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/Update%20Auth%20Method.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## configuration.list.oauth.providers

`GET /PasswordVault/api/Configuration/OAuth/Providers` — **stub**

- Category: Configuration
- Operation: List OAuth providers
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Authentication/Get-PASOAuthProvider.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; PVWA 15.2 reference
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.add.oauth.provider

`POST /PasswordVault/api/Configuration/OAuth/Providers` — **stub**

- Category: Configuration
- Operation: Add OAuth provider
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Authentication/Add-PASOAuthProvider.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; PVWA 15.2 reference
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.delete.oauth.provider

`DELETE /PasswordVault/api/Configuration/OAuth/Providers/{id}` — **stub**

- Category: Configuration
- Operation: Delete OAuth provider
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `id`
- Response contracts: 501 object; 401 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Authentication/Remove-PASOAuthProvider.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; PVWA 15.2 reference
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.update.oauth.provider

`PUT /PasswordVault/api/Configuration/OAuth/Providers/{id}` — **stub**

- Category: Configuration
- Operation: Update OAuth provider
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `id`
- Response contracts: 501 object; 401 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Authentication/Set-PASOAuthProvider.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; PVWA 15.2 reference
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.get.all.openid.connect.identity.providers

`GET /PasswordVault/api/Configuration/OIDC/Providers` — **stub**

- Category: Configuration
- Operation: Get All OpenID Connect Identity Providers
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/OIDC%20Identity%20Provider/Get%20All%20OpenID%20Connect%20Identity%20Providers.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.add.openid.connect.identity.provider

`POST /PasswordVault/api/Configuration/OIDC/Providers` — **stub**

- Category: Configuration
- Operation: Add OpenID Connect Identity Provider
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/OIDC%20Identity%20Provider/Add%20OpenID%20Connect%20Identity%20Provider.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## configuration.delete.openid.connect.identity.provider

`DELETE /PasswordVault/api/Configuration/OIDC/Providers/{authID}` — **stub**

- Category: Configuration
- Operation: Delete OpenID Connect Identity Provider
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `authID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/OIDC%20Identity%20Provider/Delete%20OpenID%20Connect%20Identity%20Provider.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.get.specific.openid.connect.identity.provider

`GET /PasswordVault/api/Configuration/OIDC/Providers/{authID}` — **stub**

- Category: Configuration
- Operation: Get Specific OpenID Connect Identity Provider
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `authID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/OIDC%20Identity%20Provider/Get%20Specific%20OpenID%20Connect%20Identity%20Provider.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.update.openid.connect.identity.provider

`PUT /PasswordVault/api/Configuration/OIDC/Providers/{authID}` — **stub**

- Category: Configuration
- Operation: Update OpenID Connect Identity Provider
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `authID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/OIDC%20Identity%20Provider/Update%20OpenID%20Connect%20Identity%20Provider.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## configuration.remove.fido2.device

`DELETE /PasswordVault/API/fido2/keys/{fidoKeyID}` — **stub**

- Category: Configuration
- Operation: Remove FIDO2 Device
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `fidoKeyID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/FIDO2%20Device%20Management/Remove%20FIDO2%20Device.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.register.fido2.device

`POST /PasswordVault/API/fido2/registration` — **stub**

- Category: Configuration
- Operation: Register FIDO2 Device
- Authentication: token
- Request media type: application/json
- Request fields: `Attestation` (object), `UserId` (integer)
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/FIDO2%20Device%20Management/Register%20FIDO2%20Device.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.start.fido2.registration

`POST /PasswordVault/API/fido2/registrationOptions` — **stub**

- Category: Configuration
- Operation: Start FIDO2 Registration
- Authentication: token
- Request media type: application/json
- Request fields: `UserId` (integer)
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/FIDO2%20Device%20Management/Start%20FIDO2%20Registration.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.remove.own.fido2.device

`DELETE /PasswordVault/API/fido2/selfKeys/{fidoKeyID}` — **stub**

- Category: Configuration
- Operation: Remove Own FIDO2 Device
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `fidoKeyID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/FIDO2%20Device%20Management/Remove%20Own%20FIDO2%20Device.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.register.own.fido2.device

`POST /PasswordVault/API/fido2/selfRegistration` — **stub**

- Category: Configuration
- Operation: Register Own FIDO2 Device
- Authentication: token
- Request media type: application/json
- Request fields: `Attestation` (object), `UserId` (integer)
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/FIDO2%20Device%20Management/Register%20Own%20FIDO2%20Device.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## configuration.export.theme.image.get.245

`GET /PasswordVault/API/Images/{imageName}` — **stub**

- Category: Configuration
- Operation: Export Theme Image
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `imageName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Customization/Export-PASThemeImage.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.set.platform.patch.275

`PATCH /PasswordVault/API/platforms/targets/{id}/settings` — **stub**

- Category: Configuration
- Operation: Set Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `id`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Policies/Set-PASPlatform.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.get.master.policy.get.273

`GET /PasswordVault/API/Policies/{PolicyId}` — **stub**

- Category: Configuration
- Operation: Get Master Policy
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `PolicyId`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Policies/Get-PASMasterPolicy.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.set.master.policy.put.274

`PUT /PasswordVault/API/Policies/{PolicyId}` — **stub**

- Category: Configuration
- Operation: Set Master Policy
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `PolicyId`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Policies/Set-PASMasterPolicy.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.get.session.timeout.get.243

`GET /PasswordVault/api/Settings/Timeout` — **stub**

- Category: Configuration
- Operation: Get Session Timeout
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Authentication/Get-PASSessionTimeout.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.get.theme.get.312

`GET /PasswordVault/API/Themes` — **stub**

- Category: Configuration
- Operation: Get Theme
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Customization/Get-PASTheme.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.new.theme.post.246

`POST /PasswordVault/API/Themes` — **stub**

- Category: Configuration
- Operation: New Theme
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Customization/New-PASTheme.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.remove.theme.delete.248

`DELETE /PasswordVault/API/Themes/{ThemeName}` — **stub**

- Category: Configuration
- Operation: Remove Theme
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ThemeName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Customization/Remove-PASTheme.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.get.theme.get.313

`GET /PasswordVault/API/Themes/{ThemeName}` — **stub**

- Category: Configuration
- Operation: Get Theme
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ThemeName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Customization/Get-PASTheme.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.set.theme.put.250

`PUT /PasswordVault/API/Themes/{ThemeName}` — **stub**

- Category: Configuration
- Operation: Set Theme
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ThemeName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Customization/Set-PASTheme.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.publish.theme.post.247

`POST /PasswordVault/API/Themes/{ThemeName}/draft` — **stub**

- Category: Configuration
- Operation: Publish Theme
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ThemeName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Customization/Publish-PASTheme.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## configuration.add.auth.methods.to.users

`PATCH /PasswordVault/API/Users/AddAllowedAuthenticationMethods/Bulk` — **stub**

- Category: Configuration
- Operation: Add Auth Methods to Users
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/Add%20Auth%20Methods%20to%20Users.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## configuration.delete.auth.methods.to.users

`PATCH /PasswordVault/API/Users/RemoveAllowedAuthenticationMethods/Bulk` — **stub**

- Category: Configuration
- Operation: Delete Auth Methods to Users
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Authentication/Auth%20Methods%20Config/Delete%20Auth%20Methods%20to%20Users.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## discovery.get.discovery.scan.get.310

`GET /PasswordVault/api/DiscoveryScans` — **stub**

- Category: Discovery
- Operation: Get Discovery Scan
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/AccountsFeed/Get-PASDiscoveryScan.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## discovery.add.discovery.scan.post.240

`POST /PasswordVault/api/DiscoveryScans` — **stub**

- Category: Discovery
- Operation: Add Discovery Scan
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/AccountsFeed/Add-PASDiscoveryScan.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## discovery.remove.discovery.scan.delete.241

`DELETE /PasswordVault/api/DiscoveryScans/{taskId}` — **stub**

- Category: Discovery
- Operation: Remove Discovery Scan
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `taskId`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/AccountsFeed/Remove-PASDiscoveryScan.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## discovery.get.discovery.scan.get.311

`GET /PasswordVault/api/DiscoveryScans/{taskId}` — **stub**

- Category: Discovery
- Operation: Get Discovery Scan
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `taskId`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/AccountsFeed/Get-PASDiscoveryScan.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## discovery.stop.discovery.scan.post.242

`POST /PasswordVault/api/DiscoveryScans/{taskId}/stop` — **stub**

- Category: Discovery
- Operation: Stop Discovery Scan
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `taskId`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/AccountsFeed/Stop-PASDiscoveryScan.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## ldap.integration.get.directories

`GET /PasswordVault/API/Configuration/LDAP/Directories` — **stub**

- Category: LDAP Integration
- Operation: Get Directories
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/LDAP%20Integration/LDAP%20Directories/Get%20Directories.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## ldap.integration.create.directory

`POST /PasswordVault/API/Configuration/LDAP/Directories` — **stub**

- Category: LDAP Integration
- Operation: Create Directory
- Authentication: token
- Request media type: application/json
- Request fields: `DirectoryType` (string), `DCList ` (array), `BindUsername` (string), `BindPassword` (string), `Port` (integer), `DomainName` (string), `DomainBaseContext` (string)
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/LDAP%20Integration/LDAP%20Directories/Create%20Directory.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## ldap.integration.reorder.directory.mappings

`POST /PasswordVault/API/Configuration/LDAP/Directories/{directoryName}/Mappings/Reorder` — **stub**

- Category: LDAP Integration
- Operation: Reorder Directory Mappings
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `directoryName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/LDAP%20Integration/LDAP%20Mappings/Reorder%20Directory%20Mappings.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## ldap.integration.delete.directory.mapping

`DELETE /PasswordVault/API/Configuration/LDAP/Directories/{directoryName}/Mappings/{LDAPID}` — **stub**

- Category: LDAP Integration
- Operation: Delete Directory Mapping
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `directoryName`, path `LDAPID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/LDAP%20Integration/LDAP%20Mappings/Delete%20Directory%20Mapping.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## ldap.integration.delete.directory

`DELETE /PasswordVault/API/Configuration/LDAP/Directories/{LDAPID}` — **stub**

- Category: LDAP Integration
- Operation: Delete Directory
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `LDAPID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/LDAP%20Integration/LDAP%20Directories/Delete%20Directory.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## ldap.integration.get.directory.details

`GET /PasswordVault/API/Configuration/LDAP/Directories/{LDAPID}` — **stub**

- Category: LDAP Integration
- Operation: Get Directory Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `LDAPID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/LDAP%20Integration/LDAP%20Directories/Get%20Directory%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## ldap.integration.get.directory.mapping.list

`GET /PasswordVault/API/Configuration/LDAP/Directories/{LDAPID}/Mappings` — **stub**

- Category: LDAP Integration
- Operation: Get Directory Mapping List
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `LDAPID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/LDAP%20Integration/LDAP%20Mappings/Get%20Directory%20Mapping%20List.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## ldap.integration.create.directory.mapping

`POST /PasswordVault/API/Configuration/LDAP/Directories/{LDAPID}/Mappings` — **stub**

- Category: LDAP Integration
- Operation: Create Directory Mapping
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `LDAPID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/LDAP%20Integration/LDAP%20Mappings/Create%20Directory%20Mapping.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## ldap.integration.get.mapping.details

`GET /PasswordVault/API/Configuration/LDAP/Directories/{directoryName}/Mappings/{LDAPID}` — **stub**

- Category: LDAP Integration
- Operation: Get Mapping Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `directoryName`, path `LDAPID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/LDAP%20Integration/LDAP%20Mappings/Get%20Mapping%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## ldap.integration.edit.directory.mapping

`PUT /PasswordVault/API/Configuration/LDAP/Directories/{directoryName}/Mappings/{LDAPID}` — **stub**

- Category: LDAP Integration
- Operation: Edit Directory Mapping
- Authentication: token
- Request media type: application/json
- Request fields: `LDAPBranch` (string), `VaultGroups` (array), `MappingAuthorizations` (array), `Location` (string), `AuthenticationMethod` (array), `UserType` (string), `DisableUser` (boolean), `UserActivityLogPeriod` (integer), `UserExpiration` (integer), `LogonFromHour` (integer), `LogonToHour` (integer), `MappingID` (integer), `DirectoryMappingOrder` (integer), `MappingName` (string), `LDAPQuery` (string), `DomainGroups` (array)
- Parameters: path `directoryName`, path `LDAPID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/LDAP%20Integration/LDAP%20Mappings/Edit%20Directory%20Mapping.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## ldap.integration.get.directory.id.get.257

`GET /PasswordVault/api/settings/AddSafeMember` — **stub**

- Category: LDAP Integration
- Operation: Get Directory ID
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/LDAPDirectories/Get-PASDirectoryID.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## onboarding.rules.get.onboarding.rule

`GET /PasswordVault/API/AutomaticOnboardingRules` — **stub**

- Category: Onboarding Rules
- Operation: Get Onboarding Rule
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `name`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Onboarding%20Rules/Get%20Onboarding%20Rule.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## onboarding.rules.add.onboarding.rule

`POST /PasswordVault/API/AutomaticOnboardingRules` — **stub**

- Category: Onboarding Rules
- Operation: Add Onboarding Rule
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Onboarding%20Rules/Add%20Onboarding%20Rule.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## onboarding.rules.delete.onboarding.rule

`DELETE /PasswordVault/API/AutomaticOnboardingRules/{ruleID}` — **stub**

- Category: Onboarding Rules
- Operation: Delete Onboarding Rule
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ruleID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Onboarding%20Rules/Delete%20Onboarding%20Rule.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## onboarding.rules.update.onboarding.rule

`PUT /PasswordVault/API/AutomaticOnboardingRules/{ruleID}` — **stub**

- Category: Onboarding Rules
- Operation: Update Onboarding Rule
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `ruleID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Onboarding%20Rules/Update%20Onboarding%20Rule.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## opm.commands.get.account.acl.get.226

`GET /PasswordVault/WebServices/PIMServices.svc/Account/{AccountAddress}|{AccountUserName}|{AccountPolicyId}/PrivilegedCommands` — **stub**

- Category: OPM Commands
- Operation: Get Account ACL
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `AccountAddress`, path `AccountUserName`, path `AccountPolicyId`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/AccountACL/Get-PASAccountACL.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## opm.commands.add.account.acl.put.225

`PUT /PasswordVault/WebServices/PIMServices.svc/Account/{AccountAddress}|{AccountUserName}|{AccountPolicyId}/PrivilegedCommands` — **stub**

- Category: OPM Commands
- Operation: Add Account ACL
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `AccountAddress`, path `AccountUserName`, path `AccountPolicyId`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/AccountACL/Add-PASAccountACL.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## opm.commands.remove.account.acl.delete.227

`DELETE /PasswordVault/WebServices/PIMServices.svc/Account/{AccountAddress}|{AccountUserName}|{AccountPolicyId}/PrivilegedCommands/{Id}` — **stub**

- Category: OPM Commands
- Operation: Remove Account ACL
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `AccountAddress`, path `AccountUserName`, path `AccountPolicyId`, path `Id`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/AccountACL/Remove-PASAccountACL.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## opm.commands.get.opm.account.commands

`GET /PasswordVault/WebServices/PIMServices.svc/Account/{accountDetails}/PrivilegedCommands` — **stub**

- Category: OPM Commands
- Operation: Get OPM Account Commands
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountDetails`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/OPM%20Commands/Accounts/Get%20OPM%20Account%20Commands.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## opm.commands.add.opm.account.commands

`PUT /PasswordVault/WebServices/PIMServices.svc/Account/{accountDetails}/PrivilegedCommands` — **stub**

- Category: OPM Commands
- Operation: Add OPM Account Commands
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `accountDetails`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/OPM%20Commands/Accounts/Add%20OPM%20Account%20Commands.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## opm.commands.delete.opm.account.commands

`DELETE /PasswordVault/WebServices/PIMServices.svc/Account/{accountDetails}/PrivilegedCommands/{id}` — **stub**

- Category: OPM Commands
- Operation: Delete OPM Account Commands
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `accountDetails`, path `id`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/OPM%20Commands/Accounts/Delete%20OPM%20Account%20Commands.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## opm.commands.get.opm.rules

`GET /PasswordVault/WebServices/PIMServices.svc/Policy/{policyID}/PrivilegedCommands` — **stub**

- Category: OPM Commands
- Operation: Get OPM Rules
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `policyID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/OPM%20Commands/Policy/Get%20OPM%20Rules.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## opm.commands.add.opm.policy

`PUT /PasswordVault/WebServices/PIMServices.svc/Policy/{policyID}/PrivilegedCommands` — **stub**

- Category: OPM Commands
- Operation: Add OPM Policy
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `policyID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/OPM%20Commands/Policy/Add%20OPM%20Policy.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## opm.commands.delete.opm.policy

`DELETE /PasswordVault/WebServices/PIMServices.svc/Policy/{policyID}/PrivilegedCommands/{ruleID}` — **stub**

- Category: OPM Commands
- Operation: Delete OPM Policy
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `policyID`, path `ruleID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/OPM%20Commands/Policy/Delete%20OPM%20Policy.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## platforms.get.platforms

`GET /PasswordVault/API/Platforms` — **partial**

- Category: Platforms
- Operation: Get Platforms
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `Active`, query `PlatformType`, query `PlatformName`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Get%20Platforms.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.get.dependent.platforms

`GET /PasswordVault/API/platforms/dependents` — **partial**

- Category: Platforms
- Operation: Get Dependent Platforms
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `search`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Dependent%20Platforms/Get%20Dependent%20Platforms.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.export.platform.post.267

`POST /PasswordVault/api/Platforms/Dependents/{DependentID}/Export` — **stub**

- Category: Platforms
- Operation: Export Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `DependentID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Platforms/Export-PASPlatform.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## platforms.delete.dependent.platform

`DELETE /PasswordVault/API/platforms/dependents/{platformID}` — **partial**

- Category: Platforms
- Operation: Delete Dependent Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Dependent%20Platforms/Delete%20Dependent%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.duplicate.dependent.platforms

`POST /PasswordVault/API/platforms/dependents/{platformID}/duplicate` — **partial**

- Category: Platforms
- Operation: Duplicate Dependent Platforms
- Authentication: token
- Request media type: application/json
- Request fields: `Name` (string), `Description` (string)
- Parameters: path `platformID`
- Response contracts: 201 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Dependent%20Platforms/Duplicate%20Dependent%20Platforms.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.get.group.platforms

`GET /PasswordVault/API/platforms/groups` — **partial**

- Category: Platforms
- Operation: Get Group Platforms
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `search`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Group%20Platforms/Get%20Group%20Platforms.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.delete.group.platform

`DELETE /PasswordVault/API/platforms/groups/{platformID}` — **partial**

- Category: Platforms
- Operation: Delete Group Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Group%20Platforms/Delete%20Group%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.activate.group.platform

`POST /PasswordVault/API/platforms/groups/{platformID}/activate` — **partial**

- Category: Platforms
- Operation: Activate Group Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Group%20Platforms/Activate%20Group%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.deactivate.group.platform

`POST /PasswordVault/API/platforms/groups/{platformID}/deactivate` — **partial**

- Category: Platforms
- Operation: Deactivate Group Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Group%20Platforms/Deactivate%20Group%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.duplicate.group.platforms

`POST /PasswordVault/API/platforms/groups/{platformID}/duplicate` — **partial**

- Category: Platforms
- Operation: Duplicate Group Platforms
- Authentication: token
- Request media type: application/json
- Request fields: `Name` (string), `Description` (string)
- Parameters: path `platformID`
- Response contracts: 201 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Group%20Platforms/Duplicate%20Group%20Platforms.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.import.stored.platform.alongside.existing.platform

`PATCH /PasswordVault/API/Platforms/Import` — **stub**

- Category: Platforms
- Operation: Import Stored Platform Alongside Existing Platform
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Stored%20Platforms/Import%20Stored%20Platform%20Alongside%20Existing%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## platforms.import.platform

`POST /PasswordVault/API/Platforms/Import` — **stub**

- Category: Platforms
- Operation: Import Platform
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Import%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## platforms.get.rotational.group.platforms

`GET /PasswordVault/API/platforms/rotationalGroups` — **partial**

- Category: Platforms
- Operation: Get Rotational Group Platforms
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `search`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Rotational%20Group%20Platforms/Get%20Rotational%20Group%20Platforms.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.delete.rotational.group.platform

`DELETE /PasswordVault/API/platforms/rotationalGroups/{platformID}` — **partial**

- Category: Platforms
- Operation: Delete Rotational Group Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Rotational%20Group%20Platforms/Delete%20Rotational%20Group%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.activate.rotational.group.platform

`POST /PasswordVault/API/platforms/rotationalGroups/{platformID}/activate` — **partial**

- Category: Platforms
- Operation: Activate Rotational Group Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Rotational%20Group%20Platforms/Activate%20Rotational%20Group%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.deactivate.rotational.group.platform

`POST /PasswordVault/API/platforms/rotationalGroups/{platformID}/deactivate` — **partial**

- Category: Platforms
- Operation: Deactivate Rotational Group Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Rotational%20Group%20Platforms/Deactivate%20Rotational%20Group%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.duplicate.rotational.group.platforms

`POST /PasswordVault/API/platforms/rotationalGroups/{platformID}/duplicate` — **partial**

- Category: Platforms
- Operation: Duplicate Rotational Group Platforms
- Authentication: token
- Request media type: application/json
- Request fields: `Name` (string), `Description` (string)
- Parameters: path `platformID`
- Response contracts: 201 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Rotational%20Group%20Platforms/Duplicate%20Rotational%20Group%20Platforms.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.export.platform.post.266

`POST /PasswordVault/api/Platforms/RotationalGroups/{RotationalGroupID}/Export` — **stub**

- Category: Platforms
- Operation: Export Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `RotationalGroupID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Platforms/Export-PASPlatform.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## platforms.delete.stored.platform

`DELETE /PasswordVault/API/Platforms/Storage` — **stub**

- Category: Platforms
- Operation: Delete Stored Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Stored%20Platforms/Delete%20Stored%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## platforms.get.stored.platform.details

`GET /PasswordVault/API/Platforms/Storage` — **stub**

- Category: Platforms
- Operation: Get Stored Platform Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Stored%20Platforms/Get%20Stored%20Platform%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## platforms.get.target.platforms

`GET /PasswordVault/API/platforms/targets` — **partial**

- Category: Platforms
- Operation: Get Target Platforms
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `Filter`, query `search`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Target%20Platforms/Get%20Target%20Platforms.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.get.platform.summary.get.270

`GET /PasswordVault/API/Platforms/Targets/SystemTypes` — **partial**

- Category: Platforms
- Operation: Get Platform Summary
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Platforms/Get-PASPlatformSummary.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.rename.platform.put.272

`PUT /PasswordVault/API/Platforms/targets/{ID}` — **partial**

- Category: Platforms
- Operation: Rename Platform
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters: path `ID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Platforms/Rename-PASPlatform.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.get.platform.get.269

`GET /PasswordVault/API/platforms/targets/{id}/settings` — **partial**

- Category: Platforms
- Operation: Get Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `id`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Platforms/Get-PASPlatform.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.delete.target.platform

`DELETE /PasswordVault/API/Platforms/targets/{ID}` — **partial**

- Category: Platforms
- Operation: Delete Target Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Target%20Platforms/Delete%20Target%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.activate.target.platform

`POST /PasswordVault/API/platforms/targets/{platformID}/activate` — **partial**

- Category: Platforms
- Operation: Activate Target Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Target%20Platforms/Activate%20Target%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.deactivate.target.platform

`POST /PasswordVault/API/platforms/targets/{platformID}/deactivate` — **partial**

- Category: Platforms
- Operation: Deactivate Target Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Target%20Platforms/Deactivate%20Target%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.duplicate.target.platforms

`POST /PasswordVault/API/platforms/targets/{platformID}/duplicate` — **partial**

- Category: Platforms
- Operation: Duplicate Target Platforms
- Authentication: token
- Request media type: application/json
- Request fields: `Name` (string), `Description` (string)
- Parameters: path `platformID`
- Response contracts: 201 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Target%20Platforms/Duplicate%20Target%20Platforms.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.export.platform

`POST /PasswordVault/API/Platforms/{platformID}/Export` — **stub**

- Category: Platforms
- Operation: Export Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Export%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## platforms.new.platform.secret.post.271

`POST /PasswordVault/API/Platforms/{Platformid}/GenerateSecret` — **partial**

- Category: Platforms
- Operation: New Platform Secret
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `Platformid`
- Response contracts: 200 string; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Platforms/New-PASPlatformSecret.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## platforms.update.platform.with.stored.platform

`POST /PasswordVault/API/Platforms/{platformID}/Update` — **stub**

- Category: Platforms
- Operation: Update Platform with Stored Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Stored%20Platforms/Update%20Platform%20with%20Stored%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## platforms.get.platform.details

`GET /PasswordVault/API/Platforms/{platformName}` — **partial**

- Category: Platforms
- Operation: Get Platform Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformName`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Platforms/Get%20Platform%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## psm.import.connection.component

`POST /PasswordVault/API/ConnectionComponents/Import` — **stub**

- Category: PSM
- Operation: Import Connection Component
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Session%20Management/Import%20Connection%20Component.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## psm.get.session.management.policy.of.platform

`GET /PasswordVault/API/Platforms/Targets/{platformId}/PrivilegedSessionManagement` — **partial**

- Category: PSM
- Operation: Get Session Management Policy of Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformId`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Session%20Management/Get%20Session%20Management%20Policy%20of%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## psm.update.session.management.policy.of.platform

`PUT /PasswordVault/API/Platforms/Targets/{platformId}/PrivilegedSessionManagement` — **partial**

- Category: PSM
- Operation: Update Session Management Policy of Platform
- Authentication: token
- Request media type: application/json
- Request fields: `PSMServerId` (string), `PSMServerName` (string), `PSMConnectors` (array)
- Parameters: path `platformId`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Session%20Management/Update%20Session%20Management%20Policy%20of%20Platform.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## psm.get.all.connection.components

`GET /PasswordVault/API/PSM/Connectors` — **partial**

- Category: PSM
- Operation: Get All Connection Components
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Session%20Management/Get%20All%20Connection%20Components.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## psm.get.all.psm.servers

`GET /PasswordVault/API/PSM/Servers` — **partial**

- Category: PSM
- Operation: Get All PSM Servers
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Session%20Management/Get%20All%20PSM%20Servers.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## pta.administration.get.pta.administration

`GET /PasswordVault/API/pta/API/administration` — **stub**

- Category: PTA Administration
- Operation: Get PTA Administration
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/PTA%20Administration/Get%20PTA%20Administration.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## pta.administration.get.global.catalog.connectivity.details

`GET /PasswordVault/API/pta/API/Administration/GCConnectivity` — **stub**

- Category: PTA Administration
- Operation: Get Global Catalog Connectivity Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/PTA%20Administration/Get%20Global%20Catalog%20Connectivity%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## pta.administration.add.global.catalog.connectivity.details

`POST /PasswordVault/API/pta/API/Administration/GCConnectivity` — **stub**

- Category: PTA Administration
- Operation: Add Global Catalog Connectivity Details
- Authentication: token
- Request media type: application/json
- Request fields: `ldap_certificate` (string), `properties` (object)
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/PTA%20Administration/Add%20Global%20Catalog%20Connectivity%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## pta.administration.set.ptasmtp.put.265

`PUT /PasswordVault/api/pta/API/Administration/properties` — **stub**

- Category: PTA Administration
- Operation: Set PTASMTP
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/PTAAdministration/Set-PASPTASMTP.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## pta.administration.add.ptaexcluded.target.patch.260

`PATCH /PasswordVault/api/pta/API/Administration/properties/CidrExclusionList` — **stub**

- Category: PTA Administration
- Operation: Add PTAExcluded Target
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/PTAAdministration/Add-PASPTAExcludedTarget.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## pta.administration.add.ptaincluded.target.patch.261

`PATCH /PasswordVault/api/pta/API/Administration/properties/CidrInclusionList` — **stub**

- Category: PTA Administration
- Operation: Add PTAIncluded Target
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/PTAAdministration/Add-PASPTAIncludedTarget.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## pta.administration.remove.ptaincluded.target.delete.263

`DELETE /PasswordVault/api/pta/API/Administration/properties/CidrInclusionList/{ID}` — **stub**

- Category: PTA Administration
- Operation: Remove PTAIncluded Target
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/PTAAdministration/Remove-PASPTAIncludedTarget.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## pta.administration.add.ptasyslog.patch.262

`PATCH /PasswordVault/api/pta/API/Administration/properties/SyslogOutboundDataList` — **stub**

- Category: PTA Administration
- Operation: Add PTASyslog
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/PTAAdministration/Add-PASPTASyslog.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## pta.administration.remove.ptasyslog.delete.264

`DELETE /PasswordVault/api/pta/API/Administration/properties/SyslogOutboundDataList/{ID}` — **stub**

- Category: PTA Administration
- Operation: Remove PTASyslog
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/PTAAdministration/Remove-PASPTASyslog.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## pta.administration.update.pta.administration.property

`PATCH /PasswordVault/API/pta/API/administration/properties/{propertyKey}` — **stub**

- Category: PTA Administration
- Operation: Update PTA Administration Property
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `propertyKey`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/PTA%20Administration/Update%20PTA%20Administration%20Property.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## pta.administration.delete.pta.administration.property

`DELETE /PasswordVault/API/pta/API/administration/properties/{propertyKey}/{ID}` — **stub**

- Category: PTA Administration
- Operation: Delete PTA Administration Property
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `propertyKey`, path `ID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/PTA%20Administration/Delete%20PTA%20Administration%20Property.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## recordings.get.recordings

`GET /PasswordVault/API/recordings` — **stub**

- Category: Recordings
- Operation: Get Recordings
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `Limit`, query `sort`, query `Offset`, query `Search`, query `Safe`, query `FromTime`, query `ToTime`, query `Activities`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Recordings/Get%20Recordings.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## recordings.get.recording.details

`GET /PasswordVault/API/recordings/{recordingID}` — **stub**

- Category: Recordings
- Operation: Get Recording Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `recordingID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Recordings/Get%20Recording%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## recordings.get.recording.activities

`GET /PasswordVault/API/recordings/{recordingID}/activities` — **stub**

- Category: Recordings
- Operation: Get Recording Activities
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `recordingID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Recordings/Get%20Recording%20Activities.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## recordings.play.recording

`POST /PasswordVault/API/recordings/{recordingID}/Play` — **stub**

- Category: Recordings
- Operation: Play Recording
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `recordingID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Recordings/Play%20Recording.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## recordings.get.recording.properties

`GET /PasswordVault/API/recordings/{recordingID}/properties` — **stub**

- Category: Recordings
- Operation: Get Recording Properties
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `recordingID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Recordings/Get%20Recording%20Properties.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## recordings.test.psmrecording.get.259

`GET /PasswordVault/API/Recordings/{SessionID}/valid` — **stub**

- Category: Recordings
- Operation: Test PSMRecording
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `SessionID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Monitoring/Test-PASPSMRecording.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## reports.and.tasks.download.report

`GET /PasswordVault/API/ClassicReports` — **stub**

- Category: Reports and Tasks
- Operation: Download Report
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `data`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Reports%20and%20Tasks/Download%20Report.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## reports.and.tasks.get.reports

`GET /PasswordVault/API/Reports` — **stub**

- Category: Reports and Tasks
- Operation: Get Reports
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `offset`, query `limit`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Reports%20and%20Tasks/Get%20Reports.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## reports.and.tasks.get.tasks

`GET /PasswordVault/API/Tasks` — **stub**

- Category: Reports and Tasks
- Operation: Get Tasks
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `offset`, query `limit`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Reports%20and%20Tasks/Get%20Tasks.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## reports.and.tasks.create.task

`POST /PasswordVault/API/Tasks` — **stub**

- Category: Reports and Tasks
- Operation: Create Task
- Authentication: token
- Request media type: application/json
- Request fields: `version` (integer), `type` (string), `subType` (string), `name` (string), `keepTaskDefinition` (boolean), `schedule` (object), `subscribers` (array), `notifyOnFailure` (boolean)
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Reports%20and%20Tasks/Create%20Task.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## reports.and.tasks.remove.report.task.delete.277

`DELETE /PasswordVault/API/Tasks/{id}` — **stub**

- Category: Reports and Tasks
- Operation: Remove Report Task
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `id`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Reports/Remove-PASReportTask.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## reports.and.tasks.get.report.task.get.276

`GET /PasswordVault/API/Tasks/{id}` — **stub**

- Category: Reports and Tasks
- Operation: Get Report Task
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `id`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Reports/Get-PASReportTask.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## reports.and.tasks.set.report.task.put.278

`PUT /PasswordVault/API/Tasks/{id}` — **stub**

- Category: Reports and Tasks
- Operation: Set Report Task
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `id`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Reports/Set-PASReportTask.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## requests.get.multiple.account.access.status

`GET /PasswordVault/API/bulkactions/{requestID}` — **stub**

- Category: Requests
- Operation: Get Multiple Account Access Status
- Authentication: token
- Request media type: application/json
- Request fields: `BulkItems` (array)
- Parameters: path `requestID`, query `DisplayExtendedItems`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Requests/My%20Requests/Multiple%20Access%20Requests/Get%20Multiple%20Account%20Access%20Status.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## requests.get.incoming.request.list

`GET /PasswordVault/API/IncomingRequests` — **stub**

- Category: Requests
- Operation: Get Incoming Request List
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `OnlyWaiting`, query `Expired`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Requests/Incoming%20Requests/Get%20Incoming%20Request%20List.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## requests.confirm.request.in.bulk

`POST /PasswordVault/API/incomingrequests/confirm/bulk` — **stub**

- Category: Requests
- Operation: Confirm Request in Bulk
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Requests/Incoming%20Requests/Confirm%20Request%20in%20Bulk.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## requests.reject.request.in.bulk

`POST /PasswordVault/API/incomingrequests/reject/bulk` — **stub**

- Category: Requests
- Operation: Reject Request in Bulk
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Requests/Incoming%20Requests/Reject%20Request%20in%20Bulk.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## requests.get.confirmation.request.details

`GET /PasswordVault/API/incomingrequests/{requestID}` — **stub**

- Category: Requests
- Operation: Get Confirmation Request Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `requestID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Requests/Incoming%20Requests/Get%20Confirmation%20Request%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## requests.confirm.request

`POST /PasswordVault/API/incomingrequests/{requestID}/confirm` — **stub**

- Category: Requests
- Operation: Confirm Request
- Authentication: token
- Request media type: application/json
- Request fields: `Reason` (string)
- Parameters: path `requestID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Requests/Incoming%20Requests/Confirm%20Request.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## requests.reject.request

`POST /PasswordVault/API/incomingrequests/{requestID}/reject` — **stub**

- Category: Requests
- Operation: Reject Request
- Authentication: token
- Request media type: application/json
- Request fields: `Reason` (string)
- Parameters: path `requestID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Requests/Incoming%20Requests/Reject%20Request.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## requests.get.my.requests

`GET /PasswordVault/API/MyRequests` — **stub**

- Category: Requests
- Operation: Get My Requests
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `OnlyWaiting`, query `Expired`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Requests/My%20Requests/Get%20My%20Requests.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## requests.create.an.access.request

`POST /PasswordVault/API/MyRequests` — **stub**

- Category: Requests
- Operation: Create an Access Request
- Authentication: token
- Request media type: application/json
- Request fields: Open schema; not fully verified.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Requests/My%20Requests/Create%20an%20Access%20Request.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation. Reference request example could not be parsed; schema intentionally open.

## requests.delete.my.request

`DELETE /PasswordVault/API/myrequests/{requestID}` — **stub**

- Category: Requests
- Operation: Delete My Request
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `requestID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Requests/My%20Requests/Delete%20My%20Request.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## requests.get.details.of.my.requests

`GET /PasswordVault/API/myrequests/{requestID}` — **stub**

- Category: Requests
- Operation: Get Details of My Requests
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `requestID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Requests/My%20Requests/Get%20Details%20of%20My%20Requests.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## safe.members.get.all.safe.members

`GET /PasswordVault/API/Safes/{safeID}/Members` — **partial**

- Category: Safe Members
- Operation: Get All Safe Members
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `safeID`, query `filter`, query `search`, query `offset`, query `limit`, query `sort`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Safe%20Members/Get%20All%20Safe%20Members.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## safe.members.add.safe.member

`POST /PasswordVault/API/Safes/{safeID}/Members` — **partial**

- Category: Safe Members
- Operation: Add Safe Member
- Authentication: token
- Request media type: application/json
- Request fields: `memberName` (string), `searchIn` (string), `membershipExpirationDate` (integer), `permissions` (object), `MemberType` (string)
- Parameters: path `safeID`
- Response contracts: 201 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Safe%20Members/Add%20Safe%20Member.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## safe.members.delete.safe.member

`DELETE /PasswordVault/API/Safes/{safeID}/Members/{memberName}` — **partial**

- Category: Safe Members
- Operation: Delete Safe Member
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `safeID`, path `memberName`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Safe%20Members/Delete%20Safe%20Member.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## safe.members.get.safe.member

`GET /PasswordVault/API/Safes/{safeID}/Members/{memberName}` — **partial**

- Category: Safe Members
- Operation: Get Safe Member
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `safeID`, path `memberName`, query `useCache`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Safe%20Members/Get%20Safe%20Member.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## safe.members.update.safe.member

`PUT /PasswordVault/API/Safes/{safeID}/Members/{memberName}` — **partial**

- Category: Safe Members
- Operation: Update Safe Member
- Authentication: token
- Request media type: application/json
- Request fields: `membershipExpirationDate` (integer), `permissions` (object)
- Parameters: path `safeID`, path `memberName`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Safe%20Members/Update%20Safe%20Member.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## safe.members.get.safe.member.get.318

`GET /PasswordVault/WebServices/PIMServices.svc/Safes/{SafeName}/Members` — **stub**

- Category: Safe Members
- Operation: Get Safe Member
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `SafeName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/SafeMembers/Get-PASSafeMember.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## safe.members.add.safe.member.post.281

`POST /PasswordVault/WebServices/PIMServices.svc/Safes/{SafeName}/Members` — **stub**

- Category: Safe Members
- Operation: Add Safe Member
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `SafeName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/SafeMembers/Add-PASSafeMember.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## safe.members.remove.safe.member.delete.282

`DELETE /PasswordVault/WebServices/PIMServices.svc/Safes/{SafeName}/Members/{MemberName}` — **stub**

- Category: Safe Members
- Operation: Remove Safe Member
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `SafeName`, path `MemberName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/SafeMembers/Remove-PASSafeMember.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## safe.members.get.safe.member.get.319

`GET /PasswordVault/WebServices/PIMServices.svc/Safes/{SafeName}/Members/{MemberName}` — **stub**

- Category: Safe Members
- Operation: Get Safe Member
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `SafeName`, path `MemberName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/SafeMembers/Get-PASSafeMember.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## safe.members.set.safe.member.put.283

`PUT /PasswordVault/WebServices/PIMServices.svc/Safes/{SafeName}/Members/{MemberName}` — **stub**

- Category: Safe Members
- Operation: Set Safe Member
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `SafeName`, path `MemberName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/SafeMembers/Set-PASSafeMember.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## safes.get.safe.by.platform.id

`GET /PasswordVault/API/Platforms/{platformID}/Safes` — **partial**

- Category: Safes
- Operation: Get Safe by Platform ID
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `platformID`, query `safeName`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Get%20Safe%20by%20Platform%20ID.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## safes.get.all.safes

`GET /PasswordVault/API/Safes` — **partial**

- Category: Safes
- Operation: Get All Safes
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `search`, query `offset`, query `limit`, query `sort`, query `includeAccounts`, query `extendedDetails`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Get%20All%20Safes.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## safes.add.safe

`POST /PasswordVault/API/Safes` — **partial**

- Category: Safes
- Operation: Add Safe
- Authentication: token
- Request media type: application/json
- Request fields: `numberOfDaysRetention` (integer), `numberOfVersionsRetention` (integer), `oLACEnabled` (boolean), `autoPurgeEnabled` (boolean), `managingCPM` (string), `safeName` (string), `description` (string), `location` (string)
- Parameters:
- Response contracts: 201 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Add%20Safe.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## safes.delete.safe

`DELETE /PasswordVault/API/Safes/{safeID}` — **partial**

- Category: Safes
- Operation: Delete Safe
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `safeID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Delete%20Safe.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## safes.get.safe.details

`GET /PasswordVault/API/Safes/{safeID}` — **partial**

- Category: Safes
- Operation: Get Safe Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `safeID`, query `includeAccounts`, query `useCache`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Get%20Safe%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## safes.update.safe

`PUT /PasswordVault/API/Safes/{safeID}` — **partial**

- Category: Safes
- Operation: Update Safe
- Authentication: token
- Request media type: application/json
- Request fields: `safeName` (string), `safeNumber` (integer), `description` (string), `location` (string), `creator` (object), `olacEnabled` (boolean), `managingCPM` (string), `numberOfVersionsRetention` (integer), `numberOfDaysRetention` (integer)
- Parameters: path `safeID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Update%20Safe.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## safes.search.for.a.safe

`GET /PasswordVault/WebServices/PIMServices.svc/Safes` — **stub**

- Category: Safes
- Operation: Search for a Safe
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `Query`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Safes/Search%20for%20a%20Safe.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## safes.add.safe.post.284

`POST /PasswordVault/WebServices/PIMServices.svc/Safes` — **stub**

- Category: Safes
- Operation: Add Safe
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Safes/Add-PASSafe.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## safes.remove.safe.delete.285

`DELETE /PasswordVault/WebServices/PIMServices.svc/Safes/{SafeName}` — **stub**

- Category: Safes
- Operation: Remove Safe
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `SafeName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Safes/Remove-PASSafe.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## safes.get.safe.get.317

`GET /PasswordVault/WebServices/PIMServices.svc/Safes/{SafeName}` — **stub**

- Category: Safes
- Operation: Get Safe
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `SafeName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Safes/Get-PASSafe.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## safes.set.safe.put.286

`PUT /PasswordVault/WebServices/PIMServices.svc/Safes/{SafeName}` — **stub**

- Category: Safes
- Operation: Set Safe
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `SafeName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Safes/Set-PASSafe.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## security.remove.ptaexcluded.target.delete.253

`DELETE /PasswordVault/api/pta/API/Administration/properties/CidrExclusionList/{ID}` — **stub**

- Category: Security
- Operation: Remove PTAExcluded Target
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/EventSecurity/Remove-PASPTAExcludedTarget.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## security.get.pta.security.configuration

`GET /PasswordVault/API/pta/API/configuration` — **stub**

- Category: Security
- Operation: Get PTA Security Configuration
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Get%20PTA%20Security%20Configuration.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## security.get.ptasecurity.configuration.category.get.315

`GET /PasswordVault/API/pta/API/configuration/categories` — **stub**

- Category: Security
- Operation: Get PTASecurity Configuration Category
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/EventSecurity/Get-PASPTASecurityConfigurationCategory.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## security.get.ptasecurity.configuration.category.get.316

`GET /PasswordVault/API/pta/API/configuration/categories/{categoryKey}` — **stub**

- Category: Security
- Operation: Get PTASecurity Configuration Category
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `categoryKey`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/EventSecurity/Get-PASPTASecurityConfigurationCategory.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## security.add.ptaprivileged.group.patch.251

`PATCH /PasswordVault/API/pta/API/configuration/properties/PrivilegedDomainGroupsList` — **stub**

- Category: Security
- Operation: Add PTAPrivileged Group
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/EventSecurity/Add-PASPTAPrivilegedGroup.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## security.remove.ptaprivileged.group.delete.254

`DELETE /PasswordVault/API/pta/API/configuration/properties/PrivilegedDomainGroupsList/{ID}` — **stub**

- Category: Security
- Operation: Remove PTAPrivileged Group
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/EventSecurity/Remove-PASPTAPrivilegedGroup.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## security.add.ptaprivileged.user.patch.252

`PATCH /PasswordVault/API/pta/API/configuration/properties/PrivilegedUsersList` — **stub**

- Category: Security
- Operation: Add PTAPrivileged User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/EventSecurity/Add-PASPTAPrivilegedUser.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## security.remove.ptaprivileged.user.delete.255

`DELETE /PasswordVault/API/pta/API/configuration/properties/PrivilegedUsersList/{ID}` — **stub**

- Category: Security
- Operation: Remove PTAPrivileged User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `ID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/EventSecurity/Remove-PASPTAPrivilegedUser.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## security.reset.ptasecurity.configuration.category.put.256

`PUT /PasswordVault/API/pta/API/configuration/properties/{categoryKey}/default` — **stub**

- Category: Security
- Operation: Reset PTASecurity Configuration Category
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `categoryKey`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/EventSecurity/Reset-PASPTASecurityConfigurationCategory.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## security.update.pta.security.configuration.property

`PATCH /PasswordVault/API/pta/API/configuration/properties/{propertyKey}` — **stub**

- Category: Security
- Operation: Update PTA Security Configuration Property
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `propertyKey`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Update%20PTA%20Security%20Configuration%20Property.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## security.delete.pta.security.configuration.property

`DELETE /PasswordVault/API/pta/API/configuration/properties/{propertyKey}/{ID}` — **stub**

- Category: Security
- Operation: Delete PTA Security Configuration Property
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `propertyKey`, path `ID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Delete%20PTA%20Security%20Configuration%20Property.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## security.get.security.events

`GET /PasswordVault/API/pta/API/Events` — **stub**

- Category: Security
- Operation: Get Security Events
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `fromUpdateTime`, query `status`, query `accountID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Get%20Security%20Events.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## security.update.security.event.status

`PATCH /PasswordVault/API/pta/API/Events/{eventID}` — **stub**

- Category: Security
- Operation: Update Security Event Status
- Authentication: token
- Request media type: application/json
- Request fields: `mStatus` (string), `closeReason` (string), `reasonText` (string)
- Parameters: path `eventID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Update%20Security%20Event%20Status.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## security.update.risk.event.status

`PATCH /PasswordVault/API/pta/API/Risks/RiskEvents/{eventID}` — **stub**

- Category: Security
- Operation: Update Risk Event Status
- Authentication: token
- Request media type: application/json
- Request fields: `Status` (string), `closeReason` (string), `reasonText` (string)
- Parameters: path `eventID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Update%20Risk%20Event%20Status.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## security.get.risk.events

`GET /PasswordVault/API/pta/API/Risks/RisksEvents` — **stub**

- Category: Security
- Operation: Get Risk Events
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `filter`, query `sort`, query `page`, query `size`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Get%20Risk%20Events.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## security.get.risk.summary

`GET /PasswordVault/API/pta/API/Risks/Summary` — **stub**

- Category: Security
- Operation: Get Risk Summary
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Get%20Risk%20Summary.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## security.get.security.settings

`GET /PasswordVault/API/pta/API/Settings` — **stub**

- Category: Security
- Operation: Get Security Settings
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Get%20Security%20Settings.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## security.update.security.remediation.settings

`PATCH /PasswordVault/API/pta/API/Settings/AutomaticRemediations` — **stub**

- Category: Security
- Operation: Update Security Remediation Settings
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Update%20Security%20Remediation%20Settings.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## security.add.suspicious.activities.rule

`POST /PasswordVault/API/pta/API/Settings/RiskyActivity` — **stub**

- Category: Security
- Operation: Add Suspicious Activities Rule
- Authentication: token
- Request media type: application/json
- Request fields: `category` (string), `regex` (string), `score` (integer), `description` (string), `response` (string), `active` (boolean), `scope` (object)
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Add%20Suspicious%20Activities%20Rule.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## security.update.suspicious.activity.rule

`PUT /PasswordVault/API/pta/API/Settings/RiskyActivity` — **stub**

- Category: Security
- Operation: Update Suspicious Activity Rule
- Authentication: token
- Request media type: application/json
- Request fields: `id` (string), `category` (string), `regex` (string), `score` (integer), `description` (string), `response` (string), `active` (boolean), `scope` (object)
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Security/Update%20Suspicious%20Activity%20Rule.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## sessions.get.active.sessions

`GET /PasswordVault/API/LiveSessions` — **stub**

- Category: Sessions
- Operation: Get Active Sessions
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `Limit`, query `Sort`, query `offset`, query `Search`, query `Safe`, query `FromTime`, query `ToTime`, query `Activities`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Get%20Active%20Sessions.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## sessions.get.active.session

`GET /PasswordVault/API/livesessions/{liveSessionID}` — **stub**

- Category: Sessions
- Operation: Get Active Session
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `liveSessionID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Get%20Active%20Session.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## sessions.get.active.session.activities

`GET /PasswordVault/API/livesessions/{liveSessionID}/activities` — **stub**

- Category: Sessions
- Operation: Get Active Session Activities
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `liveSessionID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Get%20Active%20Session%20Activities.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## sessions.monitor.an.active.session

`GET /PasswordVault/API/LiveSessions/{liveSessionID}/Monitor` — **stub**

- Category: Sessions
- Operation: Monitor an Active Session
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `liveSessionID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Session%20Actions/Monitor%20an%20Active%20Session.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## sessions.get.active.session.properties

`GET /PasswordVault/API/livesessions/{liveSessionID}/properties` — **stub**

- Category: Sessions
- Operation: Get Active Session Properties
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `liveSessionID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Get%20Active%20Session%20Properties.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## sessions.resume.psmsession.post.258

`POST /PasswordVault/api/LiveSessions/{LiveSessionId}/Resume` — **stub**

- Category: Sessions
- Operation: Resume PSMSession
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `LiveSessionId`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Monitoring/Resume-PASPSMSession.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## sessions.suspend

`POST /PasswordVault/API/LiveSessions/{liveSessionID}/Suspend` — **stub**

- Category: Sessions
- Operation: Suspend session
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `liveSessionID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Session%20Actions/Suspend%20or%20Resume%20an%20Active%20Session.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## sessions.terminate.an.active.session

`POST /PasswordVault/API/LiveSessions/{liveSessionID}/Terminate` — **stub**

- Category: Sessions
- Operation: Terminate an Active Session
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `liveSessionID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Monitor%20Sessions/Session%20Actions/Terminate%20an%20Active%20Session.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## system.health.pam.self.hosted.system.health.details

`GET /PasswordVault/API/ComponentsMonitoringDetails/{componentID}` — **stub**

- Category: System Health
- Operation: PAM - Self-Hosted System Health Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `componentID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/System%20Health/PAM%20-%20Self-Hosted%20System%20Health%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## system.health.pam.self.hosted.system.health.summary

`GET /PasswordVault/API/ComponentsMonitoringSummary` — **stub**

- Category: System Health
- Operation: PAM - Self-Hosted System Health Summary
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/System%20Health/PAM%20-%20Self-Hosted%20System%20Health%20Summary.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## user.groups.export.platform.post.268

`POST /PasswordVault/API/Platforms/Groups/{GroupPlatformID}/Export` — **stub**

- Category: Platforms
- Operation: Export Platform
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `GroupPlatformID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/Platforms/Export-PASPlatform.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## user.groups.get.groups

`GET /PasswordVault/API/UserGroups` — **partial**

- Category: User Groups
- Operation: Get Groups
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `filter`, query `search`, query `sort`, query `includeMembers`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Groups/Get%20Groups.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## user.groups.create.group

`POST /PasswordVault/API/UserGroups` — **partial**

- Category: User Groups
- Operation: Create Group
- Authentication: token
- Request media type: application/json
- Request fields: `groupName` (string), `description` (string), `location` (string)
- Parameters:
- Response contracts: 201 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Groups/Create%20Group.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## user.groups.delete.group

`DELETE /PasswordVault/API/UserGroups/{groupID}` — **partial**

- Category: User Groups
- Operation: Delete Group
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `groupID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Groups/Delete%20Group.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## user.groups.get.group.details

`GET /PasswordVault/API/UserGroups/{groupID}` — **partial**

- Category: User Groups
- Operation: Get Group Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `groupID`, query `includeMembers`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Groups/Get%20Group%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## user.groups.update.group

`PUT /PasswordVault/API/UserGroups/{groupID}` — **partial**

- Category: User Groups
- Operation: Update Group
- Authentication: token
- Request media type: application/json
- Request fields: `groupName` (string)
- Parameters: path `groupID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Groups/Update%20Group.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## user.groups.add.member.to.group

`POST /PasswordVault/API/UserGroups/{groupID}/Members` — **partial**

- Category: User Groups
- Operation: Add Member to Group
- Authentication: token
- Request media type: application/json
- Request fields: `memberId` (string), `memberType` (string), `domainName` (string)
- Parameters: path `groupID`
- Response contracts: 201 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Groups/Add%20Member%20to%20Group.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## user.groups.remove.user.from.group

`DELETE /PasswordVault/API/UserGroups/{groupID}/members/{memberName}` — **partial**

- Category: User Groups
- Operation: Remove User from Group
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `groupID`, path `memberName`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Groups/Remove%20User%20from%20Group.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## user.groups.add.group.member.post.288

`POST /PasswordVault/WebServices/PIMServices.svc/Groups/{GroupName}/Users` — **stub**

- Category: User Groups
- Operation: Add Group Member
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `GroupName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/User/Add-PASGroupMember.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## users.get.logged.on.user.get.289

`GET /PasswordVault/api/currentuser` — **partial**

- Category: Users
- Operation: Get Logged On User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/User/Get-PASLoggedOnUser.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.get.user.login.info.get.290

`GET /PasswordVault/api/LoginsInfo` — **partial**

- Category: Users
- Operation: Get User Login Info
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/User/Get-PASUserLoginInfo.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.get.users

`GET /PasswordVault/API/Users` — **partial**

- Category: Users
- Operation: Get Users
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `filter`, query `search`, query `ExtendedDetails`, query `sort`, query `pageOffset`, query `pageSize`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Users/Get%20Users.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.add.user

`POST /PasswordVault/API/Users` — **partial**

- Category: Users
- Operation: Add User
- Authentication: token
- Request media type: application/json
- Request fields: `username` (string), `userType` (string), `initialPassword` (string), `authenticationMethod` (array), `location` (string), `unAuthorizedInterfaces` (array), `expiryDate` (integer), `vaultAuthorization` (array), `enableUser` (boolean), `changePassOnNextLogon` (boolean), `passwordNeverExpires` (boolean), `description` (string), `businessAddress` (object), `internet` (object), `phones` (object), `personalDetails` (object)
- Parameters:
- Response contracts: 201 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Users/Add%20User.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.delete.an.mfa.caching.ssh.key

`DELETE /PasswordVault/API/Users/Secret/SSHKeys/Cache` — **stub**

- Category: Users
- Operation: Delete an MFA Caching SSH key
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Private%20SSH%20Authentication/Delete%20an%20MFA%20Caching%20SSH%20key.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## users.generate.an.mfa.caching.ssh.key

`POST /PasswordVault/API/Users/Secret/SSHKeys/Cache` — **stub**

- Category: Users
- Operation: Generate an MFA Caching SSH Key
- Authentication: token
- Request media type: application/json
- Request fields: `formats` (string)
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Private%20SSH%20Authentication/Generate%20an%20MFA%20Caching%20SSH%20Key.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## users.delete.all.mfa.caching.ssh.keys

`DELETE /PasswordVault/API/Users/Secret/SSHKeys/ClearCache` — **stub**

- Category: Users
- Operation: Delete All MFA Caching SSH Keys
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Private%20SSH%20Authentication/Delete%20All%20MFA%20Caching%20SSH%20Keys.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## users.get.user.get.321

`GET /PasswordVault/API/Users/{id}/safes` — **partial**

- Category: Users
- Operation: Get User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `id`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/User/Get-PASUser.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.delete.user

`DELETE /PasswordVault/API/Users/{userID}` — **partial**

- Category: Users
- Operation: Delete User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `userID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Users/Delete%20User.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.get.user.details

`GET /PasswordVault/API/Users/{userID}` — **partial**

- Category: Users
- Operation: Get User Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `userID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Users/Get%20User%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.update.user

`PUT /PasswordVault/API/Users/{userID}` — **partial**

- Category: Users
- Operation: Update User
- Authentication: token
- Request media type: application/json
- Request fields: `enableUser` (boolean), `changePassOnNextLogon` (boolean), `expiryDate` (integer), `suspended` (boolean), `unAuthorizedInterfaces` (array), `authenticationMethod` (array), `passwordNeverExpires` (boolean), `distinguishedName` (string), `description` (string), `businessAddress` (object), `internet` (object), `phones` (object), `personalDetails` (object), `id` (integer), `username` (string), `source` (string), `userType` (string), `componentUser` (boolean), `vaultAuthorization` (array), `location` (string)
- Parameters: path `userID`
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Users/Update%20User.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.activate.user

`POST /PasswordVault/API/Users/{userID}/activate` — **partial**

- Category: Users
- Operation: Activate User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `userID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Users/Activate%20User.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.disable.user

`POST /PasswordVault/API/Users/{userID}/disable` — **partial**

- Category: Users
- Operation: Disable User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `userID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Users/Disable%20User.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.enable.user

`POST /PasswordVault/API/Users/{userID}/enable` — **partial**

- Category: Users
- Operation: Enable User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `userID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Users/Enable%20User.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.reset.user.password

`POST /PasswordVault/API/Users/{userID}/ResetPassword` — **partial**

- Category: Users
- Operation: Reset User Password
- Authentication: token
- Request media type: application/json
- Request fields: `id` (string), `newPassword` (string)
- Parameters: path `userID`
- Response contracts: 204 unspecified; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Users/Reset%20User%20Password.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.delete.an.mfa.caching.ssh.key.for.another.user

`DELETE /PasswordVault/API/Users/{UserName}/Secret/SSHKeys/Cache` — **stub**

- Category: Users
- Operation: Delete an MFA Caching SSH Key for Another User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `UserName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Private%20SSH%20Authentication/Delete%20an%20MFA%20Caching%20SSH%20Key%20for%20Another%20User.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## users.generate.an.mfa.caching.ssh.key.for.another.user

`POST /PasswordVault/API/Users/{UserName}/Secret/SSHKeys/Cache` — **stub**

- Category: Users
- Operation: Generate an MFA Caching SSH Key for Another User
- Authentication: token
- Request media type: application/json
- Request fields: `formats` (string), `keyPassword` (string)
- Parameters: path `UserName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Private%20SSH%20Authentication/Generate%20an%20MFA%20Caching%20SSH%20Key%20for%20Another%20User.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## users.get.user.types

`GET /PasswordVault/API/UserTypes` — **partial**

- Category: Users
- Operation: Get User Types
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 200 object; 400 object; 401 object; 403 object; 404 object; 409 object;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Users/Get%20User%20Types.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

Persistent local simulator. Supports the documented core workflow; see docs/core-modules.md for supported fields, simplified permissions and mock-only PSM behavior. Legacy APIs, package imports and external CPM/PSM execution are not simulated.

## users.get.logged.on.user.details

`GET /PasswordVault/WebServices/PIMServices.svc/User` — **stub**

- Category: Users
- Operation: Get Logged On User Details
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Users/Get%20Logged%20On%20User%20Details.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## users.new.user.post.291

`POST /PasswordVault/WebServices/PIMServices.svc/Users` — **stub**

- Category: Users
- Operation: New User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/User/New-PASUser.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## users.remove.user.delete.292

`DELETE /PasswordVault/WebServices/PIMServices.svc/Users/{UserName}` — **stub**

- Category: Users
- Operation: Remove User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `UserName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/User/Remove-PASUser.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## users.get.user.get.320

`GET /PasswordVault/WebServices/PIMServices.svc/Users/{UserName}` — **stub**

- Category: Users
- Operation: Get User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `UserName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/User/Get-PASUser.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## users.set.user.put.293

`PUT /PasswordVault/WebServices/PIMServices.svc/Users/{UserName}` — **stub**

- Category: Users
- Operation: Set User
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `UserName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/User/Set-PASUser.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## users.get.public.ssh.key

`GET /PasswordVault/WebServices/PIMServices.svc/Users/{UserName}/AuthenticationMethods/SSHKeyAuthentication/AuthorizedKeys` — **stub**

- Category: Users
- Operation: Get Public SSH Key
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `UserName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Public%20SSH%20Authentication/Get%20Public%20SSH%20Key.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## users.add.a.public.ssh.key

`POST /PasswordVault/WebServices/PIMServices.svc/Users/{UserName}/AuthenticationMethods/SSHKeyAuthentication/AuthorizedKeys` — **stub**

- Category: Users
- Operation: Add a Public SSH Key
- Authentication: token
- Request media type: application/json
- Request fields: `PublicSSHKey` (string)
- Parameters: path `UserName`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Public%20SSH%20Authentication/Add%20a%20Public%20SSH%20Key.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## users.delete.public.ssh.key

`DELETE /PasswordVault/WebServices/PIMServices.svc/Users/{UserName}/AuthenticationMethods/SSHKeyAuthentication/AuthorizedKeys/{keyID}` — **stub**

- Category: Users
- Operation: Delete Public SSH Key
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: path `UserName`, path `keyID`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/User%20Management/Public%20SSH%20Authentication/Delete%20Public%20SSH%20Key.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## vault.get.server.get.287

`GET /PasswordVault/api/server` — **stub**

- Category: Vault
- Operation: Get Server
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/ServerWebServices/Get-PASServer.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## vault.get.server.web.service.get.322

`GET /PasswordVault/API/verify` — **stub**

- Category: Vault
- Operation: Get Server Web Service
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-client-reference](https://github.com/pspete/psPAS/blob/df2b7986421285eccb3a3454def15b99d2f99677/psPAS/Functions/ServerWebServices/Get-PASServerWebService.ps1)
- Source version: psPAS df2b7986421285eccb3a3454def15b99d2f99677; API version varies by operation
- Confidence: reference-only

Request target verified against public client source. Required fields, response contract and exact product version need official verification before implementation.

## vault.logo

`GET /PasswordVault/WebServices/PIMServices.svc/Logo` — **stub**

- Category: Vault
- Operation: Logo
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters: query `type`
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Server/Logo.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## vault.server

`GET /PasswordVault/WebServices/PIMServices.svc/Server` — **stub**

- Category: Vault
- Operation: Server
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Server/Server.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.

## vault.verify

`GET /PasswordVault/WebServices/PIMServices.svc/Verify` — **stub**

- Category: Vault
- Operation: Verify
- Authentication: token
- Request media type: No body recorded
- Request fields: None recorded; see confidence note.
- Parameters:
- Response contracts: 501 object; 401 object; default unspecified;
- Known errors: PAMMOCK001
- Source: [public-bruno-reference](https://github.com/IAM-Jah/CyberArk-REST-API-Bruno/blob/966d9e9e77bbcf684becc424f04227d111e0191a/CyberArk%20Self-Hosted%20REST%20API/CyberArk%20Self-Hosted%20REST%20API/Self-Hosted%20PAM/Server/Verify.bru)
- Source version: 14.6 reference collection; reviewed 2026-10-03
- Confidence: reference-only

HTTP contract from a public reference collection. Success response and required-field details need official verification before implementation.


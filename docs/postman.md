# Postman reference and naming

Import `clients/postman/pam-mock.postman_collection.json` and `clients/postman/cyberark-local.postman_environment.json`. Select **CyberArk reference — local mock**. Expand **Self-Hosted → Privileged Access Manager → Authentication**, send the credential Logon request, then use the other requests. `pasBaseURL` is `http://localhost:8080`; the token is captured in `pasSessionToken`.

The 181-request hierarchy is preserved from [Joe Garcia's public collection](https://github.com/infamousjoeg/CyberArk-RESTAPI/tree/1728f5c4b4ed796e0e89a0332e9fd4f9916d8fa2), pinned under `api/reference`. That source calls itself **unofficial**, targets PAM 13.2, and stopped receiving updates in February 2024. It is a historical reference, not evidence of complete current official compatibility.

✅ means the method/path is implemented locally, including documented partial behaviors. ⏳ means unimplemented. 📝 means the source's placeholder body is not executable JSON yet. A green icon does not guarantee success with arbitrary example IDs or permissions, nor certify full CyberArk behavior. The collection deliberately retains upstream request bodies, including templates needing user-supplied values.

The only body replacements are explicit in `api/reference/postman-corrections.json`, each with an official source:

- Credential logon: remove the JSON comment and use the documented boolean `concurrentSession`.
- Add Safe: use documented second-generation field names, including `oLACEnabled`, with local values.
- PSM policy update: use the documented server/connector fields and local variables. No `OverrideUserParameters` extension is sent.

The Get Users filter is also completed as the documented `userType eq EPVUser`, replacing the incomplete upstream `filter=userType`.

All other bodies, methods and URLs are compared against the pinned source in automated tests. These tests prove preservation, not current vendor certification. Unknown or legacy payloads are not silently rewritten. PSM connector and server responses expose the documented `Id`/`DisplayName` and `Id`/`Name`/`Address` fields; internal server type and fixture override metadata are private.

Request variables such as `pasAccountID`, `pasSafe`, `pasUserID` and `pasPlatformName` default to actual local fixture objects. Change them before mutation requests. Some source requests also have their own path-variable defaults: inspect the Params tab before sending. Use the separate smoke collection for an automated run; the reference includes delete requests and unsupported PTA endpoints.

## ACME naming convention

There is no naming convention shared by every industry. This lab adopts one consistent example, with reserved DNS names:

| Object | Pattern | Example |
|---|---|---|
| Safe | `PAM-<environment>-<application>-<technology>` | `PAM-PRD-ERP-WIN` |
| Access group | `GG_PAM_<scope>_<role>` | `GG_PAM_PRD_WINDOWS_OPERATORS` |
| Customized platform | `ACME-<base technology>` | `ACME-WinDomain` |
| Target host | `<environment><OS>-<application>-<number>.corp.acme.example` | `prdw-erp-001.corp.acme.example` |
| Service account | `svc_<application>_<purpose>` | `svc_erp_app` |
| Account object | `<platform>-<host>-<username>` | `ACME-WinDomain-prdw-erp-001-svc_erp_app` |

`PRD` denotes production and `UAT` acceptance testing. Unix `root`, Windows `Administrator` and named service accounts are associated with appropriate platforms and safes. PSM recording fixtures do not assign a CPM. Existing login personas (`pamadmin`, `auditor`, etc.) are retained so published authentication examples continue working. ACME platform IDs are custom fixture policies, not a claim to distribute vendor platform packages.

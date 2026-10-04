# Working core modules

Log in as `pamadmin` / `PamAdmin123!` and paste the returned raw token into Swagger's **Authorize** dialog. Requests and changes are persisted in PostgreSQL. All names, addresses and secrets are fictional.

## Try the connected dataset

| Request | Example |
|---|---|
| Users and details | `GET /PasswordVault/API/Users`, `GET /PasswordVault/API/Users/1` |
| User groups and membership | `GET /PasswordVault/API/UserGroups/3` (Windows Operators) |
| Safes | `GET /PasswordVault/API/Safes` |
| Safe members and permissions | `GET /PasswordVault/API/Safes/APP-PROD-WINDOWS/Members` |
| Accounts | `GET /PasswordVault/API/Accounts?filter=safeName%20eq%20APP-PROD-WINDOWS` |
| Account and fictional password | `GET /PasswordVault/API/Accounts/1_1`, `POST /PasswordVault/API/Accounts/1_1/Password/Retrieve` |
| Platforms | `GET /PasswordVault/API/Platforms/targets` |
| Platform PSM policy | `GET /PasswordVault/API/Platforms/Targets/1/PrivilegedSessionManagement` |
| Servers and connectors | `GET /PasswordVault/API/PSM/Servers`, `GET /PasswordVault/API/PSM/Connectors` |

Users, groups, group members, safes, safe members and accounts support creation, reading, updates and deletion via the routes present in Swagger. Users also support enable, disable, activate and password reset. Groups and safes can be renamed; their references follow the rename. Removing users/groups clears associated memberships. Safes/platforms still referenced by accounts cannot be deleted.

Accounts support JSON Patch for `name`, `address`, `userName`, `platformAccountProperties`, and `secretManagement`, including one child-property level. `id`, `safeName`, `platformId` and secret fields are immutable through PATCH. Retrieve and update secrets through the dedicated routes. Secret history and activities persist, and neither lists nor search leak secret values. Verify/change/reconcile are immediate local simulations: they never contact a CPM or target host. SetNextPassword stages a secret for a subsequent Change/Reconcile. Resume enables automatic management; Cancel clears the staged value. There is no asynchronous queue or exclusive checkout enforcement.

Platforms support lists by category, details, settings reads, rename, activation/deactivation, duplicate, unused-platform deletion and generated fictional secrets. Eight target platforms cover Windows domain/local, Unix SSH, Linux services, Oracle, SQL Server, application and network accounts. Three extra platform examples cover dependent, group and rotational categories.

## PSM and user parameter overrides

Two PSM servers and one PSMP server are defined on reserved `.example` addresses. Connectors include RDP, SSH, WinSCP, SQL Server Management Studio, Oracle, and illustrative web/VNC connectors. These are metadata examples, not executable vendor packages. `SSH` is associated with PSMP; desktop connectors use PSM.

Replace a platform's PSM policy with:

```http
PUT /PasswordVault/API/Platforms/Targets/1/PrivilegedSessionManagement
Content-Type: application/json
Authorization: <raw token>
```

```json
{
  "PSMServerId": "PSM-LAB-02",
  "PSMConnectors": [
    {
      "PSMConnectorID": "PSM-RDP",
      "Enabled": true,
      "OverrideUserParameters": [
        { "Name": "Port", "Value": "3390", "Visible": true, "Required": false }
      ]
    }
  ]
}
```

The server and connector IDs must exist, associations must be compatible, flags must be booleans and override names must be unique. PUT replaces the connector list. GET returns persisted overrides. `OverrideUserParameters` is an explicitly **mock-specific extension** of the reviewed public PSM policy contract; no vendor compatibility claim is made for that extension. A Port override is reflected in the mock RDP descriptor returned by `POST /Accounts/1_1/PSMConnect` with `{"ConnectionComponent":"PSM-RDP"}`. No session is opened. PSMP uses SSH and does not produce an RDP file; attempting it returns 400. Other override metadata is persisted, not executed.

## Permissions and limits

- `pamadmin` and `vaultadmin` are fixed simulator administrators. They manage the identity/platform catalog and bypass safe permissions. Built-in administrators cannot be deleted or disabled. `vaultAuthorization` does not grant administrator status in this mock.
- Other users receive safe permissions through direct membership or user groups. Permissions combine by union; expiration is honored. Group membership changes affect access immediately. Group nesting and external directory membership are not modeled.
- Safe Owners manage all eight safes. Auditors can list accounts, members and activity but cannot retrieve secrets. Windows/Linux/Database/Application operator groups only see their relevant safes. Disabled, locked and expired fixture users remain authentication test cases.
- Lists accept `search`, `sort`, `offset`/`limit` (or `pageOffset`/`pageSize`) and simple `field eq value` filters joined with `and`. The default page size is 100, maximum 1000; size zero returns all local records. Count is the total after filtering.
- Password accounts are supported. SSH-key credentials, bulk/dependent account workflows, discovery/onboarding, package import/export, legacy CRUD, platform settings PATCH and connection-component import remain explicit 501 stubs. They are visible in the inventory and are not reported as implemented.
- Request/response support is a local subset. The 79 working routes remain marked PARTIAL until broader vendor-contract verification. Errors use the shared `ErrorCode`/`ErrorMessage` format. Most non-authentication codes and status details are project-defined.

Reset an existing foundation dataset with `make reset` after rebuilding. This intentionally replaces local changes and invalidates sessions. Normal restarts preserve data. The compatibility tests run in a separate database.

## Public contract references

The checked-in versioned psPAS/Bruno references in the manifest establish the method/path inventory. Response checks also use official [users](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/get-users-api.htm), [PSM platform policy](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/session%20mngmnt%20-%20get_session_management_policy_platform.htm), [connectors](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/session%20mngmnt%20-%20get_all_connection_components.htm) and [servers](https://docs.cyberark.com/pam-self-hosted/latest/en/content/sdk/session%20mngmnt%20-%20get_all_psm_servers.htm) documentation. Fixtures and implementation are project-created.

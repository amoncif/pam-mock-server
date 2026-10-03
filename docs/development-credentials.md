# Local development credentials

Fictional accounts, for this local mock only. Password hashes are stored in fixtures/acme.json.

| Username | Provider | Password | State |
|---|---|---|---|
| pamadmin | CyberArk | `PamAdmin123!` | active |
| vaultadmin | CyberArk | `VaultAdmin123!` | active |
| psmoperator | CyberArk | `PsmOperator123!` | active |
| auditor | CyberArk | `Audit123!` | active |
| safeowner | CyberArk | `SafeOwner123!` | active |
| appuser | CyberArk | `AppUser123!` | active |
| readonly | CyberArk | `ReadOnly123!` | disabled |
| helpdesk | CyberArk | `Helpdesk123!` | locked |
| expired.user | CyberArk | `Expired123!` | expired |
| john.ldap | LDAP | `LdapUser123!` | active |
| windows.user | Windows | `WindowsUser123!` | active |
| radius.user | RADIUS | `RadiusUser123!` | active |
| saml.user | SAML | `SamlUser123!` | active |

SAML uses the fixed local assertion in the generated client collections. Shared logon uses appuser without a request body. No real identity provider is contacted.

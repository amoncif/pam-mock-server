# Roadmap

The foundation and core simulator provide authentication, users/groups, safes/members, accounts, platform metadata and PSM configuration. See [core modules](core-modules.md) for the working subset and [coverage](api-coverage.md) for per-domain status.

Next steps:

1. Review the 79 partial core contracts against official vendor examples, including response schemas and error codes.
2. Add account bulk actions, linked/dependent accounts and discovery/onboarding with dedicated relationship tests.
3. Add platform and connection-component package import/export, with bounded archive parsing and fixture packages.
4. Extend legacy compatibility and advanced authentication (OAuth, PKI, integrated Windows and challenge flows).
5. Implement requests/approvals, recordings and system health as separate workstreams.

The active operation backlog is in [GitHub Issues](https://github.com/amoncif/pam-mock-server/issues). Cloud products and real privileged-session execution are outside this local simulator.

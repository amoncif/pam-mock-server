# Roadmap

The foundation provides a modular runtime, a known-source manifest, Swagger, deterministic fixtures, local authentication, client collections and contract checks.

Before claiming complete authentication fidelity, resolve the advanced-authentication and error-contract issues. Audit the remaining inventory against current official documentation. Unknown success response shapes are not complete schemas.

The next implementation section should be **Accounts**. Start with list accounts, account details and pagination/search/filter behavior. Then add creation/update/deletion and separate stories for password retrieval, change, verification, reconciliation and linked accounts. Keep all other categories as explicit stubs.

Safes and Safe Members should follow, with permission behavior tested before state-changing operations. Platforms, Users, Groups, Applications, Requests, PSM, recordings and system health remain later workstreams. Each has an epic and operation-level stories. Cloud products are outside this phase.

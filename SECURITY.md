# Security

This server is for local development and training. Its public fixture passwords and simulated identity checks are intentional. Ports bind to localhost by default. Do not use it to store real secrets or authenticate real users.

Report a vulnerability through the repository's private vulnerability reporting feature where available. Otherwise contact the maintainer through GitHub without posting credentials or exploit data in an issue.

No production URLs, Vault tokens, customer data or proprietary configuration belong in this repository. `.env.local` is ignored. Dependency updates are managed by Dependabot. The gitleaks configuration retains standard secret rules and allows only explicitly fictional fixture values.

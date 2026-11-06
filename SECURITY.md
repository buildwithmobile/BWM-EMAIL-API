# Security Policy

The security of BWM Mail API users and their data matters. Please report suspected vulnerabilities responsibly.

## Report a vulnerability privately

Contact the BWM Mail API team through:

**https://bwmemailapi.ct.ws/contact**

Please include:

- A concise description of the issue
- Potential impact
- Reproduction steps
- Sanitized screenshots or logs, if helpful

Do **not** include live API keys, passwords, OTPs, reset tokens, customer records, or other sensitive data.

## If a credential is exposed

1. Revoke or rotate the affected key from the relevant project/account dashboard immediately.
2. Review recent activity for unexpected usage.
3. Replace the credential in your server-side environment.
4. Remove the secret from source files and logs.
5. Remember that deleting a secret from the latest commit does not remove it from Git history, forks, or caches.

## Public disclosure

Please allow the maintainers an opportunity to investigate and address a report before publishing technical details that could enable exploitation.

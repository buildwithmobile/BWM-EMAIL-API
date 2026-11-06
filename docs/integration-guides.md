# BWM Mail API Integration Guides

Use the official integration guide for current, copy-ready examples and exact API configuration:

https://bwmemailapi.ct.ws/integration-guides

The product documentation has covered examples and workflows for the following environments. Confirm current availability and exact code samples on the hosted guide before implementation.

## HTTP / cURL

Use cURL to test the documented API request independently of your application. Copy the base URL, path, method, headers, and JSON body from the live [API reference](https://bwmemailapi.ct.ws/api-reference).

## PHP

For PHP applications, keep the API key in server-side configuration or environment variables. Use cURL or the HTTP client already used by your project. Never expose the key in rendered HTML or browser-side scripts.

## Node.js

For Node.js services, use a server-side HTTP client and read the API key from an environment variable. Handle non-success HTTP responses and network failures explicitly.

## Python

For Python applications, load credentials from environment configuration and use a maintained HTTP client. Avoid logging authorization headers or full secret-bearing request objects.

## OTP and account security workflows

Email OTP and verification flows should be tied to a server-validated account action. Generate and validate codes on the server, expire them, limit attempts, and avoid returning secrets in client responses. Send only the account/security notifications required by the product workflow.

## Webhooks

If webhooks are enabled for your account, follow the current official webhook documentation for event names, signature headers, signing secret setup, and retry behavior. Verify signatures on the raw request body before trusting an event. Do not assume a signature algorithm or header name unless the live documentation specifies it.

## AI coding assistants

When asking ChatGPT, Claude, Gemini, Cursor, Windsurf, or GitHub Copilot to integrate BWM Mail API:

1. Provide the official documentation and API reference URLs.
2. Ask the assistant to use only documented endpoints and parameters.
3. Require server-side secret storage.
4. Ask it to preserve the existing project architecture.
5. Require error handling and a test plan.
6. Review generated code against the live API reference before deploying.

## Important

This repository does not currently define SDK package names or promise official SDK availability. Use the official integration page for the latest supported languages, frameworks, and examples.

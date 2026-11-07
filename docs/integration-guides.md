# BWM Mail API — Integration Guides

This repository contains companion guides and starter code for integrating BWM Mail API. Always verify endpoint details, request fields, template variables, account limits, and webhook configuration against the [official API reference](https://bwmemailapi.ct.ws/api-reference).

## 1. Prerequisites

- A BWM Mail API account and project.
- An API key generated for the project.
- A server-side environment that can make HTTPS requests.
- A verified sender/configuration if required by your account.

Store configuration in environment variables or a secret manager:

```env
BWM_MAIL_API_URL=https://YOUR_BWM_MAIL_API_HOST/api/v1/send
BWM_MAIL_API_KEY=YOUR_API_KEY
```

Do not commit real credentials or expose them in browser JavaScript, mobile app packages, public repositories, URL query strings, logs, or prompts sent to external AI services.

## 2. Send your first email

The documented send operation uses `POST /api/v1/send`, Bearer token authentication, and a JSON request body. The starter examples use the custom HTML fields `to`, `subject`, and `html`.

- [cURL example](../examples/curl/send-email.sh)
- [PHP example](../examples/php/send-email.php)
- [Node.js example](../examples/node/send-email.mjs)
- [Python example](../examples/python/send_email.py)
- [Laravel service example](../examples/laravel/BwmMailService.php)

Replace the sample recipient and endpoint placeholder. Confirm any additional required fields in the current API reference before production use.

## 3. PHP

Use the PHP example as a server-side starting point. It reads the API URL and key from environment variables, sends JSON using cURL, applies connection/request timeouts, and checks the HTTP status.

Run it from a PHP 8+ environment with the cURL extension enabled. Never place the API key in a PHP file committed to a public repository.

## 4. Node.js

The Node.js example uses the built-in Fetch API available in Node.js 18+. Run it only in a trusted server environment. It handles non-2xx responses and uses a request timeout.

For Express, Next.js, or another framework, call the API from a server route or backend service—not from client-side components.

## 5. Python

The Python example uses the Requests package:

```bash
python -m pip install requests
```

Set the two environment variables, then run `python examples/python/send_email.py`. Keep API calls in trusted backend code.

## 6. Laravel

The Laravel starter uses Laravel's HTTP client. Add the `bwm_mail` configuration shown in the comments to `config/services.php`, then set the environment variables in the deployment environment. Do not commit the real `.env` file.

## 7. OTP and account-security emails

For registration/login OTPs, email verification, password resets, and account-security alerts:

1. Initiate the flow on the server after validating the user's action.
2. Generate secrets using a cryptographically secure method.
3. Store only what is needed to validate the code/token securely.
4. Set a short expiry and enforce attempt/rate limits.
5. Never return OTPs, reset tokens, or API keys in client responses.
6. Send the email only after the relevant action is accepted by your application.
7. Avoid duplicate sends when requests are retried.

Use the template names and variables supported by your account and the current product documentation. Do not assume template fields that are not listed in the API reference.

## 8. Webhooks

The repository includes a [PHP webhook verification starter](../examples/webhooks/verify-php.php). The documented integration describes an `X-BWM-Signature` header and HMAC-SHA256 verification over the raw request body.

Before deploying, confirm the exact signing secret, signature encoding/prefix, event header, and retry behavior shown in your account's current documentation. Verify the signature before parsing or trusting event data. Process events idempotently so webhook retries do not repeat side effects.

## 9. API response and errors

Check both the HTTP status and the JSON response. Log a safe request identifier or message identifier where available, but do not log authorization headers, API keys, OTPs, reset tokens, or full sensitive message content.

An accepted API response confirms that the provider accepted the request; it does not guarantee inbox placement or that the recipient has read the message.

## 10. Browser and Android applications

Never call BWM Mail API directly from public browser JavaScript or ship the secret API key inside an Android APK. Instead:

1. The browser/mobile app calls your own backend.
2. Your backend authenticates and validates the user/action.
3. Your backend calls BWM Mail API using a server-side secret.
4. Your backend returns only the safe result required by the client.

## 11. AI coding assistants

When asking an AI coding assistant to integrate BWM Mail API, provide the official documentation and API reference URLs. Instruct it to use only documented endpoints and fields, preserve the existing project architecture, keep secrets server-side, add error handling, and include a test plan. Review generated code before deploying.

## Important endpoint note

The live API reference and application router must remain aligned. This guide intentionally documents only the confirmed single-send route. Do not rely on a bulk-send example until the bulk endpoint path is reconciled in the product source and hosted API reference.

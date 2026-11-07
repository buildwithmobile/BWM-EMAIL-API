# BWM Mail API — Code Examples

Copy-ready starter examples for integrating BWM Mail API from common backend environments.

## Before you start

1. Create a BWM Mail API project and generate an API key.
2. Confirm the current endpoint, required fields, template variables, and account settings in the [API reference](https://bwmemailapi.ct.ws/api-reference).
3. Keep the API key on your server. Never put it in browser JavaScript, an Android APK, a public repository, a URL query string, or an AI prompt.
4. Replace every placeholder before running an example.

## Examples

| Environment | File |
|---|---|
| cURL | [send-email.sh](curl/send-email.sh) |
| PHP 8+ | [send-email.php](php/send-email.php) |
| Node.js 18+ | [send-email.mjs](node/send-email.mjs) |
| Python 3.9+ | [send_email.py](python/send_email.py) |
| Laravel | [BwmMailService.php](laravel/BwmMailService.php) |
| PHP webhook verification | [verify-php.php](webhooks/verify-php.php) |

## API request shape used by the send examples

The examples use the documented `POST /api/v1/send` route with Bearer authentication and a JSON body. The custom HTML example uses `to`, `subject`, and `html`; optional fields and built-in template variables must be checked against the live API reference.

A successful API acceptance response does not necessarily mean the message has reached the recipient's inbox.

## Configuration

Set these values in your local environment or secret manager:

```env
BWM_MAIL_API_URL=https://YOUR_BWM_MAIL_API_HOST/api/v1/send
BWM_MAIL_API_KEY=YOUR_API_KEY
```

Do not commit real credentials. Rotate any key that has been exposed.

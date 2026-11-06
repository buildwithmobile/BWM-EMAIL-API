# Security Best Practices

These recommendations apply when integrating BWM Mail API into an application.

## Protect API credentials

- Store API keys only in server-side environment variables or a secrets manager.
- Never hardcode production keys in source code.
- Never expose keys in frontend JavaScript, Android/iOS application packages, public logs, screenshots, issue reports, or query strings.
- Do not send a real API key to an AI assistant or include it in a prompt. Use placeholders such as `YOUR_API_KEY`.
- Rotate credentials if exposure is suspected.

## Protect account workflows

For OTP, email verification, and password-reset workflows:

- Generate and validate tokens on the server.
- Set short expiry periods and enforce attempt limits.
- Make tokens single-use where appropriate.
- Avoid revealing whether an account exists in public-facing responses.
- Do not log OTP values, reset tokens, or full credential-bearing requests.
- Trigger confirmation emails only after the related action has been successfully completed.

## Webhook verification

If your account uses webhooks, verify the signature exactly as described in the current official documentation. Use the raw request body and the documented signing secret/header/algorithm. Reject invalid signatures and protect against replay where supported.

## Production checklist

- Use HTTPS.
- Keep development and production credentials separate when possible.
- Validate recipient and message input on the server.
- Apply application-level authorization and abuse controls.
- Handle API errors without exposing secrets or internal stack traces.
- Monitor usage and investigate unexpected spikes.
- Review the current [API reference](https://bwmemailapi.ct.ws/api-reference) and [security-related documentation](https://bwmemailapi.ct.ws/documentation) before release.

Report suspected vulnerabilities privately using the contact details on https://bwmemailapi.ct.ws/contact.

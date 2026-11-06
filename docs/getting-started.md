# Getting Started with BWM Mail API

This guide outlines the setup workflow. Exact endpoint paths, authentication headers, and payload fields must be copied from the current [official API reference](https://bwmemailapi.ct.ws/api-reference).

## 1. Create an account and project

1. Open https://bwmemailapi.ct.ws/.
2. Sign in or create an account.
3. Create a project in the dashboard.
4. Generate an API key for that project.

Dashboard labels and account options may change; follow the current interface.

## 2. Choose a delivery configuration

BWM Mail API documentation describes own-email configuration (including supported Gmail/Outlook workflows) and managed delivery options. Availability and requirements can depend on the account and current product configuration.

Review the official [documentation](https://bwmemailapi.ct.ws/documentation) and [features](https://bwmemailapi.ct.ws/features) pages before choosing a delivery method.

## 3. Store credentials safely

- Keep API keys in server-side environment variables or a secret manager.
- Never place a live key in frontend JavaScript, mobile app bundles, public repositories, screenshots, or URLs.
- Use separate credentials for development and production when the dashboard supports it.
- Rotate a key immediately if it may have been exposed.

Example environment variable name (use your own secret value):

```env
BWM_MAIL_API_KEY=YOUR_API_KEY
```

This is a configuration example, not an API request.

## 4. Make your first request

Open the [API reference](https://bwmemailapi.ct.ws/api-reference) and confirm all of the following before writing a request:

- Base URL and endpoint path
- HTTP method
- Authentication header format
- Content type
- Required and optional request fields
- Response schema and success status
- Error response format and rate limits

Use the exact sample from the live reference. Do not infer a send endpoint or payload from another email provider's API.

## 5. Test before production

1. Start with a test project or test recipient.
2. Verify successful delivery and inspect the API response.
3. Test invalid credentials and malformed input.
4. Confirm your application handles timeouts and API errors safely.
5. Monitor usage and delivery status using the features available in your dashboard.

## Related links

- [Official documentation](https://bwmemailapi.ct.ws/documentation)
- [API reference](https://bwmemailapi.ct.ws/api-reference)
- [Integration guides](https://bwmemailapi.ct.ws/integration-guides)
- [FAQ](https://bwmemailapi.ct.ws/faq)

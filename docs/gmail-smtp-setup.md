# Gmail SMTP setup (free delivery option)

Use this guide to connect a Gmail or Google account to the **Own SMTP** configuration in BWM Mail API. Gmail SMTP can be used without buying a separate SMTP service, but Google applies account, recipient, and anti-abuse limits. It is not an unlimited bulk-email service and delivery to inboxes is not guaranteed.

> **Important:** Google recommends Sign in with Google / OAuth where supported. App passwords are a compatibility option for apps that cannot use OAuth. Availability depends on your Google Account settings. See [Google's App Password help](https://support.google.com/mail/answer/185833).

## 1. Prepare a Gmail account

1. Choose a dedicated Gmail account for application emails rather than your personal inbox.
2. Sign in to that Google account.
3. Open [Google Account Security](https://myaccount.google.com/security).
4. Under **How you sign in to Google**, open **2-Step Verification**.
5. Follow Google's prompts and turn on 2-Step Verification.
6. After it is enabled, open [App passwords](https://myaccount.google.com/apppasswords).
7. If prompted, sign in again.
8. Create an app password. If Google asks for an app/device name, choose **Other (custom name)** and enter a label such as `BWM Mail API SMTP`.
9. Generate the password and copy the 16-character value. Google displays it only at creation time.

If App passwords is missing, Google says this can happen when 2-Step Verification is configured only with security keys, the account is managed by a work/school/organisation, or Advanced Protection is enabled. Do not try to bypass those account protections; use an OAuth-supported connection or another SMTP provider instead.

## 2. Enter the Gmail SMTP details in BWM Mail API

Open your BWM Mail API dashboard and navigate to the **Own SMTP** configuration for the project/email identity you want to use. Enter the following standard Gmail SMTP settings in the matching fields:

| BWM Own SMTP field | Value |
|---|---|
| SMTP Host / Server | `smtp.gmail.com` |
| SMTP Port | `465` for SSL/TLS, or `587` for STARTTLS |
| Encryption | SSL/TLS for port 465; STARTTLS/TLS for port 587 |
| SMTP Username | Your complete Gmail address |
| SMTP Password | The 16-character Google App Password |
| From Email | The same Gmail address, unless BWM explicitly supports a verified alias |
| From Name | Your app, website, or sender name |

Use one matching port/encryption pair. Google's documented settings are `smtp.gmail.com:465` with implicit SSL/TLS or `smtp.gmail.com:587` with STARTTLS. Do not enable both encryption modes at once.

**Password handling:** Paste the app password, not your normal Google password. Remove any visual spaces Google may show between groups of characters. Never add the app password to frontend JavaScript, a public GitHub repository, screenshots, support tickets, or an AI prompt.

Save the configuration. If BWM provides a **Test SMTP** or **Send test email** action, use it with an inbox you control and confirm the result before using the connection in production.

## 3. Test and troubleshoot

- **Authentication failed:** Confirm the full Gmail address is the username and the generated App Password is being used. Re-create the app password if it was revoked.
- **App passwords unavailable:** Check Google's eligibility notes above. Use an OAuth connection if BWM supports it, or choose another SMTP service.
- **Connection timeout:** Check that the hosting provider allows outbound SMTP on port 465 or 587. Some shared hosts block outbound SMTP.
- **TLS/SSL error:** Match port 465 with implicit SSL/TLS, or port 587 with STARTTLS.
- **Sender rejected:** Use the authenticated Gmail address as the From address unless you have configured and verified a supported Gmail alias.
- **Messages land in spam or are rejected:** Review the content, recipient consent, sending pattern, Google account limits, and recipient-domain policies. SMTP acceptance does not guarantee inbox placement.

## 4. Important limits and security notes

- Gmail SMTP is subject to Google's sending limits and anti-abuse systems. Limits can change and differ by account type; check Google's current guidance before estimating capacity.
- Do not use a personal Gmail account for high-volume or critical transactional traffic. Consider a dedicated domain and a transactional email provider as volume and reliability requirements grow.
- Use this connection only for legitimate, expected transactional email. Do not send unsolicited bulk mail.
- Restrict who can view or edit Own SMTP credentials in BWM.
- If an app password is exposed, revoke it in your Google Account and generate a replacement.
- If you change your Google Account password, Google may revoke existing app passwords; create a new one and update BWM.

## Official references

- [Google: Sign in with app passwords](https://support.google.com/mail/answer/185833)
- [Google: Turn on 2-Step Verification](https://support.google.com/mail/answer/185839)
- [Google for Developers: Gmail IMAP, POP, and SMTP server settings](https://developers.google.com/workspace/gmail/imap/imap-smtp)
- [BWM Mail API dashboard](https://bwmemailapi.ct.ws/)
- [BWM Mail API documentation](https://bwmemailapi.ct.ws/documentation)

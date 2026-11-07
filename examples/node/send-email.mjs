// Node.js 18+ (server-side only). Never run this in browser code.
const endpoint = process.env.BWM_MAIL_API_URL;
const apiKey = process.env.BWM_MAIL_API_KEY;

if (!endpoint || !apiKey) {
  throw new Error("Set BWM_MAIL_API_URL and BWM_MAIL_API_KEY first.");
}

const response = await fetch(endpoint, {
  method: "POST",
  headers: {
    Authorization: `Bearer ${apiKey}`,
    "Content-Type": "application/json",
    Accept: "application/json",
  },
  body: JSON.stringify({
    to: "recipient@example.com",
    subject: "BWM Mail API test",
    html: "<h1>Hello!</h1><p>This is a test email.</p>",
  }),
  signal: AbortSignal.timeout(30000),
});

const responseText = await response.text();
let result;
try {
  result = JSON.parse(responseText);
} catch {
  result = responseText;
}

if (!response.ok) {
  throw new Error(`BWM Mail API HTTP ${response.status}: ${responseText}`);
}

console.log(result);

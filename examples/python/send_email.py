"""Python 3.9+ example. Install dependency: python -m pip install requests"""
import json
import os
import requests

endpoint = os.environ.get("BWM_MAIL_API_URL")
api_key = os.environ.get("BWM_MAIL_API_KEY")

if not endpoint or not api_key:
    raise RuntimeError("Set BWM_MAIL_API_URL and BWM_MAIL_API_KEY first.")

payload = {
    "to": "recipient@example.com",
    "subject": "BWM Mail API test",
    "html": "<h1>Hello!</h1><p>This is a test email.</p>",
}

response = requests.post(
    endpoint,
    headers={
        "Authorization": f"Bearer {api_key}",
        "Content-Type": "application/json",
        "Accept": "application/json",
    },
    json=payload,
    timeout=30,
)

try:
    result = response.json()
except ValueError:
    result = response.text

if not response.ok:
    raise RuntimeError(
        f"BWM Mail API returned HTTP {response.status_code}: "
        f"{json.dumps(result, ensure_ascii=False)}"
    )

print(json.dumps(result, indent=2, ensure_ascii=False))

#!/usr/bin/env sh
set -eu

: "${BWM_MAIL_API_URL:?Set BWM_MAIL_API_URL to the documented send endpoint}"
: "${BWM_MAIL_API_KEY:?Set BWM_MAIL_API_KEY in your environment}"

curl --fail-with-body --silent --show-error \
  --request POST "$BWM_MAIL_API_URL" \
  --header "Authorization: Bearer $BWM_MAIL_API_KEY" \
  --header "Content-Type: application/json" \
  --data '{
    "to": "recipient@example.com",
    "subject": "BWM Mail API test",
    "html": "<h1>Hello!</h1><p>This is a test email.</p>"
  }'

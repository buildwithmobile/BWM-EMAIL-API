<?php
declare(strict_types=1);

// Webhook signature verification starter.
// Confirm the exact signing secret, signature encoding, and headers in your
// BWM Mail API account documentation before using this in production.

$rawBody = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_BWM_SIGNATURE'] ?? '';
$secret = getenv('BWM_WEBHOOK_SECRET');

if ($rawBody === false || $secret === false || $secret === '' || $signature === '') {
    http_response_code(400);
    exit('Missing webhook body, signature, or configured secret.');
}

// The documented integration uses HMAC-SHA256 over the raw request body.
// If the provider specifies a prefix/encoding format, normalize it exactly
// as documented before comparing.
$expected = hash_hmac('sha256', $rawBody, $secret);

if (!hash_equals($expected, $signature)) {
    http_response_code(401);
    exit('Invalid webhook signature.');
}

$event = json_decode($rawBody, true);
if (!is_array($event)) {
    http_response_code(400);
    exit('Invalid JSON payload.');
}

// TODO: Validate the documented event type and process idempotently.
// Store the event/message identifier so retries do not duplicate side effects.
// Do not trust event fields until signature verification succeeds.

http_response_code(200);
header('Content-Type: application/json');
echo json_encode(['received' => true]);

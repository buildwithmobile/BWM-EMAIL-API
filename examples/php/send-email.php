<?php
declare(strict_types=1);

// PHP 8+ with the cURL extension.
// Set BWM_MAIL_API_URL and BWM_MAIL_API_KEY in the server environment.

$endpoint = getenv('BWM_MAIL_API_URL');
$apiKey = getenv('BWM_MAIL_API_KEY');

if (!$endpoint || !$apiKey) {
    throw new RuntimeException('Missing BWM_MAIL_API_URL or BWM_MAIL_API_KEY.');
}

$payload = [
    'to' => 'recipient@example.com',
    'subject' => 'BWM Mail API test',
    'html' => '<h1>Hello!</h1><p>This is a test email.</p>',
];

$ch = curl_init($endpoint);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
        'Accept: application/json',
    ],
    CURLOPT_POSTFIELDS => json_encode($payload, JSON_THROW_ON_ERROR),
]);

$response = curl_exec($ch);
$status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    throw new RuntimeException('Request failed: ' . $error);
}
curl_close($ch);

$data = json_decode($response, true);
if ($status < 200 || $status >= 300) {
    throw new RuntimeException('BWM Mail API returned HTTP ' . $status . ': ' . $response);
}

echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;

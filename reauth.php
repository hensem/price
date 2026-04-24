<?php
// ONE-TIME USE: Re-authenticate with Azure to get a fresh refresh token.
// DELETE THIS FILE after use.

$clientId     = '657546db-e614-41a9-85cd-f9a9792ccf1d';
$clientSecret = '1pC8Q~zc5w2EZ-D8unCUJuPrcgJzy6hzjEtGoa9O';
$tenantId     = '2f4cdd0f-69e9-437b-9fb9-a8f7d2fdc95d';
$redirectUri  = 'https://rumah.kuceng.my/price/reauth.php';
$tokenFile    = __DIR__ . '/../../config/refresh_token_azure.txt';

// Step 2: Exchange code for tokens
if (isset($_GET['code'])) {
    $url  = "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/token";
    $data = http_build_query([
        'client_id'     => $clientId,
        'client_secret' => $clientSecret,
        'grant_type'    => 'authorization_code',
        'code'          => $_GET['code'],
        'redirect_uri'  => $redirectUri,
        'scope'         => 'https://graph.microsoft.com/.default offline_access',
    ]);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $data,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    $token = json_decode($response, true);

    if (!isset($token['refresh_token'])) {
        echo '<pre>ERROR: No refresh token returned. Response:<br>' . htmlspecialchars($response) . '</pre>';
        exit;
    }

    file_put_contents($tokenFile, $token['refresh_token']);
    echo '<p style="color:green;font-weight:bold;">✅ Success! Refresh token saved. You can now delete this file.</p>';
    exit;
}

// Step 1: Redirect to Microsoft login
$authUrl = "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/authorize?"
    . http_build_query([
        'client_id'     => $clientId,
        'response_type' => 'code',
        'redirect_uri'  => $redirectUri,
        'scope'         => 'https://graph.microsoft.com/.default offline_access',
        'prompt'        => 'consent',
    ]);

header('Location: ' . $authUrl);
exit;

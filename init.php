<?php
// init.php - shared PHP logic for price app
require_once '../../config/config_price.php';

// Security Headers (must be sent BEFORE any output)
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: interest-cohort=()');

// Regenerate CSRF token every 30 minutes
if (!isset($_SESSION['csrf']) || $_SESSION['csrf_time'] < time() - 1800) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
    $_SESSION['csrf_time'] = time();
}

$login_button = '';

if (!isLoggedIn() && isset($_GET["code"])) {
    // Verify state parameter for CSRF protection
    if (!isset($_GET['state']) || !isset($_SESSION['oauth_state']) || $_GET['state'] !== $_SESSION['oauth_state']) {
        header('Location: index.php?error=invalid_state');
        exit();
    }
    unset($_SESSION['oauth_state']);
    if (isset($_SESSION['oauth_code_used'])) {
        header('Location: index.php');
        exit();
    }
    $_SESSION['oauth_code_used'] = true;
    $token = $google_provider->getAccessToken('authorization_code', ['code' => $_GET['code']]);
    if (!$token->getToken()) {
        header('Location: index.php?error=token_exchange_failed');
        exit();
    }
    session_regenerate_id(true);
    $_SESSION['access_token'] = $token->getToken();
    if ($token->getRefreshToken()) {
        $_SESSION['refresh_token'] = $token->getRefreshToken();
    }
    $_SESSION['token_expires'] = $token->getExpires();
    $user = $google_provider->getResourceOwner($token);
    if (!$user->getEmail()) {
        session_destroy();
        header('Location: index.php?error=invalid_user');
        exit();
    }
    $_SESSION['user_first_name'] = $user->getFirstName() ?? '';
    $_SESSION['user_last_name'] = $user->getLastName() ?? '';
    $_SESSION['user_email_address'] = $user->getEmail();
    $_SESSION['user_image'] = $user->getAvatar() ?? '';
    unset($_SESSION['oauth_code_used']);
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
    $_SESSION['csrf_time'] = time();
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit();
}

if (!isLoggedIn()) {
    $state = bin2hex(random_bytes(16));
    $_SESSION['oauth_state'] = $state;
    $authUrl = $google_provider->getAuthorizationUrl(['state' => $state]);
    $login_button = '<a href="' . htmlspecialchars($authUrl) . '"><img src="img/sign-in-with-google.png" alt="Sign in with Google" /></a>';
}

<?php
session_start();

/**
 * 1. Unset all session variables
 */
$_SESSION = [];

/**
 * 2. Explicitly remove OAuth-related keys
 */
unset(
    $_SESSION['access_token'],
    $_SESSION['refresh_token'],
    $_SESSION['token_expires'],
    $_SESSION['oauth_code'],
    $_SESSION['user_first_name'],
    $_SESSION['user_last_name'],
    $_SESSION['user_email_address'],
    $_SESSION['user_image']
);

/**
 * 3. Destroy the session
 */
session_destroy();

/**
 * 4. Delete session cookie (important)
 */
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

/**
 * 5. Redirect cleanly
 */
header('Location: .');
exit;

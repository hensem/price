<?php
require_once 'init.php';

// Prepare template variables
$template_vars = [
    'login_button' => $login_button,
    'user_image' => $_SESSION['user_image'] ?? '',
    'user_name' => ($_SESSION['user_first_name'] ?? '') . ' ' . ($_SESSION['user_last_name'] ?? ''),
    'user_email' => $_SESSION['user_email_address'] ?? '',
    'csrf_token' => $_SESSION['csrf'] ?? '',
    'contributor' => $contributor ?? [],
    'current_year' => date('Y')
];

// Include the template
include 'template.php';
?>
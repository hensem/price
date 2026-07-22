<?php
ob_start();
require_once __DIR__ . '/../../config/config_price.php';

if ($_SERVER['HTTP_HOST'] !== PRICE_ALLOWED_HOST) {
    echo 'This is a private server. If you come here by mistake, go away.';
    exit;
}

require_once 'init.php';

// Turnstile gate — verify POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cf-turnstile-response'])) {
    $token    = $_POST['cf-turnstile-response'];
    $redirect = $_POST['redirect'] ?? '/';

    $ch = curl_init('https://challenges.cloudflare.com/turnstile/v0/siteverify');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => http_build_query([
            'secret'   => PRICE_CF_SECRET_KEY,
            'response' => $token,
            'remoteip' => $_SERVER['REMOTE_ADDR'],
        ]),
    ]);
    $result = json_decode(curl_exec($ch), true);
    curl_close($ch);

    if ($result['success'] ?? false) {
        $_SESSION['price_human'] = time();
        ob_end_clean();
        echo '<!DOCTYPE html><html><head></head><body><script>window.location.replace(' . json_encode($redirect) . ');</script></body></html>';
        exit;
    }
    $error = true;
}

// Show gate if not verified
if (empty($_SESSION['price_human']) || $_SESSION['price_human'] < time() - 3600) {
    ob_end_clean();
    $redirect = $_SERVER['REQUEST_URI'];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Price</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
  <script>function onVerified() { document.getElementById('gate-form').submit(); }</script>
</head>
<body class="min-h-screen flex items-center justify-center">
  <div class="text-center space-y-6">
    <?php if (!empty($error)): ?>
      <p class="text-red-400 text-sm">Verification failed. Please try again.</p>
    <?php endif; ?>
    <form method="POST" id="gate-form">
      <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>" />
      <div class="cf-turnstile" data-sitekey="<?= PRICE_CF_SITE_KEY ?>" data-theme="light" data-callback="onVerified"></div>
      <noscript><p class="text-gray-400 text-sm mt-2">JavaScript is required to verify.</p></noscript>
    </form>
  </div>
</body>
</html>
    <?php
    exit;
}

ob_end_clean();

$template_vars = [
    'login_button' => $login_button,
    'user_image'   => $_SESSION['user_image'] ?? '',
    'user_name'    => ($_SESSION['user_first_name'] ?? '') . ' ' . ($_SESSION['user_last_name'] ?? ''),
    'user_email'   => $_SESSION['user_email_address'] ?? '',
    'csrf_token'   => $_SESSION['csrf'] ?? '',
    'contributor'  => $contributor ?? [],
    'current_year' => date('Y')
];

include 'template.php';
?>

<?php

if (!isset($_SESSION['user'])) {
    header('Location: /');
}

// https://www.php.net/manual/en/function.session-destroy.php
$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}

session_destroy();

header('Location: /');
exit;
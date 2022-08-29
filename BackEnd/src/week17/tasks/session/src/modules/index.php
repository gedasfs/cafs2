<?php

if (isset($_SESSION['user'])) {
    header('Location: /?module=home');
    exit;
}

$title = 'Index';

$component = 'loginForm.phtml';

require_once ROOT_PATH . '/views/module.phtml';
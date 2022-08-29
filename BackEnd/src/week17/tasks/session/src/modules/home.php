<?php

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit;
}

$title = 'Homepage';
$username = $_SESSION['user']['username'];
$lastLogin = $_SESSION['user']['lastLogin'];

$component = 'homePage.phtml';

require_once ROOT_PATH . '/views/module.phtml';
<?php

if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit;
}

$title = 'Location';
$username = $_SESSION['user']['username'];
$location = $_SESSION['user']['location'];
$address = sprintf('%s %s, %s', $location['street']['name'], $location['street']['number'], $location['city']);
$postcode = $location['postcode'];
$state = $location['state'];
$country = $location['country'];
$coordinates = $location['coordinates'];

$component = 'locationPage.phtml';

require_once ROOT_PATH . '/views/module.phtml';
<?php

define('SEARCH_INPT_NAME', 'search_inpt');
define('MAX_TIME', 10*60);  // seconds
define('MAX_REQUESTS', 10);

$errors = [];
$url = $_POST[SEARCH_INPT_NAME] ?? null;


if (!$_POST[SEARCH_INPT_NAME]) {
    $errors[SEARCH_INPT_NAME] = 'Field must not be empty.';
    ajaxResponse($errors, false, 'Input problems', 422);
}

$urlValid = validateUrl($url); 

if (!$urlValid) {
    $errors[SEARCH_INPT_NAME] = 'Invalid URL. Please check your link';
    ajaxResponse($errors, false, 'Input problems', 422);
}


$currTime = time();
$timeLeft = MAX_TIME - ($currTime - $_SESSION['firstRequestTime']);

if (!isset($_SESSION['sessionId'])) {
    $_SESSION['sessionId'] = session_id();
    $_SESSION['requestsRemaining'] = MAX_REQUESTS;
    $_SESSION['firstRequestTime'] = $currTime;
}

if ($timeLeft <= 0) {
    $_SESSION['requestsRemaining'] = MAX_REQUESTS;
    $_SESSION['firstRequestTime'] = $currTime;
}

if ($_SESSION['requestsRemaining'] == 0) {
    $errors[SEARCH_INPT_NAME] = sprintf('Maxed out requests (max %s per %s min.). Please wait another %s seconds', MAX_REQUESTS, MAX_TIME, $timeLeft);
    ajaxResponse($errors, false, 'Max requests reached', 429);
}

$response = [];
$_SESSION['requestsRemaining']--;
ajaxResponse($_POST, true, $url, 200);

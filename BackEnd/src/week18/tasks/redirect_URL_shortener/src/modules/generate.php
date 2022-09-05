<?php

define('SEARCH_INPT_NAME', 'search_inpt');

$errors = [];
$userUrl = $_POST[SEARCH_INPT_NAME] ?? null;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

if (!$_POST[SEARCH_INPT_NAME]) {
    $errors[SEARCH_INPT_NAME] = 'Field must not be empty.';
    ajaxResponse($errors, false, 'Input problems', 422);
}

$userUrlValid = validateUrl($userUrl); 

if (!$userUrlValid) {
    $errors[SEARCH_INPT_NAME] = 'Invalid URL. Please check your link';
    ajaxResponse($errors, false, 'Input problems', 422);
}


$currTime = time();
$timeLeft = (int) env('MAX_TIME') - ($currTime - $_SESSION['firstRequestTime']);

if (!isset($_SESSION['sessionId'])) {
    $_SESSION['sessionId'] = session_id();
    $_SESSION['requestsRemaining'] = env('MAX_REQUESTS');
    $_SESSION['firstRequestTime'] = $currTime;
}

if ($timeLeft <= 0) {
    $_SESSION['requestsRemaining'] = env('MAX_REQUESTS');
    $_SESSION['firstRequestTime'] = $currTime;
}

if ($_SESSION['requestsRemaining'] == 0) {
    $errors[SEARCH_INPT_NAME] = sprintf('Maxed out requests (max %s per %s min.). Please wait another %s seconds', env('MAX_REQUESTS'), env('MAX_TIME'), $timeLeft);
    ajaxResponse($errors, false, 'Max requests reached', 429);
}


do {
    $fileName = generateRandomString(5);
    $filePath = sprintf('%s/%s.%s', ROOT_PATH . env('DATA_FOLDER_PATH'), $fileName, env('FILE_EXT', 'json'));
} while (file_exists($filePath));

$redirectUrl = sprintf('http://%s/?module=redirect&code=%s', $_SERVER['HTTP_HOST'], $fileName);

$fileContent = [
    'redirectUrl' => $redirectUrl,
    'userUrl' => $userUrl,
];
// To Do: change to Exceptions
$writeResult = file_put_contents($filePath, json_encode($fileContent));

if (!$writeResult) {
    $errors['writeError'] = 'Internal Error.';
    ajaxResponse($errors, false, 'Could not write into file', 500);
}

$_SESSION['requestsRemaining']--;
$response = [
    'requestsRemaining' => $_SESSION['requestsRemaining'],
    'redirectUrl' => $redirectUrl,
    'userUrl' => $userUrl,
];

ajaxResponse($response, true, $userUrl, 200);

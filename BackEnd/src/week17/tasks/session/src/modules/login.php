<?php

if (isset($_SESSION['user'])) {
    header('Location: /?module=home');
    exit;
}


$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;


if (!$username || !$password) {
    $_SESSION['errors']['errMsg'] = 'No username or password provided.';
    $_SESSION['errors']['username'] = $username;

    header('Location: /');
    exit;
}

// $userXxxx...-> user's data from json/database
$usersDataFilePath = ROOT_PATH . env('USERS_DATAFILE_PATH');

$usersData = json_decode(file_get_contents($usersDataFilePath), true);
$usersData = $usersData['users'];

$userDataKey = array_search($username, array_column($usersData, 'username'));

if ($userDataKey === false) {
    $_SESSION['errors']['errMsg'] = 'Username not found.';

    header('Location: /');
    exit;
}


$userData = $usersData[$userDataKey];

if ($userData['password'] != $password) {
    $_SESSION['errors']['errMsg'] = 'Incorrect password.';
    $_SESSION['errors']['username'] = $username;
    $_SESSION['errors']['password'] = $password;

    header('Location: /');
    exit;
}


$_SESSION['user']['username'] = $userData['username'];
$_SESSION['user']['location'] = $userData['location'];

$_SESSION['user']['lastLogin'] = getLastLogin($userData['username']) ?? 'first login';
setLoginTime($userData['username'], date('Y-m-d H:i:s'));

header('Location: /?module=home');
exit;
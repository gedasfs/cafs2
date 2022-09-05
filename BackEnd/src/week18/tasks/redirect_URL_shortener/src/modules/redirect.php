<?php

$urlCode = $_GET['code'] ?? null;

if (!$urlCode) {
    header('Location: /');
    exit;
}

$urlFilePath = sprintf('%s/%s.%s', ROOT_PATH . env('DATA_FOLDER_PATH'), $urlCode, env('FILE_EXT', 'json'));
$urlFileContent = file_get_contents($urlFilePath);
$urlFileContent = json_decode($urlFileContent, true);

header("Location: {$urlFileContent['userUrl']}");
exit;
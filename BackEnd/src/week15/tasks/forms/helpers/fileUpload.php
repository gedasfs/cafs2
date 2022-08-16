<?php
require_once './../configs/dirs.php';

define('MAX_ALLOWED_SIZE', 5 * 1024 * 1024);    //Mb
define('ALLOWED_EXTS', ['png', 'jpg', 'jpeg']);
define('UPPLOAD_ERR_MSGS_LT', [
    1 => 'Failas per didelis. Max ' . MAX_ALLOWED_SIZE,
    2 => 'Failas per didelis.',
    3 => 'Failas nebuvo pilnai įkeltas.',
    4 => 'Failas nebuvo pasirinktas.',
    6 => 'Nerastas tmp folderis.',
    7 => 'Failo nepavyko įrašyti.',
    8 => 'Failas nebuvo įkeltas (serverio klaida).',
    9 => 'Neleistinas failo plėtinys.'
]);


function checkFileUpload($uplFile, $fileInputName) {
    $file = isset($uplFile[$fileInputName]) ? $uplFile[$fileInputName] : null;
    $result = [];

    if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
        return setError($file['error']);
    }

    $ext = getFileExt($file['name']);

    if (!in_array($ext, ALLOWED_EXTS)) {
        return setError(9);
    }

    if ($file['size'] > MAX_ALLOWED_SIZE) {
        return setError(1);
    }

    return $file;
}

function setError($errCode) {
    $result = [];

    $result['error'] = true;
    $result['errorCode'] = $errCode;
    $result['errorMsg'] = getErrorMsg($result['errorCode']);

    return $result;
}

function getFileExt($fileName) {
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $ext = strtolower($ext);

    return $ext;
}

function getErrorMsg($errCode) {
    if ($errCode != '' && $errCode > 0) {
        $errMsg = UPPLOAD_ERR_MSGS_LT[$errCode];
    } else {
        $errMsg = 'Nežinoma failo įkėlimo klaida.';
    }

    return $errMsg;
}

// https://stackoverflow.com/questions/4356289/php-random-string-generator
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

function moveUploadedFile($fileArr, $folderName) {
    $dirPath = sprintf('%s/%s', UPLOAD_DIR_FULL, $folderName);

    if (!is_dir($dirPath)) {
        mkdir($dirPath, 0777, TRUE);

        // https://stackoverflow.com/questions/3997641/why-cant-php-create-a-directory-with-777-permissions
        // https://www.php.net/manual/en/function.umask.php
        // https://www.php.net/manual/en/function.chmod.php
        chmod($dirPath, 0777);      // mkdir does not set perm. to 0777 due to umask: 0777 - 022 (umask) = 0755 --> should change umask, but not recommended --> changing perm. manually
    }

    $ext = getFileExt($fileArr['name']);

    do {
        $fileName = generateRandomString();
        $fileName .= sprintf('.%s', $ext);
        $filePath = sprintf('%s/%s', $dirPath, $fileName);
    } while (file_exists($filePath));

    $moveResult = move_uploaded_file($fileArr['tmp_name'], $filePath);

    if ($moveResult) {
        chmod($filePath, 0777);
        $downloadFilePath = sprintf('..%s/%s/%s', UPLOAD_DIR, $folderName, $fileName);
    } else {
        $downloadFilePath = 'path_to_default_img';
    }

    return $downloadFilePath;
}
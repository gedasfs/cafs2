<?php
require_once './../configs/index_form_vars.php';
require_once './../helpers/fileUpload.php';

$messages = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $photo = checkFileUpload($_FILES, 'profile_photo');
    

    if ((!isset($_POST['name']) || $_POST['name'] == '') || (!isset($_POST['lastname']) || $_POST['lastname'] == '')) {
        $messages['error'] = true;
        $messages['msgStr'] = 'Būtina užpildyti vardo ir pavardės laukelius.';
    } elseif (!isset($_POST['coding_lang']) || !count($_POST['coding_lang'])) {
        $messages['error'] = true;
        $messages['msgStr'] = 'Būtina pasirinkti bent vieną programavimo kalbą.';
    } elseif (isset($photo['error']) && $photo['error']) {
        $messages['error'] = true;
        $messages['msgStr'] = $photo['errorMsg'];
    } else {
        $messages['success'] = true;
        $photoDir = moveUploadedFile($photo, 'profile_photos');

    }
}



if (isset($messages['success'])) {
    require_once './../views/profile.phtml';
} else {
    require_once './../views/form.phtml';
}
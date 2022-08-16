<?php
require_once './../configs/index_form_vars.php';
require_once './../helpers/fileUpload.php';
require_once './../helpers/profileExportImage.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $photo = checkFileUpload($_FILES, 'profile_photo');

    if ((!isset($_POST['name']) || $_POST['name'] == '') || (!isset($_POST['lastname']) || $_POST['lastname'] == '')) {
        $response['error'] = true;
        $response['msgStr'] = 'Būtina užpildyti vardo ir pavardės laukelius.';
    } elseif (!isset($_POST['coding_lang']) || count($_POST['coding_lang']) == 0) {
        $response['error'] = true;
        $response['msgStr'] = 'Būtina pasirinkti bent vieną programavimo kalbą.';
    } elseif (isset($photo['error']) && $photo['error']) {
        $response['error'] = true;
        $response['msgStr'] = $photo['errorMsg'];
    } else {
        $response['error'] = false;
        $response['msgStr'] = 'Jūsų informacija išsaugota sėkmingai.';

        $photoDir = moveUploadedFile($photo, 'profile_photos');
        $response['profilePNGPath'] = createProfileAsPNG($_POST, $photoDir);;

    }

    echo json_encode($response);
} else {

    require_once './../views/index.phtml';
}

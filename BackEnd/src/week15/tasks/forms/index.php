<?php
    require_once './configs/index_form_vars.php';
    $messages = [];

    if (count($_POST)) {
        if (!isset($_POST['reg_form']) || $_POST['reg_form'] !== 'submitted') {
            $messages['error'] = true;
            $messages['msgStr'] = 'Neaiškus formos išsiuntimo šaltinis. Jūsų informacija nebuvo išsaugota.';
        } else {
            if ((!isset($_POST['name']) || $_POST['name'] == '') || (!isset($_POST['lastname']) || $_POST['lastname'] == '')) {
                $messages['error'] = true;
                $messages['msgStr'] = 'Būtina užpildyti vardo ir pavardės laukelius.';
            } elseif (!isset($_POST['coding_lang']) || !count($_POST['coding_lang'])) {
                $messages['error'] = true;
                $messages['msgStr'] = 'Būtina pasirinkti bent vieną programavimo kalbą.';
            } else {
                $messages['success'] = true;
                $messages['msgStr'] = 'Jūsų registracija sėkminga.';
            }
        }
    }
    

    require_once './views/index.phtml';

    if (isset($messages['success'])) {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
    }
    
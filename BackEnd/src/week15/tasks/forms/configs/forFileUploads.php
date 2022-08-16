<?php

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
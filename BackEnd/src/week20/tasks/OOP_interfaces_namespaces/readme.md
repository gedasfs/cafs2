# Namespace + Interface PHP

Žemiau pateiktas kodo pavyzdys. Reikia sukurti visas trūkstamas klases bei vieną nenurodytą interface Messenger, kuris turi privalomą metodą „send“, kurį turi implementuoti kiekvienas iš messenger‘io servisų.
 
Atkreipkite dėmesį, kad kievienas messenger‘io servisas priima skirtingo būdo parametrus konstruktoriuje.
 
Šio kodo pavyzdžio redaguoti negalima, reikia tik sukurti visas trūkstamas klases bei galima pridėti ‘require’ kad pajungti naujas klases į pagrindinį failą.
 
P.S.
Tai yra pseudo-kodas, realus siuntimo SMS ar į Facebook nereikia daryt. Kodas turi pasileisti be klaidų ir grąžinti išsiųsto pranešimo rezultatą.
`
<?php

$text = 'Hello World';

$host = 'smtp.gmail.com';
$port = 587;
$username = 'testtest@gmail.com';
$password = 'testtest';

$emailMessaenger = new Services\Messengers\EmailMessengerService($host, $username, $password);
$emailMessaenger->send('hello@nonamez.name', $text);

$smsMessager = new Services\Messengers\SmsMessengerService();
$smsMessager->send('+37061234567', $text);

$facebookAppName = 'test-name';
$facebookAppKey  = '';

$facebookConnector = new Connectors\FacebookConnector($facebookAppName, $facebookAppKey);

$facebookMessenger = new Services\Messengers\FacebookMessengerService($facebookConnector);
$facebookMessenger->send(4, $text);
`
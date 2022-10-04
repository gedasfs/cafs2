<?php

// PDO [PHP]

// Naudojant PDO ištraukite 13 naujausiu pilnamečių vartotojų.

// P.S.
// https://github.com/nonamez/CAFS2/tree/master/BackEnd/src/MySQL/2022-10-03/pdo/sql

try {

    $pdo = new PDO('mysql:host=mysql;dbname=' . getenv('MYSQL_DATABASE'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
    
    $queryGetAdmin = 'SELECT * FROM `users` WHERE `is_admin` = :is_admin';
    $isAdmin = 1;

    $stmt = $pdo->prepare($queryGetAdmin);
    $stmt->execute(['is_admin' => $isAdmin]);
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    var_dump($admins);

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
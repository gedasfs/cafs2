<?php

// PDO [PHP]

// Naudojant PDO parodykite sugrupuotus pagal lytį vartotojus.

// P.S.
// https://github.com/nonamez/CAFS2/tree/master/BackEnd/src/MySQL/2022-10-03/pdo/sql

try {

    $pdo = new PDO('mysql:host=mysql;dbname=' . getenv('MYSQL_DATABASE'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
    
    $queryGetByGender = 'SELECT `gender`, users.* FROM `users` WHERE `gender` = "Male" OR `gender` = "Female"';

    $stmt = $pdo->prepare($queryGetByGender);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);

    var_dump($users);

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
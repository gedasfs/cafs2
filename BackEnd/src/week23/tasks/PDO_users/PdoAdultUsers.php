<?php

// PDO [PHP]

// Naudojant PDO ištraukite 13 naujausiu pilnamečių vartotojų.

// P.S.
// https://github.com/nonamez/CAFS2/tree/master/BackEnd/src/MySQL/2022-10-03/pdo/sql

try {

    $pdo = new PDO('mysql:host=mysql;dbname=' . getenv('MYSQL_DATABASE'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
    
    // SELECT * FROM `users` WHERE TIMESTAMPDIFF(YEAR, `birthdate`, NOW()) > 18 ORDER BY `id` DESC LIMIT 13;

    $timeDiff = 18;
    $limitBy = 13;

    $queryNewestAdultUsers = 'SELECT * FROM `users` WHERE TIMESTAMPDIFF(YEAR, `birthdate`, NOW()) > :timeDiff';
    $queryNewestAdultUsers .= " ORDER BY `id` DESC";
    $queryNewestAdultUsers .= " LIMIT :limitBy";

    $stmt = $pdo->prepare($queryNewestAdultUsers);
    // $stmt->execute(['timeDiff' => $timeDiff, 'orderBy' => $orderBy]);
    $stmt->bindValue(':timeDiff', $timeDiff, PDO::PARAM_INT);
    $stmt->bindValue(':limitBy', $limitBy, PDO::PARAM_INT);
    $stmt->execute();
    $adultUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    var_dump($adultUsers);

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
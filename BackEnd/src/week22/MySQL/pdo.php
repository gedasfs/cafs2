<?php

// var_dump($_ENV);

try {
    $pdo = new PDO('mysql:host=mysql;dbname=' . getenv('MYSQL_DATABASE'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
    // echo $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    
    $stmt = $pdo->query('SELECT * FROM `users`');
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt = $pdo->prepare('SELECT * FROM `roles` WHERE `role` = :roleName');
    $stmt->execute(['roleName' => 'quest']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $questRoleId = $row['id'];

    // $stmt = $pdo->prepare('SELECT * FROM `users` WHERE `role_id` = :roleId');
    // $stmt->execute(['roleId' => $roleId]);
    // $quests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $quests = array_filter($users, function($user) use($questRoleId) {
        return $user['role_id'] == $questRoleId;
    });

    var_dump($quests);

    $pdo = null;

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
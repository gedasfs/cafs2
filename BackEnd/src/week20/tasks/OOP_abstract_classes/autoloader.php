<?php

spl_autoload_register(function ($className) {
    $classPath = sprintf('%s/classes/%s.php', __DIR__, $className);

    if (file_exists($classPath)) {
        require_once $classPath;
    } else {
        throw new Exception('Class file not found', 1);
    }
});
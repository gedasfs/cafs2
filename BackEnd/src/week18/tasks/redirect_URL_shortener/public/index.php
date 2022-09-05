<?php

session_start();

define('ROOT_PATH', dirname(__DIR__));

ob_start();

try {

    $envFilePath = ROOT_PATH . '/.env';

	if (file_exists($envFilePath)) {
		define('ENV', parse_ini_file($envFilePath));
	} else {
		throw new Exception('Env file not found');
    }

    require_once ROOT_PATH . '/src/helpers.php';
    require_once ROOT_PATH . '/src/router.php';

    // unset($_SESSION['errors']);

    ob_end_flush();
    
} catch (Exception $e) {
    ob_end_clean();
    
    $code = $e->getCode();
    $msg = $e->getMessage();
    $fullMsg = sprintf('Error: %s (%s)', $msg, $code);

    echo $fullMsg;
}
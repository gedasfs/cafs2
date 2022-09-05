<?php

$module = $_GET['module'] ?? 'index';

$modulePath = sprintf('%s/src/modules/%s.php', ROOT_PATH, $module);

if (is_file($modulePath)) {
	require_once $modulePath;
} else {
	throw new Exception('Module not found', 404);
}
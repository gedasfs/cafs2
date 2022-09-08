<?php

$module = $_GET['module'] ?? 'index';
$code = $_GET['code'] ?? null;

if ($code) {
	$module = 'redirect';
}
$modulePath = sprintf('%s/src/modules/%s.php', ROOT_PATH, $module);

if (is_file($modulePath)) {
	require_once $modulePath;
} else {
	throw new Exception('Module not found', 404);
}
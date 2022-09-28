<?php

if (!function_exists('env')) {
	function env($name, $default = FALSE) {
		return isset($_ENV[$name]) ? $_ENV[$name] : $default;
	}
} else {
	throw new Exception('Env function exist');
}

if (!function_exists('asset')) {
	function asset($asset) {
		$manifestPath = ROOT_PATH . '/public/mix-manifest.json';

		if (!is_file($manifestPath)) {
			throw new Exception('Manifest file not found', 500);
		}

		$manifest = file_get_contents($manifestPath);
		$manifest = json_decode($manifest, TRUE);

		if (array_key_exists($asset, $manifest)) {
			return $manifest[$asset];
		} else {
			throw new Exception('Asset in manifest file not found', 500);
		}

		return $asset;
	}
}

if (!function_exists('ajaxResponse')) {
	function ajaxResponse($data = NULL, bool $status = TRUE, string $message = NULL,  int $httpResponseCode = 200)
	{
		$data = [
			'data'    => $data,
			'status'  => $status,
			'message' => $message,
		];

		header('Content-type: application/json');

		http_response_code($httpResponseCode);

		echo json_encode($data);

		exit;
	}
}

if (!function_exists('generateRandomString')) {
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}

if (!function_exists('view')) {
	function view(string $name, array $params = [])
	{
		extract($params);
		
		require_once ROOT_PATH . "/views/{$name}.phtml";
	}
}
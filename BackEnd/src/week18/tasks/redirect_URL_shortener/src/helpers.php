<?php

if (!function_exists('env')) {
	function env(string $key, string $default = null): string
	{
		if (array_key_exists($key, ENV)) {
			return ENV[$key];
		}

		return $default;
	}
}

if (!function_exists('asset')) {
	function asset(string $asset): string
	{
		$manifestPath = ROOT_PATH . '/public/mix-manifest.json';

		if (!is_file($manifestPath)) {
			throw new Exception('Manifest file not found', 500);
		}

		$manifest = file_get_contents($manifestPath);
		$manifest = json_decode($manifest, TRUE);

		if (is_array($manifest) && array_key_exists($asset, $manifest)) {
			return $manifest[$asset];
		}

		throw new Exception('Asset in manifest file not found', 500);
	}
}

if (!function_exists('generateRandomString')) {
	// https://stackoverflow.com/questions/4356289/php-random-string-generator
	function generateRandomString(int $length = 5): string
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;
	}
}

if (!function_exists('ajaxResponse')) {
	function ajaxResponse($content = null, bool $status = true, string $msg = null, int $httpResponseCode = 200): void
	{

		$data = [
			'content' => $content,
			'status' => $status,
			'msg' => $msg,
			'httpResponseCode' => $httpResponseCode
		];

		header('Content-type: application/json');
		http_response_code($httpResponseCode);

		echo json_encode($data);

		exit;
	}
}

if (!function_exists('validateUrl')) {
	function validateUrl(string $url): bool
	{
		// https://uibakery.io/regex-library/url-regex-php
		$urlRegex = '/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/';

		return preg_match($urlRegex, $url);
	}
}

if (!function_exists('getViewComponents')) {
	function getViewComponents(array $components): string
	{
		ob_start();
		foreach ($components as $component) {
			require ROOT_PATH . '/views/components/' . $component;
		}
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}
}
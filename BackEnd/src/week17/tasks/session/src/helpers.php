<?php

if (!function_exists('env')) {
	function env($key, $default = NULL)
	{
		if (array_key_exists($key, ENV)) {
			return ENV[$key];
		}

		return $default;
	}
}

if (!function_exists('getLastLogin')) {
    function getLastLogin($username) {
        $logsDirPath = ROOT_PATH . env('USERS_LOGIN_LOGS_DIR');
        $userLogFilePath = sprintf('%s/%s.log',$logsDirPath, $username);

        if (is_file($userLogFilePath)) {
            $result = file_get_contents($userLogFilePath);
        } else {
            $result = null;
        }

        return $result;
    }
} 

if (!function_exists('setLoginTime')) {
    function setLoginTime($username, $time) {
        $logsDirPath = ROOT_PATH . env('USERS_LOGIN_LOGS_DIR');
        $userLogFilePath = sprintf('%s/%s.log',$logsDirPath, $username);

        $result = file_put_contents($userLogFilePath, $time);

        return $result;
    }
}
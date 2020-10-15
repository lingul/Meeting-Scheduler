<?php
class Config {

	public static function get($path = null){
		if ($path) {
			$config = $GLOBALS['config'];
			$path = explode('/',$path);
			foreach ($path as $key) {
				if (array_key_exists($key, $config)) {
					$config = $config[$key];
				} else {
				  return false;
        }
			}
			return $config;
		}

		return false;
	}
}

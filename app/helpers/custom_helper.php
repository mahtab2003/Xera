<?php

define("HASH_SALT", "xera_salt");

if (!function_exists('char64')) {
	function char64($string)
	{
		$hash = $string;
		for ($i = 0; $i < 25; $i++) {
			$hash = hash(HASH_ALGO_64, $hash . ':' . HASH_SALT);
		}
		return $hash;
	}
}

if (!function_exists('char32')) {
	function char32($string)
	{
		$hash = $string;
		for ($i = 0; $i < 25; $i++) {
			$hash = hash(HASH_ALGO_32, $hash . ':' . HASH_SALT);
		}
		return $hash;
	}
}

if (!function_exists('char16')) {
	function char16($string)
	{
		$hash = $string;
		for ($i = 0; $i < 25; $i++) {
			$hash = hash(HASH_ALGO_16, $hash . ':' . HASH_SALT);
		}
		return $hash;
	}
}

if (!function_exists('char8')) {
	function char8($string)
	{
		$hash = $string;
		for ($i = 0; $i < 25; $i++) {
			$hash = hash(HASH_ALGO_8, $hash . ':' . HASH_SALT);
		}
		return $hash;
	}
}

if (!function_exists('remap_array')) {
	function remap_array($prefix, $array)
	{
		if (is_array($array)) {
			foreach (array_keys($array) as $arr) {
				$data[$prefix . $arr] = $array[$arr];
			}
			return $data;
		}
		return false;
	}
}

if (!function_exists('get_languages')) {
	function get_languages()
	{
		$dirs = scandir(APPPATH . 'language');
		$langs = [];
		foreach ($dirs as $lang) {
			if ($lang !== '.' and $lang !== '..' and $lang !== 'index.html') {
				$langs[] = ['name' => str_replace('-', ' ', ucfirst($lang)), 'code' => $lang];
			}
		}
		return $langs;
	}
}

if (!function_exists('get_templates')) {
	function get_templates()
	{
		$dirs = scandir(APPPATH . '../template/');
		$templates = [];
		foreach ($dirs as $dir) {
			if ($dir !== '.' and $dir !== '..' and $dir !== 'index.html' and $dir !== 'errors') {
				$templates[] = ['name' => str_replace('-', ' ', ucfirst($dir)), 'dir' => $dir];
			}
		}
		return $templates;
	}
}

if (!function_exists('get_version')) {
	function get_version()
	{
		return XERA_VERSION;
	}
}

if (!function_exists('get_tag')) {
	function get_tag()
	{
		return XERA_TAG;
	}
}

if (!function_exists('get_aff_id')) {
	function get_aff_id()
	{
		return XERA_AFFL;
	}
}

if (!function_exists('build_date')) {
	function build_date()
	{
		return XERA_DATE;
	}
}

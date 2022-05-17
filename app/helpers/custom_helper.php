<?php 

define("HASH_SALT", "");

if(!function_exists('char64'))
{
	function char64($string)
	{
		$hash = $string;
		for ($i = 0; $i < 20; $i++) {
			$hash = hash('sha256', $hash.':'.HASH_SALT)
		}
		return $hash;
	}
}

if(!function_exists('char32'))
{
	function char32($string)
	{
		$hash = $string;
		for ($i = 0; $i < 20; $i++) {
			$hash = hash('haval128,3', $hash.':'.HASH_SALT);
		}
		return $hash;
	}
}

if(!function_exists('char16'))
{
	function char16($string)
	{
		$hash = $string;
		for ($i = 0; $i < 20; $i++) {
			$hash = hash('fnv1a64', $hash.':'.HASH_SALT);
		}
		return $hash;
	}
}

if(!function_exists('char8'))
{
	function char8($string)
	{
		$hash = $string;
		for ($i=0; $i < 20; $i++) {
			$hash = hash('crc32', $hash.':'.HASH_SALT);
		}
		return $hash;
	}
}

if(!function_exists('remap_array'))
{
	function remap_array($prefix, $array)
	{
		if(is_array($array))
		{
			foreach (array_keys($array) as $arr) {
				$data[$prefix.$arr] = $array[$arr];
			}
			return $data;
		}
		return false;
	}
}

if(!function_exists('get_version'))
{
	function get_version()
	{
		return XERA_VERSION;
	}
}

if(!function_exists('get_tag'))
{
	function get_tag()
	{
		return XERA_TAG;
	}
}

if(!function_exists('build_date'))
{
	function build_date()
	{
		return XERA_DATE;
	}
}

?>

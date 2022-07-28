<?php 

class Recaptcha extends CI_Model
{
	function get_site_key()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			return $res['recaptcha_site'];
		}
		return false;
	}

	function set_site_key($key)
	{
		$res = $this->update('site', $key);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_secret_key()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			return $res['recaptcha_key'];
		}
		return false;
	}

	function set_secret_key($secret_key)
	{
		$res = $this->update('key', $secret_key);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_type()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			return $res['recaptcha_type'];
		}
		return false;
	}
	
	function set_type($key)
	{
		$res = $this->update('type', $key);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function is_active()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			if($res['recaptcha_status'] === 'active')
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function get_status()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			return $res['recaptcha_status'];
		}
		return false;
	}

	function set_status(bool $status)
	{
		if($status === true)
		{ 
			$status = 'active';
		}
		else
		{
			$status = 'inactive';
		}
		$res = $this->update('status', $status);
		if($res)
		{
			return true;
		}
		return false;
	}

	function is_valid($token, $type = "google")
	{
		if($type == "google")
		{
			$secret_key = $this->get_secret_key();
	        $res = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$token");
	        $res = json_decode($res);
	        if($res->success){
	        	return true;
	        }
	        return false;
		}
		elseif($type == "human")
		{
			$secret_key = $this->get_secret_key();
			$param = http_build_query(["secret" => $secret_key, "response" => $token]);

			$ch = curl_init("https://hcaptcha.com/siteverify");
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);

	        $res = json_decode($result);
	        if($res->success){
	        	return true;
	        }
	        return false;
		}
		elseif($type == "crypto")
		{
			$secret_key = $this->get_secret_key();
			$param = http_build_query(["CRLT-captcha-token" => $token, 'hashes' => 256, "secret" => $secret_key]);

			$ch = curl_init("https://api.crypto-loot.org/token/verify");
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);

	        $res = json_decode($result);
	        if($res->success){
	        	return true;
	        }
	        return false;
		}
        return false;
	}

	private function update($field, $value)
	{
		$res = $this->base->update(
			[$field => $value],
			['id' => 'xera_recaptcha'],
			'is_recaptcha',
			'recaptcha_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function fetch()
	{
		$res = $this->base->fetch(
			'is_recaptcha',
			['id' => 'xera_recaptcha'],
			'recaptcha_'
		);
		if(count($res) > 0)
		{
			return $res[0];
		}
		return false;
	}
}

?>
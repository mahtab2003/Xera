<?php 

class SitePro extends CI_Model
{
	function get_hostname()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			return $res['builder_hostname'];
		}
		return false;
	}

	function set_hostname($name)
	{
		$res = $this->update('hostname', $name);
		if($res)
		{
			return true;
		}
		return false;
	}

	function get_username()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			return $res['builder_username'];
		}
		return false;
	}

	function set_username($name)
	{
		$res = $this->update('username', $name);
		if($res)
		{
			return true;
		}
		return false;
	}

	function get_password()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			return $res['builder_password'];
		}
		return false;
	}

	function set_password($name)
	{
		$res = $this->update('password', $name);
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
			if($res['builder_status'] === 'active')
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
			return $res['builder_status'];
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

	function load_builder_url($username, $password, $domain, $dir = '/htdocs/')
	{
		$data_string = json_encode([
			"type" => "external",
			"username" => $username,
			"password" => $password,
			"domain" => $domain,
			"baseDomain" => $domain,
			"apiUrl" => "ftpupload.net",
			"uploadDir" => $dir
		]);
		$ch = curl_init($this->get_hostname() . '/api/requestLogin');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERPWD, $this->get_username().':'.$this->get_password());
		$headers = array(
		    'Content-type: application/json',
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		$json = json_decode($result, true);
		if(isset($json['error']))
		{
			return ['success' => false, 'msg' => $json['error']['message']];
		}
		elseif(isset($json['url'])) {
			return ['success' => true, 'url' => $json['url']];
		}
		return false;
	}

	private function update($field, $value)
	{
		$res = $this->base->update(
			[$field => $value],
			['id' => 'xera_builder'],
			'is_builder',
			'builder_'
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
			'is_builder',
			['id' => 'xera_builder'],
			'builder_'
		);
		if(count($res) > 0)
		{
			return $res[0];
		}
		return false;
	}
}

?>

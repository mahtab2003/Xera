<?php 

class Smtp extends CI_Model
{
	function get_hostname()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			return $res['smtp_hostname'];
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
			return $res['smtp_username'];
		}
		return false;
	}

	function set_username($username)
	{
		$res = $this->update('username', $username);
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
			return $res['smtp_password'];
		}
		return false;
	}

	function set_password($password)
	{
		$res = $this->update('password', $password);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_port()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			return $res['smtp_port'];
		}
		return false;
	}

	function set_port($port)
	{
		$res = $this->update('port', $port);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_from()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			return $res['smtp_from'];
		}
		return false;
	}

	function set_from($from)
	{
		$res = $this->update('from', $from);
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
			if($res['smtp_status'] === 'active')
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
			return $res['smtp_status'];
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
	
	function get_name()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			return $res['smtp_name'];
		}
		return false;
	}

	function set_name($name)
	{
		$res = $this->update('name', $name);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function update($field, $value)
	{
		$res = $this->base->update(
			[$field => $value],
			['id' => 'xera_smtp'],
			'is_smtp',
			'smtp_'
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
			'is_smtp',
			['id' => 'xera_smtp'],
			'smtp_'
		);
		if(count($res) > 0)
		{
			return $res[0];
		}
		return false;
	}
}

?>
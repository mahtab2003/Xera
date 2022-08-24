<?php 

class Oauth extends CI_Model
{
	function get_client($id)
	{
		$res = $this->fetch($id);
		if($res !== false)
		{
			return $res['oauth_client'];
		}
		return false;
	}

	function set_client($id, $client)
	{
		$res = $this->update($id, 'client', $client);
		if($res)
		{
			return true;
		}
		return false;
	}

	function get_secret($id)
	{
		$res = $this->fetch($id);
		if($res !== false)
		{
			return $res['oauth_secret'];
		}
		return false;
	}

	function set_secret($id, $secret)
	{
		$res = $this->update($id, 'secret', $secret);
		if($res)
		{
			return true;
		}
		return false;
	}

	function get_endpoint($id)
	{
		$res = $this->fetch($id);
		if($res !== false)
		{
			return $res['oauth_endpoint'];
		}
		return false;
	}

	function set_endpoint($id, $endpoint)
	{
		$res = $this->update($id, 'endpoint', $endpoint);
		if($res)
		{
			return true;
		}
		return false;
	}

	function is_active($id)
	{
		$res = $this->fetch($id);
		if($res !== false)
		{
			if($res['oauth_status'] === 'active')
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function get_status($id)
	{
		$res = $this->fetch($id);
		if($res !== false)
		{
			return $res['oauth_status'];
		}
		return false;
	}

	function set_status($id, bool $status)
	{
		if($status === true)
		{ 
			$status = 'active';
		}
		else
		{
			$status = 'inactive';
		}
		$res = $this->update($id, 'status', $status);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function update($id, $field, $value)
	{
		$res = $this->base->update(
			[$field => $value],
			['id' => $id],
			'is_oauth',
			'oauth_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function fetch($id = 'github')
	{
		$res = $this->base->fetch(
			'is_oauth',
			['id' => $id],
			'oauth_'
		);
		if(count($res) > 0)
		{
			return $res[0];
		}
		return false;
	}
}

?>
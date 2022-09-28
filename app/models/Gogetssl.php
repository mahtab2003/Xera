<?php 

class Gogetssl extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('gogetsslapi');
		$this->s = new GoGetSSLApi();
		$this->s->auth($this->get_username(), $this->get_password());
	}

	function create_ssl($csr)
	{
		$data = array(
			'product_id'       => 65,
			'csr' 			   => $csr,
		    'server_count'     => "-1",
		    'period'           => 3,
		    'approver_email'   => $this->get_username(),
		    'webserver_type'   => "1",
		    'admin_firstname'  => 'Web',
		    'admin_lastname'   => 'Host',
		    'admin_phone'      => '03000000000',
		    'admin_title'      => "Mr",
		    'admin_email'      => $this->user->get_email(),
		    'tech_firstname'   => 'Web',
		    'tech_lastname'    => 'Host',
		    'tech_phone'       => '03000000000',
		    'tech_title'       => "Mr",
		    'tech_email'       => $this->user->get_email(),
		    'org_name'         => $this->base->get_hostname(),
		    'org_division'     => "Hosting",
		    'org_addressline1' => 'Block# Area#',
		    'org_city'         => 'New York',
		    'org_country'      => 'US',
		    'org_phone'        => '03000000000',
		    'org_postalcode'   => '11001',
		    'org_region'       => "None",
		    'dcv_method'       => "dns",
		);
		$res = $this->s->addSSLOrder($data);
		if(count($res) > 4)
		{
			$key = $username = char8($this->base->get_hostname().':'.$this->user->get_email().':'.$res['order_id'].':'.time());
			$data = [
				'ssl_pid' => $res['order_id'],
				'ssl_key' => $key,
				'ssl_for' => $this->user->get_key()
			];
			$res = $this->db->insert('is_ssl', $data);
			if($res !== false)
			{
				return true;
			}
			return false;
		}
		else
		{
			if(isset($res['description']))
			{
				return $res['description'];
			}
			return false;
		}
		return false;
	}

	function get_ssl_info($key)
	{
		$res = $this->fetch(['key' => $key]);
		if($res !== [])
		{
			$data = $this->s->getOrderStatus($res[0]['ssl_pid']);
			if(count($data) > 4)
			{
				return $data;
			}
			else
			{
				if(isset($res['description']))
				{
					return $res['description'];
				}
				return false;
			}
			return false;
		}
		return false;
	}

	function get_ssl_list()
	{
		$res = $this->fetch(['for' => $this->user->get_key()]);
		if($res !== false)
		{
			$arr = [];
			if(count($res)>0)
			{
				foreach ($res as $key) {
					$data = $this->s->getOrderStatus($key['ssl_pid']);
					$data['key'] = $key['ssl_key'];
					$arr[] = $data;
				}
				return $arr;
			}
			return $arr;
		}
		return false;
	}

	function get_ssl_list_all($count = 0)
	{
		$res = $this->fetch();
		if($res !== false)
		{
			$arr = [];
			if(count($res)>0)
			{
				foreach ($res as $key) {
					$data = $this->s->getOrderStatus($key['ssl_pid']);
					$data['key'] = $key['ssl_key'];
					$arr[] = $data;
				}
				return $arr;
			}
			$list = [];
			if($count == 0)
			{
				$count = 0;
			}
			else
			{
				$count = $count * $this->base->rpp();
			}
			for ($i = $count; $i < count($arr); $i++) { 
				if($i >= $count + $this->base->rpp())
				{
					break;
				}
				else
				{
					$list[] = $arr[$i];
				}
			}
			return $list;
		}
		return false;
	}

	function list_count()
	{
		$res = $this->fetch();
		if($res !== false)
		{
			$arr = [];
			if(count($res)>0)
			{
				foreach ($res as $key) {
					$data = $this->s->getOrderStatus($key['ssl_pid']);
					$data['key'] = $key['ssl_key'];
					$arr[] = $data;
				}
			}
			return count($arr);
		}
		return false;
	}

	function cancel_ssl($key, $reason)
	{
		$res = $this->fetch(['key' => $key]);
		if($res !== false)
		{
			$data = $this->s->cancelSSLOrder($res[0]['ssl_pid'], $reason);
			if(isset($data['success']))
			{
				return true;
			}
			else
			{
				if(isset($res['description']))
				{
					return $res['description'];
				}
				return false;
			}
			return false;
		}
		return false;
	}

	function get_username()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['gogetssl_username'];
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
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['gogetssl_password'];
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
	
	function is_active()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			if($res['gogetssl_status'] === 'active')
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function get_status()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['gogetssl_status'];
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

	private function update($index, $value)
	{
		$res = $this->base->update(
			[$index => $value],
			['id' => 'xera_gogetssl'],
			'is_gogetssl',
			'gogetssl_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function fetch_base()
	{
		$res = $this->base->fetch(
			'is_gogetssl',
			['id' => 'xera_gogetssl'],
			'gogetssl_'
		);
		if(count($res) > 0)
		{
			return $res[0];
		}
		return false;
	}

	private function fetch($where = [])
	{
		$res = $this->base->fetch(
			'is_ssl',
			$where,
			'ssl_'
		);
		return $res;
	}
}

?>
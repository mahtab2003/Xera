<?php 

if(!file_exists(APPPATH.'logs/install.json'))
{
	header('location: install.php');
}
elseif(file_exists(APPPATH.'logs/install.json') AND file_exists(APPPATH.'../install.php'))
{
	unlink(APPPATH.'../install.php');
}

class Base extends CI_Model
{

	function __construct()
	{
		if(!get_cookie('lang'))
		{
			set_cookie('lang', 'english', 365 * 86400);
		}
	}

	function text($line, $filename)
	{
		$this->lang->load($filename, get_cookie('lang'));
		$res = $this->lang->line($line);
		if($res !== false)
		{
			return $res;
		}
		return '...';
	}

	function set_rpp($rpp)
	{
		$res = $this->update_base('rpp', $rpp);
		if($res)
		{
			return true;
		}
		return false;
	}

	function rpp()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['base_rpp'];
		}
		return false;
	}

	function get_hostname()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['base_name'];
		}
		return false;
	}

	function set_hostname($name)
	{
		$res = $this->update_base('name', $name);
		if($res)
		{
			return true;
		}
		return false;
	}

	function get_template()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			if(is_dir(APPPATH.'../template/'.$res['base_template']))
			{
				return $res['base_template'];
			}
			return 'default';
		}
		return false;
	}

	function set_template($template)
	{
		$res = $this->update_base('template', $template);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_email()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['base_email'];
		}
		return false;
	}

	function set_email($email)
	{
		$res = $this->update_base('email', $email);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_fourm()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['base_fourm'];
		}
		return false;
	}

	function set_fourm($fourm)
	{
		$res = $this->update_base('fourm', $fourm);
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
			if($res['base_status'] === 'active')
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
			return $res['base_status'];
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
		$res = $this->update_base('status', $status);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function fetch_base()
	{
		$res = $this->fetch('is_base', ['id' => 'xera_base']);
		if(count($res)>0)
		{
			return $res[0];
		}
		return false;
	}

	private function update_base($field, $value)
	{
		$res = $this->update(
			[$field => $value],
			['id' => 'xera_base']
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	function update($data, $where, $table = 'is_base', $prefix = 'base_')
	{
		$data = remap_array($prefix, $data);
		$where = remap_array($prefix, $where);
		$this->db->where($where);
		$this->db->set($data);
		$res = $this->db->update($table);
		if($res)
		{
			return true;
		}
		return false;
	}

	function fetch($table, $where = [], $prefix = 'base_', $data = '*')
	{
		if(count($where)>0)
		{
			$where = remap_array($prefix, $where);
		}
		$this->db->where($where);
		$this->db->select($data);
		$this->db->from($table);
		$res = $this->db->get()->result_array();
		return $res;
	}
}

?>
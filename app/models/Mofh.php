<?php 
use \InfinityFree\MofhClient\Client;

class Mofh extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mailer');
		$this->m = new Client;
		$this->m->setApiUsername($this->get_username());
		$this->m->setApiPassword($this->get_password());
		$this->m->setPlan($this->get_package());
	}

	function get_username()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['mofh_username'];
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
			return $res['mofh_password'];
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
	
	function get_cpanel()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['mofh_cpanel'];
		}
		return false;
	}

	function set_cpanel($cpanel)
	{
		$res = $this->update('cpanel', $cpanel);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_ns_1()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['mofh_ns_1'];
		}
		return false;
	}

	function set_ns_1($ns_1)
	{
		$res = $this->update('ns_1', $ns_1);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_ns_2()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['mofh_ns_2'];
		}
		return false;
	}

	function set_ns_2($ns_2)
	{
		$res = $this->update('ns_2', $ns_2);
		if($res)
		{
			return true;
		}
		return false;
	}
	
	function get_package()
	{
		$res = $this->fetch_base();
		if($res !== false)
		{
			return $res['mofh_package'];
		}
		return false;
	}

	function set_package($package)
	{
		$res = $this->update('package', $package);
		if($res)
		{
			return true;
		}
		return false;
	}

	function check_availablity($domain)
	{
		try{
			$req = $this->m->availability(['domain' => $domain]);
			$res = $req->send();
			if($res->isSuccessful() == 0 AND strlen($res->getMessage()) > 1)
			{
				return trim($res->getMessage());
			}
			elseif($res->isSuccessful() == 1 AND $res->getMessage() == 1)
			{
				return true;
			}
			elseif($res->isSuccessful() == 0 AND $res->getMessage() == 0)
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function create_account($label, $domain)
	{
		try{
			$email = $this->user->get_email();
			$username = char8($label.':'.$domain.':'.$email.':'.time());
			$password = substr(char16($username.':'.time()), 0, 15);
			$req = $this->m->createAccount([
				'username' => $username,
				'password' => $password,
				'domain' => $domain,
				'email' => $email
			]);
			$res = $req->send();
			if($res->isSuccessful() == 0 AND strlen($res->getMessage()) > 1)
			{
				return trim($res->getMessage());
			}
			elseif($res->isSuccessful() == 1 AND strlen($res->getMessage()) > 1)
			{
				$data = [
					'account_label' => $label,
					'account_username' => $res->getVpUsername(),
					'account_password' => $password,
					'account_status' => 'pending',
					'account_key' => $username,
					'account_for' => $this->user->get_key(),
					'account_time' => time(),
					'account_domain' => $domain,
					'account_main' => str_replace('cpanel', $username, $this->get_cpanel())
				];
				$res = $this->db->insert('is_account', $data);
				if($res !== false)
				{
					return true;
				}
				return false;
			}
			elseif($res->isSuccessful() == 0 AND strlen($res->getMessage()) > 0)
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function change_password($username, $password)
	{
		try{
			$req = $this->m->password([
				'username' => $username,
				'password' => $password,
				'enabledigest' => 1
			]);
			$res = $req->send();
			$data = $res->getData();
			$param = [
			        'status' => $data['passwd']['status'],
			        'message' => $data['passwd']['statusmsg']
			    ];
			if($param['status'] == 0 AND strlen($param['message']) > 1)
			{
				return trim($param['message']);
			}
			elseif($param['status'] == 1 AND strlen($param['message']) > 1)
			{
				return true;
			}
			else
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function deactivate_account($username, $reason)
	{
		try{
			$req = $this->m->suspend([
				'username' => $username,
				'reason' => $reason
			]);
			$res = $req->send();
			$data = $res->getData();
			$param = [
			        'status' => $data['result']['status'],
			        'message' => $data['result']['statusmsg']
			    ];
			if($param['status'] == 0 AND !is_array($param['message']))
			{
				return trim($param['message']);
			}
			elseif($param['status'] == 1 AND is_array($param['message']))
			{
				$data = ['status' => 'deactivating'];
				$where = ['key' => $username];
				$res = $this->base->update($data, $where, 'is_account', 'account_');
				if($res !== false)
				{
					return true;
				}
				return false;
			}
			elseif($param['status'] == 0 AND $param['message'] == 0)
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function reactivate_account($username)
	{
		try{
			$req = $this->m->unsuspend([
				'username' => $username
			]);
			$res = $req->send();
			$data = $res->getData();
			$param = [
			        'status' => $data['result']['status'],
			        'message' => $data['result']['statusmsg']
			    ];
			if($param['status'] == 0 AND !is_array($param['message']))
			{
				return trim($param['message']);
			}
			elseif($param['status'] == 1 AND is_array($param['message']))
			{
				$data = ['status' => 'reactivating'];
				$where = ['key' => $username];
				$res = $this->base->update($data, $where, 'is_account', 'account_');
				if($res !== false)
				{
					return true;
				}
				return false;
			}
			elseif($param['status'] == 0 AND $param['message'] == 0)
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function get_domains($username)
	{
		try{
			$req = $this->m->GetUserDomains([
				'username' => $username
			]);
			$res = $req->send();
			if($res->isSuccessful() == 0)
			{
				return false;
			}
			elseif($res->isSuccessful() == 1)
			{
				return $res->getDomains();
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function get_domain_user($domain)
	{
		try{
			$req = $this->m->getDomainUser([
				'domain' => $domain
			]);
			$res = $req->send();
			if($res->isSuccessful() == 0)
			{
				return false;
			}
			elseif($res->isSuccessful() == 1)
			{
				return $res->getData();
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	function list_exts(){
		$res = $this->fetch('is_domain', [], 'domain_');
		return $res;
	}

	function rm_ext($domain){
		$res = $this->db->delete('is_domain', ['domain_name' => $domain]);
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	function add_ext($domain){
		if($domain == '')
		{
			return false;
		}
		if(strpos($domain, '.') === false)
		{
			return false;
		}
		if(strpos($domain, '.') !== 0)
		{
			$domain = '.'.$domain;
		}
		$domain = strtolower($domain);
		$res = $this->db->insert('is_domain', array('domain_name' => $domain));
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	function test_mofh()
	{
		try{
			$req = $this->m->availability(['domain' => 'google.com']);
			$res = $req->send();
			if($res->isSuccessful() == 0 AND strlen($res->getMessage()) > 1)
			{
				return trim($res->getMessage());
			}
			elseif($res->isSuccessful() == 1 AND $res->getMessage() == 1)
			{
				return true;
			}
			elseif($res->isSuccessful() == 0 AND $res->getMessage() == 0)
			{
				return false;
			}
			return false;
		}
		catch(Exception $e){
			return false;
		}
	}

	private function update($field, $value)
	{
		$res = $this->base->update(
			[$field => $value],
			['id' => 'xera_mofh'],
			'is_mofh',
			'mofh_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function update_where($table, $data, $where, $prefix)
	{
		$res = $this->base->update(
			$data,
			$where,
			$table,
			$prefix
		);
		if(count($res) > 0)
		{
			return $res;
		}
		return false;
	}

	private function fetch($table, $where = [], $prefix)
	{
		$res = $this->base->fetch(
			$table,
			$where,
			$prefix
		);
		return $res;
	}

	private function fetch_base()
	{
		$res = $this->base->fetch(
			'is_mofh',
			['id' => 'xera_mofh'],
			'mofh_'
		);
		if(count($res) > 0)
		{
			return $res[0];
		}
		return false;
	}
}

?>

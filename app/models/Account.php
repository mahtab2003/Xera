<?php 

class Account extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mofh');
	}

	// -------------------------------------------------
	// File Manager Link Encoding Utilities
	// -------------------------------------------------

	/**
	 * XOR + Base64 encode password using key.
	 */
	private function fm_encode_with_key($password, $key)
	{
		if(strlen($key) === 0)
		{
			return false;
		}

		$out = '';
		$klen = strlen($key);

		for($i = 0; $i < strlen($password); $i++)
		{
			$out .= chr(ord($password[$i]) ^ ord($key[$i % $klen]));
		}

		return base64_encode($out);
	}

	/**
	 * Build FileManager URL using encoded password.
	 * Default key derived from a tested working configuration.
	 */
	public function create_fm_link($username, $password, $dir = '/htdocs/', $key = 'ERFgjowETHGj9wf')
	{
		$p_enc = $this->fm_encode_with_key($password, $key);

		$u = urlencode($username);
		$p = urlencode($p_enc);
		$home = $dir !== null && $dir !== '' ? '&home=' . urlencode($dir) : '';

		$link = "https://filemanager.ai/new3/index.php?u={$u}&p={$p}{$home}";
		return $link;
	}

	function get_accounts($count = 0)
	{
		$res = $this->fetch();
		if($res !== false)
		{
			$list = [];
			if($count != 0)
			{
				$count = $count * $this->base->rpp();
			}
			for ($i = $count; $i < count($res); $i++) { 
				if($i >= $count + $this->base->rpp())
				{
					break;
				}
				else
				{
					$list[] = $res[$i];
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
			return count($res);
		}
		return false;
	}

	function get_user_accounts()
	{
		$res = $this->fetch(['for' => $this->user->get_key()]);
		if($res !== false)
		{
			return $res;
		}
		return false;
	}

	function get_active_accounts($for)
	{
		$res = $this->fetch(['for' => $for, 'status' => 'active']);
		if($res !== false)
		{
			return count($res);
		}
		return false;
	}

	function get_account($username)
	{
		$res = $this->fetch(['username' => $username]);
		if($res !== false)
		{
			return $res[0];
		}
		return false;
	}

	function set_label($username, $label)
	{
		$res = $this->update(['label' => $label], ['username' => $username]);
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	function get_count($status = 'active')
	{
		$res = $this->base->fetch('is_account', ['status' => $status], 'account_');
		return count($res);
	}

	function change_account_password($username, $password, $old_password)
	{
		$res = $this->get_account($username);
		if($res !== false)
		{
			if($res['account_password'] === $old_password)
			{
				$res = $this->mofh->change_password($res['account_key'], $password);
				if(!is_bool($res))
				{
					return $res;
				}
				elseif($res !== false)
				{
					$data = ['password' => $password];
					$where = ['key' => $username];
					$res = $this->base->update($data, $where, 'is_account', 'account_');
					if($res !== false)
					{
						return true;
					}
					return false;
				}
				return false;
			}
			return 'Password does not match.';
		}
		return false;
	}

	function get_user_account($username)
	{
		$res = $this->fetch(['username' => $username,'for' => $this->user->get_key()]);
		if(count($res)>0)
		{
			return $res[0];
		}
		return false;
	}

	function get_domains($username, $password, $reg)
	{
		$res = $this->mofh->get_domains($username);
		if($res !== false)
		{
			$domains = [];
			if(count($res) > 0)
			{
				foreach ($res as $domain) {
					if($domain === $reg)
					{
						$dir = "/htdocs/";
					}
					else
					{
						$dir = "/$domain/htdocs/";
					}
					$link = $this->create_fm_link($username, $password, $dir);
					$domains[] = ['domain' => $domain, 'file_manager' => $link];
				}
				return $domains;
			}
			return [];
		}
		return [];
	}

	function set_sql_server($username, $server)
	{
		$data = ['sql' => $server];
		$where = ['username' => $username];
		$res = $this->update($data, $where);
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	function change_status($username, $status)
	{
		$data = ['status' => $status];
		$where = ['username' => $username];
		$res = $this->update($data, $where);
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	function delete_account($username)
	{
		$res = $this->mofh->delete_account($username);
		if($res !== false)
		{
			$this->db->where(['account_username' => $username]);
			$res = $this->db->delete('is_account');
			if($res !== false)
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function remove_account($username)
	{
		$this->db->where(['account_username' => $username]);
		$res = $this->db->delete('is_account');
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	private function update($data, $where)
	{
		$res = $this->base->update(
			$data,
			$where,
			'is_account',
			'account_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function fetch($where = [])
	{
		$res = $this->base->fetch(
			'is_account',
			$where,
			'account_'
		);
		if($res !== false)
		{
			return $res;
		}
		return false;
	}
}

?>

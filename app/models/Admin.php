<?php 

class Admin extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mailer');
	}

	function register($name, $email, $password)
	{
		$data['admin_name'] = $name;
		$data['admin_email'] = $email;
		$data['admin_password'] = char64($password);
		$data['admin_status'] = 'active';
		$data['admin_date'] = time();
		$data['admin_key'] = char16(implode(':', $data));
		$data['admin_rec'] = char32(implode(':', $data));
		$res = $this->db->insert('is_admin', $data);
		if($res)
		{
			if($this->mailer->is_active())
			{
				return true;
			}
			return true;
		}
		return false;
	}

	function login($email, $password, $days = 1)
	{
		$data = $this->fetch_where('email', $email);
		if($data !== false)
		{
			$passwd = $data['admin_password'];
			$password = char64($password);
			if(hash_equals($passwd, $password))
			{
				$json = json_encode([$data['admin_rec'], time()]);
				$gz = gzcompress($json);
				$token = base64_encode($gz);
				set_cookie('logged_admin', true, $days * 86400);
				set_cookie('token_admin', $token, $days * 86400);
				return true;
			}
			return false;
		}
		return false;
	}

	function is_register($email)
	{
		$res = $this->fetch_where('email', $email);
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	function is_logged()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	function logout()
	{
		if(get_cookie('logged_admin', true))
		{
			delete_cookie('logged_admin');
			delete_cookie('token_admin');
			return true;
		}
		return false;
	}

	function reset_password($email)
	{
		$res = $this->fetch_where('email', $email);
		if($res !== false)
		{
			$time = time();
			$token = char32($email.':'.$res['admin_rec'].':'.$time.':'.$res['admin_key']);
			$json = json_encode(['email' => $email, 'token' => $token, 'time' => $time]);
			$base64 = base64_encode($json);
			if($this->mailer->is_active())
			{
				$param['user_name'] = $res['admin_name'];
				$param['user_email'] = $email;
				$param['new_password'] = base_url().'admin/reset/password/'.$base64;
				$this->mailer->send('forget_password', $email, $param, 'admin');
				return true;
			}
			return true;
		}
		return false;
	}

	function reset_admin_password($password, $email)
	{
		$res = $this->fetch_where('email', $email);
		if($res !== false)
		{
			$rec = char64($res['admin_rec'].':'.$password.':'.time().':'.$res['admin_key']);
			$password = char64($password);
			$res = $this->update(['password' => $password, 'rec' => $rec], ['email' => $email]);
			if($res !== false)
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function get_name()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			return $res['admin_name'];
		}
		return false;
	}

	function set_name($name)
	{
		$res = $this->update(['name' => $name], ['email' => $this->get_email()]);
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	function get_key()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			return $res['admin_key'];
		}
		return false;
	}

	function get_email()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			return $res['admin_email'];
		}
		return false;
	}

	function get_uid()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			$uid = char8($res['admin_id'].':'.$res['admin_date'].':'.$res['admin_key']);
			return $uid;
		}
		return false;
	}

	private function get_password()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			return $res['admin_password'];
		}
		return false;
	}

	function set_password($old_password, $new_password)
	{
		$hash = $this->get_password();
		if(hash_equals($hash, char64($old_password)))
		{
			$res = $this->update(['password' => char64($new_password)], ['email' => $this->get_email()]);
			if($res !== false)
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function get_avatar()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			$default = base_url().'assets/'.$this->base->get_template().'/img/user.png';
			$size = 30;
			$url = "https://www.gravatar.com/avatar/".md5(strtolower(trim($res['admin_email'])))."?d=".urlencode($default)."&s=".$size;
			$ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($code !== 200)
            {
            	return $default;
            }
            return $url;
		}
		return false;
	}

	private function update($data, $where)
	{
		$res = $this->base->update(
			$data,
			$where,
			'is_admin',
			'admin_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	function admin_count()
	{
		$res = $this->base->fetch(
			'is_admin',
			[],
			'admin_'
		);
		if(count($res) > 0)
		{
			return count($res);
		}
		return false;
	}

	private function fetch_if_logged()
	{
		if(get_cookie('logged_admin', true))
		{
			$gz = base64_decode(get_cookie('token_admin'));
			$json = gzuncompress($gz);
			$array = json_decode($json, true);
			$res = $this->fetch_where('rec', $array[0]);
			if($res !== false)
			{
				return $res;
			}
			return false;
		}
		return false;
	}

	function fetch_where($index, $field)
	{
		$res = $this->base->fetch(
			'is_admin',
			[$index => $field],
			'admin_'
		);
		if(count($res) > 0)
		{
			return $res[0];
		}
		return false;
	}
}

?>
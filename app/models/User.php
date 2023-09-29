<?php 

class User extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mailer');
	}

	function register($name, $email, $password)
	{
		$data['user_name'] = $name;
		$data['user_email'] = $email;
		$data['user_password'] = char64($password);
		if($this->mailer->is_active())
		{
			$data['user_status'] = 'inactive';
		}
		else
		{
			$data['user_status'] = 'active';
		}
		$data['user_date'] = time();
		$data['user_key'] = char16(implode(':', $data));
		$data['user_rec'] = char32(implode(':', $data));
		$res = $this->db->insert('is_user', $data);
		if($res)
		{
			if($this->mailer->is_active())
			{
				$param['user_name'] = $name;
				$param['user_email'] = $email;
				$param['activation_link'] = base_url().'user//activate/'.$data['user_rec'];
				$this->mailer->send('new_user', $email, $param);
				return true;
			}
			return true;
		}
		return false;
	}

	function oauth_register($name, $email, $secret)
	{
		$data['user_name'] = $name;
		$data['user_email'] = $email;
		$data['user_password'] = char64($email.':'.$secret);
		$data['user_status'] = 'active';
		$data['user_oauth'] = 'enabled';
		$data['user_date'] = time();
		$data['user_key'] = char16(char32($secret).':'.char64($email));
		$data['user_rec'] = char32($data['user_key'].':'.$email.':'.$secret);
		$res = $this->db->insert('is_user', $data);
		if($res)
		{
			if($this->mailer->is_active())
			{
				$param['user_name'] = $name;
				$param['user_email'] = $email;
				$param['activation_link'] = base_url().'user//activate/'.$data['user_rec'];
				$this->mailer->send('new_user', $email, $param);
				return true;
			}
			return true;
		}
		return false;
	}

	function resend_email()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			$param['user_name'] = $res['user_name'];
			$param['user_email'] = $res['user_email'];
			$param['activation_link'] = base_url().'user/activate/'.$res['user_rec'];
			$res = $this->mailer->send('new_user', $param['user_email'], $param);
			if($res !== false)
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function get_count($status = 'active')
	{
		$res = $this->base->fetch('is_user', ['status' => $status], 'user_');
		return count($res);
	}

	function login($email, $password, $days)
	{
		$data = $this->fetch_where('email', $email);
		if($data !== false)
		{
			if($data['user_oauth'])
			{
				$passwd = $data['user_password'];
				$password = char64($password);
				if(hash_equals($passwd, $password))
				{
					$json = json_encode([$data['user_rec'], time()]);
					$gz = gzcompress($json);
					$token = base64_encode($gz);
					set_cookie('logged', true, $days * 86400);
					set_cookie('token', $token, $days * 86400);
					return true;
				}
				return false;
			}
			return 'error';
		}
		return false;
	}

	function oauth_login($email, $secret, $days)
	{
		$data = $this->fetch_where('email', $email);
		if($data !== false)
		{
			if($data['user_oauth'] !== 'disabled')
			{
				$hash = char16(char32($secret).':'.char64($email));
				$rec = $data['user_key'];
				if(hash_equals($rec, $hash)){
					$json = json_encode([$data['user_rec'], time()]);
					$gz = gzcompress($json);
					$token = base64_encode($gz);
					set_cookie('logged', true, $days * 86400);
					set_cookie('token', $token, $days * 86400);
					return true;
				}
				return false;
			}
			return false;
		}
		return false;
	}

	function login_me_as($key)
	{
		$data = $this->fetch_where('key', $key);
		if($data !== false)
		{
			$json = json_encode([$data['user_rec'], time()]);
			$gz = gzcompress($json);
			$token = base64_encode($gz);
			set_cookie('logged', true, 86400);
			set_cookie('token', $token, 86400);
			return true;
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

	function activate($token)
	{
		$res = $this->fetch_where('rec', $token);
		if($res !== false)
		{
			if($res['user_status'] !== 'active')
			{
				$hash = char32($token.':'.time().':'.$res['user_key']);
				$data = ['status' => 'active', 'rec' => $hash];
				$where = ['rec' => $token];
				$res = $this->update($data, $where);
				if($res)
				{
					return true;
				}
				return false;	
			}
			return false;
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
		if(get_cookie('logged', true))
		{
			delete_cookie('logged');
			delete_cookie('token');
			return true;
		}
		return false;
	}

	function reset_password($email)
	{
		$res = $this->fetch_where('email', $email);
		if($res !== false)
		{
			if($res['user_oauth'])
			{
				$time = time();
				$token = char32($email.':'.$res['user_rec'].':'.$time.':'.$res['user_key']);
				$json = json_encode(['email' => $email, 'token' => $token, 'time' => $time]);
				$base64 = base64_encode($json);
				if($this->mailer->is_active())
				{
					$param['user_name'] = $res['user_name'];
					$param['user_email'] = $email;
					$param['new_password'] = base_url().'reset/password/'.$base64;
					$this->mailer->send('forget_password', $email, $param);
					return true;
				}
				return false;
			}
			return true;
		}
		return false;
	}

	function reset_user_password($password, $email)
	{
		$res = $this->fetch_where('email', $email);
		if($res !== false)
		{
			$rec = char64($res['user_rec'].':'.$password.':'.time().':'.$res['user_key']);
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
			return $res['user_name'];
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

	function set_status(bool $status, $key)
	{
		if($status === true)
		{
			$status = 'active';
		}
		else
		{
			$status = 'inactive';
		}
		$res = $this->update(['status' => $status], ['key' => $key]);
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
			return $res['user_key'];
		}
		return false;
	}

	function is_active()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			if($res['user_status'] === 'active')
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		return false;
	}

	function get_email()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			return $res['user_email'];
		}
		return false;
	}

	function get_uid()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			$uid = char8($res['user_id'].':'.$res['user_date'].':'.$res['user_key']);
			return $uid;
		}
		return false;
	}

	function get_rec()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			return $res['user_rec'];
		}
		return false;
	}

	private function get_password()
	{
		$res = $this->fetch_if_logged();
		if($res !== false)
		{
			return $res['user_password'];
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

	function get_oauth($key)
	{
		$res =  $this->fetch_where('key', $key);
		if($res !== false)
		{
			if($res['user_oauth'] === 'enabled')
			{
				return true;
			}
			else
			{
				return false;
			}
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
			$url = "https://www.gravatar.com/avatar/".md5(strtolower(trim($res['user_email'])))."?d=".urlencode($default)."&s=".$size;
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

	function get_user_avatar($key)
	{
		$res = $this->fetch_where('key', $key);
		if($res !== false)
		{
			$default = base_url().'assets/'.$this->base->get_template().'/img/user.png';
			$size = 30;
			$url = "https://www.gravatar.com/avatar/".md5(strtolower(trim($res['user_email'])))."?d=".urlencode($default)."&s=".$size;
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

	function list_count()
	{
		$res = $this->base->fetch(
			'is_user',
			[],
			'user_'
		);
		return count($res);
	}

	function list_users($count = 0)
	{
		$res = $this->base->fetch(
			'is_user',
			[],
			'user_'
		);
		$list = [];
		if($count == 0)
		{
			$count = 0;
		}
		else
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

	function get_info($key)
	{
		$res = $this->fetch_where('key', $key);
		if(count($res)>0)
		{
			return $res;
		}
		return false;
	}

	private function update($data, $where)
	{
		$res = $this->base->update(
			$data,
			$where,
			'is_user',
			'user_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function fetch_if_logged()
	{
		if(get_cookie('logged', true))
		{
			$gz = base64_decode(get_cookie('token', true));
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
			'is_user',
			[$index => $field],
			'user_'
		);
		if(count($res) > 0)
		{
			return $res[0];
		}
		return false;
	}
}

?>
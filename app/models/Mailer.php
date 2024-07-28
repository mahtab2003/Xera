<?php 

class Mailer extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('smtp');
		$this->load->library('email');
 	    $this->load->model('base');
        $crypto = $this->smtp->get_encryption();
        if ($crypto === 'none') {
            $crypto = '';
        } elseif ($crypto == 'tls') {
            $email['starttls'] = true;
        }

        $email = [
            'protocol' => 'smtp',
            'smtp_host' => $this->smtp->get_hostname(),
            'smtp_timeout' => 4,
            'charset' => 'utf-8',
            'smtp_user' => $this->smtp->get_username(),
            'smtp_pass' => $this->smtp->get_password(),
            'smtp_port' => $this->smtp->get_port(),
            'smtp_crypto' => $crypto,
            'mailtype' => 'html',
            'newline' => "<br>"
        ];

		$this->email->initialize($email);
	}

	function is_active()
	{
		return $this->smtp->is_active();
	}

	function get_template($id, $for = 'user')
	{
		$res = $this->fetch(['id' => $id, 'for' => $for]);
		if($res !== false)
		{
			return $res;
		}
		return false;
	}

	function send($id, $email, $array, $for = 'user')
	{
		$res = $this->get_template($id, $for);
		if($res !== false)
		{
			$subject = $res['email_subject'].' - '.$this->base->get_hostname();
			$content = $res['email_content'];
			$content = str_replace("{site_name}", $this->base->get_hostname(), $content);
			$content = str_replace("{site_url}", base_url(), $content);
			foreach(array_keys($array) as $key)
			{
				$subject = str_replace("{".$key."}", $array[$key], $subject);
				$content = str_replace("{".$key."}", $array[$key], $content);
			}
			$this->email->from($this->smtp->get_from(), $this->smtp->get_name());
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($content);
			$res = $this->email->send();
			if($res !== false)
			{
				return true;
			}
			return false;
		}
		return false;
	}

	function test_mail()
	{
		$this->email->from($this->smtp->get_from(), $this->smtp->get_name());
		$this->email->to($this->base->get_email());
		$this->email->subject('Test Email');
		$this->email->message('If you have received this email thats mean smtp config is setup correctly.');
		$res = $this->email->send();
		if($res !== false)
		{
			return true;
		}
		return false;
	}

	function get_user_templates()
	{
		$res = $this->fetch(['for' => 'user'], false);
		if($res !== false)
		{
			return $res;
		}
		return false;
	}

	function set_template($data, $id)
	{
		$res = $this->update($data, ['id' => $id, 'for' => 'user']);
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
			'is_email',
			'email_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	private function fetch($where, $one = true)
	{
		$res = $this->base->fetch(
			'is_email',
			$where,
			'email_'
		);
		if($one !== true)
		{
			return $res;
		}
		else
		{
			if(count($res) > 0)
			{
				return $res[0];
			}
			return false;
		}
	}
}

?>

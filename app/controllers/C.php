<?php 

class C extends CI_Controller
{
	function mofh()
	{
		$this->load->model('account');
		$this->load->model('ticket');
		$this->load->model('mofh');
		$this->load->model('mailer');

		if($this->input->post('username'))
		{
			$username = $this->input->post('username');
			$status = $this->input->post('status');
			$comment = $this->input->post('comments');
			if(file_exists(APPPATH.'logs/mofh_callback.json'))
			{
				$logs = file_get_contents(APPPATH.'logs/mofh_callback.json');
				$logs = json_decode($logs, true);
			}
			else
			{
				$logs = [];
			}
			$callback = [
				'username' => $username,
				'status' => $status,
				'comment' => $comment,
				'time' => date('d-m-Y h:i:s A')
			];
			$logs[] = $callback;
			file_put_contents(APPPATH.'logs/mofh_callback.json', json_encode($logs));
			if(substr($status, 0, 3) === 'sql')
			{
				$this->account->set_sql_server($username, $status);
			}
			elseif($status === 'ACTIVATED')
			{
				$res = $this->account->get_account($username);
				if($res !== false)
				{
					$name = $this->ticket->get_user_name($res['account_for']);
					$email = $this->ticket->get_user_email($res['account_for']);
					$res1 = $this->account->change_status($username, 'active');
					if($res1 !== false)
					{
						if($this->mailer->is_active())
						{
							$param['user_name'] = $name;
							$param['user_email'] = $email;
							$param['account_username'] = $username;
							$param['account_password'] = $res['account_password'];
							$param['account_domain'] = $res['account_domain'];
							$param['main_domain'] = $res['account_main'];
							$param['sql_server'] = str_replace('cpanel', $res['account_sql'], $this->mofh->get_cpanel());
							$param['account_label'] = $res['account_label'];
							$param['cpanel_domain'] = $this->mofh->get_cpanel();
							$param['nameserver_1'] = $this->mofh->get_ns_1();
							$param['nameserver_2'] = $this->mofh->get_ns_2();
							$this->mailer->send('account_created', $email, $param);
						}
					}
				}
			}
			elseif($status === 'DELETE')
			{
				$res = $this->account->get_account($username);
				if($res !== false)
				{
					$name = $this->ticket->get_user_name($res['account_for']);
					$email = $this->ticket->get_user_email($res['account_for']);
					$res = $this->account->remove_account($username);
					if($res !== false)
					{
						if($this->mailer->is_active())
						{
							$param['user_name'] = $name;
							$param['user_email'] = $email;
							$param['account_username'] = $username;
							$this->mailer->send('delete_account', $email, $param);
						}
					}
				}
			}
			elseif($status === 'REACTIVATE')
			{
				$res = $this->account->get_account($username);
				if($res !== false)
				{
					$name = $this->ticket->get_user_name($res['account_for']);
					$email = $this->ticket->get_user_email($res['account_for']);
					$res = $this->account->change_status($username, 'active');
					if($res !== false)
					{
						if($this->mailer->is_active())
						{
							$param['user_name'] = $name;
							$param['user_email'] = $email;
							$param['account_username'] = $username;
							$this->mailer->send('account_reactivated', $email, $param);
						}
					}
				}
			}
			elseif($status === 'SUSPENDED')
			{
				$res = $this->account->get_account($username);
				if($res !== false)
				{
					$name = $this->ticket->get_user_name($res['account_for']);
					$email = $this->ticket->get_user_email($res['account_for']);
					$parse = explode(':', $comment);
					if(trim($parse[0]) == 'AUTO_IDLE')
					{
						$comment = 'due to inactivity.';
					}
					elseif(trim($parse[0]) == 'RES_CLOSE')
					{
						$comment = $parse[1];
					}
					elseif(trim($parse[0]) == 'ADMIN_CLOSE')
					{
						if(trim($parse[1]) == 'DAILY_HIT')
						{
							$comment = 'reached daily hit limit.';
						}
						elseif(trim($parse[1]) == 'DAILY_cpu')
						{
							$comment = 'reached cpu limit.';
						}
						elseif(trim($parse[1]) == 'DAILY_ cpu')
						{
							$comment = 'reached cpu limit.';
						}
						elseif(trim($parse[1]) == 'abuse_complaint LINKED_PHISH_mail')
						{
							$comment = 'absue complaint.';
						}
						elseif(trim($parse[1]) == 'DISPOSABLE_EMAIL')
						{
							$comment = 'using disposable email.';
						}
						elseif(trim($parse[1]) == 'DAILY_IO')
						{
							$comment = 'reached IO limit.';
						}
						else
						{
							$comment = $parse[1];
						}
					}
					elseif(trim($parse[0]) == 'ADMIN_CLOSE; ADMIN_CLOSE')
					{
						if(trim($parse[1]) == 'BAD PHISHING')
						{
							$comment = 'using nulled or illegal script.';
						}
						else
						{
							$comment = $parse[1];
						}
					}
					$res = $this->account->change_status($username, 'suspended');
					if($res !== false)
					{
						if($this->mailer->is_active())
						{
							$param['user_name'] = $name;
							$param['user_email'] = $email;
							$param['some_reason'] = $comment;
							$param['account_username'] = $username;
							$this->mailer->send('account_suspended', $email, $param);
						}
					}
				}
			}
		}
	}
}

?>	

<?php 

class C extends CI_Controller
{
	public function mofh()
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
					$account_status = 'suspended';
					$comment = 'some reason';
					if(trim($parse[0]) == 'AUTO_IDLE')
					{
						$comment = 'due to inactivity.';
					}
					elseif(trim($parse[0]) == 'RES_CLOSE')
					{
						$account_status = 'deactivated';
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
					$res = $this->account->change_status($username, $account_status);
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

	function github_oauth()
	{
		$this->load->model('user');
		$this->load->model('oauth');
		$oauth = 'github';
		if($this->input->get('code'))
		{
			$arr = [
				'client_id' => $this->oauth->get_client($oauth),
				'client_secret' => $this->oauth->get_secret($oauth),
				'code' => $this->input->get('code')
			];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://github.com/login/oauth/access_token");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($arr));
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$adata = curl_exec($ch);
			curl_close($ch);
			$adata = json_decode($adata, true);
			if(isset($adata['error']))
			{
				$this->session->set_flashdata('msg', json_encode([0, $this->base->text('invalid_oauth_key', 'error')]));
				redirect('u/login');
			}
			else
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $this->oauth->get_endpoint($oauth));
				curl_setopt($ch, CURLOPT_POST, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: token '.$adata['access_token'],'User-Agent: PHP']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$udata = curl_exec($ch);
				curl_close($ch);
				$udata = json_decode($udata, true);
				if(isset($udata['error']))
				{
					$this->session->set_flashdata('msg', json_encode([0, $this->base->text('invalid_oauth_key', 'error')]));
					redirect('u/login');
				}
				else
				{
					$key = char16($udata['id']);
					$secret = $udata['id'];
					$name = $udata['name'];
					$password = char64($udata['login']);
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $this->oauth->get_endpoint($oauth)."/emails");
					curl_setopt($ch, CURLOPT_POST, 0);
					curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: token '.$adata['access_token'],'User-Agent: PHP']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$edata = curl_exec($ch);
					$edata = json_decode($edata, true);
					curl_close($ch); 
					$email = $edata[0]['email'];
					if($this->user->is_register())
					{
						$res = $this->user->oauth_login($email, $secret, 30);
						if($res !== false)
						{
							$this->session->set_flashdata('msg', json_encode([1, $this->base->text('login_msg', 'success')]));
							redirect('u/login');
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
							redirect('u/login');
						}
					}
					else
					{
						$res = $this->user->oauth_register($name, $email, $secret);
						if($res !== false)
						{

							$res = $this->user->oauth_login($email, $secret, 30);
							if($res !== false)
							{
								$this->session->set_flashdata('msg', json_encode([1, $this->base->text('login_msg', 'success')]));
								redirect('u/login');
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
								redirect('u/login');
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('oauth_msg', 'error')]));
							redirect('u/login');
						}

					}
				}
			}
		}
	}
}

?>	

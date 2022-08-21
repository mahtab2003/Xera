<?php 

class U extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->load->model('ticket');
		$this->load->model('account');
		$this->load->model(['gogetssl' => 'ssl']);
		$this->load->model('mofh');
		$this->load->model(['sitepro' => 'sp']);
		$this->load->library(['form_validation' => 'fv']);
		$this->load->model(['recaptcha' => 'grc']);
		if(!$this->base->is_active())
		{
			redirect('e/error_500');
		}
		if($this->user->is_logged())
		{
			if(!$this->user->is_active())
			{
				redirect('e/error_400');
			}
		}
		if(!get_cookie('theme'))
		{
			set_cookie('theme', 'light', 30*86400);
		}
	}

	function index()
	{
		$this->login();
	}

	function register()
	{
		if(!$this->user->is_logged())
		{
			if($this->input->post('register'))
			{
				$this->fv->set_rules('name', $this->base->text('your_name', 'label'), ['trim', 'required', 'valid_name']);
				$this->fv->set_rules('email', $this->base->text('email_address', 'label'), ['trim', 'required', 'valid_email']);
				$this->fv->set_rules('password', $this->base->text('password', 'label'), ['trim', 'required']);
				$this->fv->set_rules('password1', $this->base->text('confirm_password', 'label'), ['trim', 'required','matches[password]']);
				if($this->grc->is_active())
				{
					if($this->grc->get_type() == "google")
					{
						$this->fv->set_rules('g-recaptcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					elseif($this->grc->get_type() == "crypto")
					{
						$this->fv->set_rules('CRLT-captcha-token', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					else
					{
						$this->fv->set_rules('h-captcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					if($this->fv->run() === true)
					{
						$name = $this->input->post('name');
						$email = $this->input->post('email');
						$password = $this->input->post('password');
						if($this->grc->get_type() == "google")
						{
							$token = $this->input->post('g-recaptcha-response');
							$type = "google";
						}
						elseif($this->grc->get_type() == "crypto")
						{
							$token = $this->input->post('CRLT-captcha-token');
							$type = "crypto";
						}
						else
						{
							$token = $this->input->post('h-captcha-response');
							$type = "human";
						}
						if($this->grc->is_valid($token, $type))
						{
							if(!$this->user->is_register($email))
							{
								$res = $this->user->register($name, $email, $password);
								if($res)
								{
									$this->session->set_flashdata('msg', json_encode([1, $this->base->text('register_msg', 'success')]));
									redirect('u/login');
								}
								else
								{
									$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
									redirect('u/register');
								}
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('user_exists', 'success')]));
								redirect('u/register');
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('captcha_error', 'error')]));
							redirect('u/register');
						}
					}
					else
					{
						if(validation_errors() !== '')
						{
							$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
						}
						redirect('u/register');
					}
				}
				else
				{
					if($this->fv->run() === true)
					{
						$name = $this->input->post('name');
						$email = $this->input->post('email');
						$password = $this->input->post('password');
						if(!$this->user->is_register($email))
						{
							$res = $this->user->register($name, $email, $password);
							if($res)
							{
								$this->session->set_flashdata('msg', json_encode([1, $this->base->text('register_msg', 'success')]));
									redirect('u/login');
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
							}
							redirect('u/register');
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('user_exists', 'success')]));
							redirect('u/register');
						}
					}
					else
					{
						if(validation_errors() !== '')
						{
							$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
						}
						redirect('u/register');
					}
				}
			}
			else
			{
				$data['title'] = 'register';
				$this->load->view('form/includes/header.php', $data);
				$this->load->view('form/user/register.php');
				$this->load->view('form/includes/footer.php');
			}
		}
		else
		{
			redirect('u/dashboard');
		}
	}

	function login()
	{
		if(!$this->user->is_logged())
		{
			if($this->input->post('login'))
			{
				$this->fv->set_rules('email', $this->base->text('email_address', 'label'), ['trim', 'required', 'valid_email']);
				$this->fv->set_rules('password', $this->base->text('password', 'label'), ['trim', 'required']);
				if($this->grc->is_active())
				{
					if($this->grc->get_type() == "google")
					{
						$this->fv->set_rules('g-recaptcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					elseif($this->grc->get_type() == "crypto")
					{
						$this->fv->set_rules('CRLT-captcha-token', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					else
					{
						$this->fv->set_rules('h-captcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					if($this->fv->run() === true)
					{
						$email = $this->input->post('email');
						$password = $this->input->post('password');
						$checkbox = $this->input->post('checkbox');
						if($this->grc->get_type() == "google")
						{
							$token = $this->input->post('g-recaptcha-response');
							$type = "google";
						}
						elseif($this->grc->get_type() == "crypto")
						{
							$token = $this->input->post('CRLT-captcha-token');
							$type = "crypto";
						}
						else
						{
							$token = $this->input->post('h-captcha-response');
							$type = "human";
						}
						if($this->grc->is_valid($token, $type))
						{
							if(!$checkbox)
							{
								$days = 1;
							}
							else
							{
								$days = 30;
							}
							$res = $this->user->login($email, $password, $days);
							if($res)
							{
								$this->session->set_flashdata('msg', json_encode([1, $this->base->text('login_msg', 'success')]));
								redirect('u/dashboard');
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('invalid_email_pass', 'error')]));
								redirect('u/login');
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('captcha_error', 'error')]));
							redirect('u/login');
						}
					}
					else
					{
						if(validation_errors() !== '')
						{
							$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
						}
						redirect('u/login');
					}
				}
				else
				{
					if($this->fv->run() === true)
					{
						$email = $this->input->post('email');
						$password = $this->input->post('password');
						$checkbox = $this->input->post('checkbox');
						if(!$checkbox)
						{
							$days = 1;
						}
						else
						{
							$days = 30;
						}
						$res = $this->user->login($email, $password, $days);
						if($res)
						{
							$this->session->set_flashdata('msg', json_encode([1, $this->base->text('login_msg', 'success')]));
							redirect('u/dashboard');
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('invalid_email_pass', 'error')]));
							redirect('u/login');
						}
					}
					else
					{
						if(validation_errors() !== '')
						{
							$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
						}
						redirect('u/login');
					}
				}
			}
			else
			{
				$data['title'] = 'login';
				$this->load->view('form/includes/header.php', $data);
				$this->load->view('form/user/login.php');
				$this->load->view('form/includes/footer.php');
			}
		}
		else
		{
			redirect('u/dashboard');
		}
	}

	function forget()
	{
		if(!$this->user->is_logged())
		{
			if($this->input->post('forget'))
			{
				$this->fv->set_rules('email', $this->base->text('email_address', 'label'), ['trim', 'required', 'valid_email']);
				if($this->fv->run() === true)
				{
					$email = $this->input->post('email');
					$data = $this->user->reset_password($email);
					$this->session->set_flashdata('msg', json_encode([1, $this->base->text('forget_msg', 'success')]));
					redirect('u/login');
				}
				else
				{
					if(validation_errors() !== '')
					{
						$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
					}
					redirect('u/forget');
				}
			}
			else
			{
				$data['title'] = 'forget_password';
				$this->load->view('form/includes/header.php', $data);
				$this->load->view('form/user/forget.php');
				$this->load->view('form/includes/footer.php');
			}
		}
		else
		{
			redirect('u/dashboard');
		}
	}

	function reset_password($token)
	{
		if(!$this->user->is_logged())
		{
			$json = base64_decode($token);
			$arr = json_decode($json, true);
			$email = $arr['email'];
			$key = $arr['token'];
			$time = $arr['time'];
			$user = $this->user->fetch_where('email', $email);
			if(time() > $time + 3600)
			{
				$this->session->set_flashdata('msg', json_encode([0, $this->base->text('reset_token_expired', 'error')]));
				redirect('u/login');
			}
			elseif($user !== false)
			{
				$verify = char32($email.':'.$user['user_rec'].':'.$time.':'.$user['user_key']);
				if($verify == $key)
				{
					if($this->input->post('reset'))
					{
						$this->fv->set_rules('password', $this->base->text('password', 'label'), ['trim', 'required']);
						$this->fv->set_rules('password1', $this->base->text('confirm_password', 'label'), ['trim', 'required', 'matches[password]']);
						if($this->fv->run() === true)
						{
							$password = $this->input->post('password');
							$res = $this->user->reset_user_password($password, $email);
							if($res !== false)
							{
								$this->session->set_flashdata('msg', json_encode([1, $this->base->text('reset_msg', 'success')]));
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
							if(validation_errors() !== '')
							{
								$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
							}
							redirect('u/login');
						}
					}
					else
					{
						$data['title'] = 'reset_password';
						$data['token'] = $token;
						$this->load->view('form/includes/header.php', $data);
						$this->load->view('form/user/reset_password.php');
						$this->load->view('form/includes/footer.php');	
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, $this->base->text('invalid_token', 'error')]));
					redirect('u/login');
				}
			}
			else
			{
				$this->session->set_flashdata('msg', json_encode([0, $this->base->text('invalid_token', 'error')]));
				redirect('u/login');
			}
		}
		else
		{
			redirect('u/dashboard');
		}
	}

	function logout($status = 1, $msg = '')
	{
		if($this->user->logout())
		{
			if($msg !== '')
			{
				$this->session->set_flashdata('msg', json_encode([$status, $msg]));
			}
			else
			{
				$this->session->set_flashdata('msg', json_encode([1, $this->base->text('logout_msg', 'success')]));
			}
			redirect('u/login');
		}
		else
		{
			$this->session->set_flashdata('msg', json_encode([0, $this->base->text('login_to_continue', 'error')]));
			redirect('u/login');
		}
	}

	function settings()
	{
		if($this->user->is_logged())
		{
			if($this->input->post('update_theme'))
			{
				set_cookie('theme', $this->input->post('theme'), 30 * 86400);
				set_cookie('lang', $this->input->post('language'), 30 * 86400);
				$this->session->set_flashdata('msg', json_encode([1, $this->base->text('theme_msg', 'success')]));
				redirect('u/settings');
			}
			elseif($this->input->post('update_name'))
			{
				$this->fv->set_rules('name', $this->base->text('your_name', 'label'), ['trim', 'required', 'valid_name']);
				if($this->fv->run() === true)
				{
					$name = $this->input->post('name');
					$res = $this->user->set_name($name);
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, $this->base->text('name_msg', 'success')]));
						redirect('u/settings');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
						redirect('u/settings');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('u/settings');
				}
			}
			elseif($this->input->post('update_password'))
			{
				$this->fv->set_rules('password', $this->base->text('new_password', 'label'), ['trim', 'required']);
				$this->fv->set_rules('password1', $this->base->text('confirm_password', 'label'), ['trim', 'required', 'matches[password]']);
				$this->fv->set_rules('old_password', $this->base->text('old_password', 'label'), ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$password = $this->input->post('password');
					$old_password = $this->input->post('old_password');
					$res = $this->user->set_password($old_password, $password);
					if($res !== false)
					{
						$this->logout(1, $this->base->text('user_pass_msg', 'success'));
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
						redirect('u/settings');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('u/settings');
				}
			}
			else
			{
				$data['title'] = 'settings';

				$this->load->view('page/includes/user/header', $data);
				$this->load->view('page/includes/user/navbar');
				$this->load->view('page/user/settings');
				$this->load->view('page/includes/user/footer');
			}

		}
		else
		{
			redirect('u/login');
		}
	}

	function dashboard()
	{
		if($this->user->is_logged())
		{
			$data['title'] = 'dashboard';
			$data['active'] = 'home';
			$data['list'] = $this->account->get_user_accounts();
			
			$this->load->view('page/includes/user/header', $data);
			$this->load->view('page/includes/user/navbar');
			$this->load->view('page/user/accounts');
			$this->load->view('page/includes/user/footer');
		}
		else
		{
			redirect('u/login');
		}
	}

	function tickets()
	{
		if($this->user->is_logged())
		{
			$data['title'] = 'tickets';
			$data['active'] = 'ticket';
			$data['list'] = $this->ticket->get_user_tickets();

			$this->load->view('page/includes/user/header', $data);
			$this->load->view('page/includes/user/navbar');
			$this->load->view('page/user/tickets');
			$this->load->view('page/includes/user/footer');
		}
		else
		{
			redirect('u/login');
		}
	}

	function create_ticket()
	{
		if($this->user->is_logged())
		{
			if($this->input->post('create'))
			{
				$this->fv->set_rules('subject', $this->base->text('subject', 'label'), ['trim', 'required']);
				$this->fv->set_rules('content', $this->base->text('content', 'label'), ['trim', 'required']);
				if($this->grc->is_active())
				{
					if($this->grc->get_type() == "google")
					{
						$this->fv->set_rules('g-recaptcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					elseif($this->grc->get_type() == "crypto")
					{
						$this->fv->set_rules('CRLT-captcha-token', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					else
					{
						$this->fv->set_rules('h-captcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					if($this->fv->run() === true)
					{
						$subject = $this->input->post('subject');
						$content = $this->input->post('content');
						if($this->grc->get_type() == "google")
						{
							$token = $this->input->post('g-recaptcha-response');
							$type = "google";
						}
						elseif($this->grc->get_type() == "crypto")
						{
							$token = $this->input->post('CRLT-captcha-token');
							$type = "crypto";
						}
						else
						{
							$token = $this->input->post('h-captcha-response');
							$type = "human";
						}
						if($this->grc->is_valid($token, $type))
						{
							$res = $this->ticket->create_ticket($subject, $content);
							if($res)
							{
								$this->session->set_flashdata('msg', json_encode([1, $this->base->text('ticket_msg', 'success')]));
								redirect('u/tickets');
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
								redirect('u/create_ticket');
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('captcha_error', 'error')]));
							redirect('u/create_ticket');
						}
					}
					else
					{
						if(validation_errors() !== '')
						{
							$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
						}
						redirect('u/create_ticket');
					}
				}
				else
				{
					if($this->fv->run() === true)
					{
						$subject = $this->input->post('subject');
						$content = $this->input->post('content');
						$res = $this->ticket->create_ticket($subject, $content);
						if($res)
						{
							$this->session->set_flashdata('msg', json_encode([1, $this->base->text('ticket_msg', 'success')]));
							redirect('u/tickets');
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
							redirect('u/create_ticket');
						}
					}
					else
					{
						if(validation_errors() !== '')
						{
								$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
						}
						redirect('u/create_ticket');
					}
				}
			}
			else
			{
				$data['title'] = 'create_ticket';
				$data['active'] = 'ticket';

				$this->load->view('page/includes/user/header', $data);
				$this->load->view('page/includes/user/navbar');
				$this->load->view('page/user/create_ticket');
				$this->load->view('page/includes/user/footer');
			}
		}
		else
		{
			redirect('u/login');
		}
	}

	function view_ticket($id)
	{
		if($this->user->is_logged()){
			$id = $this->security->xss_clean($id);
			if($this->input->get('close'))
			{
				if($this->ticket->view_user_ticket($id))
				{
					$res = $this->ticket->change_ticket_status($id, 'closed');
					if($res)
					{
						$this->session->set_flashdata('msg', json_encode([1, $this->base->text('ticket_closed_msg', 'success')]));
						redirect("u/view_ticket/$id");
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
						redirect("u/view_ticket/$id");
					}
				}
				else
				{
					redirect('u/tickets');
				}
			}
			elseif($this->input->get('open'))
			{
				if($this->ticket->view_user_ticket($id))
				{
					$res = $this->ticket->change_ticket_status($id, 'open');
					if($res)
					{
						$this->session->set_flashdata('msg', json_encode([1, $this->base->text('ticket_opened_msg', 'success')]));
						redirect("u/view_ticket/$id");
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
						redirect("u/view_ticket/$id");
					}
				}
				else
				{
					redirect('u/tickets');
				}
			}
			elseif($this->input->post('reply'))
			{
				if($this->ticket->view_user_ticket($id))
				{
					$this->fv->set_rules('content', $this->base->text('content', 'label'), ['trim', 'required']);
					if($this->grc->is_active())
					{
						if($this->grc->get_type() == "google")
					{
						$this->fv->set_rules('g-recaptcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					elseif($this->grc->get_type() == "crypto")
					{
						$this->fv->set_rules('CRLT-captcha-token', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					else
					{
						$this->fv->set_rules('h-captcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
						if($this->fv->run() === true)
						{
							$content = $this->input->post('content');
							if($this->grc->get_type() == "google")
							{
								$token = $this->input->post('g-recaptcha-response');
								$type = "google";
							}
							elseif($this->grc->get_type() == "crypto")
							{
								$token = $this->input->post('CRLT-captcha-token');
								$type = "crypto";
							}
							else
							{
								$token = $this->input->post('h-captcha-response');
								$type = "human";
							}
							if($this->grc->is_valid($token, $type))
							{
								$res = $this->ticket->add_reply($id, $content, $this->user->get_key(), 'customer');
								if($res)
								{
									$this->session->set_flashdata('msg', json_encode([1, $this->base->text('reply_msg', 'success')]));
									redirect("u/view_ticket/$id");
								}
								else
								{
									$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
									redirect("u/view_ticket/$id");
								}
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('captcha_error', 'error')]));
								redirect("u/view_ticket/$id");
							}
						}
						else
						{
							if(validation_errors() !== '')
							{
								$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
							}
							redirect("u/view_ticket/$id");
						}
					}
					else
					{
						if($this->fv->run() === true)
						{
							$content = $this->input->post('content');
							$res = $this->ticket->add_reply($id, $content, $this->user->get_key(), 'customer');
							if($res)
							{
								$this->session->set_flashdata('msg', json_encode([1, $this->base->text('reply_msg', 'success')]));
								redirect("u/view_ticket/$id");
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
								redirect("u/view_ticket/$id");
							}
						}
						else
						{
							if(validation_errors() !== '')
							{
									$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
							}
							redirect("u/view_ticket/$id");
						}
					}
				}
				else
				{
					redirect("u/tickets");
				}
			}
			else
			{
				$data['title'] = 'view_ticket';
				$data['active'] = 'ticket';
				$data['ticket'] = $this->ticket->view_user_ticket($id);
				if($data['ticket'] !== false)
				{
					$data['replies'] = $this->ticket->get_ticket_reply($id);

					$this->load->view('page/includes/user/header', $data);
					$this->load->view('page/includes/user/navbar');
					$this->load->view('page/user/view_ticket');
					$this->load->view('page/includes/user/footer');
				}
				else
				{
					redirect('e/error_404');
				}
			}
		}
		else
		{
			redirect('u/login');
		}
	}

	function accounts()
	{
		if($this->user->is_logged())
		{
			$data['title'] = 'accounts';
			$data['active'] = 'account';
			$data['list'] = $this->account->get_user_accounts();
			
			$this->load->view('page/includes/user/header', $data);
			$this->load->view('page/includes/user/navbar');
			$this->load->view('page/user/accounts');
			$this->load->view('page/includes/user/footer');
		}
		else
		{
			redirect('u/login');
		}
	}

	function create_account()
	{
		if($this->user->is_logged())
		{
			$count = $this->account->get_active_accounts($this->user->get_key());
			if($count < 3)
			{
				if($this->input->post('check_domain')){
					$this->fv->set_rules('domain', $this->base->text('domain', 'label'), ['trim', 'required']);
					if($this->fv->run() !== false)
					{
						$domain = $this->input->post('domain');
						$res = $this->mofh->check_availablity($domain);
						if($res === true)
						{
							$this->session->set_flashdata('msg', json_encode([1, $this->base->text('domain_selected_msg', 'success')]));
							$this->session->set_userdata('domain', strtolower($domain));
							redirect('u/create_account#configure');
						}
						elseif($res === false){
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('domain_not_available', 'error')]));
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $res]));
						}
						redirect('u/create_account');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('fill_domain_field', 'error')]));
						redirect('u/create_account');
					}
				}
				elseif($this->input->post('check_subdomain')){
					$this->fv->set_rules('domain', $this->base->text('domain', 'label'), ['trim', 'required']);
					$this->fv->set_rules('ext', 'Extension', ['trim', 'required']);
					if($this->fv->run() !== false)
					{
						$domain = $this->input->post('domain');
						$ext = $this->input->post('ext');
						$subdomain = $domain.$ext;
						$res = $this->mofh->check_availablity($subdomain);
						if($res === true)
						{
							$this->session->set_flashdata('msg', json_encode([1, $this->base->text('domain_selected_msg', 'success')]));
							$this->session->set_userdata('domain', strtolower($subdomain));
							redirect('u/create_account#configure');
						}
						elseif($res === false){
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('domain_not_available', 'error')]));
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $res]));
						}
						redirect('u/create_account');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('fill_domain_field', 'error')]));
						redirect('u/create_account');
					}
				}
				elseif($this->input->post('create'))
				{
					$this->fv->set_rules('domain', $this->base->text('domain', 'label'), ['trim', 'required']);
					$this->fv->set_rules('label', $this->base->text('label', 'label'), ['trim', 'required']);
					if($this->grc->is_active())
					{
						if($this->grc->get_type() == "google")
					{
						$this->fv->set_rules('g-recaptcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					elseif($this->grc->get_type() == "crypto")
					{
						$this->fv->set_rules('CRLT-captcha-token', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					else
					{
						$this->fv->set_rules('h-captcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
						if($this->fv->run() === true)
						{
							$label = $this->input->post('label');
							$domain = $this->input->post('domain');
							if($this->grc->get_type() == "google")
							{
								$token = $this->input->post('g-recaptcha-response');
								$type = "google";
							}
							elseif($this->grc->get_type() == "crypto")
							{
								$token = $this->input->post('CRLT-captcha-token');
								$type = "crypto";
							}
							else
							{
								$token = $this->input->post('h-captcha-response');
								$type = "human";
							}
							if($this->grc->is_valid($token, $type))
							{
								$res = $this->mofh->create_account($label, $domain);
								if($res === true)
								{
									$this->session->set_flashdata('msg', json_encode([1, $this->base->text('account_msg', 'success')]));
									if(isset($_SESSION['domain']))
									{
										unset($_SESSION['domain']);
									}
									if(isset($_SESSION['ext']))
									{
										unset($_SESSION['ext']);
									}
									$this->session->set_userdata('done', true);
									redirect('u/create_account#done');
								}
								elseif($res === false)
								{
									$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
									redirect('u/create_account#configure');
								}
								else
								{
									$this->session->set_flashdata('msg', json_encode([0, $res]));
									redirect('u/create_account#configure');
								}
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('captcha_error', 'error')]));
								redirect('u/create_account#configure');
							}
						}
						else
						{
							if(validation_errors() !== '')
							{
								$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
							}
							redirect('u/create_account#configure');
						}
					}
					else
					{
						if($this->fv->run() === true)
						{
							$label = $this->input->post('label');
							$domain = $this->input->post('domain');
							$res = $this->mofh->create_account($label, $domain);
							if($res === true)
							{
								$this->session->set_flashdata('msg', json_encode([1, $this->base->text('account_msg', 'success')]));
								if(isset($_SESSION['domain']))
								{
									unset($_SESSION['domain']);
								}
								if(isset($_SESSION['ext']))
								{
									unset($_SESSION['ext']);
								}
								$this->session->set_userdata('done', true);
								redirect('u/create_account#done');
							}
							elseif($res === false)
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
								redirect('u/create_account#configure');
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $res]));
								redirect('u/create_account#configure');
							}
						}
						else
						{
							if(validation_errors() !== '')
							{
									$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
							}
							redirect('u/create_account#configure');
						}
					}
				}
				else
				{
					$data['title'] = 'create_account';
					$data['active'] = 'account';

					$this->load->view('page/includes/user/header', $data);
					$this->load->view('page/includes/user/navbar');
					$this->load->view('page/user/create_account');
					$this->load->view('page/includes/user/footer');
				}
			}
			else
			{
				$this->session->set_flashdata('msg', json_encode([0, $this->base->text('account_limit', 'error')]));
				redirect('u/accounts');
			}
		}
		else
		{
			redirect('u/login');
		}
	}

	function view_account($id)
	{
		if($this->user->is_logged())
		{
			$id = $this->security->xss_clean($id);
			if($this->input->get('login'))
			{
				$res = $this->account->get_user_account($id);
				if($res !== false)
				{
					$data['username'] = $res['account_username'];
					$data['password'] = $res['account_password'];
					$this->load->view('page/user/cpanel_login', $data);
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
					redirect("u/view_account/$id");
				}
			}
			elseif($this->input->get('builder') AND $this->input->get('domain'))
			{
				$res = $this->account->get_user_account($id);
				if($res !== false)
				{
					$username = $res['account_username'];
					$password = $res['account_password'];
					$domain = $this->input->get('domain');
					if($domain !== $res['account_domain'])
					{
						$dir = '/htdocs/'.$domain;
					}
					else
					{
						$dir = '/htdocs/';
					}
					$link = $this->sp->load_builder_url($username, $password, $domain, $dir);
					if($link === false)
					{
						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
						redirect("u/view_account/$id");
					}
					elseif($link['success'] == true)
					{
						header('location: '.$link['url']);
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, $link['msg']]));
						redirect("u/view_account/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
					redirect("u/view_account/$id");
				}
			}
			elseif($this->input->get('reactivate'))
			{
				$count = $this->account->get_active_accounts($this->user->get_key());
				if($count > 2)
				{
					$this->session->set_flashdata('msg', json_encode([0, $this->base->text('cant_reactivate', 'error')]));
					redirect("u/view_account/$id");
				}
				else
				{
					$res = $this->account->get_user_account($id);
					if($res !== false)
					{
						if($res['account_status'] === 'suspended' OR $res['account_status'] === 'deactivated')
						{
							$res = $this->mofh->reactivate_account($res['account_key']);
							if(!is_bool($res))
							{
								$this->session->set_flashdata('msg', json_encode([0, $res]));
								redirect("u/view_account/$id");
							}
							elseif($res !== false)
							{
								$this->session->set_flashdata('msg', json_encode([1, $this->base->text('account_reactivated_msg', 'success')]));
								redirect("u/view_account/$id");
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
								redirect("u/view_account/$id");
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('reactivation_error', 'error')]));
							redirect("u/view_account/$id");
						}
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
						redirect("u/view_account/$id");
					}
				}
			}
			else
			{
				$data['title'] = 'view_account';
				$data['active'] = 'account';
				$data['id'] = $id;
				$data['data'] = $this->account->get_user_account($id);
				if($data['data'] !== false)
				{
					$this->load->view('page/includes/user/header', $data);
					$this->load->view('page/includes/user/navbar');
					$this->load->view('page/user/view_account');
					$this->load->view('page/includes/user/footer');
				}
				else
				{
					redirect('e/error_404');
				}
			}
		}
		else
		{
			redirect('u/login');
		}
	}

	function account_settings($id)
	{
		if($this->user->is_logged())
		{
			$id = $this->security->xss_clean($id);
			if($this->input->post('update_label'))
			{
				$res = $this->account->get_user_account($id);
				if($res !== false)
				{
					$res = $this->account->set_label($id, $this->input->post('label'));
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, $this->base->text('label_updated_msg', 'success')]));
						redirect("u/account_settings/$id");
					}
						else
					{
						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
						redirect("u/account_settings/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
					redirect("u/account_settings/$id");
				}
			}
			elseif($this->input->post('update_password'))
			{
				$res = $this->account->get_user_account($id);
				if($res !== false)
				{
					if(strlen($this->input->post('password')) > 4 AND strlen($this->input->post('old_password')) > 4)
					{
						$res = $this->account->change_account_password($id, $this->input->post('password'), $this->input->post('old_password'));
						if(!is_bool($res))
						{
							$this->session->set_flashdata('msg', json_encode([0, $res]));
							redirect("u/account_settings/$id");
						}
						elseif($res !== false)
						{
							$this->session->set_flashdata('msg', json_encode([1, $this->base->text('account_password_msg', 'success')]));
							redirect("u/view_account/$id");
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
							redirect("u/account_settings/$id");
						}
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'Unable to delete account.']));
							redirect("u/account_settings/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
					redirect("u/account_settings/$id");
				}
			} 
			elseif($this->input->post('deactivate'))
			{
				$res = $this->account->get_user_account($id);
				if($res !== false)
				{
					if($res['account_status'] === 'active')
					{
						$res = $this->mofh->deactivate_account($res['account_key'], $this->input->post('reason'));
						if(!is_bool($res)){
							$this->session->set_flashdata('msg', json_encode([0, $res]));
							redirect("u/account_settings/$id");
						}
						elseif($res !== false)
						{
							$this->session->set_flashdata('msg', json_encode([1, $this->base->text('account_deactivated_msg', 'success')]));
							redirect("u/accounts");
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
							redirect("u/account_settings/$id");
						}
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, $this->base->text('deactivation_error', 'error')]));
							redirect("u/account_settings/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
					redirect("u/account_settings/$id");
				}
			}
			else
			{
				$data['title'] = 'account_settings';
				$data['active'] = 'account';
				$data['id'] = $id;
				$data['data'] = $this->account->get_user_account($id);
				if($data['data'] !== false)
				{
					$this->load->view('page/includes/user/header', $data);
					$this->load->view('page/includes/user/navbar');
					$this->load->view('page/user/account_settings');
					$this->load->view('page/includes/user/footer');
				}
				else
				{
					redirect('e/error_404');
				}
			}
		}
		else
		{
			redirect('u/login');
		}
	}

	function domain_checker($domain = false)
	{
		$domain = $this->security->xss_clean($domain);
		$domain = strtolower($domain);
		if($this->user->is_logged())
		{
			$data['title'] = 'domain_checker';
			$data['active'] = 'domain';
			if($domain !== false)
			{
				$data['data'] = $this->mofh->get_domain_user($domain);
			}
			else
			{
				$data['data'] = false;
			}
			$data['domain'] = $domain;

			$this->load->view('page/includes/user/header', $data);
			$this->load->view('page/includes/user/navbar');
			$this->load->view('page/user/domain_checker');
			$this->load->view('page/includes/user/footer');
		}
		else
		{
			redirect('u/login');
		}
	}

	function ssl()
	{
		if($this->user->is_logged())
		{
			if($this->ssl->is_active())
			{
				$data['title'] = 'ssl';
				$data['active'] = 'ssl';
				$data['list'] = $this->ssl->get_ssl_list();
				
				$this->load->view('page/includes/user/header', $data);
				$this->load->view('page/includes/user/navbar');
				$this->load->view('page/user/ssl');
				$this->load->view('page/includes/user/footer');
			}
			else
			{
				redirect('u/');
			}
		}
		else
		{
			redirect('u/login');
		}
	}

	function create_ssl()
	{
		if($this->user->is_logged())
		{
			if($this->input->post('create'))
			{
				$this->fv->set_rules('csr', $this->base->text('csr_code', 'label'), ['trim', 'required']);
				if($this->grc->is_active())
				{
					if($this->grc->get_type() == "google")
					{
						$this->fv->set_rules('g-recaptcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					elseif($this->grc->get_type() == "crypto")
					{
						$this->fv->set_rules('CRLT-captcha-token', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					else
					{
						$this->fv->set_rules('h-captcha-response', $this->base->text('recaptcha', 'label'), ['trim', 'required']);
					}
					if($this->fv->run() === true)
					{
						$csr = $this->input->post('csr');
						if($this->grc->get_type() == "google")
						{
							$token = $this->input->post('g-recaptcha-response');
							$type = "google";
						}
						elseif($this->grc->get_type() == "crypto")
						{
							$token = $this->input->post('CRLT-captcha-token');
							$type = "crypto";
						}
						else
						{
							$token = $this->input->post('h-captcha-response');
							$type = "human";
						}
						if($this->grc->is_valid($token, $type))
						{
							$res = $this->ssl->create_ssl($csr);
							if(!is_bool($res))
							{
								$this->session->set_flashdata('msg', json_encode([0, $res]));
								redirect('u/ssl');
							}
							elseif(is_bool($res) AND $res == true)
							{
								$this->session->set_flashdata('msg', json_encode([1, $this->base->text('ssl_created_msg', 'success')]));
								redirect('u/ssl');
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
								redirect('u/create_ssl');
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('captcha_error', 'error')]));
							redirect('u/create_ssl');
						}
					}
					else
					{
						if(validation_errors() !== '')
						{
							$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
						}
						redirect('u/create_ssl');
					}
				}
				else
				{
					if($this->fv->run() === true)
					{
						$csr = $this->input->post('csr');
						$res = $this->ssl->create_ssl($csr);
						if(!is_bool($res))
						{
							$this->session->set_flashdata('msg', json_encode([0, $res]));
							redirect('u/ssl');
						}
						if(is_bool($res) AND $res == true)
						{
							$this->session->set_flashdata('msg', json_encode([1, $this->base->text('ssl_created_msg', 'success')]));
							redirect('u/ssl');
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
							redirect('u/create_ssl');
						}
					}
					else
					{
						if(validation_errors() !== '')
						{
								$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, $this->base->text('required_fields', 'error')]));
						}
						redirect('u/create_ssl');
					}
				}
			}
			else
			{
				if($this->ssl->is_active())
				{
					$data['title'] = 'create_ssl';
					$data['active'] = 'ssl';

					$this->load->view('page/includes/user/header', $data);
					$this->load->view('page/includes/user/navbar');
					$this->load->view('page/user/create_ssl');
					$this->load->view('page/includes/user/footer');
				}
				else
				{
					redirect('u/');
				}
			}
		}
		else
		{
			redirect('u/login');
		}
	}

	function view_ssl($id)
	{
		if($this->user->is_logged())
		{
			$id = $this->security->xss_clean($id);
			if($this->input->get('delete'))
			{
				$this->db->where(['key' => $id]);
				$res = $this->db->delete('is_ssl');
				if($res !== false)
				{
					$this->session->set_flashdata('msg', json_encode([1, $this->base->text('ssl_deleted_msg', 'success')]));
					redirect("u/view_ssl/$id");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
					redirect("u/view_ssl/$id");
				}
			}
			elseif($this->input->get('cancel'))
			{
				$res = $this->ssl->cancel_ssl($id, 'Some Reason');
				if(!is_bool($res))
				{
					$this->session->set_flashdata('msg', json_encode([0, $res]));
					redirect("u/view_ssl/$id");
				}
				elseif(is_bool($res) AND $res == true)
				{
					$this->session->set_flashdata('msg', json_encode([1, $this->base->text('ssl_cancelled_msg', 'success')]));
					redirect("u/view_ssl/$id");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, $this->base->text('error_occured', 'error')]));
					redirect("u/view_ssl/$id");
				}
			}
			else
			{
				if($this->ssl->is_active())
				{
					$data['title'] = 'view_ssl';
					$data['active'] = 'ssl';
					$data['id'] = $id;
					$data['data'] = $this->ssl->get_ssl_info($id);
					if($data['data'] !== false)
					{
						$this->load->view('page/includes/user/header', $data);
						$this->load->view('page/includes/user/navbar');
						$this->load->view('page/user/view_ssl');
						$this->load->view('page/includes/user/footer');
					}
					else
					{
						redirect('e/error_404');
					}
				}
				else
				{
					redirect('u/');
				}
			}
		}
		else
		{
			redirect('u/login');
		}
	}

	function upgrade()
	{
		if($this->user->is_logged())
		{
			$this->load->view('page/user/upgrade');
		}
		else
		{
			redirect('u/login');
		}
	}
}

?>
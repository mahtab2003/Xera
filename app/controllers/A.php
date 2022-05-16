<?php 

class A extends CI_Controller
{
		function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->load->model('admin');
		$this->load->model('ticket');
		$this->load->model('account');
		$this->load->model('mofh');
		$this->load->library(['form_validation' => 'fv']);
		$this->load->model(['recaptcha' => 'grc']);
		if(!get_cookie('theme'))
		{
			set_cookie('theme', 'light', 30*86400);
		}
	}

	function index()
	{
		if(!$this->admin->admin_count() > 0)
		{
			redirect('a/register');
		}
		else
		{
			$this->login();
		}
	}

	function register()
	{
		if(!$this->admin->admin_count() > 0)
		{
			if($this->input->post('register'))
			{
				$this->fv->set_rules('name', 'Name', ['trim', 'required', 'valid_name']);
				$this->fv->set_rules('email', 'Email address', ['trim', 'required', 'valid_email']);
				$this->fv->set_rules('password', 'Password', ['trim', 'required']);
				$this->fv->set_rules('password1', 'Confirm password', ['trim', 'required','matches[password]']);
				if($this->grc->is_active())
				{
					$this->fv->set_rules('g-recaptcha-response', 'Recaptcha', ['trim', 'required']);
					if($this->fv->run() === true)
					{
						$name = $this->input->post('name');
						$email = $this->input->post('email');
						$password = $this->input->post('password');
						$token = $this->input->post('g-recaptcha-response');
						if($this->grc->is_valid($token))
						{
							if(!$this->admin->is_register($email))
							{
								$res = $this->admin->register($name, $email, $password);
								if($res)
								{
									$this->session->set_flashdata('msg', json_encode([1, 'User have been registered successfully.']));
									redirect('a/login');
								}
								else
								{
									$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
									redirect('a/register');
								}
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, 'User already exists with this email address.']));
								redirect('a/register');
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'Invalid recaptcha response received.']));
							redirect('a/register');
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
							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));
						}
						redirect('a/register');
					}
				}
				else
				{
					if($this->fv->run() === true)
					{
						$name = $this->input->post('name');
						$email = $this->input->post('email');
						$password = $this->input->post('password');
						if(!$this->admin->is_register($email))
						{
							$res = $this->admin->register($name, $email, $password);
							if($res)
							{
								$this->session->set_flashdata('msg', json_encode([1, 'User have been registered successfully.']));
									redirect('a/login');
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
							}
							redirect('a/register');
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'User already exists with this email address.']));
							redirect('a/register');
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
							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));
						}
						redirect('a/register');
					}
				}
			}
			else
			{
				$data['title'] = 'Register';
				$this->load->view('form/includes/header.php', $data);
				$this->load->view('form/admin/register.php');
				$this->load->view('form/includes/footer.php');
			}
		}
		else
		{
			redirect('a/dashboard');
		}
	}

	function login()
	{
		if(!$this->admin->is_logged())
		{
			if($this->input->post('login'))
			{
				$this->fv->set_rules('email', 'Email address', ['trim', 'required', 'valid_email']);
				$this->fv->set_rules('password', 'Password', ['trim', 'required']);
				if($this->grc->is_active())
				{
					$this->fv->set_rules('g-recaptcha-response', 'Recaptcha', ['trim', 'required']);
					if($this->fv->run() === true)
					{
						$email = $this->input->post('email');
						$password = $this->input->post('password');
						$token = $this->input->post('g-recaptcha-response');
						if($this->grc->is_valid($token))
						{
							$res = $this->admin->login($email, $password);
							if($res)
							{
								$this->session->set_flashdata('msg', json_encode([1, 'Logged in successfully.']));
								redirect('a/dashboard');
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, 'Invalid email address or password.']));
								redirect('a/login');
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'Invalid recaptcha response received.']));
							redirect('a/login');
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
							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));
						}
						redirect('a/login');
					}
				}
				else
				{
					if($this->fv->run() === true)
					{
						$email = $this->input->post('email');
						$password = $this->input->post('password');
						$res = $this->admin->login($email, $password);
						if($res)
						{
							$this->session->set_flashdata('msg', json_encode([1, 'Logged in successfully.']));
							redirect('a/dashboard');
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'Invalid email address or password.']));
							redirect('a/login');
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
							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));
						}
						redirect('a/login');
					}
				}
			}
			else
			{
				$data['title'] = 'Login';
				$this->load->view('form/includes/header.php', $data);
				$this->load->view('form/admin/login.php');
				$this->load->view('form/includes/footer.php');
			}
		}
		else
		{
			redirect('a/dashboard');
		}
	}

	function forget()
	{
		if(!$this->admin->is_logged())
		{
			if($this->input->post('forget'))
			{
				$this->fv->set_rules('email', 'Email address', ['trim', 'required', 'valid_email']);
				if($this->fv->run() === true)
				{
					$email = $this->input->post('email');
					$this->admin->reset_password($email);
					$this->session->set_flashdata('msg', json_encode([1, 'Please check your inbox for further instructions.']));
					redirect('a/login');
				}
				else
				{
					if(validation_errors() !== '')
					{
						$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));
					}
					redirect('a/login');
				}
			}
			else
			{
				$data['title'] = 'Login';
				$this->load->view('form/includes/header.php', $data);
				$this->load->view('form/admin/forget.php');
				$this->load->view('form/includes/footer.php');
			}
		}
		else
		{
			redirect('a/dashboard');
		}
	}

	function logout($status = 1, $msg = '')
	{
		if($this->admin->logout())
		{
			if($msg !== '')
			{
				$this->session->set_flashdata('msg', json_encode([$status, $msg]));
			}
			else
			{
				$this->session->set_flashdata('msg', json_encode([1, 'Logged out successfully.']));
			}
			redirect('a/login');
		}
		else
		{
			$this->session->set_flashdata('msg', json_encode([0, 'Login to continue.']));
			redirect('a/login');
		}
	}

	function settings()
	{
		if($this->admin->is_logged())
		{
			if($this->input->post('update_theme'))
			{
				set_cookie('theme', $this->input->post('theme'), 30*86400);
				$this->session->set_flashdata('msg', json_encode([1, 'Theme changed successfully.']));
				redirect('a/settings');
			}
			elseif($this->input->post('update_name'))
			{
				$this->fv->set_rules('name', 'Name', ['trim', 'required', 'valid_name']);
				if($this->fv->run() === true)
				{
					$name = $this->input->post('name');
					$res = $this->admin->set_name($name);
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'User name updated successfully.']));
						redirect('a/settings');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
						redirect('a/settings');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('a/settings');
				}
			}
			elseif($this->input->post('update_password'))
			{
				$this->fv->set_rules('password', 'New password', ['trim', 'required']);
				$this->fv->set_rules('password1', 'Confirm password', ['trim', 'required', 'matches[password]']);
				$this->fv->set_rules('old_password', 'Old password', ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$password = $this->input->post('password');
					$old_password = $this->input->post('old_password');
					$res = $this->admin->set_password($old_password, $password);
					if($res !== false)
					{
						$this->logout(1, 'User password updated successfully.');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
						redirect('a/settings');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('a/settings');
				}
			}
			else
			{
				$data['title'] = 'Settings';

				$this->load->view('page/includes/admin/header', $data);
				$this->load->view('page/includes/admin/navbar');
				$this->load->view('page/admin/settings');
				$this->load->view('page/includes/admin/footer');
			}

		}
		else
		{
			redirect('a/login');
		}
	}

	function api_settings()
	{

		if($this->admin->is_logged())
		{
			if($this->input->post('update_host'))
			{
				$this->fv->set_rules('hostname', 'Host Name', ['trim', 'required', 'valid_name']);
				$this->fv->set_rules('email', 'Alert Email', ['trim', 'required', 'valid_email']);
				$this->fv->set_rules('fourm', 'Fourm URL', ['trim', 'required', 'valid_url']);
				$this->fv->set_rules('status', 'Status', ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$name = $this->input->post('hostname');
					$email = $this->input->post('email');
					$status = $this->input->post('status');
					$fourm = $this->input->post('fourm');
					$res = $this->base->set_hostname($name);
					$res = $this->base->set_email($email);
					$res = $this->base->set_status($status);
					$res = $this->base->set_fourm($fourm);
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'General settings updated successfully.']));
						redirect('a/api_settings');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
						redirect('a/api_settings');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('a/api_settings');
				}
			}
			elseif($this->input->post('update_smtp'))
			{
				$this->fv->set_rules('hostname', 'Hostname', ['trim', 'required']);
				$this->fv->set_rules('name', 'From Name', ['trim', 'required', 'valid_name']);
				$this->fv->set_rules('from', 'From Email', ['trim', 'required', 'valid_email']);
				$this->fv->set_rules('username', 'Username', ['trim', 'required']);
				$this->fv->set_rules('password', 'Password', ['trim', 'required']);
				$this->fv->set_rules('port', 'Port', ['trim', 'required']);
				$this->fv->set_rules('status', 'Status', ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$hostname = $this->input->post('hostname');
					$name = $this->input->post('name');
					$from = $this->input->post('from');
					$username = $this->input->post('username');
					$port = $this->input->post('port');
					$status = $this->input->post('status');
					$password = $this->input->post('password');
					$res = $this->smtp->set_hostname($hostname);
					$res = $this->smtp->set_username($username);
					$res = $this->smtp->set_status($status);
					$res = $this->smtp->set_password($password);
					$res = $this->smtp->set_from($from);
					$res = $this->smtp->set_name($name);
					$res = $this->smtp->set_port($port);
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'SMTP settings updated successfully.']));
						redirect('a/api_settings');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
						redirect('a/api_settings');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('a/api_settings');
				}
			}
			elseif($this->input->post('update_grc'))
			{
				$this->fv->set_rules('site_key', 'Site key', ['trim', 'required']);
				$this->fv->set_rules('secret_key', 'Secret key', ['trim', 'required']);
				$this->fv->set_rules('status', 'Status', ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$site_key = $this->input->post('site_key');
					$secret_key = $this->input->post('secret_key');
					$status = $this->input->post('status');
					$res = $this->grc->set_site_key($site_key);
					$res = $this->grc->set_secret_key($secret_key);
					$res = $this->grc->set_status($status);
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'Google recaptcha settings updated successfully.']));
						redirect('a/api_settings');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
						redirect('a/api_settings');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('a/api_settings');
				}
			}
			elseif($this->input->post('update_mofh'))
			{
				$this->fv->set_rules('username', 'Username', ['trim', 'required']);
				$this->fv->set_rules('password', 'Password', ['trim', 'required']);
				$this->fv->set_rules('cpanel', 'cPanel URL', ['trim', 'required']);
				$this->fv->set_rules('ns_1', 'Nameserver 1', ['trim', 'required']);
				$this->fv->set_rules('ns_2', 'Nameserver 2', ['trim', 'required']);
				$this->fv->set_rules('package', 'Package', ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$username = $this->input->post('username');
					$cpanel = $this->input->post('cpanel');
					$password = $this->input->post('password');
					$ns_1 = $this->input->post('ns_1');
					$ns_2 = $this->input->post('ns_2');
					$package = $this->input->post('package');
					$res = $this->mofh->set_username($username);
					$res = $this->mofh->set_password($password);
					$res = $this->mofh->set_cpanel($cpanel);
					$res = $this->mofh->set_ns_1($ns_1);
					$res = $this->mofh->set_ns_2($ns_2);
					$res = $this->mofh->set_package($package);
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'MOFH settings updated successfully.']));
						redirect('a/api_settings');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
						redirect('a/api_settings');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('a/api_settings');
				}
			}
			elseif($this->input->get('test_mail'))
			{
				$res = $this->mailer->test_mail();
				if($res)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'Test email sent successfully.']));
					redirect("a/api_settings");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/api_settings");
				}
			}
			elseif($this->input->get('test_mofh'))
			{
				$res = $this->mofh->test_mofh();
				if($res === true)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'Mofh api working successfully.']));
					redirect("a/api_settings");
				}
				elseif($res === false)
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/api_settings");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, $res]));
					redirect("a/api_settings");
				}
			}
			else
			{
				$data['title'] = 'Api Settings';
				$data['active'] = 'api';

				$this->load->view('page/includes/admin/header', $data);
				$this->load->view('page/includes/admin/navbar');
				$this->load->view('page/admin/api_settings');
				$this->load->view('page/includes/admin/footer');
			}
		}
		else
		{
			redirect('a/login');
		}
	}

	function dashboard()
	{
		if($this->admin->is_logged())
		{
			$data['title'] = 'Dashboard';
			$data['active'] = 'home';
			$data['ci_clients'] = count($this->user->list_users());
			$data['ci_accounts'] = count($this->account->get_accounts());
			$data['ci_tickets'] = count($this->ticket->get_tickets());
			$data['ci_templates'] = count($this->mailer->get_user_templates());

			$this->load->view('page/includes/admin/header', $data);
			$this->load->view('page/includes/admin/navbar');
			$this->load->view('page/admin/dashboard');
			$this->load->view('page/includes/admin/footer');
		}
		else
		{
			redirect('a/login');
		}
	}

	function email_templates()
	{
		if($this->admin->is_logged())
		{
			$data['title'] = 'Email Templates';
			$data['active'] = 'email';
			$data['list'] = $this->mailer->get_user_templates();
			
			$this->load->view('page/includes/admin/header', $data);
			$this->load->view('page/includes/admin/navbar');
			$this->load->view('page/admin/email_templates');
			$this->load->view('page/includes/admin/footer');
		}
		else
		{
			redirect('a/login');
		}
	}

	function edit_email($id)
	{
		if($this->admin->is_logged())
		{
			$id = $this->security->xss_clean($id);
			if($this->input->post('update'))
			{
				$this->fv->set_rules('subject', 'Subject', ['trim', 'required']);
				$this->fv->set_rules('content', 'Content', ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$subject = $this->input->post('subject');
					$content = $this->input->post('content');
					$res = $this->mailer->set_template(['subject' => $subject, 'content' => $content], $id);
					if($res)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'Email template updated successfully.']));
						redirect("a/edit_email/$id");
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
						redirect("a/edit_email/$id");
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
						$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));
					}
					redirect("a/edit_email/$id");
				}
			}
			else
			{
				$data['title'] = 'Edit Email';
				$data['active'] = 'email';
				$data['email'] = $this->mailer->get_template($id);
				
				$this->load->view('page/includes/admin/header', $data);
				$this->load->view('page/includes/admin/navbar');
				$this->load->view('page/admin/edit_email');
				$this->load->view('page/includes/admin/footer');
			}
		}
		else
		{
			redirect('a/login');
		}
	}

	function tickets()
	{
		if($this->admin->is_logged())
		{
			$data['title'] = 'Tickets';
			$data['active'] = 'ticket';
			$data['list'] = $this->ticket->get_tickets();

			$this->load->view('page/includes/admin/header', $data);
			$this->load->view('page/includes/admin/navbar');
			$this->load->view('page/admin/tickets');
			$this->load->view('page/includes/admin/footer');
		}
		else
		{
			redirect('a/login');
		}
	}

	function view_ticket($id)
	{
		if($this->admin->is_logged()){
			$id = $this->security->xss_clean($id);
			if($this->input->get('close'))
			{
				$res = $this->ticket->change_ticket_status($id, 'closed');
				if($res)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'Ticket had been closed successfully.']));
					redirect("a/view_ticket/$id");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/view_ticket/$id");
				}
			}
			elseif($this->input->get('open'))
			{
				$res = $this->ticket->change_ticket_status($id, 'open');
				if($res)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'Ticket had been opened successfully.']));
					redirect("a/view_ticket/$id");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/view_ticket/$id");
				}
			}
			elseif($this->input->post('reply'))
			{
				$this->fv->set_rules('content', 'Content', ['trim', 'required']);
				if($this->grc->is_active())
				{
					$this->fv->set_rules('g-recaptcha-response', 'Recaptcha', ['trim', 'required']);
					if($this->fv->run() === true)
					{
						$content = $this->input->post('content');
						if($this->grc->is_valid($token))
						{
							$res = $this->ticket->add_reply($id, $content, $this->admin->get_key(), 'support');
							if($res)
							{
								$this->session->set_flashdata('msg', json_encode([1, 'Ticket reply added successfully.']));
								redirect("a/view_ticket/$id");
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
								redirect("a/view_ticket/$id");
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'Invalid recaptcha response received.']));
							redirect("a/view_ticket/$id");
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
							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));
						}
						redirect("a/view_ticket/$id");
					}
				}
				else
				{
					if($this->fv->run() === true)
					{
						$content = $this->input->post('content');
						$res = $this->ticket->add_reply($id, $content, $this->admin->get_key(), 'support');
						if($res)
						{
							$this->session->set_flashdata('msg', json_encode([1, 'Ticket reply added successfully.']));
							redirect("a/view_ticket/$id");
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
							redirect("a/view_ticket/$id");
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
							$this->session->set_flashdata('msg', json_encode([0, 'Please fill all required fields.']));
						}
						redirect("a/view_ticket/$id");
					}
				}
			}
			else
			{
				$data['title'] = 'View Ticket '.$id;
				$data['active'] = 'ticket';
				$data['ticket'] = $this->ticket->view_user_ticket($id);
				if($data['ticket'] !== false)
				{
					$data['replies'] = $this->ticket->get_ticket_reply($id);

					$this->load->view('page/includes/admin/header', $data);
					$this->load->view('page/includes/admin/navbar');
					$this->load->view('page/admin/view_ticket');
					$this->load->view('page/includes/admin/footer');
				}
				else
				{
					redirect('e/error_404');
				}
			}
		}
		else
		{
			redirect('a/login');
		}
	}

	function clients()
	{
		if($this->admin->is_logged())
		{
			$data['title'] = 'Clients';
			$data['active'] = 'client';
			$data['list'] = $this->user->list_users();

			$this->load->view('page/includes/admin/header', $data);
			$this->load->view('page/includes/admin/navbar');
			$this->load->view('page/admin/clients');
			$this->load->view('page/includes/admin/footer');
		}
		else
		{
			redirect('a/login');
		}
	}

	function view_client($id)
	{
		if($this->admin->is_logged()){
			$id = $this->security->xss_clean($id);
			if($this->input->get('active'))
			{
				$res = $this->user->set_status(1, $id);
				if($res)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'Client had been activated successfully.']));
					redirect("a/view_client/$id");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/view_client/$id");
				}
			}
			elseif($this->input->get('login'))
			{
				$res = $this->user->login_me_as($id);
				if($res)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'Logged in successfully.']));
					redirect("a/");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/view_client/$id");
				}
			}
			else
			{
				$data['title'] = 'View Client '.$id;
				$data['active'] = 'client';
				$data['info'] = $this->user->get_info($id);
				if($data['info'] !== false)
				{
					$this->load->view('page/includes/admin/header', $data);
					$this->load->view('page/includes/admin/navbar');
					$this->load->view('page/admin/view_client');
					$this->load->view('page/includes/admin/footer');
				}
				else
				{
					redirect('e/error_404');
				}
			}
		}
		else
		{
			redirect('a/login');
		}
	}

	function domains()
	{
		if($this->admin->is_logged()){
			if($this->input->get('add_domain'))
			{
				$res = $this->mofh->add_ext($this->input->get('domain'));
				if($res)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'Domain extension added successfully.']));
					redirect("a/domains");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/domains");
				}
			}
			elseif($this->input->get('rm_domain'))
			{
				$res = $this->mofh->rm_ext($this->input->get('domain'));
				if($res)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'Domain extension removed successfully.']));
					redirect("a/domains");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/domains");
				}
			}
			else
			{
				$data['title'] = 'Domain Extensions';
				$data['active'] = 'domain';
				$data['list'] = $this->mofh->list_exts();

				$this->load->view('page/includes/admin/header', $data);
				$this->load->view('page/includes/admin/navbar');
				$this->load->view('page/admin/domains');
				$this->load->view('page/includes/admin/footer');
			}
		}
		else
		{
			redirect('a/login');
		}
	}

	function accounts()
	{
		if($this->admin->is_logged())
		{
			$data['title'] = 'Accounts';
			$data['active'] = 'account';
			$data['list'] = $this->account->get_accounts();
			
			$this->load->view('page/includes/admin/header', $data);
			$this->load->view('page/includes/admin/navbar');
			$this->load->view('page/admin/accounts');
			$this->load->view('page/includes/admin/footer');
		}
		else
		{
			redirect('a/login');
		}
	}

	function view_account($id)
	{
		if($this->admin->is_logged())
		{
			$id = $this->security->xss_clean($id);
			if($this->input->get('login'))
			{
				$res = $this->account->get_account($id);
				if($res !== false)
				{
					$data['username'] = $res['account_username'];
					$data['password'] = $res['account_password'];
					$this->load->view('page/admin/cpanel_login', $data);
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/view_account/$id");
				}
			}
			elseif($this->input->get('reactivate'))
			{
				$res = $this->account->get_account($id);
				if($res !== false)
				{
					if($res['account_status'] === 'suspended' OR $res['account_status'] === 'deactivated')
					{
						$res = $this->mofh->reactivate_account($res['account_key']);
						if($res !== false)
						{
							$this->session->set_flashdata('msg', json_encode([1, 'Account reactivated successfully.']));
							redirect("a/view_account/$id");
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
							redirect("a/view_account/$id");
						}
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'Unable to reactivate account.']));
						redirect("a/view_account/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/view_account/$id");
				}
			}
			else
			{
				$data['title'] = 'View Account';
				$data['active'] = 'account';
				$data['id'] = $id;
				$data['data'] = $this->account->get_account($id);
				if($data['data'] !== false)
				{
					$this->load->view('page/includes/admin/header', $data);
					$this->load->view('page/includes/admin/navbar');
					$this->load->view('page/admin/view_account');
					$this->load->view('page/includes/admin/footer');
				}
				else
				{
					redirect('e/error_404');
				}
			}
		}
		else
		{
			redirect('a/login');
		}
	}

	function account_settings($id)
	{
		if($this->admin->is_logged())
		{
			$id = $this->security->xss_clean($id);
			if($this->input->post('update_label'))
			{
				$res = $this->account->get_account($id);
				if($res !== false)
				{
					$res = $this->account->set_label($id, $this->input->post('label'));
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'Account label updated successfully.']));
						redirect("a/account_settings/$id");
					}
						else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
						redirect("a/account_settings/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/account_settings/$id");
				}
			}
			elseif($this->input->get('update_password'))
			{
				$res = $this->account->get_account($id);
				if($res !== false)
				{
					if(strlen($this->input->post('password')) > 4 AND strlen($this->input->post('old_password')) > 4)
					{
						$res = $this->account->change_account_password($id, $this->input->post('password'), $this->input->post('old_password'));
						if($res !== false)
						{
							$this->session->set_flashdata('msg', json_encode([1, 'Account password updated successfully.']));
							redirect("a/account_settings/$id");
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
							redirect("a/account_settings/$id");
						}
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'Unable to delete account.']));
							redirect("a/account_settings/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/account_settings/$id");
				}
			}
			elseif($this->input->get('deactivate'))
			{
				$res = $this->account->get_account($id);
				if($res !== false)
				{
					if($res['account_status'] === 'active')
					{
						$res = $this->mofh->deactivate_account($id, $this->input->post('reason'));
						if($res !== false)
						{
							$this->session->set_flashdata('msg', json_encode([1, 'Account deactivated successfully.']));
							redirect("a/account_settings/$id");
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
							redirect("a/account_settings/$id");
						}
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'Unable to delete account.']));
							redirect("a/account_settings/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					redirect("a/account_settings/$id");
				}
			}
			else
			{
				$data['title'] = 'Account Settings';
				$data['active'] = 'account';
				$data['id'] = $id;
				$data['data'] = $this->account->get_account($id);
				if($data['data'] !== false)
				{
					$this->load->view('page/includes/admin/header', $data);
					$this->load->view('page/includes/admin/navbar');
					$this->load->view('page/admin/account_settings');
					$this->load->view('page/includes/admin/footer');
				}
				else
				{
					redirect('e/error_404');
				}
			}
		}
		else
		{
			redirect('a/login');
		}
	}
}

?>
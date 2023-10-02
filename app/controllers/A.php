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
		$this->load->model(['gogetssl' => 'ssl']);
		$this->load->model(['sitepro' => 'sp']);
		$this->load->model('mofh');
		$this->load->model('oauth');
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
			redirect('admin/register');
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
					if($this->grc->get_type() == "google")
					{
						$this->fv->set_rules('g-recaptcha-response', 'Recaptcha', ['trim', 'required']);
					}
					elseif($this->grc->get_type() == "crypto")
					{
						$this->fv->set_rules('CRLT-captcha-token', 'Recaptcha', ['trim', 'required']);
					}
					else
					{
						$this->fv->set_rules('h-captcha-response', 'Recaptcha', ['trim', 'required']);
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
							if(!$this->admin->is_register($email))
							{
								$res = $this->admin->register($name, $email, $password);
								if($res)
								{
									$this->session->set_flashdata('msg', json_encode([1, 'User has been registered successfully.']));
									redirect('admin/login');
								}
								else
								{
									$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
									redirect('admin/register');
								}
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, 'A user with this email address already exists.']));
								redirect('admin/register');
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'Invalid captcha response received.']));
							redirect('admin/register');
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
						redirect('admin/register');
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
								$this->session->set_flashdata('msg', json_encode([1, 'User has been registered successfully.']));
									redirect('admin/login');
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
							}
							redirect('admin/register');
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'A user with this email address already exists.']));
							redirect('admin/register');
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
						redirect('admin/register');
					}
				}
			}
			else
			{
				$data['title'] = 'Register';
				$this->load->view($this->base->get_template().'/form/includes/admin/header.php', $data);
				$this->load->view($this->base->get_template().'/form/admin/register.php');
				$this->load->view($this->base->get_template().'/form/includes/admin/footer.php');
			}
		}
		else
		{
			redirect('admin');
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
					if($this->grc->get_type() == "google")
					{
						$this->fv->set_rules('g-recaptcha-response', 'Recaptcha', ['trim', 'required']);
					}
					elseif($this->grc->get_type() == "crypto")
					{
						$this->fv->set_rules('CRLT-captcha-token', 'Recaptcha', ['trim', 'required']);
					}
					else
					{
						$this->fv->set_rules('h-captcha-response', 'Recaptcha', ['trim', 'required']);
					}
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
							$res = $this->admin->login($email, $password, $days);
							if($res)
							{
								$this->session->set_flashdata('msg', json_encode([1, 'Logged in successfully.']));
								redirect('admin');
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, 'Invalid email address or password.']));
								redirect('admin/login');
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'Invalid recaptcha response received.']));
							redirect('admin/login');
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
						redirect('admin/login');
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
						$res = $this->admin->login($email, $password, $days);
						if($res)
						{
							$this->session->set_flashdata('msg', json_encode([1, 'Logged in successfully.']));
							redirect('admin');
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'Invalid email address or password.']));
							redirect('admin/login');
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
						redirect('admin/login');
					}
				}
			}
			else
			{
				$data['title'] = 'Login';
				$this->load->view($this->base->get_template().'/form/includes/admin/header.php', $data);
				$this->load->view($this->base->get_template().'/form/admin/login.php');
				$this->load->view($this->base->get_template().'/form/includes/admin/footer.php');
			}
		}
		else
		{
			redirect('admin');
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
					redirect('admin/login');
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
					redirect('admin/forget');
				}
			}
			else
			{
				$data['title'] = 'Login';
				$this->load->view($this->base->get_template().'/form/includes/admin/header.php', $data);
				$this->load->view($this->base->get_template().'/form/admin/forget.php');
				$this->load->view($this->base->get_template().'/form/includes/admin/footer.php');
			}
		}
		else
		{
			redirect('admin');
		}
	}

	function reset_password($token)
	{
		if(!$this->admin->is_logged())
		{
			$json = base64_decode($token);
			$arr = json_decode($json, true);
			$email = $arr['email'];
			$key = $arr['token'];
			$time = $arr['time'];
			$admin = $this->admin->fetch_where('email', $email);
			if(time() > $time + 3600)
			{
				$this->session->set_flashdata('msg', json_encode([0, 'Password reset token expired.']));
				redirect('admin/login');
			}
			elseif($admin !== false)
			{
				$verify = char32($email.':'.$admin['admin_rec'].':'.$time.':'.$admin['admin_key']);
				if($verify == $key)
				{
					if($this->input->post('reset'))
					{
						$this->fv->set_rules('password', 'Password', ['trim', 'required']);
						$this->fv->set_rules('password1', 'Confirm Password', ['trim', 'required', 'matches[password]']);
						if($this->fv->run() === true)
						{
							$password = $this->input->post('password');
							$res = $this->admin->reset_admin_password($password, $email);
							if($res !== false)
							{
								$this->session->set_flashdata('msg', json_encode([1, 'Password reset successfully.']));
								redirect('admin/login');
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
								redirect('admin/login');
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
							redirect('admin/login');
						}
					}
					else
					{
						$data['title'] = 'Reset Password';
						$data['token'] = $token;
						$this->load->view($this->base->get_template().'/form/includes/admin/header.php', $data);
						$this->load->view($this->base->get_template().'/form/admin/reset_password.php');
						$this->load->view($this->base->get_template().'/form/includes/admin/footer.php');	
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'Invalid password reset token.']));
					redirect('admin/login');
				}
			}
			else
			{
				$this->session->set_flashdata('msg', json_encode([0, 'Invalid password reset token.']));
				redirect('admin/login');
			}
		}
		else
		{
			redirect('admin');
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
			redirect('admin/login');
		}
		else
		{
			$this->session->set_flashdata('msg', json_encode([0, 'Login to continue.']));
			redirect('admin/login');
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
				redirect('admin/settings');
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
						redirect('admin/settings');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect('admin/settings');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('admin/settings');
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
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect('admin/settings');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('admin/settings');
				}
			}
			else
			{
				$data['title'] = 'Settings';

				$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
				$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
				$this->load->view($this->base->get_template().'/page/admin/settings');
				$this->load->view($this->base->get_template().'/page/includes/admin/footer');
			}

		}
		else
		{
			redirect('admin/login');
		}
	}

	function api_settings()
	{

		if($this->admin->is_logged())
		{
			if($this->input->post('update_host'))
			{
				$this->fv->set_rules('hostname', 'Host Name', ['trim', 'required']);
				$this->fv->set_rules('email', 'Alert Email', ['trim', 'required', 'valid_email']);
				$this->fv->set_rules('fourm', 'Fourm URL', ['trim', 'required', 'valid_url']);
				$this->fv->set_rules('status', 'Status', ['trim', 'required']);
				$this->fv->set_rules('template', 'Template Dir', ['trim', 'required']);
				$this->fv->set_rules('rpp', 'Records Per Page', ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$name = $this->input->post('hostname');
					$email = $this->input->post('email');
					$status = $this->input->post('status');
					$fourm = $this->input->post('fourm');
					$template = $this->input->post('template');
					$rpp = $this->input->post('rpp');
					$res = $this->base->set_hostname($name);
					$res = $this->base->set_email($email);
					$res = $this->base->set_status($status);
					$res = $this->base->set_fourm($fourm);
					$res = $this->base->set_template($template);
					$res = $this->base->set_rpp($rpp);
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'General settings updated successfully.']));
						redirect('api/settings');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect('api/settings');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('api/settings');
				}
			}
			elseif($this->input->post('update_smtp'))
			{
				$this->fv->set_rules('hostname', 'Hostname', ['trim', 'required']);
				$this->fv->set_rules('name', 'From Name', ['trim', 'required']);
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
						redirect('api/settings?smtp=1');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect('api/settings?smtp=1');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('api/settings?smtp=1');
				}
			}
			elseif($this->input->post('update_grc'))
			{
				$this->fv->set_rules('site_key', 'Site key', ['trim', 'required']);
				$this->fv->set_rules('secret_key', 'Secret key', ['trim', 'required']);
				$this->fv->set_rules('status', 'Status', ['trim', 'required']);
				$this->fv->set_rules('type', 'Type', ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$site_key = $this->input->post('site_key');
					$secret_key = $this->input->post('secret_key');
					$status = $this->input->post('status');
					$type = $this->input->post('type');
					$res = $this->grc->set_site_key($site_key);
					$res = $this->grc->set_secret_key($secret_key);
					$res = $this->grc->set_status($status);
					$res = $this->grc->set_type($type);
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'Captcha settings updated successfully.']));
						redirect('api/settings?captcha=1');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect('api/settings?captcha=1');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('api/settings?captcha=1');
				}
			}
			elseif($this->input->post('update_ssl'))
			{
				$this->fv->set_rules('username', 'Username', ['trim', 'required']);
				$this->fv->set_rules('password', 'Password', ['trim', 'required']);
				$this->fv->set_rules('status', 'Status', ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					$status = $this->input->post('status');
					$res = $this->ssl->set_username($username);
					$res = $this->ssl->set_password($password);
					$res = $this->ssl->set_status($status);
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'GoGetSSL settings updated successfully.']));
						redirect('api/settings?ssl=1');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect('api/settings?ssl=1');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('api/settings?ssl=1');
				}
			}
			elseif($this->input->post('update_github'))
			{
				$this->fv->set_rules('client', 'Client Key', ['trim', 'required']);
				$this->fv->set_rules('secret', 'Secret Key', ['trim', 'required']);
				$this->fv->set_rules('endpoint', 'Endpoint URL', ['trim', 'required']);
				$this->fv->set_rules('status', 'Status', ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$id = $this->input->post('service');
					$client = $this->input->post('client');
					$secret = $this->input->post('secret');
					$endpoint = $this->input->post('endpoint');
					$status = $this->input->post('status');
					$res = $this->oauth->set_client($id, $client);
					$res = $this->oauth->set_secret($id, $secret);
					$res = $this->oauth->set_endpoint($id, $endpoint);
					$res = $this->oauth->set_status($id, $status);
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'GitHub oauth settings updated successfully.']));
						redirect('api/settings?oauth=1');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect('api/settings?oauth=1');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('api/settings?oauth=1');
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
						redirect('api/settings?mofh=1');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect('api/settings?mofh=1');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('api/settings?mofh=1');
				}
			}
			elseif($this->input->post('update_sp'))
			{
				$this->fv->set_rules('hostname', 'Hostname', ['trim', 'required']);
				$this->fv->set_rules('username', 'Username', ['trim', 'required']);
				$this->fv->set_rules('password', 'Password', ['trim', 'required']);
				$this->fv->set_rules('status', 'Status', ['trim', 'required']);
				if($this->fv->run() === true)
				{
					$hostname = $this->input->post('hostname');
					$username = $this->input->post('username');
					$status = $this->input->post('status');
					$password = $this->input->post('password');
					$res = $this->sp->set_hostname($hostname);
					$res = $this->sp->set_username($username);
					$res = $this->sp->set_status($status);
					$res = $this->sp->set_password($password);
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'SitePro settings updated successfully.']));
						redirect('api/settings?sitepro=1');
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect('api/settings?sitepro=1');
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, validation_errors()]));
					redirect('api/settings?sitepro=1');
				}
			}
			elseif($this->input->get('test_mail'))
			{
				$res = $this->mailer->test_mail();
				if($res)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'Test email sent successfully.']));
					redirect("api/settings?smtp=1");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("api/settings?smtp=1");
				}
			}
			elseif($this->input->get('test_mofh'))
			{
				$res = $this->mofh->test_mofh();
				if($res === true)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'MOFH API working successfully.']));
					redirect("api/settings?mofh=1");
				}
				elseif($res === false)
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("api/settings?mofh=1");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, $res]));
					redirect("api/settings?mofh=1");
				}
			}
			else
			{
				$data['title'] = 'API Settings';
				$data['active'] = 'settings';

				$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
				$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
				$this->load->view($this->base->get_template().'/page/admin/api_settings');
				$this->load->view($this->base->get_template().'/page/includes/admin/footer');
			}
		}
		else
		{
			redirect('admin/login');
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

			$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
			$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
			$this->load->view($this->base->get_template().'/page/admin/dashboard');
			$this->load->view($this->base->get_template().'/page/includes/admin/footer');
		}
		else
		{
			redirect('admin/login');
		}
	}

	function email_templates()
	{
		if($this->admin->is_logged())
		{
			$data['title'] = 'Email Templates';
			$data['active'] = 'settings';
			$data['list'] = $this->mailer->get_user_templates();
			
			$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
			$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
			$this->load->view($this->base->get_template().'/page/admin/email_templates');
			$this->load->view($this->base->get_template().'/page/includes/admin/footer');
		}
		else
		{
			redirect('admin/login');
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
					$content = $this->input->post('content', false);
					$res = $this->mailer->set_template(['subject' => $subject, 'content' => $content], $id);
					if($res)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'Email template updated successfully.']));
						redirect("email/edit/$id");
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect("email/edit/$id");
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
					redirect("email/edit/$id");
				}
			}
			else
			{
				$data['title'] = 'Edit Email';
				$data['active'] = 'email';
				$data['email'] = $this->mailer->get_template($id);
				
				$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
				$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
				$this->load->view($this->base->get_template().'/page/admin/edit_email');
				$this->load->view($this->base->get_template().'/page/includes/admin/footer');
			}
		}
		else
		{
			redirect('admin/login');
		}
	}

	function tickets()
	{
		if($this->admin->is_logged())
		{
			$data['title'] = 'Tickets';
			$data['active'] = 'ticket';
			$count = $this->input->get('page') ?? 0;
			$data['list'] = $this->ticket->get_tickets($count);

			$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
			$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
			$this->load->view($this->base->get_template().'/page/admin/tickets');
			$this->load->view($this->base->get_template().'/page/includes/admin/footer');
		}
		else
		{
			redirect('admin/login');
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
					$this->session->set_flashdata('msg', json_encode([1, 'Ticket has been closed successfully.']));
					redirect("admin/ticket/list/$id");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("admin/ticket/list/$id");
				}
			}
			elseif($this->input->get('open'))
			{
				$res = $this->ticket->change_ticket_status($id, 'open');
				if($res)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'Ticket has been opened successfully.']));
					redirect("admin/ticket/list/$id");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("admin/ticket/list/$id");
				}
			}
			elseif($this->input->post('reply'))
			{
				$this->fv->set_rules('content', 'Content', ['trim', 'required']);
				if($this->grc->is_active())
				{
					if($this->grc->get_type() == "google")
					{
						$this->fv->set_rules('g-recaptcha-response', 'Recaptcha', ['trim', 'required']);
					}
					elseif($this->grc->get_type() == "crypto")
					{
						$this->fv->set_rules('CRLT-captcha-token', 'Recaptcha', ['trim', 'required']);
					}
					else
					{
						$this->fv->set_rules('h-captcha-response', 'Recaptcha', ['trim', 'required']);
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
							$res = $this->ticket->add_reply($id, $content, $this->admin->get_key(), 'support');
							if($res)
							{
								$this->session->set_flashdata('msg', json_encode([1, 'Ticket reply added successfully.']));
								redirect("admin/ticket/list/$id");
							}
							else
							{
								$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
								redirect("admin/ticket/list/$id");
							}
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'Invalid captcha response received.']));
							redirect("admin/ticket/list/$id");
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
						redirect("admin/ticket/list/$id");
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
							redirect("admin/ticket/list/$id");
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
							redirect("admin/ticket/list/$id");
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
						redirect("admin/ticket/list/$id");
					}
				}
			}
			else
			{
				$data['title'] = 'View Ticket '.$id;
				$data['active'] = 'ticket';
				$data['ticket'] = $this->ticket->view_ticket($id);
				if($data['ticket'] !== false)
				{
					$data['replies'] = $this->ticket->get_ticket_reply($id);

					$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
					$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
					$this->load->view($this->base->get_template().'/page/admin/view_ticket');
					$this->load->view($this->base->get_template().'/page/includes/admin/footer');
				}
				else
				{
					redirect('404');
				}
			}
		}
		else
		{
			redirect('admin/login');
		}
	}

	function clients()
	{
		if($this->admin->is_logged())
		{
			$data['title'] = 'Clients';
			$data['active'] = 'client';
			$count = $this->input->get('page') ?? 0;
			$data['list'] = $this->user->list_users($count);

			$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
			$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
			$this->load->view($this->base->get_template().'/page/admin/clients');
			$this->load->view($this->base->get_template().'/page/includes/admin/footer');
		}
		else
		{
			redirect('admin/login');
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
					$this->session->set_flashdata('msg', json_encode([1, 'Client has been activated successfully.']));
					redirect("client/view/$id");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("client/view/$id");
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
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("client/view/$id");
				}
			}
			else
			{
				$data['title'] = 'View Client '.$id;
				$data['active'] = 'client';
				$data['info'] = $this->user->get_info($id);
				if($data['info'] !== false)
				{
					$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
					$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
					$this->load->view($this->base->get_template().'/page/admin/view_client');
					$this->load->view($this->base->get_template().'/page/includes/admin/footer');
				}
				else
				{
					redirect('404');
				}
			}
		}
		else
		{
			redirect('admin/login');
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
					redirect("domain/list");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("domain/list");
				}
			}
			elseif($this->input->get('rm_domain'))
			{
				$res = $this->mofh->rm_ext($this->input->get('domain'));
				if($res)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'Domain extension removed successfully.']));
					redirect("domain/list");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("domain/list");
				}
			}
			else
			{
				$data['title'] = 'Domain Extensions';
				$data['active'] = 'settings';
				$data['list'] = $this->mofh->list_exts();

				$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
				$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
				$this->load->view($this->base->get_template().'/page/admin/domains');
				$this->load->view($this->base->get_template().'/page/includes/admin/footer');
			}
		}
		else
		{
			redirect('admin/login');
		}
	}

	function accounts()
	{
		if($this->admin->is_logged())
		{
			$data['title'] = 'Accounts';
			$data['active'] = 'account';
			$count = $this->input->get('page') ?? 0;
			$data['list'] = $this->account->get_accounts($count);
			
			$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
			$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
			$this->load->view($this->base->get_template().'/page/admin/accounts');
			$this->load->view($this->base->get_template().'/page/includes/admin/footer');
		}
		else
		{
			redirect('admin/login');
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
					$this->load->view($this->base->get_template().'/page/admin/cpanel_login', $data);
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("admin/account/view/$id");
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
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect("admin/account/view/$id");
					}
					elseif($link['success'] == true)
					{
						 header('location: '.$link['url']); 
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, $link['msg']]));
						redirect("admin/account/view/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("admin/account/view/$id");
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
						if(!is_bool($res))
						{
							$this->session->set_flashdata('msg', json_encode([0, $res]));
							redirect("admin/account/view/$id");
						}
						elseif($res !== false)
						{
							$this->session->set_flashdata('msg', json_encode([1, 'Account reactivated successfully.']));
							redirect("admin/account/view/$id");
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
							redirect("admin/account/view/$id");
						}
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'Unable to reactivate account.']));
						redirect("admin/account/view/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("admin/account/view/$id");
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
					$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
					$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
					$this->load->view($this->base->get_template().'/page/admin/view_account');
					$this->load->view($this->base->get_template().'/page/includes/admin/footer');
				}
				else
				{
					redirect('404');
				}
			}
		}
		else
		{
			redirect('admin/login');
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
						redirect("admin/account/settings/$id");
					}
						else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
						redirect("admin/account/settings/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("admin/account/settings/$id");
				}
			}
			elseif($this->input->post('update_password'))
			{
				$res = $this->account->get_account($id);
				if($res !== false)
				{
					if(strlen($this->input->post('password')) > 4 AND strlen($this->input->post('old_password')) > 4)
					{
						$res = $this->account->change_account_password($id, $this->input->post('password'), $this->input->post('old_password'));
						if(!is_bool($res))
						{
							$this->session->set_flashdata('msg', json_encode([0, $res]));
							redirect("a/view_settings/$id");
						}
						elseif($res !== false)
						{
							$this->session->set_flashdata('msg', json_encode([1, 'Account password updated successfully.']));
							redirect("admin/account/settings/$id");
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
							redirect("admin/account/settings/$id");
						}
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'Unable to delete account.']));
							redirect("admin/account/settings/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("admin/account/settings/$id");
				}
			}
			elseif($this->input->post('deactivate'))
			{
				$res = $this->account->get_account($id);
				if($res !== false)
				{
					if($res['account_status'] === 'active')
					{
						$res = $this->mofh->deactivate_account($res['account_key'], $this->input->post('reason'));
						if(!is_bool($res))
						{
							$this->session->set_flashdata('msg', json_encode([0, $res]));
							redirect("admin/account/settings/$id");
						}
						elseif($res !== false)
						{
							$this->session->set_flashdata('msg', json_encode([1, 'Account deactivated successfully.']));
							redirect("a/accounts");
						}
						else
						{
							$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
							redirect("admin/account/settings/$id");
						}
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'Unable to delete account.']));
							redirect("admin/account/settings/$id");
					}
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("admin/account/settings/$id");
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
					$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
					$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
					$this->load->view($this->base->get_template().'/page/admin/account_settings');
					$this->load->view($this->base->get_template().'/page/includes/admin/footer');
				}
				else
				{
					redirect('404');
				}
			}
		}
		else
		{
			redirect('admin/login');
		}
	}
	
	function ssl()
	{
		if($this->admin->is_logged())
		{
			$data['title'] = 'SSL Certificates';
			$data['active'] = 'ssl';
			$count = $this->input->get('page') ?? 0;
			$data['list'] = $this->ssl->get_ssl_list_all($count);
			
			$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
			$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
			$this->load->view($this->base->get_template().'/page/admin/ssl');
			$this->load->view($this->base->get_template().'/page/includes/admin/footer');
		}
		else
		{
			redirect('admin/login');
		}
	}

	function view_ssl($id)
	{
		if($this->admin->is_logged())
		{
			$id = $this->security->xss_clean($id);
			if($this->input->get('delete'))
			{
				$this->db->where(['key' => $id]);
				$res = $this->db->delete('is_ssl');
				if($res !== false)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'SSL certificate deleted successfully.']));
					redirect("admin/ssl/view/$id");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("admin/ssl/view/$id");
				}
			}
			elseif($this->input->get('cancel'))
			{
				$res = $this->ssl->cancel_ssl($id, 'Some Reason');
				if(!is_bool($res))
				{
					$this->session->set_flashdata('msg', json_encode([0, $res]));
					redirect("admin/ssl/view/$id");
				}
				if(is_bool($res) AND $res == true)
				{
					$this->session->set_flashdata('msg', json_encode([1, 'SSL certificate cancelled successfully.']));
					redirect("admin/ssl/view/$id");
				}
				else
				{
					$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					redirect("admin/ssl/view/$id");
				}
			}
			else
			{
				$data['title'] = 'View SSL';
				$data['active'] = 'ssl';
				$data['id'] = $id;
				$data['data'] = $this->ssl->get_ssl_info($id);
				if($data['data'] !== false)
				{
					$this->load->view($this->base->get_template().'/page/includes/admin/header', $data);
					$this->load->view($this->base->get_template().'/page/includes/admin/navbar');
					$this->load->view($this->base->get_template().'/page/admin/view_ssl');
					$this->load->view($this->base->get_template().'/page/includes/admin/footer');
				}
				else
				{
					redirect('404');
				}
			}
		}
		else
		{
			redirect('admin/login');
		}
	}
}

?>
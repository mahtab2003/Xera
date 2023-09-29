<?php

class E extends CI_Controller
{
	function index()
	{
		$this->error_404();
	}

	function error_500()
	{
		if (!$this->base->is_active()) {
			$this->load->view($this->base->get_template() . '/errors/custom/error_500');
		} else {
			redirect('user');
		}
	}

	function error_404()
	{
		$this->load->view($this->base->get_template() . '/errors/custom/error_404');
	}

	function error_503()
	{
		$this->load->view($this->base->get_template() . '/errors/custom/error_503');
	}

	function about()
	{
		$this->load->view($this->base->get_template() . '/errors/custom/about');
	}

	function license()
	{
		$this->load->view($this->base->get_template() . '/errors/custom/license');
	}

	function tos()
	{
		$this->load->view($this->base->get_template() . '/errors/custom/tos');
	}

	function update()
	{
		$this->load->model('admin');
		if ($this->admin->is_logged()) {
			$file = file_get_contents('https://raw.githubusercontent.com/mahtab2003/Xera/updates/check.json');
			$data = json_decode($file, true);
			$version = $data['version'];
			$current = get_version();
			if ($version > $current) {
				if ($this->input->get("update")) {
					if ($version > $current) {
						$c_version = explode('.', $current);
						while ($current !== $version) {
							$c_version[2] += 1;
							$current = implode('.', $c_version);
							$update = file_get_contents('https://raw.githubusercontent.com/mahtab2003/Xera/updates/' . $current . '.json');
							$data = json_decode($update, true);
							if (count($data['files']) > 0) {
								foreach ($data['files'] as $name => $value) {
									file_put_contents(APPPATH . $name, base64_decode($value));
								}
							}
							if (count($data['db']) > 0) {
								foreach ($data['db'] as $value) {
									$query = $this->db->query($value);
								}
							}
						}
					}
					redirect("e/about");
				} else {
					$this->load->view($this->base->get_template() . '/errors/custom/update_now', $data);
				}
			} else {
				$this->load->view($this->base->get_template() . '/errors/custom/latest_version');
			}
		} else {
			redirect('e/error_404');
		}
	}

	function activate($token)
	{
		$this->load->model('user');
		$token = $this->security->xss_clean($token);
		$res = $this->user->activate($token);
		if ($res !== false) {
			$this->session->set_flashdata('msg', json_encode([1, 'User activated successfully.']));
		} else {
			$this->session->set_flashdata('msg', json_encode([0, 'Invalid activation token.']));
		}
		redirect('login');
	}

	function error_400()
	{
		$this->load->model('user');
		if (!$this->user->is_logged()) {
			redirect('user');
		} else {
			if ($this->user->is_active()) {
				redirect('user');
			} else {
				if ($this->input->get('resend')) {
					$res = $this->user->resend_email();
					if ($res !== false) {
						$this->session->set_flashdata('msg', json_encode([1, 'Activation email sent successfully.']));
					} else {
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					}
					redirect('e/error_400');
				} elseif ($this->input->get('logout')) {
					$res = $this->user->logout();
					if ($res !== false) {
						$this->session->set_flashdata('msg', json_encode([1, 'Logged out successfully.']));
					} else {
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. Try again later.']));
					}
					redirect('e/error_400');
				} else {
					$this->load->view($this->base->get_template() . '/errors/custom/error_400');
				}
			}
		}
	}
}

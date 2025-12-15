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
			// Fetch constants.php from the main branch to check version
			$opts = [
				"http" => [
					"method" => "GET",
					"header" => "User-Agent: Xera-CE-Updater\r\n"
				]
			];
			$context = stream_context_create($opts);

			// Using Galaxixoff1/Xera-Community-Edition repo
			$remote_file = @file_get_contents('https://raw.githubusercontent.com/Galaxixoff1/Xera-Community-Edition/main/app/config/constants.php', false, $context);

			$version = false;
			if ($remote_file) {
				if (preg_match("/define\('XERA_VERSION', '([^']+)'\);/", $remote_file, $matches)) {
					$version = $matches[1];
				}
			}

			$current = get_version();

			if ($version && version_compare($version, $current, '>')) {
				$data['version'] = $version;
				$data['changelog'] = 'Check GitHub for changelog.'; // Simplified

				if ($this->input->get("update")) {
					// Auto Update Logic via Zip Download
					$zip_url = 'https://github.com/Galaxixoff1/Xera-Community-Edition/archive/refs/heads/main.zip';
					$zip_file = FCPATH . 'update.zip';

					// Download Zip
					if (file_put_contents($zip_file, file_get_contents($zip_url, false, $context))) {
						$zip = new ZipArchive;
						if ($zip->open($zip_file) === TRUE) {
							// Extract to a temp folder first to avoid mess
							$extract_path = FCPATH . 'temp_update/';
							if (!is_dir($extract_path)) mkdir($extract_path);

							$zip->extractTo($extract_path);
							$zip->close();

							// The zip usually contains a folder "Xera-Community-Edition-main"
							$source_dir = $extract_path . 'Xera-Community-Edition-main/';
							if (!is_dir($source_dir)) {
								// Fallback if structure differs
								$dirs = glob($extract_path . '*', GLOB_ONLYDIR);
								if (count($dirs) > 0) $source_dir = $dirs[0] . '/';
							}

							// Recursive copy function
							$this->copy_recursive($source_dir, FCPATH);

							// Cleanup
							$this->delete_recursive($extract_path);
							unlink($zip_file);

							$this->session->set_flashdata('msg', json_encode([1, 'Update completed successfully!']));
							redirect("e/about");
						} else {
							$this->session->set_flashdata('msg', json_encode([0, 'Failed to open update package.']));
							redirect("update");
						}
					} else {
						$this->session->set_flashdata('msg', json_encode([0, 'Failed to download update package.']));
						redirect("update");
					}
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

	private function copy_recursive($src, $dst) {
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				// Exclude config files and install.php to prevent overwrite
				if ($file == 'config.php' && strpos($dst, 'app/config') !== false) continue;
				if ($file == 'database.php' && strpos($dst, 'app/config') !== false) continue;
				if ($file == 'install.php') continue;
				if ($file == 'db.sql') continue;
				if ($file == '.git') continue;

				if ( is_dir($src . '/' . $file) ) {
					$this->copy_recursive($src . '/' . $file, $dst . '/' . $file);
				} else {
					copy($src . '/' . $file, $dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	}

	private function delete_recursive($dir) {
		if (!file_exists($dir)) {
			return true;
		}
		if (!is_dir($dir)) {
			return unlink($dir);
		}
		foreach (scandir($dir) as $item) {
			if ($item == '.' || $item == '..') {
				continue;
			}
			if (!$this->delete_recursive($dir . DIRECTORY_SEPARATOR . $item)) {
				return false;
			}
		}
		return rmdir($dir);
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

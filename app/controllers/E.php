<?php 

class E extends CI_Controller
{
	function index()
	{
		$this->error_404();
	}

	function error_500()
	{
		if(!$this->base->is_active())
		{
			$this->load->view('errors/custom/error_500');
		}
		else
		{
			redirect('u');
		}
	}

	function error_404()
	{
		$this->load->view('errors/custom/error_404');
	}

	function error_503()
	{
		$this->load->view('errors/custom/error_503');
	}

	function about()
	{
		$this->load->view('errors/custom/about');
	}

	function error_400()
	{
		$this->load->model('user');
		if(!$this->user->is_logged())
		{
			redirect('u/');
		}
		else
		{
			if($this->user->is_active())
			{
				redirect('u/');
			}
			else
			{
				if($this->input->get('resend'))
				{
					$res = $this->user->resend_email();
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'Activation email sent successfully.']));
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					}
					redirect('e/error_400');
				}
				elseif($this->input->get('logout'))
				{
					$res = $this->user->logout();
					if($res !== false)
					{
						$this->session->set_flashdata('msg', json_encode([1, 'Logged out successfully.']));
					}
					else
					{
						$this->session->set_flashdata('msg', json_encode([0, 'An error occured. try again later.']));
					}
					redirect('e/error_400');
				}
				else
				{
					$this->load->view('errors/custom/error_400');
				}
			}
		}
	}
}

?>
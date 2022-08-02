<?php

class Go extends CI_Controller
{
	function index()
	{
		redirect("u/dashboard");
	}

	function ifastnet()
	{
		$this->load->view('page/go/ifastnet.php');
	}
}

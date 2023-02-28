<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {
	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('login/index');
		$this->load->view('layouts/footer');
	}
}

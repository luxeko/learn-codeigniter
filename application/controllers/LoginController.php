<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('layouts/header');
		$this->load->view('login/index');
		$this->load->view('layouts/footer');
	}

	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'required',['required' => 'Vui long nhap %s']);
		$this->form_validation->set_rules('password', 'Password', 'required',['required' => 'Vui long nhap %s']);
		if ($this->form_validation->run()) {
			//
		} else {
			$this->index();
		}
	}
}

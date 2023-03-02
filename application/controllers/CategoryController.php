<?php

class CategoryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
	 public function checkLogin()
	 {
	     $user = $this->session->userdata('LoginIn');
	     if (!$user) {
	         redirect(base_url('/login'));
	     }
	 }
    public function index()
    {
		$this->checkLogin();
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->view('category/index');
		$this->load->view('admin_template/footer');
    }

	public function add()
	{
		$this->checkLogin();
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->view('category/create');
		$this->load->view('admin_template/footer');
	}
}

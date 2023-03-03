<?php 

class ProductController extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductModel');
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
		$data['products'] = $this->ProductModel->select();
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->view('product/index', $data);
		$this->load->view('admin_template/footer');
	}
}
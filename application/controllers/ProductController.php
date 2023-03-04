<?php 

class ProductController extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductModel');
		$this->load->model('CategoryModel');
		$this->load->helper('url');
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
	public function getCategory($parentId)
	{
		return $this->CategoryModel->recusive($parentId);
	}
	public function add()
	{
		$this->checkLogin();
		$this->load->helper('url');
		$htmlOption = $this->getCategory($parentId = 0);
		$tags = $this->ProductModel->getTags();
		$data = array(
			'htmlOption' => $htmlOption,
			'tags' => $tags
		);
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->view('product/create', $data);
		$this->load->view('admin_template/footer');
	}
}

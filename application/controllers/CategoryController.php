<?php

class CategoryController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CategoryModel');
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
		$data = $this->CategoryModel->select();
		foreach ($data as $value) {
			$parentName = $this->parentName($value->parentId);
			$value->parentName = $parentName;
		}
		$data = [
			'categories' => $data
		];
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->view('category/index', $data);
		$this->load->view('admin_template/footer');
	}

	public function parentName($parentId)
	{
		$parentName = $this->CategoryModel->getParentName($parentId);
		if (!$parentName) {
			return '';
		} else {
			return $parentName[0]->categoryName;
		}
	}

	public function getCategory($parentId)
	{
		return $this->CategoryModel->recusive($parentId);
	}

	public function add()
	{
		$this->checkLogin();
		$htmlOption = $this->getCategory($parentId = 0);
		$data = array(
			'htmlOption' => $htmlOption
		);
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->view('category/create', $data);
		$this->load->view('admin_template/footer');
	}

	public function create()
	{
		$this->form_validation->set_rules('categoryName', 'CategoryName', 'trim|required|is_unique[categories.categoryName]',
			[
				'required' => 'Vui lòng nhập tên danh mục',
				'is_unique' => 'Tên danh mục đã tồn tại'
			]
		);
		$this->form_validation->set_rules('categoryCode', 'CategoryCode', 'trim|required|is_unique[categories.categoryCode]',
			[
				'required' => 'Vui lòng nhập mã danh mục',
				'is_unique' => 'Mã danh mục đã tồn tại'
			]);
		if ($this->form_validation->run()) {
			$data = [
				'categoryName' => $this->input->post('categoryName'),
				'categoryCode' => $this->input->post('categoryCode'),
				'parentId' => $this->input->post('parentId'),
				'status' => $this->input->post('status'),
				'slug' => $this->input->post('slug'),
				'description' => $this->input->post('description')
			];
			$this->CategoryModel->insert($data);
			$this->session->set_flashdata('success_create', 'Thêm mới thành công');
			redirect(base_url('/cms/categories'));
		} else {
			$this->add();
		}
	}

	public function edit($id)
	{
		$this->checkLogin();
		$data['category'] = $this->CategoryModel->getById($id);
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->view('category/edit', $data);
		$this->load->view('admin_template/footer');
	}

	public function update($id)
	{
		$this->checkLogin();
		$this->form_validation->set_rules('categoryName', 'CategoryName', 'trim|required', ['required' => 'Vui lòng điền tên danh mục']);
		$this->form_validation->set_rules('categoryCode', 'CategoryCode', 'trim|required', ['required' => 'Vui lòng điền mã danh mục']);
		if ($this->form_validation->run()) {
			$date = date('Y-m-d H:i:s');
			$data = [
				'categoryName' => $this->input->post('categoryName'),
				'categoryCode' => $this->input->post('categoryCode'),
				'parentId' => $this->input->post('parentId'),
				'status' => $this->input->post('status'),
				'slug' => $this->input->post('slug'),
				'description' => $this->input->post('description'),
				'updatedAt' => $date
			];
			$categoryName = $this->input->post('categoryName');
			$categoryCode = $this->input->post('categoryCode');
			$checkExceptName = $this->CategoryModel->checkExcept($id, 'categoryName', $categoryName);
			$checkExceptCode = $this->CategoryModel->checkExcept($id, 'categoryCode', $categoryCode);
			if ($checkExceptName) {
				$this->session->set_flashdata('exists_name', 'Tên danh mục đã tồn tại');
				$this->edit($id);
			} elseif ($checkExceptCode) {
				$this->session->set_flashdata('exists_code', 'Mã danh mục đã tồn tại');
				$this->edit($id);
			} else {
				$this->CategoryModel->update($id, $data);
				$this->session->set_flashdata('success_update', 'Cập nhật thành công');
				redirect(base_url('/cms/categories'));
			}
		} else {
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		$this->checkLogin();
		$this->CategoryModel->delete($id);
		$this->session->set_flashdata('success_delete', 'Xóa thành công');
		redirect(base_url('/cms/categories'));
	}
}

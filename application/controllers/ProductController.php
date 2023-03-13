<?php

class ProductController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductModel');
		$this->load->model('CategoryModel');
		$this->load->model('TagModel');
	}

	private function checkLogin()
	{
		$user = $this->session->userdata('LoginIn');
		if (!$user) {
			redirect(base_url('/login'));
		}
	}

	public function index()
	{
		$this->checkLogin();
		$data = $this->ProductModel->select();
		foreach ($data as $value) {
			$categoryName = $this->ProductModel->getCategoryName($value->categoryId);
			$value->categoryName = $categoryName;
		}
		$data = [
			'products' => $data
		];
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->view('product/index', $data);
		$this->load->view('admin_template/footer');
	}

	private function getCategory($parentId)
	{
		return $this->CategoryModel->recusive($parentId);
	}

	public function add()
	{
		$this->checkLogin();
		$htmlOption = $this->getCategory($parentId = 0);
		$tags = $this->TagModel->select();
		$data = array(
			'htmlOption' => $htmlOption,
			'tags' => $tags
		);
		$this->load->view('admin_template/header');
		$this->load->view('admin_template/navbar');
		$this->load->view('product/create', $data);
		$this->load->view('admin_template/footer');
	}

	private function uploadFile($name, $path)
	{
		if (!is_dir($path)) {
			mkdir($path, 0777);
		}
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'jpeg|JPEG|jpg|JPG|png|PNG';
		$config['encrypt_name'] = true;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload($name)) {
			$fileData = $this->upload->data();
			return $fileData['file_name'];
		}
		return false;
	}
	public function create()
	{
		$this->form_validation->set_rules('productName', 'ProductName', 'trim|required|min_length[5]',
			[
				'required' => 'Vui lòng nhập tên sản phẩm'
			]);
		$this->form_validation->set_rules('productCode', 'ProductCode', 'trim|required|is_unique[products.productCode]',
			[
				'required' => 'Vui lòng nhập mã sản phẩm',
				'is_unique' => 'Mã sản phẩm đã tồn tại'
			]);
		$this->form_validation->set_rules('slug', 'Slug', 'trim|required',
			[
				'required' => 'Vui lòng nhập %s sản phẩm'
			]);
		$this->form_validation->set_rules('categoryId', 'CategoryId', 'required|integer',
			[
				'required' => 'Vui lòng chọn danh mục sản phẩm',
				'integer' => 'Vui lòng chọn danh mục sản phẩm'
			]);
		if ($this->form_validation->run()) {
			$_FILES['imageProductPath']['name'] = time() . "" . str_replace(' ', '-', $_FILES['imageProductPath']['name']);
			$pathImage = './application/assets/image/products/imageProduct';
			$uploadImageStatus = $this->uploadFile('imageProductPath', $pathImage);
			if (!$uploadImageStatus) {
				$this->session->set_flashdata('error_file', $this->upload->display_errors());
				redirect(base_url('/cms/products/add'));
			} else {
				$product_filename = $this->upload->data('file_name');
				$data = [
					'productName' => $this->input->post('productName'),
					'productCode' => $this->input->post('productCode'),
					'slug' => $this->input->post('slug'),
					'categoryId' => $this->input->post('categoryId'),
					'description' => $this->input->post('description'),
					'overview' => $this->input->post('overview'),
					'viewCount' => 0,
					'status' => $this->input->post('status'),
					'imageProductPath' => $pathImage . '/' . $product_filename,
					'imageProductName' => $product_filename
				];
				$productId = $this->ProductModel->insert($data);
				if ($productId) {
					// add tag to product
					$this->addTagsToProduct($productId);

					// add color, price, size, quantity to product
					$this->addPricesAndColorsToProduct($productId);

					// add thumbnail to product
					$this->addThumbnailsToProduct($productId);
				}
				$this->session->set_flashdata('success_create', 'Thêm mới thành công');
				redirect(base_url('/cms/products'));
			}
		} else {
			$this->add();
		}
	}

	private function addTagsToProduct($productId) {
		$listTags = $this->input->post('tag_id');
		if ($listTags) {
			foreach ($listTags as $tagId) {
				$dataProductTag = [
					'productId' => $productId,
					'tagId' => $tagId
				];
				$this->TagModel->addTagToProduct($dataProductTag);
			}
		}
	}

	private function addPricesAndColorsToProduct($productId) {
		$colorName = $this->input->post('colorName');
		$colorCode = $this->input->post('colorCode');
		$quantity = $this->input->post('quantity');
		$price = $this->input->post('price');
		$countColor = count($colorName);
		$data = [];
		for ($i = 0; $i < $countColor; $i++) {
			$list = [
				'colorName' => $colorName[$i],
				'colorCode' => $colorCode[$i],
				'quantity' => $quantity[$i],
				'price' => $price[$i],
				'productId' => $productId
			];
			$size = $this->input->post('size'.$i);
			for ($j = 0; $j < count($size); $j++) {
				$list['size'] = $size[$j];
				array_push($data, $list);
			}
		}
		for ($i = 0; $i < count($data); $i++) {
			$this->ProductModel->addPriceToProduct($data[$i]);
		}
	}

	private function addThumbnailsToProduct($productId) {
		$countFiles = count($_FILES['thumbnailPaths']['name']);
		$path = './application/assets/image/products/thumbnail';
		for ($i = 0; $i < $countFiles; $i++) {
			$_FILES['thumbnailPath']['name'] = time() . "" . str_replace(' ', '-', $_FILES['thumbnailPaths']['name'][$i]);
			$_FILES['thumbnailPath']['type'] = $_FILES['thumbnailPaths']['type'][$i];
			$_FILES['thumbnailPath']['size'] = $_FILES['thumbnailPaths']['size'][$i];
			$_FILES['thumbnailPath']['tmp_name'] = $_FILES['thumbnailPaths']['tmp_name'][$i];
			$_FILES['thumbnailPath']['error'] = $_FILES['thumbnailPaths']['error'][$i];

			$uploadStatus = $this->uploadFile('thumbnailPath', $path);
			if ($uploadStatus) {
				$data = array(
					'productId' => $productId,
					'thumbnailName' => $uploadStatus,
					'thumbnailPath' => $path . '/' . $uploadStatus
				);
				$this->ProductModel->addThumbnailToProduct($data);
			} else {
				// check error
			}
		}
	}

	public function getPreviewDetail($productId) {
		$data['productPrice'] = $this->ProductModel->getDetailProduct($productId);
		$data['productThumbnail'] = $this->ProductModel->getThumbnailProduct($productId);
		echo json_encode($data);
	}
}

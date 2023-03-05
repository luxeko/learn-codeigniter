<?php

class ProductModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductModel');
	}
	public function select()
	{
		$query = $this->db->get('products');
		return $query->result();
	}

	public function insert($data)
	{
		$this->db->insert('products', $data);
		return $this->db->insert_id();
	}

	public function getCategoryName($categoryId)
	{
		$this->db->select('categoryName');
		$query = $this->db->where('id', $categoryId)->get('categories');
		return $query->result()[0]->categoryName;
	}

	public function addThumbnailToProduct($data) {
		return $this->db->insert('product_thumbnails', $data);
	}

	public function addPriceToProduct($data)
	{
		return $this->db->insert('product_prices', $data);
	}
}

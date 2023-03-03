<?php

class ProductModel extends CI_Model
{
    public function select()
	{
		$query = $this->db->get('products');
		return $query->result();
	}
}

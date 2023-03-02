<?php

class CategoryModel extends CI_Model
{
	public function select()
	{
		$query = $this->db->get('categories');
		return $query->result();
	}

	public function insert($data)
	{
		return $this->db->insert('categories', $data);
	}

	public function update($id, $data)
	{
		return $this->db->update('categories', $data, ['id' => $id]);
	}

	public function getById($id)
	{
		$query = $this->db->where('id', $id)->get('categories');
		return $query->result();
	}

	public function checkExist($categoryName)
	{
		$query = $this->db->where('categoryName', $categoryName)->get('categories');
		return $query->result();
	}

	public function checkExcept($id, $categoryName)
	{
		$this->db->select('categoryName');
		$query = $this->db->where("id NOT IN ($id) and categoryName = '$categoryName'")->get('categories');
		return $query->result();
	}

	public function delete($id)
	{
		return $this->db->delete('categories', ['id' => $id]);
	}

	public function getParentName($parentId)
	{
		$this->db->select('categoryName');
		$query = $this->db->where('id', $parentId)->get('categories');
		return $query->result();
	}
}

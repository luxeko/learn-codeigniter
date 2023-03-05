<?php

class CategoryModel extends CI_Model
{
	private $htmlSelect = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CategoryModel');
	}

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

	public function delete($id)
	{
		return $this->db->delete('categories', ['id' => $id]);
	}

	public function getById($id)
	{
		$query = $this->db->where('id', $id)->get('categories');
		return $query->result();
	}

	public function checkExcept($id, $fieldName, $value)
	{
		$this->db->select($fieldName);
		$query = $this->db->where("id NOT IN ($id) and $fieldName = '$value'")->get('categories');
		return $query->result();
	}


	public function getParentName($parentId)
	{
		$this->db->select('categoryName');
		$query = $this->db->where('id', $parentId)->get('categories');
		return $query->result();
	}

	public function recusive($parentId, $id = 0, $text = '')
	{
		$data = $this->select();
		foreach ($data as $value) {
			if ($value->parentId == $id) {
				if (!empty($parentId) && $parentId == $value->id && $value->status == 'Active') {
					$this->htmlSelect .= "<option selected value=" . $value->id . ">" . $text . ' ' .
						$value->categoryName . "</option>";
				} elseif ($value->status == 'Active') {
					$this->htmlSelect .= "<option value=" . $value->id . ">" . $text . ' ' . $value->categoryName . "</option>";
				}
				$this->recusive($parentId, $value->id, $text . '--');
			}
		}
		return $this->htmlSelect;
	}
}

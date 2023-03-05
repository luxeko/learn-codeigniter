<?php

class TagModel extends CI_Model
{
	public function select()
	{
		$query = $this->db->get('tags');
		return $query->result();
	}

	public function insert($data)
	{
		return $this->db->insert('tags', $data);
	}

	public function update($id, $data)
	{
		return $this->db->update('tags', $data, ['id' => $id]);
	}

	public function delete($id)
	{
		return $this->db->delete('tags', ['id' => $id]);
	}

	public function addTagToProduct($data) {
		return $this->db->insert('products_tags', $data);
	}
}

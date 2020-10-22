<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PriceModel extends CI_Model {

	private $tbl = "tbl_price_member";
	public function show($id='')
	{
		$this->db->select('*');
		$this->db->from($this->tbl);
		$this->db->join('tbl_admin', $this->tbl.'.id_admin = tbl_admin.id_admin', 'left');
		if (@$id != null) {
			$this->db->where($id);
		}
		$this->db->limit(1);
		return $this->db->get();
	}

	public function insert($object)
	{
		$this->db->insert($this->tbl, $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function update($object,$id)
	{
		$this->db->where($id);
		$this->db->update($this->tbl, $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function delete($id)
	{
		$this->db->where($id);
		$this->db->delete($this->tbl);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

}

/* End of file PriceModel.php */
/* Location: ./application/models/PriceModel.php */
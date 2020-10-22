<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FasilitasModel extends CI_Model {

	private $tbl = "tbl_fasilitas_member";
	private $dtl = "tbl_detail_fasilitas";

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

	// ===============================================

	public function showDetail($id='')
	{
		$this->db->select('*');
		$this->db->from($this->dtl);
		if (@$id != null) {
			$this->db->where($id);
		}
		return $this->db->get();
	}

	public function insertDetail($object)
	{
		$this->db->insert($this->dtl, $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function updateDetail($object,$id)
	{
		$this->db->where($id);
		$this->db->update($this->dtl, $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteDetail($id)
	{
		$this->db->where($id);
		$this->db->delete($this->dtl);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

}

/* End of file FasilitasModel.php */
/* Location: ./application/models/FasilitasModel.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CourtModel extends CI_Model {
	private $tbl = "tbl_lapangan";
	private $tbldtl = "tbl_dtl_lapangan";
	private $view = "v_lapangan";
	public function showAgg($id='')
	{
		$this->db->select('COUNT(id_lapangan) as total');
		$this->db->from($this->tbl);
		if (@$id) {
			$this->db->where($id);
		}
		return $this->db->get()->row()->total;
	}
	public function show($id='')
	{
		$this->db->select('*');
		$this->db->from($this->tbl);
		if (@$id != null) {
			$this->db->where($id);
		}
		return $this->db->get();
	}

	public function showByGroup()
	{
		$this->db->select('*');
		$this->db->from($this->tbldtl);
		$this->db->group_by('banyak_penyewa');
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

	// =====================================================
	public function detailshow($id='')
	{
		$this->db->select('*');
		$this->db->from($this->view);
		if (@$id != null) {
			$this->db->where($id);
		}
		$this->db->order_by('banyak_penyewa', 'asc');
		return $this->db->get();
	}

	public function detailinsert($object)
	{
		$this->db->insert($this->tbldtl, $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function detailupdate($object,$id)
	{
		$this->db->where($id);
		$this->db->update($this->tbldtl, $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function detaildelete($id)
	{
		$this->db->where($id);
		$this->db->delete($this->tbldtl);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

}

/* End of file CourtModel.php */
/* Location: ./application/models/CourtModel.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

	private $tbl = "tbl_admin";

	public function show($id='')
	{
		$this->db->select('*');
		$this->db->from($this->tbl);
		if (@$id != null) {
			$this->db->where($id);
		}
		$this->db->order_by('nama_admin', 'asc');
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

	public function cekData($id)
	{
		$this->db->select('*');
		$this->db->from($this->tbl);
		$this->db->where($id);
		return $this->db->get();
	}

	public function grafikMemberBulan()
	{
		return $this->db->query('SELECT
									COUNT(tm.id_member) count_member,
									CONCAT(YEAR(tm.register_date),MONTH(tm.register_date)) yearmonth,
									CONCAT(mt.column_2, " ", YEAR(tm.register_date)) bulan_tahun
								FROM tbl_member tm
								JOIN mapping_table mt ON mt.column_1 = MONTH(tm.register_date)
								WHERE YEAR(tm.register_date) <= YEAR(CURDATE())
								AND MONTH(tm.register_date) <= MONTH(CURDATE())
								GROUP BY CONCAT(YEAR(tm.register_date),MONTH(tm.register_date))
								ORDER BY YEAR(tm.register_date), MONTH(tm.register_date) ASC
								LIMIT 12');
	}

}

/* End of file AdminModel.php */
/* Location: ./application/models/AdminModel.php */
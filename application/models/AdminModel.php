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
		return $this->db->query('SELECT q.bulan_tahunind bulan_tahun, q.maping_tahun, q.column_1,
									(SELECT COUNT(tm.id_member)
										FROM tbl_member tm
										WHERE YEAR(tm.register_date) = q.maping_tahun
										AND MONTH(tm.register_date) = q.column_1) count_member
								FROM(
									SELECT
										CASE WHEN MONTH(CURRENT_DATE()) >= mt.column_1
												THEN CONCAT(mt.column_2, " ", YEAR(CURDATE()))
												ELSE CONCAT(mt.column_2, " ", YEAR(CURDATE())-1)
										END AS bulan_tahunind,
										CASE WHEN MONTH(CURRENT_DATE()) >= mt.column_1
												THEN YEAR(CURDATE())
												ELSE YEAR(CURDATE())-1
										END AS maping_tahun,
										mt.column_1
									FROM mapping_table mt
									LIMIT 12
								) q
								ORDER BY q.maping_tahun, FLOOR(q.column_1) ASC');
	}

	public function grafikMembertahun()
	{
		return $this->db->query("SELECT mt.column_1 bulan_tahun,
									(SELECT COUNT(tm.id_member)
									FROM tbl_member tm
									WHERE YEAR(tm.register_date) = mt.column_1) count_member
									FROM mapping_table mt
								WHERE mt.kd_mapping = 'MAPPING_YEAR_FS'
									AND mt.column_1 BETWEEN YEAR(CURDATE())-10 AND YEAR(CURDATE())
									ORDER BY mt.column_1 ASC");
	}

	public function grafikBookingBulan()
	{
		return $this->db->query('SELECT q.bulan_tahunind bulan_tahun, q.maping_tahun, q.column_1,
									(SELECT COUNT(tb.id_pesanan)
										FROM tbl_booking tb
										WHERE YEAR(tb.tgl_booking) = q.maping_tahun
										AND MONTH(tb.tgl_booking) = q.column_1) count_booking
								FROM(
									SELECT
										CASE WHEN MONTH(CURRENT_DATE()) >= mt.column_1
												THEN CONCAT(mt.column_2, " ", YEAR(CURDATE()))
												ELSE CONCAT(mt.column_2, " ", YEAR(CURDATE())-1)
										END AS bulan_tahunind,
										CASE WHEN MONTH(CURRENT_DATE()) >= mt.column_1
												THEN YEAR(CURDATE())
												ELSE YEAR(CURDATE())-1
										END AS maping_tahun,
										mt.column_1
									FROM mapping_table mt
									LIMIT 12
								) q
								ORDER BY q.maping_tahun, FLOOR(q.column_1) ASC');
	}

	public function grafikBookingTahun()
	{
		return $this->db->query("SELECT mt.column_1 bulan_tahun,
									(SELECT COUNT(tb.id_pesanan)
										FROM tbl_booking tb
										WHERE YEAR(tb.tgl_booking) = mt.column_1) count_booking
								FROM mapping_table mt
								WHERE mt.kd_mapping = 'MAPPING_YEAR_FS'
									AND mt.column_1 BETWEEN YEAR(CURDATE())-10 AND YEAR(CURDATE())
									ORDER BY mt.column_1 ASC");
	}

}

/* End of file AdminModel.php */
/* Location: ./application/models/AdminModel.php */
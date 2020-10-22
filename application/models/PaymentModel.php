<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentModel extends CI_Model {
	private $tbl = "tbl_payment_member";
	private $view = "v_payment";
	public function sumTotalPayment()
	{
		$this->db->select('SUM(price) as total');
		$this->db->from($this->tbl);
		$this->db->where('status_payment', 'Accept');
		return $this->db->get()->row()->total;
	}

	public function show($id='')
	{
		$this->db->select('*');
		$this->db->from($this->view);
		if (@$id != null) {
			$this->db->where($id);
		}
		$this->db->order_by('payment_date', 'desc');
		return $this->db->get();
	}

	public function insert($object)
	{
		$this->db->insert($this->tbl, $object);
		if ($this->db->affected_rows() >0) {
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

}

/* End of file PaymentModel.php */
/* Location: ./application/models/PaymentModel.php */
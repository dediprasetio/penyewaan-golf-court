<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookingModel extends CI_Model {
	private $tbl = "tbl_booking";
	private $view = "v_book";

	public function checkUniqueKey($where)
	{
		$this->db->select('MAX(RIGHT(kode_booking,4)) as kode');
		$this->db->from($this->tbl);
		$this->db->where($where);
		$q = $this->db->get();
		$kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kode)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
			$kd = "0001";
        }
        return random_string('alpha',4).date('Ymd').$kd;
	}

	public function showAgg($id='',$limit='')
	{
		$this->db->select('COUNT(id_pesanan) as total');
		$this->db->from($this->tbl);
		if (@$id) {
			$this->db->where($id);
		}
		return $this->db->get()->row()->total;
	}

	public function show($id='',$limit='')
	{
		$this->db->select('*');
		$this->db->from($this->view);
		if (@$id != null) {
			$this->db->where($id);
		}
		if (@$limit != null) {
			$this->db->limit($limit);
		}
		$this->db->order_by('tgl_pesan', 'desc');
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

	public function update($object,$where)
	{
		$this->db->where($where);
		$this->db->update($this->tbl, $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function upload($file)
	{
		$config['upload_path'] = './assets/users/assets/img/uploaded_payment_booking/';
		$config['allowed_types'] = 'jpg|png|jpeg|JPG';
    	$config['max_size'] = 2048;
    	$config['remove_spaces'] = TRUE;
    	$config['overwrite'] = TRUE;
    	$config['file_name'] = $file;

		
		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload('buktibayar')){
			$return = array(
				'result' 	=> 'success', 
				'file'		=>	$this->upload->data(),
				'error' 	=> 	''
			);
			return $return;
		}
		else{
			$return = array(
				'result'	=> 'failed', 
				'file'		=>'', 
				'error'		=>$this->upload->display_errors()
			);
			return $return;
		}
	}

}

/* End of file BookingModel.php */
/* Location: ./application/models/BookingModel.php */
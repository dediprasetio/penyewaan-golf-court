<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends CI_Model {
	private $tbl = "tbl_member";
	public function countMember($where='', $limit='')
	{
		$this->db->select('COUNT(id_member) as member');
		$this->db->from($this->tbl);
		if (@$where) {
			$this->db->where($where);
		}
		if (@$limit) {
			$this->db->limit($limit);
		}
		return $this->db->get()->row()->member;
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

	public function upload($file)
	{
		$config['upload_path'] = './assets/users/assets/img/uploaded_payment_member/';
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

/* End of file MemberModel.php */
/* Location: ./application/models/MemberModel.php */
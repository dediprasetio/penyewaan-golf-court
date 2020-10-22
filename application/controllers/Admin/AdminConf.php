<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminConf extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		
		$this->load->model('AdminModel','admin');
		$this->load->helper('security');
	}

	public function description($title,$subtitel,$active,$result='')
	{
		$data= [
			'title' => $title,
			'subtitel' => $subtitel,
			'active' => $active,
			'description' => '',
			'data' => [
				'name' => $this->session->userdata('nama'),
				'result' => $result
			]
		];

		return $data;
	}

	public function index()
	{
		$data['data'] = $this->description("Admin Config Pages | Booking Golf Hall", "Admin Config", "admin", $this->admin->show()->result_array());
		
		$data['content'] = "Admin/pages/admin/view";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function form($id='')
	{
		if (@$id) {
			$i = ['id_admin' => base64_decode($id)];
			$result = $this->description("Admin Config Pages | Booking Golf Hall", "Admin Config", "admin", $this->admin->show($i)->row());
		}else{
			$result = $this->description("Admin Config Pages | Booking Golf Hall", "Admin Config", "admin", random_string('alnum', 7));
		}
		$data['data'] = $result;
		$data['content'] = "Admin/pages/admin/form";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function action($id='')
	{
		if (@$id) {
			$this->form_validation->set_rules('id', 'Id Admin', 'trim|required|max_length[7]',['required' => 'You must provide a %s.']);
			$this->form_validation->set_rules('email', 'Email', 'trim|required',['required' => 'You must provide a %s.']);
			$this->form_validation->set_rules('uname', 'Username', 'trim|required',['required' => 'You must provide a %s.']);
			if (@$this->input->post('password') && @$this->input->post('repassword')) {
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]',['required' => 'You must provide a %s.']);
				$this->form_validation->set_rules('repassword', 'Confirmed Password', 'trim|required|min_length[6]|matches[password]',['required' => 'You must provide a %s.']);
			}
		}else{
			$this->form_validation->set_rules('id', 'Id Admin', 'trim|required|max_length[7]|is_unique[tbl_admin.id_admin]',['required' => 'You must provide a %s.','is_unique' => 'This %s already exists.']);
			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[tbl_admin.email]',['required' => 'You must provide a %s.']);
			$this->form_validation->set_rules('uname', 'Username', 'trim|required|is_unique[tbl_admin.username]',['required' => 'You must provide a %s.']);
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]',['required' => 'You must provide a %s.']);
			$this->form_validation->set_rules('repassword', 'Confirmed Password', 'trim|required|min_length[6]|matches[password]',['required' => 'You must provide a %s.']);
		}
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required',['required' => 'You must provide a %s.']);
		$this->form_validation->set_rules('notelp', 'No Telephone', 'trim|required',['required' => 'You must provide a %s.']);

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('warning','Check the required form !!');
			// echo validation_errors('<div class="error">', '</div>');
			$i = @$id ? $id : '';
			redirect('Admin/AdminConf/form/'.$i);
		} else {
			$dataArr = array(
				'nama_admin' => $this->input->post('nama'), 
				'email' => $this->input->post('email'), 
				'username' => $this->input->post('uname'), 
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), 
				'repasswrod' => base64_encode($this->input->post('password')), 
				'no_telp' => $this->input->post('notelp')
			);
			if (@$id) {
				$i = ['id_admin' => base64_decode($id)];
				$update = $this->admin->update($dataArr,$i);
				if ($update) {
					$this->session->set_flashdata('success','Success Update Record Data Admin !!');
					redirect('Admin/AdminConf');
				}else{
					$this->session->set_flashdata('danger','Error Update Data Admin !!');
					redirect('Admin/AdminConf/form/'.$id);
				}
			}else{
				$dataArr['id_admin'] = $this->input->post('id');
				$dataArr['status'] = "Active";
				$dataArr['level'] = "Admin";
				$insert = $this->admin->insert($dataArr);
				if ($insert) {
					$this->session->set_flashdata('success','Success Insert new Record Data Admin !!');
					redirect('Admin/AdminConf');
				}else{
					$this->session->set_flashdata('danger','Error Insert Data Admin !!');
					redirect('Admin/AdminConf/form');
				}
			}
		}

	}

	public function delete($id,$nama='')
	{
		if (@$id) {
			$i = ['id_admin' => base64_decode($id)];
			$delete = $this->admin->delete($i);
			$n = explode('%20', $nama);
			$name = '';
			foreach ($n as $key => $value) {
				$name .= $value." ";
			}
			if ($delete) {
				$this->session->set_flashdata('success','Success Delete Data Admin atas nama <b>'.$name.'</b> !!');
				redirect('Admin/AdminConf');
			}else{
				$this->session->set_flashdata('error','Gagal delete Data Admin !!');
				redirect('Admin/AdminConf');
			}
		}else{
			$this->session->set_flashdata('danger','Id Not Found !!');
			redirect('Admin/AdminConf/');
		}
	}

	// public function ins()
	// {
	// 	$pass = "superadmin";
	// 	$arr = array(
	// 		'id_admin' => random_string('alnum', 7), 
	// 		'nama_admin' => "Super Admin Hall Golf",
	// 		'email' => "superadmin@gmail.com",
	// 		'username' => "superadmin",
	// 		'password' => password_hash($pass, PASSWORD_DEFAULT),
	// 		'repasswrod' => base64_encode($pass),
	// 		'no_telp' => "089837629981",
	// 		'status' => "Active",
	// 		'level' => "Super Admin"
	// 	);
	// 	$this->admin->insert($arr);
	// 	redirect('Admin/AdminConf','refresh');
	// }

}

/* End of file AdminConf.php */
/* Location: ./application/controllers/Admin/AdminConf.php */
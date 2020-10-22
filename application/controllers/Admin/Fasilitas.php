<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('FasilitasModel','fasilitas');
		$this->load->model('AdminModel','admin');
	}

	public function description($title,$subtitel,$active,$result='',$description='')
	{
		$data= [
			'title' => $title,
			'subtitel' => $subtitel,
			'active' => $active,
			'description' => $description,
			'data' => [
				'name' => $this->session->userdata('nama'),
				'result' => $result
			]
		];

		return $data;
	}

	public function index()
	{
		$data['data'] = $this->description("Admin Fasilitas Member Pages | Booking Golf Court", "Fasilitas Member Config", "member",['fasilitas' => $this->fasilitas->show()->result_array(), 'detail' => $this->fasilitas->showDetail()->result_array()],'fasilitas');
		
		$data['content'] = "Admin/pages/fasilitas/view";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function form($id='')
	{
		$row['dataAdmin'] = $this->admin->show()->result_array();
		$row['fasilitas'] = '';
		$row['id_fasilitas'] = random_string('alnum',6);

		if (@$id) {
			$i = ['id_fasilitas' => base64_decode($id)];
			$row['id_fasilitas'] = base64_decode($id);
			$row['fasilitas'] = $this->fasilitas->show($i)->row();
		}

		$data['data'] = $this->description("Admin Fasilitas Member Pages | Booking Golf Court", "Fasilitas Member Config", "member",$row,'fasilitas');
		$data['content'] = "Admin/pages/fasilitas/form";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function formDetail($id='')
	{
		$row['detail'] = '';
		$row['fasilitas'] = $this->fasilitas->show()->row();
		if (@$id) {
			$i = ['id' => base64_decode($id)];
			$row['detail'] = $this->fasilitas->showDetail($i)->row();
		}
		$data['data'] = $this->description("Admin Fasilitas Member Pages | Booking Golf Court", "Fasilitas Member Config", "member",$row,'fasilitas');
		$data['content'] = "Admin/pages/fasilitas/formList";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function actionDetail($id='')
	{
		$this->form_validation->set_rules('alat[][]', 'Alat', 'trim|required');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('warning','Check the required form !!');
			// echo validation_errors('<div class="error">', '</div>');
			$i = @$id ? $id : '';
			redirect('Admin/Fasilitas/formDetail/'.$i);
		} else {
			$dataArr['id_fasilitas'] = $this->input->post('id');
			if (@$id) {
				$i = ['id' => $this->input->post('ids')];
				foreach ($this->input->post('alat') as $key => $val) {
					$dataArr['deskripsi'] = $val['deskripsi'];
					$dataArr['qty'] = $val['qty'];
					$returnDetail = $this->fasilitas->updateDetail($dataArr,$i);
				}
				if ($returnDetail) {
					$this->session->set_flashdata('success','Success Update Record List Data Fasilitas !!');
					redirect('Admin/Fasilitas/');
				}else{
					$this->session->set_flashdata('danger','Error Update Record List Data Fasilitas !!');
					redirect('Admin/Fasilitas/formDetail/'.base64_encode($this->input->post('ids')));
				}
			}else{
				foreach ($this->input->post('alat') as $key => $val) {
					$dataArr['deskripsi'] = $val['deskripsi'];
					$dataArr['qty'] = $val['qty'];
					$returnDetail = $this->fasilitas->insertDetail($dataArr);
				}
				if ($returnDetail) {
					$this->session->set_flashdata('success','Success Insert New Record List Data Fasilitas !!');
					redirect('Admin/Fasilitas/');
				}else{
					$this->session->set_flashdata('danger','Error Insert New Record List Data Fasilitas !!');
					redirect('Admin/Fasilitas/formDetail/');
				}
			}
		}
	}

	public function action($id='')
	{
		if (@$id) {
			$this->form_validation->set_rules('id', 'id', 'trim|required|max_length[6]',['required' => 'You must provide a %s.']);
			
		}else{
			$this->form_validation->set_rules('id', 'id', 'trim|required|max_length[6]|is_unique[tbl_fasilitas_member.id_fasilitas]',['required' => 'You must provide a %s.','is_unique' => 'This %s already exists.']);
		}
		$this->form_validation->set_rules('diskon', 'diskon', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('warning','Check the required form !!');
			// echo validation_errors('<div class="error">', '</div>');
			$i = @$id ? $id : '';
			redirect('Admin/Fasilitas/form/'.$i);
		} else {
			$dataArr = [
				'id_admin' => $this->input->post('admin'),
				'diskon_member' => $this->input->post('diskon')
			];
			if (@$id) {
				$i = ['id_fasilitas' => base64_decode($id)];
				$dataArr['update_at'] = date('Y-m-d H:i:s');
				$result = $this->fasilitas->update($dataArr,$i);
				if ($result) {
					$this->session->set_flashdata('success','Success Update Record Data !!');
					redirect('Admin/Fasilitas');
				}else{
					$this->session->set_flashdata('danger','Error Update Record Data!!');
					redirect('Admin/Fasilitas/form/'.$id);
				}
			}else{
				$dataArr['id_fasilitas'] = $this->input->post('id');
				$dataArr['create_at'] = date('Y-m-d H:i:s');
				$insert = $this->fasilitas->insert($dataArr);

				foreach ($this->input->post('alat') as $key => $val) {
					$dt = [
							'id_fasilitas' => $this->input->post('id'),
							'deskripsi' => $val['deskripsi'],
							'qty' => $val['qty']
						];
						$this->fasilitas->insertDetail($dt);
				}

				if ($insert) {
					$this->session->set_flashdata('success','Success Insert new Record !!');
					redirect('Admin/Fasilitas');
				}else{
					$this->session->set_flashdata('danger','Error Insert !!');
					redirect('Admin/Fasilitas/form');
				}
			}
		}
	}

	public function delete($id)
	{
		if (@$id) {
			$i = ['id' => base64_decode($id)];
			$delete = $this->fasilitas->deleteDetail($i);
			if ($delete) {
				$this->session->set_flashdata('success','Success Delete List Data Fasilitas !!');
				redirect('Admin/Fasilitas');
			}else{
				$this->session->set_flashdata('error','Gagal delete List Data Fasilitas !!');
				redirect('Admin/Fasilitas');
			}
		}else{
			$this->session->set_flashdata('warning','Required data to delete !!');
			redirect('Admin/Fasilitas/');
		}
	}

}

/* End of file Fasilitas.php */
/* Location: ./application/controllers/Admin/Fasilitas.php */
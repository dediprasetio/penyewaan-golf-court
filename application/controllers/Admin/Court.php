<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Court extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('CourtModel','court');
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
		$data['data'] = $this->description("Admin Golf Court Pages | Booking Golf Court", "Golf Court Config", "Court",$this->court->show()->result_array());
		
		$data['content'] = "Admin/pages/court/view";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function form($id='')
	{
		if (@$id) {
			$i = ['id_lapangan' => base64_decode($id)];
			$record = [
				'court' => $this->court->show($i)->row(),
				'dtcourt' => $this->court->detailshow($i)->result_array(),
			];
			$result = $this->description("Admin Golf Court Pages | Booking Golf Court", "Golf Court Config", "Court",$record);
		}else{
			$record = [
				'court' => random_string('alnum',6),
				'dtcourt' => '',
			];
			$result = $this->description("Admin Golf Court Pages | Booking Golf Court", "Golf Court Config", "Court", $record);
		}
		$data['data'] = $result;
		$data['content'] = "Admin/pages/court/form";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function action($id='')
	{
		if (@$id) {
			$this->form_validation->set_rules('id', 'id', 'trim|required|max_length[6]',['required' => 'You must provide a %s.']);
		}else{
			$this->form_validation->set_rules('id', 'id', 'trim|required|max_length[6]|is_unique[tbl_lapangan.id_lapangan]',['required' => 'You must provide a %s.','is_unique' => 'This %s already exists.']);
		}
		$this->form_validation->set_rules('nama', 'nama', 'trim|required',['required' => 'You must provide a %s.']);
		$this->form_validation->set_rules('desk', 'desk', 'trim|required',['required' => 'You must provide a %s.']);
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('warning','Check the required form !!');
			// echo validation_errors('<div class="error">', '</div>');
			$i = @$id ? $id : '';
			redirect('Admin/Court/form/'.$i);
		} else {
			$dataArr = array(
				'nama_lapangan' => $this->input->post('nama'), 
				'deskripsi' => $this->input->post('desk'), 
			);
			$dataList = array();
			$id_dt = array();
			foreach ($this->input->post('list') as $key => $val) {
				$listWeek = [
					'banyak_penyewa' => $val['qty'],
					'harga_sewa_weekday' => $val['priceweekday'],
					'harga_sewa_weekend' => $val['priceweekend'],
					'update_at' => date('Y-m-d H:i:s')
				];
				$dataList[] = $listWeek;
				$id_dt[] = $val['id'];
			}
				
			if (@$id) {
				$i = ['id_lapangan' => base64_decode($id)];
				$dataArr['update_at'] = date('Y-m-d H:i:s');
				$update = $this->court->update($dataArr,$i);
				if ($update) {
					$a = array();
					for ($i=0; $i < count($dataList); $i++) {
						$idt = ['id_detail_lapangan ' => $id_dt[$i]];
						$this->court->detailupdate($dataList[$i],$idt);
					}
					$this->session->set_flashdata('success','Success Update Record Data Golf Court !!');
					redirect('Admin/Court');
				}else{
					$this->session->set_flashdata('danger','Error Update Data Golf Court !!');
					redirect('Admin/Court/form/'.$id);
				}
			}else{
				$dataArr['id_lapangan'] = $this->input->post('id');
				$dataArr['create_at'] = date('Y-m-d H:i:s');
				$insert = $this->court->insert($dataArr);
				if ($insert) {
					for ($i=0; $i < count($dataList); $i++) { 
						$dataList[$i]['id_lapangan '] = $dataArr['id_lapangan'];
						$this->court->detailinsert($dataList[$i],$i);
					}
					$this->session->set_flashdata('success','Success Insert new Record Data Golf Court !!');
					redirect('Admin/Court');
				}else{
					$this->session->set_flashdata('danger','Error Insert Data Golf Court !!');
					redirect('Admin/Court/form');
				}
			}
		}
	}

	public function delete($id,$nama='')
	{
		if (@$id) {
			$i = ['id_lapangan' => base64_decode($id)];
			$delete = $this->court->delete($i);
			$n = explode('%20', $nama);
			$name = '';
			foreach ($n as $key => $value) {
				$name .= $value." ";
			}
			if ($delete) {
				$this->session->set_flashdata('success','Success Delete Data Court Golf : <b>'.$name.'</b> !!');
				redirect('Admin/Court');
			}else{
				$this->session->set_flashdata('error','Gagal delete Data Court Golf !!');
				redirect('Admin/Court');
			}
		}else{
			$this->session->set_flashdata('danger','Id Not Found !!');
			redirect('Admin/Court/');
		}
	}

}

/* End of file Court.php */
/* Location: ./application/controllers/Admin/Court.php */
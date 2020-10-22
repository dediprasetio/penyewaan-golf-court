<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('PaketModel','paket');
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
		$result = [
			'paketAlat' => $this->paket->show(['status' => "Alat"])->result_array(),
			'paketMobil' => $this->paket->show(['status' => "Mobil"])->result_array(),
		];

		$data['data'] = $this->description("Admin Rental Package Pages | Booking Golf Court", "Rental Package Config", "Paket", $result);
		
		$data['content'] = "Admin/pages/paket/view";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function detail($id='')
	{
		if (@$id) {
			$i = ['id_paket' => base64_decode($id)];
			$result = [
				'paket' => $this->paket->show($i)->row(),
				'detail' => $this->paket->showDetail($i)->result_array(),
			];

			$data['data'] = $this->description("Admin Rental Package Pages | Booking Golf Court", "Rental Package Config", "Paket", $result);

			$data['content'] = "Admin/pages/paket/detailPaket";
			$this->load->view('Admin/layouts/main', $data, FALSE);
		}else{
			$this->session->set_flashdata('warning','Required Id !!');
			redirect('Admin/Paket','refresh');
		}
	}

	public function formDetail($id='')
	{
		if (@$this->input->get('q')) {
			$q = ['id_paket' => base64_decode($this->input->get('q'))];

			$row['detail'] = '';
			$row['paket'] = $this->paket->show($q)->row();

			if (@$id) {
				$i = ['id_detail_sewa' => base64_decode($id)];
				$row['detail'] = $this->paket->showDetail($i)->row();
			}
			
			$data['data'] = $this->description("Admin Rental Package Pages | Booking Golf Court", "Rental Package Config", "Paket",$row);

			$data['content'] = "Admin/pages/paket/formDetail";
			$this->load->view('Admin/layouts/main', $data, FALSE);

		}else{
			$this->session->set_flashdata('warning','Required Key !!');
			redirect('Admin/Paket','refresh');
		}
	}


	public function form($id='',$q='')
	{
		if ((@$this->input->get('q') == base64_encode("Alat") || @$this->input->get('q') == base64_encode("Mobil")) || @$q) {
			$row['q'] = $this->input->get('q');

			$row['paket'] = '';
			if (@$id) {
				$i = ['id_paket' => base64_decode($id)];
				$row['paket'] = $this->paket->show($i)->row();
				$result = $this->description("Admin Rental Package Pages | Booking Golf Court", "Rental Package Config", "Paket",$row);
			}else{
				$row['id_paket'] = random_string('alnum',6);
				$result = $this->description("Admin Rental Package Pages | Booking Golf Court", "Rental Package Config", "Paket", $row);
			}
			$data['data'] = $result;
			$data['content'] = "Admin/pages/paket/formPaket";

			// echo "<pre>";
			// print_r ($data);
			// echo "</pre>";
			$this->load->view('Admin/layouts/main', $data, FALSE);
		}else{
			redirect('Admin/Paket','refresh');
		}
	}


	public function actionDetail($id='')
	{
		$this->form_validation->set_rules('id', 'id', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('warning','Check the required form !!');
			// echo validation_errors('<div class="error">', '</div>');
		
			redirect('Admin/Paket/detail/'.base64_encode($this->input->post('id')));
		} else {
			$dataArr = array(
				'id_paket' => base64_decode($this->input->get('q')), 
			);
			if (@$id) {
				$i = ['id_detail_sewa' => base64_decode($id)];
				foreach ($this->input->post('alat') as $key => $val) {
					$dataArr['deskripsi_barang'] = $val['alat'];
					$dataArr['qty'] = $val['qty'];
					$returnDetail = $this->paket->updateDetail($dataArr,$i);
				}
				if ($returnDetail) {
					$this->session->set_flashdata('success','Success Update Record List Data Paket Sewa !!');
					redirect('Admin/Paket/detail/'.base64_encode($this->input->post('id')));
				}else{
					$this->session->set_flashdata('danger','Error Update Record List Data Paket Sewa !!');
					redirect('Admin/Paket/detail/'.base64_encode($this->input->post('id')));
				}
			}else{
				foreach ($this->input->post('alat') as $key => $val) {
					$dataArr['deskripsi_barang'] = $val['alat'];
					$dataArr['qty'] = $val['qty'];
					$returnDetail = $this->paket->insertDetail($dataArr);
				}
				if ($returnDetail) {
					$this->session->set_flashdata('success','Success Insert New Record List Data Paket Sewa !!');
					redirect('Admin/Paket/detail/'.base64_encode($this->input->post('id')));
				}else{
					$this->session->set_flashdata('danger','Error Insert New Record List Data Paket Sewa !!');
					redirect('Admin/Paket/detail/'.base64_encode($this->input->post('id')));
				}
			}
		}
	}

	public function action($id='')
	{
		if (@$id) {
			$this->form_validation->set_rules('id', 'id_paket', 'trim|required|max_length[6]',['required' => 'You must provide a %s.']);
		}else{
			$this->form_validation->set_rules('id', 'id_paket', 'trim|required|max_length[6]|is_unique[tbl_paket_sewa.id_paket]',['required' => 'You must provide a %s.','is_unique' => 'This %s already exists.']);
		}
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		$this->form_validation->set_rules('desk', 'desk', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('warning','Check the required form !!');
			// echo validation_errors('<div class="error">', '</div>');
			$i = @$id ? $id : '?q='.$this->input->post('type');
			redirect('Admin/Paket/form/'.$i);
		} else {
			$q = $this->input->get('q');
			$dataArr = [
				'nama_paket' => $this->input->post('nama'),
				'harga_paket' => $this->input->post('harga'),
				'deskripsi' => $this->input->post('desk'),
				'status' => base64_decode($q),
			];
			if (@$id) {
				$i = ['id_paket' => base64_decode($id)];
				$dataArr['update_at'] = date('Y-m-d H:i:s');
				$update = $this->paket->update($dataArr,$i);
				if ($update) {
					$this->session->set_flashdata('success','Success Update Record Data Paket Sewa !!');
					redirect('Admin/Paket');
				}else{
					$this->session->set_flashdata('danger','Error Update Data Paket Sewa !!');
					redirect('Admin/Paket/form/'.$id."q=".$q);
				}
			}else{
				$dataArr['id_paket'] = $this->input->post('id');
				$dataArr['create_at'] = date('Y-m-d H:i:s');

				$returnPaket = $this->paket->insert($dataArr);

				if ($dataArr['status'] != "Mobil") {
					foreach ($this->input->post('alat') as $key => $val) {
						$dt = [
							'id_paket' => $this->input->post('id'),
							'deskripsi_barang' => $val['alat'],
							'qty' => $val['qty'],

						];
						$returnDetail = $this->paket->insertDetail($dt);
					}
				}

				if ($returnPaket) {
					$this->session->set_flashdata('success','Success Insert new Record Data Paket Sewa !!');
					redirect('Admin/Paket');
				}else{
					$this->session->set_flashdata('danger','Error Insert Data Paket Sewa !!');
					redirect('Admin/Paket/form?q='.$q);
				}
			}

			echo "<pre>";
			print_r ($this->input->post());
			echo "</pre>";
		}
	}

	public function delete($id='',$nama='')
	{
		if (@$id) {
			$i = ['id_paket' => base64_decode($id)];
			$delete = $this->paket->delete($i);
			$n = explode('%20', $nama);
			$name = '';
			foreach ($n as $key => $value) {
				$name .= $value." ";
			}
			if ($delete) {
				$this->session->set_flashdata('success','Success Delete Data Paket '.$name.' !!');
				redirect('Admin/Paket/');
			}else{
				$this->session->set_flashdata('error','Gagal delete Data Paket Sewa !!');
				redirect('Admin/Paket/');
			}
		}else{
			$this->session->set_flashdata('danger','Required Data to Delete !!');
			redirect('Admin/Paket/');
		}
	}

	public function deleteDetail($id='')
	{
		if (@$id && @$this->input->get('q')) {
			$i = [
				'id_detail_sewa' => base64_decode($id),
				'id_paket' => base64_decode($this->input->get('q'))
			];
			$delete = $this->paket->deleteDetail($i);
			if ($delete) {
				$this->session->set_flashdata('success','Success Delete List Data Paket Sewa !!');
				redirect('Admin/Paket/detail/'.base64_encode($i['id_paket']));
			}else{
				$this->session->set_flashdata('error','Gagal delete List Data Paket Sewa !!');
				redirect('Admin/Paket/detail/'.base64_encode($i['id_paket']));
			}
		}else{
			$this->session->set_flashdata('error','Gagal delete List Data Paket Sewa !!');
			redirect('Admin/Paket/detail/'.base64_encode($this->input->get('q')));
		}
	}

}

/* End of file Paket.php */
/* Location: ./application/controllers/Admin/Paket.php */
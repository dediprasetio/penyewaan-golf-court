<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('PriceModel','price');
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
		$data['data'] = $this->description("Admin Price Member Pages | Booking Golf Court", "Price Member Config", "member",$this->price->show()->result_array(),'price');
		
		$data['content'] = "Admin/pages/pricemember/view";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function form($id='')
	{
		$row['dataAdmin'] = $this->admin->show()->result_array();
		$row['dataPrice'] = '';
		if (@$id) {
			$i = ['id_price' => base64_decode($id)];
			$row['dataPrice'] = $this->price->show($i)->row();
			$result = $this->description("Admin Price Member Pages | Booking Golf Court", "Price Member Config", "price", $row);
		}else{
			$result = $this->description("Admin Price Member Pages | Booking Golf Court", "Price Member Config", "price", $row);
		}
		$data['data'] = $result;
		$data['content'] = "Admin/pages/pricemember/form";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function action($id='')
	{
		$this->form_validation->set_rules('admin', 'admin', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('warning','Check the required form !!');
			// echo validation_errors('<div class="error">', '</div>');
			$i = @$id ? $id : '';
			redirect('Admin/Price/form/'.$i);
		} else {
			$dataArr = array(
				'id_admin' => $this->input->post('admin'), 
				'price' => $this->input->post('harga'), 
			);
			if (@$id) {
				$i = ['id_price' => base64_decode($id)];
				$dataArr['update_at'] = date('Y-m-d H:i:s');
				$update = $this->price->update($dataArr,$i);
				if ($update) {
					$this->session->set_flashdata('success','Success Update Record Price Member !!');
					redirect('Admin/Price');
				}else{
					$this->session->set_flashdata('danger','Error Update Price Member !!');
					redirect('Admin/Price/form/'.$id);
				}
			}else{
				$dataArr['create_at'] = date('Y-m-d H:i:s');
				$insert = $this->price->insert($dataArr);
				if ($insert) {
					$this->session->set_flashdata('success','Success Insert new Record Price Member !!');
					redirect('Admin/Price');
				}else{
					$this->session->set_flashdata('danger','Error Insert Price Member !!');
					redirect('Admin/Price/form');
				}
			}
		}
	}

	public function delete($id)
	{
		if (@$id) {
			$i = ['id_price' => base64_decode($id)];
			$delete = $this->price->delete($i);
			if ($delete) {
				$this->session->set_flashdata('success','Success Delete Data Price Member !!');
				redirect('Admin/Court');
			}else{
				$this->session->set_flashdata('error','Gagal delete Data Price Member !!');
				redirect('Admin/Court');
			}
		}else{
			$this->session->set_flashdata('danger','Id Not Found !!');
			redirect('Admin/Court/');
		}
	}

}

/* End of file Price.php */
/* Location: ./application/controllers/Admin/Price.php */
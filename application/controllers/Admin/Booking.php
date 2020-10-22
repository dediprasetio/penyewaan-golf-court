<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('BookingModel','book');
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
		$data['data'] = $this->description("Admin Booking Pages | Booking Golf Court", "Booking Court Config", "booking", $this->book->show()->result_array());
		
		$data['content'] = "Admin/pages/booking/view";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function detail($id='')
	{
		$result = '';
		if (@$id) {
			$i = ['id_pesanan' => base64_decode($id)];
			$record = [
				'booking' => $this->book->show($i)->row(),
			];

			if ($this->book->show($i)->num_rows() < 1) {
				redirect('Admin/Booking','refresh');
			}

			$result = $this->description("Admin Booking Pages | Booking Golf Court", "Booking Court Config", "booking", $record);
		}else{
			redirect('Admin/Booking','refresh');
		}
		$data['data'] = $result;
		$data['content'] = "Admin/pages/booking/detail";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function confirmation($id='')
	{
		$this->form_validation->set_rules('id', 'Id Pesanan', 'trim|required');
		$this->form_validation->set_rules('kode', 'Kode Pesanan', 'trim|required');
		$this->form_validation->set_rules('total', 'Total Biaya', 'trim|required');
		$this->form_validation->set_rules('admin', 'Petugas Admin', 'trim|required');
		$this->form_validation->set_rules('status', 'Status Booking', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('warning','Check the required form !! '.validation_errors('<div class="error">', '</div>'));
			// echo ;
			$i = @$id ? $id : $this->input->post('id');
			redirect('Admin/Booking/detail/'.$i);
		} else {

			$arr = [
				'total_bayar' => @$this->input->post('bayar') ? $this->input->post('bayar') : null,
				'admin_cek' => $this->input->post('admin'),
				'keterangan_status' => @$this->input->post('keterangan') ? $this->input->post('keterangan') : null,
				'status_pesanan' => $this->input->post('status'),
				'update_at' => date('Y-m-d H:i:s')
			];
			$i = [
				'id_pesanan' => $this->input->post('id'),
				'kode_booking' => $this->input->post('kode')
			];
			$update = $this->book->update($arr,$i);
			if ($update) {
				$this->session->set_flashdata('success','Success Confirm '.$i['kode_booking'].' Booking Order !!');
				redirect('Admin/Booking/detail/'.$id);
			}else{
				$this->session->set_flashdata('danger','Error Update Price Member !!');
				redirect('Admin/Booking/detail/'.$id);
			}
		}
	}

}

/* End of file Booking.php */
/* Location: ./application/controllers/Admin/Booking.php */
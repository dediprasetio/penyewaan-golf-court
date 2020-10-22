<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('BookingModel','book');
		$this->load->model('MemberModel','member');
		$this->load->model('PaymentModel','payment');
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

	public function member($id='')
	{
		if (@$this->input->get('start') && @$this->input->get('end')) {
			$where = array(
				'DATE(register_date) >=' => date('Y-m-d', strtotime($this->input->get('start'))),
				'DATE(register_date) <=' => date('Y-m-d', strtotime($this->input->get('end')))
			);
			$row = $this->member->show($where)->result_array();
		}else{
			$row = $this->member->show()->result_array();
		}
		$data['data'] = $this->description("Admin Report Member Pages | Booking Golf Court", "Report Member Config", "report", $row, 'report_member');
		
		$data['content'] = "Admin/pages/laporan/report_member";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function payment($id='')
	{
		if (@$this->input->get('start') && @$this->input->get('end')) {
			$where = array(
				'DATE(payment_date) >=' => date('Y-m-d', strtotime($this->input->get('start'))),
				'DATE(payment_date) <=' => date('Y-m-d', strtotime($this->input->get('end')))
			);
			$row = $this->payment->show($where)->result_array();
		}else{
			$row = $this->payment->show()->result_array();
		}
		$data['data'] = $this->description("Admin Report Member Pages | Booking Golf Court", "Report Member Config", "report", $row, 'report_payment');
		
		$data['content'] = "Admin/pages/laporan/report_payment";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function booking($id='')
	{
		if (@$this->input->get('start') && @$this->input->get('end')) {
			$where = array(
				'DATE(tgl_pesan) >=' => date('Y-m-d', strtotime($this->input->get('start'))),
				'DATE(tgl_pesan) <=' => date('Y-m-d', strtotime($this->input->get('end')))
			);
			$row = $this->book->show($where)->result_array();
		}else{
			$row = $this->book->show()->result_array();
		}
		$data['data'] = $this->description("Admin Report Member Pages | Booking Golf Court", "Report Member Config", "report", $row, 'report_booking');
		
		$data['content'] = "Admin/pages/laporan/report_booking";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Admin/Report.php */
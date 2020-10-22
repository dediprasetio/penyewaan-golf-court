<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('PaymentModel','payment');
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
		

		$data['data'] = $this->description("Admin Golf Paymeet Member Pages | Booking Golf Court", "Payment Member Config", "payment",$this->payment->show()->result_array());
		
		$data['content'] = "Admin/pages/payment/view";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

}

/* End of file Payment.php */
/* Location: ./application/controllers/Admin/Payment.php */
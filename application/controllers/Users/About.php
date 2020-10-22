<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
	private $countPayMember = false;
	private $staPayMember = '';
	private $id;
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		
		$this->load->model('CourtModel','court');
		$this->load->model('PaketModel','paket');
		$this->load->model('FasilitasModel','fasilitas');
		$this->load->model('BookingModel','book');
		$this->load->model('MemberModel','member');
		$this->load->model('PaymentModel','payment');
		$this->checkPayment();
	}

	public function checkPayment()
	{
		$arr = [
			'id_member' => $this->session->userdata('id'),
			'start_from >=' => date('Y-m-d'),
			'end_before <=' => date('Y-m-d', mktime(date("H"),date("i"),date("s"),date("n"),date("d"),date("Y")+1))
		];
		$row = $this->payment->show($arr);
		if ($row->num_rows() > 0) {
			$this->countPayMember = true;
			$result = $row->row();
			$this->staPayMember = $result->status_payment;
			$this->id = $result->id_payment;
		}
	}

	public function description($title,$subtitel,$active,$result='',$desk='')
	{
		$data= [
			'title' => $title,
			'subtitel' => $subtitel,
			'active' => $active,
			'description' => $desk,
			'data' => [
				'name' => @$this->session->userdata('member') ? $this->session->userdata('member') : '',
				'result' => $result,
				'checkPayment' => [
					'countPayMember' => $this->countPayMember,
					'staPayMember' => $this->staPayMember,
					'id_payment' => $this->id
				]
			]
		];
		return $data;
	}

	public function index()
	{
		$record = [
			'court' => $this->court->show()->result_array(),
		];

		$data['data'] = $this->description("About Us Users | Booking Golf Hall", "", "about", $record);
		
		$data['content'] = "Users/pages/aboutus";
		$this->load->view('Users/layouts/main', $data, FALSE);
	}

}

/* End of file About.php */
/* Location: ./application/controllers/Users/About.php */
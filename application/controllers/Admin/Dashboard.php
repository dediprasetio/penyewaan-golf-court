<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('AdminModel','admin');
		$this->load->model('MemberModel','member');
		$this->load->model('PaymentModel','payment');
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
		$arrCountAllMember = ['status_member !=' => 'Not Payment' ];
		$result = [
			'allMember' => $this->member->countMember($arrCountAllMember),
			'sumBook' => $this->book->showAgg(),
			'sumTotalpayment' => $this->payment->sumTotalPayment(),
			'dataAdmin' => $this->admin->show()->result_array(),
			'member' => $this->member->show('',5)->result_array(),
			'booking' => $this->book->show('',5)->result_array(),
			'grafikMemberBulan' => $this->admin->grafikMemberBulan()->result_array(),
			'grafikBookingBulan' => $this->admin->grafikBookingBulan()->result_array(),
		];

		$data['data'] = $this->description("Admin Dashboard Pages | Booking Golf Hall", "Dashboard", "home", $result);
		$data['content'] = "Admin/pages/dashboard";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function grafikMember()
	{
		if($this->input->post('session_grafmember') == 'tahunan'){
			$grafikData = $this->admin->grafikMembertahun()->result();
		}else{
			$grafikData = $this->admin->grafikMemberBulan()->result();
		}
		echo json_encode($grafikData);
	}

	public function grafikBooking()
	{
		if($this->input->post('session_grafbooking') == 'tahunan'){
			$grafikData = $this->admin->grafikBookingTahun()->result();
		}else{
			$grafikData = $this->admin->grafikBookingBulan()->result();
		}
		echo json_encode($grafikData);
	}

	// public function insert_row()
	// {
	// 	for($i=0; $i<=99; $i++){
	// 		$this->load->model('MemberModel','member');
	// 		$dataArr = array(				
	// 			'kd_mapping' => 'MAPPING_YEAR_FS',
	// 			'column_1' => 2000+$i,
	// 			'column_2' => 2000+$i,
	// 			'created_at' => date('Y-m-d h:i:s'),
	// 			'user_id' => 0,
	// 		);
			
	// 		echo $regist = $this->member->insert2('mapping_table', $dataArr);
	// 	}
	// }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Admin/Dashboard.php */
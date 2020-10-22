<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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
				'result' => $result
			]
		];
		return $data;
	}

	public function index()
	{
		$record = [
			'court' => $this->court->show()->result_array(),
			'fasilitas' => @$this->session->userdata('member') ? $this->fasilitas->show()->row() : '',
			'countCourt' => $this->court->showAgg(),
			'countAllBook' => $this->book->showAgg(),
			'countNonMemberBook' => $this->book->showAgg(['jenis_pelanggan' => 'Tamu','id_member !=' => null]),
			'countMember' => $this->member->countMember(['status_member !=' => "Not Payment"]),
		];
		$paketRow = $this->paket->show()->result_array();
		for ($i=0; $i < count($paketRow); $i++) { 
			$arr = ['id_paket' => $paketRow[$i]['id_paket']];
			$dt = $this->paket->showDetail($arr)->result_array();
			array_push($paketRow[$i], $dt);
		}

		$record['paket'] = $paketRow;
		$data['data'] = $this->description("Homepage Users | Booking Golf Hall", "", "home", $record);
		
		$data['content'] = "Users/pages/home";
		$this->load->view('Users/layouts/main', $data, FALSE);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Users/Dashboard.php */
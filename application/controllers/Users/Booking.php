<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
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

	public function formBooking($id='')
	{
		$key = '';
		if (@$id) {
			$key = base64_decode($id);
		}
		$record = [
			'court' => $this->court->show()->result_array(),
			'fasilitas' => @$this->session->userdata('member') ? $this->fasilitas->show()->row() : '',
		];
		$paketRow = $this->paket->show()->result_array();
		for ($i=0; $i < count($paketRow); $i++) { 
			$arr = ['id_paket' => $paketRow[$i]['id_paket']];
			$dt = $this->paket->showDetail($arr)->result_array();
			array_push($paketRow[$i], $dt);
		}

		$record['paket'] = $paketRow;
		$record['option'] = $key;
		$record['pemain'] = $this->court->showByGroup()->result_array();

		$data['data'] = $this->description("Form Booking Users | Booking Golf Hall", "Form Booking Court", "home", $record, "Form for Booking the Court");
		
		$data['content'] = "Users/pages/formBooking";
		$this->load->view('Users/layouts/main', $data, FALSE);
	}

	public function detailBooking($id="")
	{
		$this->form_validation->set_rules('courts', 'courts', 'trim|required');
		$this->form_validation->set_rules('tgl_main', 'Tanggal Main', 'trim|required');
		$this->form_validation->set_rules('pemain', 'Banyak Pemain', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$alert = "alert('".validation_errors('<div class="error">', '</div>')."')";
			$this->session->set_flashdata('notif', $alert);
			redirect('Users/Dashboard','refresh');
		} else {
			if (@$this->input->post('courts')) {
				$i = [
					'banyak_penyewa' => $this->input->post('pemain'),
					'id_lapangan' => base64_decode($this->input->post('courts'))
				];
			}else{
				redirect('Users/Dashboard','refresh');
			}

			$record = [
				'time' => date('d-m-Y H:i:s', strtotime($this->input->post('tgl_main'))),
				'court' => $this->court->detailshow($i)->row(),
				'dtcourt' => $this->court->detailshow(['id_lapangan' => $i['id_lapangan']])->result_array(),
				'paketAlat' => $this->paket->show(['status' => "Alat"])->result_array(),
				'paketMobil' => $this->paket->show(['status' => "Mobil"])->result_array(),
				'fasilitas' => $this->fasilitas->show()->result_array()
			];
			$i = 0;
			$record['dtfasilitas'] = $this->fasilitas->showDetail()->result_array();
			foreach ($record['paketAlat'] as $key) {
				$dt = $this->paket->showDetail(['id_paket' => $key['id_paket']])->result_array();
				array_push($record['paketAlat'][$i], $dt);
				$i++;
			}
			$data['data'] = $this->description("Form Booking Users | Booking Golf Hall", "Form Booking Court", "home", $record, "Form for Booking the Court");

			$data['content'] = "Users/pages/formDetailBooking";
			$this->load->view('Users/layouts/main', $data, FALSE);
		}		
	}

	public function bookAction()
	{
		$this->form_validation->set_rules('tgl_main', 'Tanggal Main', 'trim|required');
		$this->form_validation->set_rules('jam_main', 'Jam Main', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama Pemesan', 'trim|required');
		$this->form_validation->set_rules('court', 'Lapangan', 'trim|required');
		$this->form_validation->set_rules('dtcourt', 'Lapangan', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Pemesan', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'No Telp Pemesan', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat Pemesan', 'trim|required');
		$this->form_validation->set_rules('total', 'Total Pesanan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

			$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Error!</strong> '.validation_errors('<div class="error">', '</div>').'
			</div>';
			$this->session->set_flashdata('notif', $alert);
			redirect('Users/Booking/formBooking/'.base64_encode($this->input->post('court')),'refresh');
		} else {
			$findUniqKey = ['DATE(tgl_pesan)' => date('Y-m-d')];
			// $maxKey = $this->book->checkUniqueKey($findUniqKey);

			$dataArr = array(
				'id_pesanan' => random_string('alnum',6), 
				'kode_booking' => $this->book->checkUniqueKey($findUniqKey),
				'id_member' => @$this->input->post('kode') ? $this->input->post('kode') : null,
				'tgl_booking' => date('Y-m-d', strtotime($this->input->post('tgl_main'))),
				'jam_main' => date('H:i:s', strtotime($this->input->post('jam_main'))),
				'nama_pemesan' => $this->input->post('nama'),
				'alamat_pemesan' => $this->input->post('alamat'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'jenis_pelanggan' => @$this->session->userdata('member') ? "Member" : "Tamu" ,
				'id_lapangan' => $this->input->post('dtcourt'),
				'harga_lapangan' => $this->input->post('subtotal'),
				'id_fasilitas' => @$this->input->post('fasilitas') ? $this->input->post('fasilitas') : null,
				'id_paket_barang' => @$this->input->post('paketAlat') ? $this->input->post('paketAlat') : null,
				'id_paket_mobil' => @$this->input->post('paketMobil') ? $this->input->post('paketMobil') : null,
				'total_harga' => $this->input->post('total'),
				'tgl_pesan' => date('Y-m-d H:i:s'),
				'status_pesanan' => "Pending"
			);


			$ins = $this->book->insert($dataArr);
			if ($ins) {
				$alert = '<div class="alert alert-success custom-alert alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> Sukses Melakukan Booking
				</div>';
				$this->session->set_flashdata('notif', $alert);
				redirect('Users/Booking/successBooking/'.$dataArr['id_pesanan'],'refresh');
			}else{
				$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Error!</strong> Gagal melakukan Booking, harap lakukan pesanan ulang
				</div>';
				$this->session->set_flashdata('notif', $alert);
				redirect('Users/Booking/formBooking/'.base64_encode($this->input->post('court')),'refresh');
			}
		}
	}

	public function successBooking($id)
	{
		if (!$id) {
			redirect('Users/Dashboard','refresh');
		}
		$i = ['id_pesanan' => $id];
		$row = $this->book->show($i);
		if ($row->num_rows() < 1) {
			redirect('Users/Dashboard','refresh');
		}
		$record = [
			'booking' => $row->row(),
		];

		$data['data'] = $this->description("Success Booking Order | Booking Golf Hall", "", "home", $record, "Booking the Court");
		
		$data['content'] = "Users/pages/successOrder";
		$this->load->view('Users/layouts/main', $data, FALSE);
	}


	public function konfirmasiPembayaran()
	{
		$this->form_validation->set_rules('id', 'Id Booking', 'trim|required|min_length[5]|max_length[6]');
		$this->form_validation->set_rules('kode', 'Kode Booking', 'trim|required|min_length[14]|max_length[15]');
		$this->form_validation->set_rules('tgl', 'Tanggal Booking', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Error!</strong> '.validation_errors('<div class="error">', '</div>').'
			</div>';
			$this->session->set_flashdata('notif', $alert);
			redirect('Users/Booking/successBooking/'.$this->input->post('id'),'refresh');
		} else {
			if (@$_FILES['buktibayar']['name']) {
				$file_name = date('dmY',strtotime($this->input->post('tgl'))).'_'.$this->input->post('kode');
				$upload = $this->book->upload($file_name);
				if ($upload['result'] == 'success') {
					$where = [
						'id_pesanan' => $this->input->post('id'),
						'kode_booking' => $this->input->post('kode'),
					];
					$dataArr = [
						'tanggal_bayar' => date("Y-m-d H:i:s"),
						'bukti_bayar' => $upload['file']['file_name'],
					];
					if ($this->input->post('sta') == "Reject") {
						$dataArr['status_pesanan'] = "Pending";
					}
					$upd = $this->book->update($dataArr, $where);
					if ($upd) {
						$alert = '<div class="alert alert-success custom-alert alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Success!</strong> Pembayaran Booking Order dengan kode : '.$where['kode_booking'].' berhasil, konfirmasi akan di lakukan secepatnya.
						</div>';
						$this->session->set_flashdata('notif', $alert);
						redirect('Users/Booking/successBooking/'.$this->input->post('id'),'refresh');
					}else{
						$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> Pembayaran Booking Order dengan kode : '.$where['kode_booking'].' Gagal. Harap sertakan bukti pembayaran yang valid
						</div>';
						$this->session->set_flashdata('notif', $alert);
						redirect('Users/Booking/successBooking/'.$this->input->post('id'),'refresh');
					}
				}else{
					$alert = 'alert("'.$upload['error'].'")';
					$this->session->set_flashdata('notif', $alert);
					redirect('Users/Booking/successBooking1/'.$this->input->post('id'),'refresh');
				}
			}else{
				$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Error!</strong> The Bukti Pembayaran field is required.
				</div>';
				$this->session->set_flashdata('notif', $alert);
				redirect('Users/Booking/successBooking/'.$this->input->post('id'),'refresh');
			}
		}
	}

	public function confirmBooking()
	{
		$record = [];

		$data['data'] = $this->description("Confirm Booking Users | Booking Golf Hall", "Confirm Booking Court", "payment", $record, "Confirm for Booking the Court");
		
		
		$data['content'] = "Users/pages/confirmPayment";
		$this->load->view('Users/layouts/main', $data, FALSE);
	}
}

/* End of file Booking.php */
/* Location: ./application/controllers/Users/Booking.php */
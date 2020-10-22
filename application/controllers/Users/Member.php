<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	private $countPayMember = false;
	private $staPayMember = '';
	private $id, $whatsapp;

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('MemberModel','member');
		$this->load->model('BookingModel','book');
		$this->load->model('FasilitasModel','fasilitas');
		$this->load->model('PriceModel','price');
		$this->load->model('PaymentModel','payment');
		$this->checkPayment();
		$this->whatsappApi();
	}

	public function checkPayment()
	{
		$arr = [
			'id_member' => $this->session->userdata('id'),
			// 'start_from >=' => date('Y-m-d'),
			'end_before <=' => date('Y-m-d', mktime(date("H"),date("i"),date("s"),date("n"),date("d"),date("Y")+1))
		];
		$row = $this->payment->show($arr);
		if ($row->num_rows() > 0) {
			$this->countPayMember = true;
			$result = $row->row();
			$this->staPayMember = $result->status_payment;
			if (date('Y-m-d') > $result->end_before) {
				$this->staPayMember = "Expired";
			}
			$this->id = $result->id_payment;
		}
	}

	public function whatsappApi()
	{
		$android = stripos($_SERVER['HTTP_USER_AGENT'], "android");
		$iphone = stripos($_SERVER['HTTP_USER_AGENT'], "iphone");
		$ipad = stripos($_SERVER['HTTP_USER_AGENT'], "ipad");

		$whatsappNumber = '6283874766210';
		$whatsappLink = '';
		$text = str_replace(' ', '%20', "Saya tertarik menjadi Bagian dari Anggota Member PT Golf Court Indonesia");

		if($android !== false || $ipad !== false || $iphone !== false) {
			$whatsappLink = 'https://wa.me/'.$whatsappNumber.'?text='.$text;
		} else {
			$whatsappLink = 'https://wa.me/'.$whatsappNumber.'?text='.$text;
		}
		$this->whatsapp = $whatsappLink;
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
				],
				'whatsAppApi' => $this->whatsapp
			]
		];
		return $data;
	}

	public function dashboard()
	{
		if (!$this->session->userdata('member')) {
			redirect('Users/Dashboard','refresh');
		}
		$id = ['id_member' => $this->session->userdata('id')];

		$record = [
			'countAllBook' => $this->book->showAgg($id),
			'booking' => $this->book->show($id)->result_array(),
			'paymentMember' => $this->payment->show($id)->result_array()
		];

		$id['status_pesanan'] = "Pending";
		$record['countPendingBook'] = $this->book->showAgg($id);
		$id['status_pesanan'] = "Accept";
		$record['countSuccessBook'] = $this->book->showAgg($id);

		$data['data'] = $this->description("Users Pages | Booking Golf Hall", "", "home", $record,'dashboard');
		
		$data['content'] = "Users/pages/member/dashboard";
		$this->load->view('Users/layouts/main', $data, FALSE);
	}

	public function paymentAccount($id='')
	{

		if (!$this->session->userdata('member')) {
			redirect('Users/Dashboard','refresh');
		}

		$record = [
			'price' => $this->price->show()->row()
		];
		if ($this->staPayMember == "Accept" && !$id) {
			$alert = "alert('Most required value id from payment lsit')";
			$this->session->set_flashdata('alert', $alert);
			redirect('Users/Member/Dashboard','refresh');
		}
		$record['payment'] = [];

		if (@$id) {
			$i = ['id_payment' => base64_decode($id)];
			$row = $this->payment->show($i);
			if ($row->num_rows() < 1) {
				redirect('Users/Member/dashboard','refresh');
			}
			$record['payment'] = $row->row();
		}

		$data['data'] = $this->description("Users Pages | Booking Golf Hall", "", "home", $record,'dashboard');
		
		$data['content'] = "Users/pages/member/payment_member";
		$this->load->view('Users/layouts/main', $data, FALSE);
	}

	public function profile()
	{
		if (!$this->session->userdata('member')) {
			redirect('Users/Dashboard','refresh');
		}
		$id = ['id_member' => $this->session->userdata('id')];
		$record = [
			'member' => $this->member->show($id)->row()
		];

		$data['data'] = $this->description("Users Pages | Booking Golf Hall", "", "home", $record, 'profile');
		
		$data['content'] = "Users/pages/member/profil";
		$this->load->view('Users/layouts/main', $data, FALSE);
	}

	public function myBooking($id='')
	{
		if (!$this->session->userdata('member')) {
			redirect('Users/Dashboard','refresh');
		}
		$id = ['id_member' => $this->session->userdata('id')];
		$record = [
			'booking' => $this->book->show($id)->result_array()
		];

		$data['data'] = $this->description("Users Pages | Booking Golf Hall", "", "home", $record, 'myBooking');
		
		$data['content'] = "Users/pages/member/myBooking";
		$this->load->view('Users/layouts/main', $data, FALSE);
	}

	public function changePassword()
	{
		if (!$this->session->userdata('member')) {
			redirect('Users/Dashboard','refresh');
		}
		$id = ['id_member' => $this->session->userdata('id')];
		$record = [];

		$data['data'] = $this->description("Users Pages | Booking Golf Hall", "", "home", $record, 'change');
		
		$data['content'] = "Users/pages/member/changePassword";
		$this->load->view('Users/layouts/main', $data, FALSE);
	}
	// ================== ACTION ==========================================

	public function changePasswordAction()
	{
		$this->form_validation->set_rules('oldPass', 'Old Password', 'trim|required');
		$this->form_validation->set_rules('newPass', 'New Password', 'trim|required');
		$this->form_validation->set_rules('rePass', 'Confirm Password', 'trim|required|matches[newPass]');

		if ($this->form_validation->run() == FALSE) {
			$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Error!</strong> '.validation_errors('<div class="error">', '</div>').'
			</div>';
			$this->session->set_flashdata('notif', $alert);
			redirect('Users/Member/changePassword','refresh');
		} else {
			$id = ['id_member' => $this->session->userdata('id')];
			$oldPass = htmlentities(htmlspecialchars($this->input->post('oldPass')));
			$newPass = htmlentities(htmlspecialchars($this->input->post('newPass')));
			$row = $this->member->show($id)->row();
			if (password_verify($oldPass, $row->password)) {
				$newPass = ['password' => password_hash($newPass, PASSWORD_DEFAULT)];
				$id = ['id_member' => $this->session->userdata('id')];
				$upd = $this->member->update($newPass, $id);
				if ($upd) {
					$alert = '<div class="alert alert-success custom-alert alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Success!</strong> Sukses melakukan update
					</div>';
					$this->session->set_flashdata('notif', $alert);
					redirect('Users/Member/dashboard','refresh');
				}else{
					$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Error!</strong> Gagal Update!
					</div>';
					$this->session->set_flashdata('notif', $alert);
					redirect('Users/Member/changePassword','refresh');
				}
			}else{
				$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Error!</strong> incorrect password member! Please try again
				</div>';
				$this->session->set_flashdata('notif', $alert);
				redirect('Users/Member/changePassword','refresh');
			}
		}

	}

	public function profileAction()
	{
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('notelp', 'No Telephone', 'trim|required');
		$this->form_validation->set_rules('jenkel', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tgllahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Error!</strong> '.validation_errors('<div class="error">', '</div>').'
			</div>';
			$this->session->set_flashdata('notif', $alert);
			redirect('Users/Member/profile','refresh');
		} else {
			$id = ['id_member' => base64_decode($this->input->post('id'))];
			$dataArr = array(
				'nama_member' => htmlentities(htmlspecialchars($this->input->post('nama'))),
				'email' => htmlentities(htmlspecialchars($this->input->post('email'))),
				'no_telp' => htmlentities(htmlspecialchars($this->input->post('notelp'))),
				'jenis_kelamin' => htmlentities(htmlspecialchars($this->input->post('jenkel'))),
				'tempat_lahir' => htmlentities(htmlspecialchars($this->input->post('tempat'))),
				'tgl_lahir' => date('Y-m-d', strtotime(htmlentities(htmlspecialchars($this->input->post('tgllahir'))))),
				'alamat' => htmlentities(htmlspecialchars($this->input->post('alamat'))),
			);
			$upd = $this->member->update($dataArr, $id);
			if ($upd) {
				$dataArr['id_member'] = base64_decode($this->input->post('id'));
				$dataArr['nama'] = $dataArr['nama_member'];
				$this->session->set_userdata($dataArr);
				$this->session->unset_userdata('nama_member');
				$alert = '<div class="alert alert-success custom-alert alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> Sukses melakukan update profil
				</div>';
				$this->session->set_flashdata('notif', $alert);
				redirect('Users/Member/profile','refresh');
			}else{
				$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Error!</strong> Gagal Update profil!
				</div>';
				$this->session->set_flashdata('notif', $alert);
				redirect('Users/Member/profile','refresh');
			}
		}
	}

	public function paymentAction($id)
	{
		if (@$id) {
			$this->form_validation->set_rules('account', 'Account', 'trim|required');
			$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
			$this->form_validation->set_rules('dateat', 'dateat', 'trim|required');
			$this->form_validation->set_rules('expired', 'expired', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Error!</strong> '.validation_errors('<div class="error">', '</div>').'
				</div>';
				$this->session->set_flashdata('notif', $alert);
				redirect('Users/Member/paymentAccount','refresh');
			} else {
				$dataArr = array(
					'id_member' => $this->input->post('account'), 
					'price' => $this->input->post('resultPayment') == $this->input->post('harga') ? $this->input->post('resultPayment') : $this->input->post('harga'), 
					'payment_date' => date('Y-m-d'), 
					'start_from' => date('Y-m-d',strtotime($this->input->post('dateat'))), 
					'end_before' => date('Y-m-d',strtotime($this->input->post('expired'))), 
				);

				if (@$this->input->post('i')) {
					$id = ['id_payment' => base64_decode($this->input->post('i'))];

					if (@$_FILES['buktibayar']['name']) {
						$file_name = date('dmY',strtotime($this->input->post('dateat'))).'_'.date('dmY',strtotime($this->input->post('expired')))."_".$this->input->post('account');
						$upload = $this->member->upload($file_name);
						if ($upload['result'] == "success") {
							$dataArr['bukti_payment'] = $upload['file']['file_name'];

						}else{
							$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Error!</strong> '.$upload['error'].'
							</div>';
							$this->session->set_flashdata('notif', $alert);
							redirect('Users/Member/paymentAccount','refresh');
						}
					}
					$upd = $this->payment->update($dataArr,$id);
					if ($upd) {
						$alert = '<div class="alert alert-success custom-alert alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Success!</strong> Pembayaran Aktifasi Member Sukses, konfirmasi akan di lakukan secepatnya.
						</div>';
						$this->session->set_flashdata('notif', $alert);
						redirect('Users/Member/Dashboard','refresh');
					}else{
						$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> Gagal Melakukan Pembayaran Member.
						</div>';
						$this->session->set_flashdata('notif', $alert);
						redirect('Users/Member/paymentAccount','refresh');
					}
				}else{
					if(isset($_FILES['buktibayar']['name'])){
						$file_name = date('dmY',strtotime($this->input->post('dateat'))).'_'.date('dmY',strtotime($this->input->post('expired')))."_".$this->input->post('account');
						$upload = $this->member->upload($file_name);
						if ($upload['result'] == 'success') {
							$dataArr = array(
								'id_member' => $this->input->post('account'), 
								'price' => $this->input->post('resultPayment') == $this->input->post('harga') ? $this->input->post('resultPayment') : $this->input->post('harga'), 
								'payment_date' => date('Y-m-d H:i:s'), 
								'start_from' => date('Y-m-d',strtotime($this->input->post('dateat'))), 
								'end_before' => date('Y-m-d',strtotime($this->input->post('expired'))), 
								'duration' => 1, 
								'status_payment' => "Pending",
								"bukti_payment" => $upload['file']['file_name']
							);
							$ins = $this->payment->insert($dataArr);
							if ($ins) {
								$alert = '<div class="alert alert-success custom-alert alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Success!</strong> Pembayaran Aktifasi Member Sukses, konfirmasi akan di lakukan secepatnya.
								</div>';
								$this->session->set_flashdata('notif', $alert);
								redirect('Users/Member/Dashboard','refresh');
							}else{
								$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Error!</strong> Gagal Melakukan Pembayaran Member.
								</div>';
								$this->session->set_flashdata('notif', $alert);
								redirect('Users/Member/paymentAccount','refresh');
							}
						}else{
							$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Error!</strong> '.$upload['error'].'
							</div>';
							$this->session->set_flashdata('notif', $alert);
							redirect('Users/Member/paymentAccount','refresh');
						}
					}else{
						$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Error!</strong> Tidak ada Bukti Pembayaran yang di kirim!
						</div>';
						$this->session->set_flashdata('notif', $alert);
						redirect('Users/Member/paymentAccount','refresh');
					}
				}
			}
		}else{
			redirect('Users/Member/Dashboard','refresh');
		}
	}

	public function register()
	{
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[tbl_member.email]',['required' => 'You must provide a %s.','is_unique' => 'This %s already exists.']);
		$this->form_validation->set_rules('notelp', 'No Telephone', 'trim|required');

		$this->form_validation->set_rules('jenkel', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tgllahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('pass', 'pass', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Error!</strong> '.validation_errors('<div class="error">', '</div>').'
			</div>';
			$this->session->set_flashdata('notif', $alert);
			redirect('Users/Fasilitas','refresh');
		} else {
			$dataRegist = array(
				'id_member' => random_string('alpha',3).''.random_string('numeric', 8), 
				'nama_member' => htmlentities(htmlspecialchars($this->input->post('nama'))),
				'email' => htmlentities(htmlspecialchars($this->input->post('email'))),
				'no_telp' => htmlentities(htmlspecialchars($this->input->post('notelp'))),
				'jenis_kelamin' => htmlentities(htmlspecialchars($this->input->post('jenkel'))),
				'tempat_lahir' => htmlentities(htmlspecialchars($this->input->post('tempat'))),
				'tgl_lahir' => date('Y-m-d', strtotime(htmlentities(htmlspecialchars($this->input->post('tgllahir'))))),
				'alamat' => htmlentities(htmlspecialchars($this->input->post('alamat'))),
				'password' => password_hash(htmlentities(htmlspecialchars($this->input->post('pass'))), PASSWORD_DEFAULT),
				'register_date' => date('Y-m-d H:i:s'),
				'status_member' => "Not Payment"
			);
			$regist = $this->member->insert($dataRegist);
			if ($regist) {
				$ses = array(
					'member' => true, 
					'id' => $dataRegist['id_member'],
					'nama' => $dataRegist['nama_member'],
					'email' => $dataRegist['email'],
					'no_telp' => $dataRegist['no_telp'],
					'jenis_kelamin' => $dataRegist['jenis_kelamin'],
					'tempat_lahir' => $dataRegist['tempat_lahir'],
					'tgl_lahir' => $dataRegist['tgl_lahir'],
					'alamat' => $dataRegist['alamat'],
					'status' => $dataRegist['status_member'],
					'payment_date' => null,
					'expire_date' => null
				);
				$this->session->set_userdata($ses);
				redirect('Users/Member/success/'.$this->session->userdata('id'),'refresh');
			}else{
				$alert = '<div class="alert alert-danger custom-alert alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Error!</strong> Register Failed!
				</div>';
				$this->session->set_flashdata('notif', $alert);
				redirect('Users/Fasilitas','refresh');
			}
		}
	}

	public function success($id)
	{
		if (!$this->session->userdata('member')) {
			redirect('Users','refresh');
		}

		if (!$id) {
			redirect('Users/Dashboard','refresh');
		}
		$id = ['id_member' => $id];
		$record = [
			'member' => $this->member->show($id)->row(),
		];

		$data['data'] = $this->description("Registration Users Pages | Booking Golf Hall", "", "home", $record);
		
		$data['content'] = "Users/pages/success_register_member";
		$this->load->view('Users/layouts/main', $data, FALSE);
	}

}

/* End of file Member.php */
/* Location: ./application/controllers/Users/Member.php */
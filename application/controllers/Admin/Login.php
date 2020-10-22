<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel','admin');
	}

	public function index()
	{
		$this->load->view('Admin/pages/login', '', FALSE);
	}

	public function signout()
	{
		session_destroy();
		redirect('Admin','refresh');
	}

	public function ceklogin()
	{
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$alert = 'swal.fire({
				text: "Sorry, looks like there are some errors detected, please try again.",
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			})';
			$this->session->set_flashdata('notif', $alert);
			redirect('Admin','refresh');
		} else {
			$uname = ['username' => $this->input->post('username')];
			$pass = $this->input->post('password');

			$result = $this->admin->cekData($uname);
			if ($result->num_rows() > 0) {
				$row = $result->row();
				if (base64_encode($pass) == $row->repasswrod) {
					if (password_verify($pass, $row->password)) {
						if ($row->status == "Active") {
							$array = array(
								'id' => $row->id_admin,
								'nama' => $row->nama_admin,
								'email' => $row->email,
								'uname' => $row->username,
								'notelp' => $row->no_telp,
								'level' => $row->level,
							);

							$this->session->set_userdata( $array );
							$alert = 'swal.fire({
								title: "Success Login as '.$this->session->userdata('level').'!",
								text: "Welcome to Admin Page '.$this->session->userdata('nama').'!",
								icon: "success",
								timer: 3000
							});';
							$this->session->set_flashdata('notif', $alert);
							redirect('Admin/Dashboard','refresh');
						}else{
							$alert = 'swal.fire({
								text: "User has been Not Active! try again",
								icon: "error",
								buttonsStyling: false,
								confirmButtonText: "Ok, got it!",
								customClass: {
									confirmButton: "btn font-weight-bold btn-light-primary"
								}
							})';
							$this->session->set_flashdata('notif', $alert);
							redirect('Admin','refresh');
						}
					}else{
						$alert = 'swal.fire({
							text: "Username or Password incorrect! Please try again",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
						})';
						$this->session->set_flashdata('notif', $alert);
						redirect('Admin','refresh');
					}
				}else{
					$alert = 'swal.fire({
						text: "Username or Password incorrect! Please try again",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light-primary"
						}
					})';
					$this->session->set_flashdata('notif', $alert);
					redirect('Admin','refresh');
				}
			}else{
				$alert = 'swal.fire({
					text: "User Admin not Found! Please try again",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				})';
				$this->session->set_flashdata('notif', $alert);
				redirect('Admin','refresh');
			}
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Admin/Login.php */
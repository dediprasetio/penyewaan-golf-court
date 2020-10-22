<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MemberModel','member');
	}
	public function logout()
	{
		session_destroy();
		redirect('Users/Dashboard','refresh');
	}
	public function checklog()
	{
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$alert = 'alert("'.validation_errors('<div class="error">', '</div>').'")';
			$this->session->set_flashdata('notif', $alert);
			redirect('Users/Dashboard','refresh');
		} else {
			$email = ['email' => htmlentities(htmlspecialchars($this->input->post('email')))];
			$pass = htmlentities(htmlspecialchars($this->input->post('password')));
			$row = $this->member->show($email);
			if ($row->num_rows() == 1) {
				$result = $row->row();
				if (password_verify($pass, $result->password)) {
					$ses = array(
						'member' => true, 
						'id' => $result->id_member,
						'nama' => $result->nama_member,
						'email' => $result->email,
						'no_telp' => $result->no_telp,
						'jenis_kelamin' => $result->jenis_kelamin,
						'tempat_lahir' => $result->tempat_lahir,
						'tgl_lahir' => $result->tgl_lahir,
						'alamat' => $result->alamat,
						'status' => $result->status_member,
						'payment_date' => $result->payment_date,
						'expire_date' => $result->expire_date
					);
					
					$this->session->set_userdata($ses);
					$alert = 'alert("Successful Login Member")';
					$this->session->set_flashdata('notif', $alert);
					redirect('Users/Dashboard','refresh');
				}else{
					$alert = 'alert("Email or Password incorrect")';
					$this->session->set_flashdata('notif', $alert);
					redirect('Users/Dashboard','refresh');
				}
			}else{
				$alert = 'alert("Member Not Found! Please try again")';
				$this->session->set_flashdata('notif', $alert);
				redirect('Users/Dashboard','refresh');
			}
		}

	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Users/Login.php */
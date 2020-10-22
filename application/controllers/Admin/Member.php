<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('MemberModel','member');
		$this->load->model('PaymentModel','payment');
		$this->load->model('PriceModel','price');
		$this->load->model('FasilitasModel','fasilitas');
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

	public function index()
	{
		$data['data'] = $this->description("Admin Data Member Pages | Booking Golf Court", "Data Member Config", "member",$this->member->show()->result_array(),'member');

		
		$data['content'] = "Admin/pages/member/view";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function form($id='')
	{
		if (@$id) {
			$i = ['id_member' => base64_decode($id)];
			$result = $this->description("Admin Data Member Pages | Booking Golf Court", "Data Member Config", "member", $this->member->show($i)->row(), 'member');
		}else{
			$result = $this->description("Admin Data Member Pages | Booking Golf Court", "Data Member Config", "member", random_string('alpha',3).''.random_string('numeric', 8), 'member');
		}
		$data['data'] = $result;
		$data['content'] = "Admin/pages/member/form";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function action($id='')
	{
		$this->form_validation->set_rules('nama', 'Nama Member', 'trim|required', ['required' => 'You must provide a %s.']);
		if (@$id) {
			$this->form_validation->set_rules('email', 'email', 'trim|required',['required' => 'You must provide a %s.']);
		}else{
			$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[tbl_member.email]',['required' => 'You must provide a %s.','is_unique' => 'This %s already exists.']);
		}
		$this->form_validation->set_rules('notelp', 'No Telephone', 'trim|required');

		$this->form_validation->set_rules('jenkel', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('tempat', 'Tempat Lahir', 'trim|required');
		$this->form_validation->set_rules('tgllahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('warning','Check the required form !! '.validation_errors('<div class="error">', '</div>'));
			// echo ;
			$i = @$id ? $id : '';
			redirect('Admin/Member/form/'.$i);
		} else {

			$dataArr = array(				
				'nama_member' => htmlentities(htmlspecialchars($this->input->post('nama'))),
				'email' => htmlentities(htmlspecialchars($this->input->post('email'))),
				'no_telp' => htmlentities(htmlspecialchars($this->input->post('notelp'))),
				'jenis_kelamin' => htmlentities(htmlspecialchars($this->input->post('jenkel'))),
				'tempat_lahir' => htmlentities(htmlspecialchars($this->input->post('tempat'))),
				'tgl_lahir' => date('Y-m-d', strtotime(htmlentities(htmlspecialchars($this->input->post('tgllahir'))))),
				'alamat' => htmlentities(htmlspecialchars($this->input->post('alamat'))),
				'password' => password_hash(htmlentities(htmlspecialchars($this->input->post('pass'))), PASSWORD_DEFAULT),
				'status_member' => htmlentities(htmlspecialchars($this->input->post('status')))
			);

			if (@$id) {
				$i = ['id_member' => base64_decode($id)];
				$dataArr['update_at'] = date('Y-m-d H:i:s');
				$update = $this->member->update($dataArr,$i);
				if (@$update) {
					$this->session->set_flashdata('success','Success Update Record Data Member !!');
					redirect('Admin/Member');
				}else{
					$this->session->set_flashdata('danger','Error Update Data Member !!');
					redirect('Admin/Member/form/'.$id);
				}
			}else{
				$dataArr['id_member'] = $this->input->post('id');
				$dataArr['register_date'] = date('Y-m-d H:i:s');
				
				
				$regist = $this->member->insert($dataArr);
				if ($regist) {
					$this->session->set_flashdata('success','Success Insert Record Data Member !!');
					redirect('Admin/Member');
				}else{
					$this->session->set_flashdata('danger','Error Insert Data Member !!');
					redirect('Admin/Member/form/');
				}

			}

		}
	}

	public function detail($id='')
	{
		if (@$id) {
			$i = ['id_member' => base64_decode($id)];
			$record = [
				'member' => $this->member->show($i)->row(),
				'payment' => $this->payment->show($i)->result_array()
			];
			$result = $this->description("Admin Data Member Pages | Booking Golf Court", "Data Member Config", "member", $record, 'member');
		}else{
			redirect('Admin/Member','refresh');
		}
		$data['data'] = $result;
		$data['content'] = "Admin/pages/member/detail";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	// ============================================================================================

	public function showInvoice($id='')
	{
		$result = '';
		if (@$id) {
			$i = ['id_payment' => base64_decode($id)];
			$record = [
				'payment' => $this->payment->show($i)->row(),
				'fasilitas' => $this->fasilitas->show()->row()
			];

			if ($this->payment->show($i)->num_rows() < 1) {
				redirect('Admin/Member','refresh');
			}

			$result = $this->description("Admin Data Member Pages | Booking Golf Court", "Data Member Config", "member", $record, 'member');
		}else{
			redirect('Admin/Member','refresh');
		}
		$data['data'] = $result;
		$data['content'] = "Admin/pages/member/invoice/view";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function formInvoice($id='')
	{
		if (@$id) {
			$i = ['id_member' => base64_decode($id)];
			$record = [
				'member' => $this->member->show($i)->row(),
				'price' => $this->price->show()->row()
			];

			if ($this->input->get('pay')) {
				$i['id_payment'] = base64_decode($this->input->get('pay'));
				$record['payment'] = $this->payment->show($i)->row();
			}else{
				$record['payment'] = random_string('numeric', 8);
			}
			
			$result = $this->description("Admin Data Member Pages | Booking Golf Court", "Data Member Config", "member", $record, 'member');
		}else{
			redirect('Admin/Member','refresh');
			// $result = $this->description("Admin Data Member Pages | Booking Golf Court", "Data Member Config", "member", random_string('alpha',3).''.random_string('numeric', 8), 'member');
		}
		$data['data'] = $result;
		$data['content'] = "Admin/pages/member/invoice/form";
		$this->load->view('Admin/layouts/main', $data, FALSE);
	}

	public function invoiceAction($id='')
	{
		if (@$id) {
			$this->form_validation->set_rules('id', 'Id Payment', 'trim|required');
		}else{
			$this->form_validation->set_rules('id', 'Id Payment', 'trim|required|is_unique[tbl_payment_member.id_payment]');
		}
		$this->form_validation->set_rules('member', 'Data Member', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga Member', 'trim|required');
		$this->form_validation->set_rules('start', 'Date Start Member', 'trim|required');
		$this->form_validation->set_rules('end', 'Date Expired Member', 'trim|required');
		$this->form_validation->set_rules('admin', 'Petugas Admin', 'trim|required');
		$this->form_validation->set_rules('status', 'Status Payment', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('warning','Check the required form !! '.validation_errors('<div class="error">', '</div>'));
			// echo validation_errors('<div class="error">', '</div>');
			$i = @$id ? $id : '';
			redirect('Admin/Member/formInvoice/'.base64_encode($this->input->post('member')).'pay='.$id);
		} else {
			$dataArr = [
				'id_member' => $this->input->post('member'),
				'price' => $this->input->post('harga'),
				'start_from' => date('Y-m-d', strtotime($this->input->post('start'))),
				'end_before' => date('Y-m-d', strtotime($this->input->post('end'))),
				'status_payment' => $this->input->post('status'),
				'admin_cek' => $this->input->post('admin')
			];

			if (@$id) {
				$where = [
					'id_payment' => $this->input->post('id'),
					'id_member' => $this->input->post('member')
				];
				$update = $this->payment->update($dataArr,$where);
				if ($update) {
					$this->session->set_flashdata('success','Success Update Record Payment Member !!');
					redirect('Admin/Member/showInvoice/'.base64_encode($this->input->post('id')));
					
				}else{
					$this->session->set_flashdata('danger','Error Update Payment Member !!');
					redirect('Admin/Member/formInvoice/'.base64_encode($dataArr['id_member']).'?pay='.base64_encode($this->input->post('id')));
				}
			}else{
				$dataArr['id_payment '] = $this->input->post('id');
				$dataArr['payment_date'] = date('Y-m-d H:i:s');
				$insert = $this->payment->insert($dataArr);
				if ($insert) {
					$this->session->set_flashdata('success','Success Insert new Record Payment Member !!');
					redirect('Admin/Member/showInvoice/'.base64_encode($this->input->post('id')));
				}else{
					$this->session->set_flashdata('danger','Error Insert Payment Member !!');
					redirect('Admin/Member/formInvoice/'.base64_encode($dataArr['id_member']));
				}
			}
		}

	}

	public function deleteInvoice($value='')
	{
		# code...
	}

}

/* End of file Member.php */
/* Location: ./application/controllers/Admin/Member.php */
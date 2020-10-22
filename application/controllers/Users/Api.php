<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CourtModel','court');
		$this->load->model('PaketModel','paket');
		$this->load->model('BookingModel','book');
	}

	public function loadPaket($id='')
	{
		if (@$id) {
			$i = ['id_paket' => $id];
			$respons['data'] = $this->paket->show($i)->row();
			$respons['message'] = "Success get data Lapangan";
			$respons['result'] = true;
		}else{
			$respons['data'] = [];
			$respons['message'] = "Tidak Ada paramater yang di kirim";
			$respons['result'] = false;
		}
		echo json_encode($respons);
	}

	public function loadPlayer($id)
	{
		if (@$id) {
			$i = ['id_detail_lapangan' => $id];
			$respons['data'] = $this->court->detailshow($i)->row();
			$respons['message'] = "Success get data Lapangan";
			$respons['result'] = true;
		}else{
			$respons['data'] = [];
			$respons['message'] = "Tidak Ada paramater yang di kirim";
			$respons['result'] = false;
		}
		echo json_encode($respons);
	}

	public function loadBooking($id)
	{
		if (@$id) {
			$i = ['kode_booking' => $id];
			// $respons['data'] = $this->book->show($i)->row();
			$row = $this->book->show($i);
			$book = $row->row();

			$html = '';
			if ($row->num_rows() > 0){

									if ($book->status_pesanan == "Pending"){
										$staBook = "pending-booking";
									}elseif ($book->status_pesanan == "Accept"){
										$staBook = "approved-booking";
									}elseif ($book->status_pesanan == "Reject"){
										$staBook = "canceled-booking";
									} 
									$html .= '<li class="'.$staBook.'">
										<div class="list-box-listing bookings">
											<div class="list-box-listing-img"><img src="https://image.flaticon.com/icons/png/512/145/145849.png" alt=""></div>
											<div class="list-box-listing-content">
												<div class="inner">
													<h3>
													<span class="booking-status">'.$book->status_pesanan.'</span>';
													if ($book->status_pesanan == "Pending" && @$book->bukti_bayar)
														$html .= '<span class="booking-status" style="background: #1db75c">Paid</span>';
														elseif ($book->status_pesanan == "Pending" && !$book->bukti_bayar){
															$html .= '<span class="booking-status unpaid" style="background: #e21f1f">Unpaid</span>';
														
														}
													$html .= '</h3>';
													$date = $book->tgl_booking.' '.$book->jam_main;
													$html .= '<div class="inner-booking-list">
														<h5>Booking Date:</h5>
														<ul class="booking-list">
															<li class="highlighted">'.date('d M Y / H:i', strtotime($date)).' WIB</li>
														</ul>
													</div>

													<div class="inner-booking-list">
														<h5>Paket Lapangan:</h5>
														<ul class="booking-list">
															<li class="highlighted">Paket '.$book->nama_lapangan.' </li>
														</ul>
													</div>		

													<div class="inner-booking-list">
														<h5>Total Harga:</h5>
														<ul class="booking-list">
															<li class="highlighted">Rp.  '.number_format($book->total_harga,0,',','.').'</li>
														</ul>
													</div>';
													if (@$book->keterangan_status){

														$html.='<div class="inner-booking-list">
															<h5>Keterangan:</h5>
															<span>'.$book->keterangan_status.'</span>
															</div>';
												}

										$html.= '</div>
									</div>
								</div>
								<div class="buttons-to-right">
									<a href="'.site_url('Users/Booking/successBooking/'.$book->id_pesanan).'" class="button gray approve"><i class="ti-trash"></i> Lihat Detail</a>
								</div>
							</li>';
					}else{
						$html .= '<li class="pending-booking">
								<div style="width: 100%; margin: 0 auto; text-align: center;">
									<div>
										<h5><i class="fa fa-info-circle"></i> No Found Booking Order</h5>
									</div>
								</div>
							</li>';
					} 
			$respons['html'] = $html;
			$respons['data'] = $book;
			$respons['message'] = "Success get data Lapangan";
			$respons['result'] = true;
		}else{
			$respons['data'] = [];
			$respons['message'] = "Tidak Ada paramater yang di kirim";
			$respons['result'] = false;
		}

		echo json_encode($respons);

	}

}

/* End of file api.php */
/* Location: ./application/controllers/Users/api.php */
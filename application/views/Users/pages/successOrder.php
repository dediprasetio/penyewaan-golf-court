<?php $row = $data['data']['result']['booking'] ?>

<style type="text/css">
	ol.information li{
		font-size: 15px;
	}
	ul.putusputus li{
		border-bottom: 1px dashed rgba(0, 0, 0, 0.09);
	}
</style>
<!-- =================== Sidebar Search ==================== -->
<section class="gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?= $this->session->flashdata('notif'); ?>
			</div>

			<div class="col-lg-8 col-md-12">

				<div class="checkout-wrap">

					<div class="checkout-head">
						<div class="success-message">
							<span class="thumb-check"><i class="ti-check"></i></span>

							<h4>Success! Already Booking</h4>
							<!-- <h5 style="margin-top: 10px;">Your Kode Booking </h5> -->
							<p class="">Kode Booking : <b class="text-primary"><?= $row->kode_booking ?></b></p>
							
						</div>
					</div>

					<div class="checkout-body">


						<div class="row">
							<div class="col-md-12 col-lg-12">

								<ul class="booking-detail-list putusputus">
									<li>ID Booking<span><?= $row->id_pesanan ?></span></li>
									<li>Kode Booking<span><?= $row->kode_booking ?></span></li>
									<li>Waktu Main<span><?= date('d M Y H:i', strtotime($row->tgl_booking.' '.$row->jam_main)) ?> WIB</span></li>
									<li>Nama Pemesan<span><?= $row->nama_pemesan ?></span></li>
									<li>Email Pemesan<span><?= $row->email_pemesan ?></span></li>
									<li>No Telephone<span><?= $row->no_telp_pemesan ?></span></li>
									<li>Jenis Pelanggan<span><?= $row->jenis_pelanggan == "Tamu" ? "Non Member" : "Member" ?></span></li>
									<li>Paket Lapangan<span>Paket <?= $row->nama_lapangan ?></span></li>
									<?php if (@$row->fasilitas): ?>
										<li>Fasilitas Member <span>Di Gunakan</span></li>
									<?php endif ?>
									<?php if (@$row->id_paket_alat): ?>
										<li>Paket Sewa Alat<span><?= $row->nama_paket_alat ?></span></li>
									<?php endif ?>
									<?php if (@$row->id_paket_mobil): ?>
										<li>Paket Sewa Mobil<span><?= $row->nama_paket_mobil ?></span></li>
									<?php endif ?>
									<li>Tanggal Pesan <span><?= date('d-m-Y H:i:s', strtotime($row->tgl_pesan))  ?></span></li>
									<li>Total Pembayaran<span>Rp. <?= number_format($row->total_harga,0,',','.')  ?></span></li>
									<li>Status Pembayaran <span><?= $row->status_pesanan  ?></span></li>
									<?php if (@$row->bukti_bayar): ?>
										<li>Tanggal Bayar <span><?= date('d-m-Y H:i:s', strtotime($row->tanggal_bayar))  ?></span></li>
									<?php endif ?>
									<?php if (@$row->admin_cek): ?>
										<li>Total Transfer <span>Rp. <?= number_format($row->total_bayar,0,',','.')  ?></span></li>
										<li>Admin Check <span><?= $row->nama_admin  ?></span></li>
										<li>Email Admin <span><?= $row->email  ?></span></li>
										<li>Keterangan <span><?= $row->keterangan_status  ?></span></li>
										<li>Waktu Konfirmasi <span><?= date('d-m-Y H:i:s', strtotime($row->update_at))  ?></span></li>
									<?php endif ?>
								</ul>
								<hr>

								<h4>Informasi Pembayaran</h4>
								<p>
									<ol class="information">
										<li>Mohon lakukan Screen Shot pada halaman ini untuk melakukan konfirmasi Pesanan</li>
										<li>Jumlah yang harus di bayar sebesar <b>Rp. <?= number_format($row->total_harga,0,',','.') ?></b></li>
										<li>Transfer ke bank BRI dengan no Rekening 1234458900 a/n PT.Court Golf Indonesia dengan kode (002)</li>
										<li>Setelah melakukan transfer, simpan bukti transfer dan konfirmasi pembayaran dengan menyertakan bukti transfer di halaman <u><i><a href="#konfirmasipembayaran">Konfirmasi Pembayaran!</a></i></u></li>
										<li>Pesanan yang sudah menyertakan konfirmasi pembayaran akan di verifikasi oleh admin</li>
										<li>Pada saat akan melakukan konfirmasi pesanan di meja resepsionis, mohon untuk menunjukan bukti transfer dan screen shot halaman konfirmasi untuk verifikasi lebih lanjut</li>
									</ol>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group text-center">
												<a href="#konfirmasipembayaran" class="btn btn-theme">Konfirmasi Pembayaran!</a>
											</div>
										</div>
									</div>
								</p>
							</div>
						</div>
					</div>

				</div>

			</div>
			<div class="col-lg-4 col-md-12" >
				<div class="checkout-side" id="konfirmasipembayaran">

					<div class="booking-short">
						<h4>Konfirmasi Pembayaran </h4>
						<span>Kode Booking : <b class="text-primary"><?= $row->kode_booking ?></b></span>
					</div>

					<div class="booking-short-side">
						<div class="accordion" id="accordionExample">

							<div class="card" >
								<div class="card-header" id="CouponCode">
									<h2 class="mb-0">
										<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#couponcd" aria-expanded="true" aria-controls="couponcd">
											Form Konfirmasi Pembayaran 
										</button>
									</h2>
								</div>
								<form action="<?= site_url('Users/Booking/konfirmasiPembayaran') ?>" method="POST" enctype="multipart/form-data">
									<div id="couponcd" class="collapse show" aria-labelledby="CouponCode" data-parent="#accordionExample" style="">
										<?php 
										$src = @$row->bukti_bayar ? base_url('/assets/users/assets/img/uploaded_payment_booking/'.$row->bukti_bayar) : '';
										$disable = @$row->bukti_bayar && $row->status_pesanan == "Accept" ? 'disabled=""' : '';
										 ?>
										<div class="card-body">
											<div class="form-group">
												<label>Total Yang Harus di bayar</label>
												<h5 class="text-primary">Rp. <?= number_format($row->total_harga,0,',','.') ?></h5>
											</div>
											<div class="form-group">
												<label>Bukti Pembayaran</label>
												<input required="" type="file" name="buktibayar" accept="image/*" id="buktibayar" class="form-control" value="<?= $src ?>" onchange="PreviewImage();" <?= $disable ?>>
												<small><i>Max image Size 2Mb</i></small>
											</div>
											<div class="form-group">
												<label>Result Bukti Pembayaran</label>
												<div style="width: 100%; margin: 0 auto; border: 1px dashed rgba(0, 0, 0, 0.09); ">
													<img src="<?= $src ?>" class="img-responsive" id="resultbuktibayar" alt="Result bukti Pembayaran" style="width: 100%; min-height: 10vh;">
												</div>
											</div>
											<div class="form-group">
												<input hidden="" type="text" name="tgl" value="<?= $row->tgl_booking ?>">
												<input hidden="" type="text" name="sta" value="<?= $row->status_pesanan ?>">
												<input hidden="" type="text" name="id" value="<?= $row->id_pesanan ?>">
												<input hidden="" type="text" name="kode" value="<?= $row->kode_booking ?>">
												<input type="submit" <?= $disable ?> class="btn btn-primary full-width mt-2" value="Konfirmasi">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<!-- =================== Sidebar Search ==================== -->
<script type="text/javascript">
	function PreviewImage() {
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("buktibayar").files[0]);
		oFReader.onload = function (oFREvent)
		{
			document.getElementById("resultbuktibayar").src = oFREvent.target.result;
		};
	};
</script>

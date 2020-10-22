<link rel="stylesheet" type="text/css" href="<?= site_url('assets/dist/lightbox/dist/ekko-lightbox.css') ?>">
<?php $row = $data['data']['result']['booking']; ?>
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
		<!-- begin::Card-->
		<div class="card card-custom overflow-hidden">
			<div class="card-body p-0">
				<!-- begin: Invoice-->
				<!-- begin: Invoice header-->
				<div id="printArea">


					<div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0" style="background-image: url(<?= base_url('assets/') ?>dist/assets/media/bg/bg-6.jpg);">
						<div class="col-md-9">
							<div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
								<h1 class="display-4 text-white font-weight-boldest mb-10">INVOICE</h1>
								<div class="d-flex flex-column align-items-md-end px-0">
									<!--begin::Logo-->
									<a href="#" class="mb-5">
										<img src="<?= base_url('assets/users/assets/images/logo-fix-2.png') ?>" style="width: 200px; background: white;" alt="" />
									</a>
									<!--end::Logo-->
									<span class="text-white d-flex flex-column align-items-md-end opacity-70">
										<span>Jl. Golf No 1 Kepuharjo, Cangkringan</span>
										<span>Kab. Sleman - Yogyakarta 55281</span>
									</span>
								</div>
							</div>
							<div class="border-bottom w-100 opacity-20"></div>
							<div class="d-flex justify-content-between text-white pt-6">
								<div class="d-flex flex-column flex-root">
									<span class="font-weight-bolde mb-2r">Tanggal Pesan</span>
									<span class="opacity-70"><?= date('d F Y', strtotime($row->tgl_pesan)) ?></span>
								</div>
								<div class="d-flex flex-column flex-root">
									<span class="font-weight-bolder mb-2">Kode Booking</span>
									<span class="opacity-70">#<?= $row->kode_booking ?></span>
								</div>
								<div class="d-flex flex-column flex-root">
									<span class="font-weight-bolder mb-2">Identitas Pemesan.</span>
									<span class="opacity-70"><?= $row->nama_pemesan ?> - <?= $row->jenis_pelanggan == "Member" ? "Member" : "Non Member" ?><br>  	<?= $row->no_telp_pemesan ?>
									<br /><?= $row->email_pemesan ?></span>
								</div>
							</div>
						</div>
					</div>
					<!-- end: Invoice header-->
					<!-- begin: Invoice body-->
					<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
						<div class="col-md-9">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th class="pl-0 font-weight-bold text-muted text-uppercase">Item Order</th>
											<th class="text-left font-weight-bold text-muted text-uppercase">Deskripsi</th>
											<th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Sub Total</th>
										</tr>
									</thead>
									<tbody>
										<tr class="font-weight-boldest font-size-lg">
											<td class="pl-0 pt-7">Paket Lapangan</td>
											<td class="text-left pt-7">Paket <?= $row->nama_lapangan ?></td>
											<td class="text-danger pr-0 pt-7 text-right">Rp <?= number_format($row->harga_lapangan,0,',','.') ?></td>
										</tr>

										<?php if (@$row->id_fasilitas): ?>
											<tr class="font-weight-boldest font-size-lg">
												<td class="pl-0 pt-7">Paket Fasilitas Member</td>
												<td class="text-left pt-7">Mendapatkan Potongan Harga sebesar <?= $row->diskon_member."%" ?></td>
												<td class="text-danger pr-0 pt-7 text-right">Rp <?= number_format(0,0,',','.') ?></td>
											</tr>
										<?php endif ?>

										<?php if (@$row->id_paket_barang): ?>
											<tr class="font-weight-boldest font-size-lg">
												<td class="pl-0 pt-7">Paket Sewa Alat</td>
												<td class="text-left pt-7"><?= $row->nama_paket_alat ?></td>
												<td class="text-danger pr-0 pt-7 text-right">Rp <?= number_format($row->harga_paket_alat,0,',','.') ?></td>
											</tr>
										<?php endif ?>

										<?php if (@$row->id_paket_mobil): ?>
											<tr class="font-weight-boldest font-size-lg">
												<td class="pl-0 pt-7">Paket Sewa Mobil</td>
												<td class="text-left pt-7"><?= $row->nama_paket_mobil ?></td>
												<td class="text-danger pr-0 pt-7 text-right">Rp <?= number_format($row->harga_paket_mobil,0,',','.') ?></td>
											</tr>
										<?php endif ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- end: Invoice body-->
					<!-- begin: Invoice footer-->
					<div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
						<div class="col-md-9">
							<div class="d-flex justify-content-between flex-column flex-md-row font-size-lg">
								<div class="d-flex flex-column mb-10 mb-md-0">
									<div class="font-weight-bolder font-size-lg mb-3">Detail Booking Order</div>
									<div class="d-flex justify-content-between mb-3">
										<span class="mr-15 font-weight-bold">Tanggal Main</span>
										<span class="text-right"><?= date('d F Y', strtotime($row->tgl_booking))?></span>
									</div>
									<div class="d-flex justify-content-between mb-3">
										<span class="mr-15 font-weight-bold">Jam Main</span>
										<span class="text-right"><?= date('H:i:s', strtotime($row->jam_main))?> WIB</span>
									</div>
									<div class="d-flex justify-content-between mb-3">
										<span class="mr-15 font-weight-bold">Status Pesanan </span>
										<span class="text-right <?= $row->status_pesanan == "Accept" ? " text-success" : "text-danger"; ?>"><?= $row->status_pesanan ?></span>
									</div>
									<div class="d-flex justify-content-between mb-3">
										<span class="mr-15 font-weight-bold">Tanggal Bayar</span>
										<span class="text-right"><?= @$row->tanggal_bayar ? date('d F Y', strtotime($row->tanggal_bayar)) : '' ?></span>
									</div>
									<div class="d-flex justify-content-between mb-3">
										<span class="mr-15 font-weight-bold">Total Bayar</span>
										<span class="text-right"><?= @$row->total_bayar ? "Rp ".number_format($row->total_bayar,0,',','.') : '' ?></span>
									</div>
									<div class="d-flex justify-content-between mt-5">
										<span class="mr-15 font-weight-bold">Bukti Bayar</span>
										<span class="text-right">
											<a href="<?= base_url('assets/users/assets/img/uploaded_payment_booking/'.$row->bukti_bayar) ?>" data-toggle="lightbox" data-title="Payment Kode #<?= $row->kode_booking ?>" data-footer="Tanda Bukti Pembayaran" data-min-width="800" class="btn btn-primary btn-sm">Bukti Bayar</a>
										</span>
									</div>
								</div>
								<div class="d-flex flex-column text-md-right">
									<span class="font-size-lg font-weight-bolder mb-1">TOTAL HARGA</span>
									<span class="font-size-h2 font-weight-boldest text-danger mb-1"><?= "Rp ".number_format($row->total_harga,0,',','.') ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
						<div class="col-md-9">
							<div class="d-flex justify-content-between pt-6">
								<div class="d-flex flex-column flex-root text-center">
									&nbsp;
								</div>
								<div class="d-flex flex-column flex-root text-center">
									&nbsp;
								</div>
								<div class="d-flex flex-column flex-root text-center">
									<span class="mb-5">Mengetahui dan mengesahkan,</span>
									<span class="font-weight-bolder mb-2">Petugas </span>
									<span style="margin: 35px 0;"></span>

									<span class="opacity-70">
										(<?= @$row->nama_admin ? $row->nama_admin : $this->session->userdata('nama'); ?>)<br>
										<?= @$row->level_admin ? $row->level_admin : $this->session->userdata('level'); ?>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end: Invoice footer-->
				<!-- begin: Invoice action-->
				<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
					<div class="col-md-9">
						<div class="d-flex justify-content-between">
							<?php $disabled=''; if (!$row->bukti_bayar){ $disabled = 'disabled=""'; }elseif (date('Y-m-d') > $row->tgl_booking) {$disabled = 'disabled="1"';} ?>
							<button type="button" <?= $disabled ?> class="btn btn-light-primary font-weight-bold" data-toggle="modal" data-target="#responseOrder">Konfirmasi Pemesanan</button>
							<button type="button" class="btn btn-primary font-weight-bold" onclick="PrintMe('printArea');">Print Invoice</button>
						</div>
					</div>
				</div>
				<!-- end: Invoice action-->
				<!-- end: Invoice-->
			</div>
		</div>
		<!-- end::Card-->
	</div>
	<!--end::Container-->
</div>

<div class="modal fade" id="responseOrder" tabindex="-1" role="dialog" aria-labelledby="resConfirm" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="resConfirm">Confirmation Booking Order</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button>
			</div>
			
			<form action="<?= site_url('Admin/Booking/confirmation/'.base64_encode($row->id_pesanan)) ?>" method="POST">
				<div class="modal-body">
					<div class="card-body">
						<div class="form-group">
							<label>Total Biaya Transfer</label>
							<input type="number" name="bayar" <?= @$row->total_bayar ? "value='".$row->total_bayar."'" : '' ?> class="form-control" placeholder="Masukan Jumlah Uang Transfer"/>

							<input type="number" name="total" value="<?= $row->total_harga ?>" required="" hidden="">
							<input type="text" name="id" value="<?= $row->id_pesanan ?>" required="" hidden="">
							<input type="text" name="kode" value="<?= $row->kode_booking ?>" required="" hidden="">

							<input type="text" name="admin" value="<?= $this->session->userdata('id'); ?>" required="" hidden="">

							<span class="form-text text-muted">Exp (Rp) : 150000</span>
						</div>
						<div class="form-group">
							<label for="status">Status Pesanan <span class="text-danger">*</span></label>
							<?php $sta = ['Pending', 'Accept', 'Reject']; ?>
							<select class="form-control" name="status" id="status" required="">
								<?php foreach ($sta as $key => $val): ?>
									<option <?= $row->status_pesanan == $val ? 'selected=""' : '' ?> value="<?= $val ?>"><?= $val ?></option>
								<?php endforeach ?>

							</select>
						</div>

						<div class="form-group mb-1">
							<label for="keterangan">Keterangan Status</label>
							<textarea class="form-control" name="keterangan" id="keterangan" rows="3"><?= @$row->keterangan_status ? $row->keterangan_status : '' ?></textarea>
						</div>
						<div class="form-group mb-1 mt-3 text-right">
							<a href="<?= base_url('assets/users/assets/img/uploaded_payment_booking/'.$row->bukti_bayar) ?>" data-toggle="lightbox" data-title="Payment Kode #<?= $row->kode_booking ?>" data-footer="Tanda Bukti Pembayaran" data-min-width="800" class="btn btn-primary">Bukti Bayar</a>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary font-weight-bold" value="Confrim Booking">
				</div>
			</form>
		</div>
	</div>
</div>
<!--end::Entry-->
<script type="text/javascript" src="<?= site_url('assets/dist/lightbox/dist/ekko-lightbox.min.js') ?>"></script>

<script type="text/javascript">
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});

</script>
<script language="javascript">
	function PrintMe(DivID) {
		var printContents = document.getElementById(DivID).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
</script>

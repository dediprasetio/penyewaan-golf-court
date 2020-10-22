
<?php $row = $data['data']['result']; ?>
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
					<div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
						<div class="col-md-9">
							<div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
								<h1 class="display-4 font-weight-boldest mb-10">INVOICE MEMBER</h1>
								<div class="d-flex flex-column align-items-md-end px-0">
									<!--begin::Logo-->
									<a href="#" class="mb-5">
										<img src="<?= base_url('assets/users/assets/images/logo-fix-2.png') ?>" style="width: 200px" alt="" />
									</a>
									<!--end::Logo-->
									<span class="d-flex flex-column align-items-md-end opacity-70">
										<span>Jl. Golf No 1 Kepuharjo, Cangkringan</span>
										<span>Kab. Sleman - Yogyakarta 55281</span>
									</span>
								</div>
							</div>
							<div class="border-bottom w-100"></div>
							<div class="d-flex justify-content-between pt-6">
								<div class="d-flex flex-column flex-root">
									<span class="font-weight-bolder mb-2">Tanggal Bayar</span>
									<span class="opacity-70"><?= date('d F Y', strtotime($row['payment']->payment_date)) ?></span>
								</div>
								<div class="d-flex flex-column flex-root">
									<span class="font-weight-bolder mb-2">INVOICE NO.</span>
									<span class="opacity-70">IN - <?= $row['payment']->id_payment ?></span>
								</div>
								<div class="d-flex flex-column flex-root">
									<span class="font-weight-bolder mb-2">IDENTITY MEMBER</span>
									<span class="opacity-70"><?= $row['payment']->nama_member ?> <br>(<?= $row['payment']->no_telp ?>) <?= $row['payment']->email_member ?>
										<br /><?= $row['payment']->alamat ?></span>
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
												<th class="pl-0 font-weight-bold text-muted text-uppercase">Item</th>
												
												<th class=" font-weight-bold text-muted text-uppercase">Description</th>

												<th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Sub Total</th>
											</tr>
										</thead>
										<tbody>
											<tr class="font-weight-boldest">
												<td class="pl-0 pt-7">Status Member</td>
												<td class=" pt-7">Member Status Active</td>
												<td class="text-danger pr-0 pt-7 text-right">Rp <?= number_format($row['payment']->price,0,',','.') ?></td>
											</tr>
											<tr class="font-weight-boldest border-bottom-0">
												<td class="border-top-0 pl-0 py-4">Fasilitas Member</td>
												<td class="border-top-0 py-4">Fasilitas Golf Member Active</td>
												<td class="text-danger border-top-0 pr-0 py-4 text-right">Rp. 0</td>
											</tr>
											<tr class="font-weight-boldest border-bottom-0">
												<td class="border-top-0 pl-0 py-4">Diskon Member</td>
												<td class="border-top-0 py-4">Diskon Booking Court <b><?= $row['fasilitas']->diskon_member."%" ?></b> Active</td>
												<td class="text-danger border-top-0 pr-0 py-4 text-right">Rp. 0</td>
											</tr>

										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- end: Invoice body-->
						<!-- begin: Invoice footer-->

						<div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
							<div class="col-md-9">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th class="font-weight-bold text-muted text-uppercase ">Id Member</th>
												<th class="font-weight-bold text-muted text-uppercase">Nama Member</th>
												<th class="font-weight-bold text-muted text-uppercase">START DATE</th>
												<th class="font-weight-bold text-muted text-uppercase">EXPIRED DATE</th>
												<th class="font-weight-bold text-muted text-uppercase">TOTAL HARGA</th>
											</tr>
										</thead>
										<tbody>
											<tr class="font-weight-bolder">
												<td class=""><?= $row['payment']->id_member ?></td>
												<td class=""><?= $row['payment']->nama_member ?></td>
												<td class=""><?= date('d M Y', strtotime($row['payment']->start_from)) ?></td>
												<td class=""><?= date('d M Y', strtotime($row['payment']->end_before)) ?></td>
												<td class="text-danger font-weight-boldest"><h3><b>Rp <?= number_format($row['payment']->price,0,',','.') ?></b></h3></td>
											</tr>
										</tbody>
									</table>
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
											(<?= $row['payment']->nama_admin ?>)<br>
											<?= $row['payment']->level ?>
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
							<div class="row">
								<div class="col-md-12 text-right">
									<button type="button" class="btn btn-primary font-weight-bold" onclick="PrintMe('printArea');">Print Invoice</button>
								</div>
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
	<!--end::Entry-->

	<script language="javascript">
		function PrintMe(DivID) {
			var printContents = document.getElementById(DivID).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
	</script>
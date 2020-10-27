<?php 
$record = $data['data']['result']; 
$row = $record['member'];
$payment = $record['payment'];
?>

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
	<!--begin::Container-->
	<div class="container">
		<!--begin::Profile 4-->
		<div class="d-flex flex-row">
			<!--begin::Aside-->
			<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
				<!--begin::Card-->
				<div class="card card-custom gutter-b">
					<!--begin::Body-->
					<div class="card-body pt-4">

						<!--begin::User-->
						<div class="d-flex align-items-center mt-3">
							<div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
								<div class="symbol-label" style="background-image:url('<?= base_url('assets/') ?>dist/assets/images/user.jpg')"></div>
								<i class="symbol-badge bg-success"></i>
							</div>
							<div>
								<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= $row->nama_member ?></a>
								<div class="text-muted"><?= $row->status_member == "Member" ? "Member" : "Calon Member" ?></div>
								<div class="mt-2">
									<a href="javascript:void(0);" class="btn btn-sm btn-primary btn-block font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1"><?= $row->status_member ?></a>
								</div>
							</div>
						</div>
						<!--end::User-->
						<!--begin::Contact-->
						<div class="pt-8 pb-6">
							<div class="d-flex align-items-center justify-content-between mb-3">
								<span class="font-weight-bold mr-2">ID:</span>
								<a href="#" class="text-muted text-hover-primary"><?= $row->id_member ?></a>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-3">
								<span class="font-weight-bold mr-2">Email:</span>
								<a href="#" class="text-muted text-hover-primary"><?= $row->email ?></a>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-3">
								<span class="font-weight-bold mr-2">Phone:</span>
								<span class="text-muted"><?= $row->no_telp ?></span>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-3">
								<span class="font-weight-bold mr-2">Gender:</span>
								<span class="text-muted"><?= $row->jenis_kelamin ?></span>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-3">
								<span class="font-weight-bold mr-2">Tempat, Tgl Lahir:</span>
								<span class="text-muted"><?= $row->tempat_lahir.", ".date('d M Y', strtotime($row->tgl_lahir)) ?></span>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-3">
								<span class="font-weight-bold mr-2">Alamat:</span>
								<span class="text-muted"><?= $row->alamat ?></span>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-3">
								<span class="font-weight-bold mr-2">Register Date:</span>
								<span class="text-muted"><?= date('d M Y', strtotime($row->register_date)) ?></span>
							</div>
							<div class="d-flex align-items-center justify-content-between mb-3">
								<span class="font-weight-bold mr-2">Register Time:</span>
								<span class="text-muted"><?= date('H:i:s', strtotime($row->register_date)) ?> WIB</span>
							</div>
						</div>
						<!--end::Contact-->
						<!--begin::Contact-->
						<div class="pb-6">Untuk mengubah profile member, silahkan click button di bawah ini!</div>
						<!--end::Contact-->
						<a href="<?= site_url('Admin/Member/form/'.base64_encode($row->id_member)) ?>" class="btn btn-light-success font-weight-bold py-3 px-6 mb-2 text-center btn-block">Edit Member</a>
						<a href="<?= site_url('Admin/Member/printcard/'.base64_encode($row->id_member)) ?>" class="btn btn-light-info font-weight-bold py-3 px-6 mb-2 text-center btn-block">Print Kartu</a>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Card-->
				
			</div>
			<!--end::Aside-->
			<!--begin::Content-->
			<div class="flex-row-fluid ml-lg-8">

				<!--begin::Advance Table Widget 8-->
				<div class="card card-custom gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 py-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark">Payment Member</span>
							<span class="text-muted mt-3 font-weight-bold font-size-sm">List Pembayaran oleh Member</span>
						</h3>
						<div class="card-toolbar">
							<a href="<?= site_url('Admin/Member/formInvoice/'.base64_encode($row->id_member)) ?>" class="btn btn-success font-weight-bolder font-size-sm">
								<span class="svg-icon svg-icon-md svg-icon-white">
									<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Add-user.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24" />
											<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
											<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>Pay Bills Member</a>
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body pt-0 pb-3">
							<!--begin::Table-->
							<div class="table-responsive">
								<table class="table table-head-custom table-head-bg table-vertical-center table-borderless">
									<thead>
										<tr class="bg-gray-100 text-left">
											<th class="text-center" style="min-width: 50px">No.</th>
											<th class="text-center" style="min-width: 130px">Tgl Bayar</th>
											<th class="text-center" style="min-width: 130px">Tgl Mulai</th>
											<th class="text-center" style="min-width: 130px">Tgl Expired</th>
											<th class="text-center" style="min-width: 140px">Total Bayar</th>
											<th class="text-center" style="min-width: 130px">Status bayar</th>
											<th class="text-center" style="min-width: 150px">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1; foreach ($payment as $pay): ?>
											
										<tr>
											<td class="text-center">
												<span class=" d-block font-size-lg"><?= $i; ?></span>
											</td>
											<td class="text-center">
												<span class=" d-block font-size-lg"><?= date('d M Y', strtotime($pay['payment_date'])) ?></span>
											</td>
											<td class="text-center">
												<span class=" d-block font-size-lg"><?= date('d M Y', strtotime($pay['start_from'])) ?></span>
											</td>
											<td class="text-center">
												<span class=" d-block font-size-lg"><?= date('d M Y', strtotime($pay['end_before'])) ?></span>
											</td>
											<td class="text-right">
												<span class=" d-block font-size-lg"><?= "Rp ".number_format($pay['price'],0,',','.') ?></span>
											</td>
											<td class="text-center">
												<span class="label label-lg label-light-<?= $pay['status_payment'] == "Reject" ? "danger" : "primary" ?> label-inline"><?= $pay['status_payment'] ?></span>
											</td>
											<td class="pr-0 text-center">
												<?php $dis = $i > 1 ? 'javascript:void(0)' : site_url('Admin/Member/formInvoice/'.base64_encode($row->id_member).'?pay='.base64_encode($pay['id_payment'])); ?>

												<a href="<?= site_url('Admin/Member/showInvoice/'.base64_encode($pay['id_payment'])) ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm" title="Lihat Invoice">
													<span class="svg-icon svg-icon-md svg-icon-primary"><i class="fas fa-info"></i></span>
												</a>
												<a href="<?= $dis ?>"  class="btn btn-icon btn-light btn-hover-success btn-sm" title="Edit Invoice">
													<span class="svg-icon svg-icon-md svg-icon-primary"><i class="fas fa-edit"></i></span>
												</a>
												
											</td>
										</tr>
										<?php $i++; endforeach ?>

									</tbody>
								</table>
							</div>
							<!--end::Table-->
						</div>
						<!--end::Body-->
					</div>
					<!--end::Advance Table Widget 8-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Profile 4-->
		</div>
		<!--end::Container-->
	</div>
						<!--end::Entry-->
<link href="<?= base_url('assets/') ?>dist/assets/plugins/custom/datatables/datatables.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />

<style type="text/css">
	.font-blue-in-here{
		color: #187DE4;
	}

	.font-blue-in-here:hover i.edit {
		color: #0073e9;
	}
	.font-blue-in-here:hover i.trash {
		color: #F64E60;
	}
	.alert.alert-custom{
		padding: 0.75rem 1.25rem !important;
	}
</style>
<!--begin::Card-->
<div class="card card-custom gutter-b">
	<div class="card-header flex-wrap py-3">
		<div class="card-title">
			<h3 class="card-label">Data Fasilitas Member 
				<span class="d-block text-muted pt-2 font-size-sm">Fasilitas yang di dapat ketika menjadi Member</span></h3>
			</div>
			<div class="card-toolbar">

				<!--begin::Button-->
				<?php if (count($data['data']['result']['fasilitas']) < 1): ?>
					
				<a href="<?= site_url('Admin/Fasilitas/form') ?>" class="btn btn-primary font-weight-bolder">
					<span class="svg-icon svg-icon-md">
						<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<circle fill="#000000" cx="9" cy="15" r="6" />
								<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>Add  Fasilitas for Member
				</a>
				<?php endif ?>

				<!--end::Button-->
			</div>
		</div>
		<div class="card-body">
			<!--begin: Datatable-->
			<table class="table table-bordered table-checkable" id="kt_datatable">
				<thead>
					<tr>
						<th>No</th>
						<th>Diskon Member (%)</th>
						<th>Last Update From</th>
						<th>Last Time Update</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach ($data['data']['result']['fasilitas'] as $key): ?>

					<tr>
						<td><?= $no++; ?></td>
						<td><?= number_format($key['diskon_member'],0,',','.') ?>%</td>
						<td><?= $key['nama_admin'] ?></td>
						<td><?= date('d-m-Y H:i:s', strtotime(@$key['update_at'] ? $key['update_at'] : $key['create_at'])) ?></td>
						<td class="text-center">
							<a href="<?= site_url('Admin/Fasilitas/form/'.base64_encode($key['id_fasilitas'])) ?>" class="font-blue-in-here"><i class="fas fa-edit edit"></i></a>
							<!-- <a onclick="confirm('Hapus data ini?')" href="<?= site_url('Admin/Court/delete/'.base64_encode($key['id_price'])) ?>" class="font-blue-in-here"><i class="fas fa-trash trash"></i></a>  -->
						</td>
					</tr>
				<?php endforeach ?>

			</tbody>
		</table>
		<!--end: Datatable-->
	</div>
</div>
<!--end::Card-->
<div class="card card-custom gutter-b">
	<div class="card-header flex-wrap py-3">
		<div class="card-title">
			<h3 class="card-label">List Fasilitas Member 
				<span class="d-block text-muted pt-2 font-size-sm">Fasilitas yang di dapat ketika menjadi Member</span></h3>
			</div>
			<div class="card-toolbar">

				<!--begin::Button-->
					
				<a href="<?= site_url('Admin/Fasilitas/formDetail') ?>" class="btn btn-primary font-weight-bolder">
					<span class="svg-icon svg-icon-md">
						<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<circle fill="#000000" cx="9" cy="15" r="6" />
								<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>Add  Fasilitas for Member
				</a>

				<!--end::Button-->
			</div>
		</div>
		<div class="card-body">
			<!--begin: Datatable-->
			<table class="table table-bordered table-checkable" id="kt_datatable_2">
				<thead>
					<tr>
						<th>No</th>
						<th>Deskripsi Fasilitas</th>
						<th>Qty</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach ($data['data']['result']['detail'] as $key): ?>

					<tr>
						<td><?= $no++; ?></td>
						<td><?= $key['deskripsi'] ?></td>
						<td><?= $key['qty'] ?></td>

						<td class="text-center">
							<a href="<?= site_url('Admin/Fasilitas/formDetail/'.base64_encode($key['id'])) ?>" class="font-blue-in-here"><i class="fas fa-edit edit"></i></a>
							<a onclick="deleteThs(this)" href="javascript:;" data-id="<?= base64_encode($key['id']) ?>" data-url="<?= site_url('Admin/Fasilitas/Delete/') ?>" class="font-blue-in-here"><i class="fas fa-trash trash"></i></a> 
						</td>
					</tr>
				<?php endforeach ?>

			</tbody>
		</table>
		<!--end: Datatable-->
	</div>
</div>
<!--begin::Page Vendors(used by this page)-->
<script src="<?= base_url('assets/') ?>dist/assets/plugins/custom/datatables/datatables.bundle526f.js?v=7.0.8"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="<?= base_url('assets/') ?>dist/assets/js/pages/crud/datatables/basic/basic526f.js?v=7.0.8"></script>
<script type="text/javascript">
	function deleteThs(val) {
		var id = $(val).data('id');
		var url = $(val).data('url');
		var conf = confirm("Hapus Data ini?");
		if (conf) {
			window.location.href = url+''+id;
		}
	}
</script>
		<!--end::Page Scripts-->
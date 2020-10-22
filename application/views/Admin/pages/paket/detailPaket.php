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
<?php $row = $data['data']['result']; ?>
<!--begin::Card-->
<div class="row">
	<div class="col-xl-5">
		<div class="card card-custom">
			<!--begin::Header-->
			<div class="card-header h-auto py-4">
				<div class="card-title">
					<h3 class="card-label"><?= $row['paket']->nama_paket ?> 
					<span class="d-block text-muted pt-2 font-size-sm">Deskripsi Paket <?= $row['paket']->nama_paket ?></span>
				</h3>
			</div>

		</div>
		<!--end::Header-->
		<!--begin::Body-->
		<div class="card-body py-4">
			<div class="form-group row my-2">
				<label class="col-4 col-form-label">Nama Paket </label>
				<div class="col-8">
					<span class="form-control-plaintext font-weight-bolder"><?= $row['paket']->nama_paket ?></span>
				</div>
			</div>
			<div class="form-group row my-2">
				<label class="col-4 col-form-label">Harga Paket </label>
				<div class="col-8">
					<span class="form-control-plaintext font-weight-bolder">Rp. <?= number_format($row['paket']->harga_paket,0,',','.')  ?></span>
				</div>
			</div>
			<div class="form-group row my-2">
				<label class="col-4 col-form-label">Deskripsi </label>
				<div class="col-8">
					<span class="form-control-plaintext">
						<span class="font-weight-bolder"><?= $row['paket']->deskripsi ?></span>
					</div>
				</div>
				<div class="form-group row my-2">
					<label class="col-4 col-form-label">Type </label>
					<div class="col-8">
						<span class="form-control-plaintext font-weight-bolder">Paket <?= $row['paket']->status ?></span>
					</div>
				</div>
				<div class="form-group row my-2">
					<label class="col-4 col-form-label">Create At </label>
					<div class="col-8">
						<span class="form-control-plaintext font-weight-bolder"><?= date('d F Y H:i:s', strtotime($row['paket']->create_at)) ?> WIB</span>
					</div>
				</div>
				<div class="form-group row my-2">
					<label class="col-4 col-form-label">Last Update </label>
					<div class="col-8">
						<span class="form-control-plaintext font-weight-bolder"><?= date('d F Y H:i:s', strtotime($row['paket']->update_at)) ?> WIB</span>
					</div>
				</div>
			</div>
			<!--end::Body-->
			<!--begin::Footer-->
			<div class="card-footer">
				<a href="<?= site_url('Admin/Paket/form/'.base64_encode($row['paket']->id_paket).'?q='.base64_encode('Alat')) ?>" class="btn btn-primary font-weight-bold mr-2"><i class="fas fa-edit"></i> Update Data</a>
				<a data-url="#" onclick="deleteThs(this)" class="btn btn-danger font-weight-bold"><i class="fas fa-trash"></i> Hapus Data</a>
			</div>
			<!--end::Footer-->
		</div>
		<!--end::Card-->
	</div>
	<div class="col-xl-7">
		<div class="card card-custom gutter-b">
			<div class="card-header flex-wrap py-3">
				<div class="card-title">
					<h3 class="card-label">List Detail <?= $row['paket']->nama_paket ?>
					<span class="d-block text-muted pt-2 font-size-sm">Detail Paket Sewa Alat</span>
				</h3>
			</div>
			<div class="card-toolbar">

				<!--begin::Button-->
				<a href="<?= site_url('Admin/Paket/formDetail?q='.base64_encode($row['paket']->id_paket)) ?>" class="btn btn-primary font-weight-bolder">
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
					</span>Add list item Paket</a>
					<!--end::Button-->
				</div>
			</div>
			<div class="card-body">
				<!--begin: Datatable-->
				<table class="table table-bordered table-checkable" id="kt_datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Name Alat</th>
							<th>Qty</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($row['detail'] as $key): ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $key['deskripsi_barang'] ?></td>
							<td><?= $key['qty'] ?></td>
							<td class="text-center">
								<a class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" href="<?= site_url('Admin/Paket/formDetail/'.base64_encode($key['id_detail_sewa'])).'?q='.base64_encode($row['paket']->id_paket) ?>" title="Edit Record"><i class="fas fa-edit edit"></i></a>
								<a class="btn btn-sm btn-default btn-text-primary btn-hover-danger btn-icon mr-2" onclick="deleteThs(this)" data-url="<?= site_url('Admin/Paket/deleteDetail/'.base64_encode($key['id_detail_sewa']).'?q='.base64_encode($row['paket']->id_paket)) ?>" title="Delete"><i class="fas fa-trash trash"></i></a> 
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<!--end: Datatable-->
		</div>
	</div>
</div>
</div>


<!--begin::Page Vendors(used by this page)-->
<script src="<?= base_url('assets/') ?>dist/assets/plugins/custom/datatables/datatables.bundle526f.js?v=7.0.8"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="<?= base_url('assets/') ?>dist/assets/js/pages/crud/datatables/basic/basic526f.js?v=7.0.8"></script>
<script type="text/javascript">
	function deleteThs(val) {
		var url = $(val).data('url');
		var conf = confirm("Hapus Data ini?");
		if (conf) {
			window.location.href = url;
		}
	}
</script>
		<!--end::Page Scripts-->
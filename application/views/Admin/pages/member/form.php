<style type="text/css">
  .alert.alert-custom{
    padding: 0.75rem 1.25rem !important;
  }
</style> 

<!--begin::Card-->
<div class="card card-custom example example-compact">
  <div class="card-header">
    <h3 class="card-title">Form Action Admin</h3>
  </div>

  <?php  
  echo validation_errors('<div class="alert alert-warning">', '</div>' );
  $row = $data['data']['result'];
  $url = @$row->id_member ? "action/".base64_encode($row->id_member) : "action";
  ?>

  <!--begin::Form-->
  <form method="POST" class="form" action="<?= site_url('Admin/Member/'.$url) ?>">
    <div class="card-body row">
      <div class="form-group col-xl-6 col-md-12">
        <label>ID Admin</label>
        <input type="text" name="id" class="form-control form-control-solid" value="<?= @$row->id_member ? $row->id_member : $row; ?>" readonly="">
      </div>
      <div class="form-group col-xl-6 col-md-12">
        <label>Nama Lengkap<span class="text-danger">*</span></label>
        <div class="input-with-icon">
          <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required="" value="<?= @$row->nama_member ? $row->nama_member : '' ?>">
        </div>
      </div>

      <div class="form-group col-xl-6 col-md-12">
        <label>Email<span class="text-danger">*</span></label>
        <div class="input-with-icon">
          <input type="email" class="form-control" name="email" placeholder="Enter Email" required="" value="<?= @$row->email  ? $row->email  : '' ?>">
        </div>
      </div>

      <div class="form-group col-xl-6 col-md-12">
        <label>No Telephone<span class="text-danger">*</span></label>
        <div class="input-with-icon">
          <input type="number" class="form-control" name="notelp" placeholder="No Telephone Member" required="" value="<?= @$row->no_telp  ? $row->no_telp  : ''; ?>">
        </div>
      </div>

      <div class="form-group col-xl-6 col-md-12">
        <label>Tempat Lahir<span class="text-danger">*</span></label>
        <div class="input-with-icon">
          <input type="text" class="form-control" value="<?= @$row->tempat_lahir  ? $row->tempat_lahir  : ''; ?>" name="tempat" placeholder="Tempat Lahir" required="">
        </div>
      </div>      

      <div class="form-group col-xl-6 col-md-12">
        <label>Tanggal Lahir<span class="text-danger">*</span></label>
        <div class="input-group date">
          <input type="text" name="tgllahir" class="form-control" id="kt_datepicker_2" readonly="readonly" placeholder="Pilih tanggal lahir" readonly="" value="<?= @$row->tgl_lahir  ? date('m/d/Y', strtotime($row->tgl_lahir))  : ''; ?>">
          <div class="input-group-append">
            <span class="input-group-text">
              <i class="la la-calendar-check-o"></i>
            </span>
          </div>
        </div>
      </div>

      <div class="form-group col-xl-6 col-md-12">
        <label>Jenis Kelamin<span class="text-danger">*</span></label>
        <div class="input-with-icon">

          <select class="form-control" name="jenkel" required="">
            <option <?= @$row->jenis_kelamin == "Laki-Laki" ? 'checked=""'  : '' ?> value="Laki-Laki">Laki-Laki</option>
            <option <?= @$row->jenis_kelamin == "Perempuan" ? 'checked=""'  : '' ?> value="Perempuan">Perempuan</option>
          </select>
        </div>
      </div>

      <div class="form-group col-xl-6 col-md-12">
        <label>Password<span class="text-danger">*</span></label>
        <div class="input-with-icon">
          <input type="password" class="form-control" name="pass" placeholder="*******" <?= @$row->password ? 'disabled=""' : 'required=""' ?> >
        </div>
      </div>

      <div class="form-group col-xl-6 col-md-12">
        <label>Alamat<span class="text-danger">*</span></label>
        <div class="input-with-icon">
          <textarea style="resize: none; height: 10vh;" name="alamat" class="form-control" placeholder="Alamat Lengkap" required=""><?= @$row->alamat  ? $row->alamat  : ''; ?></textarea>
        </div>
      </div>

      <div class="form-group col-xl-6 col-md-12">
        <label>Status Member<span class="text-danger">*</span></label>
        <div class="input-with-icon">
          <?php $status = ['Not Payment','Member', 'Expire', 'Pending']; ?>
          <select class="form-control" name="status" required="">
            <?php foreach ($status as $key => $sta): ?>
              <option  <?= @$row->status_member == $sta ? 'selected=""'  : '' ?> value="<?= $sta ?>"><?= $sta ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>

    </div>
    <div class="card-footer text-right">
      <input type="submit" name="action" class="btn btn-primary mr-2" value="<?= @$row->id_member ? "Update" : "Save" ?> Record">
      <span class="ml-2">or 
        <a href="javascript:;" onclick="window.history.back(-1)" class="font-weight-bold ml-2">Cancel</a>
      </span>
    </div>
  </form>
  <!--end::Form-->
</div>
                    <!--end::Card-->

<script src="<?= base_url('assets/') ?>dist/assets/js/pages/crud/forms/widgets/bootstrap-datepicker526f.js?v=7.0.8"></script>
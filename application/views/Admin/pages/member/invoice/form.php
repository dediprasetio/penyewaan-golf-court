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
  $url = @$row['payment']->id_payment ? "invoiceAction/".base64_encode($row['payment']->id_payment) : "invoiceAction";
  ?>

  <!--begin::Form-->
  <form method="POST" class="form" action="<?= site_url('Admin/Member/'.$url) ?>">
    <div class="card-body row">
      <div class="form-group col-xl-6 col-md-12">
        <label>No Invoice</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">IN - </span>
          </div>
          <input type="text" name="id" class="form-control bg-gray-100" value="<?= @$row['payment']->id_payment ? $row['payment']->id_payment : $row['payment']; ?>" readonly="">
        </div>
      </div>
      <div class="form-group col-xl-6 col-md-12">
        <label>Nama Member<span class="text-danger">*</span></label>
        <div class="input-with-icon">
          <select class="form-control" name="member" required="">
            <option selected="" value="<?= $row['member']->id_member ?>"><?= $row['member']->nama_member ?></option>
          </select>
        </div>
      </div>
      
      <div class="form-group col-xl-6 col-md-12">
        <label>Harga Member<span class="text-danger">*</span></label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Rp</span>
          </div>
          <input type="text" name="harga" readonly="" class="form-control" required="" value="<?= @$row['payment']->price == $row['price']->price ? $row['payment']->price : $row['price']->price ?>">
        </div>
      </div>


      <div class="form-group col-xl-6 col-md-12">
        <label>Duration Time Member<span class="text-danger">*</span></label>
        <div class="input-daterange input-group" id="kt_datepicker_5">
          <input type="text" class="form-control" required="" name="start" placeholder="Date Start" value="<?= @$row['payment']->start_from ? date('m/d/Y', strtotime($row['payment']->start_from)) : date('m/d/Y') ?>">
          <div class="input-group-append">
            <span class="input-group-text">
              <i class="la la-ellipsis-h"></i>
            </span>
          </div>
          <input type="text" class="form-control" required="" name="end" placeholder="Expired Date" value="<?= @$row['payment']->end_before ? date('m/d/Y', strtotime($row['payment']->end_before)) : date('m/d/Y', mktime(date("H"),date("i"),date("s"),date("n"),date("d"),date("Y")+1)) ?>">
        </div>
      </div>

      <div class="form-group col-xl-6 col-md-12">
        <label>Petugas Admin<span class="text-danger">*</span></label>
        <div class="input-with-icon">
          <select class="form-control" name="admin" required="">
            <option selected="" value="<?= $this->session->userdata('id'); ?>"><?= $this->session->userdata('nama').' - '.$this->session->userdata('level'); ?></option>
          </select>
        </div>
      </div>

      <div class="form-group col-xl-6 col-md-12">
        <label>Petugas Admin<span class="text-danger">*</span></label>
        <div class="input-with-icon">
          <?php $r = ['Pending', 'Accept', 'Reject']; ?>
          <select class="form-control" name="status" required="">
            <?php foreach ($r as $key => $value): ?>
              <option <?= @$row['payment']->status_payment == $value ? 'selected=""' : ''; ?> value="<?= $value; ?>"><?= $value; ?></option>
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
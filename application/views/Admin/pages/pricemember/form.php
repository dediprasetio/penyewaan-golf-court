<style type="text/css">
  .alert.alert-custom{
    padding: 0.75rem 1.25rem !important;
  }
</style> 

<!--begin::Card-->
<div class="card card-custom example example-compact">
  <div class="card-header">
    <h3 class="card-title">Form Action Price member</h3>
  </div>

  <?php  
  echo validation_errors('<div class="alert alert-warning">', '</div>' );

  $row = $data['data']['result'];
  $url = @$row['dataPrice']->id_price ? "action/".base64_encode($row['dataPrice']->id_price) : "action";
  ?>

  <!--begin::Form-->
  <form method="POST" class="form" action="<?= site_url('Admin/Price/'.$url) ?>">
    <div class="card-body">

      <div class="form-group">
        <label>Nama Admin Penginput<span class="text-danger">*</span> </label>
        <select class="form-control" name="admin" id="exampleSelect1" required="">
          <?php foreach ($row['dataAdmin'] as $key): ?>
            <?php if (@$row['dataPrice']->id_admin == $key['id_admin']): ?>
              <option value="<?= $key['id_admin'] ?>" selected=""><?= $key['nama_admin']." - ".$key['level'] ?></option>
            <?php elseif ($this->session->userdata('id') == $key['id_admin']) : ?>
              <option value="<?= $key['id_admin'] ?>" selected=""><?= $key['nama_admin']." - ".$key['level'] ?></option>
            <?php else: ?>
              <option value="<?= $key['id_admin'] ?>"><?= $key['nama_admin']." - ".$key['level'] ?></option>
            <?php endif ?>
          <?php endforeach ?>

        </select>
        <span class="form-text text-danger"><?php echo form_error('nama'); ?></span>
      </div>

      <div class="form-group">
        <label>Harga Member<span class="text-danger">*</span></label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Rp</span>
          </div>
          <input type="number" name="harga" required="" class="form-control" placeholder="Masukan Nominal Harga Sewa" value="<?= @$row['dataPrice']->price ? $row['dataPrice']->price : ''; ?>">
          <span class="form-text text-danger"><?php echo form_error('harga'); ?></span>
        </div>
      </div>      

    </div>
    <div class="card-footer text-right">
      <input type="submit" name="action" class="btn btn-primary mr-2" value="<?= @$row['dataPrice']->id_price ? "Update" : "Save" ?> Record">
      <span class="ml-2">or 
        <a href="javascript:;" onclick="window.history.back(-1)" class="font-weight-bold ml-2">Cancel</a>
      </span>
    </div>
  </form>
  <!--end::Form-->
</div>
                    <!--end::Card-->
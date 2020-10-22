<style type="text/css">
  .alert.alert-custom{
    padding: 0.75rem 1.25rem !important;
  }
</style> 

<?php  
echo validation_errors('<div class="alert alert-warning">', '</div>' );

$row = $data['data']['result'];
$url = @$row['paket']->id_paket ? "action/".base64_encode($row['paket']->id_paket) : "action";
?>
<!--begin::Card-->
<div class="card card-custom example example-compact">
  <div class="card-header">
    <h3 class="card-title">Form Action Paket <?= base64_decode($row['q']) ?></h3>
  </div>


  <!--begin::Form-->
  <form method="POST" class="form" action="<?= site_url('Admin/Paket/'.$url.'?q='.$row['q']) ?>">
    <div class="card-body">
      <div class="form-group">
        <label>ID Paket<span class="text-danger">*</span></label>
        <input type="text" name="id" class="form-control form-control-solid" value="<?= @$row['paket']->id_paket ? $row['paket']->id_paket : $row['id_paket']; ?>" readonly="">
        <input type="text" name="type"  value="<?= $row['q'] ?>" hidden="">
      </div>

      <div class="form-group">
        <label>Nama Paket<span class="text-danger">*</span> </label>
        <input type="text" name="nama" class="form-control" required="" placeholder="Masukan Nama Paket" value="<?= @$row['paket']->nama_paket ? $row['paket']->nama_paket : ''; ?>" />
        <span class="form-text text-danger"><?php echo form_error('nama'); ?></span>
      </div>

      <div class="form-group">
        <label>Harga Paket<span class="text-danger">*</span></label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Rp</span>
          </div>
          <input type="number" name="harga" required="" class="form-control" placeholder="Masukan Nominal Harga Paket" value="<?= @$row['paket']->harga_paket ? $row['paket']->harga_paket : ''; ?>">
          <span class="form-text text-danger"><?php echo form_error('harga'); ?></span>
        </div>
      </div>      
      <div class="form-group">
        <label>Deskripsi Paket<span class="text-danger">*</span> </label>
        <textarea class="form-control" name="desk" style="resize: none;" rows="4" required="" placeholder="Enter Description Court"><?= @$row['paket']->deskripsi ? $row['paket']->deskripsi : ''; ?></textarea>
        <span class="form-text text-danger"><?php echo form_error('desk'); ?></span>
      </div>
      <?php if (!$row['paket']): ?>
        <?php if (base64_decode($row['q']) != "Mobil"): ?>
          
        <p class="text-muted"><h5>Detail Paket yang di Dapat : </h5></p>

        <div id="form-config">
          <div class="form-group row ">
            <div class="col-md-6 col-xs-12 ">
              <label>Nama Alat</label>
              <input type="text" name="alat[0][alat]" class="form-control" placeholder="Masukan Nama Alat" required="">
            </div>
            <div class="col-md-6 col-xs-12">
              <label>Qty Alat</label>
              <input type="number" name="alat[0][qty]" class="form-control" placeholder="Masukan Qty Alat" required="">
            </div>
          </div>
        </div>

        <div class="form-group text-right">
          <label>
            <a href="javascript:;" id="add" class="btn btn-primary btn-text-default"><i class="fas fa-plus "></i> Tambah Detail</a>
          </label>
          <label>
            <a href="javascript:;" id="remove" class="btn btn-danger btn-text-default" hidden=""><i class="fas fa-minus "></i> Hapus Detail</a>
          </label>
        </div>

        <script type="text/javascript">
          index = 1;
          

          $('#add').click(() => {
            html = '<div class="form-group row ">\
                      <div class="col-md-6 col-xs-12 ">\
                        <label>Nama Alat</label>\
                        <input type="text" name="alat['+index+'][alat]" class="form-control" placeholder="Masukan Nama Alat" required="">\
                      </div>\
                      <div class="col-md-6 col-xs-12">\
                       <label>Qty Alat</label>\
                        <input type="number" name="alat['+index+'][qty]" class="form-control" placeholder="Masukan Qty Alat" required="">\
                      </div>\
                    </div>';

            $('#form-config').append(html);
            index = index+1;
            if (index > 1) {
              document.getElementById('remove').removeAttribute('hidden',0);
            }
          });

          $('#remove').click(() => {
            $('#form-config .form-group.row:last').remove();
            index = index-1;
            if (index == 1 || index <= 1) {
              document.getElementById('remove').setAttribute('hidden',0);
            }
          });
        </script>
        <?php endif ?>
      <?php endif ?>
    </div>
    

    <div class="card-footer text-right">
      <input type="submit" name="action" class="btn btn-primary mr-2" value="<?= @$row['paket']->id_paket ? "Update" : "Save" ?> Record">
      <span class="ml-2">or 
        <a href="javascript:;" onclick="window.history.back(-1)" class="font-weight-bold ml-2">Cancel</a>
      </span>
    </div>
  </form>
  <!--end::Form-->
</div>
                    <!--end::Card-->
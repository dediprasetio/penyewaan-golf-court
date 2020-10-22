<style type="text/css">
  .alert.alert-custom{
    padding: 0.75rem 1.25rem !important;
  }
</style> 

<!--begin::Card-->
<div class="card card-custom example example-compact">
  <div class="card-header">
    <h3 class="card-title">Form Action Golf Court</h3>
  </div>

  <?php  
  echo validation_errors('<div class="alert alert-warning">', '</div>' );
  $row = $data['data']['result'];
  $url = @$row['court']->id_lapangan ? "action/".base64_encode($row['court']->id_lapangan) : "action";
  ?>

  <!--begin::Form-->
  <form method="POST" class="form" action="<?= site_url('Admin/Court/'.$url) ?>">
    <div class="card-body">
      <div class="form-group">
        <label>ID Lapangan<span class="text-danger">*</span></label>
        <input type="text" name="id" class="form-control form-control-solid" value="<?= @$row['court']->id_lapangan ? $row['court']->id_lapangan : $row['court']; ?>" readonly="">
      </div>
      <div class="form-group">
        <label>Nama Paket Lapangan<span class="text-danger">*</span> </label>
        <input type="text" name="nama" class="form-control" required="" placeholder="Enter Packet Court Name" value="<?= @$row['court']->nama_lapangan ? $row['court']->nama_lapangan : ''; ?>" />
        <span class="text-muted ml-3">Exp : 9 Hole | 18 Hole </span>
        <span class="form-text text-danger"><?php echo form_error('nama'); ?></span>
      </div>

      <div class="form-group">
        <label>Deskripsi Lapangan<span class="text-danger">*</span> </label>
        <textarea class="form-control" name="desk" style="resize: none;" rows="4" required="" placeholder="Enter Description Court"><?= @$row['court']->deskripsi ? $row['court']->deskripsi : ''; ?></textarea>
        <span class="form-text text-danger"><?php echo form_error('desk'); ?></span>
      </div>

      <h5 class="mt-4">Price List Harga</h5>

      <?php $dt = @$row['dtcourt'] ? $row['dtcourt'] : ''; 
      ?>

      <table class="table">
        <thead>
          <tr>
            <th width="120">Banyak Penyewa</th>
            <th>Harga Sewa Weekday</th>
            <th>Harga Sewa Weekend</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i=0; $i < 4; $i++) { ?>
            <tr>
              <td>
                <input type="text" name="list[<?= $i; ?>][id]" value="<?= @$dt[$i]['id_detail_lapangan'] ? $dt[$i]['id_detail_lapangan'] : '' ?>" required="" readonly="" hidden="">
                <input type="number" name="list[<?= $i; ?>][qty]" class="form-control" required="" readonly="" value="<?= @$dt[$i]['banyak_penyewa'] ? $dt[$i]['banyak_penyewa'] : $i+1; ?>">
              </td>
              <td>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                      <input type="number" name="list[<?= $i; ?>][priceweekday]" required="" class="form-control" value="<?= @$dt[$i]['harga_sewa_weekday'] ? $dt[$i]['harga_sewa_weekday'] : '' ?>"  placeholder="Masukan Harga Weekday">
                    <span class="form-text text-danger"></span>
                  </div>
                </div>

              </td>
              <td>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                      <input type="number" name="list[<?= $i; ?>][priceweekend]" required="" class="form-control" value="<?= @$dt[$i]['harga_sewa_weekend'] ? $dt[$i]['harga_sewa_weekend'] : '' ?>" placeholder="Masukan Harga Weekday">
                    <span class="form-text text-danger"></span>
                  </div>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer text-right">
      <input type="submit" name="action" class="btn btn-primary mr-2" value="<?= @$row['court']->id_lapangan ? "Update" : "Save" ?> Record">
      <span class="ml-2">or 
        <a href="javascript:;" onclick="window.history.back(-1)" class="font-weight-bold ml-2">Cancel</a>
      </span>
    </div>
  </form>
  <!--end::Form-->
</div>
                    <!--end::Card-->
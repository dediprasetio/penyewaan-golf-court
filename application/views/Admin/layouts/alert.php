  <?php if (@$this->session->flashdata('warning')): ?>
    <div class="alert alert-custom alert-warning fade show mb-5" role="alert">
      <div class="alert-icon">
        <i class="flaticon-warning"></i>
      </div>
      <div class="alert-text"><?= $this->session->flashdata('warning') ?></div>
      <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">
            <i class="ki ki-close"></i>
          </span>
        </button>
      </div>
    </div>
    <?php elseif (@$this->session->flashdata('danger')):?>
     <div class="alert alert-custom alert-danger fade show mb-5" role="alert">
      <div class="alert-icon">
        <i class="flaticon-circle"></i>
      </div>
      <div class="alert-text"><?= $this->session->flashdata('danger') ?></div>
      <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">
            <i class="ki ki-close"></i>
          </span>
        </button>
      </div>
    </div>
    <?php elseif (@$this->session->flashdata('success')) :?>
      <div class="alert alert-custom alert-success fade show mb-5" role="alert">
        <div class="alert-icon">
          <i class="flaticon2-check-mark"></i>
        </div>
        <div class="alert-text"><?= $this->session->flashdata('success') ?></div>
        <div class="alert-close">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
              <i class="ki ki-close"></i>
            </span>
          </button>
        </div>
      </div>
      <?php else: ?>
        <div></div>
        <?php endif ?>
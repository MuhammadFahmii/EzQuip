      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <?php if ($this->session->flashdata('success')) : ?>
                <div class="flash-data" data-type="success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
              <?php elseif ($this->session->flashdata('failed')) : ?>
                <div class="flash-data" data-type="failed" data-flashdata="<?= $this->session->flashdata('failed'); ?>"></div>
              <?php endif; ?>

              <?php echo form_open('user/changePassword'); ?>
              <div class="form-group">
                <label for="currentPassword">Current password</label>
                <input type="password" class="form-control" name="currentPassword" id="currentPassword">
                <?= form_error('currentPassword', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" name="newPassword" id="newPassword">
                <?= form_error('newPassword', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="repeatPassword">Repeat Password</label>
                <input type="password" class="form-control" name="repeatPassword" id="repeatPassword">
                <?= form_error('repeatPassword', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </div>
          </div>
      </section>
      </div>
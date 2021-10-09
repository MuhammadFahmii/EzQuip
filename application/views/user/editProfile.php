          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-10">
                  <?php if ($this->session->flashdata('success')) : ?>
                    <div class="flash-data" data-type="success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
                  <?php elseif ($this->session->flashdata('failed')) : ?>
                    <div class="flash-data" data-type="failed" data-flashdata="<?= $this->session->flashdata('failed'); ?>"></div>
                  <?php endif; ?>

                  <?php echo form_open_multipart('user/editProfile'); ?>
                  <input type="hidden" name="id" value="<?= $id ?>">
                  <input type="hidden" name="lastImage" value="<?= $image ?>">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $email; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= $name; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <img src="<?= base_url('assets/img/') . $image ?>" height="100" width="100">
                    <div class="custom-file mt-2">
                      <label class="custom-file-label" for="image">Choose Picture</label>
                      <input type="file" class="custom-file-input" name="image" id="image">
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </div>
              </div>
              <!-- form -->
            </div>
            <!-- /.container-fluid -->
          </section>
          <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
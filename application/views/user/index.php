          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row justify-content-center">
                <div class="col-md-3">
                  <?php if ($this->session->flashdata('success')) : ?>
                    <div class="flash-data" data-type="success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
                  <?php elseif ($this->session->flashdata('failed')) : ?>
                    <div class="flash-data" data-type="failed" data-flashdata="<?= $this->session->flashdata('failed'); ?>"></div>
                  <?php endif; ?>

                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/') . $image ?>" alt="User profile picture">
                      </div>
                      <h3 class="profile-username text-center">
                        <?= $name; ?>
                        <a href="" data-toggle="modal" data-target="#setting"><small><i class="fas fa-wrench"></i></small></a>
                      </h3>
                      <?php if ($role_id == 2) : ?>
                        <p class="text-muted text-center">Member since <?= date('d M Y', $date_created); ?></p>
                      <?php endif; ?>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
          </section>
          <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->

          <!-- Modal -->
          <div class="modal fade" id="setting">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">My Profile</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php echo form_open_multipart('user/updateData'); ?>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $email; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= $name; ?>">
                  </div>
                  <div class="form-group custom-file mb-5">
                    <div class="row">
                      <div class="col">
                        <img src="<?= base_url('assets/img/') . $image ?>" width="100" height="100">
                      </div>
                      <div class="col">
                        <input type="file" class="custom-file-input" id="image">
                        <label class="custom-file-label" for="image"><?= $image; ?></label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
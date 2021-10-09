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

              <h3>Role : <?= $role['role']; ?></h3>
              <div class="card">
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead class="thead-dark">
                      <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      foreach ($allMenu as $am) : ?>
                        <tr>
                          <td><?= $i; ?></td>
                          <td><?= $am['menu']; ?></td>
                          <td>
                            <div class="form-group form-check">
                              <input type="checkbox" class="form-check-input checkAcc" <?= check_access($role['id'], $am['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $am['id']; ?>">
                            </div>
                          </td>
                        </tr>
                      <?php $i++;
                      endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      </div>
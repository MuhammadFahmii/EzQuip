      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md">
              <button type="button" class="btn btn-primary mb-3" id="add-submenu" data-toggle="modal" data-target="#submenu-modal">
                Add New Submenu
              </button>
              <table class="table table-hover text-nowrap" id="submenu-table">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Menu</th>
                    <th>Url</th>
                    <th>Icon</th>
                    <th>Active</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
      </section>
      </div>

      <div class="modal fade" id="submenu-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Menu</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= base_url('menu/SubmenuManagement'); ?>" method="POST">
              <div class="modal-body">
                <input type="hidden" name="id-submenu" id="id-submenu">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" id="name" placeholder="name" autocomplete="off">
                </div>
                <div class="form-group">
                  <select class="form-control" id="menu-id" name="menu-id">
                    <option value="">--Select Menu--</option>
                    <?php foreach ($menu as $m) : ?>
                      <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="url" id="url" placeholder="URL">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon">
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="is-active" name="is-active" value="0">
                  <label class="form-check-label" for="is-active">Active?</label>
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
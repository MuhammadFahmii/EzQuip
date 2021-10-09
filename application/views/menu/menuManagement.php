      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md">
              <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#menu-modal" id="add-menu">Add New Menu
              </button>
              <table class="table table-hover text-nowrap" id="menu-table">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
      </div>

      <!-- Menu Modal -->
      <div class="modal fade" id="menu-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form>
              <div class="modal-body">
                <input type="hidden" name="id-menu" id="id-menu">
                <div class="form-group">
                  <input type="text" class="form-control" name="nama-menu" id="nama-menu" placeholder="Menu name" autocomplete="off">
                </div>
              </div>

              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submit"></button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
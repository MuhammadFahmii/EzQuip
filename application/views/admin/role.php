      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md">
              <button type="button" class="btn btn-primary mb-3" id="add-role" data-toggle="modal" data-target="#roleModal">
                Add New Role
              </button>
              <table class="table table-hover text-nowrap" id="table-role">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>Name</th>
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

      <div class="modal fade" id="roleModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form name="roleForm" id="roleForm">
              <div class="modal-body">
                <input type="hidden" name="id-role" id="id-role">
                <div class="form-group">
                  <input type="text" class="form-control" name="nama-role" id="namaRole" placeholder="Role Menu" autocomplete="off">
                </div>
              </div>

              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submit"></button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <!-- Flash Message dengan Sweet Alert-->
              <?php if ($this->session->flashdata('success')) : ?>
                <div class="flash-data" data-type="success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
              <?php elseif ($this->session->flashdata('failed')) : ?>
                <div class="flash-data" data-type="failed" data-flashdata="<?= $this->session->flashdata('failed'); ?>"></div>
              <?php endif; ?>
              <?php if ($this->session->flashdata("errorImage")) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <h5><i class="icon fas fa-ban"></i><?= $this->session->flashdata('errorImage'); ?></h5>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>
              <!-- Main Content -->
              <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#add-menu">
                Add Barang Keluar
              </button>
              <table class="table table-striped display nowrap" id="brgKeluar">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
      </section>
      </div>

      <!-- Modal Input Barang Keluar -->
      <div class="modal fade" id="add-menu">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Barang Keluar</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= base_url('transaksi/barangKeluar'); ?>" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <select class="form-control" name="idBarang" id="idBarang" required>
                    <?php foreach ($barang as $brg) : ?>
                      <option value="<?= $brg['idBarang']; ?>"><?= $brg['namaBarang']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" required>
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
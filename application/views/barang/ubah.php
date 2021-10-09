  <!-- Main content -->
  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="card mt-2">
            <div class="card-header">
              <?php if ($this->session->flashdata('error')) : ?>
                <div class="row mt-3">
                  <div class="col">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <?= $this->session->flashdata('error'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              <h4>Form Ubah Data</h4>
            </div>
            <div class="card-body">
              <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="gambarLama" value="<?= $barang["gambar"]; ?>">
                <input type="hidden" name="idBarang" value="<?= $barang["idBarang"]; ?>">
                <div class="form-group">
                  <label for="namaBarang">Nama Barang</label>
                  <input type="text" name="namaBarang" id="namaBarang" class="form-control" value="<?= $barang['namaBarang']; ?>">
                  </>
                  <div class="form-group">
                    <label for="jenisBarang">Jenis Barang</label>
                    <select class="form-control" id="jenisBarang" name="jenisBarang">
                      <?php foreach ($jenisBarang as $jb) : ?>
                        <?php if ($jb == $barang["jenisBarang"]) : ?>
                          <option value="<?= $jb ?>" selected><?= $jb; ?></option>
                        <?php else : ?>
                          <option value="<?= $jb ?>"><?= $jb; ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="hargaJual">Harga</label>
                    <input type="number" name="hargaJual" class="form-control" id="hargaJual" rows="3" value="<?= $barang["hargaJual"]; ?>"></input>
                  </div>
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" id="jumlah" rows="3" disabled value="<?= $barang["jumlah"]; ?>"></input>
                  </div>
                  <div class="form-group">
                    <label for="gambar">Pilih Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control-file">
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Ubah</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </div>
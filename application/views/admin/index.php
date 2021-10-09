      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-7=6">
              <!-- BAR CHART -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Grafik Pemasukan Barang <span class="text-white bg-dark rounded p-1 year-title">Pertahun</span></h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-7">
                      <h4>Pilih Tahun</h4>
                      <select class="form-control" id="selectYear">
                        <option value="0">--Pilih Tahun--</option>
                        <?php foreach ($year as $yr) : ?>
                          <option value="<?= html_escape($yr['year']) ?>"><?= html_escape($yr['year']) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
      </section>
      </div>
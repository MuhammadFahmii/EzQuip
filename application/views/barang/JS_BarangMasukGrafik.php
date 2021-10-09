<script>
  const namaBulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'Desember'];
  let jmlMasuk = [];

  /**
   * Konfigurasi Bar Chart
   */
  const barChartCanvas = document.getElementById("barChart");
  barChartCanvas.getContext("2d");
  const barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false,
  };
  const barChart = new Chart(barChartCanvas, {
    type: "bar",
    data: 0,
    options: barChartOptions,
  });

  /**
   * Untuk menghandle ketika memilih tahun
   */
  document.addEventListener('click', function(e) {
    const yearTitle = document.querySelector('.year-title');
    namaBulan.forEach((nb, i) => {
      jmlMasuk[i] = 0;
    })
    if (e.target.tagName == "SELECT" && e.target.value != 0) {
      yearTitle.innerHTML = e.target.value;
      fetch(`<?= base_url('admin/dataGrafik/') ?>${e.target.value}`)
        .then(res => res.json())
        .then(result => {
          for (let i = 1; i <= namaBulan.length; i++) {
            result.forEach(data => {
              // replace jmlMasuk[i] with data
              if (data.month == i) jmlMasuk[i - 1] = data.masuk;
            })
          }
          var areaChartData = {
            labels: namaBulan,
            datasets: [{
              label: 'Barang Masuk',
              backgroundColor: 'rgba(60,141,188,0.9)',
              borderColor: 'rgba(60,141,188,0.8)',
              pointRadius: false,
              pointColor: '#3b8bba',
              pointStrokeColor: 'rgba(60,141,188,1)',
              pointHighlightFill: '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data: jmlMasuk
            }]
          }
          const barChartData = jQuery.extend(true, {}, areaChartData);
          barChartData.datasets[0] = areaChartData.datasets[0];

          barChart.config.data = barChartData;
          barChart.update();
        })
    } else if (e.target.tagName == "SELECT" && e.target.value == 0) {
      yearTitle.innerHTML = 'Pertahun';
      barChart.config.data = 0;
    }
  })
</script>
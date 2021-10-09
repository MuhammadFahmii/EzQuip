<script>
  $(`#mytable`).dataTable({
    responsive: true,
    autoWidth: false,
    processing: true,
    serverSide: true,
    // ambil data dari (method) dengan ajax
    ajax: {
      url: "barang/get_all_json",
      header: "application/json",
      type: "POST",
    },
    columns: [{
        data: "namaBarang"
      },
      {
        data: "jenisBarang"
      },
      {
        data: "hargaJual"
      },
      {
        data: "jumlah"
      },
      {
        data: "gambar",
        render: function(data, type, row) {
          return '<img src=<?= base_url('upload/produk/'); ?>' + data + ' style="height:100px;width:100px"/>';
        }
      },
      {
        data: "action"
      },
    ],
  });

  // Handle tombol hapus pada datatable
  document.addEventListener('click', e => {
    if (e.target.classList.contains('tmb-hapus')) clickTmb(e, 'Apakah anda yakin?', 'Barang akan dihapus');
  })
</script>
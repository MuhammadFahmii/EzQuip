<script>
  $("#brgKeluar").DataTable({
    responsive: true,
    autoWidth: false,
    processing: true,
    serverSide: true,
    ajax: {
      url: "barangKeluar/get_all_json",
      header: "application/json",
      type: "POST",
    },
    columns: [{
        data: "tanggal"
      },
      {
        data: "namaBarang"
      },
      {
        data: "jumlah_keluar"
      },
      {
        data: "action"
      },
    ],
  })
  // Handle tombol hapus
  document.addEventListener('click', e => {
    if (e.target.classList.contains('tmb-hapus')) clickTmb(e, 'Apakah anda yakin?', 'Barang akan dihapus');
  })
</script>
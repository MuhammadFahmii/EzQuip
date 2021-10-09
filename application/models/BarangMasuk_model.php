<?php
defined('BASEPATH') or exit('No direct script access allowed');
class BarangMasuk_model extends CI_Model
{
  /**
   * Function yang berhubungan dengan tabel barang
   */
  public function updateJumlahBarang($updateJumlah, $idBarang)
  {
    return $this->db->update('barang', ['jumlah' => $updateJumlah], ['idBarang' => $idBarang]);
  }

  public function getDataBarang()
  {
    return $this->db->select('idBarang, namaBarang')->get('barang')->result_array();
  }


  /**
   * Function yang berhubungan dengan tabel barang_masuk
   */
  public function getAllBarangMasuk()
  {
    $this->datatables->select('tanggal, jumlah_masuk, namaBarang, id')->from('barang_masuk')->join('barang', 'barang_masuk.id_barang=barang.idBarang')->add_column('action', '<a href="barangMasuk/ubah/$1" class="badge badge-warning">Ubah</a> <a href="barangMasuk/hapus/$1" class="badge badge-danger tmb-hapus">Hapus</a>',  'id');
    return $this->datatables->generate();
  }
}

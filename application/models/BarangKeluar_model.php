<?php
defined('BASEPATH') or exit('No direct script access allowed');
class BarangKeluar_model extends CI_Model
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
   * Function yang berhubungan dengan tabel barang_keluar
   */
  public function getAllBarangKeluar()
  {
    $this->datatables->select('tanggal, jumlah_keluar, namaBarang, id')->from('barang_keluar')->join('barang', 'barang_keluar.id_barang=barang.idBarang')->add_column('action', '<a href="barangKeluar/ubah/$1" class="badge badge-warning">Ubah</a> <a href="barangKeluar/hapus/$1" class="badge badge-danger tmb-hapus">Hapus</a>',  'id');
    return $this->datatables->generate();
  }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangKeluar extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('BarangKeluar_model', 'brgKeluar');
    isLogged();
  }

  public function index()
  {
    $data = $this->user->getUserData();
    $data['title'] = 'Barang Keluar';
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $data['barang'] = $this->brgKeluar->getDataBarang();
    $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
    if ($this->form_validation->run() == false) {
      $this->template->load('barang/barangKeluar/barangKeluar', $data, 'barang/barangKeluar/JS_barangKeluar');
    } else {
      $idBarang = $this->input->post('idBarang');
      $updateJumlah = $this->barang->getBarangById($idBarang)['jumlah'] - $this->input->post('jumlah');
      $this->brgKeluar->updateJumlahBarang($updateJumlah, $idBarang);
      $this->db->insert('barang_keluar', [
        'id_barang' => $this->input->post('idBarang'),
        'jumlah_keluar' => $this->input->post('jumlah')
      ]);
      $this->session->set_flashdata('success', 'Barang berhasil di input');
      redirect('transaksi/barangKeluar');
    }
  }

  public function hapus($id)
  {
    $dataBarang = $this->db->select('id_barang as idBarang, jumlah_keluar')->get_where('barang_keluar', ['id' => $id])->row_array();
    $updateJumlah = $this->barang->getBarangById($dataBarang['idBarang'])['jumlah'] + $dataBarang['jumlah_keluar'];
    $this->db->update('barang', ['jumlah' => $updateJumlah], ['idBarang' => $dataBarang['idBarang']]);
    $this->db->delete('barang_keluar', ['id' => $id]);
    $this->session->set_flashdata('success', 'Barang deleted succesfully');
    redirect('transaksi/barangKeluar');
  }

  public function get_all_json()
  {
    echo $this->brgKeluar->getAllBarangKeluar();
  }

  public function ubah()
  {
  }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangMasuk extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Barangmasuk_model', 'brgMsk');
    isLogged();
  }

  public function index()
  {
    $data = $this->user->getUserData();
    $data['title'] = 'Barang Masuk';
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $data['barang'] = $this->brgMsk->getDataBarang();
    $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
    if ($this->form_validation->run() == false) {
      $this->template->load('barang/barangMasuk/barangMasuk', $data, 'barang/barangMasuk/JS_BarangMasuk');
    } else {
      $idBarang = $this->input->post('idBarang');
      $updateJumlah = $this->barang->getBarangById($idBarang)['jumlah'] + $this->input->post('jumlah');
      $this->brgMsk->updateJumlahBarang($updateJumlah, $idBarang);
      $this->db->insert('barang_masuk', [
        'id_barang' => $this->input->post('idBarang'),
        'jumlah_masuk' => $this->input->post('jumlah')
      ]);
      $this->session->set_flashdata('success', 'Barang berhasil di input');
      redirect('transaksi/barangMasuk');
    }
  }

  public function hapus($id)
  {
    $dataBarang = $this->db->select('id_barang as idBarang, jumlah_masuk')->get_where('barang_masuk', ['id' => $id])->row_array();
    $updateJumlah = $this->barang->getBarangById($dataBarang['idBarang'])['jumlah'] - $dataBarang['jumlah_masuk'];
    $this->db->update('barang', ['jumlah' => $updateJumlah], ['idBarang' => $dataBarang['idBarang']]);
    $this->db->delete('barang_masuk', ['id' => $id]);
    $this->session->set_flashdata('success', 'Barang deleted succesfully');
    redirect('transaksi/barangMasuk');
  }

  public function get_all_json()
  {
    echo $this->brgMsk->getAllBarangMasuk();
  }

  public function ubah()
  {
  }
}

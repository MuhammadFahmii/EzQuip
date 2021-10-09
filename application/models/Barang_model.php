<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Barang_model extends CI_model
{
  /**
   * Function for generating barang datatable
   */
  public function generateDatatable()
  {
    // Ambil data sekaligus generate datatables
    $this->datatables->select('*, idBarang');
    $this->datatables->from('barang');
    $this->datatables->add_column('action', '<a href="barang/ubah/$1" class="badge badge-warning">Ubah</a> <a href="barang/hapus/$1" class="badge badge-danger tmb-hapus">Hapus</a>',  'idBarang');
    return $this->datatables->generate();
  }

  /**
   * Function for get all data
   */
  public function getAllData()
  {
    return $this->db->get('barang')->result_array();
  }

  public function tambahDataBarang()
  {
    $data = array(
      'namaBarang' => $this->input->post('namaBarang'),
      'jenisBarang' => $this->input->post('jenisBarang'),
      'hargaJual' => $this->input->post('hargaJual'),
      'jumlah' => $this->input->post('jumlah'),
      'gambar' => $this->uploadImage()
    );
    if ($data["gambar"] == false) return false;
    $this->db->insert("barang", $data);
  }

  public function getBarangById($id)
  {
    return $this->db->get_where('barang', ['idBarang' => $id])->row_array();
    // // Connect REST API using curl
    // $curl = curl_init('http://localhost/codeigniter-restserver/api?id=' . $id);
    // curl_setopt_array($curl, [
    //   CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
    //   CURLOPT_USERPWD => 'admin:1234',
    //   CURLOPT_HTTPHEADER => [
    //     'X-API-KEY: 1234',
    //   ],
    //   CURLOPT_RETURNTRANSFER => true,
    // ]);
    // $result = curl_exec($curl);
    // curl_close($curl);
    // return json_decode($result, true)[0];
  }

  public function uploadImage()
  {
    $config['upload_path']          = FCPATH . 'upload/produk/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = uniqid() . '.jpg';
    $config["overwrite"]            = true;
    $config['max_size']             = 1000;
    $config['max_width']            = 1024;
    $config['max_height']           = 768;

    $this->load->library('upload', $config);
    if ($this->upload->do_upload('gambar')) {
      return $this->upload->data("file_name");
    } else {
      $this->session->set_flashdata('errorImage', $this->upload->display_errors());
      return false;
    }
  }

  public function hapusDataBarang($id)
  {
    $barang = $this->getBarangById($id);
    // Jika gambar bkn default jpg, maka akan dihapus
    if ($barang["gambar"] != "default.jpg") {
      $filename = $barang["gambar"];
      unlink(FCPATH . "upload/produk/" . $filename);
    }
    $this->db->where('idBarang', $id);
    $this->db->delete('barang');
  }

  public function ubahDataBarang($idBarang)
  {
    $data = array(
      'namaBarang' => $this->input->post('namaBarang'),
      'jenisBarang' => $this->input->post('jenisBarang'),
      'hargaJual' => $this->input->post('hargaJual'),
      'jumlah' => $this->input->post('jumlah')
    );

    // jika file terjadi kesalahan
    if (!empty($_FILES["gambar"]["name"]) && !$_FILES["gambar"]["error"] != 0) {
      $data["gambar"] = $this->uploadImage();
    } else {
      $data["gambar"] = $this->input->post("gambarLama");
    }

    $this->db->update('barang', $data, array('idBarang' => $idBarang));
  }

  public function grafikBarang($year)
  {
    return $this->db->select('SUM(jumlah_masuk) as masuk, MONTH(tanggal) as month')->group_by('month')->from('barang_masuk')->where('YEAR(tanggal)', $year)->get()->result_array();
  }
}

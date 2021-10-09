<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
  private $jenisBarang = ["makanan", "aksesoris"];
  public function __construct()
  {
    parent::__construct();
    isLogged();
  }

  public function index()
  {
    $data = $this->user->getUserData();
    $data['title'] = "Barang";
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $this->template->load('barang/index', $data, 'barang/JS_Barang');
  }

  public function get_all_json()
  {
    echo $this->barang->generateDatatable();
  }

  public function tambah()
  {
    $data = $this->user->getUserData();
    $data["title"] = "Form Tambah Data Barang";
    $data["jenisBarang"] = $this->jenisBarang;
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $this->form_validation->set_rules("namaBarang", "Nama Barang", "required");
    $this->form_validation->set_rules("hargaJual", "harga", "required");
    if ($this->form_validation->run() == FALSE) {
      $this->template->load('barang/tambah', $data);
    } else {
      // Jika menggunakan rest api
      // $curl = curl_init('http://localhost/codeigniter-restserver/api/item');
      // $cfile = new CURLFile($_FILES['gambar']['tmp_name'], 'image/jpeg', 'image');
      // curl_setopt_array($curl, [
      //   CURLOPT_HTTPAUTH => CURLAUTH_DIGEST,
      //   CURLOPT_USERPWD => 'admin:1234',
      //   CURLOPT_HTTPHEADER => [
      //     'X-API-KEY: 1234',
      //   ],
      //   CURLOPT_POSTFIELDS => [
      //     'namaBarang' => $this->input->post('namaBarang'),
      //     'jenisBarang' => $this->input->post('jenisBarang'),
      //     'hargaJual' => $this->input->post('hargaJual'),
      //     'jumlah' => $this->input->post('jumlah'),
      //     'image' => $cfile
      //   ],
      //   CURLOPT_RETURNTRANSFER => true,
      // ]);
      // $result = json_decode(curl_exec($curl), true);
      // curl_close($curl);
      if ($this->barang->tambahDataBarang()) {
        $this->session->set_flashdata('failed', 'Barang gagal ditambah');
      } else {
        $this->session->set_flashdata('success', 'Barang berhasil ditambah');
        redirect('barang');
      }
    }
  }

  public function ubah($id)
  {
    $data = $this->user->getUserData();
    $data["title"] = "Form Ubah Data Barang";
    $data["barang"] = $this->barang->getBarangById($id);

    $data["jenisBarang"] = $this->jenisBarang;
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $this->form_validation->set_rules("namaBarang", "Nama Barang", "required");
    $this->form_validation->set_rules("hargaJual", "harga", "required");
    if ($this->form_validation->run() == FALSE) {
      if (empty($data["barang"])) show_404();
      $this->template->load('barang/ubah', $data);
    } else {
      $this->barang->ubahDataBarang($id);
      $this->session->set_flashdata('success', 'Barang berhasil diubah');
      // Jika gambar error, tampil notif gagal
      if ($_FILES["gambar"]["error"] != 0) {
        $this->session->set_flashdata("errorImage", "Gambar Tidak Dirubah");
      }
      redirect('barang');
    }
  }

  public function hapus($id)
  {
    $this->barang->hapusDataBarang($id);
    $this->session->set_flashdata('success', 'Gambar Berhasil dihapus');
    redirect('barang');
  }

  public function cetakLaporan()
  {
    $this->load->library('fpdf');
    $barang = $this->barang->getAllData();
    $tahun = $this->db->select('YEAR(tanggal) as tahun')->from('barang_masuk')->group_by('tahun')->get()->row_array();
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    // Header
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 10, 'Laporan Stok Barang Tahun ' . $tahun['tahun'], 1, 1, 'C');
    // Data
    $pdf->SetFont('Arial', '', '13');
    $pdf->Cell(30, 5, 'NO', 1, 0, 'C');
    $pdf->Cell(70, 5, 'Nama Barang', 1, 0, 'C');
    $pdf->Cell(60, 5, 'Jenis Barang', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Jumlah', 1, 1, 'C');
    $no = 1;
    foreach ($barang as $brg) {
      $pdf->Cell(30, 5, $no, 1, 0, 'C');
      $pdf->Cell(70, 5, $brg['namaBarang'], 1, 0, 'C');
      $pdf->Cell(60, 5,  $brg['jenisBarang'], 1, 0, 'C');
      $pdf->Cell(30, 5,  $brg['jumlah'], 1, 1, 'C');
      $no++;
    }
    $pdf->Ln(30);
    $pdf->cell('180', '10', 'Mengetahui', 0, 1, 'R');
    $pdf->Ln(10);
    $pdf->cell('180', '10', 'Kepala Gudang', 0, 0, 'R');
    $pdf->Output('', 'Laporan Stok Barang ' . $tahun['tahun'] . '.pdf');
  }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    isLogged();
  }

  /**
   * Function to show admin page 
   */
  public function index()
  {
    $data = $this->user->getUserData();
    $data['title'] = 'Dashboard';
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $data['year'] = $this->db->select('YEAR(tanggal) as year')->group_by('year')->get('barang_masuk')->result_array();
    $this->template->load('admin/index', $data, 'barang/JS_BarangMasukGrafik');
  }

  /**
   * Function to show data in graph
   */
  public function dataGrafik($year)
  {
    $data = $this->barang->grafikBarang($year);
    echo json_encode($data);
  }

  /**
   * Function to show role page 
   */
  public function role()
  {
    $data = $this->user->getUserData();
    $data['title'] = 'Role';
    $data['role'] = $this->db->get('user_role')->result_array();
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $this->template->load('admin/role', $data, 'admin/JS_Role');
  }

  /**
   * Function to show role access
   */
  public function roleAccess($roleId)
  {
    $data = $this->user->getUserData();
    $data['title'] = 'Role';
    $data['role'] = $this->db->get_where('user_role', ['id' => $roleId])->row_array();
    $data['allMenu'] = $this->db->get_where('user_menu', 'id!=1')->result_array();
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $this->template->load('admin/roleAccess', $data);
  }

  /**
   * Function to change access
   */
  public function changeAccess()
  {
    $roleId = $this->input->post('roleId');
    $menuId = $this->input->post('menuId');
    $data = [
      'role_id' => $roleId,
      'menu_id' => $menuId
    ];
    $result = $this->db->get_where('user_access_menu', $data);
    if ($result->num_rows() < 1) {
      $this->db->insert('user_access_menu', $data);
    } else {
      $this->db->delete('user_access_menu', $data);
    }
  }

  /**
   * Function to get role
   * @param id
   */
  public function getRole($id)
  {
    echo json_encode($this->db->select('role')->from('user_role')->where('id', $id)->get()->row_array());
  }

  /**
   * Function to insert role
   */
  public function tambahRole()
  {
    $role = $this->input->post('role');
    if ($role == '') {
      $msg = [
        'message' => 'Please provide some data',
        'status' => 'failed'
      ];
    } else {
      $msg = $this->db->insert('user_role', ['role' => $this->input->post('role')]);
    }
    echo json_encode($msg);
  }

  /**
   * Function to update role
   */
  public function editRole()
  {
    $id = $this->input->post('id');
    $role = $this->input->post('role');
    if ($role == null) {
      $msg = [
        'message' => 'Role must be filled',
        'status' => 'false'
      ];
    } else {
      $msg = $this->db->update('user_role', ['role' => $role], ['id' => $id]);
    }
    echo json_encode($msg);
  }

  /**
   * Function to delete role 
   * @param idRole
   */
  public function hapusRole($id)
  {
    echo json_encode($this->db->delete('user_role', ['id' => $id]));
    // redirect('admin/role');
  }

  /**
   * Function for generating datatable
   */
  public function generateDatatable()
  {
    $this->datatables->select('id, role');
    $this->datatables->from('user_role');
    $this->datatables->add_column('action', '<a href="editRole/$1" class="badge badge-warning" id="edit-role" data-toggle="modal" data-target="#roleModal">Edit</a> <a href="roleAccess/$1" class="badge badge-success">Access</a> <a href="hapusRole/$1" class="badge badge-danger" id="hapus-role">Hapus</a>',  'id');
    echo $this->datatables->generate();
  }
}

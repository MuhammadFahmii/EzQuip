<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubmenuManagement extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // isLogged();
  }

  /**
   * Function for show submenu management page
   */
  public function index()
  {
    $data = $this->user->getUserData();
    $data['title'] = 'Submenu Management';
    $data['allMenu'] = $this->db->select('id', 'menu')->get('user_menu')->result_array();
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $this->template->load('menu/submenuManagement', $data, 'menu/JS_submenu');
  }

  /**
   * Function for get menu
   * @param idSubmenu
   */
  public function getMenuById($idSubmenu)
  {
    echo json_encode($this->db->where('id_submenu', $idSubmenu)->get('user_submenu')->row_array());
  }

  /**
   * Function for generate datatable from table user submenu
   */
  public function generateDatatable()
  {
    $this->datatables
      ->select('id_submenu, name, url, icon, is_active, menu')
      ->from('user_submenu')
      ->join('user_menu', 'user_submenu.menu_id=user_menu.id')
      ->add_column('action', '<a href="SubmenuManagement/edit/$1" class="badge badge-warning" id="edit-submenu" data-toggle="modal" data-target="#submenu-modal">Edit</a> <a href="SubmenuManagement/delete/$1" class="badge badge-danger" id="delete-submenu">Delete</a>',  'id_submenu');
    echo $this->datatables->generate();
  }

  /**
   * Function for insert submenu
   */
  public function insert()
  {
    $data = [
      'menu_id' => $this->input->post('menu_id'),
      'name' => $this->input->post('name'),
      'url' => $this->input->post('url'),
      'icon' => $this->input->post('icon'),
      'is_active' => $this->input->post('is_active'),
    ];
    echo json_encode($this->db->insert('user_submenu', $data));
  }

  /**
   * Function for update submenu
   */
  public function update()
  {
    $idSubmenu = $this->input->post('id_submenu');
    $data = [
      'menu_id' => $this->input->post('menu_id'),
      'name' => $this->input->post('name'),
      'url' => $this->input->post('url'),
      'icon' => $this->input->post('icon'),
      'is_active' => $this->input->post('is_active'),
    ];
    // validation
    if ($data['name'] == null || $data['url'] == null || $data['icon'] == null) {
      echo json_encode(['message' => 'Please fill some data']);
    } else {
      echo json_encode($this->db->update('user_submenu', $data, ['id_submenu' => $idSubmenu]));
    }
  }

  /**
   * Function for delete submenu
   */
  public function delete($id)
  {
    echo json_encode($this->db->delete('user_submenu', ['id_submenu' => $id]));
  }
}

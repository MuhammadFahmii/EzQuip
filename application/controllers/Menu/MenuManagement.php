<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuManagement extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    isLogged();
  }

  /**
   * Function to show menu page
   */
  public function index()
  {
    $data = $this->user->getUserData();
    $data['title'] = 'Menu Management';
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $this->template->load('menu/menuManagement', $data, 'menu/JS_menu');
  }

  /**
   * Function to insert menu 
   */
  public function insertMenu()
  {
    $menu = $this->input->post('menu');
    $msg = [];
    if ($menu == '') {
      $msg = [
        'message' => 'Please provide some data',
        'status' => 'failed'
      ];
    } else {
      $msg = $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
    }
    echo json_encode($msg);
  }

  /**
   * Function to edit menu
   */
  public function editMenu()
  {
    $menu = $this->input->post('menu');
    $id = $this->input->post('id');
    $msg = [];
    if ($menu == '') {
      $msg = [
        'message' => 'Menu name must be filled',
        'status' => 'failed'
      ];
    } else {
      $msg = $this->db->update('user_menu', ['menu' => $menu], ['id' => $id]);
    }
    echo json_encode($msg);
  }

  /**
   * Function to delete menu 
   * @param id
   */
  public function deleteMenu($id)
  {
    echo json_encode($this->menu->deleteMenu($id));
  }

  /**
   * Function to get menu by id menu
   * @param id
   */
  public function getMenuById($id)
  {
    echo json_encode($this->db->select('menu')->from('user_menu')->where('id', $id)->get()->row());
  }

  /**
   * Function to generate datatable from database
   */
  public function generateDatatableMenu()
  {
    $this->datatables->select('menu, id');
    $this->datatables->from('user_menu');
    $this->datatables->add_column('action', '<a href="menu/editMenu/$1" class="badge badge-warning" id="edit-menu" data-toggle="modal" data-target="#menu-modal">Edit</a> <a href="menu/deleteMenu/$1" class="badge badge-danger" id="delete-menu">Delete</a>',  'id');
    echo $this->datatables->generate();
  }
}

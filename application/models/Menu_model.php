<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
  /**
   * Function for get all submenu
   */
  public function getAllSubmenu()
  {
    return $this->db->select('menu, user_submenu.*')->from('user_menu')->where('user_submenu.is_active', 1)->join('user_submenu', 'user_submenu.menu_id=user_menu.id')->order_by('user_submenu.menu_id', 'ASC')->order_by('user_submenu.name', 'ASC')->get()->result_array();
  }

  /**
   * Function for delete menu
   */
  public function deleteMenu($id)
  {
    return $this->db->delete('user_menu', ['id' => $id]);
  }

  /**
   * Function for get menu by user_access_menu
   * @param roleId
   */
  public function getMenuByUser($roleId)
  {
    return $this->db->select('user_menu.id, menu')->from('user_menu')->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id')->where("user_access_menu.role_id= $roleId")->order_by('user_access_menu.menu_id', 'ASC')->get()->result_array();
  }
}

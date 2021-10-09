<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function isLogged()
{
  $ci = get_instance();
  if (!$ci->session->userdata('email')) return redirect(base_url());
  $role_id = $ci->session->userdata('role_id');
  $url = $ci->uri->segment(1);
  $userSubmenu = $ci->db->like('url', $url)->get('user_submenu')->row_array();
  $menuId = $userSubmenu['menu_id'];
  $userAccess = $ci->db->get_where('user_access_menu', [
    'role_id' => $role_id,
    'menu_id' => $menuId
  ]);
  if ($userAccess->num_rows() < 1) redirect('auth/blocked');
}

/**
 * Function to added class checked in checkbox
 */
function check_access($roleId, $menuId)
{
  $ci = get_instance();
  $result = $ci->db->get_where('user_access_menu', [
    'role_id' => $roleId,
    'menu_id' => $menuId
  ]);
  if ($result->num_rows() > 0) return "checked";
}

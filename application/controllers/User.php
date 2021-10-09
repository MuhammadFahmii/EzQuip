<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    isLogged();
  }

  public function index()
  {
    $data = $this->user->getUserData();
    $data['title'] = 'MyProfile';
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $this->template->load('user/index', $data);
  }

  public function editProfile()
  {
    $data = $this->user->getUserData();
    $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
    $data['submenu'] = $this->menu->getAllSubmenu();
    $this->form_validation->set_rules('name', 'Name', 'required');
    if ($this->form_validation->run() === false) {
      $data['title'] = 'Edit Profile';
      $this->template->load('user/editProfile', $data);
    } else {
      $this->user->updateData($data['id'], $data['image']);
      redirect('user');
    }
  }

  public function changePassword()
  {
    $data = $this->user->getUserData();
    $this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
    $this->form_validation->set_rules('newPassword', 'New Password', 'required|trim|matches[repeatPassword]|min_length[3]');
    $this->form_validation->set_rules('repeatPassword', 'Repeat Password', 'required|trim|matches[newPassword]|min_length[3]');
    if ($this->form_validation->run() === false) {
      $data['menu'] = $this->menu->getMenuByUser($data['role_id']);
      $data['submenu'] = $this->menu->getAllSubmenu();
      $data['title'] = 'Change Password';
      $this->template->load('user/changePassword', $data);
    } else {
      $curPassword = $this->input->post('currentPassword');
      $newPassword = $this->input->post('newPassword');
      $repPassword = $this->input->post('repeatPassword');
      if (password_verify($curPassword, $data['password'])) {
        if ($newPassword == $repPassword) {
          $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
          $this->db->update('user', ['password' => $newPassword], ['email' => $data['email']]);
          $this->session->set_flashdata('success', 'Password changed!');
          redirect('user/changePassword');
        }
      } else {
        $this->session->set_flashdata('failed', 'Wrong Password!');
        redirect('user/changePassword');
      }
    }
  }
}

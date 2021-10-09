<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  public function getUserData()
  {
    return $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
  }

  public function insertData($userData)
  {
    $this->db->insert('user', [
      'name' => $userData['name'],
      'email' => $userData->getEmail(),
      'image' => 'default.jpg',
      'role_id' => 2,
      'is_active' => 1,
      'date_created' => time()
    ]);
  }
  public function updateData($id, $img = null)
  {
    $data = [
      'name' => $this->input->post('name'),
      'email' => $this->input->post('email')
    ];
    if (empty($_FILES['image']['name'])) {
      $data['image'] = $this->input->post('lastImage');
      $this->session->set_flashdata('success', 'Changed Successfull');
    } else {
      $data['image'] = $this->uploadImage($img);
    }
    $this->db->update('user', $data, ['id' => $id]);
  }

  private function uploadImage($img)
  {
    $config['upload_path']          = 'assets/img';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = uniqid() . '.jpg';
    $config["overwrite"]            = true;
    $config['max_size']             = 1000;

    $lastImage = $img;
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('image')) {
      if ($lastImage != 'default.jpg') unlink(FCPATH . 'assets/img/' . $lastImage);
      $this->session->set_flashdata('success', 'Changed Successfull');
      return $this->upload->data("file_name");
    } else {
      $this->session->set_flashdata('failed', 'Changed Success, but ' . $this->upload->error_msg[0]);
      $this->load->view('user/editProfile');
      return $lastImage;
    }
  }
}

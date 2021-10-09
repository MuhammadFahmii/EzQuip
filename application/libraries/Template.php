<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
  private $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
  }

  /**
   * Generate template Utama
   */
  public function load($content, $data = null, $js = null)
  {
    $data['header'] = $this->ci->load->view('templates/app/header', $data, TRUE);

    $data['navbar'] = $this->ci->load->view('templates/app/navbar', $data, TRUE);

    $data['sidebar'] = $this->ci->load->view('templates/app/sidebar', $data, TRUE);

    $data['content_header'] = $this->ci->load->view('templates/app/content_header', $data, TRUE);

    $data['content'] = $this->ci->load->view($content, $data, TRUE);

    $data['footer'] = $this->ci->load->view('templates/app/footer', $data, TRUE);

    if ($js) {
      $data['js'] = $this->ci->load->view($js, $data, TRUE);
    } else {
      $data['js'] = $js;
    }

    $this->ci->load->view('templates/index', $data,);
  }
}

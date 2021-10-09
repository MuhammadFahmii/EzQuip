<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Google extends Google_Client
{
  public function __construct()
  {
    parent::__construct();
    $client_id = '987581926997-8jpcr39n8r516blr2ejdupnn4mmvvoq9.apps.googleusercontent.com';
    $client_secret = 'Sw9whkP3890DKwr_88FDLjOe';
    $api_key = 'AIzaSyDQwGKfe7-tG7wiJbx3avqeZ3uHYFAI3-w';
    $redirect_uri = 'http://localhost/website/ci-app/';
    $this->setApplicationName("Pengelolaan Barang");
    $this->setClientId($client_id);
    $this->setClientSecret($client_secret);
    $this->setDeveloperKey($api_key);
    $this->setRedirectUri($redirect_uri);
    $this->addScope([
      "https://www.googleapis.com/auth/userinfo.profile",
      "https://www.googleapis.com/auth/userinfo.email",
    ]);
  }
}

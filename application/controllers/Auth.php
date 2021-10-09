<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('google');
  }

  public function index()

  {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'password', 'trim|required');
    if ($this->form_validation->run() == false) {
      if ($this->session->userdata('role_id') == 1) redirect(base_url('admin'));
      if ($this->session->userdata('role_id') == 2) redirect(base_url('user'));
      $data['judul'] = 'Login';
      /**
       * Apabila pengguna login menggunakan OAuth2 (Google)
       */
      // Create Client
      $client = $this->google;
      // Send client request
      $objOAuthService = new Google_Service_Oauth2($client);
      if ($this->input->get('code')) {
        $client->authenticate($_GET['code']);
        $this->session->set_userdata('access_token', $client->getAccessToken());
      }

      if ($this->session->userdata('access_token')) {
        $client->setAccessToken($this->session->userdata('access_token'));
      }

      /**
       * Get user data from Google and store in $data
       */
      if ($client->getAccessToken()) {
        $userData = $objOAuthService->userinfo->get();
        $userAccess = $this->db->get_where('user', ['email' => $userData->getEmail()]);
        if ($userAccess->num_rows() < 1) $this->user->insertData($userData);
        $this->session->set_userdata([
          'email' => $userData->getEmail(),
          'role_id' => 2
        ]);
        redirect('user');
      } else {
        $authUrl = $this->google->createAuthUrl();
        $data['loginURL'] = $authUrl;
        $this->load->view('templates/auth/header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth/footer');
      }
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $email = $this->input->post('email', true);
    $password = $this->input->post('password', true);
    $user = $this->db->get_where('user', ['email' => $email])->row_array();
    if ($user) {
      // cek aktif
      if ($user['is_active'] == 1) {
        // cek password
        if (password_verify($password, $user['password'])) {
          $data = [
            'email' => $user['email'],
            'role_id' => $user['role_id']
          ];
          $this->session->set_userdata($data);
          // select role
          if ($this->session->userdata('role_id') == 1) {
            redirect('admin');
          } elseif ($this->session->userdata('role_id') == 2) {
            redirect('user');
          }
        } else {
          $this->session->set_flashdata('failed', 'Wrong Password');
          redirect(base_url());
        }
      } else {
        $this->session->set_flashdata('failed', 'Please activate this email');
        redirect(base_url());
      }
    } else {
      $this->session->set_flashdata('failed', 'Email not recognized');
      redirect(base_url());
    }
  }

  public function logout()
  {
    $this->google->revokeToken();
    $this->session->unset_userdata('role_id');
    $this->session->unset_userdata('access_token');
    $this->session->set_flashdata('success', 'You have been logged out');
    redirect('auth');
  }

  public function registration()
  {
    $config = [
      [
        'field' => 'name',
        'label' => 'Name',
        'rules' => 'required|trim'
      ],
      [
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|trim|valid_email|is_unique[user.email]',
        'errors' => [
          'is_unique' => 'This email has already registered'
        ]
      ],
      [
        'field' => 'password1',
        'label' => 'Password1',
        'rules' => 'required|trim|min_length[4]|matches[password2]',
        'errors' => [
          'min_length' => 'Password too short',
          'matches' => 'Password does\'nt match'
        ]
      ],
      [
        'field' => 'password2',
        'label' => 'Password',
        'rules' => 'required|trim|matches[password1]'
      ],
    ];
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == false) {
      if ($this->session->userdata('role_id') == 1) {
        redirect('admin');
      } elseif ($this->session->userdata('role_id') == 2) {
        redirect('user');
      } else {
        $data['judul'] = 'Registration';
        $this->load->view('templates/auth/header', $data);
        $this->load->view('auth/registration');
        $this->load->view('templates/auth/footer');
      }
    } else {
      $data = [
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'image' => 'default.jpg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id' => 2,
        'is_active' => 0,
        'date_created' => time()
      ];
      $token = base64_encode(random_bytes(32));
      $userToken = [
        'email' => $data['email'],
        'token' => $token,
        'date_created' => time(),
      ];
      $this->db->insert('user', $data);
      $this->db->insert('user_token', $userToken);
      $this->_sendEmail($token, 'verify');
      $this->session->set_flashdata('success', 'Congratulation your account has been created, Please Activate');
      redirect(base_url());
    }
  }

  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'rpahit5@gmail.com',
      'smtp_pass' => 'fahmijoki',
      'smtp_port' => 465,
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'newline' => "\r\n"
    ];
    $this->email->initialize($config);
    $this->email->from('rpahit5@gmail.com', 'Heinz');
    $this->email->to($this->input->post('email'));
    if ($type == 'verify') {
      $this->email->subject('Account Verification');
      $this->email->message('Click this link to verify your account: <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
    } elseif ($type == 'forgot') {
      $this->email->subject('Reset Password');
      $this->email->message('Click this link to reset your password: <a href="' . base_url() . 'auth/resetPassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
    }
    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
    }
  }

  public function verify()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');
    $user = $this->db->get_where('user', ['email' => $email])->row_array();
    if ($user) {
      $userToken = $this->db->get_where('user_token', ['token' => $token])->row_array();
      if ($userToken) {
        $waktuAktivasi = time() - $userToken['date_created'];
        // Jika lebih dari sehari akan tidak dapat diaktivasi
        if ($waktuAktivasi < (60 * 60 * 24)) {
          $this->db->update('user', ['is_active' => 1], ['email' => $email]);
          $this->db->delete('user_token', ['email' => $email]);
          $this->session->set_flashdata('success', "$email has been activated, Please Login !");
          redirect('auth');
        } else {
          $this->db->delete('user', ['email' => $email]);
          $this->db->delete('user_token', ['email' => $email]);
          $this->session->set_flashdata('failed', 'Token Expired');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('failed', 'Wrong Token');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('failed', 'Wrong Email');
      redirect('auth');
    }
  }

  public function blocked()
  {
    $data['title'] = 'Access Blocked';
    $this->load->view('templates/auth/header', $data);
    $this->load->view('auth/blocked');
    $this->load->view('templates/auth/footer');
  }

  public function forgotPassword()
  {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Forgot Password';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/forgotPassword');
      $this->load->view('templates/auth_footer');
    } else {
      $email = $this->input->post('email');
      $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
      if ($user) {
        $token = base64_encode(random_bytes(32));
        $userToken = [
          'email' => $email,
          'token' => $token,
          'date_created' => time()
        ];
        $this->db->insert('user_token', $userToken);
        $this->_sendEmail($token, 'forgot');
        $this->session->set_flashdata('success', 'Please check your email to reset password');
        redirect('auth/forgotPassword');
      } else {
        $this->session->set_flashdata('failed', 'Email is not registered or activated');
        redirect('auth/forgotPassword');
      }
    }
  }

  public function resetPassword()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');
    $user = $this->db->get_where('user', ['email' => $email])->row_array();
    if ($user) {
      $userToken = $this->db->get_where('user_token', ['token' => $token])->row_array();
      if ($userToken) {
        $this->session->set_userdata('reset_email', $email);
        $this->changePassword();
      } else {
        $this->session->set_flashdata('failed', 'Reset Password Failed: Wrong Token');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('failed', 'Reset Password Failed: Wrong Email');
      redirect('auth');
    }
  }

  public function changePassword()
  {
    if (!$this->session->userdata('reset_email')) redirect('auth');

    $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');
    if ($this->form_validation->run() == false) {
      $data['title'] = 'Change Password';
      $this->load->view('templates/header', $data);
      $this->load->view('auth/changePassword');
      $this->load->view('templates/auth_footer');
    } else {
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      $email = $this->session->userdata('reset_email');
      $this->db->update('user', ['password' => $password], ['email' => $email]);
      $this->session->unset_userdata('reset_email');
      $this->session->set_flashdata('success', 'Password has been changed!');
      redirect('auth');
    }
  }
}

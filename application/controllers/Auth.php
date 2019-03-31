<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

            public function __construct()
            {
             parent::__construct();
             $this->load->library('form_validation');
            }

           public function index ()
           {

            $this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email',[
              'valid_email' => 'Harap masukan e-mail yang valid ',
              'required' => 'Harap isi kolom ini'

            ]);
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
         
             if ($this->form_validation->run() == FALSE) {
               $data['judul'] = "Halaman Login";
               $this->load->view('template/header', $data);
               $this->load->view('auth/login');
               $this->load->view('template/footer');
              } else {
                // _login method private
                $this->_login();
              }

           }


           private function _login()
           {
              $email = $this->input->post('email');
              $password = $this->input->post('password');

              // SELECT * FROM user where email = $email
              $user = $this->db->get_where('user', ['email' => $email])->row_array();
               // var_dump($user);
              if ($user) {
                 // jika user ada pada database
                if ($user['is_active'] == 1) {
                      //  kalau aktif , cek password
                  if (password_verify($password, $user['password'])) {
                    $data = [
                      'email' =>  $user['email'],
                      'role_id' =>  $user['role_id']
                    ];
                       // simpan data ke session
                       $this->session->set_userdata($data);
                       // pengecekan user 
                      if ($user['role_id'] ==  1) {
                        redirect('admin');
                      } else {
                        redirect('user');
                      }

                 
                    

                  } else {
                    // kalau password user salah
                        $this->session->set_flashdata("Pesan", "<div class = 'alert alert-danger'>Password salah</div>");
                        redirect('auth');
                  }

                } else {
                  // jika email tidak aktif
                      $this->session->set_flashdata("Pesan", "<div class = 'alert alert-danger'>E-mail tidak aktif</div>");
                      redirect('auth');
                }

              } else {
                // jika email tidak terdaftar
                  $this->session->set_flashdata("Pesan", "<div class = 'alert alert-danger'>E-mail tidak terdaftar</div>");
                  redirect('auth');

              }             

           }


           public function register()
           {

            $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]',[
              'is_unique' => "E-mail sudah terdaftar dalam database "
            ]);
            $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]',[
                'matches' => "password tidak sama", 
                'min_length' => "password kurang panjang"
            ]);
            $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');


            if ($this->form_validation->run() == FALSE) {
              $data['judul'] = "Halaman Register";
              $this->load->view('template/header', $data);
              $this->load->view('auth/register');
              $this->load->view('template/footer');
              } else {
                $data = [
                  'name' => htmlspecialchars($this->input->post('nama' , true)),
                  'email' => htmlspecialchars($this->input->post('email', true)),
                  'image' => "default.jpg",
                  'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                  'role_id' => 2,
                  'is_active' => 1,
                  'create_at' => time()                   
                ];

                $this->db->insert('user', $data);

                $this->session->set_flashdata("Pesan", "<div class = 'alert alert-success'>Selamat account anda berhasil di buat, silahkan login </div>");
                redirect('auth');

            }



          }


          public function logout()
          {
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('role_id');
            $this->session->set_flashdata("Pesan", "<div class = 'alert alert-success'>Logout berhasil</div>");
                redirect('auth');

          }

          public function blocked()
          {
          
            
            $this->load->view('auth/blocked');
            $this->load->view('template/auth_footer');

          
          }
  


}

?>
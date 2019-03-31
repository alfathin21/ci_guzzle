<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();

			is_log_in();

		



	}	public function index()
		{
			// tangkap data email dari set session userdata kemudian get where kedalam database sesuai dengan email tersebut
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		     //echo "Selamat datang " . $data['user']['name'];
			   $data['judul'] = "My Profile";
               $this->load->view('template/auth_header', $data);
               $this->load->view('template/sidebar');
               $this->load->view('template/toopbar');
               $this->load->view('user/index');
               $this->load->view('template/auth_footer');
          
		}






}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		// helper
		// 1. dia loghin atau belum
		// 2. dia user role nya apa
		
		is_log_in();



	}
		public function index()
		{

			   $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			   $data['judul'] = "Dashbord";
               $this->load->view('template/auth_header', $data);
               $this->load->view('template/sidebar');
               $this->load->view('template/toopbar');
               $this->load->view('admin/index');
               $this->load->view('template/auth_footer');
          
		}


		public function role()
		{
			// tangkap data email dari set session userdata kemudian get where kedalam database sesuai dengan email tersebut
		
			 //echo "Selamat datang " . $data['user']['name'];
			 
			 	$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			  	$data['judul'] = "Role";
			   	$data['role'] = $this->db->get('user_role')->result_array();



			   $this->form_validation->set_rules('role', 'Role', 'required');

			   if ($this->form_validation->run() == false) {
				 
				
				$this->load->view('template/auth_header', $data);
				$this->load->view('template/sidebar');
				$this->load->view('template/toopbar');
				$this->load->view('admin/role' , $data);
				$this->load->view('template/auth_footer');
			   } else {
				  $this->db->insert('user_role' , ['role' => $this->input->post('role') ]);
				  $this->session->set_flashdata("Pesan", "<div class = 'alert alert-success'>Role baru berhasil ditambahkan !</div>");
				  redirect('admin/role');
			   }

		
 
		}
		
		public function role_akses($role_id)
		{
			$data['judul'] = "Role Akses";
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			
			$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
			
			$this->db->where('id != ', 1);
			
			$data['menu'] = $this->db->get('user_menu')->result_array();
		
		   $this->load->view('template/auth_header', $data);
		   $this->load->view('template/sidebar');
		   $this->load->view('template/toopbar');
		   $this->load->view('admin/role_akses' , $data);
		   $this->load->view('template/auth_footer');
		}

		public function ajax()
		{
			$role_id = $this->input->post('roleId');
			$menu_id = $this->input->post('menuId');
			

			$data = [
					'role_id' => $role_id,
					'menu_id' => $menu_id
			];

			$result = $this->db->get_where('user_access_menu', $data);
			
			if ($result->num_rows() < 1) {
				$this->db->insert('user_access_menu', $data);
			} else {
				$this->db->delete('user_access_menu', $data);
			}

			$this->session->set_flashdata("Pesan", "<div class = 'alert alert-success'>Akses berhasil diganti</div>");
			

		}








}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
    is_log_in();
    $this->load->model('Menu_Model');

	}


		public function index()
		{         
            $data['judul'] = "Menu Management";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $data['menu'] = $this->db->get('user_menu')->result_array();


            $this->form_validation->set_rules('menu', 'Menu', 'required');

            if ($this->form_validation->run() == false) {
              
              $this->load->view('template/auth_header', $data);
              $this->load->view('template/sidebar', $data);
              $this->load->view('template/toopbar', $data);
              $this->load->view('menu/index', $data);
              $this->load->view('template/auth_footer');
            } else {
               $this->db->insert('user_menu' , ['menu' => $this->input->post('menu') ]);
               $this->session->set_flashdata("Pesan", "<div class = 'alert alert-success'>Menu baru berhasil ditambahkan !</div>");
               redirect('menu');
            }
             
          
    }


    public function submenu()
    {

      $data['judul'] = "Submenu Management";
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      
      
      $data['submenu'] = $this->Menu_Model->getSubmenu();
      $data['menu'] = $this->db->get('user_menu')->result_array();
      

      $this->form_validation->set_rules('title', 'Title', 'required');
      $this->form_validation->set_rules('menu_id', 'Menu ', 'required');
      $this->form_validation->set_rules('url', 'URL', 'required');
      $this->form_validation->set_rules('icon', 'Icon', 'required');
    
 


      if ($this->form_validation->run() == false) {
       
          $this->load->view('template/auth_header', $data);
          $this->load->view('template/sidebar', $data);
          $this->load->view('template/toopbar', $data);
          $this->load->view('menu/submenu', $data);
          $this->load->view('template/auth_footer');
      } else {
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')

        ];

        $this->db->insert('user_sub_menu' , $data );
        $this->session->set_flashdata("Pesan", "<div class = 'alert alert-success'>Submenu baru berhasil ditambahkan !</div>");
        redirect('menu/submenu');



      }


    }


      public function delete_menu($id)
      {
        $this->Menu_Model->hapusmenu($id);
        redirect('menu');
      
      
      }
      public function hapus_submenu($id)
      {
        $this->Menu_Model->hapussubmenu($id);
        redirect('menu/submenu');
      }



    
 





}
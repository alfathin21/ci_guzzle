<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       
        $this->load->model('Data_obat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/data_obat/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/data_obat/index/';
            $config['first_url'] = base_url() . 'index.php/data_obat/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Data_obat_model->total_rows($q);
        $data_obat = $this->Data_obat_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_obat_data' => $data_obat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','data_obat/data_obat_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Data_obat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
	    );
            $this->template->load('template','data_obat/data_obat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_obat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_obat/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	);
        $this->template->load('template','data_obat/data_obat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->Data_obat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('data_obat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_obat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_obat/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
	    );
            $this->template->load('template','data_obat/data_obat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_obat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->Data_obat_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_obat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_obat_model->get_by_id($id);

        if ($row) {
            $this->Data_obat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_obat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_obat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_obat.xls";
        $judul = "data_obat";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");

	foreach ($this->Data_obat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=data_obat.doc");

        $data = array(
            'data_obat_data' => $this->Data_obat_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('data_obat/data_obat_doc',$data);
    }

}

/* End of file Data_obat.php */
/* Location: ./application/controllers/Data_obat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-03-26 18:36:43 */
/* http://harviacode.com */
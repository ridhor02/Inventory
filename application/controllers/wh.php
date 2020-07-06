<?php
defined('BASEPATH') or exit('No direct script access allowed');

class wh extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Data Warehouse";
        $data['wh'] = $this->admin->get('wh');
        $this->template->load('templates/dashboard', 'wh/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('Warehouse', 'Warehouse', 'required|trim');
        $this->form_validation->set_rules('Distric', 'Distric', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Warehouse";
            $this->template->load('templates/dashboard', 'wh/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('wh', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('wh');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('wh/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Warehouse";
            $data['wh'] = $this->admin->get('wh', ['id_wh' => $id]);
            $this->template->load('templates/dashboard', 'wh/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('wh', 'id_wh', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('wh');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('wh/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('wh', 'id_wh', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('wh');
    }
}

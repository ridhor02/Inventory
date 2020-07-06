<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mnemonic extends CI_Controller
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
        $data['title'] = "Data Mnemonic";
        $data['mnemonic'] = $this->admin->get('mnemonic');
        $this->template->load('templates/dashboard', 'mnemonic/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('Mnemonic', 'Mnemonic', 'required|trim');
        $this->form_validation->set_rules('Mnemonic_name', 'Mnemonic_name', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Mnemonic";
            $this->template->load('templates/dashboard', 'mnemonic/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('mnemonic', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('mnemonic');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('mnemonic/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "mnemonic";
            $data['mnemonic'] = $this->admin->get('mnemonic', ['id_nmonic' => $id]);
            $this->template->load('templates/dashboard', 'mnemonic/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('mnemonic', 'id_nmonic', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('mnemonic');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('mnemonic/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('mnemonic', 'id_nmonic', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('mnemonic');
    }
}

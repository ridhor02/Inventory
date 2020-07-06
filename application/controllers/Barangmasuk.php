<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Barangmasuk extends CI_Controller
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
        $data['title'] = "Barang Masuk";
        $data['barangmasuk'] = $this->admin->getBarangMasuk();
        $this->template->load('templates/dashboard', 'barang_masuk/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Masuk";
            $data['supplier'] = $this->admin->get('supplier');
            $data['barang'] = $this->admin->get('barang');
            $data['wh'] = $this->admin->get('wh');

            // Mendapatkan dan men-generate kode transaksi barang masuk
            $kode = 'A-IN-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('barang_masuk', 'id_barang_masuk', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_barang_masuk'] = $kode . $number;

            $this->template->load('templates/dashboard', 'barang_masuk/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('barang_masuk', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('barangmasuk');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('barangmasuk/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang_masuk', 'id_barang_masuk', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barangmasuk');

    }


    public function import($import_data = null)
	{
		$this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Masuk";
            $data['supplier'] = $this->admin->get('supplier');
            $data['barang'] = $this->admin->get('barang');

	
		if ($import_data != null) $data['import'] = $import_data;

		$this->template->load('templates/dashboard', 'barang_masuk/import', $data);
		
		
	}
}
	public function preview()
    {
        
		$config['upload_path']		= './uploads/import/';
		$config['allowed_types']	= 'xls|xlsx|csv';
		$config['max_size']			= 2048;
		$config['encrypt_name']		= true;

        $this->load->library('upload');
        $this->upload->initialize($config);
        
       

		if (!$this->upload->do_upload('upload_file')) {
			$error = $this->upload->display_errors();
			echo $error;
			die;
		} else {
			$file = $this->upload->data('full_path');
            $ext = $this->upload->data('file_ext');
            
            switch ($ext) {
				case '.xlsx':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
					break;
				case '.xls':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
					break;
				case '.csv':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
					break;
				default:
					echo "unknown file ext";
					die;
                }

                $spreadsheet = $reader->load($file);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                $data = [];
                for ($i = 1; $i < count($sheetData); $i++) {
                    $data[] = [
                        'No_PO' => $sheetData[$i][0],
                        'Item_no' => $sheetData[$i][1],
                        'Stock_Code' => $sheetData[$i][2],
                        'PR_Item_No' => $sheetData[$i][3],
                        'Ro_No' => $sheetData[$i][4],
                        'Description_1' => $sheetData[$i][5],
                        'Description_2' => $sheetData[$i][6],
                        'Description_3' => $sheetData[$i][7],
                        'Description_4' => $sheetData[$i][8],
                        'Quantity_Order' => $sheetData[$i][9],
                        'Qty_Received' => $sheetData[$i][10],
                        'UOP' => $sheetData[$i][11],
                        'Gross_Price' => $sheetData[$i][12],
                        'Unit_Price_IDR' => $sheetData[$i][13],
                        'Unit_Price_USD' => $sheetData[$i][14],
                        'Unit_Price_Other' => $sheetData[$i][15],
                        'Total_Discount_IDR' => $sheetData[$i][16],
                        'Total_Discount_USD' => $sheetData[$i][17],
                        'Total_Discount_Other' => $sheetData[$i][18],
                        'Total_VAT_IDR' => $sheetData[$i][19],
                        'Total_VAT_USD' => $sheetData[$i][20],
                        'Total_VAT_Other' => $sheetData[$i][21],
                        'Total_Po_Value_IDR' => $sheetData[$i][22],
                        'Total_Po_Value_USD' => $sheetData[$i][23],
                        'Total_Po_Value_OTHER' => $sheetData[$i][24],
                        'Qty_Outstanding' => $sheetData[$i][25],
                        'UOP2' => $sheetData[$i][26],
                        'PO_Status' => $sheetData[$i][27],
                        'Creation_Date' => $sheetData[$i][28],
                        'PO_Auths_Date' => $sheetData[$i][29],
                        'PO_Auths_By' => $sheetData[$i][30],
                        'Onsite_Receive_Date' => $sheetData[$i][31],
                        'Offsite_Receive_Date' => $sheetData[$i][32],
                        'Cost_Allocation' => $sheetData[$i][33],
                        'Cost_Allocation_Desc' => $sheetData[$i][34],
                        'Supplier_No' => $sheetData[$i][35],
                        'Supplier_Name' => $sheetData[$i][36],
                        'Warehouse_ID' => $sheetData[$i][37],
                        'Ext_Desc' => $sheetData[$i][38],
                        'PO_Footing_Line_of_Text' => $sheetData[$i][39],
                        'Qty_Receive_Onsite' => $sheetData[$i][40],
                        'Qty_Receive_Offsite' => $sheetData[$i][41],
                        'Qty_Receive_Ex_Offsite' => $sheetData[$i][42],
                        'Conv_Factor' => $sheetData[$i][43],
                        'Delivery_Location' => $sheetData[$i][44],
                        'Quote_No' => $sheetData[$i][45],
                        'PR_Authorised_Date' => $sheetData[$i][46],
                        'PR_Authorised_By_Name' => $sheetData[$i][47],
                        'Quote_Close_Date' => $sheetData[$i][48],
                        'Quote_Prtd_Date' => $sheetData[$i][49],
                        'Purch_Officer' => $sheetData[$i][50],
                        'Purch_Officer_Name' => $sheetData[$i][51],
                        'PO_Header_Line_of_Text' => $sheetData[$i][52],
                        'Payment_Type' => $sheetData[$i][53],
                        'Due_Date' => $sheetData[$i][54],
                        'user_id' => $sheetData[$i][55],
                        'barang_id' => $sheetData[$i][56],
                        'supplier_id' => $sheetData[$i][57],
                        'id_barang_masuk' => $sheetData[$i][58],
                        'PO_Type' => $sheetData[$i][59],
                       
                        

                    ];
                }
    
                unlink($file);
    
                $this->import($data);
            }
        }
        
        public function save()
        {
                $method 	= $this->input->post('method', true);
                $No_PO  = $this->input->post('No_PO', true);
                $Item_no  = $this->input->post('Item_no', true);
                $PR_Item_No  = $this->input->post('PR_Item_No', true);
                $Ro_No  = $this->input->post('Ro_No', true);
                $Stock_Code  = $this->input->post('Stock_Code', true);
                $Description_1  = $this->input->post('Description_1', true);
                $Description_2  = $this->input->post('Description_2', true);
                $Description_3  = $this->input->post('Description_3', true);
                $Description_4  = $this->input->post('Description_4', true);
                $PO_Type  = $this->input->post('PO_Type', true);
                $Quantity_Order  = $this->input->post('Quantity_Order', true);
                $Qty_Received  = $this->input->post('Qty_Received', true);
                $UOP  = $this->input->post('UOP', true);
                $Gross_Price  = $this->input->post('Gross_Price', true);
                $Unit_Price_IDR  = $this->input->post('Unit_Price_IDR', true);
                $Unit_Price_USD  = $this->input->post('Unit_Price_USD', true);
                $Unit_Price_Other  = $this->input->post('Unit_Price_Other', true);
                $Total_Discount_IDR  = $this->input->post('Total_Discount_IDR', true);
                $Total_Discount_USD  = $this->input->post('Total_Discount_USD', true);
                $Total_Discount_Other  = $this->input->post('Total_Discount_Other', true);
                $Total_VAT_IDR  = $this->input->post('Total_VAT_IDR', true);
                $Total_VAT_USD  = $this->input->post('Total_VAT_USD', true);
                $Total_VAT_Other  = $this->input->post('Total_VAT_Other', true);
                $Total_Po_Value_IDR  = $this->input->post('Total_Po_Value_IDR', true);
                $Total_Po_Value_USD  = $this->input->post('Total_Po_Value_USD', true);
                $Total_Po_Value_OTHER  = $this->input->post('Total_Po_Value_OTHER', true);
                $Qty_Outstanding  = $this->input->post('Qty_Outstanding', true);
                $UOP2  = $this->input->post('UOP2', true);
                $PO_Status  = $this->input->post('PO_Status', true);
                $Creation_Date  = $this->input->post('Creation_Date', true);
                $PO_Auths_Date  = $this->input->post('PO_Auths_Date', true);
                $PO_Auths_By  = $this->input->post('PO_Auths_By', true);
                $Onsite_Receive_Date  = $this->input->post('Onsite_Receive_Date', true);
                $Offsite_Receive_Date  = $this->input->post('Offsite_Receive_Date', true);
                $Cost_Allocation  = $this->input->post('Cost_Allocation', true);
                $Cost_Allocation_Desc  = $this->input->post('Cost_Allocation_Desc', true);
                $Supplier_No  = $this->input->post('Supplier_No', true);
                $Supplier_Name  = $this->input->post('Supplier_Name', true);
                $Warehouse_ID  = $this->input->post('Warehouse_ID', true);
                $Ext_Desc  = $this->input->post('Ext_Desc', true);
                $PO_Footing_Line_of_Text  = $this->input->post('PO_Footing_Line_of_Text', true);
                $Qty_Receive_Onsite  = $this->input->post('Qty_Receive_Onsite', true);
                $Qty_Receive_Offsite  = $this->input->post('Qty_Receive_Offsite', true);
                $Qty_Receive_Ex_Offsite  = $this->input->post('Qty_Receive_Ex_Offsite', true);
                $Conv_Factor  = $this->input->post('Conv_Factor', true);
                $Delivery_Location  = $this->input->post('Delivery_Location', true);
                $Quote_No  = $this->input->post('Quote_No', true);
                $PR_Authorised_Date  = $this->input->post('PR_Authorised_Date', true);
                $PR_Authorised_By_Name  = $this->input->post('PR Authorised_By_Name', true);
                $Quote_Close_Date  = $this->input->post('Quote_Close_Date', true);
                $Quote_Prtd_Date  = $this->input->post('Quote_Prtd_Date', true);
                $Purch_Officer  = $this->input->post('Purch_Officer', true);
                $Purch_Officer_Name  = $this->input->post('Purch_Officer_Name', true);
                $PO_Header_Line_of_Text  = $this->input->post('PO_Header_Line_of_Text', true);
                $Payment_Type  = $this->input->post('Payment_Type', true);
                $Due_Date  = $this->input->post('Due_Date', true);
                $user_id  = $this->input->post('user_id', true);
                $barang_id  = $this->input->post('barang_id', true);
                $supplier_id  = $this->input->post('supplier_id', true);
                $id_barang_masuk  = $this->input->post('id_barang_masuk', true);
    
            
            $this->form_validation->set_rules('nip', 'NIP', 'required|numeric|trim|min_length[8]|max_length[12]' . $u_nip);
            $this->form_validation->set_rules('nama_dosen', 'Nama Dosen', 'required|trim|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email' . $u_email);
            $this->form_validation->set_rules('matkul', 'Mata Kuliah', 'required');
        
    
            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'status'	=> false,
                    'errors'	=> [
                        'nip' => form_error('nip'),
                        'nama_dosen' => form_error('nama_dosen'),
                        'email' => form_error('email'),
                        'matkul' => form_error('matkul'),
                    ]
                ];
                $this->output_json($data);
            } else {
                $input = [
                    'nip'			=> $nip,
                    'nama_dosen' 	=> $nama_dosen,
                    'email' 		=> $email,
                    'matkul_id' 	=> $matkul
                ];
                if ($method === 'add') {
                    $action = $this->master->create('dosen', $input);
                } else if ($method === 'edit') {
                    $action = $this->master->update('dosen', $input, 'id_dosen', $id_dosen);
                }
    
                if ($action) {
                    $this->output_json(['status' => true]);
                } else {
                    $this->output_json(['status' => false]);
                }
            }
        }

        public function do_import()
        {
            $input = json_decode($this->input->post('data', true));
            $data = [];
            foreach ($input as $d) {
                $data[] = [
                    'No_PO' => $d->No_PO,
                    'Item_no' => $d->Item_no,
                    'Stock_Code' => $d->Stock_Code,
                    'PR_Item_No' => $d->PR_Item_No,
                    'Ro_No' => $d->Ro_No,
                    'Description_1' => $d->Description_1,
                    'Description_2' => $d->Description_2,
                    'Description_3' => $d->Description_3,
                    'Description_4' => $d->Description_4,
                    'PO_Type' => $d->PO_Type,
                    'Quantity_Order' => $d->Quantity_Order,
                    'Qty_Received' => $d->Qty_Received,
                    'UOP' => $d->UOP,
                    'Gross_Price' => $d->Gross_Price,
                    'Unit_Price_IDR' => $d->Unit_Price_IDR,
                    'Unit_Price_USD' => $d->Unit_Price_USD,
                    'Unit_Price_Other' => $d->Unit_Price_Other,
                    'Total_Discount_IDR' => $d->Total_Discount_IDR,
                    'Total_Discount_USD' => $d->Total_Discount_USD,
                    'Total_Discount_Other' => $d->Total_Discount_Other,
                    'Total_VAT_IDR' => $d->Total_VAT_IDR,
                    'Total_VAT_USD' => $d->Total_VAT_USD,
                    'Total_VAT_Other' => $d->Total_VAT_Other,
                    'Total_Po_Value_IDR' => $d->Total_Po_Value_IDR,
                    'Total_Po_Value_USD' => $d->Total_Po_Value_USD,
                    'Total_Po_Value_OTHER' => $d->Total_Po_Value_OTHER,
                    'Qty_Outstanding' => $d->Qty_Outstanding,
                    'UOP2' => $d->UOP2,
                    'PO_Status' => $d->PO_Status,
                    'Creation_Date' => $d->Creation_Date,
                    'PO_Auths_Date' => $d->PO_Auths_Date,
                    'PO_Auths_By' => $d->PO_Auths_By,
                    'Onsite_Receive_Date' => $d->Onsite_Receive_Date,
                    'Offsite_Receive_Date' => $d->Offsite_Receive_Date,
                    'Cost_Allocation' => $d->Cost_Allocation,
                    'Cost_Allocation_Desc' => $d->Cost_Allocation_Desc,
                    'Supplier_No' => $d->Supplier_No,
                    'Supplier_Name' => $d->Supplier_Name,
                    'Warehouse_ID' => $d->Warehouse_ID,
                    'Ext_Desc' => $d->Ext_Desc,
                    'PO_Footing_Line_of_Text' => $d->PO_Footing_Line_of_Text,
                    'Qty_Receive_Onsite' => $d->Qty_Receive_Onsite,
                    'Qty_Receive_Offsite' => $d->Qty_Receive_Offsite,
                    'Qty_Receive_Ex_Offsite' => $d->Qty_Receive_Ex_Offsite,
                    'Conv_Factor' => $d->Conv_Factor,
                    'Delivery_Location' => $d->Delivery_Location,
                    'Quote_No' => $d->Quote_No,
                    'PR_Authorised_Date' => $d->PR_Authorised_Date,
                    'PR_Authorised_By_Name' => $d->PR_Authorised_By_Name,
                    'Quote_Close_Date' => $d->Quote_Close_Date,
                    'Quote_Prtd_Date' => $d->Quote_Prtd_Date,
                    'Purch_Officer' => $d->Purch_Officer,
                    'Purch_Officer_Name' => $d->Purch_Officer_Name,
                    'PO_Header_Line_of_Text' => $d->PO_Header_Line_of_Text,
                    'Payment_Type' => $d->Payment_Type,
                    'Due_Date' => $d->Due_Date,
                    'user_id' => $d->user_id,
                    'barang_id' => $d->barang_id,
                    'supplier_id' => $d->supplier_id,
                    'id_barang_masuk' => $d->id_barang_masuk, 
                ];
            }

            $save = $this->admin->create('barang_masuk', $data, true);
            if ($save) {
                redirect('barang_masuk');
            } else {
                redirect('barang_masuk/import');
            }
        }
    }

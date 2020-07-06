<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import Data Excel dengan PHP</title>
    <!-- Load File bootstrap.min.css yang ada difolder css -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Style untuk Loading -->
    <style>
        #loading{
      background: whitesmoke;
      position: absolute;
      top: 140px;
      left: 82px;
      padding: 5px 10px;
      border: 1px solid #ccc;
    }
    </style>
    
    <!-- Load File jquery.min.js yang ada difolder js -->
    <script src="js/jquery.min.js"></script>
    
    <script>
    $(document).ready(function(){
      // Sembunyikan alert validasi kosong
      $("#kosong").hide();
    });
    </script>
  </head>
  <body>
    <!-- Membuat Menu Header / Navbar -->
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#" style="color: white;"><b>Import Data Excel dengan PHP</b></a>
        </div>
        <p class="navbar-text navbar-right hidden-xs" style="color: white;padding-right: 10px;">
          FOLLOW US ON  
          <a target="_blank" style="background: #3b5998; padding: 0 5px; border-radius: 4px; color: #f7f7f7; text-decoration: none;" href="https://www.linkedin.com/company/baramulti-group>">Linkedin</a> 
          <a target="_blank" style="background: #00aced; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="https://twitter.com">Twitter</a> 
          <a target="_blank" style="background: #d34836; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="http://www.bssr.co.id/">Website</a>
        </p>
      </div>
    </nav>
    
    <!-- Content -->
    <div style="padding: 0 15px;">
      <!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
      <a href="index.php" class="btn btn-danger pull-right">
        <span class="glyphicon glyphicon-remove"></span> Cancel
      </a>
      
      <h3>Form Import Data</h3>
      <hr>
      
      <!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
      <form method="post" action="" enctype="multipart/form-data">
        <a href="Format.xlsx" class="btn btn-default">
          <span class="glyphicon glyphicon-download"></span>
          Download Format
        </a><br><br>
        
        <!-- 
        -- Buat sebuah input type file
        -- class pull-left berfungsi agar file input berada di sebelah kiri
        -->
        <input type="file" name="file" class="pull-left">
        
        <button type="submit" name="preview" class="btn btn-success btn-sm">
          <span class="glyphicon glyphicon-eye-open"></span> Preview
        </button>
      </form>
      
      <hr>
      
      <!-- Buat Preview Data -->
      <?php
      // Jika user telah mengklik tombol Preview
      if(isset($_POST['preview'])){
        $nama_file_baru = 'data.xlsx';
        
        // Cek apakah terdapat file data.xlsx pada folder tmp
        if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
          unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
        
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
        $tmp_file = $_FILES['file']['tmp_name'];
        // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
        if($ext == "xlsx"){
          // Upload file yang dipilih ke folder tmp
          move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
          
          // Load librari PHPExcel nya
          require_once 'import_php/PHPExcel/PHPExcel.php';
          
          $excelreader = new PHPExcel_Reader_Excel2007();
          $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
          $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
          
          // Buat sebuah tag form untuk proses import data ke database
          echo "<form method='post' action='import.php'>";
          
          // Buat sebuah div untuk alert validasi kosong
          echo "<div class='alert alert-danger' id='kosong'>
          Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
          </div>";
          
          echo "<table class='table table-bordered'>
          <tr>
            <th colspan='5' class='text-center'>Preview Data</th>
          </tr>
          <tr>
          <th>No</th>
          <th>PO No</th>
          <th>PO Item No</th>
          <th>Stock Code</th>
          <th>PR / Item No</th>
          <th>RO No</th>
          <th>Description 1</th>
          <th>Description 2</th>
          <th>Description 3</th>
          <th>Description 4</th>
          <th>PO Type</th>
          <th>Quantity Order</th>
          <th>Qty Received</th>
          <th>UOP</th>
          <th>Gross Price ($)</th>
          <th>Unit Price (1 UOP)</th>
          <th>Total Discount per Item</th>
          <th>Total VAT per Item</th>
          <th>Total Po Value</th>
          <th>Qty Outstanding</th>
          <th>UOP</th>
          <th>PO Status</th>
          <th>Creation Date</th>
          <th>PO Auths Date</th>
          <th>PO Auths By</th>
          <th>Onsite Receive Date</th>
          <th>Offsite Receive Date</th>
          <th>Cost Allocation</th>
          <th>Cost Allocation Desc</th>
          <th>Supplier No</th>
          <th>Supplier Name</th>
          <th>Warehouse ID</th>
          <th>Ext Desc</th>
          <th>PO Footing Line of Text</th>
          <th>Qty Receive Onsite</th>
          <th>Qty Receive Offsite</th>
          <th>Qty Receive Ex-Offsite</th>
          <th>Conv Factor</th>
          <th>Delivery Location</th>
          <th>Quote No</th>
          <th> PR Authorised Date</th>
          <th>PR Authorised By Name</th>
          <th>Quote Close Date</th>
          <th>Quote Prtd Date</th>
          <th>Purch Officer</th>
          <th>Purch Officer Name</th>
          <th>PO Header Line of Text</th>
          <th>Payment Type</th>
          <th>Due Date</th>
          <th>User no</th>
          <th>User</th>
          <th>Tanggal pengambil</th>
          <th>Distric</th>
          <th>Category</th>
          </tr>";
          
          $numrow = 1;
          $kosong = 0;
          foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
            // Ambil data pada excel sesuai Kolom
            //$nis = $row['A']; // Ambil data NIS
           // $nama = $row['B']; // Ambil data nama
           // $jenis_kelamin = $row['C']; // Ambil data jenis kelamin
            //$telp = $row['D']; // Ambil data telepon
           // $alamat = $row['E']; // Ambil data alamat

            $No= $row['A'];
            $PO_No= $row['B'];
            $PO_Item_No= $row['C'];
            $Stock_Code= $row['D'];
            $PR_Item_No= $row['E'];
            $RO_No= $row['F'];
            $Description_1= $row['G'];
            $Description_2= $row['H'];
            $Description_3= $row['I'];
            $Description_4= $row['J'];
            $PO_Type= $row['K'];
            $Quantity_Order= $row['L'];
            $Qty_Received= $row['M'];
            $UOP= $row['N'];
            $Gross_Price= $row['O'];
            $Unit_Price= $row['P'];
            $Total_Discount_per_Item= $row['Q'];
            $Total_VAT_per_Item= $row['R'];
            $Total_Po_Value= $row['S'];
            $Qty_Outstanding= $row['T'];
            $UOP= $row['U'];
            $PO_Status= $row['V'];
            $Creation_Date= $row['W'];
            $PO_Auths_Date= $row['X'];
            $PO_Auths_By= $row['Y'];
            $Onsite_Receive_Date= $row['Z'];
            $Offsite_Receive_Date= $row['AA'];
            $Cost_Allocation= $row['AB'];
            $Cost_Allocation_Desc= $row['AC'];
            $Supplier_No= $row['AD'];
            $Supplier_Name= $row['AE'];
            $Warehouse_ID= $row['AF'];
            $Ext_Desc= $row['AG'];
            $PO_Footing_Line_of_Text= $row['AH'];
            $Qty_Receive_Onsite= $row['AI'];
            $Qty_Receive_Offsite= $row['AJ'];
            $Qty_Receive_Ex_Offsite= $row['AK'];
            $Conv_Factor= $row['AL'];
            $Delivery_Location= $row['AM'];
            $Quote_No= $row['AN'];
            $PR_Authorise_date= $row['AO'];
            $PR_Authorised_By_Name= $row['AP'];
            $Quote_Close_Date= $row['AQ'];
            $Quote_Prtd_Date= $row['AR'];
            $Purch_Officer= $row['AS'];
            $Purch_Officer_Name= $row['AT'];
            $PO_Header_Line_of_Text= $row['AU'];
            $Payment_Type= $row['AV'];
            $Due_Date= $row['AW'];

            
            // Cek jika semua data tidak diisi
            //if($nis == "" && $nama == "" && $jenis_kelamin == "" && $telp == "" && $alamat == "")
            if($No =="" && $PO_No =="" && $PO_Item_No =="" && $Stock_Code =="" && $PR_Item_No =="" && $RO_No =="" && $Description_1 =="" && $Description_2 =="" && $Description_3 =="" && $Description_4 =="" && $PO_Type =="" && $Quantity_Order =="" && $Qty_Received =="" && $UOP =="" && $Gross_Price =="" && $Unit_Price =="" && $Total_Discount_per_Item =="" && $Total_VAT_per_Item =="" && $Total_Po_Value =="" && $Qty_Outstanding =="" && $UOP =="" && $PO_Status =="" && $Creation_Date =="" && $PO_Auths_Date =="" && $PO_Auths_By =="" && $Onsite_Receive_Date =="" && $Offsite_Receive_Date =="" && $Cost_Allocation =="" && $Cost_Allocation_Desc =="" && $Supplier_No =="" && $Supplier_Name  =="" && $Warehouse_ID =="" && $Ext_Desc =="" && $PO_Footing_Line_of_Text =="" && $Qty_Receive_Onsite =="" && $Qty_Receive_Offsite  =="" && $Qty_Receive_Ex_Offsite =="" && $Conv_Factor =="" && $Delivery_Location =="" && $Quote_No ="" && $PR_Authorise_date =="" && $PR_Authorised_By_Name =="" && $Quote_Close_Date =="" && $Quote_Prtd_Date =="" && $Purch_Officer =="" && $Purch_Officer_Name =="" && $PO_Header_Line_of_Text =="" && $Payment_Type =="" && $Due_Date =="" && $User_no =="" && $User =="" && $Tanggal_pengambil =="" && $Distric =="" && $Category =="")
              continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
            
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            if($numrow > 1){
              // Validasi apakah semua data telah diisi
              //$nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
              //$nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
             // $jk_td = ( ! empty($jenis_kelamin))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
              //$telp_td = ( ! empty($telp))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
             // $alamat_td = ( ! empty($alamat))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
              
              // Jika salah satu data ada yang kosong
              //if($nis == "" or $nama == "" or $jenis_kelamin == "" or $telp == "" or $alamat == ""){
                //$kosong++; // Tambah 1 variabel $kosong
              }
              
              echo "<tr>";
              echo "<td".$nis_td.">".$nis."</td>";
              echo "<td".$nama_td.">".$nama."</td>";
              echo "<td".$jk_td.">".$jenis_kelamin."</td>";
              echo "<td".$telp_td.">".$telp."</td>";
              echo "<td".$alamat_td.">".$alamat."</td>";
              echo "</tr>";
            }
            
            $numrow++; // Tambah 1 setiap kali looping
          }
          
          echo "</table>";
          
          // Cek apakah variabel kosong lebih dari 0
          // Jika lebih dari 0, berarti ada data yang masih kosong
          if($kosong > 0){
          ?>  
            <script>
            $(document).ready(function(){
              // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
              $("#jumlah_kosong").html('<?php echo $kosong; ?>');
              
              $("#kosong").show(); // Munculkan alert validasi kosong
            });
            </script>
          <?php
          }else{ // Jika semua data sudah diisi
            echo "<hr>";
            
            // Buat sebuah tombol untuk mengimport data ke database
            echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
          }
          
          echo "</form>";
        }else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
          // Munculkan pesan validasi
          echo "<div class='alert alert-danger'>
          Hanya File Excel 2007 (.xlsx) yang diperbolehkan
          </div>";
        }
     //  }
      ?>
    </div>
  </body>
</html>
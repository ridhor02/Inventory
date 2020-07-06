<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Import Barang Masuk
                        </h4>
                        </div>
                        <div class="col-auto">
                        <a href="<?= base_url('barangmasuk') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>       
        <div class="text-right">
            <a href="<?= base_url('uploads/import/format/barangmasuk.xlsx') ?>" class="btn btn-secondary">Download Format</a>
        </div>           
        <div class="row">
            <?= form_open_multipart('barangmasuk/preview'); ?>
            <label for="file" class="col-sm-offset-12 col-sm-3 text-right">Pilih File</label>
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="file" name="upload_file">
                    <button name="preview" type="submit" class="btn btn-sm btn-success">Preview</button>
                </div>
            </div>
            </div>
            <?= form_close(); ?>
            <div class="col-sm-12 col-sm-offset-6">
                <?php if (isset($_POST['preview'])) : ?>
                    <br>
                    <div class="table-responsive">
                   <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
                  <thead>
                     <tr>
                                        <td>No.</td>
                                        <td>PO No</td>
                                        <td>PO Item No</td>
                                        <td>Stock Code</td>
                                        <td>PR / Item No</td>
                                        <td>RO No</td>
                                        <td>Description 1</td>
                                        <td>Description 2</td>
                                        <td>Description 3</td>
                                        <td>Description 4</td>
                                        <td>PO Type</td>
                                        <td>Quantity Order</td>
                                        <td>Qty Received</td>
                                        <td>UOP</td>
                                        <td>Gross Price ($)</td>
                                        <td>Unit Price IDR</td>
                                        <td>Unit Price USD</td>
                                        <td>Unit Price OTHER</td>
                                        <td>Total Discount per Item IDR</td>
                                        <td>Total Discount per Item USD</td>
                                        <td>Total Discount per Item OTHER</td>
                                        <td>Total VAT per Item IDR</td>
                                        <td>Total VAT per Item USD</td>
                                        <td>Total VAT per Item OTHER</td>
                                        <td>Total Po Value IDR</td>
                                        <td>Total Po Value USD</td>
                                        <td>Total Po Value OTHER</td>
                                        <td>Qty Outstanding</td>
                                        <td>UOP</td>
                                        <td>PO Status</td>
                                        <td>Creation Date</td>
                                        <td>PO Auths Date</td>
                                        <td>PO Auths By</td>
                                        <td>Onsite Receive Date</td>
                                        <td>Offsite Receive Date</td>
                                        <td>Cost Allocation</td>
                                        <td>Cost Allocation Desc</td>
                                        <td>Supplier No</td>
                                        <td>Supplier Name</td>
                                        <td>Warehouse ID</td>
                                        <td>Ext Desc</td>
                                        <td>PO Footing Line of Text</td>
                                        <td>Qty Receive Onsite</td>
                                        <td>Qty Receive Offsite</td>
                                        <td>Qty Receive Ex-Offsite</td>
                                        <td>Conv Factor</td>
                                        <td>Delivery Location</td>
                                        <td>Quote No</td>
                                        <td> PR Authorised Date</td>
                                        <td>PR Authorised By Name</td>
                                        <td>Quote Close Date</td>
                                        <td>Quote Prtd Date</td>
                                        <td>Purch Officer</td>
                                        <td>Purch Officer Name</td>
                                        <td>PO Header Line of Text</td>
                                        <td>Payment Type</td>
                                        <td>Due Date</td>
                                        
                                        </tr>
                        </thead>
                        <tbody>
                           
                        <?php
                                $status = true;
                                if (empty($import)) {
                                    echo '<tr><td colspan="2" class="text-center">Data kosong! pastikan anda menggunakan format yang telah disediakan.</td></tr>';
                                } else {
                                    $no = 1;
                                    foreach ($import as $data) :
                                        ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="<?= $data['No_PO'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['No_PO'] == null ? 'BELUM DIISI' : $data['No_PO']; ?>
                                        </td>
                                        <td class="<?= $data['Item_no'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['Item_no'] == null ? 'BELUM DIISI' : $data['Item_no'];; ?>
                                        </td>
                                        <td class="<?= $data['Stock_Code'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['Stock_Code'] == null ? 'BELUM DIISI' : $data['Stock_Code'];; ?>
                                        </td>
                                        <td class="<?= $data['PR_Item_No'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['PR_Item_No'] == null ? 'BELUM DIISI' : $data['PR_Item_No'];; ?>
                                        </td>
                                        <td class="<?= $data['Ro_No'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['Ro_No'] == null ? 'BELUM DIISI' : $data['Ro_No']; ?>
                                        </td>
                                        <td class="<?= $data['Description_1'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['Description_1'] == null ? 'BELUM DIISI' : $data['Description_1'];; ?>
                                        </td>
                                        <td class="<?= $data['Description_2'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['Description_2'] == null ? 'BELUM DIISI' : $data['Description_2'];; ?>
                                        </td>
                                        <td class="<?= $data['Description_3'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['Description_3'] == null ? 'BELUM DIISI' : $data['Description_3'];; ?>
                                        </td>
                                    </tr>
                            <?php
                                        if ($data['No_PO'] == null || $data['Item_no'] == null || $data['Stock_Code'] == null || $data['PR_Item_No'] == null || $data['Ro_No'] == null || $data['Description_1'] == null || $data['Description_2'] == null || $data['Description_3'] == null) {
                                            $status = true;
                                        }
                                    endforeach;
                                }
                                ?>
                        </tbody>
                    </table>
                    <?php if ($status) : ?>

                        <?= form_open('Barangmasuk/do_import', null, ['data' => json_encode($import)]); ?>
                        <button type='submit' class='btn btn-block btn-flat bg-purple'>Import</button>
                        <?= form_close(); ?>

                    <?php endif; ?>
                    <br>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
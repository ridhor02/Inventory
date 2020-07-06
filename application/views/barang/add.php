<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Stock Code
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('barang') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open('', [], ['stok' => 0]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="id_barang">ID Barang</label>
                    <div class="col-md-9">
                        <input readonly value="<?= set_value('id_barang', $id_barang); ?>" name="id_barang" id="id_barang" type="text" class="form-control" placeholder="ID Barang...">
                        <?= form_error('id_barang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="Stock_Code">Stock Code</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('Stock_Code'); ?>" name="Stock_Code" id="Stock_Code" type="text" class="form-control" placeholder="Stock Code...">
                        <?= form_error('Stock_Code', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_barang">Item Name</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama_barang'); ?>" name="nama_barang" id="nama_barang" type="text" class="form-control" placeholder="Item Name...">
                        <?= form_error('nama_barang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="Part_Number">Part Number</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('Part_Number'); ?>" name="Part_Number" id="nama_barang" type="text" class="form-control" placeholder="Item Name...">
                        <?= form_error('nama_barang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="Equitment">Equitment</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('Equitment'); ?>" name="Equitment" id="Equitment" type="text" class="form-control" placeholder="Equitment...">
                        <?= form_error('Equitment', '<small class="text-danger">', '</small>'); ?>
                        </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="id_nmonic">Mnemonic</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <select name="id_nmonic" id="id_nmonic" class="custom-select">
                                <option value="" selected disabled>Pilih Mnemonic</option>
                                <?php foreach ($mnemonic as $m) : ?>
                                    <option <?= set_select('id_nmonic', $m['id_nmonic']) ?> value="<?= $m['id_nmonic'] ?>"><?= $m['Mnemonic'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                            <a class="btn btn-primary" href="<?= base_url('mnemonic/add'); ?>"><i class="fa fa-plus"></i></a>
                     </div>  
                </div>

                <div class="row form-group">
                    <label class="col-md-9 text-md-left" for="jenis_id">Part Category</label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <select name="jenis_id" id="jenis_id" class="custom-select">
                                <option value="" selected disabled>Pilih Category</option>
                                <?php foreach ($jenis as $j) : ?>
                                    <option <?= set_select('jenis_id', $j['id_jenis']) ?> value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('jenis/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('jenis_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="satuan_id">Satuan Barang</label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <select name="satuan_id" id="satuan_id" class="custom-select">
                                <option value="" selected disabled>Pilih Satuan Barang</option>
                                <?php foreach ($satuan as $s) : ?>
                                    <option <?= set_select('satuan_id', $s['id_satuan']) ?> value="<?= $s['id_satuan'] ?>"><?= $s['nama_satuan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('satuan/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('satuan_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="id_wh">Warehouse</label>
                    <div class="col-md-12">
                        <div class="input-group">
                            <select name="id_wh" id="id_wh" class="custom-select">
                                <option value="" selected disabled>Pilih Satuan Warehouse</option>
                                <?php foreach ($wh as $w) : ?>
                                    <option <?= set_select('id_wh', $w['id_wh']) ?> value="<?= $w['id_wh'] ?>"><?= $w['Warehouse'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('wh/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('id_wh', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 offset-lg-6">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</bu>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
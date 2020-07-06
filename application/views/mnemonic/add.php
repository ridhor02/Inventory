<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Mnemonic
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('mnemonic') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="mnemonic">Mnemonic</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('mnemonic'); ?>" name="mnemonic" id="mnemonic" type="text" class="form-control" placeholder="Mnemonic...">
                        <?= form_error('mnemonic', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="Mnemonic_name"> Name Mnemonic</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('Mnemonic_name'); ?>" name="Mnemonic_name" id="Mnemonic_name" type="text" class="form-control" placeholder="Name Mnemonic...">
                        <?= form_error('Mnemonic_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="keterangan"> Keterangan</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('keterangan'); ?>" name="keterangan" id="keterangan" type="text" class="form-control" placeholder="Keterangan...">
                        <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
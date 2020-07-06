<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Warehouse
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('wh') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                    <label class="col-md-3 text-md-right" for="Warehouse">Warehouse</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('Warehouse'); ?>" name="Warehouse" id="Warehouse" type="text" class="form-control" placeholder="Warehouse...">
                        <?= form_error('Warehouse', '<small class="text-danger">', '</small>'); ?>
                    </div>
            </div>
            <div class="card-body">
              <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="Distric">Distric</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('Distric'); ?>" name="Distric" id="Distric" type="text" class="form-control" placeholder="Distric...">
                        <?= form_error('Distric', '<small class="text-danger">', '</small>'); ?>
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
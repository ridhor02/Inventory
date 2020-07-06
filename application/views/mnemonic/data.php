<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Mnemonic
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('mnemonic/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Mnemonic
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Mnemonic</th>
                    <th>Name Mnemonic</th>
                    <th>keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($mnemonic) :
                    foreach ($mnemonic as $m) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $m['Mnemonic']; ?></td>
                            <td><?= $m['Mnemonic_name']; ?></td>
                            <td><?= $m['keterangan']; ?></td>
                            <td>
                                <a href="<?= base_url('mnemonic/edit/') . $m['id_nmonic'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('mnemonic/delete/') . $m['id_nmonic'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
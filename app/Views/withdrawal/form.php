<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4 rounded">
                <h2 class="text-center text-primary">Form Pencairan Saldo</h2>
                <?php if (session()->get('errors')) : ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->get('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <p class="text-muted text-center">Silakan isi data di bawah untuk mengajukan pencairan saldo.</p>

                <?php if (session()->getFlashdata('message')) : ?>
                    <div class="alert alert-success text-center">
                        <?= session()->getFlashdata('message') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('withdrawal/store') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah Pencairan (Rp)</label>
                        <input type="number" name="amount" class="form-control" required min="10000" placeholder="Masukkan jumlah saldo yang ingin dicairkan">
                    </div>

                    <div class="mb-3">
                        <label for="bank_name" class="form-label">Nama Bank</label>
                        <input type="text" name="bank_name" class="form-control" required placeholder="Contoh: BCA, Mandiri, BRI">
                    </div>

                    <div class="mb-3">
                        <label for="account_number" class="form-label">Nomor Rekening</label>
                        <input type="text" name="account_number" class="form-control" required placeholder="Masukkan nomor rekening">
                    </div>

                    <div class="mb-3">
                        <label for="account_holder" class="form-label">Nama Pemilik Rekening</label>
                        <input type="text" name="account_holder" class="form-control" required placeholder="Masukkan nama sesuai rekening">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Ajukan Pencairan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <h2 class="mb-3 text-center text-primary">Manajemen Produk</h2>
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= site_url('/admin/products/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </a>
        
        <!-- Form Pencarian -->
        <form method="get" action="<?= site_url('/admin/products') ?>" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari ID atau Nama Barang..." value="<?= esc($search ?? '') ?>">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Cari</button>
        </form>
    </div>

    <?php if (session()->getFlashdata('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= esc($product['id']) ?></td>
                        <td><?= esc($product['name']) ?></td>
                        <td>Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                        <td>
                            <img src="<?= base_url('uploads/' . esc($product['image'])) ?>" class="img-thumbnail" width="60" alt="Produk">
                        </td>
                        <td><?= esc(substr($product['description'], 0, 100)) ?><?= (strlen($product['description']) > 100) ? '...' : '' ?></td>
                        <td>
                            <a href="<?= base_url('/admin/products/edit/' . $product['id']) ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="<?= base_url('/admin/products/delete/' . $product['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
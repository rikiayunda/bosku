<form action="<?= base_url('/admin/products/store') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    
    <div class="mb-3">
        <label for="name" class="form-label">Nama Produk</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Harga</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Upload Gambar</label>
        <input type="file" name="image" class="form-control" accept=".jpg, .jpeg" required>
        <small class="text-muted">Hanya diperbolehkan format JPG atau JPEG.</small>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h3 class="text-center text-primary mb-3">Tambah Produk</h3>
        
        <form action="<?= base_url('/admin/products/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" name="name" class="form-control" required placeholder="Masukkan nama produk">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga (Rp)</label>
                <input type="number" name="price" class="form-control" required min="1000" placeholder="Masukkan harga">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Produk</label>
                <textarea name="description" class="form-control" required rows="3" placeholder="Masukkan deskripsi produk"></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Gambar</label>
                <input type="file" name="image" class="form-control" accept=".jpg, .jpeg" required onchange="previewImage(event)">
                <small class="text-muted">Hanya diperbolehkan format JPG atau JPEG.</small>
                <div class="mt-2">
                    <img id="imagePreview" class="img-thumbnail" style="max-width: 200px; display: none;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Simpan Produk</button>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById("imagePreview");

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

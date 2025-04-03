<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h3 class="text-primary mb-4"><i class="bi bi-person-circle"></i> Profile</h3>

        <!-- Flash Message -->
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/profile/update/' . $user_get['id']); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" id="full_name" value="<?= esc($user_get['full_name'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?= esc($user_get['email'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="<?= esc($user_get['phone'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="<?= esc($user_get['username'] ?? '') ?>" required>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Profile Photo</label>
                        <input type="file" name="photo" class="form-control" id="photo" accept="image/*" onchange="previewImage(event)">
                        <input type="hidden" name="photo_current" value="<?= esc($user_get['photo'] ?? '') ?>">
                        <div class="mt-2">
                            <img id="photoPreview" src="<?= base_url('uploads/' . $user_get['photo'] ?? 'default.jpg') ?>" alt="Profile Photo" class="img-thumbnail" width="120">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="skin" class="form-label">Skin</label>
                        <select name="skin" class="form-select" id="skin">
                            <option value="">Pilih Skin</option>
                            <option value="merah" <?= ($user_get['skin'] == 'merah') ? "selected" : "" ?>>Merah</option>
                            <option value="biru" <?= ($user_get['skin'] == 'biru') ? "selected" : "" ?>>Biru</option>
                            <option value="kuning" <?= ($user_get['skin'] == 'kuning') ? "selected" : "" ?>>Kuning</option>
                            <option value="black" <?= ($user_get['skin'] == 'black') ? "selected" : "" ?>>Hitam</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <input type="text" name="level" class="form-control" id="level" value="<?= esc($user_get['level'] ?? '') ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" name="status" class="form-control" id="status" value="<?= esc($user_get['status'] ?? '') ?>">
                        <small class="text-muted">*) Kosongkan jika tidak ingin diubah!</small>
                    </div>
                </div>
            </div>

            <!-- Password Section -->
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Leave blank to keep current password">
                
            </div>

            <!-- Tombol Simpan -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Profile</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('photoPreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

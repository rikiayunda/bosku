
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="mb-3 text-center">Ubah Sandi Pengguna</h2>
            <p><strong>Nama:</strong> <?= esc($user['full_name']); ?></p>
            
            <form action="<?= base_url('admin/update-password'); ?>" method="post" onsubmit="return validatePassword()">
                <?= csrf_field(); ?>
                <input type="hidden" name="user_id" value="<?= esc($user['id']); ?>">

                <div class="mb-3">
                    <label for="new_password" class="form-label">Sandi Baru:</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required minlength="6">
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Sandi:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                    <div class="invalid-feedback">Sandi tidak cocok!</div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <script>
        function validatePassword() {
            let password = document.getElementById("new_password").value;
            let confirmPassword = document.getElementById("confirm_password").value;
            
            if (password !== confirmPassword) {
                document.getElementById("confirm_password").classList.add("is-invalid");
                return false;
            }
            return true;
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

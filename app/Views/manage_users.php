
<body>
    <div class="container mt-5">
        <!-- <h2 class="mb-4">Manage Users</h2> -->
        
        <?php if (session()->getFlashdata('notif')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('notif') ?>
            </div>
        <?php endif; ?>

        <!-- <a href="<?= base_url('/manage_users/create') ?>" class="btn btn-primary mb-3">Add New User</a> -->
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Skin</th>
                        <th>Saldo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($user)): ?>
                        <?php foreach ($user as $key => $user): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= esc($user['full_name']) ?></td>
                                <td><?= esc($user['phone']) ?></td>
                                <td><?= esc($user['email']) ?></td>
                                <td><?= esc($user['username']) ?></td>
                                <td><?= esc($user['level']) ?></td>
                                <td><?= esc($user['skin']) ?></td>
                                <td>Rp <?= number_format($user['saldo'], 0, ',', '.') ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('/manage_users/edit/' . $user['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('/manage_users/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                        <a href="<?= base_url('admin/edit-saldo/' . $user['id']) ?>" class="btn btn-info btn-sm">Edit Saldo</a>
                                        <a href="<?= base_url('admin/change-password/' . $user['id']) ?>" class="btn btn-secondary btn-sm">Ubah Sandi</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

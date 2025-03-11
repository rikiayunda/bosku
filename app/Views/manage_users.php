<div class="container mt-5">
    <h2>Manage Users</h2>
    <a href="<?= base_url('/manage_users/create') ?>" class="btn btn-primary mb-3">Add New User</a>
    <spann style="background-color:green;" <?php session()->getFlashdata('notif') ?>></span>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Skin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($user)): ?>
                    <?php foreach ($user as $key => $user): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $user['full_name'] ?></td>
                            <td><?= $user['phone'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['skin'] ?></td>
                            <td><?= $user['level'] ?></td>
                            <td>
                                <a href="<?= base_url('/manage_users/edit/' . $user['id']) ?>" class="btn btn-warning">Edit</a>
                                <a href="<?= base_url('/manage_users/delete/' . $user['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

</div>
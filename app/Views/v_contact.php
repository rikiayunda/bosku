<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Contact List</h3>
        <div class="mt-4">
            <!-- Tombol Tambah Contact yang memunculkan modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addContactModal">
                Tambah Contact
            </button>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    <?php if (!empty($contact)): ?> <!-- Ganti $contacts dengan $contact -->
        <?php foreach ($contact as $c): ?> <!-- Ubah variabel dalam loop -->
            <tr>
                <td><?= esc($c['id']) ?></td>
                <td><?= esc($c['name']) ?></td>
                <td><?= esc($c['email']) ?></td>
                <td><?= esc($c['phone']) ?></td>
                <td>
                    <a href="<?= base_url('/manage_users/edit/' . $c['id']) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('/manage_users/delete/' . $c['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" class="text-center">No contacts found</td>
        </tr>
    <?php endif; ?>
</tbody>

        </table>
    </div>
</div>

<!-- Modal Tambah Contact -->
<div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="addContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addContactModalLabel">Tambah Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/contacts/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Contact</button>
                </div>
            </form>
        </div>
    </div>
</div>

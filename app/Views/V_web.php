<div class="card">
    <div class="card-header">
        <h3 class="card-title">Public Messages</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($messages) && is_array($messages)): ?>
                    <?php foreach ($messages as $index => $message): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($message['name']) ?></td>
                            <td><?= esc($message['email']) ?></td>
                            <td><?= esc($message['message']) ?></td>
                            <td>
                                <!-- Tindakan yang diperbolehkan untuk umum -->
                                <a href="<?= base_url('/messages/detail/' . $message['id']) ?>" class="btn btn-info btn-sm">View Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No messages found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

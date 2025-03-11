<div class="card">
  <div class="card-header">
    <h3 class="card-title">DataTable with Default Features</h3>
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
              <a href="<?= base_url('/messages/detail/' . $message['id']) ?>" class="btn btn-info btn-sm">View Details</a>
              <!-- <a href="<?= base_url('/messages/detail/' . urlencode($message['id'])) ?>">View Details</a> -->
              <a href="<?= base_url('/messages/reply/' . $message['id']) ?>" class="btn btn-primary btn-sm">Reply</a>
                <a href="<?= base_url('/messages/delete/' . $message['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
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



<div class="container mt-5">
        <h2>Message Detail</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= esc($message['name']) ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= esc($message['email']) ?></h6>
                <p class="card-text"><?= esc($message['message']) ?></p>
            </div>
        </div>

        <h4 class="mt-4">Replies</h4>
        <?php if ($replies): ?>
            <?php foreach ($replies as $reply): ?>
                <div class="card mt-2">
                    <div class="card-body">
                        <p class="card-text"><?= esc($reply['reply']) ?></p>
                        <p class="text-muted"><small>Replied on: <?= esc($reply['created_at']) ?></small></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No replies yet.</p>
        <?php endif; ?>

        <h4 class="mt-4">Send a Reply</h4>
        <form action="<?= base_url('/messages/sendReply') ?>" method="post">
            <input type="hidden" name="id" value="<?= esc($message['id']) ?>">
            <div class="form-group">
                <textarea name="reply" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Reply</button>
        </form>

        <!-- Button to go back to list -->
        <a href="<?= base_url('/messages') ?>" class="btn btn-secondary mt-3">Back to Messages</a>
    </div>
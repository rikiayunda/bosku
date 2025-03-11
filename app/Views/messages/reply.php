<div class="container mt-5">
        <h2>Reply to: <?= esc($message['name']) ?></h2>
        <p><strong>Original Message:</strong> <?= esc($message['message']) ?></p>
        <form action="<?= base_url('/messages/sendReply') ?>" method="post">
            <input type="hidden" name="id" value="<?= esc($message['id']) ?>">
            <div class="form-group">
                <label for="reply">Your Reply</label>
                <textarea name="reply" class="form-control" id="reply" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Reply</button>
        </form>
        <a href="<?= base_url('/messages') ?>" class="btn btn-secondary mt-3">Back to Messages</a>
    </div>
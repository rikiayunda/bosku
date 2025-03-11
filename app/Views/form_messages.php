<div class="container mt-5">
    <h2>Send New Message</h2>

    <!-- Form to send a new message -->
    <form action="<?= base_url('/messages/send') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="recipient">Recipient Emails (Separate emails with commas)</label>
            <input type="text" name="recipients" class="form-control" id="recipients" value="<?= old('recipients') ?>" placeholder="e.g. email1@example.com, email2@example.com" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" class="form-control" id="subject" value="<?= old('subject') ?>" required>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" class="form-control" id="message" rows="6" required><?= old('message') ?></textarea>
        </div>
        <div class="form-group">
            <label for="attachment">Attachment (Optional)</label>
            <input type="file" name="attachment" class="form-control-file" id="attachment">
        </div>
        
        <!-- Buttons to send or save as draft -->
        <button type="submit" name="action" value="send" class="btn btn-primary">Send Message</button>
        <button type="submit" name="action" value="save_draft" class="btn btn-secondary">Save as Draft</button>
    </form>

    <!-- Button to go back to Messages -->
    <a href="<?= base_url('/messages') ?>" class="btn btn-secondary mt-3">Back to Messages</a>
</div>

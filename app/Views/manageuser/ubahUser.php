<div class="container mt-5">
    <h2>Profile</h2>

    <!-- <form action="<?= base_url('/profile/update') ?>" method="post" enctype="multipart/form-data"> -->

    <!-- <form action="<?= base_url('/profile/update' . $user_get['id']); ?>" method="post" enctype="multipart/form-data"> -->
    <form action="<?= base_url('/profile/update/' . $user_get['id']); ?>" method="post" enctype="multipart/form-data">
   
    <!-- <input type="hidden" name="id" value="<?= $user_get['id'] ?>"> -->

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" class="form-control" id="full_name" value="<?= esc($user_get['full_name'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="<?= esc($user_get['email'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" class="form-control" id="phone" value="<?= esc($user_get['phone'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="<?= esc($user_get['username'] ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label for="photo">Profile Photo</label>
            <input type="file" name="photo" class="form-control" id="photo">
            <input type="hidden" name="photo_current" value="<?= esc($user_get['photo'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="skin">Skin</label>
            <select name="skin" class="form-control" id="skin">
                <option value="">Pilih skin</option>
                <option value="merah" <?php if ($user_get['skin'] == 'merah') echo "selected"; ?>>Merah</option>
                <option value="biru" <?php if ($user_get['skin'] == 'biru') echo "selected"; ?>>Biru</option>
                <option value="kuning" <?php if ($user_get['skin'] == 'kuning') echo "selected"; ?>>Kuning</option>
                <option value="black" <?php if ($user_get['skin'] == 'black') echo "selected"; ?>>hitam</option>
            </select>
            </br>
        </div>
        <div class="form-group">
            <label for="level">Level</label>
            <input type="text" name="level" class="form-control" id="level" value="<?= esc($user_get['level'] ?? '') ?>" readonly>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" id="status" value="<?= esc($user_get['status'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Leave blank to keep current password">
        </div>
        <div>
            <font color="red">
                <small>*) Kosongkan jika tidak ingin diubah!</small>
            </font>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
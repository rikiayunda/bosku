<div class="container mt-5">
    <h2>Profile</h2>

    <form action="<?= base_url('/profile/update') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" class="form-control" id="full_name" value="<?= isset($user['full_name']) ? $user['full_name'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="<?= isset($user['email']) ? $user['email'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" class="form-control" id="phone" value="<?= isset($user['phone']) ? $user['phone'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="<?= isset($user['username']) ? $user['username'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="photo">Profile Photo</label>
            <input type="file" name="photo" class="form-control" id="photo">
            <input type="hidden" name="current_photo" value="<?= isset($user['photo']) ? $user['photo'] : '' ?>"> <!-- Simpan nama foto yang lama -->
        </div>
        <div class="form-group">
            <label for="skin">Skin</label>
            <select name="skin" class="form-control" id="skin" value="<?= isset($user['skin']) ? $user['skin'] : '' ?>">
                <option value="">Pilih skin</option>
                <option value="">Merah</option>
                <option value="">Kuning</option>    
            </select>
        </br>
        </div>
        <div class="form-group">
            <label for="level">Level</label>
            <input type="text" name="level" class="form-control" id="level" value="<?= isset($user['level']) ? $user['level'] : '' ?>" readonly>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" id="status" value="<?= isset($user['status']) ? $user['status'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Leave blank to keep current password">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

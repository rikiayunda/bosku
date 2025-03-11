<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lupa Password</title>
  <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Lupa</b>Password</a>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
        
        <?php
        //pesan validasi error
        $errors = session()->getFlashdata('errors');
        if (!empty($errors)) { ?>
          <div class="alert alert-danger" role="alert">
            <ul>
              <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php } ?>

        <?php
        if (session()->getFlashdata('pesan')) {
          echo '<div class="alert alert-success" role="alert">';
          echo session()->getFlashdata('pesan');
          echo '</div>';
        }
        ?>

        <?= form_open('auth/proses_lupa_password'); ?>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email Terdaftar" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Kirim</button>
          </div>
        </div>
        <?= form_close(); ?>

        <a href="<?= base_url('auth/login') ?>" class="text-center">Kembali ke Login</a>
      </div>
    </div>
  </div>

  <script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>/template/dist/js/adminlte.min.js"></script>
</body>

</html>

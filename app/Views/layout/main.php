<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Load head section -->
    <?= view('layout/v_head'); ?>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Load header -->
        <?= view('layout/v_header'); ?>

        <!-- Load sidebar -->
        <?= view('layout/v_nav'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php if (isset($isi)) {
                        echo view($isi); // Load content view dynamically
                    } ?>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Load footer -->
        <?= view('layout/v_footer'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- Load Scripts -->
    <script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/template/dist/js/adminlte.min.js"></script>

    <!-- Additional Scripts (if any) -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>

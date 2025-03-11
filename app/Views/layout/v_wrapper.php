<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Load head section -->
    <?= view('layout/v_head'); ?>
</head>

<!-- <body class="hold-transition sidebar-mini"> -->
<!-- <body class="hold-transition sidebar-mini layout-fixed"> -->
<body class="sidebar-collapse layout-fixed ">

    

    <div class="wrapper">
        <!-- Load header -->
        <?= view('layout/v_header'); ?>

        <!-- Load sidebar -->
        <?= view('layout/v_nav'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Page header (Optional) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $title ?? 'Messages' ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                                <li class="breadcrumb-item active"><?= $title ?? 'Messages' ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content mb-3">
                <div class="container-fluid">
                    <?php if (isset($isi)) {
                        echo view($isi); // Load dynamic content view
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

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <!-- Additional Scripts -->
    <?= $this->renderSection('scripts') ?>

    <script>
        $(document).ready(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [
                    "copy", "csv", "excel", "pdf", "print", "colvis"
                ],
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

           
        });

    $(document).ready(function () {
        $('[data-widget="pushmenu"]').PushMenu();
    });

    


    </script>

</body>

</html>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('dashboard') ?>" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- User Account Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user"></i>   <?= session()->get('full_name') ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= base_url('logout') ?>" class="dropdown-item">Logout</a>
            </div>
        </li>
        
    </ul>
</nav>
<!-- /.navbar -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url() ?>/logo/logoZB.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Zona Belanja</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('photo/' . session()->get('photo')) ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <?= session()->get('full_name') ?> <!-- Nama lengkap pengguna -->
                    <br>
                    <a href="#"><i class="fa fa-circle text-success"></i>
                        <?php if (session()->get('level') == 1): ?>
                            Admin
                        <?php elseif (session()->get('level') == 2): ?>
                            User
                        <?php elseif (session()->get('level') == 3): ?>
                            Pelanggan
                        <?php else: ?>
                            Guest
                        <?php endif; ?>
                    </a>
                </a>
                <!-- Menambahkan Keterangan Saldo -->
                <?php if (session()->get('level') == 3): ?> <!-- Hanya tampilkan saldo untuk pelanggan -->
                    <p class="text-white mt-2">
                        <strong>Saldo:</strong> <?= number_format(session()->get('saldo'), 0, ',', '.') ?> IDR
                    </p>
                    <?php
                    // var_dump(session()->get('saldo'));
                    ?>

                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                <?php if (session()->get('level') == 3): ?>
                    <!-- <li class="nav-item">
                        <a href="<?= base_url('dashboard') ?>" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="<?= base_url('home-pelanggan') ?>" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i> <!-- Ikon keranjang belanja -->
                            <p>Belanja</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('withdrawal') ?>" class="nav-link">
                            <i class="nav-icon fas fa-wallet"></i> <!-- Ikon dompet untuk tarik saldo -->
                            <p>Tarik Saldo</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/referral') ?>" class="nav-link">
                            <i class="nav-icon fas fa-user-friends"></i> <!-- Ikon jaringan orang untuk referral -->
                            <p>Referral & Bonus</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/panduan-faq') ?>" class="nav-link">
                            <i class="nav-icon fas fa-question-circle"></i> <!-- Ikon tanda tanya untuk FAQ -->
                            <p>Panduan & FAQ</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="<?= base_url('/profile') ?>" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i> 
                            <p>Profil</p>
                        </a>
                    </li> -->




                    <!-- <li class="nav-item">
                    <a href="<?= base_url('deposit') ?>" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Deposit</p>
                    </a>
                </li> -->

                    <!-- Sent Messages/Pesan Keluar -->

                <?php endif; ?>

                <!-- <li class="nav-item">
                    <a href="<?= base_url('transaksi') ?>" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Transaksi</p>
                    </a>
                </li> -->
                <?php if (session()->get('level') == 1): ?>
                    <!-- <li class="nav-item">
                        <a href="<?= base_url('admin/deposit') ?>" class="nav-link">
                            <i class="nav-icon fas fa-wallet"></i>
                            <p>Kelola Deposit</p>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/bank') ?>" class="nav-link">
                            <i class="nav-icon fas fa-university"></i> <!-- Ikon bank -->
                            <p>Bank Checkout</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/products') ?>" class="nav-link">
                            <i class="nav-icon fas fa-store"></i> <!-- Toko -->
                            <p>Kelola Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/admin/orders') ?>" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i> <!-- Ikon daftar pesanan -->
                            <p>Kelola Order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/manage_users') ?>" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i> <!-- Ikon user management -->
                            <p>Manage User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/withdrawals') ?>" class="nav-link">
                            <i class="nav-icon fas fa-money-bill-wave"></i> <!-- Ikon pencairan dana -->
                            <p>Manage Withdraw</p>
                        </a>
                    </li>

                <?php endif; ?>

                <!-- Inbox/Pesan Masuk -->
                <!-- <li class="nav-item">
                    <a href="<?= base_url('') ?>" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Inbox</p>
                    </a>
                </li> -->

                <!-- Sent Messages/Pesan Keluar -->
                <!-- <li class="nav-item">
                    <a href="<?= base_url('/messages/new') ?>" class="nav-link">
                        <i class="nav-icon fas fa-paper-plane"></i>
                        <p>Sent Messages</p>
                    </a>
                </li> -->

                <!-- Manage Users/Manajemen Pengguna -->
                <!-- <li class="nav-item">
                    <a href="<?= base_url('manage_users') ?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Manage Users</p>
                    </a>
                </li> -->

                <!-- Contact List/Daftar Kontak -->
                <!-- <li class="nav-item">
                    <a href="<?= base_url('/contacts') ?>" class="nav-link">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>Contact List</p>
                    </a>
                </li> -->

                <!-- Email Template/Template Email -->
                <!-- <li class="nav-item">
                    <a href="<?= base_url('email_template') ?>" class="nav-link">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p>Email Templates</p>
                    </a>
                </li> -->

                <!-- Attachments/Lampiran -->
                <!-- <li class="nav-item">
                    <a href="<?= base_url('attachments') ?>" class="nav-link">
                        <i class="nav-icon fas fa-paperclip"></i>
                        <p>Attachments</p>
                    </a>
                </li> -->

                <!-- Email Logs/Log Pengiriman Email -->
                <!-- <li class="nav-item">
                    <a href="<?= base_url('email_logs') ?>" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Email Logs</p>
                    </a>
                </li> -->

                <!-- Email Replies/Balasan Email -->
                <!-- <li class="nav-item">
                    <a href="<?= base_url('email_replies') ?>" class="nav-link">
                        <i class="nav-icon fas fa-reply"></i>
                        <p>Email Replies</p>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a href="<?= base_url('/profile') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li> -->

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
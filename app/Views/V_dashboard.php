<div class="wrapper mb-2">
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- Pesan Masuk -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $total_incoming_messages; ?></h3>
                            <p>Pesan Masuk</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-email"></i>
                        </div>
                        <a href="/messages/incoming" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Pesan Keluar -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $total_outgoing_messages; ?></h3>
                            <p>Pesan Keluar</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-paper-airplane"></i>
                        </div>
                        <a href="/messages/outgoing" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Pengguna Aktif -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                <?= $total_active_users; ?>
                            </h3>
                            <p>Pengguna Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="/users" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Pesan Gagal Terkirim -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $failed_messages; ?></h3>
                            <p>Pesan Gagal Terkirim</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-alert-circled"></i>
                        </div>
                        <a href="/messages/failed" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Notifikasi Baru -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $new_notifications; ?></h3>
                            <p>Notifikasi Baru</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-notifications"></i>
                        </div>
                        <a href="/notifications" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Kontak Tersimpan -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3><?= $total_contacts; ?></h3>
                            <p>Kontak Tersimpan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-contact"></i>
                        </div>
                        <a href="/contacts" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Grafik Aktivitas Pesan -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Pesan Masuk/Keluar</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="messageChart"></canvas> <!-- Implementasi Chart.js -->
                        </div>
                    </div>
                </div>

                <!-- Grafik Aktivitas Pengguna -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Aktivitas Pengguna</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="userActivityChart"></canvas> <!-- Implementasi chart menggunakan Chart.js -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Script untuk Chart.js -->
<script>
    var ctx1 = document.getElementById('messageChart').getContext('2d');
    var messageChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'], // contoh data bulan
            datasets: [{
                label: 'Pesan Masuk',
                data: [12, 19, 3, 5, 2, 3], // contoh data dinamis
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }, {
                label: 'Pesan Keluar',
                data: [15, 29, 8, 10, 5, 6],
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2
            }]
        }
    });

    var ctx2 = document.getElementById('userActivityChart').getContext('2d');
    var userActivityChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Admin', 'User', 'Pelanggan'], // contoh data level pengguna
            datasets: [{
                label: 'Jumlah Login',
                data: [30, 45, 15], // contoh data dinamis
                backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'],
                borderWidth: 2
            }]
        }
    });
</script>

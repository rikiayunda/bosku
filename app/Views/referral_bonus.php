<div class="container mt-5">
    <h2 class="text-center mb-4">Referral & Bonus</h2>

    <!-- Informasi Umum tentang Program Referral -->
    <div class="alert alert-info">
        <h4>Bagaimana Program Referral Bekerja?</h4>
        <p>Undang teman-teman Anda untuk bergabung dan dapatkan bonus komisi setiap kali teman Anda melakukan transaksi pertama mereka. Semakin banyak teman yang Anda ajak, semakin besar bonus yang akan Anda terima!</p>
    </div>

    <!-- Form untuk Mengajak Teman -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Undang Teman Anda</h5>
        </div>
        <div class="card-body">
            <p>Gunakan kode referral Anda untuk mengajak teman-teman Anda bergabung. Mereka akan mendapatkan diskon atau bonus khusus saat mendaftar menggunakan kode referral ini!</p>
            <!-- <form action="<?= base_url('/referral/send-invite') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="friend_email">Email Teman</label>
                    <input type="email" name="friend_email" class="form-control" id="friend_email" placeholder="Masukkan email teman" required>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Undangan</button>
            </form> -->
        </div>
    </div>

    <!-- Tampilkan Kode Referral -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Kode Referral Anda</h5>
        </div>
        <div class="card-body">
            <p>Bagikan kode referral Anda dengan teman-teman Anda untuk mulai mengundang mereka:</p>
            <div class="input-group">
                <input type="text" class="form-control" value="<?= esc($referral_link) ?>" id="referral-link" readonly>
                <button class="btn btn-primary" onclick="copyReferral()">Salin</button>
            </div>
            <small class="text-muted">Bagikan kode referral Anda ke teman-teman dan dapatkan bonus setiap kali mereka bergabung!</small>
        </div>
    </div>

    <!-- Informasi Bonus Komisi -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Bonus Komisi</h5>
        </div>
        <div class="card-body">
            <h6>Bonus untuk Setiap Teman yang Bergabung</h6>
            <p>Untuk setiap teman yang Anda ajak bergabung dan melakukan transaksi pertama, Anda akan menerima bonus komisi sebesar:</p>
            <ul>
                <li>Komisi: Rp <strong>50,000</strong> per transaksi pertama teman Anda.</li>
            </ul>
            <h6>Status Komisi Anda:</h6>
            <p>Total Komisi yang Diperoleh: <strong>Rp <?= number_format($user['total_bonus'], 0, ',', '.') ?></strong></p>
        </div>
    </div>
</div>

<script>
    document.getElementById('copy-btn').addEventListener('click', function() {
        var copyText = document.querySelector('input[type="text"]');
        copyText.select();
        document.execCommand('copy');
        alert('Kode referral telah disalin!');
    });
</script>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <h2 class="text-primary text-center"><i class="fas fa-trophy"></i> Peringkat & Reward</h2>
    <p class="text-center">🎖 Daftar pengguna dengan total komisi tertinggi. Jadilah yang terbaik dan dapatkan reward eksklusif!</p>

    <hr>

    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Peringkat</th>
                    <th>Username</th>
                    <th>Total Komisi</th>
                    <th>Badge</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($topUsers)): ?>
                    <tr>
                        <td colspan="4">Belum ada data leaderboard.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($topUsers as $index => $user): ?>
                        <tr>
                            <td>
                                <?php if ($index == 0): ?>
                                    🥇
                                <?php elseif ($index == 1): ?>
                                    🥈
                                <?php elseif ($index == 2): ?>
                                    🥉
                                <?php else: ?>
                                    <?= $index + 1; ?>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($user['username']); ?></td>
                            <td>Rp <?= number_format($user['total_komisi'], 0, ',', '.'); ?></td>
                            <td>
                                <?php if ($user['total_komisi'] >= 1000000): ?>
                                    <span class="badge badge-danger">Elite</span>
                                <?php elseif ($user['total_komisi'] >= 500000): ?>
                                    <span class="badge badge-warning">Gold</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Silver</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <hr>

    <h3 class="text-success text-center"><i class="fas fa-gift"></i> Reward untuk Pengguna Teratas</h3>
    <p class="text-center">🔥 Pengguna dengan peringkat tertinggi berhak mendapatkan hadiah eksklusif setiap bulannya!</p>
    
    <ul class="list-group">
        <li class="list-group-item"><i class="fas fa-star"></i> 🥇 **Juara 1** - Bonus Rp 500.000 + Merchandise Eksklusif</li>
        <li class="list-group-item"><i class="fas fa-star"></i> 🥈 **Juara 2** - Bonus Rp 300.000</li>
        <li class="list-group-item"><i class="fas fa-star"></i> 🥉 **Juara 3** - Bonus Rp 150.000</li>
        <li class="list-group-item"><i class="fas fa-star"></i> ⭐ **Peringkat 4-10** - Hadiah Misteri</li>
    </ul>

    <p class="text-center mt-4">💡 **Tips:** Ajak teman untuk bergabung dan aktif menyelesaikan misi untuk naik peringkat lebih cepat!</p>
</div>
<?= $this->endSection(); ?>

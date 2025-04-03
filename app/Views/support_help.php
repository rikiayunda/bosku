
<div class="container mt-5">
    <h2 class="text-primary"><i class="fas fa-life-ring"></i> Support & Bantuan – Zona Belanja</h2>
    <p>Selamat datang di halaman Support & Bantuan Zona Belanja! Kami siap membantu Anda dalam menggunakan platform ini dengan mudah dan nyaman.</p>

    <hr>

    <h3 class="text-success"><i class="fas fa-question-circle"></i> Pertanyaan yang Sering Diajukan (FAQ)</h3>

    <div class="accordion" id="faqAccordion">
        <?php 
        $faqs = [
            "Apa itu Zona Belanja?" => "Zona Belanja adalah platform yang membantu seller baru di Shopee meningkatkan transaksi melalui sistem simulasi pembelian. Pengguna mendapatkan pengembalian modal 100% dan komisi tambahan.",
            "Bagaimana cara mengikuti misi pembelian?" => "✅ Masuk ke akun dan pilih menu Mission.<br>✅ Pilih misi yang tersedia dan ikuti petunjuk pembelian di Shopee.<br>✅ Lakukan pembelian menggunakan dana pribadi terlebih dahulu.<br>✅ Setelah transaksi dikonfirmasi, dana dikembalikan dan komisi masuk ke saldo.",
            "Berapa lama saldo dikembalikan setelah misi?" => "Proses pengembalian dana dan komisi biasanya memakan waktu 1x24 jam setelah transaksi diverifikasi.",
            "Bagaimana cara menarik saldo saya?" => "✅ Masuk ke menu Tarik Saldo.<br>✅ Masukkan jumlah saldo yang ingin ditarik.<br>✅ Pilih metode pembayaran (transfer bank/e-wallet).<br>✅ Tunggu proses pencairan (maksimal 1x24 jam).",
            "Kenapa saldo belum masuk setelah penarikan?" => "Jika saldo belum masuk setelah 24 jam, silakan hubungi tim support dengan menyertakan bukti transaksi dan nomor rekening/e-wallet tujuan."
        ];
        ?>

        <?php $i = 1; foreach ($faqs as $question => $answer): ?>
        <div class="card">
            <div class="card-header" id="faq<?= $i ?>">
                <h5 class="mb-0">
                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#answer<?= $i ?>">
                        💡 <?= $question ?>
                    </button>
                </h5>
            </div>
            <div id="answer<?= $i ?>" class="collapse" data-parent="#faqAccordion">
                <div class="card-body">
                    <?= $answer ?>
                </div>
            </div>
        </div>
        <?php $i++; endforeach; ?>
    </div>

    <hr>

    <h3 class="text-info"><i class="fas fa-headset"></i> Cara Menghubungi Support Zona Belanja</h3>
    <ul class="list-group">
        <li class="list-group-item">
            📌 <strong>Live Chat:</strong> Klik ikon chat di pojok kanan bawah untuk bantuan instan.
        </li>
        <li class="list-group-item">
            📌 <strong>WhatsApp:</strong> <a href="#">Klik di sini untuk chat langsung</a>
        </li>
        <li class="list-group-item">
            📌 <strong>Email:</strong> <a href="mailto:support@zonabelanja.com">support@zonabelanja.com</a>
        </li>
        <li class="list-group-item">
            📌 <strong>Telegram:</strong> <a href="#">@ZonaBelanjaSupport</a>
        </li>
    </ul>

    <hr>

    <h4 class="text-center"><i class="fas fa-clock"></i> Jam Operasional Support</h4>
    <p class="text-center">
        🕘 <strong>Senin - Jumat:</strong> 08.00 - 22.00 WIB <br>
        🕘 <strong>Sabtu - Minggu:</strong> 10.00 - 20.00 WIB
    </p>

    <p class="text-center">Kami berkomitmen untuk memberikan pelayanan terbaik bagi pengguna Zona Belanja. 🚀</p>
</div>


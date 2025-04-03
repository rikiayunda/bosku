
<div class="container mt-5">
    <h2 class="text-primary"><i class="fas fa-book"></i> Panduan & FAQ Zona Belanja</h2>
    <p>Selamat datang di Zona Belanja! Kami hadir untuk membantu seller baru di Shopee mendapatkan penjualan pertama mereka sekaligus memberikan kesempatan kepada pengguna untuk mendapatkan komisi.</p>

    <hr>

    <h3 class="text-success"><i class="fas fa-book-open"></i> Panduan Penggunaan Zona Belanja</h3>

    <div class="accordion" id="guideAccordion">
        <!-- Cara Bergabung -->
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapseOne">
                        1️⃣ Cara Bergabung di Zona Belanja
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" data-parent="#guideAccordion">
                <div class="card-body">
                    <ol>
                        <li>Daftar akun di website Zona Belanja dengan mengisi data yang diperlukan.</li>
                        <li>Verifikasi akun melalui email atau nomor HP yang terdaftar.</li>
                        <li>Masuk ke dashboard untuk melihat daftar misi pembelian yang tersedia.</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Cara Melakukan Misi Pembelian -->
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo">
                        2️⃣ Cara Melakukan Misi Pembelian
                    </button>
                </h5>
            </div>

            <div id="collapseTwo" class="collapse" data-parent="#guideAccordion">
                <div class="card-body">
                    <ol>
                        <li>Pilih misi yang tersedia di halaman <strong>Mission</strong>.</li>
                        <li>Ikuti petunjuk pembelian yang diberikan, termasuk link produk dan harga pembelian.</li>
                        <li>Lakukan pembelian di Shopee sesuai instruksi.</li>
                        <li>Unggah bukti pembelian di Zona Belanja untuk diverifikasi.</li>
                        <li>Setelah transaksi dikonfirmasi, modal akan dikembalikan 100%, ditambah komisi.</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Cara Menarik Saldo -->
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseThree">
                        3️⃣ Cara Menarik Saldo Komisi
                    </button>
                </h5>
            </div>

            <div id="collapseThree" class="collapse" data-parent="#guideAccordion">
                <div class="card-body">
                    <ol>
                        <li>Masuk ke menu <strong>Tarik Saldo</strong>.</li>
                        <li>Masukkan jumlah saldo yang ingin dicairkan.</li>
                        <li>Pilih metode pencairan (transfer bank, e-wallet, dll.).</li>
                        <li>Konfirmasi dan tunggu proses pencairan dalam 1x24 jam kerja.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <h3 class="text-info"><i class="fas fa-question-circle"></i> FAQ (Pertanyaan yang Sering Diajukan)</h3>

    <div class="accordion" id="faqAccordion">
        <?php 
        $faqs = [
            "Apa itu Zona Belanja?" => "Zona Belanja adalah platform yang menghubungkan seller baru di Shopee dengan pengguna yang bersedia melakukan simulasi pembelian.",
            "Apakah barang yang dibeli akan dikirimkan?" => "Tidak, barang hanya untuk meningkatkan transaksi toko seller di Shopee. Pengguna tetap mendapatkan pengembalian modal dan komisi.",
            "Apakah saya bisa rugi saat mengikuti misi pembelian?" => "Tidak, karena modal dikembalikan 100% dan ada komisi tambahan.",
            "Berapa lama proses pengembalian modal dan komisi?" => "Pengembalian modal dalam 1x24 jam setelah transaksi diverifikasi, komisi langsung masuk ke saldo.",
            "Bagaimana cara menarik saldo komisi?" => "Masuk ke menu Tarik Saldo dan pilih metode pembayaran yang tersedia.",
            "Apakah ada biaya admin saat melakukan penarikan saldo?" => "Beberapa metode pencairan mungkin memiliki biaya admin kecil yang diinformasikan sebelum pencairan.",
            "Apakah saya bisa mengajak teman untuk bergabung?" => "Ya! Zona Belanja memiliki program referral dengan komisi tambahan.",
            "Bagaimana jika saya mengalami kendala?" => "Silakan hubungi tim Customer Support melalui menu Support & Bantuan."
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

    <h4 class="text-center"><i class="fas fa-envelope"></i> Hubungi Kami</h4>
    <p class="text-center">
        📩 Email: <a href="mailto:support@zonabelanja.com">support@zonabelanja.com</a><br>
        📞 WhatsApp: <a href="tel:+62812XXXXXXXX">+62 812XXXXXXXX</a>
    </p>
</div>

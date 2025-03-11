<div class="container">
    <h2>Formulir Deposit</h2>

    <form action="<?= base_url('deposit/submit') ?>" method="post">
        <?= csrf_field(); ?> <!-- Proteksi CSRF -->
        <input type="hidden" name="user_id" value="<?= session('user_id'); ?>">
        <!-- Pastikan user_id dikirim -->

        <div class="form-group">
            <label for="bank">Pilih Bank</label>
            <select id="bank" name="bank" class="form-control" onchange="updateRekening()" required>
                <option value="">Pilih Bank</option>
                <?php foreach ($banks as $bank): ?>
                    <option value="<?= $bank['bank_name'] ?>" data-rekening="<?= $bank['rekening'] ?>">
                        <?= $bank['bank_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="rekening">Nomor Rekening</label>
            <input type="text" id="rekening" name="rekening" class="form-control" readonly required>
        </div>

        <div class="form-group">
            <label for="nominal">Nominal</label>
            <input type="number" id="nominal" name="nominal" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Deposit</button>
    </form>
</div>

<script>
function updateRekening() {
    var bankSelect = document.getElementById("bank");
    var rekeningInput = document.getElementById("rekening");

    // Ambil nomor rekening dari atribut data-rekening
    var selectedOption = bankSelect.options[bankSelect.selectedIndex];
    rekeningInput.value = selectedOption.getAttribute("data-rekening");
}
</script>

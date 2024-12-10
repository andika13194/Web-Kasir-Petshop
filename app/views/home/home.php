<!-- Ringkasan Transaksi -->
<section class="summary">
    <div class="summary-item">
        <h3>Jumlah Transaksi</h3>
        <p><?= $data['summary']['total_transaksi'] ?? '0'; ?></p>
    </div>
    <div class="summary-item">
        <h3>Total Pendapatan</h3>
        <p>Rp <?= number_format($data['summary']['total_pendapatan'] ?? 0, 0, ',', '.'); ?></p>
    </div>
    <div class="summary-item">
        <h3>Jumlah Pelanggan</h3>
        <p><?= $data['summary']['total_transaksi'] ?? '0'; ?></p>
    </div>
</section>

<!-- Daftar Produk -->
<section class="products">
    <h3>Daftar Produk</h3>
    <div class="table-container">
        <table id="product-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['get_list_produk'] as $product): ?>
                <tr>
                    <td><img src="<?= BASE_URL; ?>assets/<?= $product['foto_produk']; ?>" class="product-image" alt="Gambar Produk <?= htmlspecialchars($product['nama_produk']); ?>"></td>
                    <td><?= htmlspecialchars($product['nama_produk']); ?></td>
                    <td><?= htmlspecialchars($product['nama_jenis_produk']); ?></td>
                    <td>Rp <?= number_format($product['harga'], 0, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($product['stok']); ?></td>
                    <td>
                        <a href="<?= BASE_URL . 'detail/' . htmlspecialchars($product['produk_id']); ?>" class="btn-viewDetail" aria-label="Lihat Detail Produk <?= htmlspecialchars($product['nama_produk']); ?>">Detail</a>
                        <a href="<?= BASE_URL . 'home/delete/' . htmlspecialchars($product['produk_id']); ?>" class="btn-delete" aria-label="Hapus Produk <?= htmlspecialchars($product['nama_produk']); ?>">Hapus</a>
                        <a href="<?= BASE_URL . 'ubahProduct/' . htmlspecialchars($product['produk_id']); ?>" class="btn-update" aria-label="Ubah Produk <?= htmlspecialchars($product['nama_produk']); ?>">Ubah</a>
                        <button class="btn-add" data-id="<?= $product['produk_id']; ?>" data-nama="<?= htmlspecialchars($product['nama_produk']); ?>" data-harga="<?= $product['harga']; ?>" aria-label="Tambah Produk ke Keranjang">Tambah</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Keranjang Belanja -->
<section class="cart">
    <h3>Keranjang Belanja</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            >
        </tbody>
    </table>
    <div class="cart-total">Total: Rp 0</div>
</section>

<!-- Pembayaran & Total -->
<section class="payment">
    <h3>Pembayaran</h3>
    <div class="total-payment">
        <p>Total Pembayaran: <strong id="total-amount">Rp 0</strong></p>
    </div>
    
    <p class="payment-method-title">Pilih Metode Pembayaran:</p>
    <div class="form-group">
        <label for="payment-method">Metode Pembayaran</label>
        <select class="input-field form-tambah payment-method" name="payment-method" id="payment-method" required>
            <option value="E Wallet">E Wallet</option>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="Tunai">Tunai</option>
        </select>
    </div>
    
    <button class="finish-transaction" aria-label="Selesaikan Transaksi" id="finish-transaction">Selesaikan Transaksi</button>
</section>


<!-- Modal untuk Input Jumlah Pembelian -->
<div id="addToCartModal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <span class="close-btn" aria-label="Tutup Modal">&times;</span>
        <h2>Tambah ke Keranjang</h2>
        <p id="product-name"></p>
        <input type="number" id="product-quantity" placeholder="Jumlah" min="1" required>
        <button id="confirm-add">Tambah</button>
    </div>
</div>

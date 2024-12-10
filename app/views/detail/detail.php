<!-- views/home/detail.php -->
<div class="product-detail-container">
    <div class="product-detail">
        <!-- Gambar Produk -->
        <div class="product-image">
            <img src="<?= BASE_URL . 'assets/' . htmlspecialchars($data['product']['foto_produk']); ?>" alt="Gambar Produk" class="product-img">
        </div>
        
        <!-- Informasi Produk -->
        <div class="product-info">
            <h2 class="product-title"><?= htmlspecialchars($data['product']['nama_produk']); ?></h2>
            <p class="product-category"><strong>Kategori:</strong> <?= htmlspecialchars($data['product']['nama_jenis_produk']); ?></p>
            <p class="product-price"><strong>Harga:</strong> Rp <?= number_format($data['product']['harga'], 0, ',', '.'); ?></p>
            <p class="product-stock"><strong>Stok:</strong> <?= htmlspecialchars($data['product']['stok']); ?> items</p>
            
            <!-- Tombol Kembali -->
            <a href="<?= BASE_URL . 'home'; ?>" class="btn-back">Kembali ke Daftar Produk</a>
        </div>
    </div>
</div>

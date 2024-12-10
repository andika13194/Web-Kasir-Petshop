<!-- Formulir Ubah Produk -->
<div class="product-edit-form">
    <h3>Ubah Data Produk</h3>

    <!-- Tampilkan Pesan Error -->
    <?php if (!empty($data['errors'])): ?>
        <div class="error-messages">
            <ul>
                <?php foreach ($data['errors'] as $error): ?>
                    <li><?= htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Formulir untuk Edit -->
    <form action="<?= BASE_URL; ?>ubahProduct/update" method="POST" enctype="multipart/form-data">
        <!-- ID Produk (hidden input) -->
        <input type="hidden" name="produk-id" value="<?= htmlspecialchars($data['product']['produk_id']); ?>">

        <!-- Nama Produk -->
        <div class="form-group">
            <label for="product-name">Nama Produk</label>
            <input 
                type="text" 
                id="product-name" 
                name="produk-nama_produk" 
                value="<?= htmlspecialchars($data['product']['nama_produk']); ?>" 
                placeholder="Masukkan nama produk" 
                required>
        </div>

        <!-- Kategori Produk -->
        <div class="form-group">
            <label for="product-category">Kategori</label>
            <select id="product-category" name="produk-id_jenis_barang" required>
                <?php foreach ($data['jenis_produk'] as $category): ?>
                    <option 
                        value="<?= $category['id_jenis_barang']; ?>" 
                        <?= $category['id_jenis_barang'] == $data['product']['id_jenis_barang'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($category['nama_jenis_produk']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Harga Produk -->
        <div class="form-group">
            <label for="product-price">Harga</label>
            <input 
                type="number" 
                id="product-price" 
                name="produk-harga" 
                value="<?= htmlspecialchars($data['product']['harga']); ?>" 
                placeholder="Masukkan harga" 
                required>
        </div>

        <!-- Stok Produk -->
        <div class="form-group">
            <label for="product-stock">Stok</label>
            <input 
                type="number" 
                id="product-stock" 
                name="produk-stok" 
                value="<?= htmlspecialchars($data['product']['stok']); ?>" 
                placeholder="Masukkan jumlah stok" 
                required>
        </div>

        <!-- Foto Produk -->
        <div class="form-group">
            <label for="product-image">Foto Produk</label>
            <input type="hidden" id="gambar-lama" name="gambar-lama" value="<?= htmlspecialchars($data['product']['foto_produk']); ?>">
            <input type="file" id="product-image" name="produk-image" accept="image/*">
            
            <!-- Tampilkan gambar saat ini jika ada -->
            <?php if (!empty($data['product']['foto_produk'])): ?>
                <div class="current-image">
                    <p>Foto saat ini:</p>
                    <img 
                        src="<?= BASE_URL . 'assets/' . htmlspecialchars($data['product']['foto_produk']); ?>" 
                        alt="Gambar Produk"
                        style="max-width: 200px; max-height: 200px; object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">
                    <p><em>Jika Anda tidak ingin mengubah foto, cukup tinggalkan kosong.</em></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Tombol Simpan -->
        <div class="form-group">
            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </div>
    </form>
</div>

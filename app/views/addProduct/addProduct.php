<!-- Formulir Tambah Produk -->
<div class="add-product form-tambah">
    <h3>Tambah Produk Baru</h3>

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

    <form action="<?= BASE_URL; ?>addProduct/add" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product-name">Nama Produk</label>
            <input type="text" class="input-field form-tambah" name="produk-nama_produk" placeholder="Masukkan nama produk" required>
        </div>
        <div class="form-group">
            <label for="product-category">Kategori</label>
            <select class="input-field form-tambah" name="produk-id_jenis_barang" required>
                <?php foreach ($data['jenis_produk'] as $category): ?>
                    <option value="<?= $category['id_jenis_barang']; ?>"><?= $category['nama_jenis_produk']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="product-price">Harga</label>
            <input type="number" name="produk-harga" class="input-field form-tambah" placeholder="Masukkan harga" required>
        </div>
        <div class="form-group">
            <label for="product-stock">Stok</label>
            <input type="number" name="produk-stok" class="input-field form-tambah" placeholder="Masukkan jumlah stok" required>
        </div>
        <div class="form-group">
            <label for="product-image">Foto Produk</label>
            <input type="file" name="produk-image" class="input-field form-tambah" accept="image/*" required>
        </div>
        <div class="form-group">
            <button type="submit" class="form-tambah">Tambah Produk</button>
        </div>
    </form>
</div>

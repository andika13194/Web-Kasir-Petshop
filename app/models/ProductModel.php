
<?php
class ProductModel extends Model {

    public function getCategories() {
        $query = "SELECT * FROM jenis_produk";
        $this->db->query($query);
        return $this->db->resultset();
    }

    public function getListProduk() {
        $query = "SELECT produk.*, jenis_produk.nama_jenis_produk
                  FROM produk
                  INNER JOIN jenis_produk ON produk.id_jenis_barang = jenis_produk.id_jenis_barang";
        $this->db->query($query);
        return $this->db->resultset();
    }
    
    public function addProduct($nama_produk, $harga, $stok, $id_jenis_barang, $image) {
        $query = "INSERT INTO produk (nama_produk, harga, stok, id_jenis_barang, foto_produk) 
                  VALUES (:nama_produk, :harga, :stok, :id_jenis_barang, :foto_produk)";
        $this->db->query($query);
        $this->db->bind(':nama_produk', $nama_produk);
        $this->db->bind(':harga', $harga);
        $this->db->bind(':stok', $stok);
        $this->db->bind(':id_jenis_barang', $id_jenis_barang);
        $this->db->bind(':foto_produk', $image);
        return $this->db->execute();
    }

    // Mengambil data produk berdasarkan produk_id
    public function getProductById($produk_id) {
        $query = "SELECT produk.*, jenis_produk.nama_jenis_produk
                  FROM produk
                  INNER JOIN jenis_produk ON produk.id_jenis_barang = jenis_produk.id_jenis_barang
                  WHERE produk.produk_id = :produk_id";
        $this->db->query($query);
        $this->db->bind(':produk_id', $produk_id);
        return $this->db->single();  // Mengembalikan satu hasil produk
    }

    public function updateProduct($id, $nama, $harga, $stok, $id_jenis_barang, $foto) {
        $query = "UPDATE produk SET nama_produk = :nama, harga = :harga, stok = :stok, id_jenis_barang = :id_jenis_barang, foto_produk = :foto_produk WHERE produk_id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->bind(':nama', $nama);
        $this->db->bind(':harga', $harga);
        $this->db->bind(':stok', $stok);
        $this->db->bind(':id_jenis_barang', $id_jenis_barang);
        $this->db->bind(':foto_produk', $foto);
        return $this->db->execute();
    }

    // Menghapus produk berdasarkan produk_id
    public function deleteProduct($produk_id) {
        // Hapus produk dari database
        $query = "DELETE FROM produk WHERE produk_id = :produk_id";
        $this->db->query($query);
        $this->db->bind(':produk_id', $produk_id);
        
        // Eksekusi query
        return $this->db->execute();
    }
}

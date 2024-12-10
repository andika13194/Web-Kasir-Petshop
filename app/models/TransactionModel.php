<?php
class TransactionModel extends Model {
    // Simpan transaksi
    public function addTransaction($userId, $totalHarga, $paymentMethod) {
        $query = "INSERT INTO transaksi (user_id, total_harga, payment_method) 
                  VALUES (:user_id, :total_harga, :payment_method)";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':total_harga', $totalHarga);
        $this->db->bind(':payment_method', $paymentMethod);
        $this->db->execute();
        return $this->db->lastInsertId(); // Dapatkan ID transaksi yang baru disimpan
    }

    // Simpan detail transaksi
    public function addTransactionDetail($transactionId, $productId, $quantity, $unitPrice, $totalPrice) {
        $query = "INSERT INTO detail_transaksi (transaction_id, produk_id, quantity, unit_price, total_price) 
                  VALUES (:transaction_id, :product_id, :quantity, :unit_price, :total_price)";
        $this->db->query($query);
        $this->db->bind(':transaction_id', $transactionId);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':unit_price', $unitPrice);
        $this->db->bind(':total_price', $totalPrice);
        return $this->db->execute();
    }

    public function checkProductStock($produkId, $quantity) {
        $query = "SELECT stok FROM produk WHERE produk_id = :produk_id";
        $this->db->query($query);
        $this->db->bind(':produk_id', $produkId);
        $result = $this->db->single();
    
        if ($result && $result['stok'] >= $quantity) {
            return true; // Stok cukup
        }
        return false; // Stok tidak cukup
    }

    public function updateProductStock($produkId, $quantity) {
        // Update stok barang berdasarkan produk_id
        $query = "UPDATE produk SET stok = stok - :quantity WHERE produk_id = :produk_id AND stok >= :quantity";
        $this->db->query($query);
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':produk_id', $produkId);
        
        return $this->db->execute();
    }

    // Fungsi untuk mendapatkan data ringkasan transaksi
    public function getTransactionSummary() {
        // Query untuk menghitung jumlah transaksi, total pendapatan, dan jumlah pelanggan unik
        $query = " SELECT  COUNT(*) AS total_transaksi, SUM(total_harga) AS total_pendapatan
            FROM transaksi
        ";

        $this->db->query($query);

        // Eksekusi dan kembalikan hasilnya
        return $this->db->single();
    }
}

<?php
class TransactionController extends Controller {

public function save() {
    // Cek apakah pengguna sudah terautentikasi
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'User tidak terautentikasi.']);
        return;
    }

    // Ambil data yang dikirimkan dari frontend (json)
    $data = json_decode(file_get_contents('php://input'), true);
    $paymentMethod = $data['paymentMethod'];
    $items = $data['items'];
    $userId = $_SESSION['user_id'];

    // Cek apakah stok barang cukup
    $TransactionModel = $this->model('TransactionModel');
    foreach ($items as $item) {
        $produkId = $item['id'];
        $quantity = $item['quantity'];

        // Cek apakah stok cukup untuk produk ini
        if (!$TransactionModel->checkProductStock($produkId, $quantity)) {
            echo json_encode(['success' => false, 'message' => 'Stok barang tidak cukup untuk produk ' . $item['name']]);
            return;
        }
    }

    // Hitung total pembayaran
    $totalPayment = array_reduce($items, function ($total, $item) {
        return $total + ($item['price'] * $item['quantity']);
    }, 0);

    // Simpan transaksi utama dan dapatkan transaction_id
    $transactionId = $TransactionModel->addTransaction($userId, $totalPayment, $paymentMethod);

    // Simpan detail transaksi dan update stok barang
    foreach ($items as $item) {
        $produkId = $item['id'];
        $quantity = $item['quantity'];
        $unitPrice = $item['price'];
        $totalPrice = $unitPrice * $quantity;

        // Simpan detail transaksi
        $TransactionModel->addTransactionDetail($transactionId, $produkId, $quantity, $unitPrice, $totalPrice);

        // Update stok barang setelah transaksi berhasil disimpan
        $TransactionModel->updateProductStock($produkId, $quantity);
    }

    // Kembalikan response JSON yang menandakan transaksi berhasil
    echo json_encode(['success' => true, 'transactionId' => $transactionId]);
}


}

<?php
class HomeController extends Controller {

    // Method untuk menampilkan halaman utama
    public function index() {
        // Pastikan user sudah login
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . 'login');
            exit;
        }
        // Ambil data ringkasan transaksi
        $TransactionModel = $this->model('TransactionModel');
        $summaryData = $TransactionModel->getTransactionSummary();

        // Ambil daftar produk dari database
        $ProductModel = $this->model('ProductModel');
        $listProduct = $ProductModel->getListProduk();

        // Panggil view dengan data produk
        $this->view('template/header');
        $this->view('home/home',$this->view('home/home', [
            'get_list_produk' => $listProduct,  // Data produk yang akan diubah
            'summary' => $summaryData
        ])
        );
        $this->view('template/footer');
    }

    // Fungsi untuk menghapus produk
    public function delete($id_barang) {

		if( $this->model('ProductModel')->deleteProduct($id_barang) > 0  ) {
			header('Location: ' . BASE_URL . '/home');
			exit;
		} else {
			header('Location: ' . BASE_URL . '/home');
			exit;
		}
	}

}

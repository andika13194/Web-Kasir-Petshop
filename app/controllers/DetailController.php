<?php
class DetailController extends Controller {

    // Method untuk menampilkan halaman detail produk
    public function index($produk_id) {
        // Pastikan user sudah login
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . 'login');
            exit;
        }

        // Ambil data produk berdasarkan produk_id
        $ProductModel = $this->model('ProductModel');
        $product = $ProductModel->getProductById($produk_id);

        // Pastikan produk ditemukan
        if ($product) {
            // Panggil view dengan data produk
            $this->view('template/header');
            $this->view('detail/detail', ['product' => $product]);
            $this->view('template/footer');
        } else {
            // Jika produk tidak ditemukan, arahkan ke halaman produk
            header("Location: " . BASE_URL . 'home');
            exit;
        }
    }
}
?>

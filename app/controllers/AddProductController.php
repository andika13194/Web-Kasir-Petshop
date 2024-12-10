<?php
class AddProductController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . 'login');
            exit;
        }

        // Ambil kategori produk dari database
        $ProductModel = $this->model('ProductModel');
        $categories = $ProductModel->getCategories();

        // Kirim kategori ke view
        $this->view('template/header');
        $this->view('addProduct/addProduct', ['jenis_produk' => $categories]);
        $this->view('template/footer');
    }

    public function add()
    {
        // Panggil model
        $ProductModel = $this->model('ProductModel');

        // Validasi dan ambil data dari form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_produk = trim($_POST['produk-nama_produk'] ?? '');
            $harga = floatval($_POST['produk-harga'] ?? 0);
            $stok = intval($_POST['produk-stok'] ?? 0);
            $id_jenis_barang = intval($_POST['produk-id_jenis_barang'] ?? 0);
            $error_messages = [];

            // Validasi input teks
            if (empty($nama_produk)) {
                $error_messages[] = "Nama produk tidak boleh kosong.";
            }
            if ($harga <= 0) {
                $error_messages[] = "Harga harus lebih besar dari 0.";
            }
            if ($stok < 0) {
                $error_messages[] = "Stok tidak boleh bernilai negatif.";
            }
            if ($id_jenis_barang <= 0) {
                $error_messages[] = "Kategori produk tidak valid.";
            }

            // Validasi file gambar
            if (isset($_FILES['produk-image']) && $_FILES['produk-image']['error'] == UPLOAD_ERR_OK) {
                $file = $_FILES['produk-image'];
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                $max_size = 2 * 1024 * 1024; // 2MB

                // Periksa ukuran file
                if ($file['size'] > $max_size) {
                    $error_messages[] = "Ukuran file gambar tidak boleh lebih dari 2MB.";
                }

                // Periksa tipe file
                $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                if (!in_array($file_extension, $allowed_extensions)) {
                    $error_messages[] = "Format file harus berupa JPG, JPEG, PNG, atau GIF.";
                }

                // Jika validasi berhasil, ganti nama file
                if (empty($error_messages)) {
                    $new_file_name = uniqid() . '.' . $file_extension;
                    $upload_directory = 'assets/';
                    $destination = $upload_directory . $new_file_name;

                    // Pastikan direktori tujuan ada
                    if (!is_dir($upload_directory)) {
                        mkdir($upload_directory, 0777, true);
                    }

                    // Pindahkan file yang diunggah
                    if (move_uploaded_file($file['tmp_name'], $destination)) {
                        $image = $new_file_name; // Simpan nama file baru
                    } else {
                        $error_messages[] = "Gagal mengunggah file.";
                    }
                }
            } else {
                $error_messages[] = "File gambar harus diunggah.";
            }

            // Tambah produk ke database jika tidak ada error
            if (empty($error_messages)) {
                if ($ProductModel->addProduct($nama_produk, $harga, $stok, $id_jenis_barang, $image)) {
                    header("Location: " . BASE_URL . "home"); // Redirect setelah berhasil menambah produk
                    exit;
                } else {
                    $error_messages[] = "Gagal menambahkan produk ke database.";
                }
            }

            // Kirim pesan kesalahan ke view jika ada
            $this->view('template/header');
            $this->view('addProduct/addProduct', [
                'errors' => $error_messages,
                'jenis_produk' => $ProductModel->getCategories()
            ]);
            $this->view('template/footer');
        }
    }
}

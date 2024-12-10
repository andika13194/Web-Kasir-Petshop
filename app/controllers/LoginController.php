<?php
class LoginController extends Controller {

    // Menampilkan halaman login
    public function index() {

        // Cek apakah user sudah login, jika ya, redirect ke home
        if (isset($_SESSION['user_id'])) {
            header("Location: " . BASE_URL . 'index');
            exit;
        }

        // Tampilkan halaman login
        $this->view('login/login');
    }

    // Proses login
    public function login() {
        // Mulai session jika belum dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Validasi input
            if (empty($username) || empty($password)) {
                $this->view('login/login', ['error' => 'Username dan password harus diisi']);
                return;
            }

            // Panggil model UserModel untuk mengecek login
            $userModel = $this->model('UserModel');
            $user = $userModel->login($username, $password);

            if ($user) {
                // Set session dan redirect ke halaman home
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['nama_user'];
                $_SESSION['role'] = $user['role']; // Menyimpan role jika diperlukan

                header("Location: " . BASE_URL . 'home');
                exit;
            } else {
                $this->view('login/login', ['error' => 'Username atau password salah']);
            }
        }
    }

    public function logout() {
        session_start();
    
        // Cek apakah session ada
        if (isset($_SESSION['user_id'])) {
            session_destroy(); // Hapus session
            header("Location: " . BASE_URL . "login");  // Redirect ke halaman login
            exit;
        } else {
            header("Location: " . BASE_URL . "login");  // Jika tidak ada session, redirect ke login
            exit;
        }
    }
    
}


<?php
class RegistrasiController extends Controller {

    public function index() {
        $this->view('registrasi/registrasi');
    }

    public function registrasi() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['konfirmasi_password'];
    
            // Validasi input
            if (empty($username) || empty($password) || empty($confirmPassword)) {
                $this->view('registrasi/registrasi', ['error' => 'Semua field harus diisi']);
                return;
            }
    
            if ($password !== $confirmPassword) {
                $this->view('registrasi/registrasi', ['error' => 'Password dan Konfirmasi Password tidak cocok']);
                return;
            }

            // Panggil model untuk registrasi
            $userModel = $this->model('UserModel');
            $isRegistered = $userModel->registrasiUser($username, $password);

            if ($isRegistered) {
                header('Location: ' . BASE_URL . 'login?message=success');
                exit;
            } else {
                $this->view('registrasi/registrasi', ['error' => 'Registrasi gagal. Username mungkin sudah terdaftar.']);
            }
        }
    }
}

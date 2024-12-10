<?php
class App
{
    protected $controller = 'LoginController'; // Default controller
    protected $method = 'index'; // Default method
    protected $params = []; // Default params

    public function __construct()
    {
        // Memulai session jika belum ada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $url = $this->parseURL(); // Ambil URL yang diminta

        // Jika sudah login, arahkan ke controller home
        if (isset($_SESSION['user_id'])) {
            $this->controller = 'HomeController';
        }

        // Tambahkan pengecekan untuk logout di URL
        if (isset($url[0]) && $url[0] == 'logout') {
            // Panggil method logout pada controller LoginController
            $this->controller = 'LoginController'; 
            $this->method = 'logout'; 
            unset($url[0]); // Hapus 'logout' dari URL
        }

        // Memeriksa jika controller ada di folder controllers
        if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller'; // Set controller sesuai URL
            unset($url[0]); // Hapus elemen pertama dari array URL
        }

        // Memuat file controller yang sesuai
        require_once '../app/controllers/' . $this->controller . '.php'; 
        $this->controller = new $this->controller;

        // Memeriksa jika method ada dalam controller
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1]; // Set method sesuai URL
            unset($url[1]); // Hapus elemen kedua dari array URL
        }

        // Memeriksa jika ada parameter tambahan
        $this->params = $url ? array_values($url) : []; 

        // Panggil method dan kirimkan parameter
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Fungsi untuk mem-parsing URL
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)); // Pisahkan URL
        }
    }
}

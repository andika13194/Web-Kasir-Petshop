<?php
class UserModel extends Model {

    // Proses login
    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE nama_user = :username LIMIT 1";
        $this->db->query($query);
        $this->db->bind(':username', $username);
        $user = $this->db->single();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        // Tambahkan log jika login gagal
        error_log("Login failed for username: $username");
        return false;
    }

    // Proses registrasi user baru
    public function registrasiUser($username, $password) {
        // Cek apakah username sudah ada
        $this->db->query('SELECT * FROM users WHERE nama_user = :username');
        $this->db->bind(':username', $username);
        $result = $this->db->single();

        if ($result) {
            return false; // Username sudah terdaftar
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Simpan user baru
        $this->db->query('INSERT INTO users (nama_user, password, role) VALUES (:username, :password, :role)');
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':role', 'karyawan');

        if ($this->db->execute()) {
            return true;
        }

    }
}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - PetShop</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
</head>
<body class="bodyLogin">
    <div class="login-container">
        <form method="post" action="<?= BASE_URL; ?>registrasi/registrasi" class="login-form">
            <h1>Registrasi</h1>

            <div class="input-group input-groupLogin">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="input-group input-groupLogin">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="input-group input-groupLogin">
                <label for="konfirmasi_password">Konfirmasi Password:</label>
                <input type="password" id="password" name="konfirmasi_password" required>
            </div>

            <button type="submit" class="btn-masuk">Registrasi</button>
            <p class="register-link">Sudah punya akun? <a href="<?= BASE_URL; ?>login">Login</a></p>
        </form>
    </div>
</body>
</html>

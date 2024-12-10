<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - PetShop</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>css/style.css">
</head>
<body class="bodyLogin">
    <div class="login-container">
        <form method="post" action="<?= BASE_URL; ?>login/login" class="login-form">
            <h1 class="h1Login">LOGIN</h1>

            <div class="input-group input-groupLogin">
                <label class= "label-login" for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="input-group input-groupLogin">
                <label class= "label-login" for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-submit btn-masuk">Masuk</button>

            <?php if (isset($data['error'])): ?>
                <p class="error-message"><?= $data['error']; ?></p>
            <?php endif; ?>

            <p class="register-link">Belum punya akun? <a href="<?= BASE_URL; ?>registrasi">Registrasi</a></p>
        </form>
    </div>
</body>
</html>

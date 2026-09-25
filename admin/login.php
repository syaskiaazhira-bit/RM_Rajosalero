<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | RM Rajo Salero</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="login.css">
</head>

<body>

    <div class="login-page">

        <div class="login-card">

            <div class="brand">
                <div class="brand-mark">RS</div>

                <h1>RM Rajo Salero</h1>
                <p>Admin Management System</p>
            </div>

            <div class="divider"></div>

            <div class="login-heading">
                <h2>Selamat Datang</h2>
                <p>Silakan masuk untuk mengakses dashboard admin.</p>
            </div>

            <form action="login_process.php" method="POST">

                <div class="form-group">
                    <label for="username">Username</label>

                    <div class="input-box">
                        <span class="input-icon">👤</span>

                        <input 
                            type="text" 
                            id="username"
                            name="username"
                            placeholder="Masukkan username"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <div class="input-box">
                        <span class="input-icon">🔒</span>

                        <input 
                            type="password" 
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                        >

                        <button 
                            type="button" 
                            class="show-password"
                            onclick="togglePassword()"
                        >
                            👁
                        </button>
                    </div>
                </div>

                <button type="submit" class="login-button">
                    Masuk sebagai Admin
                </button>

            </form>

            <a href="../index.php" class="back-home">
                Kembali ke Website
            </a>

        </div>

        <div class="login-footer">
            © 2026 RM Rajo Salero
        </div>

    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");

            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
    </script>

</body>
</html>
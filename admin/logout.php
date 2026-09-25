<?php

session_start();

require_once 'database.php';


/* ==========================================
   JIKA SUDAH LOGIN
========================================== */

if (isset($_SESSION['admin_id'])) {

    header("Location: dashboard.php");
    exit;

}


/* ==========================================
   PROSES LOGIN
========================================== */

$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';


    if ($username === '' || $password === '') {

        $error = 'Username dan password wajib diisi.';

    } else {


        $stmt = mysqli_prepare(
            $conn,
            "SELECT id, nama, username, password
             FROM admin
             WHERE username = ?
             LIMIT 1"
        );


        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $username
        );


        mysqli_stmt_execute($stmt);


        $result = mysqli_stmt_get_result($stmt);


        $admin = mysqli_fetch_assoc($result);


        if ($admin && password_verify($password, $admin['password'])) {


            session_regenerate_id(true);


            $_SESSION['admin_id'] = $admin['id'];

            $_SESSION['admin_name'] = $admin['nama'];

            $_SESSION['admin_username'] = $admin['username'];

            $_SESSION['admin_role'] = 'admin';


            header("Location: dashboard.php");

            exit;


        } else {

            $error = 'Username atau password salah.';

        }


        mysqli_stmt_close($stmt);

    }

}

?>


<!DOCTYPE html>

<html lang="id">


<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Login Admin | RM Rajo Salero
</title>


<link rel="preconnect" href="https://fonts.googleapis.com">

<link
    rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin
>


<link
    href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Montserrat:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>


<link rel="stylesheet" href="dashboard.css">


<style>

* {
    box-sizing: border-box;
}


body {

    margin: 0;

    min-height: 100vh;

    background:
        linear-gradient(
            rgba(67, 20, 20, .08),
            rgba(67, 20, 20, .08)
        ),
        #f7f3ed;

    font-family: 'Montserrat', sans-serif;

    color: #24150f;

}


.login-wrapper {

    min-height: 100vh;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 30px;

}


.login-card {

    width: 100%;

    max-width: 450px;

    background: #fffdf9;

    border: 1px solid #eadfd5;

    border-radius: 28px;

    padding: 45px;

    box-shadow:
        0 20px 50px rgba(70, 30, 20, .10);

}


.login-logo {

    width: 72px;

    height: 72px;

    border-radius: 50%;

    background: #a51d1d;

    color: #f7d98d;

    border: 3px solid #d5aa57;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 0 auto 20px;

    font-family: 'Cormorant Garamond', serif;

    font-size: 30px;

    font-weight: 700;

}


.login-brand {

    text-align: center;

}


.login-brand h1 {

    margin: 0;

    font-family: 'Cormorant Garamond', serif;

    font-size: 38px;

    color: #7f1919;

}


.login-brand p {

    margin: 7px 0 30px;

    color: #927f72;

    font-size: 13px;

}


.login-error {

    background: #f9e1df;

    color: #9a1d1d;

    border: 1px solid #efc4c0;

    border-radius: 12px;

    padding: 13px 15px;

    margin-bottom: 20px;

    font-size: 13px;

}


.form-group {

    margin-bottom: 20px;

}


.form-group label {

    display: block;

    margin-bottom: 8px;

    font-size: 13px;

    font-weight: 600;

    color: #5c4a40;

}


.form-group input {

    width: 100%;

    height: 50px;

    padding: 0 15px;

    border: 1px solid #ded1c6;

    border-radius: 12px;

    background: #fff;

    font-family: 'Montserrat', sans-serif;

    font-size: 14px;

    outline: none;

}


.form-group input:focus {

    border-color: #a51d1d;

    box-shadow: 0 0 0 3px rgba(165, 29, 29, .08);

}


.login-button {

    width: 100%;

    height: 52px;

    border: none;

    border-radius: 13px;

    background: #a51d1d;

    color: white;

    font-family: 'Montserrat', sans-serif;

    font-size: 14px;

    font-weight: 700;

    cursor: pointer;

}


.login-button:hover {

    background: #831616;

}


.back-home {

    display: block;

    text-align: center;

    margin-top: 22px;

    color: #8f201e;

    text-decoration: none;

    font-size: 13px;

}


</style>


</head>


<body>


<div class="login-wrapper">


<div class="login-card">


<div class="login-brand">


<div class="login-logo">
RS
</div>


<h1>
RM Rajo Salero
</h1>


<p>
Admin Management System
</p>


</div>


<?php if ($error !== ''): ?>

<div class="login-error">

<?= htmlspecialchars($error); ?>

</div>

<?php endif; ?>


<form method="POST">


<div class="form-group">

<label for="username">
Username
</label>


<input
    type="text"
    id="username"
    name="username"
    placeholder="Masukkan username"
    autocomplete="username"
    required
>


</div>


<div class="form-group">

<label for="password">
Password
</label>


<input
    type="password"
    id="password"
    name="password"
    placeholder="Masukkan password"
    autocomplete="current-password"
    required
>


</div>


<button
    type="submit"
    class="login-button"
>
Masuk ke Dashboard
</button>


</form>


<a
    href="../index.php"
    class="back-home"
>
← Kembali ke Website
</a>


</div>


</div>


</body>

</html>
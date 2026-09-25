<?php

session_start();


if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");

    exit;

}


require_once 'database.php';


$admin_id = (int) $_SESSION['admin_id'];


$success = '';

$error = '';



/* ==========================================
   AMBIL DATA ADMIN
========================================== */

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, nama, username
     FROM admin
     WHERE id = ?
     LIMIT 1"
);


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $admin_id
);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


$admin = mysqli_fetch_assoc($result);


mysqli_stmt_close($stmt);



if (!$admin) {

    session_destroy();

    header("Location: login.php");

    exit;

}



/* ==========================================
   UPDATE PROFIL
========================================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $nama = trim($_POST['nama'] ?? '');

    $username = trim($_POST['username'] ?? '');

    $password_baru = $_POST['password_baru'] ?? '';

    $konfirmasi_password = $_POST['konfirmasi_password'] ?? '';



    if ($nama === '' || $username === '') {

        $error = 'Nama dan username wajib diisi.';

    }


    elseif ($password_baru !== $konfirmasi_password) {

        $error = 'Konfirmasi password tidak sama.';

    }


    else {


        /* CEK USERNAME */

        $check = mysqli_prepare(
            $conn,
            "SELECT id
             FROM admin
             WHERE username = ?
             AND id != ?
             LIMIT 1"
        );


        mysqli_stmt_bind_param(
            $check,
            "si",
            $username,
            $admin_id
        );


        mysqli_stmt_execute($check);


        $check_result = mysqli_stmt_get_result($check);


        $username_exists = mysqli_fetch_assoc($check_result);


        mysqli_stmt_close($check);



        if ($username_exists) {

            $error = 'Username tersebut sudah digunakan admin lain.';

        } else {


            /* ==================================
               UPDATE DENGAN PASSWORD
            ================================== */

            if ($password_baru !== '') {


                $password_hash = password_hash(
                    $password_baru,
                    PASSWORD_DEFAULT
                );


                $update = mysqli_prepare(
                    $conn,
                    "UPDATE admin
                     SET nama = ?,
                         username = ?,
                         password = ?
                     WHERE id = ?"
                );


                mysqli_stmt_bind_param(
                    $update,
                    "sssi",
                    $nama,
                    $username,
                    $password_hash,
                    $admin_id
                );


            }

            /* ==================================
               UPDATE TANPA PASSWORD
            ================================== */

            else {


                $update = mysqli_prepare(
                    $conn,
                    "UPDATE admin
                     SET nama = ?,
                         username = ?
                     WHERE id = ?"
                );


                mysqli_stmt_bind_param(
                    $update,
                    "ssi",
                    $nama,
                    $username,
                    $admin_id
                );

            }



            if (mysqli_stmt_execute($update)) {


                $_SESSION['admin_name'] = $nama;

                $_SESSION['admin_username'] = $username;


                $admin['nama'] = $nama;

                $admin['username'] = $username;


                $success = 'Profil admin berhasil diperbarui.';


            } else {


                $error = 'Gagal memperbarui profil.';

            }


            mysqli_stmt_close($update);

        }

    }

}

?>


<!DOCTYPE html>

<html lang="id">


<head>


<meta charset="UTF-8">


<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>


<title>
Profil Admin | RM Rajo Salero
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


<link rel="stylesheet" href="profil.css">


</head>


<body>


<div class="admin-layout">


<?php include 'sidebar.php'; ?>


<main class="main-content">


<header class="topbar">


<div>


<p class="breadcrumb">
Admin / Profil
</p>


<h1>
Profil Admin
</h1>


<p class="welcome">
Kelola informasi akun administrator RM Rajo Salero.
</p>


</div>


</header>



<section class="profile-page">


<div class="profile-card">


<div class="profile-card-header">


<div class="profile-big-avatar">
<?= strtoupper(substr($admin['nama'], 0, 1)); ?>
</div>


<div>


<span class="profile-label">
ADMINISTRATOR
</span>


<h2>
<?= htmlspecialchars($admin['nama']); ?>
</h2>


<p>
@<?= htmlspecialchars($admin['username']); ?>
</p>


</div>


</div>



<?php if ($success !== ''): ?>


<div class="profile-alert success">

<?= htmlspecialchars($success); ?>

</div>


<?php endif; ?>



<?php if ($error !== ''): ?>


<div class="profile-alert error">

<?= htmlspecialchars($error); ?>

</div>


<?php endif; ?>



<form
    method="POST"
    class="profile-form"
>


<div class="form-group">


<label for="nama">
Nama Admin
</label>


<input
    type="text"
    id="nama"
    name="nama"
    value="<?= htmlspecialchars($admin['nama']); ?>"
    required
>


</div>



<div class="form-group">


<label for="username">
Username
</label>


<input
    type="text"
    id="username"
    name="username"
    value="<?= htmlspecialchars($admin['username']); ?>"
    required
>


</div>



<div class="profile-divider"></div>



<div class="password-heading">

<h3>
Ubah Password
</h3>

<p>
Kosongkan jika tidak ingin mengganti password.
</p>

</div>



<div class="form-row">


<div class="form-group">


<label for="password_baru">
Password Baru
</label>


<input
    type="password"
    id="password_baru"
    name="password_baru"
    placeholder="Masukkan password baru"
>


</div>



<div class="form-group">


<label for="konfirmasi_password">
Konfirmasi Password
</label>


<input
    type="password"
    id="konfirmasi_password"
    name="konfirmasi_password"
    placeholder="Ulangi password baru"
>


</div>


</div>



<div class="profile-actions">


<a
    href="dashboard.php"
    class="btn-profile cancel"
>
Kembali
</a>


<button
    type="submit"
    class="btn-profile save"
>
Simpan Perubahan
</button>


</div>


</form>


</div>


</section>



<footer class="admin-footer">

© 2026 RM Rajo Salero · Admin Management System

</footer>


</main>


</div>


</body>

</html>
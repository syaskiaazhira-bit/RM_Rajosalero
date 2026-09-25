<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$admin_username = $_SESSION['admin_username'] ?? 'Admin';

$admin_username = $_SESSION['admin_username'] ?? 'Admin';


// koneksi database
require_once "database.php";


// ambil menu dari database

$query = "SELECT * FROM menu ORDER BY id DESC";

$result = mysqli_query($conn, $query);


$menus = [];


while($row = mysqli_fetch_assoc($result)){

    $menus[] = [

        'id' => $row['id'],

        'nama' => $row['nama_menu'],

        'kategori' => $row['kategori'],

        'harga' => $row['harga'],

        'gambar' => $row['gambar'],

        'deskripsi' => $row['deskripsi'],

        'status' => $row['status']

    ];

}


$total_menu = count($menus);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produk | RM Rajo Salero</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="produk.css">
</head>

<body>

<div class="admin-layout">

    <!-- SIDEBAR -->
    <?php include 'sidebar.php'; ?>

    <!-- MAIN -->
    <main class="main-content">

        <header class="topbar">

            <div>
                <p class="breadcrumb">Admin / Produk</p>

                <h1>Produk & Menu</h1>

                <p class="welcome">
                    Kelola seluruh menu yang tersedia di RM Rajo Salero.
                </p>
            </div>

           <a href="tambah_produk.php" class="add-product-btn">
            + Tambah Produk
            </a>
        </header>


        <!-- SUMMARY -->
        <section class="product-summary">

            <div class="product-summary-card">
                <span>Total Menu</span>
                <strong><?= $total_menu; ?></strong>
            </div>

            <div class="product-summary-card">
                <span>Kategori</span>
                <strong>5</strong>
            </div>

            <div class="product-summary-card">
                <span>Menu Aktif</span>
                <strong><?= $total_menu; ?></strong>
            </div>

            <div class="product-summary-card">
                <span>Menu Nonaktif</span>
                <strong>0</strong>
            </div>

        </section>


        <!-- TOOLBAR -->
        <section class="product-toolbar">

            <div class="search-box">

                <span>⌕</span>

                <input
                    type="text"
                    id="searchMenu"
                    placeholder="Cari nama menu..."
                >

            </div>

            <div class="category-filter">

                <button class="filter-btn active" data-category="all">
                    Semua
                </button>

                <button class="filter-btn" data-category="Paket Nasi Padang">
                    Paket Nasi
                </button>

                <button class="filter-btn" data-category="Lauk Utama">
                    Lauk Utama
                </button>

                <button class="filter-btn" data-category="Gulai & Masakan Berkuah">
                    Gulai
                </button>

                <button class="filter-btn" data-category="Lauk Tambahan">
                    Tambahan
                </button>

                <button class="filter-btn" data-category="Minuman">
                    Minuman
                </button>

            </div>

        </section>


        <!-- PRODUCT GRID -->
        <section class="product-grid" id="productGrid">

            <?php foreach ($menus as $index => $menu): ?>

                <article
                    class="product-card"
                    data-category="<?= htmlspecialchars($menu['kategori']); ?>"
                    data-name="<?= strtolower(htmlspecialchars($menu['nama'])); ?>"
                >

                    <div class="product-image">

                        <img
                            src="<?= htmlspecialchars($menu['gambar']); ?>"
                            alt="<?= htmlspecialchars($menu['nama']); ?>"
                            onerror="this.style.display='none'; this.parentElement.classList.add('image-error');"
                        >

                        <span class="product-status">
                            Aktif
                        </span>

                    </div>


                    <div class="product-info">

                        <span class="product-category">
                            <?= htmlspecialchars($menu['kategori']); ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars($menu['nama']); ?>
                        </h3>

                        <div class="product-bottom">

                            <strong>
                                Rp<?= number_format($menu['harga'], 0, ',', '.'); ?>
                            </strong>

                            <div class="product-actions">

                                <a
    href="edit_produk.php?id=<?= $menu['id']; ?>"
    class="edit-btn"
    title="Edit"
>
    ✎
</a>

                                <a
    <a
    href="hapus_produk.php?id=<?= $menu['id']; ?>"
    class="delete-btn"
    title="Hapus"
    onclick="return confirm('Yakin ingin menghapus menu ini?')"
>
    🗑️
</a>

                            </div>

                        </div>

                    </div>

                </article>

            <?php endforeach; ?>

        </section>


        <div class="no-result" id="noResult">

            <div>🍽</div>

            <h3>Menu tidak ditemukan</h3>

            <p>
                Coba gunakan kata kunci atau kategori yang berbeda.
            </p>

        </div>


        <footer class="admin-footer">
            © 2026 RM Rajo Salero · Admin Management System
        </footer>

    </main>

</div>


<script>

const searchInput = document.getElementById('searchMenu');
const cards = document.querySelectorAll('.product-card');
const filterButtons = document.querySelectorAll('.filter-btn');
const noResult = document.getElementById('noResult');

let selectedCategory = 'all';

function filterProducts() {

    const keyword = searchInput.value.toLowerCase().trim();

    let visibleCount = 0;

    cards.forEach(card => {

        const name = card.dataset.name;
        const category = card.dataset.category;

        const matchName = name.includes(keyword);

        const matchCategory =
            selectedCategory === 'all' ||
            category === selectedCategory;

        if (matchName && matchCategory) {

            card.style.display = '';

            visibleCount++;

        } else {

            card.style.display = 'none';

        }

    });

    noResult.style.display =
        visibleCount === 0 ? 'block' : 'none';
}


searchInput.addEventListener('input', filterProducts);


filterButtons.forEach(button => {

    button.addEventListener('click', function() {

        filterButtons.forEach(btn =>
            btn.classList.remove('active')
        );

        this.classList.add('active');

        selectedCategory = this.dataset.category;

        filterProducts();

    });

});

</script>

</body>
</html>
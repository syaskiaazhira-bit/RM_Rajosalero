<?php

$current_page = basename($_SERVER['PHP_SELF']);

$admin_name = $_SESSION['admin_name'] ?? 'Admin';

$admin_username = $_SESSION['admin_username'] ?? 'admin';

?>


<aside class="sidebar">


    <!-- BRAND -->

    <div class="brand-admin">


        <div class="brand-logo">
            RS
        </div>


        <div>

            <h2>
                RM Rajo Salero
            </h2>

            <span>
                ADMIN PANEL
            </span>

        </div>


    </div>



    <!-- MENU -->

    <nav class="sidebar-menu">


        <a
            href="dashboard.php"
            class="menu-item <?= $current_page === 'dashboard.php' ? 'active' : ''; ?>"
        >

            <span class="menu-icon">
                ▦
            </span>

            <span>
                Dashboard
            </span>

        </a>



        <a
            href="produk.php"
            class="menu-item <?= $current_page === 'produk.php' ? 'active' : ''; ?>"
        >

            <span class="menu-icon">
                🍽
            </span>

            <span>
                Produk
            </span>

        </a>



        <a
            href="pesanan.php"
            class="menu-item <?= $current_page === 'pesanan.php' ? 'active' : ''; ?>"
        >

            <span class="menu-icon">
                🧾
            </span>

            <span>
                Pesanan
            </span>

        </a>



        <a
            href="bahan_baku.php"
            class="menu-item <?= $current_page === 'bahan_baku.php' ? 'active' : ''; ?>"
        >

            <span class="menu-icon">
                📦
            </span>

            <span>
                Bahan Baku
            </span>

        </a>



        <a
            href="pembayaran.php"
            class="menu-item <?= $current_page === 'pembayaran.php' ? 'active' : ''; ?>"
        >

            <span class="menu-icon">
                💳
            </span>

            <span>
                Pembayaran
            </span>

        </a>



        <a
            href="keuangan.php"
            class="menu-item <?= $current_page === 'keuangan.php' ? 'active' : ''; ?>"
        >

            <span class="menu-icon">
                💰
            </span>

            <span>
                Keuangan
            </span>

        </a>



        <a
            href="sdm.php"
            class="menu-item <?= $current_page === 'sdm.php' ? 'active' : ''; ?>"
        >

            <span class="menu-icon">
                👥
            </span>

            <span>
                SDM
            </span>

        </a>



        <a
            href="laporan.php"
            class="menu-item <?= $current_page === 'laporan.php' ? 'active' : ''; ?>"
        >

            <span class="menu-icon">
                📊
            </span>

            <span>
                Laporan
            </span>

        </a>


    </nav>



    <!-- BOTTOM -->

    <div class="sidebar-bottom">


        <!-- PROFILE -->

        <a
            href="profil.php"
            class="admin-profile"
            style="text-decoration:none; color:inherit;"
        >


            <div class="profile-avatar">

                <?= strtoupper(substr($admin_name, 0, 1)); ?>

            </div>


            <div class="profile-info">


                <strong>

                    <?= htmlspecialchars($admin_name); ?>

                </strong>


                <span>

                    <?= htmlspecialchars($admin_username); ?>

                </span>


            </div>


        </a>



        <!-- LOGOUT -->

        <a
            href="logout.php"
            class="logout"
        >

            <span>
                ↪
            </span>

            Logout

        </a>


    </div>


</aside>
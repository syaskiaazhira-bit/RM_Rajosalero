<?php

require_once "admin/database.php";


$query = mysqli_query(
    $conn,
    "SELECT * FROM menu WHERE status='aktif'"
);


$menus = [];


while($row = mysqli_fetch_assoc($query)){


    switch($row['kategori']){

        case "Paket Nasi Padang":
            $kategori = "paket";
            break;

        case "Lauk Utama":
            $kategori = "lauk";
            break;

        case "Gulai & Masakan Berkuah":
            $kategori = "gulai";
            break;

        case "Lauk Tambahan":
            $kategori = "tambahan";
            break;

        case "Minuman":
            $kategori = "minuman";
            break;

        default:
            $kategori = "lainnya";

    }



    $menus[] = [

        "id" => $row['id'],
        "nama" => $row['nama_menu'],
        "harga" => (int)$row['harga'],
        "kategori" => $kategori,
        "gambar" => basename($row['gambar']),
        "deskripsi" => $row['deskripsi']

    ];


}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RM Rajo Salero</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <nav class="navbar">
        <div class="logo">RM Rajo Salero</div>

        <div class="nav-links">
            <a href="#home" onclick="tutupPesananDashboard()">Home</a>
            <a href="#kategori" onclick="scrollToKategori(event)">Menu</a>
            <a href="#pesanan" onclick="bukaPesananSection(event)">
    Pesanan
    <span id="pesananBadge" class="pesanan-badge">0</span>
</a>
            <a href="#tentang" onclick="tutupPesananDashboard()">Tentang</a>
        </div>
    </nav>


    <!-- ================= SLIDER ================= -->

    <section class="hero" id="home">

        <div class="slider">

            <div class="slider-track">

                <!-- CLONE SLIDE 3 -->
                <div class="slide" style="background-image: url('images/banner3.jpg');">
                    <div class="slide-overlay"></div>

                    <div class="slide-content">
                        <h1>Cita Rasa Khas Minang</h1>
                        <p>
                            Lengkapi hidangan dengan paket nasi Padang
                            yang praktis dan lezat.
                        </p>

                        <button onclick="tampilkanKategori('paket')">
                            Lihat Paket
                        </button>
                    </div>
                </div>

                <!-- SLIDE 1 -->
                <div class="slide" style="background-image: url('images/banner1.jpg');">
                    <div class="slide-overlay"></div>

                    <div class="slide-content">
                        <h1>
                            Selamat Datang di
                            <span>RM Rajo Salero</span>
                        </h1>
                        <p>
                            Nikmati cita rasa masakan khas Minang dengan
                            pilihan menu yang lengkap dan menggugah selera.
                        </p>

                        <button onclick="scrollToKategori()">
                            Lihat Kategori Menu
                        </button>
                    </div>
                </div>

                <!-- SLIDE 2 -->
                <div class="slide" style="background-image: url('images/banner2.jpg');">
                    <div class="slide-overlay"></div>

                    <div class="slide-content">
                        <h1>Menu Favorit Minang</h1>
                        <p>
                            Pilihan lauk khas Padang yang cocok untuk
                            menemani makan siang maupun makan malam.
                        </p>

                        <button onclick="tampilkanKategori('lauk')">
                            Lihat Lauk Favorit
                        </button>
                    </div>
                </div>

                <!-- SLIDE 3 -->
                <div class="slide" style="background-image: url('images/banner3.jpg');">
                    <div class="slide-overlay"></div>

                    <div class="slide-content">
                        <h1>Cita Rasa Khas Minang</h1>
                        <p>
                            Lengkapi hidangan dengan paket nasi Padang
                            yang praktis dan lezat.
                        </p>

                        <button onclick="tampilkanKategori('paket')">
                            Lihat Paket
                        </button>
                    </div>
                </div>

                <!-- CLONE SLIDE 1 -->
                <div class="slide" style="background-image: url('images/banner1.jpg');">
                    <div class="slide-overlay"></div>

                    <div class="slide-content">
                        <h1>
                            Selamat Datang di
                            <span>RM Rajo Salero</span>
                        </h1>
                        <p>
                            Nikmati cita rasa masakan khas Minang dengan
                            pilihan menu yang lengkap dan menggugah selera.
                        </p>

                        <button onclick="scrollToKategori()">
                            Lihat Kategori Menu
                        </button>
                    </div>
                </div>

            </div>

            <!-- TOMBOL SLIDER -->

            <button class="slider-arrow prev" onclick="ubahSlide(-1)">
                &#10094;
            </button>

            <button class="slider-arrow next" onclick="ubahSlide(1)">
                &#10095;
            </button>


            <!-- DOT -->

            <div class="slider-dots">
                <span class="dot active" onclick="keSlide(0)"></span>
                <span class="dot" onclick="keSlide(1)"></span>
                <span class="dot" onclick="keSlide(2)"></span>
            </div>

        </div>

    </section>


    <!-- ================= KATEGORI ================= -->

    <section class="section kategori-section" id="kategori">

        <div class="section-heading">
            <h2>Kategori Menu</h2>
            <p>Pilih kategori makanan yang ingin kamu lihat</p>
        </div>


        <div class="kategori-grid">

            <!-- PAKET -->
            <div
                class="kategori-card"
                style="background-image: url('images/kategoripaket.jpg');"
                onclick="tampilkanKategori('paket')"
            >
                <div class="kategori-overlay"></div>

                <div class="kategori-content">
                    <div class="kategori-icon">🍚</div>
                    <h3>Paket Nasi Padang</h3>
                    <p>Paket nasi lengkap dengan lauk khas Minang.</p>
                </div>
            </div>


            <!-- LAUK -->
            <div
                class="kategori-card"
                style="background-image: url('images/kategorilauk.jpg');"
                onclick="tampilkanKategori('lauk')"
            >
                <div class="kategori-overlay"></div>

                <div class="kategori-content">
                    <div class="kategori-icon">🍖</div>
                    <h3>Lauk Utama</h3>
                    <p>Berbagai pilihan lauk khas Padang.</p>
                </div>
            </div>


            <!-- GULAI -->
            <div
                class="kategori-card"
                style="background-image: url('images/kategorigulai.jpg');"
                onclick="tampilkanKategori('gulai')"
            >
                <div class="kategori-overlay"></div>

                <div class="kategori-content">
                    <div class="kategori-icon">🍲</div>
                    <h3>Gulai & Berkuah</h3>
                    <p>Masakan berkuah dengan rempah khas Minang.</p>
                </div>
            </div>


            <!-- TAMBAHAN -->
            <div
                class="kategori-card"
                style="background-image: url('images/kategoritambahan.jpg');"
                onclick="tampilkanKategori('tambahan')"
            >
                <div class="kategori-overlay"></div>

                <div class="kategori-content">
                    <div class="kategori-icon">🥚</div>
                    <h3>Lauk Tambahan</h3>
                    <p>Pelengkap untuk membuat hidangan semakin lengkap.</p>
                </div>
            </div>


            <!-- MINUMAN -->
            <div
                class="kategori-card"
                style="background-image: url('images/kategoriminuman.jpg');"
                onclick="tampilkanKategori('minuman')"
            >
                <div class="kategori-overlay"></div>

                <div class="kategori-content">
                    <div class="kategori-icon">🥤</div>
                    <h3>Minuman</h3>
                    <p>Minuman segar untuk menemani makananmu.</p>
                </div>
            </div>

        </div>

    </section>


    <!-- ================= HASIL KATEGORI ================= -->

    <section class="section hasil-section" id="hasilKategori" style="display: none;">

        <div class="section-heading">
            <h2 id="judulKategori">Menu Pilihan</h2>
            <p id="deskripsiKategori">
                Pilih kategori di atas untuk melihat menu.
            </p>
        </div>

        <div class="menu-grid" id="menuKategori"></div>

    </section>


    <!-- ================= FAVORIT ================= -->

    <section class="section favorit-section">

        <div class="section-heading">
            <h2>Menu Favorit</h2>
            <p>Beberapa menu yang paling cocok buat kamu coba</p>
        </div>

        <div class="menu-grid" id="menuFavorit"></div>

    </section>


    <!-- ================= TENTANG ================= -->

    <section class="section tentang-section" id="tentang">

        <div class="section-heading">
            <h2>Tentang RM Rajo Salero</h2>
        </div>

        <div class="tentang-content">

            <p>
                RM Rajo Salero merupakan rumah makan yang menyajikan
                berbagai hidangan khas Minang. Mulai dari rendang,
                ayam, gulai, lauk tambahan, hingga minuman yang cocok
                untuk menemani makanan.
            </p>

            <p>
                Kami menghadirkan pilihan menu yang beragam dengan
                cita rasa khas masakan Padang.
            </p>

        </div>

    </section>



    <!-- ================= DASHBOARD PESANAN ================= -->

    <section class="pesanan-dashboard" id="pesanan" aria-hidden="true" onclick="if(event.target === this) tutupPesananDashboard()">

        <div class="pesanan-dashboard-inner">

            <div class="pesanan-dashboard-heading">
                <div>
                    <span class="dashboard-eyebrow">CHECKOUT</span>
                    <h2>Pesanan Kamu</h2>
                    <p>Periksa kembali menu yang kamu pilih sebelum melanjutkan.</p>
                </div>
                <button type="button" class="dashboard-back" onclick="tutupPesananDashboard()">
                    Kembali ke Menu
                </button>
            </div>

            <div class="pesanan-checkout">

                <div class="pesanan-items-column">

                    <div class="pesanan-items-heading">
                        <h3>Menu Pesanan</h3>
                        <span>Pesanan kamu</span>
                    </div>

                    <div id="daftarPesanan">
                        <div class="pesanan-kosong">
                            <div class="pesanan-kosong-icon">🍽️</div>
                            <h3>Belum Ada Pesanan</h3>
                            <p>Pilih menu terlebih dahulu untuk menambahkannya ke pesanan.</p>
                        </div>
                    </div>

                </div>

                <aside class="pesanan-summary-card">

                    <div class="summary-card-heading">
                        <span class="summary-eyebrow">CHECKOUT</span>
                        <h3>Ringkasan Pesanan</h3>
                    </div>

                    <div class="summary-items" id="ringkasanPesanan">
                        <div class="summary-empty">Belum ada item.</div>
                    </div>

                    <div class="pesanan-extra-options">

                        <div class="checkout-option">
                            <div class="checkout-option-label">
                                <strong>Tambahan Nasi</strong>
                                <small>Rp5.000 / porsi</small>
                            </div>

                            <div class="rice-control">
                                <button type="button" onclick="ubahNasi(-1)" aria-label="Kurangi nasi">−</button>
                                <span id="jumlahNasi">0</span>
                                <button type="button" onclick="ubahNasi(1)" aria-label="Tambah nasi">+</button>
                            </div>
                        </div>

                        <div class="checkout-option sambal-checkout-option">
                            <div class="checkout-option-label">
                                <strong>Sambal Gratis</strong>
                                <small>Pilih salah satu</small>
                            </div>

                            <div class="sambal-options">
                                <label class="sambal-option">
                                    <input type="radio" name="sambalDashboard" value="Tanpa Sambal" checked onchange="pilihSambal(this.value)">
                                    <span>Tanpa</span>
                                </label>
                                <label class="sambal-option">
                                    <input type="radio" name="sambalDashboard" value="Sambal Matah" onchange="pilihSambal(this.value)">
                                    <span>Matah</span>
                                </label>
                                <label class="sambal-option">
                                    <input type="radio" name="sambalDashboard" value="Sambal Ijo" onchange="pilihSambal(this.value)">
                                    <span>Ijo</span>
                                </label>
                                <label class="sambal-option">
                                    <input type="radio" name="sambalDashboard" value="Sambal Merah" onchange="pilihSambal(this.value)">
                                    <span>Merah</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-money-row">
                        <span>Subtotal</span>
                        <strong id="summarySubtotal">Rp0</strong>
                    </div>

                    <div class="summary-money-row">
                        <span>Nasi tambahan</span>
                        <strong id="summaryNasi">Rp0</strong>
                    </div>

                    <div class="summary-money-row">
                        <span>Sambal</span>
                        <strong id="summarySambal">Gratis</strong>
                    </div>

                    <div class="summary-total-row">
                        <span>Total</span>
                        <strong id="totalHarga">Rp0</strong>
                    </div>

                    <button type="button" class="btn-lanjut-pembayaran" onclick="bukaPembayaran()">
                        Lanjut ke Pembayaran
                    </button>

                </aside>

            </div>

        </div>

    </section>


    <!-- ================= FOOTER ================= -->

   <footer class="footer">

    <div class="footer-content">

        <div>
            <h3>RM Rajo Salero</h3>
            <p>Cita rasa khas Minang di setiap hidangan.</p>
        </div>

        <div>
            <p>📍 Perum Villa Pertiwi Blok E5/6, Kota Depok Jawa Barat </p>
            <p>📞 081315454459</p>
        </div>

    </div>

    <div class="footer-bottom">
        <span>© 2026 RM Rajo Salero</span>

        <a href="admin/login.php" class="admin-login-link">
            Admin Login
        </a>
    </div>

</footer>


    <!-- ================= MODAL PEMBAYARAN ================= -->

    <div class="payment-modal" id="paymentModal" aria-hidden="true">

        <div class="payment-card">

            <button type="button" class="payment-close" onclick="tutupPembayaran()" aria-label="Tutup pembayaran">
                ×
            </button>

            <div class="payment-card-header">
                <span class="payment-eyebrow">CHECKOUT</span>
                <h2>Pembayaran</h2>
                <p>Pilih metode pembayaran untuk menyelesaikan pesanan kamu.</p>
            </div>

            <div class="payment-total-preview">
                <span>Total yang harus dibayar</span>
                <strong id="paymentTotal">Rp0</strong>
            </div>

            <div class="payment-methods">

                <button type="button" class="payment-method active" data-payment="QRIS" onclick="pilihPembayaran('QRIS')">
                    <span class="payment-method-icon">▦</span>
                    <span>
                        <strong>QRIS</strong>
                        <small>Bayar dengan QRIS</small>
                    </span>
                    <span class="payment-radio"></span>
                </button>

                <button type="button" class="payment-method" data-payment="Transfer Bank" onclick="pilihPembayaran('Transfer Bank')">
                    <span class="payment-method-icon">▤</span>
                    <span>
                        <strong>Transfer Bank</strong>
                        <small>Transfer melalui rekening</small>
                    </span>
                    <span class="payment-radio"></span>
                </button>

                <button type="button" class="payment-method" data-payment="Cash" onclick="pilihPembayaran('Cash')">
                    <span class="payment-method-icon">Rp</span>
                    <span>
                        <strong>Cash</strong>
                        <small>Bayar langsung di kasir</small>
                    </span>
                    <span class="payment-radio"></span>
                </button>

            </div>
            <div class="customer-form">

    <h3>Data Pemesan</h3>

    <div class="form-group">

        <label>Nama Pelanggan</label>

        <input 
        type="text"
        id="namaPelanggan"
        placeholder="Masukkan nama">

    </div>


    <div class="form-group">

        <label>Nomor HP</label>

        <input 
        type="text"
        id="nomorHp"
        placeholder="08xxxxxxxx">

    </div>


    <div class="form-group">

        <label>Alamat</label>

        <textarea
        id="alamatPelanggan"
        placeholder="Alamat pelanggan"></textarea>

    </div>

</div>
            <button type="button" class="btn-konfirmasi-pesanan" onclick="konfirmasiPesanan()">
                Konfirmasi Pesanan
            </button>

        </div>

    </div>


    <!-- ================= MODAL PESAN ================= -->

    <div class="modal" id="modalPesan">

        <div class="modal-box">

            <button class="modal-close" onclick="tutupModal()">
                ×
            </button>

            <img
                id="modalImage"
                src=""
                alt=""
                class="modal-image"
            >

            <div class="modal-body">

                <h2 id="modalNama"></h2>

                <div class="modal-harga" id="modalHarga"></div>

                <p id="modalDeskripsi"></p>


                <div class="jumlah">

                    <button onclick="ubahJumlah(-1)">
                        −
                    </button>

                    <span id="modalJumlah">
                        1
                    </span>

                    <button onclick="ubahJumlah(1)">
                        +
                    </button>

                </div>


                <div class="modal-subtotal">

                    Subtotal:
                    <strong id="modalSubtotal">
                        Rp0
                    </strong>

                </div>


                <button
                    class="btn-tambah"
                    onclick="tambahKePesanan()"
                >
                    Tambah ke Pesanan
                </button>

            </div>

        </div>

    </div>


    <!-- ================= JAVASCRIPT ================= -->

    <script>

        const menu = <?= json_encode($menus); ?>;


        /* =========================
           VARIABEL
        ========================= */

        let menuDipilih = null;
        let jumlahMenu = 1;

        let pesanan = [];
        let jumlahNasi = 0;
        let sambalPilihan = "Tanpa Sambal";
        let metodePembayaran = "QRIS";


        /* =========================
           FORMAT RUPIAH
        ========================= */

        function formatRupiah(angka) {

            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                maximumFractionDigits: 0
            }).format(angka);

        }


        /* =========================
           SLIDER
        ========================= */

        let slideSekarang = 1;
        let timerSlider = null;
        let sedangGeser = false;

        function updateSlider(animasi = true) {
            const track = document.querySelector(".slider-track");

            if (!track) return;

            track.style.transition = animasi
                ? "transform 0.8s ease-in-out"
                : "none";

            track.style.transform =
                "translateX(-" + (slideSekarang * 100) + "%)";

            updateDot();
        }

        function updateDot() {
            const dots = document.querySelectorAll(".dot");

            let indexDot = slideSekarang - 1;

            if (indexDot < 0) indexDot = 2;
            if (indexDot > 2) indexDot = 0;

            dots.forEach(dot => dot.classList.remove("active"));

            if (dots[indexDot]) {
                dots[indexDot].classList.add("active");
            }
        }

        function ubahSlide(arah) {
            if (sedangGeser) return;

            sedangGeser = true;
            slideSekarang += arah;

            updateSlider(true);
            resetTimerSlider();
        }

        function keSlide(index) {
            if (sedangGeser) return;

            sedangGeser = true;
            slideSekarang = index + 1;

            updateSlider(true);
            resetTimerSlider();
        }

        function mulaiTimerSlider() {
            clearInterval(timerSlider);

            timerSlider = setInterval(() => {
                if (!sedangGeser) {
                    ubahSlide(1);
                }
            }, 5000);
        }

        function resetTimerSlider() {
            clearInterval(timerSlider);
            mulaiTimerSlider();
        }

        const sliderTrack = document.querySelector(".slider-track");

        if (sliderTrack) {
            sliderTrack.addEventListener("transitionend", function() {

                if (slideSekarang === 4) {
                    slideSekarang = 1;
                    updateSlider(false);
                }

                if (slideSekarang === 0) {
                    slideSekarang = 3;
                    updateSlider(false);
                }

                sedangGeser = false;
            });
        }

        /* =========================
           KATEGORI
        ========================= */

        function tampilkanKategori(kategori) {

            const hasil = menu.filter(item => item.kategori === kategori);

            const judul = {
                paket: "Paket Nasi Padang",
                lauk: "Lauk Utama",
                gulai: "Gulai & Masakan Berkuah",
                tambahan: "Lauk Tambahan",
                minuman: "Minuman"
            };

            const deskripsi = {
                paket: "Pilihan paket nasi Padang lengkap untuk menemani makanmu.",
                lauk: "Pilihan lauk utama dengan cita rasa khas Minang.",
                gulai: "Berbagai hidangan gulai dan masakan berkuah.",
                tambahan: "Pelengkap yang cocok untuk hidangan nasi Padang.",
                minuman: "Pilihan minuman segar untuk menemani makanan."
            };

            document.getElementById("judulKategori").textContent = judul[kategori];

            document.getElementById("deskripsiKategori").textContent = deskripsi[kategori];

            renderMenu(hasil, "menuKategori");

            const hasilSection = document.getElementById("hasilKategori");
            hasilSection.style.display = "block";

            hasilSection.scrollIntoView({
                behavior: "smooth"
            });

        }


        /* =========================
           RENDER MENU
        ========================= */

        function renderMenu(data, elementId) {

            const container = document.getElementById(elementId);

            container.innerHTML = "";

            data.forEach(item => {

                container.innerHTML += `

                    <div class="menu-card">

                        <img
                            src="images/${item.gambar}"
                            alt="${item.nama}"
                            class="menu-image"
                        >

                        <div class="menu-info">

                            <h3>${item.nama}</h3>

                            <p>
                                ${item.deskripsi}
                            </p>

                            <div class="menu-bottom">

                                <span class="menu-price">
                                    ${formatRupiah(item.harga)}
                                </span>

                                <button
                                    class="btn-pesan"
                                    onclick="bukaModal(${item.id})"
                                >
                                    Pesan
                                </button>

                            </div>

                        </div>

                    </div>

                `;

            });

        }


        /* =========================
           FAVORIT
        ========================= */
function tampilkanFavorit(){

    const favoritId = [
        "2",
        "6",
        "7",
        "8",
        "14",
        "20",
        "26",
        "34"
    ];

    const favorit = menu.filter(item =>
        favoritId.includes(String(item.id))
    );

    renderMenu(favorit, "menuFavorit");
}

        /* =========================
           MODAL
        ========================= */

        function bukaModal(id) {

            menuDipilih = menu.find(item => item.id == id);

            jumlahMenu = 1;

            document.getElementById("modalImage").src =
                "images/" + menuDipilih.gambar;

            document.getElementById("modalNama").textContent =
                menuDipilih.nama;

            document.getElementById("modalHarga").textContent =
                formatRupiah(menuDipilih.harga);

            document.getElementById("modalDeskripsi").textContent =
                menuDipilih.deskripsi;

            document.getElementById("modalJumlah").textContent =
                jumlahMenu;

            updateSubtotal();

            document.getElementById("modalPesan").classList.add("show");

            document.body.classList.add("modal-open");

        }


        function tutupModal() {

            document.getElementById("modalPesan").classList.remove("show");

            document.body.classList.remove("modal-open");

        }


        function ubahJumlah(angka) {

            jumlahMenu += angka;

            if (jumlahMenu < 1) {
                jumlahMenu = 1;
            }

            document.getElementById("modalJumlah").textContent =
                jumlahMenu;

            updateSubtotal();

        }


        function updateSubtotal() {

            if (!menuDipilih) return;

            const subtotal =
                menuDipilih.harga * jumlahMenu;

            document.getElementById("modalSubtotal").textContent =
                formatRupiah(subtotal);

        }


        /* =========================
           DASHBOARD PESANAN
        ========================= */

        function tampilkanPesananSection() {

            const dashboard = document.getElementById("pesanan");

            if (!dashboard || pesanan.length === 0) return;

            renderPesanan();

            dashboard.classList.add("pesanan-visible");
            dashboard.setAttribute("aria-hidden", "false");
            document.body.classList.add("pesanan-dashboard-open");

        }


        function tutupPesananDashboard() {

            const dashboard = document.getElementById("pesanan");

            if (!dashboard) return;

            dashboard.classList.remove("pesanan-visible");
            dashboard.setAttribute("aria-hidden", "true");
            document.body.classList.remove("pesanan-dashboard-open");

        }


        function bukaPesananSection(event) {

            if (event) event.preventDefault();

            // Jika belum ada pesanan, jangan tampilkan dashboard kosong.
            if (pesanan.length === 0) {
                tutupPesananDashboard();
                return;
            }

            tampilkanPesananSection();

        }


        /* =========================
           TAMBAH PESANAN
        ========================= */

        function tambahKePesanan() {

            if (!menuDipilih) return;

            const sudahAda = pesanan.find(
                item => item.id === menuDipilih.id
            );

            if (sudahAda) {

                sudahAda.jumlah += jumlahMenu;

            } else {

                pesanan.push({
                    id: menuDipilih.id,
                    nama: menuDipilih.nama,
                    harga: menuDipilih.harga,
                    gambar: menuDipilih.gambar,
                    jumlah: jumlahMenu
                });

            }

            renderPesanan();

            tutupModal();

        }


        /* =========================
           RENDER PESANAN
        ========================= */

        function updatePesananBadge() {

    const badge = document.getElementById("pesananBadge");

    if (!badge) return;

    const jumlahItem = pesanan.reduce(
        (total, item) => total + item.jumlah,
        0
    );

    badge.textContent = jumlahItem;

    if (jumlahItem > 0) {
        badge.classList.add("show");
    } else {
        badge.classList.remove("show");
    }

} 

      function renderPesanan() {

    updatePesananBadge();

    const container = document.getElementById("daftarPesanan");
            const summaryContainer = document.getElementById("ringkasanPesanan");

            if (pesanan.length === 0) {

                container.innerHTML = `
                    <div class="pesanan-kosong">
                        <div class="pesanan-kosong-icon">🍽️</div>
                        <h3>Belum Ada Pesanan</h3>
                        <p>Pilih menu terlebih dahulu untuk menambahkannya ke pesanan.</p>
                    </div>
                `;

                summaryContainer.innerHTML = `
                    <div class="summary-empty">Belum ada item.</div>
                `;

                document.getElementById("summarySubtotal").textContent = "Rp0";
                document.getElementById("summaryNasi").textContent = "Rp0";
                document.getElementById("summarySambal").textContent =
                    sambalPilihan === "Tanpa Sambal" ? "Gratis" : sambalPilihan + " · Gratis";
                document.getElementById("totalHarga").textContent = "Rp0";

                return;
            }

            container.innerHTML = "";
            summaryContainer.innerHTML = "";

            let total = 0;

            pesanan.forEach(item => {

                const subtotal = item.harga * item.jumlah;
                total += subtotal;

                container.innerHTML += `
                    <article class="pesanan-item">

                        <div class="pesanan-image-wrap">
                            <img src="images/${item.gambar}" alt="${item.nama}">
                        </div>

                        <div class="pesanan-item-content">

                            <div class="pesanan-item-top">

                                <div class="pesanan-info">
                                    <h4>${item.nama}</h4>
                                    <span class="pesanan-price">${formatRupiah(item.harga)}</span>
                                </div>

                                <button type="button"
                                        class="btn-hapus"
                                        onclick="hapusPesanan(${item.id})"
                                        aria-label="Hapus ${item.nama}"
                                        title="Hapus pesanan">
                                    <span class="hapus-icon">×</span>
                                </button>

                            </div>

                            <div class="pesanan-item-bottom">

                                <div class="quantity-control">
                                    <button type="button" class="quantity-btn" disabled>−</button>
                                    <span class="quantity-value">${item.jumlah}</span>
                                    <button type="button" class="quantity-btn" disabled>+</button>
                                </div>

                                <div class="pesanan-subtotal">
                                    <span>Subtotal</span>
                                    <strong>${formatRupiah(subtotal)}</strong>
                                </div>

                            </div>

                        </div>

                    </article>
                `;

                summaryContainer.innerHTML += `
                    <div class="summary-item">
                        <div>
                            <strong>${item.nama}</strong>
                            <span>${item.jumlah} × ${formatRupiah(item.harga)}</span>
                        </div>
                        <strong>${formatRupiah(subtotal)}</strong>
                    </div>
                `;
            });

            const nasiTotal = jumlahNasi * 5000;
            const grandTotal = total + nasiTotal;

            document.getElementById("summarySubtotal").textContent =
                formatRupiah(total);

            document.getElementById("summaryNasi").textContent =
                formatRupiah(nasiTotal);

            document.getElementById("summarySambal").textContent =
                sambalPilihan === "Tanpa Sambal"
                    ? "Gratis"
                    : sambalPilihan + " · Gratis";

            document.getElementById("totalHarga").textContent =
                formatRupiah(grandTotal);
        }



        /* =========================
           TAMBAHAN NASI & SAMBAL
        ========================= */

        function hitungSubtotalPesanan() {

            return pesanan.reduce(
                (total, item) =>
                    total + (item.harga * item.jumlah),
                0
            );

        }


        function ubahNasi(perubahan) {

            jumlahNasi = Math.max(
                0,
                jumlahNasi + perubahan
            );

            const jumlahNasiEl =
                document.getElementById("jumlahNasi");

            if (jumlahNasiEl) {
                jumlahNasiEl.textContent = jumlahNasi;
            }

            renderPesanan();

        }


        function pilihSambal(pilihan) {

            sambalPilihan = pilihan;

            renderPesanan();

        }


        /* =========================
           PEMBAYARAN
        ========================= */

        function bukaPembayaran() {

            if (pesanan.length === 0) {
                alert("Silakan pilih menu terlebih dahulu.");
                return;
            }

            const subtotal = hitungSubtotalPesanan();
            const nasiTotal = jumlahNasi * 5000;
            const total = subtotal + nasiTotal;

            const paymentTotal =
                document.getElementById("paymentTotal");

            if (paymentTotal) {
                paymentTotal.textContent =
                    formatRupiah(total);
            }

            const modal =
                document.getElementById("paymentModal");

            if (modal) {
                modal.classList.add("show");
                modal.setAttribute("aria-hidden", "false");
                document.body.classList.add("payment-open");
            }

        }


        function tutupPembayaran() {

            const modal =
                document.getElementById("paymentModal");

            if (modal) {
                modal.classList.remove("show");
                modal.setAttribute("aria-hidden", "true");
            }

            document.body.classList.remove("payment-open");

        }


        function pilihPembayaran(metode) {

            metodePembayaran = metode;

            document
                .querySelectorAll(".payment-method")
                .forEach(button => {

                    button.classList.toggle(
                        "active",
                        button.dataset.payment === metode
                    );

                });

        }


        function konfirmasiPesanan() {

    if (pesanan.length === 0) {
        alert("Belum ada pesanan.");
        return;
    }


    const nama = document.getElementById("namaPelanggan").value;
    const hp = document.getElementById("nomorHp").value;
    const alamat = document.getElementById("alamatPelanggan").value;


    if(nama === "" || hp === "" || alamat === ""){
        alert("Lengkapi data pemesan dulu.");
        return;
    }


    const subtotal = hitungSubtotalPesanan();
    const nasiTotal = jumlahNasi * 5000;
    const total = subtotal + nasiTotal;


    fetch("simpan_pesanan.php", {

        method:"POST",

        headers:{
            "Content-Type":"application/json"
        },

        body:JSON.stringify({

            nama:nama,
            hp:hp,
            alamat:alamat,
            metode:metodePembayaran,
            total:total,
            pesanan:pesanan

        })

    })


    .then(res=>res.json())

   .then(data=>{

console.log(data);

if(data.status=="success"){

    alert("✅ Pesanan berhasil dikonfirmasi!\n\nPesanan kamu sedang diproses.");

    tutupPembayaran();

setTimeout(()=>{
    location.reload();
},1000);

}

else{

alert("❌ Pesanan gagal dikirim");

}

})


}


        /* =========================
           HAPUS PESANAN
        ========================= */

        function hapusPesanan(id) {

            pesanan = pesanan.filter(
                item => item.id !== id
            );

            renderPesanan();

        }


        /* =========================
           SCROLL KATEGORI
        ========================= */

        function scrollToKategori(event) {

            if (event) event.preventDefault();

            tutupPesananDashboard();

            const kategori = document.getElementById("kategori");

            if (kategori) {
                kategori.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }

        }


        /* =========================
           TUTUP MODAL KLIK LUAR
        ========================= */

        document.getElementById("modalPesan").addEventListener(
            "click",
            function(event) {

                if (event.target === this) {
                    tutupModal();
                }

            }
        );


        /* =========================
           ESC UNTUK TUTUP MODAL
        ========================= */

        document.addEventListener("keydown", function(event) {

            if (event.key === "Escape") {
                tutupModal();
            }

        });


        /* =========================
           START
        ========================= */

        tampilkanFavorit();

        updateSlider(false);
        mulaiTimerSlider();

    </script>

</body>

</html>
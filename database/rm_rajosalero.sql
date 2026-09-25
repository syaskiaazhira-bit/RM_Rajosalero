-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2026 at 10:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rm_rajosalero`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin Rajo', 'admin', '$2y$12$SmPnT2wdPU1Jfs6Kq55YDea4vB8AUBKxhG6usZDq80Hy5.O492HD2', '2026-09-25 03:29:54', '2026-09-25 03:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` int(11) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `stok_minimal` int(11) DEFAULT 5,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `nama_bahan`, `kategori`, `jumlah`, `satuan`, `stok_minimal`, `created_at`) VALUES
(1, 'Beras', 'Karbohidrat', 30, 'Kg', 5, '2026-09-24 11:57:53'),
(2, 'Ayam', 'Protein', 15, 'Kg', 5, '2026-09-24 11:57:53'),
(3, 'Cabai', 'Sayuran', 8, 'Kg', 3, '2026-09-24 11:57:53'),
(4, 'Minyak Goreng', 'Bahan Masak', 10, 'Liter', 3, '2026-09-24 11:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id` int(11) NOT NULL,
  `pesanan_id` int(11) DEFAULT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id`, `pesanan_id`, `nama_menu`, `harga`, `jumlah`, `subtotal`) VALUES
(1, 15, 'Ayam Pop', 10000, 1, 10000),
(2, 16, 'Dendeng Balado', 10000, 1, 10000),
(3, 16, 'Cumi Sambal Ijo', 10000, 1, 10000),
(4, 16, 'Teh Manis Anget', 5000, 1, 5000),
(5, 16, 'Gulai Tunjang', 20000, 1, 20000),
(6, 16, 'Paket Nasi Padang Rendang', 14000, 1, 14000),
(7, 17, 'Paket Nasi Padang Dendeng', 15000, 2, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `nomor_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `gaji` int(11) DEFAULT 0,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE `keuangan` (
  `id` int(11) NOT NULL,
  `jenis` enum('Masuk','Keluar') DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`id`, `jenis`, `kategori`, `keterangan`, `jumlah`, `tanggal`) VALUES
(2, 'Masuk', 'sayuran', 'gatau', 20000, '2026-09-24 16:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(150) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama_menu`, `kategori`, `harga`, `gambar`, `deskripsi`, `status`, `created_at`) VALUES
(2, 'Paket Nasi Padang Rendang', 'Paket Nasi Padang', 14000, '../images/paketnasirendang.jpg', 'Paket nasi Padang lengkap dengan rendang sapi khas Minangkabau. Daging sapi dimasak perlahan menggunakan santan dan rempah pilihan hingga menghasilkan tekstur empuk dengan cita rasa gurih dan kaya bumbu.', 'aktif', '2026-09-23 12:01:54'),
(3, 'Paket Nasi Padang Ayam', 'Paket Nasi Padang', 13000, '../images/paket_nasi_ayam.jpg', 'Paket nasi Padang dengan ayam berbumbu khas Minang. Ayam dimasak menggunakan rempah tradisional sehingga menghasilkan rasa gurih dan aroma yang khas.', 'aktif', '2026-09-23 12:01:54'),
(4, 'Paket Nasi Padang Telur', 'Paket Nasi Padang', 12000, '../images/paket_nasi_telur.jpg', 'Paket nasi Padang dengan telur balado khas Minangkabau. Telur disajikan dengan sambal balado bercita rasa pedas, gurih, dan nikmat.', 'aktif', '2026-09-23 12:01:54'),
(5, 'Paket Nasi Padang Dendeng', 'Paket Nasi Padang', 15000, '../images/paket_nasi_dendeng.jpg', 'Paket nasi Padang dengan dendeng sapi khas Minang. Daging sapi diolah dengan cara diiris tipis, digoreng, kemudian diberi sambal balado yang kaya rasa.', 'aktif', '2026-09-23 12:01:54'),
(6, 'Rendang Daging', 'Lauk Utama', 10000, '../images/rendang.jpg', 'Rendang sapi khas Minangkabau yang dibuat dari daging sapi pilihan dan dimasak dengan santan serta campuran rempah tradisional hingga menghasilkan rasa gurih dan aroma khas.', 'aktif', '2026-09-23 12:01:54'),
(7, 'Dendeng Balado', 'Lauk Utama', 10000, '../images/dendengbalado.jpg', 'Dendeng balado khas Padang berupa irisan daging sapi yang dikeringkan dan digoreng kemudian disajikan dengan sambal balado pedas yang khas.', 'aktif', '2026-09-23 12:01:54'),
(8, 'Ayam Pop', 'Lauk Utama', 10000, '../images/ayampop.jpg', 'Ayam Pop khas Minangkabau dengan tekstur lembut dan rasa gurih. Ayam dimasak menggunakan bumbu sederhana kemudian disajikan dengan sambal khas Padang.', 'aktif', '2026-09-23 12:01:54'),
(9, 'Ayam Bakar Padang', 'Lauk Utama', 9000, '../images/ayam_bakar_padang.jpg', 'Ayam bakar khas Padang yang dimasak menggunakan bumbu rempah pilihan hingga menghasilkan aroma harum dengan rasa gurih dan sedikit manis.', 'aktif', '2026-09-23 12:01:54'),
(10, 'Ayam Goreng Bumbu', 'Lauk Utama', 9000, '../images/ayam_goreng_bumbu.jpg', 'Ayam goreng dengan bumbu khas Padang yang menghasilkan tekstur renyah di luar dan rasa gurih dari rempah tradisional.', 'aktif', '2026-09-23 12:01:54'),
(11, 'Ikan Kembung Bakar', 'Lauk Utama', 9000, '../images/ikan_kembung_bakar.jpg', 'Ikan kembung bakar yang dibumbui dengan rempah khas Minangkabau dan dipanggang hingga menghasilkan aroma harum serta rasa gurih.', 'aktif', '2026-09-23 12:01:54'),
(12, 'Asam Padeh Tongkol', 'Lauk Utama', 9000, '../images/asam_padeh_tongkol.jpg', 'Ikan tongkol yang dimasak dengan kuah asam pedas khas Minang menggunakan rempah pilihan sehingga menghasilkan rasa segar dan menggugah selera.', 'aktif', '2026-09-23 12:01:54'),
(13, 'Gulai Kepala Ikan Kakap', 'Lauk Utama', 20000, '../images/gulai_kepala_ikan_kakap.jpg', 'Gulai kepala ikan kakap khas Padang dengan kuah santan berbumbu rempah yang kaya rasa dan aroma khas masakan Minangkabau.', 'aktif', '2026-09-23 12:01:54'),
(14, 'Gulai Tunjang', 'Gulai & Masakan Berkuah', 20000, '../images/gulaitunjang.jpg', 'Gulai tunjang khas Minang yang menggunakan kikil sapi pilihan, dimasak dengan santan dan rempah sehingga menghasilkan tekstur lembut dan rasa gurih.', 'aktif', '2026-09-23 12:01:54'),
(15, 'Gulai Cincang', 'Gulai & Masakan Berkuah', 10000, '../images/gulai_cincang.jpg', 'Gulai cincang khas Padang berupa olahan daging sapi cincang yang dimasak dengan kuah rempah dan santan bercita rasa gurih.', 'aktif', '2026-09-23 12:01:54'),
(16, 'Gulai Limpa', 'Gulai & Masakan Berkuah', 10000, '../images/gulai_limpa.jpg', 'Gulai limpa khas Minangkabau dengan bumbu rempah tradisional dan kuah santan yang kaya rasa.', 'aktif', '2026-09-23 12:01:54'),
(17, 'Ayam Gulai', 'Gulai & Masakan Berkuah', 9000, '../images/ayam_gulai.jpg', 'Ayam gulai khas Padang dengan kuah santan dan rempah pilihan yang menghasilkan rasa gurih serta aroma yang khas.', 'aktif', '2026-09-23 12:01:54'),
(18, 'Gulai Telur', 'Gulai & Masakan Berkuah', 5000, '../images/gulai_telur.jpg', 'Gulai telur khas Minangkabau berupa telur yang dimasak dengan kuah santan berbumbu rempah sehingga menghasilkan rasa gurih.', 'aktif', '2026-09-23 12:01:54'),
(19, 'Gulai Nangka', 'Gulai & Masakan Berkuah', 5000, '../images/gulai_nangka.jpg', 'Gulai nangka muda khas rumah makan Padang yang dimasak menggunakan santan dan rempah tradisional sebagai pelengkap nasi Padang.', 'aktif', '2026-09-23 12:01:54'),
(20, 'Telur Dadar Padang', 'Lauk Tambahan', 6000, '../images/telurdadar.jpg', 'Telur dadar khas Padang dengan ukuran lebih tebal dan campuran bumbu rempah yang menghasilkan rasa gurih dan aroma khas.', 'aktif', '2026-09-23 12:01:54'),
(21, 'Kikil Balado', 'Lauk Tambahan', 5000, '../images/kikil_balado.jpg', 'Kikil balado berupa olahan kikil sapi yang dimasak dengan sambal balado khas Minangkabau dengan cita rasa pedas dan gurih.', 'aktif', '2026-09-23 12:01:54'),
(22, 'Kentang Balado', 'Lauk Tambahan', 5000, '../images/kentang_balado.jpg', 'Kentang balado khas Padang berupa potongan kentang yang digoreng dan dimasak dengan sambal balado bercita rasa pedas gurih.', 'aktif', '2026-09-23 12:01:54'),
(23, 'Terong Balado', 'Lauk Tambahan', 5000, '../images/terong_balado.jpg', 'Terong balado berupa terong yang digoreng kemudian dipadukan dengan sambal balado khas Minang yang kaya rasa.', 'aktif', '2026-09-23 12:01:54'),
(24, 'Tempe Balado', 'Lauk Tambahan', 5000, '../images/tempe_balado.jpg', 'Tempe balado dengan potongan tempe goreng yang dipadukan bersama sambal balado khas Padang.', 'aktif', '2026-09-23 12:01:54'),
(25, 'Kerang', 'Lauk Tambahan', 5000, '../images/kerang.jpg', 'Kerang yang dimasak dengan bumbu sambal khas Minangkabau sehingga menghasilkan rasa pedas dan gurih.', 'aktif', '2026-09-23 12:01:54'),
(26, 'Cumi Sambal Ijo', 'Lauk Tambahan', 10000, '../images/cumisambalijo.jpg', 'Cumi sambal ijo khas Padang berupa cumi yang dimasak dengan cabai hijau dan rempah pilihan dengan rasa pedas gurih.', 'aktif', '2026-09-23 12:01:54'),
(27, 'Jengkol', 'Lauk Tambahan', 5000, '../images/jengkol.jpg', 'Jengkol khas Padang yang dimasak dengan bumbu rempah dan sambal sehingga menghasilkan aroma serta rasa yang khas.', 'aktif', '2026-09-23 12:01:54'),
(28, 'Tumis Toge', 'Lauk Tambahan', 5000, '../images/tumis_toge.jpg', 'Tumis toge segar yang dimasak dengan bumbu sederhana sehingga menghasilkan rasa gurih dan nikmat.', 'aktif', '2026-09-23 12:01:54'),
(29, 'Daun Singkong', 'Lauk Tambahan', 5000, '../images/daun_singkong.jpg', 'Daun singkong rebus khas rumah makan Padang yang sering menjadi pelengkap hidangan dengan rasa gurih dan segar.', 'aktif', '2026-09-23 12:01:54'),
(30, 'Sambal Ijo', 'Lauk Tambahan', 5000, '../images/sambal_ijo.jpg', 'Sambal ijo khas Minangkabau yang dibuat dari cabai hijau pilihan dengan rasa pedas dan segar.', 'aktif', '2026-09-23 12:01:54'),
(31, 'Sambal Merah', 'Lauk Tambahan', 5000, '../images/sambal_merah.jpg', 'Sambal merah khas Padang dengan rasa pedas gurih yang cocok sebagai pelengkap berbagai menu.', 'aktif', '2026-09-23 12:01:54'),
(32, 'Perkedel Kentang', 'Lauk Tambahan', 3000, '../images/perkedel_kentang.jpg', 'Perkedel kentang khas Padang berupa olahan kentang berbumbu yang digoreng hingga memiliki tekstur lembut dan gurih.', 'aktif', '2026-09-23 12:01:54'),
(33, 'Kerupuk Kulit', 'Lauk Tambahan', 3000, '../images/kerupuk_kulit.jpg', 'Kerupuk kulit khas Minangkabau yang renyah dan cocok menjadi pelengkap hidangan nasi Padang.', 'aktif', '2026-09-23 12:01:54'),
(34, 'Es Teh Manis', 'Minuman', 5000, '../images/estehmanis.jpg', 'Es teh manis segar dengan perpaduan teh pilihan dan gula yang cocok menemani hidangan khas Padang.', 'aktif', '2026-09-23 12:01:54'),
(35, 'Es Teh Tawar', 'Minuman', 3000, '../images/es_teh_tawar.jpg', 'Es teh tawar dingin dengan rasa segar yang cocok sebagai pendamping makanan.', 'aktif', '2026-09-23 12:01:54'),
(36, 'Teh Manis Anget', 'Minuman', 5000, '../images/teh_manis_anget.jpg', 'Teh manis hangat dengan rasa manis dan aroma teh pilihan yang cocok dinikmati bersama makanan.', 'aktif', '2026-09-23 12:01:54'),
(37, 'Teh Tawar Anget', 'Minuman', 1000, '../images/teh_tawar_anget.jpg', 'Teh tawar hangat dengan rasa ringan dan aroma teh alami.', 'aktif', '2026-09-23 12:01:54'),
(38, 'Es Jeruk', 'Minuman', 5000, '../images/es_jeruk.jpg', 'Es jeruk segar dengan rasa manis dan asam yang menyegarkan.', 'aktif', '2026-09-23 12:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `nomor_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status` enum('Menunggu','Diproses','Selesai','Dibatalkan') DEFAULT 'Menunggu',
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama_pelanggan`, `nomor_hp`, `alamat`, `total_harga`, `status`, `metode_pembayaran`, `created_at`) VALUES
(15, 'jija', '087654', 'dpk', 15000, 'Selesai', 'QRIS', '2026-09-24 11:02:03'),
(16, 'jija', '0811123344', 'ghhg', 69000, 'Selesai', 'Cash', '2026-09-24 11:05:47'),
(17, 'p', '0811123344', 'gjhuuhh', 30000, 'Dibatalkan', 'QRIS', '2026-09-24 11:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id` int(11) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`id`, `bahan_id`, `jumlah`, `tanggal`) VALUES
(1, 1, 10, '2026-09-24 23:00:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id` (`pesanan_id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

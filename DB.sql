-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 30 Apr 2020 pada 14.51
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_test3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `link_kategori`
--

CREATE TABLE `link_kategori` (
  `id_kat` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `link_kategori`
--

INSERT INTO `link_kategori` (`id_kat`, `id_barang`) VALUES
(2, 69),
(2, 70),
(2, 71),
(3, 2),
(3, 3),
(3, 5),
(3, 59),
(3, 60),
(4, 6),
(4, 58),
(4, 66),
(4, 67),
(4, 68),
(5, 9),
(16, 63),
(17, 72);

-- --------------------------------------------------------

--
-- Struktur dari tabel `link_suplier`
--

CREATE TABLE `link_suplier` (
  `id_suplier` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `link_suplier`
--

INSERT INTO `link_suplier` (`id_suplier`, `id_barang`) VALUES
(2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users2_table', 1),
(2, '2020_01_24_081219_create_coba2s_table', 1),
(3, '2020_01_30_003116_create_tb_laporan_keuangans_table', 1),
(4, '2014_10_12_000000_create_users_table', 2),
(5, '2014_10_12_100000_create_password_resets_table', 2),
(6, '2019_08_19_000000_create_failed_jobs_table', 2),
(7, '2020_03_19_092836_create_roles_table', 3),
(8, '2020_03_19_093041_create_role_user_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2020-03-19 03:06:16', '2020-03-19 03:06:16'),
(2, 'Kasir', '2020-03-19 03:06:16', '2020-03-19 03:06:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(11, 2, 7, NULL, NULL),
(17, 2, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_customer` int(5) NOT NULL,
  `nama_customer` varchar(30) DEFAULT NULL,
  `nomor_telepon` varchar(15) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_customer`
--

INSERT INTO `tb_customer` (`id_customer`, `nama_customer`, `nomor_telepon`, `alamat`, `email`) VALUES
(0, 'Umum', NULL, NULL, NULL),
(1, 'Shikamaru', '088980800808', 'Desa Konoha', 'kakashi@gmail.com'),
(4, 'Tingkiwingki', '087772662333', 'Di suatu bukit', NULL),
(9, 'Naruto', '0888830333', 'Lenteng Agung', NULL),
(12, 'Luffy', '0877221212', 'Grand Blue', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `id_invoice` bigint(15) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_customer` int(5) DEFAULT NULL,
  `id_suplier` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_invoice`
--

INSERT INTO `tb_invoice` (`id_invoice`, `id_user`, `id_customer`, `id_suplier`, `created_at`, `updated_at`) VALUES
(110050120001, 1, 0, NULL, '2020-01-05 09:54:46', '2020-01-05 09:54:46'),
(110200120001, 1, 0, NULL, '2020-01-20 05:29:15', '2020-01-20 05:29:15'),
(111100120001, 1, 1, NULL, '2020-01-10 09:56:55', '2020-01-10 09:56:55'),
(111150220002, 1, 1, NULL, '2020-02-15 09:56:55', '2020-02-15 09:56:55'),
(114110220001, 1, 4, NULL, '2020-02-10 18:20:01', '2020-02-10 18:20:01'),
(114150320001, 1, 4, NULL, '2020-03-14 19:09:12', '2020-03-14 19:09:12'),
(119070320001, 1, 9, NULL, '2020-03-06 19:09:50', '2020-03-06 19:09:50'),
(21001070220001, 1, NULL, 1, '2020-02-07 03:12:26', '2020-02-07 03:12:26'),
(21001070220002, 1, NULL, 1, '2020-02-07 03:13:44', '2020-02-07 03:13:44'),
(21001070220003, 1, NULL, 1, '2020-02-07 03:57:17', '2020-02-07 03:57:17'),
(21001100120001, 1, NULL, 1, '2020-01-09 18:51:52', '2020-01-09 18:51:52'),
(21013050320001, 1, NULL, 13, '2020-03-04 19:26:14', '2020-03-04 19:26:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_invoice_customer`
--

CREATE TABLE `tb_invoice_customer` (
  `id` int(5) NOT NULL,
  `id_invoice` bigint(15) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `qty` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_invoice_customer`
--

INSERT INTO `tb_invoice_customer` (`id`, `id_invoice`, `id_barang`, `qty`) VALUES
(7, 114150320001, 59, 2),
(8, 119070320001, 60, 1),
(9, 119070320001, 5, 1),
(10, 110050120001, 2, 2),
(12, 111100120001, 58, 1),
(13, 111150220002, 5, 3),
(14, 110200120001, 69, 2),
(21, 114110220001, 71, 2),
(22, 114110220001, 58, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_invoice_supliers`
--

CREATE TABLE `tb_invoice_supliers` (
  `id` int(3) NOT NULL,
  `id_invoice` bigint(15) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `harga_beli` int(15) NOT NULL,
  `qty` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_invoice_supliers`
--

INSERT INTO `tb_invoice_supliers` (`id`, `id_invoice`, `id_barang`, `harga_beli`, `qty`) VALUES
(4, 21001070220001, 66, 3500000, 3),
(5, 21001070220002, 67, 5000000, 5),
(6, 21001070220002, 68, 2500000, 2),
(7, 21001070220003, 68, 2500000, 2),
(8, 21001100120001, 69, 17000000, 2),
(11, 21013050320001, 72, 2000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kat` int(5) NOT NULL,
  `nama_kat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kat`, `nama_kat`) VALUES
(1, 'Aksesoris'),
(2, 'Laptop'),
(3, 'Gadget'),
(4, 'LCD'),
(5, 'Printer'),
(16, 'Konsol'),
(17, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_barang` int(5) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_satuan` int(10) NOT NULL,
  `stok` int(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_barang`, `nama_barang`, `harga_satuan`, `stok`, `created_at`, `updated_at`) VALUES
(2, 'Mipad 4', 2500000, 280, '2020-03-05 13:44:29', '2020-04-24 05:31:08'),
(3, 'PIXMA E510', 1500000, 187, '2020-03-06 13:44:41', '2020-03-06 13:44:41'),
(5, 'Lenovo Ideapad 320', 4500000, 360, '2020-03-08 13:45:02', '2020-04-23 19:09:51'),
(6, 'HP Spectre x360', 6000000, 204, '2020-03-06 12:59:06', '2020-04-11 06:39:36'),
(9, 'HP Pavilion x360', 7000000, 442, '2020-03-08 13:00:52', '2020-03-08 13:00:52'),
(58, 'LG 4K', 5000000, 94, '2020-03-11 13:01:46', '2020-04-24 18:20:01'),
(59, 'Ipad Pro 2018', 17000000, 193, '2020-03-14 13:01:59', '2020-04-23 19:09:12'),
(60, 'Razer Phone', 9000000, 11, NULL, '2020-04-24 09:00:39'),
(63, 'Nitendo Switch New Version Grey', 5999000, 0, NULL, NULL),
(66, 'Sharp LC', 4500000, 3, '2020-04-22 03:12:26', '2020-04-22 03:57:17'),
(67, 'Philips Ultra Slim TV', 6000000, 5, '2020-04-22 03:13:44', '2020-04-22 03:13:44'),
(68, 'Polytron TV', 3500000, 9, '2020-04-22 03:13:44', '2020-04-24 08:53:50'),
(69, 'Acer Predator Triton 500.', 20000000, 3, '2020-04-23 18:51:52', '2020-04-24 05:29:16'),
(70, 'ASUS ROG Zephyrus S', 12000000, 2, '2020-04-23 18:53:57', '2020-04-24 08:53:50'),
(71, 'DELL Inspiron', 6500000, 13, '2020-04-23 19:48:35', '2020-04-24 18:20:01'),
(72, 'Test Produk', 10000, 2, '2020-04-25 19:26:14', '2020-04-25 19:26:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_suplier`
--

CREATE TABLE `tb_suplier` (
  `id_suplier` int(5) NOT NULL,
  `nama_suplier` varchar(30) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_suplier`
--

INSERT INTO `tb_suplier` (`id_suplier`, `nama_suplier`, `alamat`, `nomor_telepon`) VALUES
(1, 'Joko S.', 'Lenteng', '021998222'),
(2, 'Kakashi', 'bekasi', '021998292'),
(13, 'Maldini', 'Itali', '080909032323');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tuan Admin', 'admin@gmail.com', NULL, '$2y$10$/XjjxuQV6iKq1IH4vnR8ae1jI5lv2AxZrJvkHH9DF4W2p7oBGBt3i', NULL, '2020-03-19 03:06:15', '2020-03-26 09:47:23'),
(2, 'Frieza', 'kasir1@gmail.com', NULL, '$2y$10$qu9wuLupK4NXV5fgPNpT5ezz2yWTAGrKOWjDar95XLT5.82DSPGAC', NULL, '2020-03-19 03:06:15', '2020-03-26 09:48:14'),
(7, 'Goku', 'kasir2@gmail.com', NULL, '$2y$10$W1oRL0ZTa.VK4tgAG6EbIeZroUsbqfIMrM26qzY46essTEGy5pC1i', NULL, '2020-03-26 09:44:12', '2020-03-26 09:44:12'),
(13, 'Coba1', 'coba1@gmail.com', NULL, '$2y$10$hQvWipKwbVGAzZziTBD8aeIr3DTgXNd8KMlqox9mf34mdGgTBf.cu', NULL, '2020-04-05 08:20:58', '2020-04-05 08:20:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_backup`
--

CREATE TABLE `users_backup` (
  `id_user` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `jabatan` varchar(11) NOT NULL,
  `shift` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_backup`
--

INSERT INTO `users_backup` (`id_user`, `username`, `pass`, `nama_lengkap`, `jenis_kelamin`, `no_tlp`, `email`, `alamat`, `jabatan`, `shift`) VALUES
(2, 'naruto', '112233', 'Naruto', 'Laki-laki', '009998818822', 'naruto@gmail.com', 'desa konoha', 'Kasir', 'Pagi'),
(3, 'saske', '12345678', 'sasuke', 'Laki-laki', '088822223333', 'saske@gmail.com', 'konohagakure', 'Admin', 'Pagi'),
(4, 'ikhsan', '123123', 'Mohamad', 'Laki-laki', '32423454', 'ikhsan@gmail.com', 'fasdf', 'Kasir', 'Pagi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `link_kategori`
--
ALTER TABLE `link_kategori`
  ADD PRIMARY KEY (`id_kat`,`id_barang`),
  ADD KEY `fk_link-tb_produk` (`id_barang`),
  ADD KEY `id_kat` (`id_kat`);

--
-- Indeks untuk tabel `link_suplier`
--
ALTER TABLE `link_suplier`
  ADD UNIQUE KEY `id_barang` (`id_barang`),
  ADD KEY `id_suplier` (`id_suplier`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id_invoice`),
  ADD KEY `fk_tb_invoice-tb_customer` (`id_customer`),
  ADD KEY `fk_tb_invoice-tb_suplier` (`id_suplier`),
  ADD KEY `fk_tb_invoice-users` (`id_user`);

--
-- Indeks untuk tabel `tb_invoice_customer`
--
ALTER TABLE `tb_invoice_customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK-tb_produk` (`id_barang`),
  ADD KEY `FK-tb_invoice` (`id_invoice`);

--
-- Indeks untuk tabel `tb_invoice_supliers`
--
ALTER TABLE `tb_invoice_supliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tb_produk` (`id_barang`),
  ADD KEY `fk-tb_invoice2` (`id_invoice`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_suplier`
--
ALTER TABLE `tb_suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `users_backup`
--
ALTER TABLE `users_backup`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_customer` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_invoice_customer`
--
ALTER TABLE `tb_invoice_customer`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_invoice_supliers`
--
ALTER TABLE `tb_invoice_supliers`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_barang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `tb_suplier`
--
ALTER TABLE `tb_suplier`
  MODIFY `id_suplier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users_backup`
--
ALTER TABLE `users_backup`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `link_kategori`
--
ALTER TABLE `link_kategori`
  ADD CONSTRAINT `fk_link-tb_kategori` FOREIGN KEY (`id_kat`) REFERENCES `tb_kategori` (`id_kat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_link-tb_produk` FOREIGN KEY (`id_barang`) REFERENCES `tb_produk` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `link_suplier`
--
ALTER TABLE `link_suplier`
  ADD CONSTRAINT `fk_link-suplier` FOREIGN KEY (`id_suplier`) REFERENCES `tb_suplier` (`id_suplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_link-suplier-barang` FOREIGN KEY (`id_barang`) REFERENCES `tb_produk` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD CONSTRAINT `fk_tb_invoice-tb_customer` FOREIGN KEY (`id_customer`) REFERENCES `tb_customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_invoice-tb_suplier` FOREIGN KEY (`id_suplier`) REFERENCES `tb_suplier` (`id_suplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_invoice-users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_invoice_customer`
--
ALTER TABLE `tb_invoice_customer`
  ADD CONSTRAINT `FK-tb_invoice` FOREIGN KEY (`id_invoice`) REFERENCES `tb_invoice` (`id_invoice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK-tb_produk` FOREIGN KEY (`id_barang`) REFERENCES `tb_produk` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_invoice_supliers`
--
ALTER TABLE `tb_invoice_supliers`
  ADD CONSTRAINT `fk-tb_invoice2` FOREIGN KEY (`id_invoice`) REFERENCES `tb_invoice` (`id_invoice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_produk` FOREIGN KEY (`id_barang`) REFERENCES `tb_produk` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

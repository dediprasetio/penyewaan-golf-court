-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Okt 2020 pada 05.53
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_booking_golf_court`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` char(7) NOT NULL,
  `nama_admin` varchar(35) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` text NOT NULL,
  `repasswrod` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `status` enum('Active','Non Active') NOT NULL,
  `level` enum('Admin','Super Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama_admin`, `email`, `username`, `password`, `repasswrod`, `no_telp`, `status`, `level`) VALUES
('a1ft3OY', 'Super Admin Golf Court', 'superadmin@gmail.com', 'superadmin', '$2y$10$6ihvL6BBkdxP7HQ3YIuHc.E0BV7C/.PrfLWtrHXy1iqDGJKKes0TO', 'c3VwZXJhZG1pbg==', '08159878369', 'Active', 'Super Admin'),
('fSdwFR7', 'Farhan Aldiansyah', 'revalinoaldi@gmail.com', 'revalinoaldi', '$2y$10$6bzBdCiC.xvHQqfshy5BmuqOjlaSiQ..zdycelsdrizJx03n2S19u', 'cmV2YWxpbm9hbGRp', '08159878369', 'Active', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id_pesanan` char(6) NOT NULL,
  `kode_booking` char(15) NOT NULL,
  `id_member` char(11) DEFAULT NULL,
  `tgl_booking` date NOT NULL,
  `jam_main` time NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `alamat_pemesan` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `jenis_pelanggan` enum('Member','Tamu') NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `harga_lapangan` double NOT NULL,
  `id_fasilitas` char(5) DEFAULT NULL,
  `id_paket_barang` char(6) DEFAULT NULL,
  `id_paket_mobil` char(6) DEFAULT NULL,
  `total_harga` double NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `status_pesanan` enum('Pending','Accept','Reject') NOT NULL,
  `tanggal_bayar` datetime DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `total_bayar` double DEFAULT NULL,
  `admin_cek` char(7) DEFAULT NULL,
  `keterangan_status` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_booking`
--

INSERT INTO `tbl_booking` (`id_pesanan`, `kode_booking`, `id_member`, `tgl_booking`, `jam_main`, `nama_pemesan`, `alamat_pemesan`, `email`, `no_telp`, `jenis_pelanggan`, `id_lapangan`, `harga_lapangan`, `id_fasilitas`, `id_paket_barang`, `id_paket_mobil`, `total_harga`, `tgl_pesan`, `status_pesanan`, `tanggal_bayar`, `bukti_bayar`, `total_bayar`, `admin_cek`, `keterangan_status`, `update_at`) VALUES
('AytREc', 'Mehs20201002001', NULL, '2020-10-05', '10:00:00', 'Farhan Aldiansyah', 'Jl.Bintara 11', 'revalinoaldi@gmail.com', '08159878369', 'Tamu', 13, 250000, NULL, NULL, NULL, 250000, '2020-10-02 16:49:48', 'Accept', '2020-10-02 22:03:03', '05102020_Mehs20201002001.jpg', 250000, 'a1ft3OY', 'Confirm Booking Order Success! Have Fun!', NULL),
('dC5Zwx', 'luLw20201005001', 'zdX40985732', '2020-10-08', '15:00:00', 'Yulicha Damayani', 'Kayuringin Jaya', 'damayaniyulicha@gmail.com', '08159878369', 'Member', 14, 382500, 'vkZjL', 'bvKC8A', NULL, 472500, '2020-10-05 16:23:07', 'Accept', '2020-10-06 21:42:51', '08102020_luLw20201005001.jpeg', 472500, 'fSdwFR7', 'Confirm Success! Have Fun and play the Game of the Golf', '2020-10-06 21:48:57'),
('E3fTn4', 'CRTi20201005500', NULL, '2020-10-05', '16:00:00', 'Yulicha Damayani', 'Kayuringin', 'revalinoaldi@gmail.com', '08159878369', 'Tamu', 18, 600000, NULL, '4QV36N', 'GZHNqy', 1050000, '2020-10-05 16:38:33', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL),
('T89qPD', 'SRmU20201005550', 'zdX40985732', '2020-10-10', '16:00:00', 'Yulicha Damayani', 'Kayuringin Jaya', 'damayaniyulicha@gmail.com', '08159878369', 'Member', 18, 1445000, 'vkZjL', '4QV36N', 'GZHNqy', 1895000, '2020-10-05 16:39:49', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_fasilitas`
--

CREATE TABLE `tbl_detail_fasilitas` (
  `id` int(11) NOT NULL,
  `id_fasilitas` char(5) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_fasilitas`
--

INSERT INTO `tbl_detail_fasilitas` (`id`, `id_fasilitas`, `deskripsi`, `qty`) VALUES
(1, 'vkZjL', 'Fasilitas 1', 2),
(2, 'vkZjL', 'fasilitas 2', 1),
(3, 'vkZjL', 'fasilitas 3', 3),
(4, 'vkZjL', 'Fasilitas 4', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_paket_sewa`
--

CREATE TABLE `tbl_detail_paket_sewa` (
  `id_detail_sewa` int(11) NOT NULL,
  `id_paket` char(6) NOT NULL,
  `deskripsi_barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_paket_sewa`
--

INSERT INTO `tbl_detail_paket_sewa` (`id_detail_sewa`, `id_paket`, `deskripsi_barang`, `qty`) VALUES
(1, 'bvKC8A', 'Bola', 1),
(2, 'bvKC8A', 'Sarung Tangan', 1),
(3, 'bvKC8A', 'Stik Golf', 2),
(4, 'bvKC8A', 'Topi', 1),
(9, '4QV36N', 'Stik Golf', 5),
(10, '4QV36N', 'Bola', 3),
(11, '4QV36N', 'Sarung Tangan', 3),
(12, '4QV36N', 'Topi ', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dtl_lapangan`
--

CREATE TABLE `tbl_dtl_lapangan` (
  `id_detail_lapangan` int(11) NOT NULL,
  `id_lapangan` char(6) NOT NULL,
  `banyak_penyewa` int(11) NOT NULL,
  `harga_sewa_weekday` double NOT NULL,
  `harga_sewa_weekend` double NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_dtl_lapangan`
--

INSERT INTO `tbl_dtl_lapangan` (`id_detail_lapangan`, `id_lapangan`, `banyak_penyewa`, `harga_sewa_weekday`, `harga_sewa_weekend`, `update_at`) VALUES
(13, 'rUc6LA', 1, 250000, 700000, '2020-10-01 17:47:00'),
(14, 'rUc6LA', 2, 450000, 1100000, '2020-10-01 17:47:00'),
(15, 'rUc6LA', 3, 600000, 1400000, '2020-10-01 17:47:00'),
(16, 'rUc6LA', 4, 800000, 2000000, '2020-10-01 17:47:00'),
(17, 'XiS5zr', 1, 300000, 900000, '2020-10-02 16:31:00'),
(18, 'XiS5zr', 2, 600000, 1700000, '2020-10-02 16:31:00'),
(19, 'XiS5zr', 3, 800000, 2400000, '2020-10-02 16:31:00'),
(20, 'XiS5zr', 4, 1000000, 3000000, '2020-10-02 16:31:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_fasilitas_member`
--

CREATE TABLE `tbl_fasilitas_member` (
  `id_fasilitas` char(5) NOT NULL,
  `id_admin` char(7) DEFAULT NULL,
  `diskon_member` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_fasilitas_member`
--

INSERT INTO `tbl_fasilitas_member` (`id_fasilitas`, `id_admin`, `diskon_member`, `create_at`, `update_at`) VALUES
('vkZjL', 'a1ft3OY', 15, '2020-09-01 12:18:00', '2020-09-24 21:19:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_lapangan`
--

CREATE TABLE `tbl_lapangan` (
  `id_lapangan` char(6) NOT NULL,
  `nama_lapangan` varchar(50) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_lapangan`
--

INSERT INTO `tbl_lapangan` (`id_lapangan`, `nama_lapangan`, `deskripsi`, `create_at`, `update_at`) VALUES
('rUc6LA', '9 Hole', '9 Hole in 1 Game', '2020-10-01 17:47:00', NULL),
('XiS5zr', '18 Hole', '18 Hole in 1 Game', '2020-10-01 19:23:03', '2020-10-02 16:31:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_member`
--

CREATE TABLE `tbl_member` (
  `id_member` char(11) NOT NULL,
  `nama_member` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(35) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `register_date` datetime DEFAULT NULL,
  `status_member` enum('Not Payment','Member','Expire','Pending') NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_member`
--

INSERT INTO `tbl_member` (`id_member`, `nama_member`, `email`, `no_telp`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `password`, `register_date`, `status_member`, `payment_date`, `expire_date`, `update_at`) VALUES
('iyd51439867', 'Farhan Afif Aldiansyah', 'revalinoaldi@gmail.com', '08159878369', 'Laki-Laki', 'Bekasi', '2000-07-30', 'Jl.Bintara 11 No.56 RT.01/013', '$2y$10$8FVMGMm5mLfYUP2kafxhueITJYbzAVW871GoDmPiIQjJDI0XZ0FBu', '2020-10-03 23:11:52', 'Member', '2020-10-05 14:01:14', '2021-10-10 00:00:00', '2020-10-05 14:01:14'),
('zdX40985732', 'Yulicha Damayani', 'damayaniyulicha@gmail.com', '08159878369', 'Perempuan', 'Sumedang', '2000-07-18', 'Kayuringin Jaya', '$2y$10$IO093wjLbkpXsRyevQWmXuYs42fCzYAEWvHefpaxcFVry5B1ZQmae', '2020-10-05 14:21:15', 'Member', '2020-10-05 14:21:34', '2021-10-05 00:00:00', '2020-10-05 14:21:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_paket_sewa`
--

CREATE TABLE `tbl_paket_sewa` (
  `id_paket` char(6) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `harga_paket` double NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` enum('Alat','Mobil') NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_paket_sewa`
--

INSERT INTO `tbl_paket_sewa` (`id_paket`, `nama_paket`, `harga_paket`, `deskripsi`, `status`, `create_at`, `update_at`) VALUES
('4QV36N', 'Paket Kombo', 150000, 'Paket kombo banyak', 'Alat', '2020-08-28 14:17:23', NULL),
('bvKC8A', 'Paket Single', 90000, 'Paket Alat Single untuk bermain golf', 'Alat', '2020-08-27 12:30:51', '2020-08-28 00:24:38'),
('GZHNqy', 'Paket Mobil Buggy', 300000, 'Mobil Buggy untuk 4 orang', 'Mobil', '2020-09-01 14:33:48', NULL),
('OhYdKw', 'Paket Mobil Golf', 350000, 'Mobil berkapasitas 4 orang', 'Mobil', '2020-09-20 12:15:22', '2020-09-20 12:16:12');

--
-- Trigger `tbl_paket_sewa`
--
DELIMITER $$
CREATE TRIGGER `deletePaket` BEFORE DELETE ON `tbl_paket_sewa` FOR EACH ROW BEGIN
DELETE FROM tbl_detail_paket_sewa WHERE id_paket = OLD.id_paket;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_payment_member`
--

CREATE TABLE `tbl_payment_member` (
  `id_payment` int(11) NOT NULL,
  `id_member` char(11) NOT NULL,
  `price` double NOT NULL,
  `payment_date` datetime NOT NULL,
  `start_from` date NOT NULL,
  `end_before` date NOT NULL,
  `status_payment` enum('Pending','Accept','Reject') NOT NULL,
  `admin_cek` char(7) DEFAULT NULL,
  `keterangan_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_payment_member`
--

INSERT INTO `tbl_payment_member` (`id_payment`, `id_member`, `price`, `payment_date`, `start_from`, `end_before`, `status_payment`, `admin_cek`, `keterangan_status`) VALUES
(35961408, 'iyd51439867', 500000, '2020-10-05 13:39:45', '2020-10-05', '2021-10-05', 'Accept', 'a1ft3OY', NULL),
(69871352, 'iyd51439867', 500000, '2020-10-05 14:01:14', '2020-10-10', '2021-10-10', 'Accept', 'a1ft3OY', NULL),
(80573194, 'zdX40985732', 500000, '2020-10-05 14:21:34', '2020-10-05', '2021-10-05', 'Accept', 'a1ft3OY', NULL);

--
-- Trigger `tbl_payment_member`
--
DELIMITER $$
CREATE TRIGGER `t_activate_member` AFTER INSERT ON `tbl_payment_member` FOR EACH ROW BEGIN
	IF NEW.status_payment LIKE "Accept" THEN
    	UPDATE tbl_member SET payment_date = NEW.payment_date, expire_date = NEW.end_before, update_at = now(), status_member = "Member" WHERE id_member = NEW.id_member;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `t_activate_update_member` AFTER UPDATE ON `tbl_payment_member` FOR EACH ROW BEGIN
	IF NEW.status_payment LIKE "Accept" THEN
    	UPDATE tbl_member SET payment_date = NEW.payment_date, expire_date = NEW.end_before, update_at = now(), status_member = "Member" WHERE id_member = NEW.id_member;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_price_member`
--

CREATE TABLE `tbl_price_member` (
  `id_price` int(11) NOT NULL,
  `id_admin` char(7) DEFAULT NULL,
  `price` double NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_price_member`
--

INSERT INTO `tbl_price_member` (`id_price`, `id_admin`, `price`, `create_at`, `update_at`) VALUES
(1, 'a1ft3OY', 500000, '2020-08-26 15:42:57', '2020-09-24 21:21:01');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_book`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_book` (
`id_pesanan` char(6)
,`kode_booking` char(15)
,`id_member` char(11)
,`tgl_booking` date
,`jam_main` time
,`nama_pemesan` varchar(50)
,`alamat_pemesan` varchar(255)
,`email_pemesan` varchar(150)
,`no_telp_pemesan` varchar(13)
,`jenis_pelanggan` enum('Member','Tamu')
,`id_lapangan` int(11)
,`nama_lapangan` varchar(50)
,`deskripsi` varchar(255)
,`harga_lapangan` double
,`id_fasilitas` char(5)
,`diskon_member` int(11)
,`id_paket_barang` char(6)
,`nama_paket_alat` varchar(50)
,`harga_paket_alat` double
,`id_paket_mobil` char(6)
,`nama_paket_mobil` varchar(50)
,`harga_paket_mobil` double
,`total_harga` double
,`tgl_pesan` datetime
,`status_pesanan` enum('Pending','Accept','Reject')
,`tanggal_bayar` datetime
,`bukti_bayar` varchar(255)
,`total_bayar` double
,`admin_cek` char(7)
,`nama_admin` varchar(35)
,`email` varchar(150)
,`no_telp` varchar(13)
,`level_admin` enum('Admin','Super Admin')
,`keterangan_status` varchar(255)
,`update_at` datetime
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_lapangan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_lapangan` (
`id_detail_lapangan` int(11)
,`id_lapangan` char(6)
,`nama_lapangan` varchar(50)
,`deskripsi` varchar(255)
,`create_at` datetime
,`banyak_penyewa` int(11)
,`harga_sewa_weekday` double
,`harga_sewa_weekend` double
,`update_at` datetime
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_payment`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_payment` (
`id_payment` int(11)
,`id_member` char(11)
,`nama_member` varchar(50)
,`email_member` varchar(150)
,`no_telp` varchar(13)
,`tempat_lahir` varchar(35)
,`tgl_lahir` date
,`alamat` varchar(255)
,`price` double
,`payment_date` datetime
,`start_from` date
,`end_before` date
,`status_payment` enum('Pending','Accept','Reject')
,`admin_cek` char(7)
,`nama_admin` varchar(35)
,`email_admin` varchar(150)
,`no_telp_admin` varchar(13)
,`level` enum('Admin','Super Admin')
,`keterangan_status` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_book`
--
DROP TABLE IF EXISTS `v_book`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_book`  AS  select `b`.`id_pesanan` AS `id_pesanan`,`b`.`kode_booking` AS `kode_booking`,`b`.`id_member` AS `id_member`,`b`.`tgl_booking` AS `tgl_booking`,`b`.`jam_main` AS `jam_main`,`b`.`nama_pemesan` AS `nama_pemesan`,`b`.`alamat_pemesan` AS `alamat_pemesan`,`b`.`email` AS `email_pemesan`,`b`.`no_telp` AS `no_telp_pemesan`,`b`.`jenis_pelanggan` AS `jenis_pelanggan`,`b`.`id_lapangan` AS `id_lapangan`,`v`.`nama_lapangan` AS `nama_lapangan`,`v`.`deskripsi` AS `deskripsi`,`b`.`harga_lapangan` AS `harga_lapangan`,`b`.`id_fasilitas` AS `id_fasilitas`,`f`.`diskon_member` AS `diskon_member`,`b`.`id_paket_barang` AS `id_paket_barang`,`pb`.`nama_paket` AS `nama_paket_alat`,`pb`.`harga_paket` AS `harga_paket_alat`,`b`.`id_paket_mobil` AS `id_paket_mobil`,`pm`.`nama_paket` AS `nama_paket_mobil`,`pm`.`harga_paket` AS `harga_paket_mobil`,`b`.`total_harga` AS `total_harga`,`b`.`tgl_pesan` AS `tgl_pesan`,`b`.`status_pesanan` AS `status_pesanan`,`b`.`tanggal_bayar` AS `tanggal_bayar`,`b`.`bukti_bayar` AS `bukti_bayar`,`b`.`total_bayar` AS `total_bayar`,`b`.`admin_cek` AS `admin_cek`,`a`.`nama_admin` AS `nama_admin`,`a`.`email` AS `email`,`a`.`no_telp` AS `no_telp`,`a`.`level` AS `level_admin`,`b`.`keterangan_status` AS `keterangan_status`,`b`.`update_at` AS `update_at` from ((((((`tbl_booking` `b` left join `tbl_member` `m` on(`b`.`id_member` = `m`.`id_member`)) join `v_lapangan` `v` on(`b`.`id_lapangan` = `v`.`id_detail_lapangan`)) left join `tbl_fasilitas_member` `f` on(`b`.`id_fasilitas` = `f`.`id_fasilitas`)) left join `tbl_paket_sewa` `pb` on(`b`.`id_paket_barang` = `pb`.`id_paket`)) left join `tbl_paket_sewa` `pm` on(`b`.`id_paket_mobil` = `pm`.`id_paket`)) left join `tbl_admin` `a` on(`b`.`admin_cek` = `a`.`id_admin`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_lapangan`
--
DROP TABLE IF EXISTS `v_lapangan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_lapangan`  AS  select `dl`.`id_detail_lapangan` AS `id_detail_lapangan`,`dl`.`id_lapangan` AS `id_lapangan`,`l`.`nama_lapangan` AS `nama_lapangan`,`l`.`deskripsi` AS `deskripsi`,`l`.`create_at` AS `create_at`,`dl`.`banyak_penyewa` AS `banyak_penyewa`,`dl`.`harga_sewa_weekday` AS `harga_sewa_weekday`,`dl`.`harga_sewa_weekend` AS `harga_sewa_weekend`,`dl`.`update_at` AS `update_at` from (`tbl_dtl_lapangan` `dl` join `tbl_lapangan` `l` on(`dl`.`id_lapangan` = `l`.`id_lapangan`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_payment`
--
DROP TABLE IF EXISTS `v_payment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_payment`  AS  select `p`.`id_payment` AS `id_payment`,`p`.`id_member` AS `id_member`,`m`.`nama_member` AS `nama_member`,`m`.`email` AS `email_member`,`m`.`no_telp` AS `no_telp`,`m`.`tempat_lahir` AS `tempat_lahir`,`m`.`tgl_lahir` AS `tgl_lahir`,`m`.`alamat` AS `alamat`,`p`.`price` AS `price`,`p`.`payment_date` AS `payment_date`,`p`.`start_from` AS `start_from`,`p`.`end_before` AS `end_before`,`p`.`status_payment` AS `status_payment`,`p`.`admin_cek` AS `admin_cek`,`a`.`nama_admin` AS `nama_admin`,`a`.`email` AS `email_admin`,`a`.`no_telp` AS `no_telp_admin`,`a`.`level` AS `level`,`p`.`keterangan_status` AS `keterangan_status` from ((`tbl_payment_member` `p` join `tbl_member` `m` on(`p`.`id_member` = `m`.`id_member`)) left join `tbl_admin` `a` on(`p`.`admin_cek` = `a`.`id_admin`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_lapangan` (`id_lapangan`),
  ADD KEY `id_fasilitas` (`id_fasilitas`),
  ADD KEY `id_paket_barang` (`id_paket_barang`),
  ADD KEY `id_paket_mobil` (`id_paket_mobil`),
  ADD KEY `admin_cek` (`admin_cek`);

--
-- Indeks untuk tabel `tbl_detail_fasilitas`
--
ALTER TABLE `tbl_detail_fasilitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fasilitas` (`id_fasilitas`);

--
-- Indeks untuk tabel `tbl_detail_paket_sewa`
--
ALTER TABLE `tbl_detail_paket_sewa`
  ADD PRIMARY KEY (`id_detail_sewa`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `tbl_dtl_lapangan`
--
ALTER TABLE `tbl_dtl_lapangan`
  ADD PRIMARY KEY (`id_detail_lapangan`),
  ADD KEY `id_lapangan` (`id_lapangan`);

--
-- Indeks untuk tabel `tbl_fasilitas_member`
--
ALTER TABLE `tbl_fasilitas_member`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `tbl_lapangan`
--
ALTER TABLE `tbl_lapangan`
  ADD PRIMARY KEY (`id_lapangan`);

--
-- Indeks untuk tabel `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`id_member`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `tbl_paket_sewa`
--
ALTER TABLE `tbl_paket_sewa`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `tbl_payment_member`
--
ALTER TABLE `tbl_payment_member`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `admin_cek` (`admin_cek`);

--
-- Indeks untuk tabel `tbl_price_member`
--
ALTER TABLE `tbl_price_member`
  ADD PRIMARY KEY (`id_price`),
  ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_fasilitas`
--
ALTER TABLE `tbl_detail_fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_paket_sewa`
--
ALTER TABLE `tbl_detail_paket_sewa`
  MODIFY `id_detail_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_dtl_lapangan`
--
ALTER TABLE `tbl_dtl_lapangan`
  MODIFY `id_detail_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_payment_member`
--
ALTER TABLE `tbl_payment_member`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80573195;

--
-- AUTO_INCREMENT untuk tabel `tbl_price_member`
--
ALTER TABLE `tbl_price_member`
  MODIFY `id_price` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD CONSTRAINT `tbl_booking_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `tbl_member` (`id_member`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_booking_ibfk_3` FOREIGN KEY (`id_fasilitas`) REFERENCES `tbl_fasilitas_member` (`id_fasilitas`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_booking_ibfk_4` FOREIGN KEY (`id_paket_barang`) REFERENCES `tbl_paket_sewa` (`id_paket`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_booking_ibfk_5` FOREIGN KEY (`id_paket_mobil`) REFERENCES `tbl_paket_sewa` (`id_paket`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_booking_ibfk_6` FOREIGN KEY (`admin_cek`) REFERENCES `tbl_admin` (`id_admin`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_booking_ibfk_7` FOREIGN KEY (`id_lapangan`) REFERENCES `tbl_dtl_lapangan` (`id_detail_lapangan`);

--
-- Ketidakleluasaan untuk tabel `tbl_detail_fasilitas`
--
ALTER TABLE `tbl_detail_fasilitas`
  ADD CONSTRAINT `tbl_detail_fasilitas_ibfk_1` FOREIGN KEY (`id_fasilitas`) REFERENCES `tbl_fasilitas_member` (`id_fasilitas`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_detail_paket_sewa`
--
ALTER TABLE `tbl_detail_paket_sewa`
  ADD CONSTRAINT `tbl_detail_paket_sewa_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `tbl_paket_sewa` (`id_paket`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_dtl_lapangan`
--
ALTER TABLE `tbl_dtl_lapangan`
  ADD CONSTRAINT `tbl_dtl_lapangan_ibfk_1` FOREIGN KEY (`id_lapangan`) REFERENCES `tbl_lapangan` (`id_lapangan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_fasilitas_member`
--
ALTER TABLE `tbl_fasilitas_member`
  ADD CONSTRAINT `tbl_fasilitas_member_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `tbl_admin` (`id_admin`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `tbl_payment_member`
--
ALTER TABLE `tbl_payment_member`
  ADD CONSTRAINT `tbl_payment_member_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `tbl_member` (`id_member`),
  ADD CONSTRAINT `tbl_payment_member_ibfk_2` FOREIGN KEY (`admin_cek`) REFERENCES `tbl_admin` (`id_admin`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `tbl_price_member`
--
ALTER TABLE `tbl_price_member`
  ADD CONSTRAINT `tbl_price_member_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `tbl_admin` (`id_admin`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

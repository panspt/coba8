-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 05:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_bill`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(350) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `harga_barang` double NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_channel`
--

CREATE TABLE `tb_channel` (
  `id_channel` int(11) NOT NULL,
  `idps` int(11) NOT NULL,
  `nama_channel` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `kodepenjualan` varchar(350) NOT NULL,
  `kodebarang` varchar(350) NOT NULL,
  `jml` int(11) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `tgl_jam` datetime NOT NULL,
  `kode` varchar(350) NOT NULL,
  `jumlah` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id_member` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `kode` varchar(350) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tgl_laporan` date DEFAULT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `total` double NOT NULL,
  `dibayar` double NOT NULL,
  `sts_bayar` enum('L','B') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_member_aktif`
--

CREATE TABLE `tb_member_aktif` (
  `id_member_aktif` int(11) NOT NULL,
  `iduserdaf` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama_maktif` varchar(200) NOT NULL,
  `hp` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `gambar` text NOT NULL,
  `kode_maktif` varchar(350) NOT NULL,
  `askode` varchar(350) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `kode_mem` varchar(350) NOT NULL,
  `paket` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `judul_pengeluaran` varchar(350) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `kode_penjualan` varchar(350) NOT NULL,
  `kode_pembayaran` varchar(350) NOT NULL,
  `tgl_laporan` date NOT NULL,
  `tgl_penjualan` datetime DEFAULT NULL,
  `jml_total` double NOT NULL,
  `dibayar` double NOT NULL,
  `sts_bayar` enum('B','L','E','M') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ps`
--

CREATE TABLE `tb_ps` (
  `id_ps` int(11) NOT NULL,
  `jenis_ps` varchar(200) NOT NULL,
  `harga` double NOT NULL,
  `menit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rental`
--

CREATE TABLE `tb_rental` (
  `id_rental` int(11) NOT NULL,
  `idchannel` int(11) NOT NULL,
  `kode_member` varchar(350) NOT NULL,
  `start` datetime NOT NULL,
  `stop` datetime NOT NULL,
  `lama_rental` varchar(250) NOT NULL,
  `harga_rental` double NOT NULL,
  `aktif` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE `tb_setting` (
  `id_setting` int(11) NOT NULL,
  `judul` varchar(350) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_setting`
--

INSERT INTO `tb_setting` (`id_setting`, `judul`, `isi`) VALUES
(1, 'NAMA USAHA', 'DELTA PLAYSTATION'),
(2, 'ALAMAT', 'JL. BASUKI RAHMAT NO. 13'),
(3, 'TELP-/HP', '0812-5252-2525'),
(4, 'TEXT STRUK 1', 'AGUNG PLAYSTATION MENERIMA SEWA HARIAN, MINGGUAN & BULANAN SILAHKAN HUBUNGI  ADMIN AGUNG PLAYSTATIN'),
(5, 'TEXT STRUK 2', 'CATATAN : <br>\nMENGEMBALIKAN PS MELEBIHI BATAS WAKTUSEWA MAKA AKAN DIKENAKAN DENDA 10%\nDARI TOTAL'),
(6, 'TEXT STRUK 3', '- TERIMAKASIH ATAS KUNJUNGAN ANDA -');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sewa`
--

CREATE TABLE `tb_sewa` (
  `id_sewa` int(11) NOT NULL,
  `idps` int(11) NOT NULL,
  `jml_hari` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `harga_sewa` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sewakembali`
--

CREATE TABLE `tb_sewakembali` (
  `id_sewakembali` int(11) NOT NULL,
  `kodesewa` varchar(350) NOT NULL,
  `iduser` int(11) NOT NULL,
  `kode_sk` varchar(350) NOT NULL,
  `tgl_sk` datetime NOT NULL,
  `sisa_pembayaran` double NOT NULL,
  `dibayar` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sewaps`
--

CREATE TABLE `tb_sewaps` (
  `id_sewaps` int(11) NOT NULL,
  `kode_sewa` varchar(350) NOT NULL,
  `idps` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idmember` varchar(350) NOT NULL,
  `dari_tanggal` datetime NOT NULL,
  `sampai_tanggal` datetime NOT NULL,
  `jml_hari` int(11) NOT NULL,
  `total` double NOT NULL,
  `dibayar` double NOT NULL,
  `dbyasli` double NOT NULL,
  `sts_sewa` enum('A','K') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sewatambah`
--

CREATE TABLE `tb_sewatambah` (
  `id_sewatambah` int(11) NOT NULL,
  `kodesewa` varchar(350) NOT NULL,
  `kode_tambah` varchar(350) NOT NULL,
  `jml_hari` int(11) NOT NULL,
  `sisa_terakhir` double NOT NULL,
  `total` double NOT NULL,
  `dibayar` double NOT NULL,
  `iduser` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_shift`
--

CREATE TABLE `tb_shift` (
  `id_shift` int(11) NOT NULL,
  `judul_shift` varchar(200) NOT NULL,
  `dari_jam` time NOT NULL,
  `sampai_jam` time NOT NULL,
  `keterangan` text NOT NULL,
  `jns_shift` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(350) NOT NULL,
  `username` varchar(350) NOT NULL,
  `password` text NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(1, 'Master Admin', 'admin', '$2y$10$KX7k/AeoYHA4ML8lcWsp8OgcFJkEAD14tivZ6zbsVVMDyOQqSo3/O', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_channel`
--
ALTER TABLE `tb_channel`
  ADD PRIMARY KEY (`id_channel`);

--
-- Indexes for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `tb_member_aktif`
--
ALTER TABLE `tb_member_aktif`
  ADD PRIMARY KEY (`id_member_aktif`);

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `tb_ps`
--
ALTER TABLE `tb_ps`
  ADD PRIMARY KEY (`id_ps`);

--
-- Indexes for table `tb_rental`
--
ALTER TABLE `tb_rental`
  ADD PRIMARY KEY (`id_rental`);

--
-- Indexes for table `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tb_sewa`
--
ALTER TABLE `tb_sewa`
  ADD PRIMARY KEY (`id_sewa`);

--
-- Indexes for table `tb_sewakembali`
--
ALTER TABLE `tb_sewakembali`
  ADD PRIMARY KEY (`id_sewakembali`);

--
-- Indexes for table `tb_sewaps`
--
ALTER TABLE `tb_sewaps`
  ADD PRIMARY KEY (`id_sewaps`);

--
-- Indexes for table `tb_sewatambah`
--
ALTER TABLE `tb_sewatambah`
  ADD PRIMARY KEY (`id_sewatambah`);

--
-- Indexes for table `tb_shift`
--
ALTER TABLE `tb_shift`
  ADD PRIMARY KEY (`id_shift`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_channel`
--
ALTER TABLE `tb_channel`
  MODIFY `id_channel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `tb_member_aktif`
--
ALTER TABLE `tb_member_aktif`
  MODIFY `id_member_aktif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tb_ps`
--
ALTER TABLE `tb_ps`
  MODIFY `id_ps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_rental`
--
ALTER TABLE `tb_rental`
  MODIFY `id_rental` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_sewa`
--
ALTER TABLE `tb_sewa`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_sewakembali`
--
ALTER TABLE `tb_sewakembali`
  MODIFY `id_sewakembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_sewaps`
--
ALTER TABLE `tb_sewaps`
  MODIFY `id_sewaps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tb_sewatambah`
--
ALTER TABLE `tb_sewatambah`
  MODIFY `id_sewatambah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_shift`
--
ALTER TABLE `tb_shift`
  MODIFY `id_shift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

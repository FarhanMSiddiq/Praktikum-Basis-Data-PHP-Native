-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Des 2021 pada 08.53
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_farhan_ms`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` char(50) DEFAULT NULL,
  `kode_supplier` varchar(10) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT current_timestamp(),
  `jumlah_barang` int(5) DEFAULT NULL,
  `price` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `kode_supplier`, `tanggal_masuk`, `jumlah_barang`, `price`) VALUES
('ABC', 'Sakatonik ABC', 'SUP4', '2021-12-19', 50, 20000),
('BCK', 'chitato ayam', 'SUP1', '2021-02-02', 350, 14000),
('BDSM', 'LEM POWER BLUE', 'SUP4', '2021-01-01', 220, 23000),
('BSQC', 'POTATO BEE', 'SUP2', '2021-02-02', 300, 20000),
('BY', 'YAKULT', 'SUP5', '2021-04-02', 200, 40000),
('BZEDT', 'SHAMPO CLEAR', 'SUP3', '2021-02-01', 100, 15000),
('TST', 'Fresh Milk Pa Tani', 'SUP3', '2021-12-20', 20, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kode_pelanggan` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telp` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`kode_pelanggan`, `nama`, `no_telp`) VALUES
('P111', 'Farhan', '08981323730'),
('P112', 'Maulana', '08981323731'),
('P113', 'Siddiq', '08981323732'),
('P114', 'Panjul', '0898121312');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `kode_penjualan` varchar(20) NOT NULL,
  `kode_barang` varchar(20) DEFAULT NULL,
  `kode_pelanggan` varchar(15) DEFAULT NULL,
  `banyaknya` varchar(10) DEFAULT NULL,
  `total_transaksi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`kode_penjualan`, `kode_barang`, `kode_pelanggan`, `banyaknya`, `total_transaksi`) VALUES
('KP002', 'BSQ', 'P111', '1', '20000'),
('KP003', 'BZEDT', 'P112', '1', '22000'),
('KP004', 'BDSM', 'P113', '3', '24000'),
('KP005', 'BDSM', 'P114', '2', '28000'),
('KP006', 'BY', 'P114', '5', '30000'),
('KP007', 'BY', 'P114', '3', '35000'),
('KP008', 'ABC', 'P114', '10', '200000'),
('KP009', 'BCK', 'P111', '2', '28000'),
('KP010', 'ABC', 'P112', '3', '60000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `kode_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(20) DEFAULT NULL,
  `lokasi` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `lokasi`) VALUES
('SUP1', 'Agen Ciki', 'Jatinegara'),
('SUP2', 'Distributor Coklat', 'Pancoran'),
('SUP3', 'Distributor Coklat', 'Pancoran'),
('SUP4', 'Toko Sebelah', 'Jakarta'),
('SUP5', 'Toko Samping', 'Bekasi'),
('SUP6', 'Toko Langsing', 'Jawa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kode_penjualan`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

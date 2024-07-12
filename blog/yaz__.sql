-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 02 Tem 2024, 00:28:31
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `yazı`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog`
--

CREATE TABLE `blog` (
  `id` int(50) NOT NULL,
  `adsoyad` varchar(50) NOT NULL,
  `konusu` varchar(50) NOT NULL,
  `yazı` varchar(5000) NOT NULL,
  `yazan` varchar(50) NOT NULL,
  `yayınlamatarihi` datetime NOT NULL DEFAULT current_timestamp(),
  `yazan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici_bilgileri`
--

CREATE TABLE `kullanici_bilgileri` (
  `id` int(10) UNSIGNED NOT NULL,
  `kullaniciadi` varchar(50) NOT NULL,
  `eposta` varchar(100) NOT NULL,
  `sifre` varchar(100) NOT NULL,
  `adi` varchar(100) DEFAULT NULL,
  `soyadi` varchar(100) DEFAULT NULL,
  `adres` varchar(100) NOT NULL,
  `ilce` varchar(20) NOT NULL,
  `il` varchar(20) NOT NULL,
  `kayittarihi` datetime NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `kullanici_bilgileri`
--

INSERT INTO `kullanici_bilgileri` (`id`, `kullaniciadi`, `eposta`, `sifre`, `adi`, `soyadi`, `adres`, `ilce`, `il`, `kayittarihi`, `reset_token`) VALUES
(27, 'Ahmet1', 'a1@a.com', '$2y$10$F2UOdnz.S97BbjQ8wC8vCem9.YgpJ7ZAqgNzRuTV0birDTh2a1PZO', NULL, NULL, '', '', '', '2024-03-19 09:32:47', NULL),
(28, 'ahmet4', 'a@a.net', '$2y$10$hNkyxg080eMgkPdUMWzZjuDUkaZQPv.W2mvdb8LFSU5xoexXC3U5O', NULL, NULL, '', '', '', '2024-03-19 09:38:23', NULL),
(29, 'ahmet41', 'a@a1.net', '$2y$10$nr20a96pKlNy0ErWqbwymutTLtmn/awi9ZN3Zwnx5UH5qNWitl8ZO', NULL, NULL, '', '', '', '2024-03-19 09:38:53', NULL),
(30, 'iiii', 'i@ii.com', '$2y$10$2QawwC2s/WU18Ee8UAloNedNNQhOXP1wD9e32XPv/EiedjQI.Neoy', NULL, NULL, '', '', '', '2024-03-19 10:15:02', NULL),
(31, 'iii33', 'i3@ii.com', '$2y$10$FZ1PuksJ8sjBdRouENUTIu32zYE7yft3wTK8VnGGo9XNFdBhFElUy', NULL, NULL, '', '', '', '2024-03-19 10:26:04', NULL),
(33, 'Salih9', 'tetiksalih47@gmail.com', '$2y$10$ozMrwsG.j6cRcmm0qkxwM.kDUza8KcaUGIzlpxUBGXwFy/nrYM28a', 'Salih', 'Tetik', 'Afyon', 'Merkez', 'Afyonkarahisar', '2024-03-26 09:03:50', '8cc6d17f31aedcea210879f9ddd3b7e4'),
(34, 'Salih99', 'salih@gmail.com', '$2y$10$tSsfjG3CHvSeOkC.UDZeH.QfVfmUinCfgjq6o/KsV9hvk.vVp5SLK', 'ee', 'ee', 'ee', 'ee', 'ee', '2024-06-01 17:43:35', NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanici_bilgileri`
--
ALTER TABLE `kullanici_bilgileri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`kullaniciadi`),
  ADD UNIQUE KEY `eposta` (`eposta`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici_bilgileri`
--
ALTER TABLE `kullanici_bilgileri`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

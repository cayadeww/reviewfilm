-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 20 Mar 2025 pada 06.14
-- Versi server: 8.0.30
-- Versi PHP: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reviewfilm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('cdewi5323@gmail.com|127.0.0.1', 'i:1;', 1742365855),
('cdewi5323@gmail.com|127.0.0.1:timer', 'i:1742365855;', 1742365855);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `films`
--

CREATE TABLE `films` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sinopsis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_trailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_rilis` int NOT NULL,
  `durasi` int NOT NULL,
  `sutradara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_genre` bigint UNSIGNED NOT NULL,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `id_users` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `films`
--

INSERT INTO `films` (`id`, `judul`, `sinopsis`, `url_trailer`, `tahun_rilis`, `durasi`, `sutradara`, `gambar`, `id_genre`, `id_kategori`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 'Inception', 'Seorang pencuri yang bisa masuk ke dalam mimpi orang lain ditugaskan untuk menanamkan sebuah ide ke dalam pikiran targetnya.', 'https://youtu.be/YoHD9XEInc0?si=aw4OQE7lBsXkuBtc', 2010, 147, 'Christopher Nolan', 'film_images/dWwYRv6dgClrdm1IGRVHQjozR3iOqqGvW27BblU5.jpg', 11, 2, 1, '2025-03-17 12:06:24', '2025-03-17 23:01:37'),
(2, 'The Dark Knight', 'Batman harus menghadapi Joker yang menyebabkan kekacauan di Gotham City dengan rencana kriminalnya yang jenius.', 'https://youtu.be/EXeTwQWrcwY?si=SY0X8EIX-oIrxev_', 2008, 152, 'Christopher Nolan', 'film_images/VFzkYMYSAtNhdxUtIelJbHeNO5Tn4nvtCkSXcRG1.jpg', 1, 2, 1, '2025-03-17 12:08:49', '2025-03-17 12:08:49'),
(6, 'Parasite', 'Sebuah keluarga miskin menyusup ke dalam kehidupan keluarga kaya dengan cara yang cerdik, hingga akhirnya situasi berubah menjadi tak terkendali.', 'https://youtu.be/5xH0HfJHsaY?si=AI35rPLIm-TUeq01', 2019, 132, 'Bong Joon-ho', 'film_images/3IaAcgSkIjVC0pkm1AcAUs4lLGZ6vLlddwE6rSBN.jpg', 6, 3, 1, '2025-03-17 12:14:04', '2025-03-17 12:14:04'),
(7, 'The Revenant', 'Seorang penjelajah bernama Hugh Glass harus bertahan hidup di alam liar setelah dikhianati oleh rekan-rekannya dan ditinggalkan dalam kondisi sekarat.', 'https://youtu.be/LoebZZ8K5N0?si=epoKXNMywBlqFbSO', 2015, 156, 'Alejandro González Iñárritu', 'film_images/FgBC8jQFWP3KaxfQdVgXb88z03eSA67HSwTZj3MZ.jpg', 2, 3, 1, '2025-03-17 12:17:20', '2025-03-17 12:17:20'),
(8, 'The Hangover', 'Sekelompok sahabat mengalami malam penuh kekacauan di Las Vegas setelah pesta bujang, dan mereka harus mencari tahu apa yang terjadi.', 'https://youtu.be/tlize92ffnY?si=nxoPDyTe3yTkpz0t', 2009, 100, 'Todd Phillips', 'film_images/pnFO13We9E6GrPb7cOE3wdS1Eblm1wKpl83Jsomk.jpg', 4, 3, 1, '2025-03-17 12:21:05', '2025-03-17 12:21:05'),
(9, 'Harry Potter and the Sorcerer’s Stone', 'Seorang anak yatim piatu bernama Harry Potter menemukan bahwa ia adalah seorang penyihir dan memulai petualangan di sekolah sihir Hogwarts', 'https://youtu.be/VyHV0BRtdxo?si=XdQ5GcAOf9oZoZTd', 2001, 152, 'Chris Columbus', 'film_images/74O29OGMsUvbJmfDtu56T48ZO0e2F5teVWLUpJEO.jpg', 7, 1, 2, '2025-03-17 19:12:18', '2025-03-17 23:37:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `film_pemeran`
--

CREATE TABLE `film_pemeran` (
  `id` bigint UNSIGNED NOT NULL,
  `id_film` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemeran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `film_pemeran`
--

INSERT INTO `film_pemeran` (`id`, `id_film`, `nama`, `pemeran`, `created_at`, `updated_at`) VALUES
(1, 1, 'Leonardo DiCaprio', 'Dom Cobb', '2025-03-17 13:09:31', '2025-03-17 13:09:31'),
(2, 9, 'Daniel Radcliffe', 'Harry Potter', '2025-03-19 03:57:13', '2025-03-19 03:57:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `genre`
--

CREATE TABLE `genre` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `genre`
--

INSERT INTO `genre` (`id`, `nama_genre`, `created_at`, `updated_at`) VALUES
(1, 'Action', '2025-03-17 11:35:32', '2025-03-17 11:35:32'),
(2, 'Adventure', '2025-03-17 11:36:06', '2025-03-17 11:36:06'),
(4, 'Comedy', '2025-03-17 11:36:53', '2025-03-17 11:36:53'),
(5, 'Crime', '2025-03-17 18:39:45', '2025-03-17 18:39:45'),
(6, 'Drama', '2025-03-17 18:39:45', '2025-03-17 18:39:45'),
(7, 'Fantasy', '2025-03-17 18:39:45', '2025-03-17 18:39:45'),
(8, 'Horror', '2025-03-17 18:39:45', '2025-03-17 18:39:45'),
(9, 'Mystery', '2025-03-17 18:39:45', '2025-03-17 18:39:45'),
(10, 'Romance', '2025-03-17 18:39:45', '2025-03-17 18:39:45'),
(11, 'Sci-Fi', '2025-03-17 18:39:45', '2025-03-17 18:39:45'),
(12, 'Thriller', '2025-03-17 18:39:45', '2025-03-19 19:41:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Semua Umur', '2025-03-17 18:43:34', '2025-03-17 18:43:34'),
(2, 'R13+', '2025-03-17 18:43:34', '2025-03-17 18:43:34'),
(3, 'R17+', '2025-03-17 18:43:34', '2025-03-17 18:43:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komens`
--

CREATE TABLE `komens` (
  `id` bigint UNSIGNED NOT NULL,
  `id_film` bigint UNSIGNED NOT NULL,
  `id_users` bigint UNSIGNED NOT NULL,
  `komen` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `komens`
--

INSERT INTO `komens` (`id`, `id_film`, `id_users`, `komen`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'bagus', '2025-03-18 23:37:52', '2025-03-18 23:37:52'),
(2, 7, 3, 'keren', '2025-03-19 15:38:39', '2025-03-19 15:38:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_07_014004_create_database', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `id` bigint UNSIGNED NOT NULL,
  `id_film` bigint UNSIGNED NOT NULL,
  `id_users` bigint UNSIGNED NOT NULL,
  `rating` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Rating dari 1-5',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rating`
--

INSERT INTO `rating` (`id`, `id_film`, `id_users`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '4', '2025-03-18 23:37:52', '2025-03-18 23:37:52'),
(2, 2, 3, '5', '2025-03-19 15:33:49', '2025-03-19 15:33:49'),
(4, 7, 3, '5', '2025-03-19 15:38:39', '2025-03-19 15:38:39'),
(5, 6, 3, '4', '2025-03-19 20:47:13', '2025-03-19 20:47:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('JHiKQknYsiCIBzlMWNKdnT1UuIJYV6bURfKSB91B', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMHByYjlWR0xkRExXalVyTjE0ZDVuSTQzOGVFYzh0OUpacjBTbzU4OSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9maWxtIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1742446463);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '2025-03-17 11:11:26', '$2y$12$4VCl.3INQSsZARfIVszxMeovtSzL2prcuhrnCZPgZ3qPQ5BK1dD.W', 'XYVGVhTDWyh6XzPv1mfmdRmbMdVhYzdcTkwu9VmWGDISGYUDw0iJixG18a52', '2025-03-17 11:11:26', '2025-03-17 11:11:26'),
(2, 'author', 'author@gmail.com', 'author', NULL, '$2y$12$2cTFwRLmxVV5BaSLfcq19.8DAb1DVqXZe2ikD1hiKDnOxaTosz0b2', NULL, '2025-03-17 11:16:19', '2025-03-17 11:16:19'),
(3, 'caca', 'user@gmail.com', 'user', NULL, '$2y$12$4lRPFZqOlS6y1bDy.6GVKuVoqXWtF6HdK2NmDIYE.cINsqrmGfi4i', NULL, '2025-03-17 11:16:49', '2025-03-17 11:16:49'),
(4, 'nana', 'nana@gmail.com', 'user', NULL, '$2y$12$wHhKq.kHsuRkXsGbd0iyre2/vhguS66YTx5yLqllFqQP3ivf2644u', NULL, '2025-03-17 20:08:17', '2025-03-17 20:08:17'),
(5, 'cia', 'cia@gmail.com', 'user', NULL, '$2y$12$hGjBc2PN9poNPUKR68fb9O.HbshR63qSrMv3OaZrKCyvZEWv4vdu6', NULL, '2025-03-17 21:26:02', '2025-03-17 21:26:02'),
(7, 'miana', 'miana@gmail.com', 'user', NULL, '$2y$12$o7E9MHsQ.09jqRXI5KXv2eyPEo2L99uprmgIJ5MCSHDIMIyKQLczu', NULL, '2025-03-18 23:40:03', '2025-03-18 23:40:03'),
(8, 'miaaa', 'mia@gmail.com', 'user', NULL, '$2y$12$ZGirbxbFayDYeU8iueyW7eJQ0jbCUwoaUeGEiALLGxgE9EGC.tcB.', NULL, '2025-03-19 00:12:31', '2025-03-19 00:12:31'),
(9, 'tesa', 'tesa@gmail.com', 'user', NULL, '$2y$12$f7/yEsffCOheXIPalK2fCu99XTjjRRVXwpeNC9W066rOMPIUUrXWy', NULL, '2025-03-19 04:39:50', '2025-03-19 05:07:09'),
(11, 'contoh', 'contoh@gmail.com', 'user', NULL, '$2y$12$O5dICJkmX1Yr1M8KOWvIaurWv4nqjnAjvEbR5aUuCLj9EbYY0TlPK', NULL, '2025-03-19 21:37:23', '2025-03-19 21:37:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`),
  ADD KEY `films_id_genre_foreign` (`id_genre`),
  ADD KEY `films_id_kategori_foreign` (`id_kategori`),
  ADD KEY `films_id_users_foreign` (`id_users`);

--
-- Indeks untuk tabel `film_pemeran`
--
ALTER TABLE `film_pemeran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `film_pemeran_id_film_foreign` (`id_film`);

--
-- Indeks untuk tabel `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komens`
--
ALTER TABLE `komens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komens_id_film_foreign` (`id_film`),
  ADD KEY `komens_id_users_foreign` (`id_users`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_id_film_foreign` (`id_film`),
  ADD KEY `rating_id_users_foreign` (`id_users`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `films`
--
ALTER TABLE `films`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `film_pemeran`
--
ALTER TABLE `film_pemeran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `genre`
--
ALTER TABLE `genre`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `komens`
--
ALTER TABLE `komens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_id_genre_foreign` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `films_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `films_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `film_pemeran`
--
ALTER TABLE `film_pemeran`
  ADD CONSTRAINT `film_pemeran_id_film_foreign` FOREIGN KEY (`id_film`) REFERENCES `films` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komens`
--
ALTER TABLE `komens`
  ADD CONSTRAINT `komens_id_film_foreign` FOREIGN KEY (`id_film`) REFERENCES `films` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `komens_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_id_film_foreign` FOREIGN KEY (`id_film`) REFERENCES `films` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rating_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

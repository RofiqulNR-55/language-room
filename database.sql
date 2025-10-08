-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Okt 2025 pada 18.20
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2025_07_25_143735_create_users_table', 1),
(5, '2025_07_26_141847_create_pakets_table', 1),
(6, '2025_07_27_060240_create_transaksis_table', 1),
(7, '2025_07_27_135012_create_moduls_table', 1),
(8, '2025_07_27_172603_create_videos_table', 1),
(9, '2025_08_03_095843_create_quizzes_table', 2),
(11, '2025_08_04_045104_add_paket_id_to_moduls_table', 3),
(12, '2025_08_04_045132_add_paket_id_to_videos_table', 3),
(13, '2025_08_04_045149_add_paket_id_to_quizzes_table', 3),
(14, '2025_09_23_040000_add_tipe_to_videos_table', 4),
(15, '2025_09_23_050000_add_expired_to_transaksis_table', 5),
(16, '2025_09_23_060000_add_durasi_to_pakets_table', 6),
(17, '2025_09_30_070000_add_folder_to_moduls_table', 7),
(18, '2025_09_30_080000_add_folder_to_videos_table', 8),
(19, '2025_09_30_080001_add_folder_to_quizzes_table', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `moduls`
--

CREATE TABLE `moduls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenjang` enum('sd','smp','sma') NOT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `moduls`
--

INSERT INTO `moduls` (`id`, `judul`, `jenjang`, `folder`, `file`, `created_at`, `updated_at`, `paket_id`) VALUES
(4, 'a', 'sd', 'reading', 'modul/Gw7y2UClKStrmNNf3NWnXYWBIx7PQJd4OjPe3HXa.pdf', '2025-09-30 03:41:57', '2025-09-30 03:41:57', NULL),
(5, 'grammer', 'sd', 'listening', 'modul/irWYa7GYCUNW7jLprak3oHlbM6dmFhUVXFJmDPpm.pdf', '2025-09-30 03:43:15', '2025-09-30 03:43:15', NULL),
(6, 'bbb', 'sd', 'reading', 'modul/maxt6MNfRjXjHklQiUf3eULAudTJLaVix3NEJmRQ.pdf', '2025-09-30 04:10:56', '2025-09-30 04:10:56', NULL),
(9, 'abc', 'sd', 'reading', 'modul/zAMNKjULTfYRy2CQHvd6YIYflGFvYIYbHjZu5qyf.pdf', '2025-09-30 06:51:17', '2025-09-30 06:51:17', NULL),
(10, 'aa', 'sd', 'reading', 'modul/9qWnCOlLOC6T8lR6KRBZ4F0XghyxMZn1CrFo0MUz.docx', '2025-09-30 06:58:43', '2025-09-30 06:58:43', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakets`
--

CREATE TABLE `pakets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `durasi` int(11) NOT NULL DEFAULT 30,
  `kategori` varchar(255) NOT NULL,
  `tipe` enum('online','offline') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pakets`
--

INSERT INTO `pakets` (`id`, `nama`, `deskripsi`, `harga`, `durasi`, `kategori`, `tipe`, `created_at`, `updated_at`) VALUES
(5, 'Junior Master', 'Paket ini dirancang khusus untuk siswa Sekolah Dasar, berfokus pada pengenalan dasar-dasar bahasa Inggris melalui metode yang menyenangkan. Materi mencakup kosa kata sehari-hari, tata bahasa sederhana, dan latihan percakapan.\r\n\r\nMateri yang Didapat: Akses ke video pembelajaran interaktif, game edukasi, kuis, dan simulasi percakapan dengan AI Chatbot.\r\n\r\nDurasi: 1 Bulan.', 200000, 30, 'SD', 'online', '2025-08-23 09:27:49', '2025-08-23 09:29:55'),
(6, 'Paket Master', 'Paket ini ideal untuk siswa Sekolah Menengah Pertama yang ingin memperkuat pemahaman materi kurikulum sekolah. Fokus pada peningkatan nilai akademis, pemahaman reading, writing, dan listening.\r\n\r\nMateri yang Didapat: Akses ke bank soal lengkap (PTS & PAS), video pembahasan materi per bab, dan modul PDF yang bisa diunduh.\r\n\r\nDurasi: 1 Bulan.', 300000, 30, 'SMP', 'online', '2025-08-23 09:29:44', '2025-08-23 09:30:49'),
(7, 'Paket Senior Master', 'Dirancang untuk siswa Sekolah Menengah Atas, paket ini berfokus pada persiapan menghadapi ujian penting dan tes standar.\r\n\r\nMateri yang Didapat: Modul materi lengkap untuk persiapan UTBK, TOEFL, dan IELTS, serta bank soal dan latihan soal intensif.\r\n\r\nDurasi: 1 Bulan.', 500000, 30, 'SMA', 'online', '2025-08-23 09:30:30', '2025-08-23 09:30:30'),
(8, 'Paket Privat SD', 'Belajar 1-on-1 dengan pengajar yang berpengalaman. Materi dan kurikulum disesuaikan sepenuhnya dengan kebutuhan spesifik siswa SD.\r\n\r\nMateri yang Didapat: 8 sesi belajar privat per bulan, laporan perkembangan berkala, dan kebebasan memilih jadwal belajar.', 200000, 30, 'SD', 'offline', '2025-08-23 09:31:46', '2025-08-23 09:31:46'),
(9, 'Paket Privat SMP', 'Belajar privat yang fokus pada penguasaan materi sekolah dan persiapan ujian. Cocok untuk siswa yang membutuhkan bimbingan lebih intensif.\r\n\r\nMateri yang Didapat: 8 sesi belajar privat per bulan, sesi konsultasi, dan jadwal belajar yang fleksibel.', 400000, 30, 'SMP', 'offline', '2025-08-23 09:32:13', '2025-08-23 09:32:13'),
(10, 'Paket Privat SMA', 'Belajar privat intensif untuk siswa SMA, khusus untuk persiapan ujian nasional dan tes masuk universitas.\r\n\r\nMateri yang Didapat: 8 sesi belajar privat per bulan, materi khusus untuk UTBK, TOEFL, dan IELTS, serta bimbingan personal dari pengajar.', 500000, 30, 'SMA', 'offline', '2025-08-23 09:32:38', '2025-08-23 09:32:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `quiz_link` varchar(255) NOT NULL,
  `jenjang` enum('sd','smp','sma') NOT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `quiz_link`, `jenjang`, `folder`, `created_at`, `updated_at`, `paket_id`) VALUES
(6, 'aaa', 'https://wayground.com/embed/quiz/68a737f0dd7d01bacd67dec5', 'sd', 'bahasa inggris', '2025-09-30 06:51:41', '2025-09-30 06:51:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `start_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksis`
--

INSERT INTO `transaksis` (`id`, `user_id`, `paket_id`, `order_id`, `status`, `start_at`, `expired_at`, `created_at`, `updated_at`) VALUES
(85, 15, 5, 'ORDER-68d25ec8bb3c6', 'cancel', '2025-09-23 08:48:32', '2025-09-30 11:00:16', '2025-09-23 00:48:08', '2025-09-30 03:00:16'),
(86, 15, 5, 'ORDER-68d3ad42d12f2', 'pending', NULL, NULL, '2025-09-24 00:35:14', '2025-09-24 00:35:14'),
(87, 15, 8, 'ORDER-68d3b03d8b96e', 'cancel', '2025-09-24 08:48:49', '2025-09-30 11:00:28', '2025-09-24 00:47:57', '2025-09-30 03:00:28'),
(88, 15, 5, 'ORDER-68dbbbf6a2f14', 'cancel', '2025-09-30 11:16:31', '2025-09-30 11:17:38', '2025-09-30 03:16:06', '2025-09-30 03:17:38'),
(89, 15, 5, 'ORDER-68dbbcdae9810', 'success', '2025-09-30 11:20:18', '2025-10-30 11:20:18', '2025-09-30 03:19:54', '2025-09-30 03:20:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(9, 'admin', 'languangeroom@gmail.com', '$2y$10$w2aLrVIOpCKiu0AAS6SsVujqVuFEAvrQvb79hamxdrEMltrcnZ8He', 'admin', '2025-08-21 20:59:19', '2025-08-21 21:25:22'),
(13, 'iqbal eljan buazi', 'iqbaleljan09@gmail.com', '$2y$10$Ofymy.IWzpxj2Ggy6spfxOL85TbzVm0tQFRUYZuwQRvbBa0nDjniW', 'user', '2025-08-21 21:26:35', '2025-08-21 21:26:35'),
(15, 'iqbal eljan buazi', 'iqbaleljanbuazi2003@gmail.com', '$2y$10$mZ5pnj6an55DMJsOUvyFwuy3Q.eWgQ0EDuZDNvA6aj6OfuXe.qURC', 'user', '2025-09-22 18:51:46', '2025-09-22 18:51:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `jenjang` varchar(255) NOT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `tipe` varchar(255) NOT NULL DEFAULT 'link',
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `videos`
--

INSERT INTO `videos` (`id`, `judul`, `deskripsi`, `jenjang`, `folder`, `tipe`, `url`, `created_at`, `updated_at`, `paket_id`) VALUES
(11, 'listening', NULL, 'sd', 'reading', 'link', 'https://www.youtube.com/embed/owC80a8xHT4?si=BWIfmoyeGg45BfaC', '2025-09-30 03:59:09', '2025-09-30 04:06:52', NULL),
(12, 'vvv', NULL, 'sd', 'reading', 'link', 'https://www.youtube.com/embed/owC80a8xHT4?si=BWIfmoyeGg45BfaC', '2025-09-30 04:07:15', '2025-09-30 04:07:15', NULL),
(13, 'listening', NULL, 'sd', 'listening', 'link', 'https://www.youtube.com/embed/HlGwtSQW_eE?si=FkU0kg0D_YE3SjuW', '2025-09-30 06:52:09', '2025-09-30 06:52:09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `moduls`
--
ALTER TABLE `moduls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moduls_paket_id_foreign` (`paket_id`);

--
-- Indeks untuk tabel `pakets`
--
ALTER TABLE `pakets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_paket_id_foreign` (`paket_id`);

--
-- Indeks untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_user_id_foreign` (`user_id`),
  ADD KEY `transaksis_paket_id_foreign` (`paket_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_paket_id_foreign` (`paket_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `moduls`
--
ALTER TABLE `moduls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pakets`
--
ALTER TABLE `pakets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `moduls`
--
ALTER TABLE `moduls`
  ADD CONSTRAINT `moduls_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

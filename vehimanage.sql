/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : vehimanage

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 10/08/2023 14:23:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bookings
-- ----------------------------
DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(0) UNSIGNED NOT NULL,
  `vehicle_id` bigint(0) UNSIGNED NOT NULL,
  `driver_id` bigint(0) UNSIGNED NOT NULL,
  `pickup_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` time(0) NOT NULL,
  `approval_level` int(0) NOT NULL DEFAULT 0,
  `approval_by` bigint(0) UNSIGNED NULL DEFAULT NULL,
  `status` int(0) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `bookings_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `bookings_vehicle_id_foreign`(`vehicle_id`) USING BTREE,
  INDEX `bookings_driver_id_foreign`(`driver_id`) USING BTREE,
  INDEX `bookings_approval_by_foreign`(`approval_by`) USING BTREE,
  CONSTRAINT `bookings_approval_by_foreign` FOREIGN KEY (`approval_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bookings_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bookings_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bookings
-- ----------------------------
INSERT INTO `bookings` VALUES (2, 2, 1, 1, 'Sumbersari', 'Tanggul', '2023-08-10', '06:38:12', 4, 3, 2, '2023-08-08 18:39:17', '2023-08-10 11:22:19');
INSERT INTO `bookings` VALUES (3, 5, 3, 3, 'Sumbersari', 'Ambulu', '2023-08-10', '10:35:00', 4, 4, 2, '2023-08-09 22:36:00', '2023-08-10 13:56:02');
INSERT INTO `bookings` VALUES (4, 2, 1, 4, 'Balung', 'Sumbersari', '2023-08-11', '00:38:00', 2, 3, 1, '2023-08-09 22:38:20', '2023-08-10 11:22:30');
INSERT INTO `bookings` VALUES (5, 5, 5, 8, 'Balung', 'Sumbersari', '2023-08-10', '10:38:00', 3, 5, 2, '2023-08-10 22:38:49', '2023-08-10 12:34:00');
INSERT INTO `bookings` VALUES (6, 2, 1, 4, 'Balung', 'Sumbersari', '2023-08-10', '00:38:00', 2, 3, 1, '2023-08-09 22:38:20', '2023-08-10 11:17:23');
INSERT INTO `bookings` VALUES (7, 5, 2, 2, 'Malang', 'Surabaya', '2023-08-11', '01:33:00', 3, 5, 2, '2023-08-10 12:33:30', '2023-08-10 12:34:05');
INSERT INTO `bookings` VALUES (8, 5, 7, 9, 'Malang', 'Sidoarjo', '2023-08-07', '13:29:23', 2, 4, 1, '2023-08-10 13:29:50', '2023-08-10 13:29:54');
INSERT INTO `bookings` VALUES (9, 5, 4, 8, 'Sumbersari', 'Malang', '2023-08-10', '08:20:00', 2, 4, 1, '2023-08-10 14:17:22', '2023-08-10 14:22:35');

-- ----------------------------
-- Table structure for drivers
-- ----------------------------
DROP TABLE IF EXISTS `drivers`;
CREATE TABLE `drivers`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of drivers
-- ----------------------------
INSERT INTO `drivers` VALUES (1, 'Farhan Dani', '57930850', 'Jln. Orang No. 873, Kupang 45737, Bali', '021 7057 132', 1, '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `drivers` VALUES (2, 'Johan ', '65868409', 'Ki. Juanda No. 687, Bima 66800, Sulut', '0586 5086 0990', 1, '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `drivers` VALUES (3, 'Hairyanto Suryono ', '17804087', 'Gg. Raden No. 719, Medan 78057, Bali', '(+62) 506 3447 876', 1, '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `drivers` VALUES (4, 'Ramadan', '91672879', 'Kpg. Acordion No. 331, Bima 38480, Sulbar', '0509 0262 6488', 1, '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `drivers` VALUES (5, 'Abyasa Megantara', '51181345', 'Ki. Supono No. 552, Singkawang 19140, Banten', '029 4752 565', 0, '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `drivers` VALUES (6, 'Lukman Firgantoro', '99690191', 'Kpg. Nanas No. 342, Bengkulu 61689, Gorontalo', '0950 1999 548', 0, '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `drivers` VALUES (7, 'Yanto ', '3264537', 'Kpg. Sukajadi No. 147, Banjar 72026, Jabar', '0953 2656 939', 0, '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `drivers` VALUES (8, 'Jaga Cakrabirawa Marbun ', '29965410', 'Ds. Achmad Yani No. 42, Administrasi Jakarta Utara 44574, Jambi', '(+62) 816 8992 282', 1, '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `drivers` VALUES (9, 'Zalindra Kania Hassanah', '37853807', 'Dk. Pasteur No. 39, Dumai 18942, Sumbar', '(+62) 610 5763 4000', 0, '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `drivers` VALUES (10, 'Bakti Siregar', '45624996', 'Jln. Banda No. 809, Padang 78330, Aceh', '0456 5954 6122', 1, '2023-08-09 17:01:00', '2023-08-09 17:01:00');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for log_messages
-- ----------------------------
DROP TABLE IF EXISTS `log_messages`;
CREATE TABLE `log_messages`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(0) UNSIGNED NULL DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `log_messages_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `log_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_messages
-- ----------------------------
INSERT INTO `log_messages` VALUES (1, 1, 'User Gantar Pranowo  logged in.', '2023-08-10 14:13:10', '2023-08-10 14:13:10');
INSERT INTO `log_messages` VALUES (2, 1, 'Gantar Pranowo  created a new booking for Jane Winarsih dated 2023-08-10.', '2023-08-10 14:17:22', '2023-08-10 14:17:22');
INSERT INTO `log_messages` VALUES (3, 1, 'User Gantar Pranowo  logged out.', '2023-08-10 14:21:50', '2023-08-10 14:21:50');
INSERT INTO `log_messages` VALUES (4, 5, 'User Jane Winarsih logged in.', '2023-08-10 14:22:03', '2023-08-10 14:22:03');
INSERT INTO `log_messages` VALUES (5, 5, 'approve orders that have been made dated 2023-08-10.', '2023-08-10 14:22:08', '2023-08-10 14:22:08');
INSERT INTO `log_messages` VALUES (6, 5, 'User Jane Winarsih logged out.', '2023-08-10 14:22:19', '2023-08-10 14:22:19');
INSERT INTO `log_messages` VALUES (7, 4, 'User Gamani Harjasa Pratama  logged in.', '2023-08-10 14:22:30', '2023-08-10 14:22:30');
INSERT INTO `log_messages` VALUES (8, 4, 'approved the order for Jane Winarsih dated 2023-08-10.', '2023-08-10 14:22:35', '2023-08-10 14:22:35');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (50, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (51, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (52, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (53, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (54, '2023_08_08_150648_create_vehicles_table', 1);
INSERT INTO `migrations` VALUES (55, '2023_08_09_152247_create_drivers_table', 1);
INSERT INTO `migrations` VALUES (56, '2023_08_09_153336_create_bookings_table', 1);
INSERT INTO `migrations` VALUES (58, '2023_08_10_140915_create_log_messages_table', 2);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(0) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','supervisor','employee') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'employee',
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_id` bigint(0) UNSIGNED NULL DEFAULT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Gantar Pranowo ', 'vkuswandari', 'intan.wibowo@example.com', 'admin', '(+62) 744 9253 0784', NULL, '2023-08-09 17:01:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aW58j0NXfjLXHYm5pzBD1z7xSt7M6MHUQDebxO6OXH3BcMVyF6dMMzOl2ITh', '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `users` VALUES (2, 'Vino Satya Dabukke', 'parman76', 'handayani.cecep@example.com', 'employee', '0268 5842 7986', 3, '2023-08-09 17:01:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6MpQni3Ifa8GGlV1ZFOJkHlS3g3EMXz93pzHoScZadxVP3ogIkCRNUducGfg', '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `users` VALUES (3, 'Salwa Padmasari', 'ihasanah', 'hkusumo@example.com', 'supervisor', '(+62) 928 4062 4773', NULL, '2023-08-09 17:01:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Uz45YnBjeui3APRhZgX69ZuQGxdz9Yh6MtdDTUxV2msZ9qSwWAcnjgTmj8fS', '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `users` VALUES (4, 'Gamani Harjasa Pratama ', 'salsabila.marpaung', 'budiman.utama@example.org', 'supervisor', '0374 4081 1817', NULL, '2023-08-09 17:01:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CoOyP3mF01l8OMIPvZAwn5swuH05SvFvDXMQ30LeRbLKYsZWpcB5ttX8mtUL', '2023-08-09 17:01:00', '2023-08-09 17:01:00');
INSERT INTO `users` VALUES (5, 'Jane Winarsih', 'enteng33', 'kayun42@example.net', 'employee', '0666 9831 9880', 4, '2023-08-09 17:01:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'RFC2eDLXOZCDSAh7geCDen6yadWkWDiqlTwGvO14MfmozkKUNMrhq2tZ0bb2', '2023-08-09 17:01:00', '2023-08-09 17:01:00');

-- ----------------------------
-- Table structure for vehicles
-- ----------------------------
DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `merk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_plate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehicles
-- ----------------------------
INSERT INTO `vehicles` VALUES (1, 'Toyota Rush', 'SUV ', 'zy3-wfg', 'Magenta', '2019', '2023-08-09 14:09:32', '2023-08-09 14:09:32');
INSERT INTO `vehicles` VALUES (2, 'Suzuki XL7', 'SUV ', 'wd1-aam', 'Hitam Arang', '2021', '2023-08-09 14:09:32', '2023-08-09 14:09:32');
INSERT INTO `vehicles` VALUES (3, 'Honda HR-V', 'SUV ', 'pz5-srk', 'Biru Tua', '2020', '2023-08-09 14:09:32', '2023-08-09 14:09:32');
INSERT INTO `vehicles` VALUES (4, 'Wuling Almaz', 'SUV ', 'pj7-xpi', 'Peach', '2022', '2023-08-09 14:09:32', '2023-08-09 14:09:32');
INSERT INTO `vehicles` VALUES (5, 'Wuling Almaz 2', 'SUV ', 'xa9-qqo', 'Hijau Abu-Abu', '2020', '2023-08-09 14:09:32', '2023-08-09 14:09:32');
INSERT INTO `vehicles` VALUES (6, 'Suzuki XL7', 'SUV ', 'ct8-brr', 'Hijau Rumput', '2018', '2023-08-09 14:09:32', '2023-08-09 14:09:32');
INSERT INTO `vehicles` VALUES (7, 'Toyota Rush', 'SUV ', 'xi7-knk', 'Merah Tua Terang', '2023', '2023-08-09 14:09:32', '2023-08-09 14:09:32');
INSERT INTO `vehicles` VALUES (8, 'Toyota Rush', 'SUV ', 'vf4-iqq', 'Merah', '2020', '2023-08-09 14:09:32', '2023-08-09 14:09:32');
INSERT INTO `vehicles` VALUES (9, 'Toyota Rush', 'SUV ', 'zy8-eyd', 'Kuning Muda', '2019', '2023-08-09 14:09:32', '2023-08-09 14:09:32');
INSERT INTO `vehicles` VALUES (10, 'Toyota Rush', 'SUV ', 'xe7-pjo', 'Hijau Kebiruan', '2020', '2023-08-09 14:09:32', '2023-08-09 14:09:32');

SET FOREIGN_KEY_CHECKS = 1;

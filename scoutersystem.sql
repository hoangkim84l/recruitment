-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 15, 2018 lúc 11:11 AM
-- Phiên bản máy phục vụ: 10.1.24-MariaDB
-- Phiên bản PHP: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `scoutersystem`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `applies`
--

CREATE TABLE `applies` (
  `id` int(10) UNSIGNED NOT NULL,
  `candidate_id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `scouter_id` int(10) UNSIGNED NOT NULL,
  `jobstatus_id` int(3) UNSIGNED NOT NULL,
  `cv_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_note` text COLLATE utf8mb4_unicode_ci,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `applies`
--

INSERT INTO `applies` (`id`, `candidate_id`, `job_id`, `scouter_id`, `jobstatus_id`, `cv_url`, `message`, `company_note`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(6, 3, 3, 15, 3, '', 'Chờ kết qả', NULL, 0, NULL, NULL, NULL, '2018-05-03 00:00:00', '2018-05-03 00:00:00'),
(7, 4, 4, 16, 7, '', 'Đã nhận ứng viên', NULL, 0, NULL, NULL, NULL, '2018-05-06 00:00:00', '2018-05-06 00:00:00'),
(8, 4, 5, 14, 3, '', 'đã pv', NULL, 0, NULL, NULL, NULL, '2018-05-01 00:00:00', '2018-05-01 00:00:00'),
(9, 3, 5, 17, 1, '', 'fails', NULL, 1, NULL, NULL, NULL, '2018-05-08 00:00:00', '2018-05-09 17:20:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bonus_histories`
--

CREATE TABLE `bonus_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `apply_id` int(10) UNSIGNED NOT NULL,
  `scouter_id` int(10) UNSIGNED NOT NULL,
  `bonusstatus_id` int(1) UNSIGNED NOT NULL,
  `bonus_money` int(10) UNSIGNED NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `candidates`
--

CREATE TABLE `candidates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(2) UNSIGNED NOT NULL,
  `address_city_id` int(10) UNSIGNED NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_receive_flg` tinyint(2) UNSIGNED NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `email`, `gender`, `address_city_id`, `phone_number`, `tags`, `cv_url`, `email_receive_flg`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(3, 'candidates_01', 'candidates001@gmail.com', 1, 24, '01233456789', 'HTML', 'mycv.pdf', 0, 0, NULL, NULL, NULL, '2018-05-02 00:00:00', '2018-05-03 00:00:00'),
(4, 'candidate02', 'candidate002@gmail.com', 1, 12, '0123456852', 'JavaScript', 'khoi.pdf', 0, 0, NULL, NULL, NULL, '2018-05-08 00:00:00', '2018-05-09 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_vi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `list_order` int(10) UNSIGNED NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cities`
--

INSERT INTO `cities` (`id`, `code`, `name_vi`, `name_en`, `alias`, `description`, `list_order`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'VN', 'Việt Nam', '', 'viet-nam', 'Việt Nam', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'AG', 'An Giang', '', 'an-giang', 'An Giang', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'BRV', 'Bà Rịa Vũng Tàu', '', 'ba-ria-vung-tau', 'Bà Rịa Vũng Tàu', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'BD', 'Bình Dương', '', 'binh-duong', 'Bình Dương', 4, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'BP', 'Bình Phước', '', 'binh-phuoc', 'Bình Phước', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'BT', 'Bình Thuận', '', 'binh-thuan', 'Bình Thuận', 6, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'BĐ', 'Bình Định', '', 'binh-thuan', 'Bình Định', 7, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'BG', 'Bắc Giang', '', 'bac-giang', 'Bắc Giang', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'BC', 'Bắc Kạn', '', 'bac-can', 'Bắc Kạn', 9, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'BN', 'Bắc Ninh', '', 'bac-ninh', 'Bắc Ninh', 10, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'BT', 'Bến Tre', '', 'ben-tre', 'Bến Tre', 11, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'CB', 'Cao Bằng', '', 'cao-bang', 'Cao Bằng', 12, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'CM', 'Cà Mau', '', 'ca-mau', 'Cà Mau', 13, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'CT', 'Cần Thơ', '', 'can-tho', 'Cần Thơ', 14, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'GL', 'Gia Lai', '', 'gia-lai', 'Gia Lai', 15, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'HG', 'Hà Giang', '', 'ha-giang', 'Hà Giang', 16, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'HN', 'Hà Nam', '', 'ha-nam', 'Hà Nam', 17, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'HN', 'Hà Nội', '', 'ha-noi', 'Hà Nội', 18, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'HT', 'Hà Tĩnh', '', 'ha-tinh', 'Hà Tĩnh', 19, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'HB', 'Hòa Bình', '', 'hoa-binh', 'Hòa Bình', 20, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'HY', 'Hưng Yên', '', 'hung-yen', 'Hưng Yên', 21, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'HD', 'Hải Dương', '', 'hai-duong', 'Hải Dương', 22, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'HP', 'Hải Phòng', '', 'hai-phong', 'Hải Phòng', 23, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'HCM', 'Hồ Chí Minh', '', 'ho-chi-minh', 'Hồ Chí Minh', 24, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'KH', 'Khánh Hòa', '', 'khanh-hoa', 'Khánh Hòa', 25, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'KG', 'Kiên Giang', '', 'kien-giang', 'Kiên Giang', 26, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'KT', 'Kon Tum', '', 'kon-tum', 'Kon Tum', 27, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'LC', 'Lai Châu', '', 'lai-chau', 'Lai Châu', 28, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'LA', 'Long An', '', 'long-an', 'Long An', 29, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'LC', 'Lào Cai', '', 'lao-cai', 'Lào Cai', 30, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'LĐ', 'Lâm Đồng', '', 'lam-dong', 'Lâm Đồng', 31, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'LS', 'Lạng Sơn', '', 'lang-son', 'Lạng Sơn', 32, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'NĐ', 'Nam Định', '', 'nam-dinh', 'Nam Định', 33, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'NA', 'Nghệ An', '', 'nghe-an', 'Nghệ An', 34, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'NB', 'Ninh Bình', '', 'ninh-binh', 'Ninh Bình', 35, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'NT', 'Ninh Thuận', '', 'ninh-thuan', 'Ninh Thuận', 36, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'PT', 'Phú Thọ', '', 'phu-tho', 'Phú Thọ', 37, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'PY', 'Phú Yên', '', 'phu-yen', 'Phú Yên', 38, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'QN', 'Quảng Nam', '', 'quang-nam', 'Quảng Nam', 39, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'QN', 'Quảng Ngãi', '', 'quang-ngai', 'Quảng Ngãi', 40, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'QN', 'Quảng Ninh', '', 'quang-ninh', 'Quảng Ninh', 41, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'QT', 'Quảng Trị', '', 'quang-tri', 'Quảng Trị', 42, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'SL', 'Sơn La', '', 'son-la', 'Sơn La', 43, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'TH', 'Thanh Hóa', '', 'thanh-hoa', 'Thanh Hóa', 44, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'TB', 'Thái Bình', '', 'thai-binh', 'Thái Bình', 45, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'TN', 'Thái Nguyên', '', 'thai-nguyen', 'Thái Nguyên', 46, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'TTH', 'Thừa Thiên Huế', '', 'thua-thien-hue', 'Thừa Thiên Huế', 47, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'TG', 'Tiền Giang', '', 'tien-giang', 'Tiền Giang', 48, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'TV', 'Trà Vinh', '', 'tra-vinh', 'Trà Vinh', 49, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'TQ', 'Tuyên Quang', '', 'tuyen-quang', 'Tuyên Quang', 50, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'TN', 'Tây Ninh', '', 'tay-ninh', 'Tây Ninh', 51, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'VL', 'Vĩnh Long', '', 'vinh-long', 'Vĩnh Long', 52, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'VP', 'Vĩnh Phúc', '', 'vinh-phuc', 'Vĩnh Phúc', 53, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'YB', 'Yên Bái', '', 'yen-bai', 'Yên Bái', 54, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'ĐN', 'Đà Nẵng', '', 'da-nang', 'Đà Nẵng', 55, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'ĐL', 'Đắk Lắk', '', 'dak-lak', 'Đắk Lắk', 56, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'ĐN', 'Đồng Nai', '', 'dong-nai', 'Đồng Nai', 57, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'ĐT', 'Đồng Tháp', '', 'dong-thap', 'Đồng Tháp', 58, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'BL', 'Bạc Liêu', '', 'bac-lieu', 'Bạc Liêu', 59, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'ST', 'Sóc Trăng', '', 'soc-trang', 'Sóc Trăng', 60, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'HG', 'Hậu Giang', '', 'hau-giang', 'Hậu Giang', 61, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'ĐN', 'Đắk Nông', '', 'dak-nong', 'Đắk Nông', 62, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'ĐBP', 'Điện Biên', '', 'dien-bien-phu', 'Điện Biên', 63, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_from` int(1) UNSIGNED DEFAULT NULL,
  `work_to` int(1) UNSIGNED DEFAULT NULL,
  `overtime_id` int(1) UNSIGNED DEFAULT NULL,
  `company_type_id` int(1) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_city_id` int(10) UNSIGNED NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `representative` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `members` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foundation_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `banner_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `companies`
--

INSERT INTO `companies` (`id`, `member_id`, `country_id`, `name`, `work_from`, `work_to`, `overtime_id`, `company_type_id`, `address`, `address_city_id`, `phone_number`, `representative`, `web_url`, `members`, `foundation_date`, `description`, `banner_url`, `logo_url`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(3, 14, 161, 'Embrace_it', 2, 6, 2, 1, 'Q.2 Hồ Chí Minh', 1, '0123456456', 'Max', 'abc.com', '12', '2018-05-14 00:00:00', NULL, '1526266424.jpg', '1526266424.jpg', 0, NULL, NULL, NULL, '2018-05-09 08:05:58', '2018-05-14 09:53:44'),
(4, 18, 1, '', 2, 5, 2, 1, '', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2018-05-09 09:05:10', '2018-05-09 09:05:10'),
(5, 21, 1, 'Hoàng Kim', NULL, NULL, NULL, 1, 'Trà Vinh', 1, '01238528527', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2018-05-09 16:05:37', '2018-05-09 16:05:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `list_order` int(10) UNSIGNED NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `countries`
--

INSERT INTO `countries` (`id`, `name`, `list_order`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'Albania', 1, 0, NULL, NULL, NULL, NULL, NULL),
(2, 'Algeria', 2, 0, NULL, NULL, NULL, NULL, NULL),
(3, 'American Samoa', 3, 0, NULL, NULL, NULL, NULL, NULL),
(4, 'Albania', 4, 0, NULL, NULL, NULL, NULL, NULL),
(5, 'Angola', 5, 0, NULL, NULL, NULL, NULL, NULL),
(6, 'Anguilla', 6, 0, NULL, NULL, NULL, NULL, NULL),
(7, 'Antarctica', 7, 0, NULL, NULL, NULL, NULL, NULL),
(8, 'Antigua and Barbuda', 8, 0, NULL, NULL, NULL, NULL, NULL),
(9, 'Argentina', 9, 0, NULL, NULL, NULL, NULL, NULL),
(10, 'Armenia', 10, 0, NULL, NULL, NULL, NULL, NULL),
(11, 'Aruba', 11, 0, NULL, NULL, NULL, NULL, NULL),
(12, 'Australia', 12, 0, NULL, NULL, NULL, NULL, NULL),
(13, 'Austria', 13, 0, NULL, NULL, NULL, NULL, NULL),
(14, 'Azerbaijan', 14, 0, NULL, NULL, NULL, NULL, NULL),
(15, 'Bahamas', 15, 0, NULL, NULL, NULL, NULL, NULL),
(16, 'Bahrain', 16, 0, NULL, NULL, NULL, NULL, NULL),
(17, 'Bangladesh', 17, 0, NULL, NULL, NULL, NULL, NULL),
(18, 'Barbados', 18, 0, NULL, NULL, NULL, NULL, NULL),
(19, 'Belarus', 19, 0, NULL, NULL, NULL, NULL, NULL),
(20, 'Belgium', 20, 0, NULL, NULL, NULL, NULL, NULL),
(21, 'Belize', 21, 0, NULL, NULL, NULL, NULL, NULL),
(22, 'Benin', 22, 0, NULL, NULL, NULL, NULL, NULL),
(23, 'Bermuda', 23, 0, NULL, NULL, NULL, NULL, NULL),
(24, 'Bhutan', 24, 0, NULL, NULL, NULL, NULL, NULL),
(25, 'Bolivia', 25, 0, NULL, NULL, NULL, NULL, NULL),
(26, 'Bosnia and Herzegowina', 26, 0, NULL, NULL, NULL, NULL, NULL),
(27, 'Botswana', 27, 0, NULL, NULL, NULL, NULL, NULL),
(28, 'Bouvet Island', 28, 0, NULL, NULL, NULL, NULL, NULL),
(29, 'Brazil', 29, 0, NULL, NULL, NULL, NULL, NULL),
(30, 'British Indian Ocean Territory', 30, 0, NULL, NULL, NULL, NULL, NULL),
(31, 'Brunei Darussalam', 31, 0, NULL, NULL, NULL, NULL, NULL),
(32, 'Bulgaria', 32, 0, NULL, NULL, NULL, NULL, NULL),
(33, 'Burkina Faso', 33, 0, NULL, NULL, NULL, NULL, NULL),
(34, 'Burundi', 34, 0, NULL, NULL, NULL, NULL, NULL),
(35, 'Cambodia', 35, 0, NULL, NULL, NULL, NULL, NULL),
(36, 'Cameroon', 36, 0, NULL, NULL, NULL, NULL, NULL),
(37, 'Canada', 37, 0, NULL, NULL, NULL, NULL, NULL),
(38, 'Cape Verde', 38, 0, NULL, NULL, NULL, NULL, NULL),
(39, 'Cayman Islands', 39, 0, NULL, NULL, NULL, NULL, NULL),
(40, 'Central African Republic', 40, 0, NULL, NULL, NULL, NULL, NULL),
(41, 'Chad', 41, 0, NULL, NULL, NULL, NULL, NULL),
(42, 'Chile', 42, 0, NULL, NULL, NULL, NULL, NULL),
(43, 'China', 43, 0, NULL, NULL, NULL, NULL, NULL),
(44, 'Christmas Island', 44, 0, NULL, NULL, NULL, NULL, NULL),
(45, 'Cocos (Keeling) Islands', 45, 0, NULL, NULL, NULL, NULL, NULL),
(46, 'Colombia', 46, 0, NULL, NULL, NULL, NULL, NULL),
(47, 'Comoros', 47, 0, NULL, NULL, NULL, NULL, NULL),
(48, 'Congo', 48, 0, NULL, NULL, NULL, NULL, NULL),
(49, 'Cook Islands', 49, 0, NULL, NULL, NULL, NULL, NULL),
(50, 'Costa Rica', 50, 0, NULL, NULL, NULL, NULL, NULL),
(51, 'Cote D&#039;Ivoire', 51, 0, NULL, NULL, NULL, NULL, NULL),
(52, 'Croatia', 52, 0, NULL, NULL, NULL, NULL, NULL),
(53, 'Cuba', 53, 0, NULL, NULL, NULL, NULL, NULL),
(54, 'Cyprus', 54, 0, NULL, NULL, NULL, NULL, NULL),
(55, 'Czech Republic', 55, 0, NULL, NULL, NULL, NULL, NULL),
(56, 'Denmark', 56, 0, NULL, NULL, NULL, NULL, NULL),
(57, 'Djibouti', 57, 0, NULL, NULL, NULL, NULL, NULL),
(58, 'Dominica', 58, 0, NULL, NULL, NULL, NULL, NULL),
(59, 'Dominican Republic', 59, 0, NULL, NULL, NULL, NULL, NULL),
(60, 'East Timor', 60, 0, NULL, NULL, NULL, NULL, NULL),
(61, 'Ecuador', 61, 0, NULL, NULL, NULL, NULL, NULL),
(62, 'Egypt', 62, 0, NULL, NULL, NULL, NULL, NULL),
(63, 'El Salvador', 63, 0, NULL, NULL, NULL, NULL, NULL),
(64, 'Equatorial Guinea', 64, 0, NULL, NULL, NULL, NULL, NULL),
(65, 'Eritrea', 65, 0, NULL, NULL, NULL, NULL, NULL),
(66, 'Estonia', 66, 0, NULL, NULL, NULL, NULL, NULL),
(67, 'Ethiopia', 67, 0, NULL, NULL, NULL, NULL, NULL),
(68, 'Falkland Islands (Malvinas)', 68, 0, NULL, NULL, NULL, NULL, NULL),
(69, 'Faroe Islands', 69, 0, NULL, NULL, NULL, NULL, NULL),
(70, 'Fiji', 70, 0, NULL, NULL, NULL, NULL, NULL),
(71, 'Finland', 71, 0, NULL, NULL, NULL, NULL, NULL),
(72, 'France', 72, 0, NULL, NULL, NULL, NULL, NULL),
(73, 'France, Metropolitan', 73, 0, NULL, NULL, NULL, NULL, NULL),
(74, 'French Guiana', 74, 0, NULL, NULL, NULL, NULL, NULL),
(75, 'French Polynesia', 75, 0, NULL, NULL, NULL, NULL, NULL),
(76, 'French Southern Territories', 76, 0, NULL, NULL, NULL, NULL, NULL),
(77, 'Gabon', 77, 0, NULL, NULL, NULL, NULL, NULL),
(78, 'Gambia', 78, 0, NULL, NULL, NULL, NULL, NULL),
(79, 'Georgia', 79, 0, NULL, NULL, NULL, NULL, NULL),
(80, 'Germany', 80, 0, NULL, NULL, NULL, NULL, NULL),
(81, 'Ghana', 81, 0, NULL, NULL, NULL, NULL, NULL),
(82, 'Gibraltar', 82, 0, NULL, NULL, NULL, NULL, NULL),
(83, 'Greece', 83, 0, NULL, NULL, NULL, NULL, NULL),
(84, 'Greenland', 84, 0, NULL, NULL, NULL, NULL, NULL),
(85, 'Grenada', 85, 0, NULL, NULL, NULL, NULL, NULL),
(86, 'Guadeloupe', 86, 0, NULL, NULL, NULL, NULL, NULL),
(87, 'Guam', 87, 0, NULL, NULL, NULL, NULL, NULL),
(88, 'Guatemala', 88, 0, NULL, NULL, NULL, NULL, NULL),
(89, 'Guinea', 89, 0, NULL, NULL, NULL, NULL, NULL),
(90, 'Guinea-bissau', 90, 0, NULL, NULL, NULL, NULL, NULL),
(91, 'Guyana', 91, 0, NULL, NULL, NULL, NULL, NULL),
(92, 'Haiti', 92, 0, NULL, NULL, NULL, NULL, NULL),
(93, 'Heard and Mc Donald Islands', 93, 0, NULL, NULL, NULL, NULL, NULL),
(94, 'Honduras', 94, 0, NULL, NULL, NULL, NULL, NULL),
(95, 'Hong Kong', 95, 0, NULL, NULL, NULL, NULL, NULL),
(96, 'Hungary', 96, 0, NULL, NULL, NULL, NULL, NULL),
(97, 'Iceland', 97, 0, NULL, NULL, NULL, NULL, NULL),
(98, 'India', 98, 0, NULL, NULL, NULL, NULL, NULL),
(99, 'Indonesia', 99, 0, NULL, NULL, NULL, NULL, NULL),
(100, 'Iran (Islamic Republic of)', 100, 0, NULL, NULL, NULL, NULL, NULL),
(101, 'Iraq', 101, 0, NULL, NULL, NULL, NULL, NULL),
(102, 'Ireland', 102, 0, NULL, NULL, NULL, NULL, NULL),
(103, 'Israel', 103, 0, NULL, NULL, NULL, NULL, NULL),
(104, 'Italy', 104, 0, NULL, NULL, NULL, NULL, NULL),
(105, 'Jamaica', 105, 0, NULL, NULL, NULL, NULL, NULL),
(106, 'Japan', 106, 0, NULL, NULL, NULL, NULL, NULL),
(107, 'Jordan', 107, 0, NULL, NULL, NULL, NULL, NULL),
(108, 'Kazakhstan', 108, 0, NULL, NULL, NULL, NULL, NULL),
(109, 'Kenya', 109, 0, NULL, NULL, NULL, NULL, NULL),
(110, 'Kiribati', 110, 0, NULL, NULL, NULL, NULL, NULL),
(111, 'Korea, Democratic People&#039;s Republic of', 111, 0, NULL, NULL, NULL, NULL, NULL),
(112, 'Korea, Republic of', 112, 0, NULL, NULL, NULL, NULL, NULL),
(113, 'Kuwait', 113, 0, NULL, NULL, NULL, NULL, NULL),
(114, 'Kyrgyzstan', 114, 0, NULL, NULL, NULL, NULL, NULL),
(115, 'Laos', 115, 0, NULL, NULL, NULL, NULL, NULL),
(116, 'Latvia', 116, 0, NULL, NULL, NULL, NULL, NULL),
(117, 'Lebanon', 117, 0, NULL, NULL, NULL, NULL, NULL),
(118, 'Lesotho', 118, 0, NULL, NULL, NULL, NULL, NULL),
(119, 'Liberia', 119, 0, NULL, NULL, NULL, NULL, NULL),
(120, 'Libyan Arab Jamahiriya', 120, 0, NULL, NULL, NULL, NULL, NULL),
(121, 'Liechtenstein', 121, 0, NULL, NULL, NULL, NULL, NULL),
(122, 'Lithuania', 122, 0, NULL, NULL, NULL, NULL, NULL),
(123, 'Luxembourg', 123, 0, NULL, NULL, NULL, NULL, NULL),
(124, 'Macau', 124, 0, NULL, NULL, NULL, NULL, NULL),
(125, 'Macedonia, The Former Yugoslav Republic of', 125, 0, NULL, NULL, NULL, NULL, NULL),
(126, 'Madagascar', 126, 0, NULL, NULL, NULL, NULL, NULL),
(127, 'Malawi', 127, 0, NULL, NULL, NULL, NULL, NULL),
(128, 'Malaysia', 128, 0, NULL, NULL, NULL, NULL, NULL),
(129, 'Maldives', 129, 0, NULL, NULL, NULL, NULL, NULL),
(130, 'Mali', 130, 0, NULL, NULL, NULL, NULL, NULL),
(131, 'Malta', 131, 0, NULL, NULL, NULL, NULL, NULL),
(132, 'Marshall Islands', 132, 0, NULL, NULL, NULL, NULL, NULL),
(133, 'Martinique', 133, 0, NULL, NULL, NULL, NULL, NULL),
(134, 'Mauritania', 134, 0, NULL, NULL, NULL, NULL, NULL),
(135, 'Mauritius', 135, 0, NULL, NULL, NULL, NULL, NULL),
(136, 'Mayotte', 136, 0, NULL, NULL, NULL, NULL, NULL),
(137, 'Mexico', 137, 0, NULL, NULL, NULL, NULL, NULL),
(138, 'Micronesia, Federated States of', 138, 0, NULL, NULL, NULL, NULL, NULL),
(139, 'Moldova, Republic of', 139, 0, NULL, NULL, NULL, NULL, NULL),
(140, 'Monaco', 140, 0, NULL, NULL, NULL, NULL, NULL),
(141, 'Mongolia', 141, 0, NULL, NULL, NULL, NULL, NULL),
(142, 'Montserrat', 142, 0, NULL, NULL, NULL, NULL, NULL),
(143, 'Morocco', 143, 0, NULL, NULL, NULL, NULL, NULL),
(144, 'Mozambique', 144, 0, NULL, NULL, NULL, NULL, NULL),
(145, 'Myanmar', 145, 0, NULL, NULL, NULL, NULL, NULL),
(146, 'Namibia', 146, 0, NULL, NULL, NULL, NULL, NULL),
(147, 'Nauru', 147, 0, NULL, NULL, NULL, NULL, NULL),
(148, 'Nepal', 148, 0, NULL, NULL, NULL, NULL, NULL),
(149, 'Netherlands', 149, 0, NULL, NULL, NULL, NULL, NULL),
(150, 'Netherlands Antilles', 150, 0, NULL, NULL, NULL, NULL, NULL),
(151, 'New Caledonia', 151, 0, NULL, NULL, NULL, NULL, NULL),
(152, 'New Zealand', 152, 0, NULL, NULL, NULL, NULL, NULL),
(153, 'Nicaragua', 153, 0, NULL, NULL, NULL, NULL, NULL),
(154, 'Niger', 154, 0, NULL, NULL, NULL, NULL, NULL),
(155, 'Nigeria', 155, 0, NULL, NULL, NULL, NULL, NULL),
(156, 'Niue', 156, 0, NULL, NULL, NULL, NULL, NULL),
(157, 'Norfolk Island', 157, 0, NULL, NULL, NULL, NULL, NULL),
(158, 'Northern Mariana Islands', 158, 0, NULL, NULL, NULL, NULL, NULL),
(159, 'Norway', 159, 0, NULL, NULL, NULL, NULL, NULL),
(160, 'Oman', 160, 0, NULL, NULL, NULL, NULL, NULL),
(161, 'Pakistan', 161, 0, NULL, NULL, NULL, NULL, NULL),
(162, 'Palau', 162, 0, NULL, NULL, NULL, NULL, NULL),
(163, 'Panama', 163, 0, NULL, NULL, NULL, NULL, NULL),
(164, 'Papua New Guinea', 164, 0, NULL, NULL, NULL, NULL, NULL),
(165, 'Paraguay', 165, 0, NULL, NULL, NULL, NULL, NULL),
(166, 'Peru', 166, 0, NULL, NULL, NULL, NULL, NULL),
(167, 'Philippines', 167, 0, NULL, NULL, NULL, NULL, NULL),
(168, 'Pitcairn', 168, 0, NULL, NULL, NULL, NULL, NULL),
(169, 'Poland', 169, 0, NULL, NULL, NULL, NULL, NULL),
(170, 'Portugal', 170, 0, NULL, NULL, NULL, NULL, NULL),
(171, 'Puerto Rico', 171, 0, NULL, NULL, NULL, NULL, NULL),
(172, 'Qatar', 172, 0, NULL, NULL, NULL, NULL, NULL),
(173, 'Reunion', 173, 0, NULL, NULL, NULL, NULL, NULL),
(174, 'Romania', 174, 0, NULL, NULL, NULL, NULL, NULL),
(175, 'Russian Federation', 175, 0, NULL, NULL, NULL, NULL, NULL),
(176, 'Rwanda', 176, 0, NULL, NULL, NULL, NULL, NULL),
(177, 'Saint Kitts and Nevis', 177, 0, NULL, NULL, NULL, NULL, NULL),
(178, 'Saint Lucia', 178, 0, NULL, NULL, NULL, NULL, NULL),
(179, 'Saint Vincent and the Grenadines', 179, 0, NULL, NULL, NULL, NULL, NULL),
(180, 'Samoa', 180, 0, NULL, NULL, NULL, NULL, NULL),
(181, 'San Marino', 181, 0, NULL, NULL, NULL, NULL, NULL),
(182, 'Sao Tome and Principe', 182, 0, NULL, NULL, NULL, NULL, NULL),
(183, 'Saudi Arabia', 183, 0, NULL, NULL, NULL, NULL, NULL),
(184, 'Senegal', 184, 0, NULL, NULL, NULL, NULL, NULL),
(185, 'Seychelles', 185, 0, NULL, NULL, NULL, NULL, NULL),
(186, 'Sierra Leone', 186, 0, NULL, NULL, NULL, NULL, NULL),
(187, 'Singapore', 187, 0, NULL, NULL, NULL, NULL, NULL),
(188, 'Slovakia (Slovak Republic)', 188, 0, NULL, NULL, NULL, NULL, NULL),
(189, 'Slovenia', 189, 0, NULL, NULL, NULL, NULL, NULL),
(190, 'Solomon Islands', 190, 0, NULL, NULL, NULL, NULL, NULL),
(191, 'Somalia', 191, 0, NULL, NULL, NULL, NULL, NULL),
(192, 'South Africa', 192, 0, NULL, NULL, NULL, NULL, NULL),
(193, 'South Georgia and the South Sandwich Islands', 193, 0, NULL, NULL, NULL, NULL, NULL),
(194, 'Spain', 194, 0, NULL, NULL, NULL, NULL, NULL),
(195, 'Sri Lanka', 195, 0, NULL, NULL, NULL, NULL, NULL),
(196, 'St. Helena', 196, 0, NULL, NULL, NULL, NULL, NULL),
(197, 'St. Pierre and Miquelon', 197, 0, NULL, NULL, NULL, NULL, NULL),
(198, 'Sudan', 198, 0, NULL, NULL, NULL, NULL, NULL),
(199, 'Suriname', 199, 0, NULL, NULL, NULL, NULL, NULL),
(200, 'Svalbard and Jan Mayen Islands', 200, 0, NULL, NULL, NULL, NULL, NULL),
(201, 'Swaziland', 201, 0, NULL, NULL, NULL, NULL, NULL),
(202, 'Sweden', 202, 0, NULL, NULL, NULL, NULL, NULL),
(203, 'Switzerland', 203, 0, NULL, NULL, NULL, NULL, NULL),
(204, 'Syrian Arab Republic', 204, 0, NULL, NULL, NULL, NULL, NULL),
(205, 'Taiwan', 205, 0, NULL, NULL, NULL, NULL, NULL),
(206, 'Tajikistan', 206, 0, NULL, NULL, NULL, NULL, NULL),
(207, 'Tanzania, United Republic of', 207, 0, NULL, NULL, NULL, NULL, NULL),
(208, 'Thailand', 208, 0, NULL, NULL, NULL, NULL, NULL),
(209, 'Togo', 209, 0, NULL, NULL, NULL, NULL, NULL),
(210, 'Tokelau', 210, 0, NULL, NULL, NULL, NULL, NULL),
(211, 'Tonga', 211, 0, NULL, NULL, NULL, NULL, NULL),
(212, 'Trinidad and Tobago', 212, 0, NULL, NULL, NULL, NULL, NULL),
(213, 'Tunisia', 213, 0, NULL, NULL, NULL, NULL, NULL),
(214, 'Turkey', 214, 0, NULL, NULL, NULL, NULL, NULL),
(215, 'Turkmenistan', 215, 0, NULL, NULL, NULL, NULL, NULL),
(216, 'Turks and Caicos Islands', 216, 0, NULL, NULL, NULL, NULL, NULL),
(217, 'Tuvalu', 217, 0, NULL, NULL, NULL, NULL, NULL),
(218, 'Uganda', 218, 0, NULL, NULL, NULL, NULL, NULL),
(219, 'Ukraine', 219, 0, NULL, NULL, NULL, NULL, NULL),
(220, 'United Arab Emirates', 220, 0, NULL, NULL, NULL, NULL, NULL),
(221, 'United Kingdom', 221, 0, NULL, NULL, NULL, NULL, NULL),
(222, 'United States', 222, 0, NULL, NULL, NULL, NULL, NULL),
(223, 'United States Minor Outlying Islands', 223, 0, NULL, NULL, NULL, NULL, NULL),
(224, 'Uruguay', 224, 0, NULL, NULL, NULL, NULL, NULL),
(225, 'Uzbekistan', 225, 0, NULL, NULL, NULL, NULL, NULL),
(226, 'Vanuatu', 226, 0, NULL, NULL, NULL, NULL, NULL),
(227, 'Vatican City State (Holy See)', 227, 0, NULL, NULL, NULL, NULL, NULL),
(228, 'Venezuela', 228, 0, NULL, NULL, NULL, NULL, NULL),
(229, 'Việt Nam', 229, 0, NULL, NULL, NULL, NULL, NULL),
(230, 'Virgin Islands (British)', 230, 0, NULL, NULL, NULL, NULL, NULL),
(231, 'Virgin Islands (U.S.)', 231, 0, NULL, NULL, NULL, NULL, NULL),
(232, 'Wallis and Futuna Islands', 232, 0, NULL, NULL, NULL, NULL, NULL),
(233, 'Western Sahara', 233, 0, NULL, NULL, NULL, NULL, NULL),
(234, 'Yemen', 234, 0, NULL, NULL, NULL, NULL, NULL),
(235, 'Yugoslavia', 235, 0, NULL, NULL, NULL, NULL, NULL),
(236, 'Zaire', 236, 0, NULL, NULL, NULL, NULL, NULL),
(237, 'Zambia', 237, 0, NULL, NULL, NULL, NULL, NULL),
(238, 'Zimbabwe', 238, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `favorites`
--

CREATE TABLE `favorites` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `friends`
--

CREATE TABLE `friends` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(2) UNSIGNED NOT NULL,
  `address_city_id` int(10) UNSIGNED NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_receive_flg` tinyint(2) UNSIGNED NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `friends`
--

INSERT INTO `friends` (`id`, `email`, `name`, `gender`, `address_city_id`, `phone_number`, `tags`, `cv_url`, `email_receive_flg`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'vpduy99@gmail.com', 'Nguyễn Duy', 1, 6, '098979798', 'HTML5', '', 0, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'vpduy90@gmail.com', 'Nguyễn Kim', 1, 4, '098768767', 'ASP.NET', '', 0, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `job_type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_from` int(10) UNSIGNED NOT NULL,
  `salary_to` int(10) UNSIGNED NOT NULL,
  `bonus` int(11) NOT NULL,
  `age_from` int(3) UNSIGNED NOT NULL,
  `age_to` int(3) UNSIGNED NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_time` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `welfare` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_city_id` int(10) UNSIGNED NOT NULL,
  `email_receive` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` datetime DEFAULT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `company_id`, `job_type_id`, `name`, `salary_from`, `salary_to`, `bonus`, `age_from`, `age_to`, `tags`, `working_time`, `experience`, `requirement`, `description`, `welfare`, `address`, `address_city_id`, `email_receive`, `expire_date`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(3, 3, 1, 'Develop PHP', 500, 900, 60, 22, 45, 'css', 'monday - sunday', '3 year develop php', 'No', 'Phân tích và giải quyết task yêu cầu', 'không', '145 điện biên phủ, Hồ chí minh', 24, 'hkaido@gmail.com', '2018-05-26 00:00:00', 0, NULL, NULL, NULL, '2018-05-09 00:00:00', '2018-05-09 00:00:00'),
(4, 4, 2, 'Design Css', 200, 700, 120, 22, 35, 'css', 'every day', 'more than 2 year', 'no', 'tạo và custom được css', 'no', '91 Hồ tấn , Hồ chí minh', 24, 'hktan@gmail.com', '2018-05-20 00:00:00', 0, NULL, NULL, NULL, '2018-05-08 00:00:00', '2018-05-08 00:00:00'),
(5, 3, 3, 'Front-end ', 600, 2000, 15, 23, 32, 'front end', 'everyday', '1 year', 'no', 'no', 'no', 'quận 10, Hồ chí minh', 24, 'uiokim@gmail.com', '2018-05-26 00:00:00', 0, NULL, NULL, NULL, '2018-05-02 00:00:00', '2018-05-02 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobstatus`
--

CREATE TABLE `jobstatus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `list_order` int(10) UNSIGNED NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobstatus`
--

INSERT INTO `jobstatus` (`id`, `name`, `list_order`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'Mới', 1, 0, NULL, NULL, NULL, NULL, NULL),
(2, 'Xem xét', 2, 0, NULL, NULL, NULL, NULL, NULL),
(3, 'Đã phỏng vấn', 3, 0, NULL, NULL, NULL, NULL, NULL),
(4, 'Đã được nhận', 4, 0, NULL, NULL, NULL, NULL, NULL),
(5, 'Đã bị loại', 5, 0, NULL, NULL, NULL, NULL, NULL),
(6, 'Giai đoạn thử việc', 6, 0, NULL, NULL, NULL, NULL, NULL),
(7, 'Hoàn thành', 7, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobtypes`
--

CREATE TABLE `jobtypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `list_order` int(10) UNSIGNED NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobtypes`
--

INSERT INTO `jobtypes` (`id`, `name`, `list_order`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'Full-time', 1, 0, NULL, NULL, NULL, NULL, NULL),
(2, 'Part-time', 2, 0, NULL, NULL, NULL, NULL, NULL),
(3, 'Internship', 3, 0, NULL, NULL, NULL, NULL, NULL),
(4, 'Freelance', 4, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_03_06_031122_create_users_table', 1),
(2, '2018_03_06_062109_create_countries_table', 2),
(3, '2018_03_06_062141_create_cities_table', 2),
(4, '2018_03_06_062920_create_companies_table', 3),
(5, '2018_03_06_063515_create_tags_table', 4),
(6, '2018_03_06_063611_create_jobtypes_table', 4),
(7, '2018_03_06_063654_create_jobstatus_table', 4),
(8, '2018_03_06_064819_create_scouters_table', 5),
(9, '2018_03_06_071520_create_candidates_table', 6),
(10, '2018_03_06_072524_create_jobs_table', 7),
(11, '2018_03_06_073734_create_applies_table', 8),
(12, '2018_03_06_074156_create_bonus_histories_table', 9),
(13, '2018_03_07_172425_add_bonus_from_to_jobs_table', 10),
(14, '2018_03_07_172554_add_bonus_to_to_jobs_table', 10),
(15, '2018_03_07_172947_add_cv_url_to_applies_table', 11),
(16, '2018_03_07_173007_add_message_to_applies_table', 11),
(17, '2018_03_07_173405_create_friends_table', 12),
(18, '2018_03_08_141806_add_name_colums_to_permissions_table', 13),
(19, '2018_03_19_162308_add_name_colums_to_friends_table', 14),
(20, '2018_03_19_163039_add_name_en_colums_to_cities_table', 15),
(21, '2018_03_19_163524_create_favorites_table', 16),
(22, '2018_03_19_164020_create_subscribers_table', 17);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'songday8f@gmail.com', '$2y$10$hPUudn4mJUNPtkWDWb45Mes1SLDzOTMdrKpkEXNNmUrdkZewHXdmK', '2017-09-22 02:21:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `scouters`
--

CREATE TABLE `scouters` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `id_card` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_day` datetime NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_city_id` int(10) UNSIGNED NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_receive_flg` tinyint(2) UNSIGNED NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `scouters`
--

INSERT INTO `scouters` (`id`, `member_id`, `id_card`, `birth_day`, `address`, `address_city_id`, `phone_number`, `avatar_url`, `email_receive_flg`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(14, 15, '1', '2018-05-09 08:05:43', 'Number, Street, Ward, District', 1, '0', NULL, 1, 0, NULL, NULL, NULL, '2018-05-09 08:05:43', '2018-05-09 08:05:43'),
(15, 16, '1', '2018-05-09 09:05:21', 'Number, Street, Ward, District', 1, '0', NULL, 1, 0, NULL, NULL, NULL, '2018-05-09 09:05:21', '2018-05-09 09:05:21'),
(16, 17, '1', '2018-05-09 09:05:41', 'Number, Street, Ward, District', 1, '0', NULL, 1, 0, NULL, NULL, NULL, '2018-05-09 09:05:41', '2018-05-09 09:05:41'),
(17, 19, '1', '2018-05-09 09:05:41', 'Number, Street, Ward, District', 1, '0', NULL, 1, 0, NULL, NULL, NULL, '2018-05-09 09:05:41', '2018-05-09 09:05:41'),
(18, 20, '1', '2018-05-09 14:05:10', 'Number, Street, Ward, District', 1, '0', NULL, 1, 0, NULL, NULL, NULL, '2018-05-09 14:05:10', '2018-05-09 14:05:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cities` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobtypes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `list_order` int(10) UNSIGNED NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tags`
--

INSERT INTO `tags` (`id`, `name`, `description`, `list_order`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'ASP.NET', 'ASP.NET là một ngôn ngữ dùng để thiết kế trang web, ASP.NET khá nổi tiếng và phát triển mạnh trong thời gian hiện nay. ASP.NET có sự tách biệt giữa phần thiết kế giao diện và code xử lý sự kiện của trang web, khác với các ngôn ngữ khác như ASP và PHP. Điều này đã khiến cho người thiết kế có thể dễ dàng phát hiện lỗi cũng như chỉnh sửa lại trang web. Là một nền tảng ứng dụng web được Microsoft cung cấp và phát triển, ASP.NET giúp người lập trình có thể tạo ra những trang web động và những ứng dụng cũng như những dịch vụ web đa dạng khác nhau.  Nếu bạn là một người có chuyên môn về ASP.NET và đang cần tìm việc làm thì Job Bank VN chính là sự lựa chọn đúng đắn của bạn. Chúng tôi cam kết cho bạn những việc làm IT tốt nhất và “hot” nhất hiện nay. Với thời kì công nghệ phát triển nhanh chóng như vũ bão bây giờ, người tìm việc phải luôn thay đổi để thích ứng với nhu cầu của nhà tuyển dụng. Cập nhật những thông tin việc làm mới nhất cho người lao động chính là là trách nhiệm của Job Bank VN. Hãy để website tìm việc của chúng tôi có thể giúp đỡ bạn trên con đường sự nghiệp của mình, bắt đầu bằng một nền tang công việc vững chắc nhất có thể. Mọi thông tuyển dụng về ASP.NET luôn được Job Bank VN chúng tôi tìm kiếm và đem đến cho bạn một cách nhanh chóng nhất có thể. Sự tin tưởng của người lao động chính là động lực phát triển của Job Bank VN.', 1, 0, NULL, NULL, NULL, NULL, NULL),
(2, 'Android', 'Một hệ điều hành được thiết kế dành cho thiết bị di động, Android có mã nguồn mở và được Google phát hành mã nguồn theo giấy phép Apache. Android ngày nay đã trở thành hệ điều hành nền tảng điện thoại smartphone phổ biến nhất thế giới cũng như là một trong những trải nghiệm di động nhanh nhất từ trước đến giờ.  Với xu hướng tiêu dùng hiện nay, nếu bạn là một người có chuyên môn về Android thì danh sách  những công việc dưới đây sẽ giúp đỡ bạn rất nhiều trong quá trình tìm việc làm của mình. Job Bank VN sẽ luôn cập nhật hàng ngày những thông tin tuyển dụng mới nhất của những việc làm liên quan đến hệ điều hành Android, đảm bảo đáp ứng như cầu tìm việc của người lao động. Với những điều Job Bank VN đang cố gắng đem đến cho người lao động thì sự tín nhiệm và ủng hộ của các bạn chính là động lực để Job Bank VN ngày càng phát triển mạnh mẽ hơn, dốc sức hơn để giúp đỡ người lao động.  Hãy tham khảo danh sách những việc làm Android dưới đây để có thể hiểu rõ được xu hướng tuyển dụng của những nhà tuyển dụng ngày nay cũng như tìm cho mình một hướng đi đúng đắn khi bạn đã quyết định gắn bó với những công việc IT này. Hãy tự tin vào trình độ của mình và cùng Job Bank VN tìm những việc làm phù hợp với chuyên môn của bạn ngay hôm nay. Những ứng dụng của Android là vô kể và có rất nhiều công việc liên quan đến Android đang chờ bạn khám phá.', 2, 0, NULL, NULL, NULL, NULL, NULL),
(3, 'HTML5', 'HTML5 là một ngôn ngữ dùng để cấu trúc và trình bày nội dung cho trang web. Ngày nay những ứng dụng trên website đang dần được đòi hỏi phải trở nên tinh vi hơn, một số tính năng mới trong HTML5 có thể giúp những ứng dụng đó được cải thiện. HTML5 cùng với CSS3 sẽ làm cho các ứng dụng cũng như trang web trở nên hấp dẫn, thú vị hơn. Khả năng tương thích của HTML5 cũng khá cao và đang ngày được hoàn thiện.  Bạn là người có chuyên môn về HTML5? Bạn từng có kinh nghiệp thiết kế web HTML5? Tất cả những lợi thế đó sẽ giúp bạn khi tìm kiếm việc làm liên quan đến HTML5 tại Job Bank VN. Dưới đây là những thông tin việc làm, đến từ những nhà tuyển dụng lớn và uy tín trên khắp Việt Nam, hãy tham khảo những công việc này và tìm cho mình một công việc phù hơp nhất. Với niềm đam mê HTML5 của mình, bạn sẽ thành công ở mọi vị trí mà bạn đã lựa chọn.  Job Bank VN luôn cập nhật nhiều công việc mới mỗi ngày, cho bạn nhiều chọn lựa và cân nhắc hơn khi tìm việc. Những công việc liên quan đến HTML5 chính là chìa khóa thành công cho bạn nếu bạn có đủ đam mê và nhiệt huyết để theo đuổi. Hãy bắt đầu tìm kiếm ngay hôm nay, Job Bank VN sẽ đem cơ hội đến cho bạn, con đường sự nghiệp cùng tương lai rộng mở với danh sách những công việc liên quan đến HTML5 dưới đây.', 3, 0, NULL, NULL, NULL, NULL, NULL),
(4, 'iOS', 'Chắc hẳn không còn ai xa lạ với hệ điều hành iOS, là một hệ điều hành dành cho những thiết bị di động của Apple, khác với ban đầu chỉ được phát triển dành riêng cho iPhone, iOS hiện nay đã được mở rộng để hỗ trợ hầu hết các thiết bị của Apple. Những phiên bản mới của iOS được phát hành liên tục, một sự phát triển nhanh đến chóng mặt để phục vụ những tín đồ Apple.Một trong những công việc mà người làm IT theo đuổi bởi sức hấp dẫn cả về những điều được trải nghiệm cũng như mức lương đáng nể mà nó mang lại chính là công việc phát triển ứng dụng trên hệ điều hành, trong đó không thể không nhắc đến hệ điều hành iOS.  Nếu bạn đã có chuyên môn về lãnh vực này, hoặc muốn thử sức với lãnh vực này thì Job Bank VN xin giới thiệu cho bạn danh sách những công việc liên quan đến iOS dưới đây. Những công việc này đều là những công việc mới nhất, mức lương hấp dẫn nhất và đến từ những nhà tuyển dụng uy tín nhất. Hãy đăng ký ứng tuyển ngay hôm nay để có thể nhanh chóng thử sức mình với những trải nghiệm mới. Nếu là một tín đồ của Apple thì những công việc dưới đây đều là công việc mà bạn nên mơ ước tới, có thể vừa làm việc vừa tìm hiểu về điều mình yêu thích. Job Bank VN chúng tôi mong muốn trở thành người hỗ trợ đắc lực cho bạn trên con đường sự nghiệp của mình, cung cấp cho bạn một công việc nền móng vững chắc nhất có thể ngay hôm nay.', 4, 0, NULL, NULL, NULL, NULL, NULL),
(5, 'C#', 'Là một ngôn ngữ lập trình hướng đối tượng hiện đại được Microsoft phát triển, C# phản ánh trực tiếp nhất đến.NET Framework mà tất cả các chương trình .NET chạy, đồng thời cũng phụ thuộc mạnh mẽ vào Framework này. Nếu các bạn là những người từng học C# và đang tìm việc làm thì Job Bank xin giới thiệu cho bạn những thông tin công việc dưới đây, hy vọng sẽ giúp ích cho bạn khi cần tìm việc làm liên quan đến ngôn ngữ lập trình C#. Người lao động giờ đây sẽ không phải lo lắng về những vấn đề như thông tin việc làm quá hạn hay chi tiết công việc không cụ thể nữa, những công việc mà Job Bank VN cung cấp đều là những công việc tốt nhất và uy tín nhất. Đừng để bất kì điều gì cản bước bạn trên con đường tìm việc của mình, với kiến thức về C#, bạn hoàn toàn có thể ứng tuyển vào những công việc mà bạn cho là phù hợp với khả năng của mình, những công việc có mức lương thật lý tưởng cùng môi trường làm việc tốt, đi kèm đó là những cơ hội để bạn có thể mở mang kiến thức cũng như thăng tiến trong sự nghiệp.  Được giúp đỡ người lao động khi tìm việc chính là phương hướng làm việc của Job Bank VN, ngược lại, sự tin tưởng và ủng hộ của người lao động chính là sức mạnh để Job Bank VN tiếp tục phát triển vững vàng hơn nữa. Mong rằng những công việc mà Job Bank VN giới thiệu cho bạn dưới đây có thể khiến bạn hài lòng, ứng tuyển thành công và tìm được một việc làm ổn định. ', 5, 0, NULL, NULL, NULL, NULL, NULL),
(6, 'C++', 'Ngôn ngữ lập trình C++ hẳn không còn xa lạ gì với mọi người, C++ là một dạng ngôn ngữ đa mẫu hình tự do kiểu tĩnh, hỗ trợ lập trình thủ tục, dữ liệu trừu tượng hay như lập trình hướng đối tượng và lập trình đa hình… C++ được tăng nhiều tính năng hơn so với C, ví dụ như khai báo như mệnh đề, các kiểu tham chiếu, cá đối số mặc định… và rất nhiều những tính năng khác nữa. Với những lập trình viên sử dụng ngôn ngữ C++, Job Bank VN hân hạnh giới thiệu đến các bạn những công việc mới nhất và luôn được cập nhật mỗi ngày. Hãy tham khảo danh sách những việc làm C++ dưới đây để có thể tìm cho mình một việc làm lien quan đến lĩnh vực lập trình bằng ngôn ngữ C++ thích hợp với mình nhé. Job Bank VN hy vọng có thể đem đến cho bạn nhiều cơ hội hơn nữa với công việc lập trình C++ của mình nên chúng tôi luôn nỗ lực cố gắng mỗi ngày để thu thập, tìm kiếm những thong tin công việc mới nhất, tốt nhất, từ những nhà tuyển dụng uy tín nhất trên khắp đất nước Việt Nam này.  Sự hài lòng của người lao động khi tìm được việc làm phù hợp với năng lực và điều kiện của mình chính là động lực giúp Job Bank VN phát triển hơn nữa. Hãy đến với Job Bank VN để chúng tôi có thể giúp đỡ các bạn trên con đường tìm việc làm đầy khó khăn này. Trở thành nền tảng sự nghiệp của người lao động Việt Nam chính là hướng phát triển của Job Bank VN.', 6, 0, NULL, NULL, NULL, NULL, NULL),
(7, 'C language', 'Ngôn ngữ lập trình C ra đời từ thập niên 70 của thế kỷ trước với mong muốn giảm tải bớt công sức lập trình cho các lập trình viên khi phải sử dụng ngôn ngữ cấp thấp là các toán tử logic để cho các hệ điều hành hiểu và vận hành. Việc sử dụng các hàm thư viện để cung cấp các hàm, các tập tin khiến cho quá trình lập trình tiết kiệm được nhiều thời gian và công sức hơn. Ngôn ngữ lập trình C ra đời với mục đích viết các chương trình lớn tiện lợi hơn và tính chính xác cao hơn. Các từ khóa truyền vào cũng ít hơn làm cho việc lập trình dễ dàng.  Ngôn ngữ C được lập trình ban đầu với mục đích sử dụng trên hệ điều hành Unix nhưng sau này được phổ biến ở tất cả các hệ điều hành. Ưu điểm của ngôn ngữ C là cho phép lập trình viên kiểm soát được những gì mà họ viết thực thi dễ dàng. Do đó, dù cho hiện nay có nhiều ngôn ngữ lập trình cấp cao khác như Java, ASP.NET, v.v... nhưng ngôn ngữ C vẫn có được chỗ đứng cho riêng mình. Nhu cầu tuyển dụng nhân sự ngành lập trình trong những năm gần đây ngày càng nhộn nhịp. Những lập trình viên có khả năng chuyên môn cao và có kinh nghiệm luôn được các doanh nghiệp rộng cửa chào đón. Với mức lương thuộc nhóm khá cao trên thị trường lao động, các lập trình viên hoàn toàn có thể có được cuộc sống chất lượng tốt. Đồng thời được tạo điều kiện để nâng cao chuyên môn qua các khóa tu nghiệp ngắn hạn do doanh nghiệp tổ chức. ', 7, 0, NULL, NULL, NULL, NULL, NULL),
(8, 'Java', 'Ngôn ngữ lập trình Java được sử dụng để viết ứng dụng cho máy tính nhưng nó không đơn thuần là một ngôn ngữ lập trình, Java cũng thường được máy tính hay trình duyệt web yêu cầu phải thực thi khi chạy một ứng dụng nào đó. Java chạy tương đương như C#, hai ngôn ngữ này có sự tương đồng về cú pháp và quá trình chạy. Với những lập trình viên có chuyên môn về Java, Job Bank VN rất vui khi được giới thiệu cho bạn danh sách những việc làm Java dưới đây, những việc làm mới nhất và “hot” nhất được chúng tôi cập nhật mổi ngày, đảm bảo sự đa dạng cho các bạn chọn lựa. Là một lập trình viên, một nhà phát triển, làm việc dựa trên những kiến thức về Java, các bạn hoàn toàn có thể tìm cho mình một công việc trong những công việc mà Job Bank VN giới thiệu dưới đây. Chỉ cần tự tin vào khả năng của mình, bạn sẽ làm được tất cả và tất nhiên, một công việc đúng chuyên môn và sở thích là điều bạn sẽ đạt được. Job Bank hỗ trợ bạn mọi phương tiện để nhà tuyển dụng có biết đến tài năng của bạn.  Hãy ứng tuyển ngay hôm nay, những việc làm liên quan đến Java đang chờ đón bạn tại Job Bank VN. Trao cho bạn những cơ hội mới đầy triển vọng trên con đường sự nghiệp của mình, Job Bank VN hy vọng người lao động Việt Nam sẽ ngày càng phát triển hơn nữa, và đặt niềm tin vào Job Bank hơn nữa để chúng tôi có them nhiều động lực phấn đấu cũng như hoàn thiện bản thân mình. ', 8, 0, NULL, NULL, NULL, NULL, NULL),
(9, 'JavaScript', 'Ngôn ngữ lập trình kịch bản Javascript hẳn không còn lạ lẫm gì đối với dân IT nữa, Javascript được sử dụng rất rộng rãi khi xây dựng trang web cũng như được dùng để tạo khả năng viết script sử dụng các đói tượng nằm sẵn trong các ứng dụng. Ngôn ngữ lập trình Javascript dựa trên nguyên mẫu với cú pháp được phát triển từ C, có khái niệm từ khóa nên Javascript gần như không thể mở rộng.  Hiện nay rất nhiều công ty đang cần tuyển dụng những nhà phát triển, những lập trình viên có kiến thức vững chắc về Javascript cũng như nhiều người lao động đang cần tìm những công việc liên quan đến Javascript để có thể phát triển chuyên môn cũng như điềm đam mê của mình. Job Bank VN xin giới thiệu cho các bạn những thông tin tuyển dụng mới nhất và tốt nhất về những công việc liên quan đến Javascript dưới đây. Nếu bạn là một lập trình viên đang cần tìm việc làm, hay một sinh viên ngành IT mới ra trường đang muốn thử sức mình với lĩnh vực Javascript… thì những thông tin tuyển dụng mà Job Bank Vn đem lại hi vọng có thể giúp bạn tìm ra được con đường sự nghiệp của mình. Những việc làm mà Job Bank đem đến cho các bạn đều được đến từ những nhà tuyển dụng uy tín nhất, những công ty IT lớn tại Việt Nam.  Hãy nhanh chóng ứng tuyển ngay hôm nay để có thể nắm trong tay một công việc phù hợp với bạn và liên quan đến lĩnh vực Javascript mà bạn quan tâm. Job Bank VN sẽ luôn đồng hành bên bạn trên con đường tìm kiếm sự nghiệp. ', 9, 0, NULL, NULL, NULL, NULL, NULL),
(10, 'JQuery', 'Một thư viện kiểu mới cùa Javascript, JQuery có tác dụng giúp đơn giản hóa cách viết của Javascript cũng như tăng tốc độ xử lý các sự kiện trên trang. JQuery giúp định nghĩa sẵn các phương thức Javascript, điều này khiến chúng ta có thể viết code nhanh chóng và đơn giản hơn rất nhiều. Thư viện khổng lồ JQuery hỗ trợ cho mọi ngôn ngữ lập trình, giúp lập trình viên giảm bớt được rất nhiều thời gian.  Như các bạn đã thấy, JQuery luôn đi chung với những ngôn ngữ lập trình, đặc biệt là Javascript thế nên những công việc có liên quan đến JQuery cũng nhiều và đa dạng như vậy. Job Bank VN xin giới thiệu đến các bạn những thông tin công việc liên quan đến JQuery dưới đây. Danh sách việc làm liên quan đến JQuery luôn được cập nhật hàng ngày, đảm bảo luôn có những công việc mới nhất, phù hợp nhất dành cho tất cả mọi người. Thông tin tuyển dụng việc làm JQuery chắc chắn sẽ làm các bạn hài long vì sự mới mẻ, nhanh chóng cũng như độ chính xác, Job Bank VN sẽ làm bất cứ điều gì để người lao động Việt Nam có thể thuận tiện trong việc tìm việc làm. Những bước đệm ban đầu rất là quan trọng khi bạn bắt đầu một công việc mới, bạn có thể tiến xa với sự lựa chọn nghề nghiệp của mình với những thông tin mà Job Bank VN cung cấp cho bạn dưới đây. Khi tìm việc làm tại Job Bank VN, bạn sẽ có thể vừa làm công việc đúng chuyên môn của mình, vừa có thể trau dồi, học hỏi nâng cao kiến thức về JQuery hơn nữa. ', 10, 0, NULL, NULL, NULL, NULL, NULL),
(11, 'PHP', 'Ngôn ngữ lập trình kịch bản PHP (Hypertext Preprocessor) là một ngôn ngữ khá dễ học, dễ hiểu và cũng dễ để tiếp cận. PHP được tối ưu hóa cho các ứng dụng trên website cùng với tốc độ nhanh, nhỏ gọn, có cú pháp giống với C và Java, vì thế PHP đã trở thành ngôn ngữ lập trình phổ biến nhất trên thế giới. Vì lý do đó, những lập trình viên PHP nếu đang cần tìm việc làm thì hãy an tâm vì sẽ luôn có những công việc phù hợp với bạn và Job Bank VN chính là người sẽ giúp bạn tìm ra được công việc ấy. Danh sách những việc làm dưới đây chính là những thông tin tuyển dụng việc làm liên quan đến PHP mới nhất mà Job Bank VN đã tổng hợp được từ những nhà tuyển dụng uy tín nhất khắp đất nước Việt Nam. Những nhà phát triển, những lập trình viên PHP đang cần tìm việc làm giờ đây đã có thể an tâm hơn cũng như thoải mái lựa chọn những công việc mà mình yêu thích tại Job Bank VN. Luôn được cập nhật công việc mới hàng ngày, danh sách việc làm PHP sẽ làm vừa lòng những người lao động có nhu cầu tìm việc mọi lúc, mọi nơi.  Hãy ứng tuyển ngay hôm nay để không bỏ lỡ cơ hội nghề nghiệp đang đến với bạn. Tự tin vào trình độ của mình cũng như dành trọn niềm đang mê vào công việc chính là chìa khóa thành công cho tất cả mọi người. Job Bank VN sẽ là nền tảng vững chắc cho người lao động Việt Nam đang trong giai đoạn tìm kiếm sự nghiệp tương lai của chính mình. ', 11, 0, NULL, NULL, NULL, NULL, NULL),
(12, 'Wordpress', 'Wordpress – hệ thống xuất bản blog được viết bằng ngôn ngữ lập trình PHP và sử dụng cơ sở dữ liệu MySQL, Wordpress là một trong những mã nguồn mở được sử dụng nhiều nhất hiện nay do khả năng tùy biến cao không thua những website chuyên nghiệp khác. Mọi người thường biết đến Wordpress đơn giản chỉ để viết blog nhưng Wordpress còn có thể làm site tin tức, bán hàng hay mạng xã hội… Ngày nay, nhiều website nổi tiếng và chuyên nghiệp sử dụng bộ mã nguồn Wordpress nên những thông tin tuyển dụng việc làm IT liên quan đến Wordpress ngày càng nhiều.  Danh sách những công việc liên quan đến Wordpress dưới đây mà Job Bank VN cung cấp cho bạn chính là những thông tin tuyển dụng nóng hổi nhất, được cập nhật liên tục mỗi ngày, giúp những bạn đang cần tìm việc làm có thể dễ dàng tìm thấy công việc phù hợp với mình. Nếu như bạn là người có kiến thức về Wordpress và có niềm đam mê với lĩnh vực IT thì hãy nhanh chóng ứng tuyển việc làm để thử sức mình với một nghề nghiệp mới đầy hứa hẹn này. Được làm việc trong môi trường thích hợp, trình độ chuyên môn của bạn chắc chắn sẽ được tăng cao và cơ hội thăng tiến cũng cao hơn rất nhiều. Hãy lựa cho mình một việc làm tốt nhất tại Job Bank VN để có một nền tảng vững chắc nhất bạn nhé. Ngoài những công việc về Wordpress, Job Bank VN còn cung cấp nhiều thông tin việc làm IT rất hấp dẫn và mới mẻ khác nữa. Hãy để Job Bank VN giúp đỡ người lao động Việt Nam nhiều hơn nữa. ', 12, 0, NULL, NULL, NULL, NULL, NULL),
(13, 'CSS', 'CSS (Cascading Style Sheet) là một ngôn ngữ quy định cách trình bày của các thẻ HTML và XHTML trên trang web, được sử dụng rất nhiều trong lập trình web. CSS có tác dụng hạn chế việc làm rối mã HTML của trang web, khiến cho mã nguồn của trang web được gọn gang hơn, tách nội dung của trang web với phần định dạng hiển thị khiên cho việc cập nhật và chỉnh sửa trở nên dễ dàng hơn. Ngoài ra, CSS còn có thể tạo các kiểu dáng có thể áp dụng cho nhiều trang web, tránh lặp lại việc định dạng cho các trang web giống nhau.  Hiện tại ở Job Bank đang có rất nhiều công việc liên quan đến CSS và chúng đều là những thông tin tuyển dụng được chúng tôi cập nhật hàng ngày, đảm bảo là những thông tin chính xác nhất và mới mẻ nhất từ những nhà tuyển dụng uy tín. Nếu bạn là một người có kiến thức chuyên môn về CSS, có khả năng cũng như niềm đam mê với CSS thì hãy chọn cho mình một công việc phù hợp nhất với mình trong danh sách những việc làm CSS mà Job Bank VN đã tổng hợp cho bạn. Với thông tin chi tiết, chính xác, hỗ trợ việc ứng tuyển cũng rất dễ dàng, các bạn sẽ nhanh chóng tìm được việc làm mà mình yêu thích. Những vẫn đề khó khăn mà các bạn gặp phải khi tìm việc sẽ không còn nữa, thay vào đó là phương pháp tìm việc làm thật nhanh chóng và tiện lợi với Job Bank VN. Hãy để những công việc CSS mở lối tương lai của các bạn ngay hôm nay. ', 13, 0, NULL, NULL, NULL, NULL, NULL),
(14, 'Web', 'Trong thời đại hiện nay thì không ai là không biết đến mạng Internet, Internet đang đóng vai trò rất quan trọng với sự phát triển của một quốc gia. Từ đó những công việc liên quan đến Website cũng xuất hiện và phát triển mạnh mẽ. Việc làm Web là một khái niệm rất rộng và liên quan đến nhiều kiến thức chuyên ngành khác nhau. Job Bank VN hân hạnh giới thiệu cho những bạn đang cần tìm những việc làm liên quan đến Web cũng như mạng Internet danh sách công việc dưới đây. Có rất nhiều công việc cho các bạn thoải mái cân nhắc lựa chọn, tìm cho mình một công việc ưng ý nhất.  Job Bank VN đảm bảo rằng danh sách thông tin tuyển dụng những việc làm liên quan đến Web dưới đây sẽ khiến cho người lao động hài long bởi bộ cập nhật nhanh chóng, thông tin chính xác và hỗ trợ ứng tuyển tiện lợi của chúng tôi. Là một nhân viên IT, các bạn sẽ là người hiểu hơn ai hết những ứng dụng của Web tiện ích như thế nào đến đời sống hằng ngày cũng như lợi ích của nó trong nhiều ngành nghề khác nhau. Những việc làm Web chính là chìa khóa thành công cho những bạn muốn thử sức mình ở lĩnh vực rộng lớn này. Với sự giúp đỡ của Job Bank VN, người lao động Việt Nam sẽ có thể dễ dàng tìm thấy việc làm cho mình, đặt nền móng vững chắc cho sự phát triển sự nghiệp sau này. Sự tin tưởng của các bạn chính là động lực phát triển của Job Bank Vn chúng tôi. ', 14, 0, NULL, NULL, NULL, NULL, NULL),
(15, 'Windows Phone', 'Windows phone là hệ điều hành được thiết kế chạy trên các thiết bị di động do hãng Microsoft phát hành. Windows phone được thiết kế với giao diện người dùng dạng metro, một kiểu giao diện mới được triển khai trên các thiết bị di động. Mang lại sự mới lạ cho người sử dụng. Giao diện mới được thiết kế theo phong cách tối giản, bố cục màu sắc có tính tương phản cao, mang đến sự tập trung cho người dùng vào chức năng thật sự của ứng dụng. Tránh được sự mất tập trung vào những chi tiết dư thừa không cần thiết. Với xu hướng ngày càng đề cao tính thực tiễn của các ứng dụng, windows phone không nằm ngoài xu hướng này. Với thiết kế các icon trên giao diện theo phong cách thiết kế phẳng, nên đảm bảo được tính hiệu quả khi sử dụng mà không phải mô phỏng hình ảnh thực tế để người dùng hình dung ra chức năng của nó. Khi người dùng chọn icon thì được chuyển trực tiếp vô thông tin thay vì khởi động ứng dụng như các hệ điều hành khác. Mặc dù được viết nên bằng ngôn ngữ khá truyền thống là C/C++ nhưng hệ điều hành windows phone ra đời đã mang đến một hướng đi mới cho các lập trình viên, các nhà phát triển ứng dụng cũng như game. Thêm một lợi thế nữa đó là, thay vì chỉ là đối tác cung cấp hệ điều hành cho hãng điện thoại di động Nokia như trước đây, nay mảng sản xuất smartphone của Nokia đã thuộc sở hữu của Microsoft. Đã tạo thêm một lợi thế để hệ điều hành windows phone phát triển lớn mạnh. Tạo động lực cho cộng đồng đam mê windows phonecống hiến nhiều hơn nữa.', 15, 0, NULL, NULL, NULL, NULL, NULL),
(16, '.NET', '.NET là một framework tương tự như các thư viện ở Java, .NET định nghĩa những thứ nền tảng, căn bản cho các lập trình viên dựa vào đó và làm theo, để sử dụng hết sức mạnh của .NET thì phải sử dụng ngôn ngữ C#. Với những bạn có khả năng và trình độ chuyên môn về lập trình .NET và đang cần tìm việc làm thì Job Bank VN chính là sự lựa chọn đúng đắn cho các bạn. Có rất nhiều công việc IT nói chung và việc làm .NET nói chung đang chờ bạn khám phá tại Job Bank VN. Những vấn đề về chất lượng thông tin hay thời hạn thông tin ứng tuyển sẽ không còn đáng bận tâm nữa vì Job Bank biết cách lựa chọn thông tin, chắt lọc những tin đã hết hạn và luôn cập nhật thông tin mới mỗi ngày. Làm nên được một website cung cấp thông tin việc làm chính xác nhất dành riêng cho người lao động Việt Nam chính là mục tiêu phát triển của Job Bank VN.  Những vấn đề mà người tìm việc trước đây hay lo lắng giờ đã không còn nữa, thay vào đó là những tiện ích tuyệt vời mà Job Bank VN đang cố gắng nỗ lực từng ngày phục phụ các bạn. Những công việc liên quan đến .NET sẽ là bước đệm quan trọng cho các bạn trên con đường sự nghiệp sau này, hãy nắm lấy cơ hội ngay hôm nay và ứng tuyển vị trí làm việc mà bạn mong muốn nhé. Mong là danh sách những việc làm .NET dưới đây của Job Bank VN có thể giúp đỡ những bạn đang tìm kiếm việc làm. ', 16, 0, NULL, NULL, NULL, NULL, NULL),
(17, 'Multi language', 'Sự hiện diện của internet đang rộng khắp và ảnh hưởng đến nhiều ngành nghề và khắp mọi khía cạnh cuộc sống hằng ngày của chúng ta. Ban đầu, những gì chúng ta sử dụng chỉ là để chat với nhau thông qua ứng dụng cũ như Yahoo, xem nội dung những website tĩnh và chơi các game mini 2D. Thế nhưng sức hấp dẫn của internet và công nghệ thông tin đã lôi kéo hàng ngàn cá nhân tài năng, cống hiến bằng các ứng dụng và kỹ thuật mới được đưa vào sử dụng. Đánh dấu bằng sự ra đời của các ngôn ngữ lập trình mạnh như Java, C++, ASP.NET, v.v... Về phương diện các ứng dụng thì ngày càng có nhiều ứng dụng thông minh được đưa vào sử dụng, cho phép người dùng có thể mua sắm tại nhà, các website chuyển từ thế hệ 1.0 sang 2.0 là các thế hệ website động. Và hiện nay đang dần chuyển sang thế hệ website 3.0 là những website thông minh, gợi ý cho người dùng những thông tin họ muốn tìm kiếm thông qua nguồn cơ sở dữ liệu thu thập được trong quá trình phân tích các thói quen và cả sở thích của họ.  Với xu hướng đẩy mạnh thương mại, mở rộng phạm vi kinh doanh của doanh nghiệp, không doanh nghiệp nào không sở hữu một website là đại diện cho mình trên thế giới mạng. Do đó, nhu cầu tích hợp nhiều ngôn ngữ cho nội dung website của mình nhằm hỗ trợ người truy cập hiểu được thông tin doanh nghiệp muốn truyền tải. Vì thế, đặt ra yêu cầu những lập trình viên có thêm chức năng đa ngôn ngữ vào website. Hiện tại, đa số các website có hai ngôn ngữ là tiếng Việt và tiếng Anh. ', 17, 0, NULL, NULL, NULL, NULL, NULL),
(18, 'MVC', 'Lập trình bắt đầu với Pascal sau đó là C, C#, C++, java, v.v... tùy theo yêu cầu và chức năng của hệ thống mà sử dụng ngôn ngữ với đặc thù thích hợp. Nếu muốn viết các ứng dụng nhẹ, chạy trên các thiết bị di động với những thông số kỹ thuật thấp, phù hợp với cấu hình yếu hơn máy tính. Nhưng phổ biến nhất hiện nay, bộ .NET được microsoft hỗ trợ vẫn được chú trọng hơn cả bởi lẽ những hỗ trợ của microsoft dành cho người lập trình rất lớn. Thay vì phải tốn nhiều thời gian để tìm kiếm hoặc thiết kế lại các icon, các nút từ đầu, thì nay microsoft đã hỗ trợ bằng cách thiết kế những form mẫu và chỉ lấy ra sử dụng. Thêm vào đó, tính tương thích với hệ điều hành microsoft windows cũng là một trong những ưu điểm khi lập trình bằng bộ .NET. MVC framework là bộ framework ra đời hỗ trợ người lập trình dễ dàng hơn trong quá trình nâng cấp, bảo trì hệ thống. Nhờ đặc điểm chính của MVC chia ra làm 3 thành phần chính. Bao gồm: View, Controller và Model. Như vậy, khi lập trình các nghiệp vụ kinh tế của hệ thống bị tách hoàn toàn ra khỏi code cũng như là phần giao diện. Nên khi có một thành phần thay đổi thì hầu như hệ thống còn lại ít bị tác động. Nhờ đó mà khi tiến hành lập trình cũng nhanh chóng hơn, kiểm soát được các lỗi xảy ra dễ dàng.  Tại thị trường phần mềm Việt Nam nói chung và thành phố Hồ Chí Minh nói riêng, nhu cầu nhân lực lập trình viên thành thạo ASP.NET MVC framework rất lớn. Do những ưu điểm này cũng như giao diện thân thiện với người sử dụng.', 18, 0, NULL, NULL, NULL, NULL, NULL),
(20, 'Magento', 'Magento là một framework mã nguồn mở, được xây dựng bằng ngôn ngữ PHP và sử dụng hệ cơ sở dữ liệu MySQL. Được sử dụng để viết nên các website thương mại điện tử.Với ưu điểm cung cấp nhiều chức năng và công cụ để xây dựng và cài đặt một website thương mại điện tử nhanh chóng, không mất nhiều công sức.Các trang bán hàng sử dụng mã nguồn mở Magento có giao diện bắt mắt do các phiên bản giao diện miễn phí được cung cấp trên mạng. Hiện nay, số lượng website sử dụng magento chiếm 1% các website đang hoạt động trên toàn thế giới.Kế thừa các ưu điểm của các nền tảng mã nguồn mở như shopping cart, zen cart-oscommerce, magento được dự đoán chính là tương lai của thương mại điện tử. Trước đây, thật khó khăn để sở hữu một website thương mại điện tử bởi phạm vi các sản phẩm cần phải quản lý quá đa dạng, số lượng quá lớn và nhiều chức năng quản lý đồng thời các tiện ích tích hợp phong phú. Chưa kể đến các yêu cầu SEO nhanh lên hạng trên các công cụ tìm kiếm hiện nay. Sự xuất hiện của Magento đã mở ra một hướng giải pháp mới cho những người có nhu cầu sử dụng nhưng lại không có kiến thức chuyên sâu về lập trình. Mang lại cơ hội cho các lập trình viên đang phân vân lựa chọn cho mình một hướng đi. Đồng thời, với nhu cầu thị trường của website thương mại điện tử đang rộng mở, cơ hội việc làm khi thành thạo magento sẽ cao hơn hẳn. Hứa hẹn sẽ mang lại nguồn thu nhập tốt và ổn định đối với các ứng viên.', 20, 0, NULL, NULL, NULL, NULL, NULL),
(21, 'Objective C', 'Objective C – ngôn ngữ lập trình hướng đối tượng được mở rộng từ C, là ngôn ngữ chính được Apple chọn để viết các ứng dụng dành cho hệ điều hành MAC, iPod và iPhone. Do Objective C được mở rộng từ C nên những lập trình viên phải có kinh nghiệm và kiến thức tốt về C thì mới có thể nắm được Objective C. Những công việc liên quan đến Objective C ở Việt Nam thường là những nhà phát triển phần mềm dành cho những thiết bị của Apple. Có thể là những công việc khó nhưng đây chính là môi trường làm việc tuyệt vời cho các bạn phát triển kĩ năng cũng như chuyên môn của mình.  Danh sách những công việc Objective C mà Job Bank VN cung cấp cho bạn dưới đây đều là những công việc đến từ những nhà tuyển dụng uy tín nhất Việt Nam, các bạn sẽ không phải lo lắng về chất lượng thông tin nữa vì chúng được cập nhật mới mỗi ngày với độ chính xác tuyệt đối. Những công việc liên quan đến Objective C sẽ là một trải nghiệm tuyệt vời cho tất cả các bạn đang có ý định làm việc trong ngành IT. Những công ty IT lớn và nổi tiếng luôn cần những nhân viên tài năng, có kĩ năng và trình độ chuyên môn cao, nếu tự tin vào bản thân mình, bạn hoàn toàn có thể nắm lấy những cơ hội việc làm đó. Job Bank VN sẽ rất tự hào khi có thể giới thiệu cho các bạn những công việc phù hợp và khiến các bạn hài lòng nhất có thể. Sự thành công của người lao động Việt Nam chính là mục đích phát triển của Job Bank VN. ', 21, 0, NULL, NULL, NULL, NULL, NULL),
(22, 'Game programming', 'Game programming  – Lập trình game là một nghề khá hấp dẫn và thú vị, nhất là ở thời đại số hóa như hiện nay. Tuy nhiên, người làm Game programming cần rất nhiều kiến thức chuyên môn sâu và rộng để có thể đáp ứng yêu cầu của công việc. Job Bank VN hân hạnh giới thiệu cho bạn những thông tin tuyển dụng công việc Game programming mới nhất, với mức lương hấp dẫn nhất, được cập nhật hàng ngày, đảm bảo độ chính xác và hỗ trợ ứng tuyển trực tiếp với nhà tuyển dụng. Job Bank VN hy vọng những công việc về Game programming mà chúng tôi cung cấp sẽ khiến cho các bạn hài lòng và có thể tìm được một việc làm phù hợp với khả năng của bạn. Gạt bỏ những rào cản giữa nhà tuyển dụng và người lao động chính là điều mà Job Bank VN luôn nỗ lực hàng ngày, trở thành cầu nối vững chắc giữa người lao động và nhà tuyển dụng, giúp cân bằng cán cân người tìm việc và việc tìm người của xã hội. Sự tín nhiệm và tin tưởng của các bạn chính là động lực giúp Job Bank chúng tôi phát triển mạnh mẽ.  Những việc làm Game programming mà Job Bank VN gửi đến người lao động với hy vọng đó sẽ là công việc mà bạn chọn lựa làm nền tảng cho sự nghiệp của mình. Sự thành công của người lao động Việt Nam chính là sự thành công của Job Bank VN, sự tin tưởng của nhà tuyển dụng chính là mục đích phát triển của Job Bank VN. Chúng tôi luôn cố gắng ngày một mạnh mẽ để đem lại sự hài lòng cho tất cả mọi người. ', 22, 0, NULL, NULL, NULL, NULL, NULL),
(23, 'Drupal', 'Drupal là hệ quản trị nội dung được viết theo hướng mã nguồn mở, cho phép người dùng sử dụng để tạo các cơ sở dữ liệu, tùy biến các cách trình bày theo ý thích. Drupal cho phép người dùng có thể tạo nên những website có nội dung không giới hạn. Có thể viết nên những website là trang tĩnh, những website thông tin cá nhân đơn giản cho tới trang là những website bán hàng, website rao vặt hoặc một website mạng xã hội có nội dung hàng trăm, hàng triệu dữ liệu. Với Drupal, bạn có thể tạo ra bất kỳ website nào theo ý muốn của bạn. Bản thân Drupal rất dễ sử dụng. Thậm chí người dùng không cần phải biết thành thạo html hoặc php mới có khả năng sử dụng drupal. Hơn nữa, drupal được tối ưu nâng cao hiệu suất hoạt động giúp hệ thống tiết kiệm tài nguyên hơn. Đồng thời, cấu trúc ở dạng các module nên rất linh hoạt để mở rộng các chức năng, không hạn chếtheo nhu cầu sử dụng của người dùng cụ thể.  Drupal hiện được các website có lượng truy cập lớn như BBC, MTV, v.v... tin tưởng vào khả năng xử lý mạnh mẽ và ổn định khối lượng dữ liệu lớn. Drupal cũng thân thiện với các công cụ tìm kiếm, hỗ trợ các chiến dịch SEO của website. Giúp cho website nhanh chóng được SEO có thứ hạng tốt.  Với những ưu điểm của mình drupal hiện đang được sử dụng rất rộng rãi do khả năng chạy trên hệ điều hành không hạn chế là windows hay linux. Tạo ra một cộng đồng sử dụng rất rộng rãi. Drupal ra đời đã giúp cho những người tự nghiên cứu có thể sở hữu được một website do mình tự viết một cách dễ dàng và không tốn kém.', 23, 0, NULL, NULL, NULL, NULL, NULL),
(24, 'J2EE', 'J2EE là nền tảng dành cho việc phát triển các ứng dụng phân tán, dựa vào các thành phần module chạy trên các máy chủ ứng dụng. J2EE cung cấp các kỹ thuật hỗ trợ cho lập trình ứng dụng phân tán như RMI, JMS, web services, XML, v.v... Bên cạnh kỹ thuật xử lý song song, lập trình ứng dụng phân tán để tăng hiệu suất xử lý của hệ thống đang được áp dụng ngày càng nhiều. Nhất là trong những hệ thống lớn, cần xử lý dữ liệu nhanh và chính xác. Chính vì ưu điểm này mà các hệ thống xử lý phân tán ra đời và được đưa vào sử dụng nhiều hơn. Các ngân hàng, các doanh nghiệp lớn là những khách hàng tiềm năng cho mảng này vì yếu tố bảo mật dữ liệu cũng như đòi hỏi tính chính xác, khả năng sao lưu dữ liệu của hệ thống ngay trước khi xảy ra sự cố, v.v...  Đứng trên phương diện kỹ thuật, khi J2EE được xử dụng nhiều sẽ thúc đẩy tốc độ xử lý dữ liệu tăng lên, nâng cao tiêu chí nhanh chóng và hiệu quả trong tính toán. Sẽ mang lại lợi ích cho người sử dụng đồng thời là động lực để ngành lập trình phát triển hơn nữa. Thành phố Hồ Chí Minh là một trong những thành phố có số lượng nhân lực chất lượng làm việc trong ngành công nghệ lập trình nhiều nhất nước. Đồng thời cơ hội việc làm đầy hứa hẹn và tiềm năng phát triển cũng là hàng đầu. Do đó, người tìm việc làm khối ngành lập trình và cụ thể là J2EE hoàn toàn dễ dàng có được cơ hội nghề nghiệp tốt nhất. Là bước đệm để phát triển hơn trong tương lai. ', 24, 0, NULL, NULL, NULL, NULL, NULL),
(25, 'OOP', 'Thế giới công nghệ thông tin đang mở ra những hướng đi mới để mô phỏng những nghiệp vụ trong công việc và cả các hoạt động trong cuộc sống thường nhật. Càng lúc sức lao động của con người được thay thế bởi máy móc càng nhiều. Song song đó, những giải pháp thông minh mang đến những tiện ích trong đời sống hàng ngày như nhà thông minh tự động tắt các thiết bị điện, gas khi chúng ta ra khỏi nhà và bật mở khi chúng ta về trong một bán kính nhất định. Hệ thống khóa điện tử thay thế cho các bộ khóa cơ như trước đây, tiện lợi rất nhiều và bảo mật cao hơn, v.v... Làm được điều đó, nhân lực trong ngành lập trình ứng dụng đã làm việc rất chăm chỉ. Không chỉ phải đáp ứng yêu cầu thực hiện được những mục tiêu của dự án, thành thạo chuyên môn một ngôn ngữ nào đó, mà còn phải bắt kịp sự phát triển của những ngôn ngữ lập trình mới xuất hiện, những kỹ thuật tiên tiến hơn được phát triển. Trước đây khi sử dụng những ngôn ngữ lập trình theo hướng cấu trúc, những dự án đã thực hiện không có khả năng tái sử dụng. Gây tốn nhiều thời gian để làm lại từ đầu những gì đã làm trước đó khi muốn sử dụng lại đoạn code. Do đó, một hướng đi mới ra đời để giải quyết vấn đề này. Bằng cách sử dụng phương pháp lập trình theo hướng đối tượng mà cụ thể ban đầu là sử dụng Java. Sau này những ngôn ngữ khác đều phát triển theo hướng hướng đối tượng. Lập trình hướng đối tượng ra đời đã giúp tiết kiệm nhiều công sức cho người lập trình khi chỉ cần kế thừa và sử dụng lại những chức năng đã lập trình, và phát triển thêm các chức năng mới. Chính vì chính tiện dụng hữu ích này mà lập trình hướng đối tượng đang được sử dụng rộng rãi và có vị thế ngày càng quan trọng. ', 25, 0, NULL, NULL, NULL, NULL, NULL),
(26, 'Unity', 'Sự bùng nổ của các thiết bị di động thông minh như smartphone, máy tính bảng, máy tính bảng lai, v.v.. đã mang lại nhiều kênh giải trí đến cho người. Không còn quá khó khăn để học các loại ngoại ngữ khi giờ đây, rất nhiều phần mềm đã ra đời, hướng dẫn chi tiết và hỗ trợ tối đa các kỹ năng cần thiết. Tương tự như thế các trò chơi được thiết kế và lập trình ngày càng đặc sắc và thú vị cả về chức năng lẫn thiết kế đồ họa. Nếu như những phiên bản game đầu tiên của thế giới dạng 2D thì nay đã được phát triển lên thành thế hệ game 3D đáp ứng thị hiếu của người dùng. Các cửa hàng ứng dụng trực tuyến là một kênh đưa các chương trình game đến cho người dùng nhanh chóng. Tạo ra danh tiếng và cả thu nhập rất lớn cho các nhà phát triển game. Tạo động lực cho mảng game di động ngày càng tăng trưởng theo cấp số nhân trong thời gian ngắn.  Hiện nay, Unity được sử dụng phổ biến bởi các ưu điểm của mình trong quá trình thiết kế và lập trình game. Các nhà phát triển game có thể sử dụng Unity để thiết kế các hình ảnh trên nền 3D, các hình ảnh đồ họa hỗ trợ thiết kế sắc nét và sinh động. Unity đã dần thay thế cho các phần mềm dùng để thiết kế game trước đây và khẳng định được vị trí của mình trong lựa chọn của các nhà phát triển. Tại thành phố Hồ Chí Minh hiện nay, có nhiều nhà phát triển đang cố gắng tạo ra những sản phẩm chất lượng để cạnh tranh với nhà phát hành game lớn như Vinagame. Vẫn còn nhiều thị phần và cơ hội đủ để chia sẻ cho tất cả mọi người.', 26, 0, NULL, NULL, NULL, NULL, NULL),
(27, 'Python', 'Một ngôn ngữ lập trình năng động, có nhiều tính năng được sử dụng trong các ứng dụng phổ biến và có nhiều đặc tính tuyệt vời, Python trở nên thân thiện với người sử dụng. Python có cú pháp rất dễ đọc, ngoài ra còn rất mạnh mẽ và nhanh nhờ vào tính biên dịch được tối ưu hóa cũng như có những thư viện hỗ trợ. Ngoài ra, Python còn rất thân thiện vì hòa hợp tốt với các đối tượng khác, có thể chạy trên mọi hệ điều hành như Windows, Linux, Unix, Mac, Amiga... Có lẽ vì tính linh hoạt của mình mà nó được gọi là Python chăng. Nếu như bạn có kiến thức về Python hay muốn làm những công việc liên quan đến Python thì danh sách thông tin tuyển dụng những việc làm Python dưới đây sẽ đáp ứng được những mong muốn của bạn. Hãy chọn cho mình một công việc thích hợp nhất và bắt đầu ứng tuyển ngay hôm nay để có thể nắm trong tay một bước đệm nghề nghiệp vững chắc. Được làm công việc mình yêu thích và phù hợp với năng lượng chính là điều mà mọi người lao động luôn hướng tới. Để có thể tìm những việc làm chất lượng tốt như vậy, các bạn hãy đến với Job Bank VN để chúng tôi giúp đỡ bạn nhé. Job Bank VN có đủ những công việc thuộc nhiều lĩnh vực và ngành nghề khác nhau, và Python chính là một trong số đó. Những thông tin tuyển dụng được cập nhật hàng ngày và đảm bảo tính chính xác của chất lượng thông tin. Job Bank VN luôn mong muốn có được sự tin tưởng  tuyệt đối của người lao động Việt Nam.', 27, 0, NULL, NULL, NULL, NULL, NULL),
(28, 'Ruby on Rails', 'Ruby on rails là một Framework cho phép phát triển ứng dụng web, gồm 2 phần đó là phần ngôn ngữ Ruby và phần Framework rails. Trong đó Ruby là một ngôn ngữ lập trình mã nguồn mở, rất linh hoạt và đơn giản, dễ sử dụng. Framework rails thì gồm nhiều thư viện liên kết. Ruby on rails nhờ sức mạnh và những tính năng nổi bật của mình và được hỗ trợ mạnh mẽ sẽ giúp người sử dụng thấy được nhiều điều thú vị.  Với lợi thế đó của mình, Ruby on rails thu hút rất nhiều người tìm học và thực hành. Nếu như bạn là người có kiến thức và hứng thú với Ruby on rails thì hãy tìm cho mình một công việc liên quan đến Ruby on rails ngay hôm nay để có cơ hội trau dồi, học hỏi thêm về lĩnh vực này nhé. Job Bank VN sẽ cung cấp cho bạn danh sách những công việc Ruby on rails mới nhất, tốt nhất cho bạn lựa chọn. Đến với Job Bank VN, người lao động Việt Nam sẽ không còn phải băn khoăn hay lo lắng khi tìm việc làm nữa khi mà những tiện ích, những thông tin mà Job Bank mang đến đều hữu ích và tiện lợi cho các bạn. Sự tín nhiệm của người lao động Việt Nam là điều mà Job Bank VN luôn mong muốn đạt được và luôn nỗ lực hết mình để có thể hỗ trợ người lao động nhiều hơn nữa. Hãy đến với Job Bank Vn ngay hôm nay, dù là công việc liên quan đến Ruby on rails hay bất kể những ngành nghề, những chuyên môn nào khác, Job Bank VN cũng sẽ cung cấp cho người lao động đầy đủ. ', 28, 0, NULL, NULL, NULL, NULL, NULL),
(29, 'Agile', 'Phương thức phát triển phần mềm linh hoạt – Agile software development hay được gọi vắn tắt là Agile ngày nay đã quá phổ biến trong ngành phát triển phần mềm. Agile thu hút sự quan tâm đặc biệt từ cộng đồng lập trình phần mềm bằng các phương thức tổ chức và triển khai phần mềm một cách mới lạ, năng động và linh hoạt để đưa các sản phẩm đến tay người dùng càng nhanh càng tốt. Agile được xem là một cải tiến thành công khi đặt cạnh những mô hình quy trình phát triển phần mềm cũ trước đây như mô hình Thác nước, v.v.. Với những nguyên tắc chuẩn quy định quy trình phát triển một phần mềm để mang lại hiệu quả tốt nhất trong thời gian ngắn nhất để hoàn thành một sản phẩm phần mềm. Áp dụng những quy tắc này sẽ giảm thiểu được thời gian lãng phí do những sai sót về nghiệp vụ và nhân sự. Agile đang được đưa vào áp dụng, dần thay thế cho những quy trình trước đây. Trong khi thị trường lập trình ứng dụng tại nước ta nói chung và thành phố Hồ Chí Minh nói riêng đang phát triển nhanh và sôi động, Agile đã góp phần thúc đẩy hiệu quả mang lại cho ngành. Đồng thời tăng uy tín, cũng như chất lượng các sản phẩm được tạo ra và cung cấp cho người dùng. Quá trình áp dụng các quy tắc của Agile sẽ khiến cho đội ngũ lao động hoạt động trong ngành lập trình hay kiểm thử trở nên chuyên nghiệp hơn và bắt kịp với nhịp độ của các thị trường lập trình ứng dụng phát triển khác trong khu vực như Ấn Độ, Trung Quốc, Singapore, v.v...', 29, 0, NULL, NULL, NULL, NULL, NULL),
(30, 'Project Manager', 'Thị trường lao động tại Việt Nam nhận được sự quan tâm của các nhà đầu tư nước ngoài nhất là nhóm những ngành công nghệ cao như công nghệ thông tin, chế tạo máy, v.v.. Nguồn vốn đầu tư vào các dự án của nhóm ngành này rất lớn. Đặc biệt khi thị trường Việt Nam trở nên hấp dẫn hơn trong mắt các nhà đầu tư Nhật Bản và Hàn Quốc. Trong những năm gần đây, số lượng dự án trong ngành lập trình tăng vọt, tạo điều kiện việc làm tốt cho nhân lực ngành công nghệ thông tin. Project manager là vị trí quan trọng trong bất kỳ dự án phần cứng cũng như phần mềm nào. Bởi lẽ, một người quản lý dự án đóng vai trò như cầu nối giữa đội ngũ lập trình và bộ phận tiếp nhận khách hàng của doanh nghiệp hoặc đôi khi họ làm việc trực tiếp với khách hàng. Đó là những người có xuất phát điểm là một lập trình viên, am hiểu chuyên môn và có khả năng tư duy, quản lý một nhóm làm việc bằng cách xây dựng các liên kết giữa các thành viên trong nhóm và thúc đẩy cả nhóm làm việc hiệu quả. Đó là một vị trí thú vị nhưng cũng nhiều thách thức khi phải đối diện với áp lực về ngôn ngữ, thời gian và cả quản trị con người.  Độ tuổi của nhân viên quản lý dự án đang ngày càng trẻ hóa bởi lẽ những cơ hội việc làm trong ngành nhiều dẫn đến cơ hội được làm việc trong môi trường chuyên nghiệp sớm dễ dàng hơn đối với các bạn lập trình trẻ. Điều đó tạo nên một đà tốt để thăng tiến và là nền tảng cho một nhà quản lý ra đời.  ', 30, 0, NULL, NULL, NULL, NULL, NULL),
(31, 'Tester', 'Trong ngành IT, có lẽ nghề Tester không còn xa lạ gì nữa, Tester giữ vai trò quan trọng đối với những công ty IT, đặc biệt là những công ty lớn, luôn giữ uy tín lên hàng đầu. Nghề Tester hiện nay cũng rất được ưa chuộng và nhu cầu tìm kiếm những Tester của các doanh nghiệp ngày càng nhiều. Nếu các bạn đang tìm kiếm công việc liên quan đến Tester thì danh sách những việc làm dưới đây sẽ giúp bạn tìm cho mình một công việc phù hợp. Hãy nhanh tay ứng tuyển ngay hôm nay để có thể nắm lấy cơ hội việc làm tốt nhất mà bạn luôn mơ ước cũng như đón nhận một công việc mới phù hợp với bản thân mình hơn.  Job Bank VN sẽ rất vui mừng khi người lao động Việt Nam có thể tìm được công việc mà mình mong muốn nhờ sự giúp đỡ của chúng tôi. Sự tin tưởng và tín nhiệm của các bạn chính là động lực phát triển của Job Bank VN chúng tôi. Những thông tin tuyển dụng được cung cấp bởi những nhà tuyển dụng hàng đầu Việt Nam sẽ khiến người lao động hài lòng với nội dung thông tin chính xác, rõ ràng và luôn được cập nhật. Dù là danh sách những công việc Tester hay những công việc khác, Job Bank Vn đều cố gắng tìm kiếm, chọn lọc và đem đến cho người lao động một cách nhanh chóng nhất. Các bạn sẽ không còn phải lo lắng về những vấn đề như thông tin sai lệch, thông tin quá hạn, thông tin không rõ ràng... Job Bank VN, đảm bảo một tương lai tươi sáng cho người lao động Việt Nam. ', 31, 0, NULL, NULL, NULL, NULL, NULL),
(32, 'Manager', 'Quản lý dự án ngành công nghệ thông tin nói chung và quản lý các dự án lập trình nói riêng đang là một trong những vị trí hot trên thị trường tuyển dụng nhân sự chất lượng cao hiện nay. Với mức thu nhập hấp dẫn hàng ngàn USD, khả năng được đi công tác nước ngoài và có điều kiện được làm việc trong môi trường quốc tế chuyên nghiệp. Thu hút rất nhiều sự quan tâm của đông đảo người tìm việc có kinh nghiệm chuyên môn và  cả tham vọng.  Các dự án được các nhà đầu tư nước ngoài rót vốn vào thị trường Việt Nam nói chung và thành phố Hồ Chí Minh nói riêng, ngày càng nhiều. Do đó bên cạnh nhu cầu về số lượng kỹ sư lập trình có kinh nghiệm lớn thì đội ngũ quản lý dự án chất lượng cao càng được chú trọng. Trong đó, đáng chú ý nhất là sự tăng trưởng cả về số lượng và quy mô các dự án của các nhà đầu tư đến Nhật Bản. Từ lâu, nhân sự Việt Nam được đánh giá cao về trình độ, sự tận tụy và chi phí thấp hơn so với các nước trong khu vực. Đây chính là cơ hội tốt cho các lập trình viên nhiều kinh nghiệm và có vốn hiểu biết chuyên sâu về ngôn ngữ bản địa.  Trong xu thế kinh tế thế giới đang bị đình trệ, ảnh hưởng nghiêm trọng đến nền kinh tế của Việt Nam, chính vì thế vấn đề việc làm luôn là một nỗi lo của đông đảo người lao động. Khi mà tình trạng doanh nghiệp làm ăn thua lỗ dẫn đến giải thể ngày càng nhiều. Chính vì thế, Jobbank mong muốn mình là giải pháp việc làm hiệu quả cho các lao động chất lượng cao, góp phần thúc đẩy kinh tế đất nước bước qua khủng hoảng.', 32, 0, NULL, NULL, NULL, NULL, NULL),
(33, 'QA QC', 'QA và QC là hai phần chính của hệ thống quản lý chất lượng thuộc quản lý dự án. QA (Quality Assurance) - giám sát, quản lý chất lượng sản phẩm, là quá trình trong đó gồm những công đoạn như xác định, lập kế hoạch, thực hiện và xem xét lại các quy trình quản lý nhằm đảm bảo sản phẩm của công ty phù hợp với yêu cầu chung của thị trường. QA giúp hệ thống quản lý chất lượng của một công ty có thể ngăn ngừa những rủi ro có thể xảy ra như thế nào đối với sản phẩm của công ty. Nếu như QA mang tính vĩ mô thì QC (Quality Control) lại mang tính vi mô. QA là giám sát, quản lý, và bảo hành chất lượng của sản phẩm. Công ty thực hiện QC để có thể xác minh là sản phẩm của họ sẽ đạt được yêu cầu trong mỗi hợp đồng. QC sẽ quy định nên kiểm tra chất lượng sản phẩm ở những công đoạn nào, cũng như sẽ sử dụng phương pháp, tiêu chuẩn nào để đánh giá...  QA và QC giống như bộ phận chỉ huy và bộ phận thi hành, phối hợp nhịp nhàng với nhau nhằm đem lại hiệu quả cao nhất cho công ty và doanh nghiệp.  Nếu các bạn muốn tìm những công việc liên quan đến QA/QC thì danh sách thông tin tuyển dụng dưới đây sẽ giúp đỡ bạn phần nào. Hãy nhanh chóng tìm cho mình một việc làm phù hợp để ổn định nền móng sự nghiệp sau này. Job Bank VN hy vọng rằng người lao động Việt Nam sẽ có thể phát triển hơn nữa trong tương lai, được giúp đỡ các bạn chính là sứ mệnh của Job Bank VN. ', 33, 0, NULL, NULL, NULL, NULL, NULL),
(34, 'Joomla', 'Những lập trình viên PHP không ai không biết đến Joomla và vai trò quan trọng của Joomla trong quá trình thiết kế một website động. Với những thế mạnh, hỗ trợ từ các thành viên trong cộng đồng Joomla, ngày càng thu hút nhiều đông đảo các nhà phát triển nghiên cứu và cống hiến những kiến thức của mình cho cộng đồng ngày càng lớn mạnh. Chính yếu tố này tạo điều kiện cho những người mới tham gia vào thế giới ngôn ngữ PHP và Joomla dễ dàng nâng cao trình độ, kỹ năng của mình.Đó là lý do vì sao Joomla phổ biến và là một trong những hệ quản trị nội dung phát triển nhanh chóng hiện nay. Joomla được sử dụng ở khắp mọi nơi trên thế giới. Được sử dụng không những trong những website cá nhân đơn giản mà còn dùng cho cả những hệ thống website của các doanh nghiệp, tập đoàn lớn có tính phức tạp cao về nội dung và cả chức năng, đòi hỏi cung cấp nhiều dịch vụ và ứng dụng trong hệ thống. Một trong số những lý do mà Joomla được người dùng tin dùng bởi vì Joomla có mã nguồn mở, được phát hành miễn phí và có thể được tùy biến lại theo nhu cầu sử dụng cụ thể. Bên cạnh đó, Joomla có thể được cài đặt một cách dễ dàng, quy trình quản lý các tác vụ hoàn toàn đơn giản và đáng tin cậy.  Việc sử dụng thành thạo một ngôn ngữ mã nguồn mở luôn mang lại một nguồn động lực và phấn khích đối với những nhà phát triển. Chưa kể nhu cầu thực tế của các khách hàng rất cao, mang lại nguồn thu nhập hứa hẹn cho các lập trình viên.', 34, 0, NULL, NULL, NULL, NULL, NULL),
(35, 'Embedded', 'Hệ thống nhúng mới được du nhập vào Việt Nam chỉ vài năm gần đây. Tuy nhiên, hệ thống nhúng đã xuất hiện từ rất lâu, vào thập niên 60 của thế kỷ trước. Được áp dụng vào nhiều lĩnh vực từ công nghiệp cho tới đời sống. Vậy hệ thống nhúng là gì mà có ứng dụng rộng rãi như vậy? Hệ thống nhúng là hệ thống chuyên dụng, có khả năng tự vận hành và được thiết kế để tích hợp vào một hệ thống lớn hơn để thực hiện chức năng đặc biệt nào đó một cách tự động hóa. Thông thường, các thiết bị tích hợp chỉ có khả năng thực hiện 1 hoặc vài chức năng cụ thể. Chính vì thế, các nhà sản xuất thường tối ưu hóa, giảm kích thước và chi phí giá thành sản xuất. Có thể lấy ví dụ như hệ thống thắng xe hơi, hệ thống điều khiển thiết bị trong các nhà máy, điện thoại đi động, điều hòa nhiệt độ, hệ thống định vị toàn cầu được tích hợp vào điện thoại di động, v.v...Một hệ thống nhúng bao gồm cả phần cứng và phần mềm. Phải hoạt động đáp ứng theo tiêu chí real-time, nghĩa là tức thời, mức độ đáp ứng phải nhanh chóng hoặc độ trễ phải cực kỳ thấp.  Để lập trình nên một hệ thống nhúng hoàn chỉnh, các lập trình viên phải có kiến thức đầy đủ về các bộ vi xử lý và phần cứng của các nhà sản xuất khác nhau trên thị trường. Bộ vi xử lý, hệ điều hành và ngôn ngữ được sử dụng để lập trình. Bởi vì nó hoàn toàn khác so với những ngôn ngữ và hệ điều hành được sử dụng ở các máy vi tính. Do đó, cần phải đầu tư nghiên cứu nhiều hơn so với những lập trình viên website hoặc chương trình ứng dụng.', 35, 0, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tags` (`id`, `name`, `description`, `list_order`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(36, 'Flash', 'Một website mang dấu ấn cá nhân từ bố cục, thiết kế các hình ảnh, nội dung sẽ nhanh chóng tìm được chỗ đứng trong lòng người xem hơn là những website na ná giống nhau, nội dung nhàm chán, hình ảnh xấu, hiệu ứng không ấn tượng. Từ đó, mức độ phổ biến của website được các công cụ tìm kiếm hiện nay như google, bing, v.v... đánh giá cao hơn, nhanh được tăng hạng trong kết quả tìm kiếm hơn. Ý tưởng thiết kế giao diện của một website gồm nhiều phần. Nhưng bao giờ cũng có một điểm nhấn để thu hút khách truy cập vào website. Thông thường, website được thiết kế nhấn mạnh vào các sự kiện muốn giới thiệu hoặc đơn giản là hưởng ứng theo mùa và các sự kiện tương ứng trong năm. Ví dụ Tết trung thu, Giáng sinh, Tết dương lịch, Tết âm lịch, v.v... là những dịp website được thay áo mới. Một trong số những phương pháp thường sử dụng nhất và mang lại hiệu quả tốt nhất là tạo những hình ảnh flash động. Không gì hút mắt và gây thích thú như khi tìm thấy câu trả lời cho những câu hỏi “tuyết rơi trông thế nào?” hay “nhạc xuân năm nay có gì hay không?”. Chính những tương tác thầm lặng đó đã níu chân người xem và muốn quay trở lại. Những kỹ thuật thiết kế flash không hề khó hay phức tạp như xử lý hình ảnh. Nhưng hiệu quả truyền tải thông điệp của nó thì hơn hẳn. Chủ yếu chú trọng vào nội dung, chất lượng hình ảnh, chất lượng đồ họa và ý tưởng được đưa ra. Đó là yếu tố sống còn quyết định hiệu quả của một file flash nói riêng và cả event nói chung.', 36, 0, NULL, NULL, NULL, NULL, NULL),
(37, 'MySQL', 'Với xu hướng chuyển các ứng dụng và cổng thông tin chạy trên nền website để tăng tính khả dụng khi giờ đây việc sở hữu một chiếc điện thoại di động có khả năng kết nối internet và truy cập vào website không còn quá xa vời mà đã trở nên phổ biến. Khiến cho mức độ phổ biến của các website càng nhanh chóng. Để hỗ trợ vấn đề lưu trữ cơ sở dữ liệu của website, hiện tại hệ quản trị cơ sở dữ liệu được sử dụng phổ biến là MySQL, Oracle, SQL Server. Tuy nhiên, do những ưu điểm của một hệ quản trị dữ liệu mã nguồn mở, có khả năng làm việc được trên cả hệ điều hành microsoft windows và cả hệ điều hành linux nên MySQL được sử dụng phổ biến hơn mà vẫn đảm bảo cơ chế dữ liệu hoạt động theo mô hình các lớp. Các doanh nghiệp hoạt động tại Việt Nam chủ yếu là những doanh nghiệp vừa và nhỏ nên lựa chọn MySQL để quản lý cơ sở dữ liệu là hoàn toàn phù hợp.  Với đặc điểm là một hệ quản trị cơ sở dữ liệu mã nguồn mở, MySQL nhận được sự quan tâm đặc biệt của những nhà phát triển bởi khả năng sở hữu source miễn phí từ trang chủ của MySQL và phát triển theo hướng chuyên biệt của mình. Thêm vào đó, khả năng bảo mật dữ liệu nhờ các thuật toán mã hóa giúp cho an toàn thông tin được đảm bảo, tránh bị tấn công từ bên ngoài. Đây là giải pháp tuyệt vời cho các doanh nghiệp vừa và nhỏ tại Việt Nam mà không phải lo lắng về vấn đề bản quyền hay phải lo lắng về vấn đề bảo mật', 37, 0, NULL, NULL, NULL, NULL, NULL),
(38, 'SQL server', 'SQL server được microsoft xây dựng là một hệ quản trị cơ sở dữ liệu liên kết với nhau, trao đổi dữ liệu giữa máy chủ và máy client, được sử dụng rộng rãi trên nhiều lĩnh vực bởi nó tương thích với hệ điều hành microsoft windows và windows server. Chưa kể, SQL server cho phép người sử dụng phân tích và xử lý dữ liệu mà không đòi hỏi phải biết quá chuyên sâu. SQL đóng vai trò trung gian giữa nguồn cơ sở dữ liệu và website. Các truy vấn lấy dữ liệu của người sử dụng khi tiến hành tương tác trên giao diện website được SQL thực hiện, sau đó trả về kết quả tương ứng. Hiện nay hầu như tất cả các ngôn ngữ lập trình đều hỗ trợ SQL.  SQL server được tối ưu hóa để có thể chạy trên những môi trường cơ sở dữ liệu rất lớn, có khi lên đến hàng tera byte và có khả năng phục vụ cùng lúc hàng ngàn user truy xuất dữ liệu mà vẫn đảm bảo tốc độ nhanh chóng, ổn định. Trước khi có SQL server việc quản lý cơ sở dữ liệu để các website truy xuất động diễn ra rất khó, chậm và tính chính xác chưa cao. Hiện nay, nguồn cơ sở dữ liệu ngày càng lớn, nhu cầu quản trị của các doanh nghiệp một cách bảo mật và an toàn, hiệu quả càng tăng khi nó ảnh hưởng đến uy tín của doanh nghiệp. Đây là cơ hội việc làm cho nhiều cử nhân công nghệ thông tin theo hướng quản trị dữ liệu. Khi mà mọi cơ hội việc làm đều dành cho những lập trình viên thì những mảng chuyên môn mới có yêu cầu và vị trí ngày càng quan trọng khác trong việc thiết lập một hệ thống thông tin an toàn và hiệu quả cao. ', 38, 0, NULL, NULL, NULL, NULL, NULL),
(39, 'Oracle', 'Oracle là một hệ quản trị cơ sở dữ liệu hàng đầu trên thế giới hiện nay, có chức năng chính là xử lý, quản trị hệ cơ sở dữ liệu rất lớn. Đối với những sản phẩm được Oracle cấp bản quyền được bảo hành dữ liệu vĩnh viễn. Đó là bởi vì Oracle rất tự tin vào khả năng backup dữ liệu tốt nhất của mình. Những doanh nghiệp lớn, ngân hàng cần có sự đảm bảo về nguồn tài nguyên vô hình là cơ sở dữ liệu, đã rất tin dùng hệ quản trị cơ sở dữ liệu Oracle.  Tại Việt Nam, nhu cầu sử dụng các hệ điều hành mã nguồn mở như Linux, Solaris, v.v.. thay thế cho windows đang ngày càng nhiều. Do đó, một hệ quản trị cơ sở dữ liệu có thể được cài đặt và thực thi trên nhiều hệ điều hành như Oracle chiếm ưu thế cao hơn trước đối thủ của mình là SQL server của hãng Microsoft. Thêm một điểm cộng nữa là bản quyền của Oracle tại Việt Nam rẻ hơn các nước khác. Chính vì thế nhiều doanh nghiệp đã mạnh dạn đầu tư xây dựng hệ thống và tuyển quản trị viên hoặc cử nhân viên của mình đi học các khóa đào tạo ngắn hạn.  Đứng trước cơ hội tuyển dụng của các doanh nghiệp như hiện nay, những quản trị viên hệ thống cơ sở dữ liệu Oracle có được việc làm với mức lương hấp dẫn và môi trường làm việc hiện đại, chuyên nghiệp. Những sinh viên mới ra trường, những ứng viên muốn tìm kiếm cho mình một cơ hội việc làm tốt, có khả năng thăng tiến cao. Hãy nhanh chóng tìm cho mình một cơ hội nghề nghiệp tốt cùng với Jobbank để khẳng định bản thân và xây dựng một cuộc sống thịnh vượng hơn', 39, 0, NULL, NULL, NULL, NULL, NULL),
(40, 'Business Analyst', 'Ứng dụng công nghệ thông tin vào thực tiễn đã tạo ra nhiều nhóm công việc phù hợp với đòi hỏi đáp ứng các nghiệp vụ kinh doanh của doanh nghiệp. Trong số đó, mảng quản trị cơ sở dữ liệu được mở rộng thành quản trị số liệu, xử lý các kết quả kinh doanh để sử dụng vào các chiến lược trong tương lai. Một trong số đó là business analyst, chuyên viên phân tích nghiệp vụ kinh doanh.  Một chuyên viên phân tích nghiệp vụ kinh doanh ngoài khả năng sử dụng thành thạo các phần mềm hỗ trợ thống kê, còn cần phải có thêm kiến thức về các xu hướng đầu tư, các chiến dịch của các đối thủ, v.v.. Từ đó, đưa ra các đánh giá về hiệu quả kinh doanh đạt được dựa trên các số liệu ban đầu. Đây là tài liệu tham khảo giúp ban lãnh đạo doanh nghiệp có thể dựa vào để hoạch định các chiến dịch kinh doanh.  Nếu như trước đây, những công việc chuyên ngành của ngành công nghệ thông tin như lập trình, quản trị mạng máy tính là những ngành mặc định dành cho nam giới, thì nay quản trị cơ sở dữ liệu và phân tích nghiệp vụ kinh doanh đã mở ra hướng đi mới cho lao động nữ. Với lợi thế nhanh nhạy và kỹ lưỡng trong tính toán, cũng như là có trực giác tốt hơn, các nữ ứng viên sẽ là lựa chọn thích hợp. Hiện nay, Jobbank hiện được các nhà tuyển dụng cung cấp thông tin về nhu cầu tuyển dụng của vị trí này với mức lương và đãi ngộ tốt nhất trên thị trường. Các ứng viên chỉ cần truy cập vào website của chúng tôi tại địa chỉ http://www.job-bank.vn/ để có thêm thông tin chi tiết.', 40, 0, NULL, NULL, NULL, NULL, NULL),
(41, 'Bridge SE', 'Trong những năm gần đây, các nhà đầu tư từ Nhật Bản tìm đến với thị trường lao động Việt Nam ngày càng nhiều. Đặc biệt là trong mảng công nghệ thông tin, nhất là gia công và lập trình phần mềm. Số lượng dự án được đầu tư tại thành phố Hồ Chí Minh và Hà Nội tăng lên nhanh chóng. Do đó, nhu cầu tuyển dụng nhân lực trong ngành lập trình ứng dụng ngày càng tăng. Bên cạnh đó, cũng xuất hiện nhiều nhu cầu nhân sự mới. Một trong số đó là Bridge system engineer hay còn được gọi là kỹ sư cầu nối.  Kỹ sư cầu nối là người vừa làm việc trực tiếp với khách hàng, vừa làm việc với đội ngũ kỹ sư lập trình vừa làm việc với ban lãnh đạo của doanh nghiệp. Sau khi nắm rõ những yêu cầu chi tiết do khách hàng cung cấp.Họ đóng vai trò như là cầu nối chuyển tải những yêu cầu của khách hàng đối với sản phẩm đến cho bộ phận lập trình thực hiện. Để có thể làm tốt yêu cầu công việc của vị trí này, các kỹ sư cầu nối phải là người am hiểu kỹ thuật và có khả năng giao tiếp, có kinh nghiệm làm việc với người khác. Tất nhiên, khách hàng chủ yếu là người Nhật nên biết nói tiếng Nhật lưu loát là một lợi thế.  Với mức lương thông thường trung bình là 1000USD cho vị trí này. Cùng với cơ hội được đào tạo chuyên môn, đi công tác thường xuyên tại Nhật. Những du học sinh du học tại Nhật nhất là những du học sinh học ngành công nghệ thông tin vừa am hiểu chuyên môn vừa thành thạo văn hóa và ngôn ngữ Nhật phù hợp với vị trí này.', 41, 0, NULL, NULL, NULL, NULL, NULL),
(42, 'PLC', 'PLC (Programmable Logic Controller) là một thiết bị điều khiển lập trình có thể linh hoạt thực hiện những thuật toán điều khiển logic bằng một ngôn ngữ lập trình. Thực chất PLC chính là một máy tính điện tử được sử dụng trong những quá trình tự động hóa trong công nghiệp. Tính ứng dụng của PLC chủ yếu được dùng trong cách ngành công nghiệp chế tạo và điều khiển các quá trình riêng lẻ. Tuy nhiên ngày này PLC cũng đã được ứng dụng trong việc điền khiển trình tự và những quá trình có tính liên tục. PLC đóng vai trò rất quan trọng trong sự tự động hóa trong sản xuất ngày nay. Nhất là đối với những quốc gia đang trong giai đoạn công nghiệp hóa – hiện đại hóa như Việt Nam, ứng dụng PLC là điều hết sức cần thiết và quan trọng.  Những công việc có liên quan đến việc sử dụng và ứng dụng của PLC vào sản xuất đều được Job Bank Vn thống kê dưới đây, hi vọng sẽ phần nào giúp được người lao động đang cần tìm việc làm nhanh chóng nắm bắt được công việc trong tương lai. Job Bank VN cung cấp cho các bạn những thông tin tuyển dụng mới nhất của những công việc liên quan đến PLC, mong rằng những người có chuyên môn hay có muốn làm việc về PLC có thể thực hiện mong muốn của mình. Với những tiện ích mà Job Bank VN đem đến cho người lao động hiện nay, chúng tôi hy vọng có thể giúp đỡ người lao động Việt Nam trên con đường tìm việc làm của mình. Đó cũng chính là cánh cửa đưa các bạn đến với sự nghiệp tương lai tươi sáng. ', 42, 0, NULL, NULL, NULL, NULL, NULL),
(43, 'Analyst', 'Trong xu hướng kinh tế toàn cầu hóa, mở ra giai đoạn mới cho các doanh nghiệp khi phải học tập các kỹ thuật mới, tiên tiến để áp dụng vào hoạt động thực tiễn của mình để tăng tính cạnh tranh và nâng cao hiệu quả kinh doanh.Phân tích dữ liệu đang là một nhu cầu không của riêng bất kỳ doanh nghiệp nào để đánh giá kết quả kinh doanh thông qua các số liệu thu thập được. Thông qua những con số, rút ra được những thất bại, thành công từ các chiến dịch kinh doanh trước đó.Từ đó, có thể đưa ra những điều chỉnh trong chính sách kinh doanh của mình. Những chuyên viên phân tích và đánh giádữ liệu ngoài kỹ năng sử dụng các phần mềm được cung cấp để xử lý số liệu, tạo các biểu mẫu phục vụ báo cáo, cần có kiến thức về kinh tế, các xu hướng đầu tư, kinh doanh đang được áp dụng trong thực tế. Từ những kết quả phân tích từ phần mềm, chuyên viên phân tích sẽ đánh giá hiệu quả kinh doanh hiện thời, đề ra những kế hoạch để phát triển, dự báo các xu hướng và cả dự trù kết quả đạ được. Đây là một ngành mới xuất hiện tại thị trường Việt Nam trong vài năm vừa qua. Nhưng đã nhanh chóng thu hút được sự quan tâm và nhận được sự đánh giá cao của các doanh nghiệp. Số lượng nhân sự phân tích dữ liệu tăng lên nhanh chóng. Đa số bắt nguồn từ những ngành như kinh tế, tài chính hoặc công nghệ thông tin. Tại thị trường thành phố Hồ Chí Minh đóng vai trò như là một trung tâm tài chính của cả nước, nhu cầu tuyển dụng lại càng cao hơn.', 43, 0, NULL, NULL, NULL, NULL, NULL),
(44, 'System Admin', 'Nếu bạn có hứng thú tới những công việc của một System Admin thì danh sách việc làm dưới đây sẽ giúp bạn nhanh chóng tìm được công việc yêu thích của mình. Một System Admin cần có kiến thức tổng quát về IT và tùy thuộc vào từng yêu cầu mà trau dồi thêm kiến thức chuyên môn của mình. Đây là một công việc có tính học hỏi rất cao, thích hợp cho những người ham tìm hiểu, mở rộng kiến thức. Nếu bạn cảm thấy mình phù hợp với những công việc dưới đây thì hãy nhanh tay ứng tuyển ngay hôm nay để có thể tìm cho mình một con đường sự nghiệp đúng đắn, có cả đam mê và niềm hứng khởi và sự yêu thích cho công việc của mình.  Job Bank VN hy vọng có thể trở thành chiếc cầu nối vững chắc giữa những doanh nghiệp uy tín và người lao động Việt Nam. Những điều mà Job Bank VN đang cố gắng thực hiện chính là đem lại những lợi ích to lớn cho người lao động cũng như giúp đỡ họ trên con đường tìm việc làm đầy gian nan và khó khăn này. Trong thời kì kinh tế phát triển mạnh mẽ như hiện nay, vấn đề việc làm trở thành vấn đề cấp thiết với cả những doanh nghiệp và người lao động. Hiểu được những khó khăn đó, Job Bank VN đang cố gắng trở thành một người hỗ trợ đắc lực nhất cho tất cả những người lao động đang trong thời kì tìm việc làm. Hãy để Job Bank VN giúp đỡ bạn tìm cho mình một hướng đi thích hợp trong tương lai và xa hơn thế nữa. ', 44, 0, NULL, NULL, NULL, NULL, NULL),
(45, 'System Engineer', 'Danh sách những công việc Kỹ sư hệ thống – System Engineer dành cho những người lao động đang cần tìm việc làm liên quan đến IT và có hứng thú với System Engineer, Job Bank VN hân hạnh cung cấp cho bạn những việc làm System Engineer mới nhất và chất lượng nhất, được cung cấp bởi những nhà tuyển dụng uy tín hàng đầu Việt Nam. System Engineer là một công việc đòi hỏi lượng kiến thức rộng về IT, rất thích hợp cho những người ham học hỏi và có niềm đam mê lớn dành cho IT. Hãy tự tin ứng tuyển ngay hôm nay để có cơ hội trở thành một System Engineer như bạn mong muốn. Job Bank VN luôn tạo nhiều điều kiện để người lao động có thể dễ dàng tìm ra được công việc mà mình yêu thích cũng như phù hợp với khả năng của mình. Những gì bạn cần làm chính là tự tin vào kiến thức chuyên môn của bản thân cũng như không ngừng trau dồi những kiến thức mới. Bạn sẽ trở thành một System Engineer tài giỏi và được các doanh nghiệp săn đón.  Hãy để Job Bank VN trao cho bạn một bước đệm, một nền tảng vững chắc trên con đường sự nghiệp dài rộng sau này của bạn nhé. Trở thành cầu nối giữa những người lao động và nhà tuyển dụng chính là mục tiêu phát triển của Job Bank VN, cùng với sự tin tưởng mà các bạn dành cho Job Bank, chúng tôi sẽ còn phát triển và trở nên hữu ích hơn nữa, luôn sát cánh cùng người lao động Việt Nam. Job Bank VN, trao cho bạn những cơ hội việc làm đáng giá nhất. ', 45, 0, NULL, NULL, NULL, NULL, NULL),
(46, 'Linux', 'Qua rồi thời kỳ hệ điều hành Microsoft Windows giữ vị trí độc tôn trong phân khúc cung cấp hệ điều hành cho máy tính trên thế giới. Ngày nay nhiều hệ điều hành với mã nguồn mở đã xuất hiện và dần dần tìm được chỗ đứng của mình. Các hệ điều hành phổ biến hiện nay tồn tại song song với Windows như Linux, Mac, v.v... với những tính năng nổi trội của mình đã được người sử dụng tin dùng và dần thay thế cho hệ điều hành cũ như Windows.\r\nLinux là phiên bản mã nguồn mở của hệ điều hành UNIX được Linus Torvalds viết vào năm 1991 trên môi trường MINIX, gần giống với hệ điều hành Unix. Sau đó với khả năng được mở rộng không giới hạn, lại được phát hành miễn phí, ai cũng có thể download và phát triển từ nhân Linux nên Linux hiện nay có nhiều phiên bản được các quốc gia, các tổ chức và cả cá nhân phát triển ra những phiên bản cho riêng mình. Nhu cầu sử dụng hệ điều hành Linux càng ngày tăng, đòi hỏi lượng quản trị viên am hiểu, quản trị hệ thống Linux một cách thành thạo đảm bảo vận hành trôi chảy ngày càng nhiều. \r\nVới ưu điểm tính bảo mật cao vượt trội so với Windows, yêu cầu cấu hình thấp hơn nhưng tốc độ xử lý lại nhanh hơn, đồng thời hiện nay đã có nhiều phiên bản Linux có giao diện thân thiện với người dùng. Khiến cho Linux được người dùng là cá nhân tăng lên bên cạnh những chuyên gia IT, doanh nghiệp, các tổ chức hoặc chính phủ. Và trúc vi xử lý được xây dựng để hỗ trợ cho Linux. Do đó, thật không ngoa khi nói tương lai là thời đại của mã nguồn mở.\r\n', 46, 0, NULL, NULL, NULL, NULL, NULL),
(47, 'Windows server', 'Tại sao lại là windows server? Một doanh nghiệp có nhất thiết phải sử dụng hệ điều hành dành cho máy chủ này của microsoft không? Sao không là một hệ điều hành nào khác? v.v... Là chuỗi những câu hỏi để định hình những hình dung về chức năng và thế mạnh khiến cho người dùng mà cụ thể là các doanh nghiệp bỏ tiền túi ra mua và sở hữu hệ điều hành này phục vụ quá trình hoạt động kinh doanh của mình.  Windows server là hệ điều hành dành cho các máy chủ do microsoft phát hành. Với ưu điểm là sở hữu những chức năng mạnh mẽ hỗ trợ quá trình quản trị người dùng và các chương trình trong hệ thống mạng máy tính tập trung hơn. Các công nghệ ngôn ngữ kịch bản quản lý mới được đưa vào sử dụng giúp cho các nhiệm vụ được tự động thực thi khi đã thiết lập. Đồng thời với những công nghệ mới ra đời cho phép máy chủ có thể điều khiển những máy tính ở các chi nhánh ở xa làm việc với những chức năng và quyền hạn nhất định được thiết lập sẵn. Qua đó, có thể giám sát và quản lý toàn bộ các máy tính trong mạng. Chức năng ảo hóa giúp hệ thống bảo vệ được nguồn dữ liệu quý giá của mình trước nguy cơ tấn công từ bên ngoài cũng như bên trong hệ thống mạng.  Với những điểm mạnh được cung cấp trong hệ điều hành windows server, doanh nghiệp hoàn toàn có thể yên tâm rằng mình đang được bảo vệ với những công nghệ bảo mật mạnh. Và có khả năng mở rộng khi cần thiết để tăng hiệu suất và khả năng cũng như phạm vi hoạt động của hệ thống mạng máy tính của mình.', 47, 0, NULL, NULL, NULL, NULL, NULL),
(48, 'Networking', 'Vài năm trở lại đây, networking đã  không còn xa lạ đối với những doanh nghiệp vừa và nhỏ. Việc lắp đặt các máy tính trong doanh nghiệp để hỗ trợ quá trình làm việc diễn ra nhanh chóng, nhịp nhàng và bắt kịp với môi trường kinh doanh cạnh tranh xung quanh đã trở thành một điều tất yếu. Bởi lẽ sự sống còn của doanh nghiệp đôi khi được quyết định bởi sự chính xác hơn nhau một con số 0 hoặc tốc độ xử lý dữ liệu nhanh hơn một vài giây. Do đó nhu cầu thiết kế, thi công hệ thống mạng một cách hiệu quả, chuyên nghiệp và mang tính thẩm mỹ cao ngày càng lớn. Hiện nay, tùy từng doanh nghiệp cụ thể mà nhu cầu này cũng khác nhau. Có nơi sẽ thuê một công ty khác chuyên thiết kế, thi công và quản trị, support hệ thống. Nhưng cũng có công ty muốn chủ động quản trị hệ thống của mình, sẽ có IT quản trị hệ thống phần cứng và quản trị mạng riêng. Chính vì thế những chuyên viên quản trị mạng, am hiểu phần cứng và thành thạo các dịch vụ do các hệ điều hành cung cấp để phân bổ tài nguyên và đảm bảo hệ thống hoạt động hiệu quả, bảo mật luôn được săn đón bằng nhiều chính sách ưu đãi, chế độ lương thưởng cũng tốt hơn hẳn. Đối với những công ty vừa và nhỏ thì chỉ cần kiến thức về hệ điều hành Microsoft Windows hoặc Windows Server là đủ. Tuy nhiên ở những hệ thống lớn hơn, cần nhiều dịch vụ hơn với tốc độ cung cấp tài nguyên và xử lý dữ liệu nhanh hơn đồng thời đảm bảo tính bảo mật cao hơn thì thành thạo, có kinh nghiệm về các hệ điều hành mã nguồn mở như Linux là một lợi thế lớn.', 48, 0, NULL, NULL, NULL, NULL, NULL),
(49, 'Bridge System Engineer', 'Trong mỗi dự án công nghệ thông tin, không thể thiếu các vị trí như lập trình viên, chuyên viên thiết kế giao diện, xử lý hình ảnh đồ họa, phân tích thiết kế cơ sở dữ liệu, v.v.. Tuy nhiên, còn một vị trí quan trọng đóng vai trò như là cầu nối liên kết các bộ phận này với nhau, làm cho tiến trình xử lý công việc thông suốt, thống nhất và hiệu quả. Đó chính là Bridge system engineer. Họ là những người có khả năng lập trình tốt vừa có khả năng đàm phán về giá cả các sản phẩm, lấy các yêu cầu về các thông số kỹ thuật từ khách hàng. Bridge system engineer có vai trò giám sát tiến trình thực hiện dự án của các bộ phận, xử lý những vấn đề phát sinh, v.v... Để trở thành những kỹ sư cầu nối chuyên nghiệp, bản thân họ phải là những chuyên viên có kinh nghiệm chuyên môn, đồng thời họ có khả năng giao tiếp thành thạo, lưu loát bằng ngôn ngữ của khách hàng. Thông thường là các loại ngôn ngữ phổ biến của các nhà đầu tư nhiều nhất như Nhật Bản, Pháp, tiếng Anh, v.v... Với những dự án đầu tưvào lĩnh vực công nghệ thông tin từ các doanh nghiệp nước ngoài vào Việt Nam nói chung và thành phố Hồ Chí Minh nói riêng đã tạo nên nhu cầu tuyển dụngvị trí kỹ sư cầu nối rất nhiều. Đây chính là cơ hội để các ứng viên có khả năng đáp ứng các yêu cầu của nhà tuyển dụng muốn thử thách bản thân có thể tham gia ứng tuyển để có cơ hội nhận được các đãi ngộ về lương thưởng và có cơ hội được tham gia những khóa đào tạo chuyên môn nâng cao ở nước ngoài. ', 49, 0, NULL, NULL, NULL, NULL, NULL),
(50, 'IT Support', 'Hiện nay, các doanh nghiệp muốn vận hành trơn tru, hiệu quả, không thể nào thiếu được các thiết bị máy vi tính, các hệ thống máy chủphục vụ cho việc lưu trữ và xử lý dữ liệu. Đáp ứng nhu cầu sao lưu, in ấn, tính toán và thống kê trong các nghiệp vụ kinh doanh của doanh nghiệp. Những tiện ích này góp phần giảm tải công sức tính toán theo các phương pháp thủ công mà lại tăng tính chính xác. Nhanh chóng, tiện lợi và hiệu suất cao là những yếu tố góp phần tăng cao sức cạnh tranh của doanh nghiệp trên thương trường. Để hệ thống thông tin hoạt động ổn định và nhanh chóng được khắc phục khi có sự cố xảy ra do các thao tác không mong muốn hoặc khi bị tấn công một cách cố ý, cần có những chuyên viên hỗ trợ mạng máy tính. Vai trò của họ là quản trị, giám sát hệ thống mạng, theo dõi lưu lượng dữ liệu trong mạng và phát hiện ra những bất thường diễn ra trong mạng. Từ đó, có những hướng khắc phục cụ thể nhằm đảm bảo cho hệ thống mạng máy tính vận hành bình thường. Vị trí này đòi hỏi người quản trị viên phải có kiến thức về hệ thống mạng tốt, có kinh nghiệm quản trị thực tế và niềm đam mê, tìm tòi để có thể tìm hiểu, cập nhật thêm các công nghệ mới ra đời. Những chuyên viên quản trị mạng máy tính thông thường sẽ mất từ 1 đến 2 năm để có thể hoàn thiện các kỹ năng và tích lũy kinh nghiệm của mình. Đó là thời điểm chín muồi của các quản trị viên nên không khó hiểu vì sao họ được các doanh nghiệp chào đón.', 50, 0, NULL, NULL, NULL, NULL, NULL),
(51, 'SAP', 'SAP là viết tắt của Service Advertising Protocol. Là giao thức được sử dụng để gửi thông tin ra toàn hệ thống mạng về các dịch vụ đang sẵn sàng cho sử dụng trong mạng đến những thiết bị được nối mạng. Một server gửi đi một gói tin SAP mỗi 60 giây để thông báo đến các thiết bị được nối mạng về các dịch vụ mà nó cần sử dụng. Các máy trạm sử dụng giao thức này để tìm kiếm các dịch vụ mình cần trong hệ thống mạng.  Đây là một giao thức hỗ trợ người sử dụng các máy client trong các mạng máy tính nhanh chóng được tìm được những dịch vụ mình cần sử dụng. Tránh phải lãng phí thời gian chờ đợi để được sử dụng dịch vụ và người dùng phải kiểm tra tính khả dụng bằng cách luôn để mắt theo dõi máy cung cấp dịch vụ. Với giao thức SAP, người dùng được hỗ trợ hoàn toàn tự động và chính xác cao. Góp phẩn nâng cao hiệu suất làm việc và giải phóng sức lao động của con người. Từ lâu hình ảnh những chuyên viên quản trị hệ thống mạng luôn gắng liền với những công việc tay chân và khá là sơ đẳng như thi công, lắp đặt hệ thống mạng, sửa chữa những lỗi máy tính thông thường hay gặp phải. Đó là những sai lầm trong nhận thức của đa số người dùng và cả những sinh viên mới bước chân vào các trường có chuyên ngành công nghệ thông tin. Tuy nhiên, trên thực tế đó chỉ là một khía cạnh nhỏ của công nghệ mạng. Nơi mà chuyên sâu hơn là những giải thuật bảo mật, những kỹ thuật giúp cho hệ thống hoạt động ổn định, có tính tiện lợi, thân thiện với người sử dụng. Và SAP chính là một trong số đó.', 51, 0, NULL, NULL, NULL, NULL, NULL),
(52, 'Xử lí sự cố', 'Có thể nói rằng, công nghệ thông tin mà cụ thể là mạng máy tính và internet đang chiếm lĩnh cuộc sống của chúng ta một cách sâu rộng. Từ nhu cầu giải trí hàng ngày như lướt website đọc tin tức, nghe nhạc online cho tới làm việc trên những hệ thống mạng cần có đường truyền internet, v.v... Chính những nhu cầu về các dịch vụ mạng nhiều như thế, nên cần rất sự quản trị của các quản trị viên để hệ thống hoạt động ổn định mỗi ngày.  Hiện nay, có nhiều công ty chuyên cung cấp các dịch vụ bảo mật và bảo trì, xử lý sự cố mạng máy tính cho các doanh nghiệp và các đối tượng người dùng là hộ gia đình và cá nhân. Giúp nhanh chóng xử lý các xự cố liên quan đến đường truyền mạng máy tính cũng như trên thiết bị phần cứng. Giảm thiểu thời gian bị gián đoạn, hạn chế các thiệt hại về kinh tế. Những dịch vụ này đã phổ biến vàcạnh tranh lẫn nhau, mang đến lợi ích cho người sử dụng được phục vụ tốt hơn với giá cả tốt hơn.  Tuy nhiên, đối với những doanh nghiệp muốn có quản trị viên hiểu cách vận hành của hệ thống và nhanh chóng được khắc phục xự cố khi có vấn đề phát sinh, thường sẽ có một đội ngũ quản trị hệ thống trực 24/24 giờ. Đảm bảo hệ thống hoạt động ổn định. Giúp doanh nghiệp tránh các tổn thấtvề kinh tế khi hệ thống máy tính và đường truyền mạng bị gián đoạn. Đây là cơ hội tuyệt vời cho các sinh viên ngành công nghệ thông tin chuyên ngành mạng. Khi số lượng doanh nghiệp đang mở rộng quy mô hoạt động của mình ngày càng nhiều. Nhu cầu tuyển dụng cao mang lại cơ hội việc làm sẽ nhiều hơn giúp các bạn nhanh chóng tìm được cơ hội nghề nghiệp phù hợp.', 52, 0, NULL, NULL, NULL, NULL, NULL),
(53, 'Hardware', 'Quản trị hệ thống máy tính trong một văn phòng và trong một doanh nghiệp lớn hoàn toàn khác nhau. Khi chỉ có số lượng nhân viên và các thiết bị máy móc ít thì việc quản trị hệ thống vận hành trôi chảy, có hiệu quả và nhanh chóng có thể được giao cho một chuyên viên quản trị mạng quản lý kiêm nhiệm. Tuy nhiên khi số lượng nhân viên tăng lên hàng chục thậm chí hàng trăm người thì guồng máy này cần được quan tâm nhiều hơn. Những quy trình để quản lý về máy móc thiết bị, khi thêm, bớt, thuyên chuyển hay sửa chữa cũng cần phải quy định rõ ràng. Tất nhiên, quản trị hệ thống không thể kiêm nhiệm hết mọi thứ.  Khi đó, cần có một chuyên viên đứng ra phụ trách quản lý những tác vụ này. Quản trị phần cứng máy tính bao gồm quản lý số lượng máy móc, thiết bị, tiến hành liên hệ với trung tâm bảo hành khi bị hỏng hóc cần sửa chữa. Khi có bất kỳ kế hoạch mua sắm thiết bị hoặc chuẩn bị cho các cuộc họp, những chuyên viên này sẽ là người chịu trách nhiệm xử lý.  Để làm được điều đó, họ cần có kiến thức về phần cứng thật tốt cũng như nắm bắt giá cả hiện hành của các loại máy móc mình quản lý. Cũng như định lượng, đánh giá đúng về nhu cầu thiết bị cần cung cấp cho các nhân viên có nhu cầu sử dụng. Đưa ra những bản đề xuất dự trù mua sắm trang thiết bị cho doanh nghiệp một cách sát với thực tế. Giúp cho ban quản trị có được những hoạch định mang tính kinh tế hơn, giảm lãng phí trong việc đầu tư vốn vào cơ sở vật chất mà thay vào đó sử dụng để kinh doanh xoay vòng đồng vốn có hiệu quả.', 53, 0, NULL, NULL, NULL, NULL, NULL),
(54, 'Tư vấn', 'Những nhân sự kỳ cựu có những vốn quý mà rất nhiều doanh nghiệp mong muốn tuyển dụng họ vào công ty của mình với chức danh cố vấn. Những vị trí này thường khá đa dạng về tuổi tác nhưng có một điểm chung đó là họ có mối quan hệ giao tiếp rộng rãi, các kỹ năng mềm vượt trội cùng với kiến thức và kinh nghiệm chuyên môn vững vàng. Dễ dàng đưa ra những lời khuyên đúng đắn giúp những thành viên khác làm việc nhanh chóng và đạt hiệu quả tốt hơn.  Trong xu thế hội nhập vào sân chơi lớn là kinh tế thế giới, các doanh nghiệp tại Việt Nam ra đời hàng loạt để đáp ứng với yêu cầu trao đổi buôn bán với các đối tác không chỉ trong nước mà cả nước ngoài. Thế nên nhu cầu về cố vấn của các doanh nghiệp hiện nay vô cùng lớn. Họ sẵn sàng có những chính sách ưu đãi, trao nhiều quyền lợi để thu hút những nhân sự chất lượng cao, trở thành cánh tay phải cho ban lãnh đạo doanh nghiệp trong việc định hướng và đưa ra những quyết định, chiến lược ngắn hạn cũng như dài hạn phù hợp với môi trường kinh doanh và đưa doanh nghiệp phát triển.  Nhờ chú trọng đầu tư vào đào tạo nhân tài bằng cách cử những cá nhân có thành tích xuất sắc sang những quốc gia có nền giáo dục tiên tiến trên thế giới. Hoặc những gia đình có khả năng kinh tế cho con cái đi du học để hưởng nền giáo dục cao hơn. Hiện nay đã có một lực lượng trẻ, đầy tài năng và không kém kinh nghiệm, óc sáng tạo phong phú trở về góp phần tạo diện mạo mới cho kinh tế nước ta.', 54, 0, NULL, NULL, NULL, NULL, NULL),
(55, 'CNTT', 'Thomas L. Freidman nhận định công nghệ và đặc biệt là công nghệ thông tin là nguyên nhân đã khiến thế giới nhanh chóng bước vào kỷ nguyên toàn cầu hóa hiện nay. Ngay từ khi xuất hiện, công nghệ thông tin đã thu hút sự quan tâm của đông đảo tầng lớp trí thức và cả những người yêu khoa học tham gia vào nghiên cứu, xây dựng và phát triển đến ngày nay. Và giờ đây, với những tiện ích to lớn mà công nghệ thông tin đem lại cho cuộc sống con người, điều mà trước đây chắc hẳn không ai hình dung ra, đã biến đổi thế giới hiện đại một cách sâu rộng. Đâu ai nghĩ rằng một ngày kia một người ở Pháp có thể đánh bài với một người ở Nga và một người khác ở Nhật?  Hoặc đâu ai từng nghĩ rằng với chỉ một cú click chuột có thể thổi bay hàng triệu đô la của khách hàng trong một tài khoản ngân hàng? Nhưng công nghệ thông tin đã biến những điều chưa ai từng nghĩ tới thành hiện thực.  Du nhập vào Việt Nam không lâu, nhưng lực lượng lao động trong ngành công nghệ thông tin rất đông đảo, đầy đủ các chuyên ngành như lập trình website và các ứng dụng, quản trị hệ thống, thiết kế đồ họa, thương mại điện tử, trí tuệ nhân tạo, v.v...đáp ứng nhu cầu tuyển dụng của các doanh nghiệp cũng như nhu cầu phát triển ngành công nghiệp dịch vụ ứng dụng tại Việt Nam để theo kịp với tốc độ phát triển của các nước trong khu vực Đông Nam Á nói riêng và thế giới nói chung.  Lao động trong ngành công nghệ thông tin cũng là một trong những ngành dễ kiếm việc làm và thu nhập thuộc hàng cao ở nước ta. Với những tiềm năng chất xám nổi tiếng của người Việt, ngành công nghệ thông tin hứa hẹn sẽ phát triển hơn nữa trong tương lai.', 55, 0, NULL, NULL, NULL, NULL, NULL),
(56, 'Tiếng Nhật', 'Chưa bao giờ tiếng nhật lại được quan tâm nhiều như hiện nay. Các trường đào tạo ngôn ngữ tiếng nhật trên địa bàn thành phố Hồ Chí Minh, Hà Nội và Đà Nẵng được mở ra rất nhiều với nhiều chương trình đào tạo đa dạng phù hợp với mọi trình độ học viên có nhu cầu theo học. Hơn thế, chính phủ nhật có chính sách hỗ trợ cho những người học tiếng nhật phổ cập. Đã thu hút lượng lớn học viên là sinh viên các trường đại học, công chức đã đi làm nhằm trao dồi vốn ngôn ngữ và tăng cơ hội tìm kiếm việc làm.  Thị trường lao động Việt Nam thu hút giới đầu tư nước ngoài, đặc biệt là Nhật Bản trong những năm gần đây. Đội ngũ lao động tại Việt Nam được đánh giá có trình độ ngang với các quốc gia trong khu vực tuy nhiên chi phí rất cạnh tranh. Các dự án được đầu tư từ Nhật Bản ngày càng nhiều. Nên nhu cầu nhân lực chất lượng cao trong các ngành như công nghệ thông tin, xây dựng, v.v... biết tiếng Nhật ở mức độ giao tiếp khá rất cao. Đây là cơ hội được làm việc trong môi trường theo tiêu chuẩn quốc tế, được đi trao đổi kinh nghiệm làm việc tại nhật hàng năm đồng thời có được mức thu nhập đáng mơ ước, cao hơn nhiều so với mặt bằng lương tại Việt Nam. Có thể phải mất rất nhiều thời gian để thông thạo ngôn ngữ khó như tiếng nhật. Tuy nhiên, chỉ cần phương pháp tiếp cận đúng hướng và chăm chỉ trong thời gian liên tục thì vốn tiếng nhật của bạn được cải thiện rất nhiều. Với những cơ hội việc làm tốt như vậy, đừng chần chừ mà hãy bắt tay làm quen với tiếng nhật ngay bây giờ.', 56, 0, NULL, NULL, NULL, NULL, NULL),
(57, 'Tiếng Anh', 'Tiếng anh đã len lỏi vào mọi ngóc ngách của thế giới nhanh đến mức, nếu giờ đây không có nó, thế giới sẽ bị đảo lộn. Các tài liệu chuyên ngành, các thông số kỹ thuật các ngành công nghệ thông tin, y học, hàng không, v.v... đều đang xử dụng tiếng anh diễn đạt. Nhiều quốc gia sử dụng tiếng anh như là ngôn ngữ thứ hai song song với ngôn ngữ mẹ đẻ của mình. Ước tính, tiếng anh chỉ đứng sau tiếng trung về số lượng người sử dụng.  Tại Việt Nam, tiếng anh được sử dụng như ngôn ngữ giao tiếp đứng hàng thứ hai sau tiếng việt. Chính sách giáo dục cũng đã xây dựng các đồ án nhằm đưa tiếng anh vào giảng dạy tại các trường. Nếu như trước kia chỉ bắt đầu từ cấp hai, cấp ba và khối sau trung học thì nay tiếng anh được lồng ghép đưa vào giảng dạy ngay từ bậc mẫu giáo và tiểu học. Tạo điều kiện cho học sinh tiếp xúc với tiếng anh ngay từ nhỏ tạo nên những phản xạ giao tiếp tốt hơn so với bắt đầu học ở lứa tuổi lớn hơn. Và thực tế chứng minh, hiệu quả của chương trình đào tạo này mang lại lớn hơn hẳn. Nếu chương trình trước kia, sau 7 năm học anh văn tại các trường trung học, học sinh chỉ mới lõm bõm vài câu giao tiếp thì nay các bé đã phát âm chuẩn hơn, thành thạo hơn.  Việt Nam đã gia nhập vào nhiều tổ chức thương mại quốc tế, cơ hội đón đầu những cơ hội hợp tác quốc tế tăng cao. Và thật là lãng phí nếu vuột mất cơ hội chỉ vì hạn chế ngôn ngữ giao tiếp. Điều kiện xã hội chú trọng đầu tư vào giáo dục nên chất lượng lao động trẻ của Việt Nam cũng vì thế mà tăng cao. Nâng cao sức cạnh tranh trên thị trường lao động quốc tế.', 57, 0, NULL, NULL, NULL, NULL, NULL),
(58, 'Tiếng Hàn', 'Cũng giống như những nhà đầu tư khác trên thế giới và trong khu vực Đông Nam Á, các nhà đầu tư đến từ Hàn Quốc cũng nhận ra thị trường lao động Việt Nam là một thị trường hấp dẫn khi trình độ lao động được nâng cao dần và được đánh giá gần bằng so với những nước trong khu vực. Hơn thế nữa, những chính sách thu hút đầu tư nước ngoài của nhà nước được chú trọng với nhiều biện pháp như cải cách thủ tục pháp lý, tạo hành lang thông thoáng cho các nhà đầu tư thuận lợi trong việc hoàn tất những thủ tục theo quy định của pháp luật. Môi trường luật pháp và xã hội ổn định khiến tâm lý của các nhà đầu tư yên tâm khi triển khai các dự án tại Việt Nam. Hiện nay, có rất nhiều tập đoàn lớn của Hàn Quốc đã đến và đầu tư nhiều dự án có giá trị tại Việt Nam. Có thể kể đến như tập đoàn SK telecom, Huyndai, Lotte và gần đây là tập đoàn LG electronic, Samsung đã tiến hành đầu tư xây dựng nhà máy có trị giá hàng triệu USD. Giúp giải quyết hàng ngàn công ăn việc làm cho người lao động tại các địa phương. Chính những làn sóng đầu tư này đã đem lại nhiều cơ hội cho người lao động đang có nhu cầu tìm việc làm phù hợp. Những sinh viên ngành tiếng Hàn hoặc những lao động có trình độ kỹ thuật đồng thời có trang bị vốn kiến thức ngôn ngữ Hàn thì đây là cơ hội tốt để tìm được những vị trí tốt, lương cao và có cơ hội làm việc trong môi trường hiện đại và có khả năng thăng tiến tốt. ', 58, 0, NULL, NULL, NULL, NULL, NULL),
(59, 'Tiếng Trung', 'Trung Quốc chiếm gần 19% dân số và đang vượt qua Mỹ, vươn lên trở thành cường quốc kinh tế số 1 thế giới Nên tiếng trung vốn là ngôn ngữ được sử dụng nhiều nhất thế giới nay lại có vị thế càng quan trọng. Trở thành số một thế giới, nhiều nước giao dịch với Trung Quốc cũng như bắt đầu chú ý đến thị trường này càng chú trọng đặc biệt đến việc đầu tư về mặt ngôn ngữ giao tiếp với họ. Việt Nam từ lâu luôn coi Trung Quốc là một thị trường tiêu thụ các mặt hàng từ nông sản, thủy sản tới khoáng sản cũng như những mặt hàng công nghiệp và tiểu thủ công nghiệp. Chính kim ngạch xuất nhập khẩu sang thị trường Trung Quốc lớn như vậy nên nhu cầu tuyển dụng nhân sự có thể giao tiếp thành thạo ngôn ngữ tiếng trung luôn luôn cao hơn những ngôn ngữ khác. Số lượng sinh viên đăng ký vào học vào các trường có khoa tiếng trung luôn luôn ở mức cao nhất trong khối các ngành xã hội. Với số lượng các doanh nghiệp Trung Quốc rót vốn vào đầu tư vào Việt Nam rất lớn, lượng nhân lực có khả năng thực sự luôn được rộng cửa chào đón. Hơn thế, hiện nay tại Việt Nam đã xuất hiện những công ty săn đầu người, là một kênh đưa người lao động đến gần với doanh nghiệp một cách hiệu quả. Là một người trẻ năng động, sở hữu vốn ngôn ngữ tiếng trung lưu loát bên cạnh ngoại ngữ thứ hai là anh văn giao tiếp thành thạo, các bạn hoàn toàn có cơ hội tìm thấy những công việc phù hợp với chuyên môn, thu nhập cao và hoàn toàn có khả năng thăng tiến trong tương lai khi tìm việc cùng Jobbank.', 59, 0, NULL, NULL, NULL, NULL, NULL),
(60, 'UI-UX', 'Trong thời buổi kinh tế thị trường, thị phần đang dần bảo hòa nên việc các nhà sản xuất cạnh tranh nhau để có thể tồn tại trong thế giới kinh doanh đầy khắc nghiệt. Ngoài những chiến dịch kinh doanh xuất sắc mang lại doanh thu cao, còn có những yếu tố mang tính quyết định đó là thiết kế sản phẩm, thiết kế bao bì và cả các nghiên cứu về trải nghiệm của người dùng. Tại sao không phải chức năng sản phẩm quan trọng mà lại là những yếu tố trên?  Quá hiển nhiên rằng khi con người ta trở nên xích lại gần nhau hơn. Sự giao tiếp, trao đổi thông tin giữacác quốc gia trở nên dễ dàng. Ngôn ngữ giao tiếp và công nghệ đã giúp mọi việc đơn giản và tiết kiệm nhiều thời gian và tiền bạc. Những triết lý kinh doanh mới xuất hiện trong vài thập niên gần đây đã thay đổi tư duy kinh doanh của các doanh nghiệp hiện đại khác rất nhiều so với trước đây. Đồng thời nguồn tài nguyên thiên nhiên cùng với nguồn lao động giá rẻ đã thuyết phục các doanh nghiệp phương Tây chuyển giao công nghệ sang các nước châu Á. Song song đó, ý thức nghiên cứu khoa học công nghệ tại các quốc gia này rất cao cộng với được đầu tư nghiên cứu nên sự chênh lệch về công nghệ được rút ngắn đi khá nhiều. Từ đó dẫn đến chất lượng sản phẩm khá đồng đều. Vấn đề chỉ còn là thiết kế sản phẩm và bao bì đẹp, tiện dụng để thu hút khách hàng. Không ai muốn bỏ tiền ra mua một sản phẩm lại gây phiền toái khi sử dụng hoặc mẫu mã quá đơn điệu, nhàm chán. Đó là lúc cần tới các chuyên viên thiết kế giao diện và trải nghiệm của người dùng thể hiện khả năng thuyết phục người tiêu dùng bằng các thiết kế hiệu quả của mình.', 60, 0, NULL, NULL, NULL, NULL, NULL),
(61, 'Graphic design', 'Thiết kế đồ họa là một lĩnh vực mới xuất hiện gần đây nhưng đã thay đổi quan điểm về thẩm mỹ sâu rộng khắp các ngành. Từ ngành sử dụng hiệu ứng hình ảnh nhiều như sân khấu điện ảnh cho tới quảng cáo, thiết kế website, từ công nghiệp cho tới nông nghiệp. Quá trình chuyển đổi từ những hình ảnh minh họa được vẽ thô sơ tượng hình, sử dụng màu sắc từ bút màu cho tới những màu nước dần được thay thế. Ngày nay, những công cụ đồ họa chuyên xử lý hình ảnh ra đời giúp cho những chuyên viên đồ họa thỏa sức sáng tạo nên những tác phẩm đa dạng về chủ đề và vẫn đậm tính nghệ thuật.  Ngành đồ họa tại các trường đại học và cả các trung tâm đào tạo nghề tại các thành phố lớn luôn thu hút nhiều học viên bởi tính ứng dụng đa dạng và không giới hạn về tuổi tác cũng như giới tính như những ngành đặc thù khác của ngành công nghệ thông tin, địa hạt mà đa phần là nam giới có rất ít cơ hội dành cho nữ giới.  Những phiên bản nâng cấp của các ứng dụng đồ họa của Adobe như photoshop, flash, illustrator v.v... liên tục được cập nhật đã giúp cho người dùng làm việc hiệu quả hơn. Những sản phẩm tạo ra cũng vì thế mà mượt mà hơn. Tại thành phố Hồ Chí Minh, nhu cầu nhân lực trong ngành thiết kế đồ họa luôn luôn cao nhất là đối với những chuyên viên có kinh nghiệm và khiếu thẩm mỹ tốt. Làm việc trong môi trường năng động, tự do sáng tạo với mức thu nhập luôn thuộc hàng cao nhất nhì trên thị trường lao động. ', 61, 0, NULL, NULL, NULL, NULL, NULL),
(62, 'Corel', 'Quảng cáo từ lâu đã là một ngành có doanh thu rất lớn do nhu cầu quảng bá hình ảnh thương hiệu của các doanh nghiệp trên thị trường. Bên cạnh những hình ảnh vẽ bằng tay, trên giấy và dựng trên các thước phim thì nay nhu cầu tuyển dụng nhân lực đồ họa chuyên nghiệp, lành nghề cho để đáp ứng nhu cầu lớn mạnh của ngành quảng cáo là rất lớn. Với những chuyên viên thiết kế có kinh nghiệm có cơ hội làm việc trong môi trường năng động, chuyên nghiệp và có mức thu nhập cao, ổn định. Thiết kế đồ họa với trọng tâm sử dụng corel để vẽ nên các đối tượng, hình ảnh một cách sáng tạo là một nghề thú vị và có nhiều cơ hội học hỏi những kỹ thuật, công cụ mới nhất. Tại thành phố Hồ Chí Minh, hoạt động quảng cáo nhộn nhịp và nhu cầu tuyển dụng chuyên viên đồ họa là rất lớn trong khắp các ngành nghề. Với khả năng sáng tạo và ứng dụng vào nhiều trường hợp cụ thể trong thực tế, thiết kế đồ họa bằng corel không bị gói gọn, bó buộc trong một phạm vi nào. Thay vào đó, được ứng dụng rộng khắp. Những tấm danh thiếp xinh xắn, những tờ rơi quảng cáo được thiết kế bắt mắt cho đến những tấm poster quảng cáo đầy tính nghệ thuật đã và đang được chăm chút tỉ mỉ để đưa đến tay khách hàng sẽ mang lại hiệu quả quảng cáo tốt nhất. Nếu như nhắc đến ngành công nghệ thông tin ở Việt Nam, đa phần mặc định là nghề dành cho nam giới. Và sự thật là cả hai mảng chính là lập trình và quản trị hệ thống, nhân sự đa phần là nam giới. Tuy nhiên, ngành thiết kế đồ họa lại là một lựa chọn tuyệt vời cho các chuyên viên thiết kế nữ. Tại đây, họ tha hồ được thể hiện khiếu thẩm mỹ, sự sáng tạo và cả sự uyển chuyển của mình vào những bản vẽ.', 62, 0, NULL, NULL, NULL, NULL, NULL),
(63, 'Illustrator', 'Illustrator là một công cụ đồ họa vectơ, được đưa vào sử dụng để thiết kế nên những bản vẽ là các logo, các icon, các biểu đồ, các hình ảnh hoạt họa, v.v.. bằng cách sử dụng các phương trình toán học. Sử dụng illustrator để vẽ sẽ hỗ trợ quá trình in ấn rất nhiều, nhất là quá trình tách màu sắc trong in lụa. Đồng thời, khi thay đổi kích thước hình ảnh, chất lượng của bản vẽ không thay đổi. Đây là ưu điểm ít có phần mềm đồ họa nào có được.   Với nhu cầu in ấn, thiết kế các sản phẩm là logo, card visit, brochure hay poster quảng cáo nhiều như hiện nay ở khắp các ngành nghề, với mọi đối tượng sử dụng là cá nhân hay doanh nghiệp, lực lượng chuyên viên thiết kế đồ họa bằng illustrator đang được các doanh nghiệp chiêu mộ với số lượng lớn. Đây là cơ hội việc làm tốt trong thời buổi kinh tế khó khăn như hiện nay, khi mà tình trạng thất nghiệp đang ở mức rất cao. Là một chuyên viên thiết kế đồ họa, thành thạo kỹ năng, đam mê, yêu nghề đầy năng lượng sáng tạo, không khó để bạn tìm cho mình một chỗ đứng xứng đáng. Jobbank đã liên kết với các nhà tuyển dụng cũng như các website cung cấp và giới thiệu việc làm trực tuyến, đã tập trung lượng lớn công việc phù hợp với các bạn với mức lương hấp dẫn trong môi trường làm việc hiện đại, đầy triển vọng thăng tiến. Đến với chúng tôi, các bạn đã rút ngắn được nhiều thời gian và tiết kiệm chi phí về tiền bạc là có ngay cơ hội tiếp cận được với nguồn tin tuyển dụng chất lượng và đáng tin cậy.', 63, 0, NULL, NULL, NULL, NULL, NULL),
(64, 'Autocad', 'Trong một thế giới hướng tới tiêu chuẩn hiện thực hóa mọi thứ từ rút ngắn khoảng cách vị trí địa lý hàng triệu km xuống còn cách nhau qua màn hình và khoảng cách chênh lệch thời gian giữa hai nơi được giảm xuống từ vài giây đến gần như tức thời. Thì những bản thiết kế cũng được yêu cầu với tiêu chuẩn cao hơn. Nhìn “thực” hơn và có thể xem xét dưới góc độ không gian 3 chiều. Các thiết kế 2D đang dần được thay thế bằng các bản vẽ 3D. Các chuyên gia xây dựng, các kỹ sư điện tử đều là những người am hiểu về cách sử dụng Autocad để phục vụ cho công việc của mình để dựng nên những bản thiết kế nhà cửa, các công trình, các cao ốc, v.v... Các nhà đầu tư muốn nhìn thấy bản phác thảo 3D về những dự án tiềm năng mình sắp đầu tư hơn là một mô hình trên giấy bất động, tính tương tác kém. Hơn thế, khi được nhìn trong không gian ba chiều, những lỗi kỹ thuật và mỹ thuật nhanh chóng được nhận ra và chỉnh sửa. Giúp hoàn thiện sản phẩm nhanh chóng hơn. Không dừng lại ở bất kỳ một ngành nghề hay cho bất kỳ sản phẩm nào, autocad đang xuất hiện ngày càng sâu rộng. Từ những thiết kế nhỏ như các logo cho các doanh nghiệp cho tới các sản phẩm thời trang. Chính vì sự phổ biến như vậy nên các chuyên viên thiết kế autocad luôn được đánh giá cao, dễ dàng tìm được cho mình một chỗ đứng tốt trong ngành công nghiệp thiết kế đồ họa. Chưa kể mức lương luôn thuộc hàng cao nhất nhì. Đó là một động lực rất lớn cho những ứng viên đang có ý định theo đuổi ngành này.', 64, 0, NULL, NULL, NULL, NULL, NULL),
(66, 'Designer', 'Nhân viên thiết kế đồ họa mỹ thuật là một trong những vị trí nhân sự nhận được nhiều sự quan tâm đặc biệt trong mỗi doanh nghiệp. Dù là doanh nghiệp đó hoạt động kinh doanh trong ngành nghề, lĩnh vực nào. Từ những ngành như phân bón, thuốc trừ sâu, các sản phẩm nông sản: lúa gạo, trái cây, v.v... cho tới những ngành mang tính thời thượng như quảng cáo, kinh doanh các sản phẩm công nghệ thông tin như phần cứng, phần mềm, v.v...luôn cần có những người makeup hình ảnh thương hiệu của mình để đến tay người sử dụng đẹp hơn, hoàn hảo hơn. Góp phần nâng cao hình ảnh thương hiệu tương xứng với chất lượng dịch vụ và sản phẩm doanh nghiệp cung cấp. Đồng thời mang lại thêm nhiều giá trị gia tăng trong trường hợp các chiến dịch quảng bá hình ảnh đánh đúng thị hiếu của người tiêu dùng. Tăng hiệu ứng quảng cáo và nâng tầm hình ảnh của doanh nghiệp.  Là một ứng viên tiềm năng trong lĩnh vực thiết kế, đừng ngại thử thách bản thân trong môi trường mới. Đây luôn là vị trí có tính năng động, điều kiện làm việc hoàn toàn thoải mái, tự do, giúp các bạn chủ động về thời gian, không gian làm việc để thỏa thích sáng tạo. Hơn thế nữa, đây là một trong những công việc được trả lương cao trong nhóm ngành công nghệ thông tin. Ít áp lực, đầy tính chủ động và nhiều cơ hội học hỏi, phát triển nghề nghiệp.  Tại thị trường lao động ở Thành phố Hồ Chí Minh, nhu cầu tuyển dụng nhân viên thiết kế rất nhiều. Rộng cửa cho các ứng viên mới tốt nghiệp chưa có nhiều kinh nghiệm hoặc mong muốn tìm các công việc part-time trang trải chi phí trong quá trình học tập của các bạn sinh viên, v.v..', 66, 0, NULL, NULL, NULL, NULL, NULL),
(67, 'Designer UI', 'Tầm quan trọng của thiết kế giao diện người dùng chưa bao giờ được chú trọng như hiện nay. Trên bất kỳ sản phẩm nào từ hàng gia dụng thiết yếu hàng ngày như dầu ăn, bánh, kẹo cho tới những sản phẩm điện tử, kim khí như điện thoại, v.v... đều được chú trọng đến tính mỹ thuật và tiện dụng của sản phẩm. Thậm chí vai trò của thiết kế giao diện được đánh giá là mang tính sống còn đối với hiệu quả kinh doanh. Vì thế mà các doanh nghiệp đầu tư ngân sách lớn cho bộ phận này chỉ sau bộ phận nghiên cứu và phát triển các sản phẩm.  Sự thành công của Apple với các sản phẩm mang tính đột phá, dẫn đầu thị trường các sản phẩm điện thoại smartphone và laptop đã tạo nên một cú hích cho những đối thủ bị tụt lại phía sau và tạo động lực cho cả thị trường. Đối với nội bộ ngành công nghệ thông tin thì giao diện người dùng đó là toàn bộ những gì mà một hệ điều hành, một chương trình ứng dụng, một website mang đến cho người sử dụng. Các tiến trình diễn biến như thế nào khi thực hiện một tương tác trên màn hình. Thời gian đáp ứng, tính hợp lý của của các luồng xử lý, v,v..  tất cả những điều đó cùng với các thiết kế đồ họa thích hợp với chủ đề của ứng dụng tạo nên sự thành công của sản phẩm. Hiện nay, các chuyên gia thiết kế giao diện người dùng được đánh giá rất cao. Nhận được nhiều ưu đãi về chế độ lương, thưởng và được ưu tiên sáng tạo không giới hạn. Đây là một trong những lĩnh vực mới mẻ và hấp dẫn dành cho các bạn trẻ thử sức.', 67, 0, NULL, NULL, NULL, NULL, NULL),
(68, 'Photoshop', 'Ngày nay, thuật ngữ photoshop quá quen thuộc và phổ biến trong nhận thức của tất cả mọi người. Còn nhớ những thập niên 80, 90 của thế kỷ trước, khi những kỹ thuật xử lý hình ảnh ban đầu còn thô sơ, thiếu mềm mại chủ yếu chỉ là cắt ghép hình ảnh. Nhờ công nghệ phần cứng và cả phần mềm phát triển đã hỗ trợ người thiết kế rất nhiều, nâng cao tính chuyên nghiệp trong xử lý đồ họa. Chuyển từ cắt ghép thô sơ sang tạo ra những hiệu ứng khó, làm cho hình ảnh của người mẫu, sản phẩm được lên tầm mới. Tăng tính thẩm mỹ và hiệu quả cho chiến dịch quảng bá hình ảnh của thương hiệu. Hiện nay, kỹ thuật xử lý bằng photoshop đã đến đỉnh cao, ngay cả những người trong nghề cũng khó nhận biết được. Với những chuyên viên xử lý hình ảnh bằng photoshop có kinh nghiệm, dễ dàng có được nguồn thu nhập cao, không cần tốn quá nhiều chi phí đầu tư cũng như là công sức như những việc làm khác. Tuy nhiên, đây cũng là một trong những nghề đề cao tính sáng tạo, đam mê nghề nghiệp và cạnh tranh. Những thiết kế mang tính nhàm chán, lặp đi lặp lại trong các sản phẩm sẽ nhanh chóng bị mất chỗ đứng. Như một quy luật, vòng quay sáng tạo ngày càng được rút ngắn lại.  Nhu cầu sử dụng các hình ảnh được thiết kế có tính nghệ thuật và ứng dụng cao trong các ngành quảng cáo, sân khấu nghệ thuật hoặc ngay cả trong nhu cầu của từng cá nhân tại nước ta nói chung và thành phố Hồ Chí Minh nói riêng rất cao. Do đó, thị trường việc làm cho các ứng viên rất rộng mở và đầy tiềm năng', 68, 0, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tags` (`id`, `name`, `description`, `list_order`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(69, 'Đồ hoạ', 'Trong xu thế đòi hỏi các sản phẩm được tung ra thị trường ngoài các tiêu chí: tiện lợi, chức năng sản phẩm mang lại cho người tiêu dùng trải nghiệm tuyệt vời còn phải đảm bảo tính thẩm mỹ độc đáo. Từ thực tế đã cho thấy các doanh nghiệp chậm trễ trong vấn đề thay đổi mẫu mã sản phẩm, các hình ảnh trong các chiến dịch quản cáo sử dụng thiếu sự sáng tạo và được trau chuốt đã phải trả giá đắt cũng ngang như thiếu sự quan tâm cải tiến chất lượng sản phẩm. Một số trường hợp, thậm chí phải tốn nhiều chi phí nghiên cứu sản phẩm để mang lại những chức năng tuyệt vời tuy nhiên lại thiếu sự đầu tư về mặt hình ảnh sản phẩm, đã mang lại nhiều cái chết của các thương hiệu nổi tiếng trong nước và trên thế giới. Cho thấy tầm quan trọng trong việc bỏ công sức ra xây dựng nên hình ảnh phù hợp dù cho đó là sản phẩm thuộc bất kỳ ngành nghề nào đi nữa cũng góp phần mang lại sự thành công trong kinh doanh. Điều đó đã phát sinh ra một ngành nghề đang rất hot hiện nay là thiết kế đồ họa. Những chuyên viên thiết kế đồ họa thông thường không phân biệt giới tính như những chuyên ngành khác của ngành công nghệ thông tin, nam và nữ đều có cơ hội như nhau. Thậm chí chính sự tỉ mỉ và óc thẩm mỹ tuyệt vời của phụ nữ là một ưu thế tuyệt vời. Những chuyên viên đồ họa có kinh nghiệm thông thường sẽ được tự do sáng tạo và không bị bó buộc trong không gian công sở thuần túy, có cơ hội tiếp cận với những xu hướng mới trên thế giới và mức lương hoàn toàn thỏa đáng cho chất xám đã cống hiến cho sự thành công của doanh nghiệp.', 69, 0, NULL, NULL, NULL, NULL, NULL),
(70, 'SEO', 'Trong vài năm trở lại đây, SEO là một trong những ngành thời thượng, thu hút rất nhiều sự chú ý đặc biệt của nhiều đối tượng từ doanh nghiệp có nhu cầu khiến sản phẩm của mình trở nên phổ biến hơn và có vị trí nằm trong top đầu trang kết quả tìm kiếm của google hay bing cho đến những người làm SEO chuyên nghiệp. SEO tại Việt Nam đặc biệt trở thành ngành nghề rất hot và mang lại lợi nhuận cao. Bởi lẽ SEO là sự kết hợp của thương mại điện tử và marketing online. Mang đến nhiều cơ hội quảng bá sản phẩm và xây dựng thương hiệu hiệu quả nếu biết cách sử dụng SEO và google adwords. \r\nSEO là một khái niệm khá mơ hồ mà người làm SEO cũng không chắc chắn mình nắm bắt được hoàn toàn 100% những kỹ thuật của nó khi mà họ phải chạy theo làm vui lòng một đối tượng khó tính và thích thay đổi là các thuật toán tìm kiếm và xếp hạng của google để đảm bảo website của mình có mặt trong trang đầu của kết quả tìm kiếm và trụ lại. Nếu có chiến lược SEO tốt và tiến hành thành công sẽ mang lại hiệu quả quảng bá và xây dựng thương hiệu tiết kiệm hơn những kênh quảng cáo truyền thống rất nhiều. Chi phí ít nhưng cơ hội đưa sản phẩm của mình ra thị trường không chỉ gói gọn trong phạm vi bất kỳ lãnh thổ nào mà còn có thể vươn ra thế giới. \r\nHiện nay, lực lượng SEO chuyên nghiệp không hề nhỏ nhưng nhu cầu từ thị trường các doanh nghiệp, các cửa hàng trực tuyến đang ngày càng nở rộ thì tiềm năng để gia tăng thu nhập vẫn là rất lớn. \r\n  \r\n', 70, 0, NULL, NULL, NULL, NULL, NULL),
(71, 'Sharepoint', 'Sharepoint là một cổng ứng dụng chạy trên nền web cho phép người sử dụng tương tác nội bộ trong nhóm với nhau bằng cách cung cấp các nền tảng cơ bản của microsoft như word, excel, v.v... giúp chia sẻ và lưu giữ thông tin. Sharepoint có nhiều thành phần cung cấp nhiều chức năng khác nhau, các dịch vụ do microsoft cung cấp đủ phong phú và ấn tượng đối với người sử dụng. Đó là lý do vì sao thời gian gần đây, sharepoint nổi lên như một hiện tượng.  Khi nhu cầu làm việc nhóm, kết nối các nhóm làm việc từ khắp mọi nơi không giới hạn phạm vi vị trí địa lý đã đặt ra vấn đề làm sao để có thể trao đổi thông tin nhanh chóng, an toàn và tốn ít chi phí. Với ưu thế sở hữu nhiều ứng dụng văn phòng và phần mềm hỗ trợ lập trình vượt trội, microsoft đã tích hợp chúng vào các gói dịch vụ mình cung cấp. Nhằm hỗ trợ tối đa trong quá trình làm việc của người dùng. Người dùng chỉ cần tạo ra một site của mình là đã có thể chia sẻ tất cả mọi thứ với những người trong nhóm. Đồng thời đứng trên phương diện quản lý, việc tập trung dữ liệu của các thành viên sẽ giúp dễ dàng kiểm tra và lưu trữ đồng bộ hơn. Việc người dùng có khả năng sở hữu một thiết bị di động như smartphone, tablet, v.v... không còn quá khó khăn như trước đây giúp cho việc truy cập website cũng dễ dàng hơn. Nắm bắt được xu thế này, microsoft đã xây dựng sharepoint trên nền web giúp người dùng có thể tham gia tuong tác mọi lúc mọi nơi.', 71, 0, NULL, NULL, NULL, NULL, NULL),
(72, 'Mobile Apps', 'Không còn quá khó khăn để chúng ta sở hữu một chiếc smartphone. Khi trên thị trường điện thoại di động chia nhiều phân khúc và trong thời gian gần đây, smartphone được các nhà sản xuất di động đặc biệt cạnh tranh nhau về giá cả. Việc các nhà sản xuất điện thoại di động lớn cạnh tranh với nhau để chiếm thị phần smartphone tầm trung và giá rẻ khiến cho giá cả thấp hơn trong khi chất lượng có thể chấp nhận được và vẫn đáp ứng được nhu cầu sử dụng của người dùng.  Ngay từ những dòng điện thoại N-series của Nokia được sản xuất đã manh nha xu hướng viết ứng dụng cho điện thoại di động. Đến khi những thế hệ smartphone đầu tiên được ra đời thì những ứng dụng viết bằng java cho điện thoại được chú trọng hơn. Nhu cầu tuyển dụng hàng loạt các nhà lập trình game, ứng dụng bùng nổ tạo nên một cú hích cho cả thị trường lao động trong ngành lập trình chất lượng cao và cả cho hiệu năng của những chiếc smartphone. Vì thế mà tốc độ xử lý và hiệu ứng đồ họa trên smartphone từ thô sơ trở nên mượt mà hơn. Đặc biệt, khi Apple giành ngôi vị nhà sản xuất điện thoại di động lớn nhất thế giới nhờ vào hiệu ứng đồ họa và các ứng dụng đi tiên phong. Tạo ra một làn gió mới cho cả thế giới công nghệ. Thúc đẩy lực lượng lập trình ứng dụng trở nên chuyên nghiệp và sáng tạo hơn nữa. Lập trình bằng ngôn ngữ java nói riêng, lập trình ứng dụng nói chung đang trở nên hot hơn bao giờ hết. Những doanh nghiệp có vốn đầu tư nước ngoài như Nhật Bản, Hàn Quốc, v.v... vẫn đang có nhu cầu tuyển dụng một lượng lớn các chuyên viên lập trình với thu nhập hấp dẫn', 72, 0, NULL, NULL, NULL, NULL, NULL),
(73, 'SEM', 'Search engine marketing – SEM là một cách thức marketing mới xuất hiện và thực hiện trên các công cụ tìm kiếm phổ biến như google, yahoo, bing, v.v... Đây là địa hạt quảng cáo đầy tiềm năng và thú vị bên cạnh những kênh quảng cáo truyền thống như truyền hình, báo chí, v.v...  Kể từ khi máy vi tính và internet xuất hiện, mọi hình ảnh, âm thanh trong thực tế được mã hóa đưa lên mạng thì hành vi sinh hoạt của con người cũng thay đổi. Thay vì mua những đĩa CD/ DVD nghe như trước, người dùng có thể mua chúng trên các trang được ủy quyền bán trên mạng. Con người có xu hướng tìm kiếm tất cả mọi thứ mình quan tâm thông qua các công cụ tìm kiếm được cung cấp miễn phí từ quần áo, mỹ phẩm cho tới các thiết bị công nghệ số hiện đại, hoặc những nơi cung cấp một dịch vụ nào đó phù hợp với nhu cầu thị hiếu của mình. Nắm bắt được điều này, các doanh nghiệp đã chủ động mang sản phẩm của mình xuất hiện trên mạng để quảng bá và góp phần nâng cao hiệu quả kinh doanh. SEM là công cụ thu hút khách hàng trực tiếp thông qua hai hoạt động chính đó là sử dụng dịch vụ thanh toán cho mỗi lần khách hàng click chuột của google để website có được những vị trí đặc biệt dễ nhìn thấy như trên cùng hoặc bên phải và chuẩn hóa website của doanh nghiệp theo các tiêu chí chuẩn SEO do google đặt ra để tăng thứ hạng của website trong bảng kết quả tìm kiếm. Cả hai cách làm này có vẻ khác nhau nhưng đều có mục đích chung là thu hút sự chú ý của khách hàng tiềm năng ghé thăm website của doanh nghiệp. Vận dụng uyển chuyển những kỹ thuật này, website sẽ càng có uy tín, góp phần thúc đẩy doanh thu của công ty tăng trưởng. ', 73, 0, NULL, NULL, NULL, NULL, NULL),
(74, 'Communicator', 'Trước cơ hội việc làm tại các doanh nghiệp có vốn đầu tư nước ngoài với nhiều chế độ đãi ngộ tốt về lương thưởng, nhiều kỹ sư lập trình có mức thu nhập hàng nghìn USD mỗi tháng là hoàn toàn bình thường. Tuy nhiên, không phải ai cũng đáp ứng được yêu cầu về khả năng ngoại ngữ. Đây là một hạn chế lớn. Giải pháp được đưa ra để đảm bảo doanh nghiệp tuyển dụng được nhân lực có chuyên môn cao, đáp ứng với công việc và khắc phục nhược điểm về ngôn ngữ của lập trình viên, các phiên dịch viên, thông dịch viên có vai trò như cầu nối giúp cả hai hiểu nhau hơn và công việc diễn ra trôi chảy hơn.  Một khó khăn của một phiên dịch viên là học hỏi và nắm bắt các thuật ngữ chuyên ngành. Đó là cả một quá trình đòi hỏi tính kiên nhẫn cũng như là đam mê với nghề. Nhưng khi đã đáp ứng các yêu cầu kỹ năng trong công việc, đây sẽ là những cơ hội tốt để phát triển kỹ năng nghề nghiệp và mở rộng sang những lĩnh vực mới. Hiện nay, các khoa ngôn ngữ được chú trọng đầu tư cả về số lượng ngôn ngữ lẫn chất lượng đào tạo. Trong số nhiều ngôn ngữ được giảng dạy tại các trường đại học, các trung tâm ngoại ngữ, được theo học nhiều nhất là tiếng Hàn, tiếng Nhật, tiếng Trung, tiếng Pháp, v.v... bên cạnh ngoại ngữ thứ hai là tiếng anh. Đã đáp ứng được nhu cầu về nhân lực thông dịch viên cho các công ty nước ngoài hoặc các tập đoàn kinh tế lớn, đang làm ăn với các đối tác nước ngoài. Cả nguồn cung và cầu phong phú và đảm bảo về chất lượng, đã góp phần tạo nên lực lượng lao động chất lượng cao, năng động.', 74, 0, NULL, NULL, NULL, NULL, NULL),
(75, 'Online Marketing', 'Thời buổi công nghệ hiện đại đang dần dần len lỏi vào cuộc sống của chúng ta và đang rút ngắn dần khoảng cách địa lý thực trở thành cách nhau qua màn hình máy tính. Nếu trước đây khi cần tìm kiếm hay mua sắm một món hàng hóa thì phải ra tới tận cửa hàng, chợ hoặc các trung tâm thương mại lớn. Thế nhưng ngày nay, internet đã thay đổi cách tư duy của chúng ta. Chỉ cần tại ngồi nhà, sử dụng các công cụ tìm kiếm miễn phí như google hay bing để tìm hiểu về món hàng mà chúng ta muốn mua, thì có thể sở hữu được ngay khi sử dụng dịch vụ giao hàng tận nơi và thanh toán qua tài khoản online. Giúp tiết kiệm thời gian và công sức so với trước kia.  Chính những tiện lợi như thế đã thu hút rất nhiều khách hàng mua sắm trực tuyến. Và các cửa hàng buôn bán trực tuyến đủ loại sản phẩm ra đời như nấm mọc sau mưa. Để đưa hàng hóa tới tay khách hàng tiềm năng, giữa các doanh nghiệp, các cửa hàng bùng lên một cuộc chiến marketing hình ảnh sản phẩm và doanh nghiệp không chỉ ở phạm vi hiện thực trên những trang thông tin báo đài, tivi như trước mà lan sang các trang báo mạng, các website doanh nghiệp sở hữu, v.v... Người chiếm được sự chú ý của cộng động cư dân mạng, sẽ tạo nên hiệu ứng dây chuyền khiến cho sản phẩm của doanh nghiệp được biết đến trên phạm vi rộng rãi, không giới hạn với chi phí thấp hơn rất nhiều. Có nhiều cách để thực hiện marketing online như sử dụng các kỹ thuật của SEO, PR trên các trang báo mạng, v.v... nhưng nhất thiết các chiến dịch thực hiện phải độc đáo và sáng tạo.', 75, 0, NULL, NULL, NULL, NULL, NULL),
(76, 'Media', 'Internet đã phủ sóng khắp nơi. Dễ dàng truy cập vào mạng internet để tìm kiếm bất kỳ từ khóa ở bất kỳ phạm vi lãnh thổ hay ngôn ngữ nào. Hơn thế, những thông tin về dữ liệu đã được mã hóa hầu như toàn bộ từ ký tự cho tới âm thanh, hình ảnh. Do đó, những bài viết chỉ có thông tin, vài hình ảnh minh họa đơn điệu viết trên nền website được viết theo thế hệ đầu tiên hoặc thứ hai sẽ khiến cho người xem nhàm chán và quay đi, ít khi trở lại.  Những website hiện tại được thiết kế và lập trình dựa trên một quy trình phân tích, đánh giá các thói quen và tâm lý của người sử dụng. Qua rồi thời kỳ, người thiết kế website viết bất kỳ phong cách, nội dung gì mà mình muốn. Nay họ phải nghiên cứu những tác động tâm lý mà dịch vụ của mình cung cấp, đồng thời tăng thêm hiệu ứng thích thú trong quá trình sử dụng. Làm được điều đó nhờ vào việc sử dụng linh hoạt những hình ảnh, những video clip mà gọi chung là multi media. Giúp cho bố cục website và từng bài viết sinh động, hấp dẫn hơn. Chưa kể, phải đầu tư thêm vào chất lượng nội dung bài viết. Bài viết hay thông thường mang tính sáng tạo, gợi mở những suy nghĩ của người dùng tham gia vào tranh luận hoặc muốn chia sẻ với bạn bè. Hiện nay những trang mạng xã hội lớn như facebook, instagram, twitter, v.v.. là một kênh quan trọng để những website mới xuất hiện kiếm được sự quan tâm, thu hút của mọi người. Thế nên vai trò của media trong cuộc chiến truyền thông mạng rất quan trọng.', 76, 0, NULL, NULL, NULL, NULL, NULL),
(77, 'Khác', 'Công nghệ thông tin những năm qua luôn nằm trong danh sách những công việc có nhu cầu tuyển dụng cao và có mức thu nhập cao. Chính vì thế mà ngành luôn thu hút lượng lớn học sinh đăng ký thi tuyển vào theo học tại các trường trên cả nước. Mặc dù điểm số để tuyển sinh đầu vào tại các trường ngành công nghệ thông tin luôn thuộc hàng dẫn đầu. Với đầu vào chất lượng, không khó hiểu khi sinh viên ra trường có tư duy tốt và nhanh nhạy. Ngay từ khi ngồi trên ghế nhà trường, nhiều sinh viên đã tham gia những đề tài nghiên cứu của các giảng viên, rèn luyện kỹ năng chuyên môn ngay sau khi học. Nhờ đó tích lũy kinh nghiệm thực tế trong suốt quá trình học, tạo lợi thế khi ra trường đáp ứng được đòi hỏi về kinh nghiệm của nhà tuyển dụng.  Là quốc gia có nền giáo dục bắt kịp với các nước trong khu vực Đông Nam Á nhưng chi phí lao động lại rất cạnh tranh, Việt Nam đang trở thành thị trường đầu tư đầy hứa hẹn với các doanh nghiệp muốn rời bỏ thị trường Trung Quốc. Thêm vào đó hệ thống hành chính ngày càng được tinh giảm những thủ tục rườm rà nhằm thu hút các doanh nghiệp nước ngoài đến và đầu tư. Luôn được đánh giá là một trong những quốc gia có chính sách ổn định, Việt Nam dần vượt qua Thái Lan, Phillipine về lượng vốn nước ngoài. Trong số những nhóm ngành được đầu tư, công nghệ thông tin được quan tâm nhiều nhất. Trong đó, mảng lập trình chuyển từ gia công sang viết những chương trình, ứng dụng được xây dựng độc lập. Từ đó, nâng cao hơn nữa giá trị kinh tế. Góp phần nâng cao giá trị của người lập trình viên nói riêng và mặt bằng thu nhập của ngành công nghệ thông tin nói riêng.', 77, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(2) NOT NULL,
  `delete_flg` tinyint(2) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `remember_token`, `password`, `role`, `delete_flg`, `deleted_at`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'vpduy845', 'vpduy84@gmail.com', 'hTBvj4zO4TW92CP56XenNqMvoXLjUVPFxmXm7CoDJrEJEJS8GOs8ohYSCNzl', '$2y$10$0hasHN3qQ7fvQCacg7GtaOY.3mkwMe/XwVmzvAmQZvHN1dWuRXy5y', 3, 0, '0000-00-00 00:00:00', 0, 0, '2018-03-06 06:34:08', '2018-03-13 14:42:50'),
(14, 'employer_1', 'employer01@gmail.com', 'baHmEnKloLpeXLccOykVZLrHHSspTSDrfmkKe2Hjs2Gm0J8A3gV2exeJ3CAx', '$2y$10$7rSfkBS9.xfEuEQBCtv.1eIfRXguHeGdOcx3KGVXOU4y2S4skH7kO', 2, 0, NULL, NULL, NULL, '2018-05-09 08:05:58', '2018-05-09 08:05:58'),
(15, 'scouter01', 'scouter01@gmail.com', 'VJDEDz9ymZtzczB8CTIVEwAiwVigJzV8w1PMPAa6JqwaYJZiVdsdsrCzzw8N', '$2y$10$opIRd1izz8jexcXeHdJXY.aiChloInRxL45kaW9uZ7p5LBfmxyYF2', 1, 0, NULL, NULL, NULL, '2018-05-09 08:05:43', '2018-05-09 08:05:43'),
(16, 'scouter02', 'scouter02@gmail.com', 'orXt4l8nRt4OOHymDkOdGZi9vJvjWyLY3JrFuWUDajboWCEEHDBzaDKXWLsk', '$2y$10$a6Rfr706A7/W.cckPpJRz.Nx/N6C9G5kwGTZrKcgxMlNnqW2oagVm', 1, 0, NULL, NULL, NULL, '2018-05-09 09:05:21', '2018-05-09 09:05:21'),
(17, 'scouter03', 'scouter03@gmail.com', 'CnC8zNWDlshOpF9XABpP6WA2CAIBzK2h9bDdSp1VmQN098hlHwKS2UkWZzvy', '$2y$10$RnAbenqQ26HMl4ay7l0b6OnCf1mpys4ox3XxGRS3tqc9QwVs1AwNu', 1, 0, NULL, NULL, NULL, '2018-05-09 09:05:40', '2018-05-09 09:05:40'),
(18, 'employer_2', 'employer02@gmail.com', '2R3Z6izb55eFowzwMfrizo9mJe9P9pi3YjyIMjh1zR8Sn14XxS9xw4T1GQGs', '$2y$10$lmMgrmj0ifA2mUf9qt.FHeTFGGU6YI/UHjVUiVpcYhTmQ.ADCC/SS', 2, 0, NULL, NULL, NULL, '2018-05-09 09:05:10', '2018-05-09 09:05:10'),
(19, 'scouter04', 'scouter04@gmail.com', NULL, '$2y$10$RHd9RQVGG63.3btqcCY7fOploPmoAPazl23j60JhwgbIm1TEfCyem', 1, 0, NULL, NULL, NULL, '2018-05-09 09:05:41', '2018-05-09 09:05:41'),
(20, 'hoalongtiensinh', 'admincpp@gmail.com', '8wzArk8KTJjL1J7hybDkQjZGIGjb68gSr3AxRtl0n5e6SnPKQ0w2SaEkrSIW', '$2y$10$G77dBGtuAXjrQfZ3Q9Fg8ezYiahO8rG./uOFeZqZsEeiqk4mPgg/e', 1, 0, NULL, NULL, NULL, '2018-05-09 14:05:10', '2018-05-09 14:05:10'),
(21, 'Hoàng Kim', 'employer03@gmail.com', 'vh6NI2P5yGwfuWAk4nUZrTlZgAjWqCwDEJzNJufJicpepuOyKLfFF3ukORoM', '$2y$10$Ipn/lBFTD1V.sAToD1yUge/ILmlvAVPs./HWRIkBIlnS8gPAhWdbC', 2, 0, NULL, NULL, NULL, '2018-05-09 16:05:37', '2018-05-09 16:05:37');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `applies`
--
ALTER TABLE `applies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applies_candidate_id_foreign` (`candidate_id`),
  ADD KEY `applies_job_id_foreign` (`job_id`),
  ADD KEY `applies_scouter_id_foreign` (`scouter_id`),
  ADD KEY `applies_jobstatus_id_foreign` (`jobstatus_id`);

--
-- Chỉ mục cho bảng `bonus_histories`
--
ALTER TABLE `bonus_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bonus_histories_apply_id_foreign` (`apply_id`),
  ADD KEY `bonus_histories_scouter_id_foreign` (`scouter_id`);

--
-- Chỉ mục cho bảng `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidates_address_city_id_foreign` (`address_city_id`);

--
-- Chỉ mục cho bảng `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companies_member_id_foreign` (`member_id`),
  ADD KEY `companies_country_id_foreign` (`country_id`),
  ADD KEY `companies_address_city_id_foreign` (`address_city_id`);

--
-- Chỉ mục cho bảng `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_member_id_foreign` (`member_id`),
  ADD KEY `favorites_job_id_foreign` (`job_id`);

--
-- Chỉ mục cho bảng `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends_address_city_id_foreign` (`address_city_id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_company_id_foreign` (`company_id`),
  ADD KEY `jobs_job_type_id_foreign` (`job_type_id`),
  ADD KEY `jobs_address_city_id_foreign` (`address_city_id`);

--
-- Chỉ mục cho bảng `jobstatus`
--
ALTER TABLE `jobstatus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `jobtypes`
--
ALTER TABLE `jobtypes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Chỉ mục cho bảng `scouters`
--
ALTER TABLE `scouters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scouters_member_id_foreign` (`member_id`),
  ADD KEY `scouters_address_city_id_foreign` (`address_city_id`);

--
-- Chỉ mục cho bảng `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `applies`
--
ALTER TABLE `applies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `bonus_histories`
--
ALTER TABLE `bonus_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT cho bảng `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `jobstatus`
--
ALTER TABLE `jobstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `jobtypes`
--
ALTER TABLE `jobtypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `scouters`
--
ALTER TABLE `scouters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `applies`
--
ALTER TABLE `applies`
  ADD CONSTRAINT `applies_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`),
  ADD CONSTRAINT `applies_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `applies_jobstatus_id_foreign` FOREIGN KEY (`jobstatus_id`) REFERENCES `jobstatus` (`id`),
  ADD CONSTRAINT `applies_scouter_id_foreign` FOREIGN KEY (`scouter_id`) REFERENCES `scouters` (`id`);

--
-- Các ràng buộc cho bảng `bonus_histories`
--
ALTER TABLE `bonus_histories`
  ADD CONSTRAINT `bonus_histories_apply_id_foreign` FOREIGN KEY (`apply_id`) REFERENCES `applies` (`id`),
  ADD CONSTRAINT `bonus_histories_scouter_id_foreign` FOREIGN KEY (`scouter_id`) REFERENCES `scouters` (`id`);

--
-- Các ràng buộc cho bảng `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_address_city_id_foreign` FOREIGN KEY (`address_city_id`) REFERENCES `cities` (`id`);

--
-- Các ràng buộc cho bảng `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_address_city_id_foreign` FOREIGN KEY (`address_city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `companies_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `companies_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `favorites_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_address_city_id_foreign` FOREIGN KEY (`address_city_id`) REFERENCES `cities` (`id`);

--
-- Các ràng buộc cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_address_city_id_foreign` FOREIGN KEY (`address_city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `jobs_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `jobs_job_type_id_foreign` FOREIGN KEY (`job_type_id`) REFERENCES `jobtypes` (`id`);

--
-- Các ràng buộc cho bảng `scouters`
--
ALTER TABLE `scouters`
  ADD CONSTRAINT `scouters_address_city_id_foreign` FOREIGN KEY (`address_city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `scouters_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

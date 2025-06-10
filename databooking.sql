-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 20, 2024 lúc 11:01 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `databooking`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`admin_id`, `email`, `password`, `name`) VALUES
(1, 'tranthingoctrammt@gmail.com', '1508', 'Trần Thị Ngọc Trầm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `confirm`
--

CREATE TABLE `confirm` (
  `confirm_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `phone_number` int(50) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `gender` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `confirm`
--

INSERT INTO `confirm` (`confirm_id`, `customer_id`, `phone_number`, `check_in_date`, `check_out_date`, `gender`) VALUES
(1, 1, 909123456, '2024-11-20', '2024-11-25', 'nam'),
(2, 2, 912345678, '2024-12-01', '2024-12-05', 'nữ'),
(3, 3, 921345679, '2024-11-15', '2024-11-18', 'nam'),
(4, 4, 931234567, '2024-11-30', '2024-12-03', 'nữ'),
(5, 5, 942345678, '2024-12-10', '2024-12-15', 'nam'),
(6, 1, 1112, '2024-11-21', '2024-11-24', 'Nam'),
(7, 4, 356814815, '2024-11-27', '2024-11-29', 'Nu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `email`, `password`) VALUES
(1, 'Nguyen Van A', 'nguyenvana@gmail.com', '123'),
(2, 'Tran Thi B', 'tranthib@gmail.com', '456'),
(3, 'Le Van C', 'levanc@example.com', '111'),
(4, 'Pham Thi D', 'phamthid@gmail.com', 'aa'),
(5, 'Hoang Van E', 'hoangvane@gmail.com', '222'),
(3343, 'Trần Thị Ngọc Trầm', 'tranthingoctrammt@gmail.com', '1508'),
(3344, 'Demo', 'tram1@gmail.com', 'aaa'),
(3345, 'Đoàn Công N', 'nguyen29@gmail.com', '456'),
(3346, 'Anh Long', 'Long12@gmail.com', '123456'),
(3347, 'Bing Chi Linh', 'Bang61@gmail.com', '789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `homes`
--

CREATE TABLE `homes` (
  `home_id` int(11) NOT NULL,
  `homestay_id` int(11) NOT NULL,
  `home_type` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `capacity` int(50) NOT NULL,
  `home_image` varchar(100) NOT NULL,
  `home_status` varchar(100) NOT NULL,
  `home_description` varchar(1000) NOT NULL,
  `home_admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `homes`
--

INSERT INTO `homes` (`home_id`, `homestay_id`, `home_type`, `price`, `capacity`, `home_image`, `home_status`, `home_description`, `home_admin_id`) VALUES
(1, 1, 'Home tiêu chuẩn', 500000, 5, 'uploads/mau-nha-homestay-dep-moc-home-sapa.jpg', 'unavailable', 'Home thân thiện với thú cưng với công viên chó, dịch vụ trông thú cưng và chỗ ở thoải mái cho cả con người và thú cưng của họ.', 25),
(2, 1, 'Home cao cấp', 700000, 3, 'uploads/12.jpg', 'available', 'Home thân thiện với thú cưng với công viên chó, dịch vụ trông thú cưng và chỗ ở thoải mái cho cả con người và thú cưng của họ.', 26),
(4, 3, 'Home tiêu chuẩn', 600000, 2, 'uploads/7.jpg', 'available', 'Một điểm đến đặc biệt với tranh tường vẽ tay và đồ nội thất được thiết kế riêng.', 28),
(5, 4, 'Home cao cấp', 900000, 3, 'uploads/5.jpg', 'available', 'Home mộc mạc với dầm gỗ trần, tường đá và đồ nội thất cổ, tạo ra một không gian ấm áp và thân thiện.', 29),
(6, 5, 'Home siêu vip', 550000, 4, 'uploads/7.jpg', 'available', 'Home sang trọng với hồ bơi riêng, spa và sân thượng trên tầng thượng với tầm nhìn toàn cảnh thành phố.', 30),
(7, 6, 'Home siêu vip', 800000, 2, 'uploads/6.jpg', 'available', 'Home lãng mạn với ban công riêng nhìn ra khu vườn, lò sưởi và giường cỡ king size.', 31),
(8, 7, 'Home tiêu chuẩn', 450000, 5, 'uploads/2.jpg', 'available', 'Home thân thiện với gia đình với sân chơi, phòng trò chơi và sân sau rộng rãi cho trẻ em vui chơi.', 32),
(9, 8, 'Home siêu vip', 1500000, 4, 'uploads/4.jpg', 'available', 'Home thân thiện với thú cưng với công viên chó, dịch vụ trông thú cưng và chỗ ở thoải mái cho cả con người và thú cưng của họ.', 33),
(10, 9, 'Home cao cấp', 950000, 3, 'uploads/6.jpg', 'available', 'Homestay giá cả phải chăng với mức giá hợp lý, tiện nghi cơ bản và vị trí thuận tiện.', 34),
(11, 10, 'Home tiêu chuẩn', 650000, 2, 'uploads/4.jpg', 'available', 'Homestay giá cả phải chăng với mức giá hợp lý, tiện nghi cơ bản và vị trí thuận tiện.', 35),
(12, 11, 'Home tiêu chuẩn', 750000, 4, 'uploads/4563homestay-ba-vi-14.jpg', 'available', 'Home giá cả phải chăng với mức giá hợp lý, tiện nghi cơ bản và vị trí thuận tiện.', 36),
(13, 12, 'Home cao cấp', 1000000, 3, 'uploads/2.jpg', 'available', 'Home giá cả phải chăng với mức giá hợp lý, tiện nghi cơ bản và vị trí thuận tiện.', 37),
(14, 13, 'Home tiêu chuẩn', 850000, 4, 'uploads/7.jpg', 'available', 'Home giá cả phải chăng với mức giá hợp lý, tiện nghi cơ bản và vị trí thuận tiện.', 38),
(15, 14, 'Home tiêu chuẩn', 3000000, 5, 'uploads/mau-nha-san-homestay-dep-mai-chau-countryside.jpg', 'available', 'Home giá cả phải chăng với mức giá hợp lý, tiện nghi cơ bản và vị trí thuận tiện.', 39),
(2967, 1, 'Home siêu vip', 3000000, 5, 'uploads/7.jpg', 'available', 'Home giá cả phải chăng với mức giá hợp lý, tiện nghi cơ bản và vị trí thuận tiện.', 68),
(2974, 1, 'Home cao cấp', 7000000, 5, 'uploads/1.jpg', 'available', 'Không gian hiện đại với view thành phố tuyệt đẹp, mang đến cảm giác như ở nhà.', 75),
(2975, 3, 'Home tiêu chuẩn', 1500000, 3, 'uploads/2.jpg', 'available', 'Chốn yên bình giữa nhịp sống hối hả, tọa lạc ngay trung tâm thành phố.', 76),
(2976, 4, 'Home siêu vip', 10000000, 7, 'uploads/3.jpg', 'unavailable', 'Trải nghiệm cuộc sống đô thị với một chút nét quyến rũ tại homestay này.', 77),
(2977, 5, 'Home cao cấp', 5000000, 6, 'uploads/4.jpg', 'available', 'Homestay xinh xắn, gần các địa danh nổi tiếng và hàng quán địa phương.', 78),
(2978, 6, 'Home cao cấp', 4000000, 3, 'uploads/5.jpg', 'available', 'Thức dậy với tiếng sóng vỗ bên bờ biển tại homestay yên tĩnh này.', 79),
(2979, 7, 'Home siêu vip', 5000000, 2, 'uploads/6.jpg', 'available', 'Một điểm đến đặc biệt với tranh tường vẽ tay và đồ nội thất được thiết kế riêng.', 80),
(2980, 8, 'Home cao cấp', 8000008, 6, 'uploads/1.jpg', 'available', 'Trải nghiệm cuộc sống thôn quê tại homestay mang đậm chất truyền thống.', 81),
(2981, 9, 'Home cao cấp', 3000000, 2, 'uploads/9.jpg', 'available', 'Nơi nghỉ dưỡng độc đáo với không gian nghệ thuật và nội thất đầy màu sắc.', 82),
(2982, 10, 'Home tiêu chuẩn', 5000000, 6, 'uploads/8.jpg', 'available', 'Chốn nghỉ dưỡng mộc mạc giữa thiên nhiên xanh tươi và không khí mát mẻ', 83),
(2983, 11, 'Home cao cấp', 5000000, 2, 'uploads/7.jpg', 'available', 'Nơi ẩn náu xinh đẹp trên sườn đồi với những tiện nghi hiện đại và cảnh quan tuyệt vời.', 84),
(2984, 12, 'Home tiêu chuẩn', 2000000, 3, 'uploads/6.jpg', 'available', 'Thư giãn và tái tạo năng lượng tại homestay yên tĩnh, gần gũi với thiên nhiên.', 85),
(2985, 13, 'Home cao cấp', 12000000, 9, 'uploads/5.jpg', 'available', 'Nơi nghỉ dưỡng độc đáo với không gian nghệ thuật và nội thất đầy màu sắc.', 86),
(2986, 14, 'Home siêu vip', 8000000, 4, 'uploads/1.jpg', 'available', 'Trải nghiệm đỉnh cao với homestay thiết kế đẹp mắt và vị trí tuyệt vời.', 87),
(2987, 15, 'Home siêu vip', 600000, 3, 'uploads/10.jpg', 'available', 'Thiên đường dành cho người yêu nghệ thuật, với tác phẩm địa phương và không gian yên bình.', 88),
(2988, 13, 'Home tiêu chuẩn', 3000000, 5, 'uploads/11.jpg', 'available', 'Homestay nghệ thuật tràn đầy sức sống với không gian ấm cúng và decor lạ mắt.', 89),
(2989, 16, 'Home cao cấp', 10000000, 7, 'uploads/14ed67231636ba0216b3d7f0f8a3c738.jpg', 'available', 'Homestay nằm ngay trung tâm nhưng yên tĩnh, phù hợp cho kỳ nghỉ cuối tuần.', 90),
(2990, 17, 'Home cao cấp', 5000000, 3, 'uploads/homestay-ha-giang.jpg', 'available', 'Homestay hiện đại, nằm gần các điểm du lịch nổi bật trong thành phố.', 91),
(2991, 4, 'Home siêu vip', 15000000, 5, 'uploads/12.jpg', 'available', 'Không gian ấm áp với nội thất mang đậm chất vintage, lý tưởng để thư giãn.', 92),
(2992, 16, 'Home siêu vip', 800000, 2, 'uploads/13.jpg', 'available', 'Homestay thân thiện, gần các nhà hàng hải sản nổi tiếng và bến tàu du lịch.', 93),
(2993, 6, 'Home tiêu chuẩn', 5000000, 7, 'uploads/4.jpg', 'available', 'Homestay ven hồ với không gian yên tĩnh và không khí trong lành.', 94),
(2994, 15, 'Home cao cấp', 5000000, 7, 'uploads/3.jpg', 'available', 'Homestay mang phong cách mộc mạc, lý tưởng cho người yêu thiên nhiên.', 95),
(2995, 7, 'Home siêu vip', 12000000, 5, 'uploads/homestay-da-lat-gia-re-1.jpg', 'available', 'Nơi nghỉ ngơi lý tưởng với view sông thơ mộng và dịch vụ chu đáo.', 96);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `homestay`
--

CREATE TABLE `homestay` (
  `homestay_id` int(11) NOT NULL,
  `location_id` int(10) NOT NULL,
  `homestay_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `homestay`
--

INSERT INTO `homestay` (`homestay_id`, `location_id`, `homestay_name`, `description`, `image`, `status`) VALUES
(1, 9, 'The Shelter Homestay', 'The Shelter Homestay in Da lat', 'uploads/14ed67231636ba0216b3d7f0f8a3c738.jpg', 'active'),
(3, 9, 'Le Bleu - The Vintage Wooden House', 'Vintage wooden house in Dalat', 'uploads/homestay-da-lat-gia-re-1.jpg', 'active'),
(4, 5, 'Little Hoi An Homestay', 'Charming homestay in Hoi An', 'uploads/homestay-ba-vì-5.jpg', 'active'),
(5, 6, 'Deja Vu Homestay', 'Cozy homestay in Ha Long', 'uploads/thiet-ke-noi-that-nha-o-homestay-12.jpg', 'active'),
(6, 5, 'Maison de Tau', 'Unique homestay in Hoi An', 'uploads/vanda-hill-da-lat.jpg', 'active'),
(7, 3, 'Nắng Homestay', 'Sunny homestay in Da Nang', 'uploads/mau-nha-san-homestay-dep-mai-chau-countryside.jpg', 'active'),
(8, 7, 'Her Homestay', 'Cozy homestay in Sa Pa', 'uploads/45632b3e1ec9e52beb73b5a94563_homestay-ba-vi-1-788x525.jpg', 'active'),
(9, 9, 'Lalaland Homestay', 'Artistic homestay in Dalat', 'uploads/7.jpg', 'active'),
(10, 2, 'Sophie’s Art House', 'Artistic homestay in Ho Chi Minh City', 'uploads/4563homestay-ba-vi-14.jpg', 'unactive'),
(11, 8, 'Cocohut Homestay', 'Tropical homestay in Phu Quoc', 'uploads/mau-nha-homestay-dep-moc-home-sapa.jpg', 'active'),
(12, 8, 'Tubotel', 'Unique tube-style hotel in Phu Quoc', 'uploads/homestay-dep5.jpg', 'active'),
(13, 7, 'VietTrekking Homestay', 'Mountain view homestay in Sa Pa', 'uploads/4563homestay-ba-vi-14.jpg', 'active'),
(14, 2, 'The Little Homie', 'Modern homestay in Saigon', 'uploads/homestay.jpg', 'active'),
(15, 1, 'Hanoi Dream Homestay', 'Cozy homestay in Hanoi center', 'uploads/cac-mau-homestay-dep-2.jpg', 'active'),
(16, 1, 'Old Quarter Homestay', 'Charming homestay in Hanoi Old Quarter', 'uploads/14.jpg', 'unactive'),
(17, 1, 'West Lake Homestay', 'Peaceful homestay near West Lake', 'uploads/anh-thanh-pho-2-16355899477761013957557.jpg', 'active');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `home_admin`
--

CREATE TABLE `home_admin` (
  `home_admin_id` int(11) NOT NULL,
  `home_id` int(11) NOT NULL,
  `homestay_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `home_admin`
--

INSERT INTO `home_admin` (`home_admin_id`, `home_id`, `homestay_id`) VALUES
(25, 1, 1),
(26, 2, 1),
(28, 4, 3),
(29, 5, 4),
(30, 6, 5),
(31, 7, 6),
(32, 8, 7),
(33, 9, 8),
(34, 10, 9),
(35, 11, 10),
(36, 12, 11),
(37, 13, 12),
(38, 14, 13),
(39, 15, 14),
(68, 2967, 1),
(75, 2974, 1),
(76, 2975, 3),
(77, 2976, 4),
(78, 2977, 5),
(79, 2978, 6),
(80, 2979, 7),
(81, 2980, 8),
(82, 2981, 9),
(83, 2982, 10),
(84, 2983, 11),
(85, 2984, 12),
(86, 2985, 13),
(87, 2986, 14),
(88, 2987, 15),
(89, 2988, 13),
(90, 2989, 16),
(91, 2990, 17),
(92, 2991, 4),
(93, 2992, 16),
(94, 2993, 6),
(95, 2994, 15),
(96, 2995, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `city` varchar(200) NOT NULL,
  `location_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `locations`
--

INSERT INTO `locations` (`location_id`, `city`, `location_image`) VALUES
(1, 'Hanoi', 'uploads/R.jpg'),
(2, 'Ho Chi Minh City', 'uploads/TP_DN_zing.jpg'),
(3, 'Da Nang', 'uploads/danang-1200x900.jpg'),
(5, 'Hoi An', 'uploads/anh-dep-dao-vinh-viet-nam_055419149.jpg'),
(6, 'Ha Long', 'uploads/106d4143640t6624l52.jpg'),
(7, 'Sa Pa', 'uploads/at_thanh-pho-tren-may-fansipan-legend_ccca327a598dd0fa27140ce4f7a27884.jpg'),
(8, 'Phu Quoc', 'uploads/R (3).jpg'),
(9, 'Dalat', 'uploads/canh-dep-nhat-viet-nam_055419805.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `confirm_id` int(11) NOT NULL,
  `total_price` int(50) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `confirm_id`, `total_price`, `payment`, `customer_id`) VALUES
(6, 1, 500000, 'MOMO', 1),
(7, 1, 900000, 'VNPay', 1),
(8, 2, 700000, 'Vietcombank', 2),
(9, 6, 1500000, 'MOMO', 1),
(10, 7, 20000000, 'Vietcombank', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sections`
--

CREATE TABLE `sections` (
  `homestay_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `home_id` int(50) NOT NULL,
  `customer_id` int(15) NOT NULL,
  `reviews` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sections`
--

INSERT INTO `sections` (`homestay_id`, `section_id`, `home_id`, `customer_id`, `reviews`) VALUES
(1, 1, 1, 1, 'nhà ở khu homstay này chất lượng khá tốt'),
(1, 2, 2, 2, ''),
(3, 3, 4, 3, 'Mặc dù chỉ là phòng tiêu chuẩn nhưng CSVC khá đầy đủ'),
(4, 4, 5, 1, ''),
(4, 28, 5, 4, 'Chất lượng tốt'),
(1, 29, 2, 4, 'Nhân viên nhiệt tình'),
(1, 30, 2, 1, 'Không khí trong lành'),
(5, 31, 6, 1, 'Chất lượng giống như hình ảnh'),
(5, 32, 2977, 1, 'Chắc tôi sẽ thuê lại lần nữa'),
(14, 33, 15, 1, 'Vợ con tôi rất hài lòng về dịch vụ của homestay'),
(13, 34, 14, 1, 'Homestay cần cải thiện thêm dịch vụ khác hàng'),
(4, 35, 2991, 1, 'Dịch vụ không giống với giá cả'),
(1, 36, 2, 5, 'Như trên'),
(1, 37, 2967, 5, 'Giá cả phải chăng'),
(3, 38, 4, 5, 'Anh C nói chí phải'),
(4, 39, 5, 5, 'Nhân viên nhiệt tình, thân thiện');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `confirm`
--
ALTER TABLE `confirm`
  ADD PRIMARY KEY (`confirm_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`home_id`),
  ADD KEY `lk_home_AD` (`home_admin_id`),
  ADD KEY `lk_homestay` (`homestay_id`);

--
-- Chỉ mục cho bảng `homestay`
--
ALTER TABLE `homestay`
  ADD PRIMARY KEY (`homestay_id`),
  ADD KEY `lk_locations` (`location_id`);

--
-- Chỉ mục cho bảng `home_admin`
--
ALTER TABLE `home_admin`
  ADD PRIMARY KEY (`home_admin_id`);

--
-- Chỉ mục cho bảng `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Chỉ mục cho bảng `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `lk_confirm` (`confirm_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `lk_homes` (`home_id`),
  ADD KEY `lk_homestay` (`homestay_id`),
  ADD KEY `lk_customer` (`customer_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `confirm`
--
ALTER TABLE `confirm`
  MODIFY `confirm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3348;

--
-- AUTO_INCREMENT cho bảng `homes`
--
ALTER TABLE `homes`
  MODIFY `home_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2996;

--
-- AUTO_INCREMENT cho bảng `homestay`
--
ALTER TABLE `homestay`
  MODIFY `homestay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `home_admin`
--
ALTER TABLE `home_admin`
  MODIFY `home_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT cho bảng `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `homes`
--
ALTER TABLE `homes`
  ADD CONSTRAINT `lk_home_AD` FOREIGN KEY (`home_admin_id`) REFERENCES `home_admin` (`home_admin_id`),
  ADD CONSTRAINT `lk_homestay` FOREIGN KEY (`homestay_id`) REFERENCES `homestay` (`homestay_id`);

--
-- Các ràng buộc cho bảng `homestay`
--
ALTER TABLE `homestay`
  ADD CONSTRAINT `lk_locations` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`);

--
-- Các ràng buộc cho bảng `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `lk_confirm` FOREIGN KEY (`confirm_id`) REFERENCES `confirm` (`confirm_id`),
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Các ràng buộc cho bảng `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `lk_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `lk_homes` FOREIGN KEY (`home_id`) REFERENCES `homes` (`home_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

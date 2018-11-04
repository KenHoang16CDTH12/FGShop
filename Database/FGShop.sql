-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2018 at 12:58 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-2+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FGShop`
--

DROP DATABASE IF EXISTS FGShop;
CREATE DATABASE FGShop;
USE FGShop;
-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `id_product`) VALUES
(3, 2),
(4, 3),
(5, 9),
(7, 7),
(8, 11);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name_brand` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name_brand`) VALUES
(1, 'Xiaomi'),
(2, 'Apple'),
(3, 'Samsung'),
(4, 'Oppo'),
(5, 'Huawei'),
(6, 'Nokia'),
(7, 'Sony'),
(8, 'Asus'),
(9, 'LG'),
(10, 'Panasonic'),
(11, 'Toshiba'),
(12, 'Dell'),
(13, 'Macbook'),
(14, 'Canon');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `content` text,
  `time_comment` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id_product` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id_product`, `id_user`) VALUES
(7, 470),
(6, 470),
(2, 470),
(15, 470),
(4, 470),
(16, 470),
(15, 472),
(2, 472);

-- --------------------------------------------------------

--
-- Table structure for table `group_product_type`
--

CREATE TABLE `group_product_type` (
  `id` int(11) NOT NULL,
  `name_group` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_product_type`
--

INSERT INTO `group_product_type` (`id`, `name_group`, `image`) VALUES
(1, 'Điện Thoại - Máy Tính Bảng', 'assets/image/types/mobile_tablet.jpg'),
(2, 'Tivi - Thiết bị nghe nhìn', 'assets/image/types/tivi.jpg'),
(3, 'Phụ kiện - Thiết bị số', 'assets/image/types/accessories.jpg'),
(4, 'Laptop - Thiết bị IT', 'assets/image/types/laptop.jpg'),
(5, 'Máy Ảnh - Quay Phim', 'assets/image/types/camera.jpg'),
(6, 'Điện Gia Dụng - Điện Lạnh', 'assets/image/types/electric_appliances.jpg'),
(7, 'Nhà Cửa Đời Sống', 'assets/image/types/house.jpg'),
(8, 'Hàng Tiêu Dùng - Thực Phẩm', 'assets/image/types/food.jpg'),
(9, 'Đồ chơi, Mẹ & bé', 'assets/image/types/mother_and_baby.jpg'),
(10, 'Làm đẹp - Sức khỏe', 'assets/image/types/make_up.jpg'),
(11, 'Thời trang - Phụ kiện', 'assets/image/types/fashion.jpg'),
(12, 'Thể thao - Dã ngoại', 'assets/image/types/sport.jpg'),
(13, 'Xe máy, Ô tô, Xe đạp ', 'assets/image/types/car.jpg'),
(14, 'Sách, VPP & Quà tặng', 'assets/image/types/book.jpg'),
(15, 'Voucher - Dịch vụ - Thẻ cào', 'assets/image/types/voucher.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name_img` varchar(255) DEFAULT NULL,
  `big_img` text,
  `small_img` text,
  `details_img` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `name_img`, `big_img`, `small_img`, `details_img`) VALUES
(1, 'Xiaomi Brand', 'images/big_img/brand/xiaomi.jpg', 'images/small_img/brand/xiaomi.png', '                              '),
(2, NULL, 'images/big_img/brand/apple.jpg', 'images/small_img/brand/apple.png', NULL),
(3, NULL, 'images/big_img/brand/samsung.jpg', 'images/small_img/brand/samsung.png', NULL),
(4, NULL, 'images/big_img/brand/oppo.jpg', 'images/small_img/brand/oppo.png', NULL),
(5, NULL, 'images/big_img/brand/huawei.jpg', 'images/small_img/brand/huawei.png', NULL),
(6, NULL, 'images/big_img/brand/nokia.jpg', 'images/small_img/brand/nokia.png', NULL),
(7, NULL, 'images/big_img/brand/sony.jpg', 'images/small_img/brand/sony.png', NULL),
(8, NULL, 'images/big_img/brand/asus.jpg', 'images/small_img/brand/asus.png', NULL),
(9, NULL, 'images/big_img/brand/lg.jpeg', 'images/small_img/brand/lg.png', NULL),
(10, NULL, 'images/big_img/brand/panasonic.jpg', 'images/small_img/brand/panasonic.png', NULL),
(11, NULL, 'images/big_img/brand/toshiba.jpg', 'images/small_img/brand/toshiba.png', NULL),
(12, NULL, 'images/big_img/brand/dell.jpg', 'images/small_img/brand/dell.png', NULL),
(13, NULL, 'images/big_img/brand/macbook.jpg', 'images/small_img/brand/macbook.png', NULL),
(14, NULL, '', 'images/details_img/product/xiaomi_mi_mix_2/xiaomi_1_1.jpg', '[\r\n    "images/details_img/product/xiaomi_mi_mix_2/xiaomi_1_2.jpg",\r\n    "images/details_img/product/xiaomi_mi_mix_2/xiaomi_1_3.jpg",\r\n    "images/details_img/product/xiaomi_mi_mix_2/xiaomi_1_4.jpg",\r\n    "images/details_img/product/xiaomi_mi_mix_2/xiaomi_1_5.jpg",\r\n    "images/details_img/product/xiaomi_mi_mix_2/big_xiaomi_1_1.jpg",\r\n    "images/details_img/product/xiaomi_mi_mix_2/big_xiaomi_1_2.jpg",\r\n    "images/details_img/product/xiaomi_mi_mix_2/big_xiaomi_1_3.jpg",\r\n    "images/details_img/product/xiaomi_mi_mix_2/big_xiaomi_1_4.jpg"\r\n  ]                                                            '),
(15, NULL, NULL, 'images/details_img/product/xiaomi_redmi_5a/xiaomi_1_1.jpg', '[\r\n    "images/details_img/product/xiaomi_redmi_5a/xiaomi_1_2.jpg",\r\n    "images/details_img/product/xiaomi_redmi_5a/xiaomi_1_3.jpg",\r\n    "images/details_img/product/xiaomi_redmi_5a/big_xiaomi_1_1.jpg",\r\n    "images/details_img/product/xiaomi_redmi_5a/big_xiaomi_1_2.jpg",\r\n    "images/details_img/product/xiaomi_redmi_5a/big_xiaomi_1_3.jpg",\r\n    "images/details_img/product/xiaomi_redmi_5a/big_xiaomi_1_4.jpg"\r\n    "images/details_img/product/xiaomi_redmi_5a/big_xiaomi_1_5.jpg"\r\n    "images/details_img/product/xiaomi_redmi_5a/big_xiaomi_1_6.jpg"\r\n  ]');

-- --------------------------------------------------------

--
-- Table structure for table `image_brand`
--

CREATE TABLE `image_brand` (
  `id` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `path` text NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_brand`
--

INSERT INTO `image_brand` (`id`, `id_brand`, `path`, `type`) VALUES
(4, 1, 'assets/image/brands/xiaomi.png', 'LOGO'),
(5, 2, 'assets/image/brands/apple.png', 'LOGO'),
(6, 3, 'assets/image/brands/samsung.png', 'LOGO'),
(7, 4, 'assets/image/brands/oppo.png', 'LOGO'),
(8, 5, 'assets/image/brands/huawei.png', 'LOGO'),
(9, 6, 'assets/image/brands/nokia.png', 'LOGO'),
(10, 7, 'assets/image/brands/sony.png', 'LOGO'),
(12, 8, 'assets/image/brands/asus.png', 'LOGO'),
(13, 9, 'assets/image/brands/lg.png', 'LOGO'),
(14, 10, 'assets/image/brands/panasonic.png', 'LOGO'),
(15, 11, 'assets/image/brands/toshiba.png', 'LOGO'),
(16, 12, 'assets/image/brands/dell.png', 'LOGO'),
(17, 13, 'assets/image/brands/macbook.png', 'LOGO'),
(18, 14, 'assets/image/brands/cannon.png', 'LOGO');

-- --------------------------------------------------------

--
-- Table structure for table `image_product`
--

CREATE TABLE `image_product` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `path` text NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_product`
--

INSERT INTO `image_product` (`id`, `id_product`, `path`, `type`) VALUES
(11, 2, 'assets/image/products/xiaomi_1_1.jpg', 'PRIMARY'),
(12, 3, 'assets/image/products/xiaomi_1_3.jpg', 'PRIMARY'),
(13, 2, 'assets/image/products/big_xiaomi_1_2.jpg', 'BANNER'),
(14, 3, 'assets/image/products/big_xiaomi_1_1.jpg', 'BANNER'),
(15, 4, 'assets/image/products/apple1.png', 'PRIMARY'),
(16, 5, 'assets/image/products/asus.png', 'PRIMARY'),
(17, 6, 'assets/image/products/apple3.png', 'PRIMARY'),
(18, 9, 'assets/image/products/apple2.png', 'PRIMARY'),
(19, 7, 'assets/image/products/htc.png', 'PRIMARY'),
(20, 8, 'assets/image/products/lenovo.png', 'PRIMARY'),
(21, 10, 'assets/image/products/nokia.png', 'PRIMARY'),
(22, 11, 'assets/image/products/oppo.png', 'PRIMARY'),
(23, 12, 'assets/image/products/samsung.png', 'PRIMARY'),
(24, 13, 'assets/image/products/sony.png', 'PRIMARY'),
(25, 14, 'assets/image/products/xiaomi.png', 'PRIMARY'),
(26, 7, 'assets/image/products/big_xiaomi_1_5.jpg', 'BANNER'),
(27, 9, 'assets/image/products/big_xiaomi_1_3.jpg', 'BANNER'),
(28, 11, 'assets/image/products/big_xiaomi_1_6.jpg', 'BANNER'),
(29, 15, 'assets/image/products/canon.jpg', 'PRIMARY'),
(30, 16, 'assets/image/products/canon1.jpg', 'PRIMARY');

-- --------------------------------------------------------

--
-- Table structure for table `image_user`
--

CREATE TABLE `image_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `path` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `image_user`
--

INSERT INTO `image_user` (`id`, `id_user`, `path`, `type`) VALUES
(1, 1, 'assets/image/users/face-3.jpg', 'PRIMARY'),
(3, 1, 'assets/image/users/backgroundwall.jpg', 'BANNER'),
(4, 470, 'assets/image/users/kenhoang.jpeg', 'PRIMARY'),
(5, 469, 'assets/image/users/face-2.jpg', 'PRIMARY');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `content` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `delivery_address` text,
  `delivery_date` varchar(45) DEFAULT NULL,
  `order_date` varchar(45) DEFAULT NULL,
  `desc` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `id_user`, `phone`, `status`, `delivery_address`, `delivery_date`, `order_date`, `desc`) VALUES
(3, 1, '01232954563', 'PLACED', 'Hue Viet Nam', NULL, '01/01/2018', 'test'),
(4, 1, '01232954563', 'PLACED', 'Hue Viet Nam', '', '01/01/2018', 'test'),
(10, 470, '01232954563', 'SHIPPED', '70 Nguyễn Huệ, Vĩnh Ninh, Thành phố Huế, Thừa Thiên Huế, Vietnam', '', '13/05/2018', 'COmmoeno'),
(11, 470, '01232954563', 'PLACED', '85/6, Nguyen Hue Street, Hue City, Thua Thien Hue Province, Phú Nhuận, Thành phố Huế, Thừa Thiên Huế, Vietnam', '', '14/05/2018', ''),
(12, 472, '01232954563', 'PLACED', '70 Nguyễn Huệ, Vĩnh Ninh, Thành phố Huế, Thừa Thiên Huế, Vietnam', '01/06/2018', '28/05/2018', 'Hihi');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `quanity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_order`, `id_product`, `quanity`) VALUES
(3, 2, 5),
(3, 2, 5),
(3, 2, 5),
(10, 2, 1),
(10, 3, 1),
(10, 4, 1),
(10, 5, 1),
(11, 6, 1),
(11, 7, 1),
(12, 2, 3),
(12, 4, 1),
(12, 15, 4);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_payment_method` int(11) DEFAULT NULL,
  `create_time` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name_product` varchar(250) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `isbn` varchar(45) DEFAULT NULL,
  `infor` text,
  `desc` text,
  `status` varchar(45) DEFAULT NULL,
  `quanity` int(11) DEFAULT NULL,
  `add_by` int(11) DEFAULT NULL,
  `id_product_type` int(11) DEFAULT NULL,
  `id_brand` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name_product`, `price`, `isbn`, `infor`, `desc`, `status`, `quanity`, `add_by`, `id_product_type`, `id_brand`) VALUES
(2, 'Điện Thoại Xiaomi Mi Mix 2 (Black) - Hàng Chính Hãng DGW ', '9990000', NULL, '[\r\n"Thương hiệu" => "Xiaomi",\r\n"Model" => "Mi Mix 2",\r\n"Mã part" => "ROM Tiếng Việt, có sẵn CH play",\r\n"Phụ kiện đi kèm" => "Cáp, sạc, hướng dẫn",\r\n"Màu" => "Black",\r\n"Loại / Công nghệ màn hình" => "IPS LCD",\r\n"Độ phân giải màn hình" => "1080 x 2160 pixels",\r\n"Hiển thị màu sắc" => "Hơn 16 triệu màu",\r\n"Camera trước" => "5MP",\r\n"Camera sau" => "12MP",\r\n"Tính năng camera" => "Chụp ảnh xóa phông, Tự động lấy nét, Chạm lấy nét, Nhận diện khuôn mặt, HDR, Panorama, Chống rung quang học (OIS)",\r\n"Đèn Flash" => "Có",\r\n"Video call" => "Hỗ trợ VideoCall thông qua ứng dụng",\r\n"Quay phim" => "Quay phim 4K 2160p@30fps",\r\n"Bộ nhớ RAM" => "6GB",\r\n"Bộ nhớ trong (ROM)" => "64GB",\r\n"Trọng lượng" => "185g",\r\n"Kích thước" => "(D x R x C) 151.8 x 75.5 x 7.7 mm",\r\n"Tên chip" => Qualcomm Snapdragon 835,\r\n"Tốc độ chip (GHz)" => "4 nhân 2.45 GHz Kryo & 4 nhân 1.9 GHz Kryo",\r\n"Loại lõi chip" => "8 Nhân",\r\n"Chip đồ họa (GPU)" => "Adreno 540",\r\n"Hệ điều hành" => "Android 7.1",\r\n"Dung lượng pin (mAh)" =>  "3400mAh",\r\n"Loại pin" => "Pin chuẩn Li-Ion",\r\n"Kết nối dữ liệu" => "Bluetooth, Wifi, 3G, 4G",\r\n"Băng tần 3G" => "Có",\r\n"Hỗ trợ 4G" => "Có",\r\n"Loại Sim" => "Nano SIM",\r\n"Số khe sim" => "2",\r\n"Wifi" => "Wi-Fi 802.11 a/b/g/n/ac, Dual-band, DLNA, Wi-Fi Direct, Wi-Fi hotspot",\r\n"GPS" => "A-GPS, GLONASS",\r\n"Bluetooth" => "Bluetooth v5.0, Bluetooth HID",\r\n"Kết nối khác" => "NFC, OTG",\r\n"Cổng sạc" => "USB Type-C",\r\n"Xem phim" => "MP4, M4V, MKV, XVID",\r\n"Nghe nhạc" => "MP3, AAC, AMR, FLAC, WAV",\r\n"Ghi âm" => "Có",\r\n"FM radio" => "Không",\r\n"SKU" => "5806699882461"\r\n ]', 'Thiết kế màn hình không viền siêu mỏng\r\n\r\nĐiện thoại Xiaomi Mi Mix 2 là phiên bản mới được chế tác từ chất liệu kim loại và gốm, trong đó phần khung làm bằng kim loại được đặt giữa hai tấm gốm. Chính chất liệu gốm đã tạo nên vẻ đẹp sang trọng, tinh tế nhưng đầy cứng cáp cho dòng Mi Mix 2 này.\r\nĐặc biệt hơn, Xiaomi Mi Mix 2 được thiết kế màn hình không viền siêu mỏng, độ dày chỉ 7.7mm kết hợp đường viền mạ vàng 18K ở cụm camera mặt sau tạo nên nét quyến rũ cho người sở hữu.\r\n\r\nMàn hình 5.99 inch, độ phân giải Full HD+\r\n\r\nĐiện thoại được trang bị màn hình 5.99 inch, độ phân giải Full HD+ (2160 x 1080 pixels) với công nghệ IPS LCD nên máy đạt độ tương phản cao, màu sắc tươi sáng và góc nhìn rộng giúp người dùng trải nghiệm lý thú hơn.\r\nCấu hình mạnh mẽ, ổn định\r\nXiaomi Mi Mix 2 sở hữu cấu hình tương xứng với vẻ ngoài của mình, máy được tích hợp chip Qualcomm Snapdragon 835, RAM 6 GB, bộ nhớ trong 64GB chuẩn UFS 2.1. Cấu hình máy đảm bảo giúp bạn chinh phục mọi game độ họa nặng nhất hoặc xử lý các tác vụ nhanh chóng như xem phim, lướt web mà không sợ hiện tượng đứng màn hình.\r\n\r\nTrải nghiệm camera sắc nét, tự tin thể hiện khả năng nhiếp ảnh\r\n\r\nVầ camera, Mi Mix 2 có độ phân giải 12MP sử dụng cảm biến Sony IMX386 giống dòng Mi Mix kết hợp chống rung quang học 4 trục tương tự Mi 6 giúp người dùng quay được video 4K ở tốc độ 30 khung hình / giây, 120 khung hình/ giây với video HD và 120 khung / giây khi quay slow motion (chuyển động chậm).\r\nBên cạnh đó, camera còn tích hợp các tính năng như chụp ảnh xóa phông, tự động lấy nét, chạm lấy nét, nhận diện khuôn mặt, HDR, Panorama… giúp bạn tự tin thể hiện khả năng nhiếp ảnh của mình.\r\nDo được nâng cấp ống kính, camera sau của Mi Mix 2 lồi lên một chút, nhưng không ảnh hưởng nhiều đến tính thẩm mỹ. Đồng thời, camera trước tuy vẫn là 5 MP nhưng sử dụng cảm biến cao cấp hơn.\r\n\r\nQuick sạc nhanh 3.0\r\n\r\nXiaomi Mi Mix 2 được trang bị viên pin có dung lượng lên đến 3.400mAh và được tích hợp công nghệ sạch nhanh Quick Charge 3.0 mới nhất thông qua cổng USB Type-C giúp cho bạn có thể hạn chế tối đa thời gian sạc đầy pin mà vẫn có thời lượng sử dụng lý tưởng.', 'READY', 0, 1, 13, 1),
(3, 'Điện Thoại Xiaomi Redmi 5A (16GB/2GB) - Hàng Chính Hãng ', '1950000', NULL, '[\r\n"Thương hiệu" => "Xiaomi",\r\n"Model" => " Redmi 5A ",\r\n"Mã part" => "ROM Tiếng Việt, có sẵn CH play",\r\n"Phụ kiện đi kèm" => "Cáp, sạc, hướng dẫn",\r\n"Màu" => "Black",\r\n"Loại / Công nghệ màn hình" => "IPS LCD",\r\n"Độ phân giải màn hình" => "1080 x 2160 pixels",\r\n"Hiển thị màu sắc" => "Hơn 16 triệu màu",\r\n"Camera trước" => "5MP",\r\n"Camera sau" => "12MP",\r\n"Tính năng camera" => "Chụp ảnh xóa phông, Tự động lấy nét, Chạm lấy nét, Nhận diện khuôn mặt, HDR, Panorama, Chống rung quang học (OIS)",\r\n"Đèn Flash" => "Có",\r\n"Video call" => "Hỗ trợ VideoCall thông qua ứng dụng",\r\n"Quay phim" => "Quay phim 4K 2160p@30fps",\r\n"Bộ nhớ RAM" => "6GB",\r\n"Bộ nhớ trong (ROM)" => "64GB",\r\n"Trọng lượng" => "185g",\r\n"Kích thước" => "(D x R x C) 151.8 x 75.5 x 7.7 mm",\r\n"Tên chip" => Qualcomm Snapdragon 835,\r\n"Tốc độ chip (GHz)" => "4 nhân 2.45 GHz Kryo & 4 nhân 1.9 GHz Kryo",\r\n"Loại lõi chip" => "8 Nhân",\r\n"Chip đồ họa (GPU)" => "Adreno 540",\r\n"Hệ điều hành" => "Android 7.1",\r\n"Dung lượng pin (mAh)" =>  "3400mAh",\r\n"Loại pin" => "Pin chuẩn Li-Ion",\r\n"Kết nối dữ liệu" => "Bluetooth, Wifi, 3G, 4G",\r\n"Băng tần 3G" => "Có",\r\n"Hỗ trợ 4G" => "Có",\r\n"Loại Sim" => "Nano SIM",\r\n"Số khe sim" => "2",\r\n"Wifi" => "Wi-Fi 802.11 a/b/g/n/ac, Dual-band, DLNA, Wi-Fi Direct, Wi-Fi hotspot",\r\n"GPS" => "A-GPS, GLONASS",\r\n"Bluetooth" => "Bluetooth v5.0, Bluetooth HID",\r\n"Kết nối khác" => "NFC, OTG",\r\n"Cổng sạc" => "USB Type-C",\r\n"Xem phim" => "MP4, M4V, MKV, XVID",\r\n"Nghe nhạc" => "MP3, AAC, AMR, FLAC, WAV",\r\n"Ghi âm" => "Có",\r\n"FM radio" => "Không",\r\n"SKU" => "5806699882461"\r\n ]', 'Thiết kế đẹp mắt với đường cong tinh tế\r\n\r\nĐiện Thoại Xiaomi Redmi 5A có thiết kế bo tròn các góc đẹp mắt, với chất liệu vỏ nhựa nguyên khối tỉ mỉ và rất chắn chắn. Đặc biệt phía sau ốp máy được sơn lớp giả kim loại mờ sang trọng. Phía dưới thân máy có 1 gờ nhỏ để tránh loa máy tiếp xúc với bề mặt cứng khác làm ảnh hưởng đến chất lượng loa.\r\n\r\nMàn hình HD 5 inch\r\n\r\nRedmi 5A sử dụng màn hình HD 5 inch với độ phân giải 720 x 1280 pixels cho chất lượng hiển thị xuất sắc. Thiết bị có hỗ trợ chế độ đọc sách giúp bảo vệ và giảm mỏi cho đôi mắt bằng cách lọc ánh sáng xanh. Công nghệ IPS cho màu sắc hiển thị, độ tương phản cao và góc nhìn tốt.\r\n\r\nCamera 13 MP sắc nét\r\n\r\nXiaomi Redmi 5A được trang bị máy ảnh 13MP với độ lấy nét cực nhanh cho các bức ảnh sắc nét và sinh động, cùng nhiều chế độ chụp ảnh dễ dàng.Camera trước của điện thoại 5 MP có khẩu độ F/2.0 cho hình ảnh tốt.\r\n\r\nGiao diện MIUI 9.0 tuyệt đẹp\r\n\r\nĐiện Thoại Xiaomi Redmi 5A được trang bị sẵn MIUI 9, có giao diện tuyệt đẹp. Với MIUI 9, bạn có thể chạy song song đồng thời 2 ứng dụng trên cùng một màn hình và có thể điều chỉnh không gian màn hình của mỗi ứng dụng, cho phép chuyển tập tin giữa các thiết bị mà không cần kết nối internet. \r\n\r\nBộ xử lý 4 nhân mạnh mẽ\r\n\r\nRedmi 5A được tích hợp bộ xử lý bốn nhân Qualcomm Snapdragon 425 64-bit không chỉ đáp ứng tốt cho việc sử dụng hàng ngày mà cả game đòi hỏi đồ họa cao. Ngoài ra, điện thoại còn có bộ nhớ Ram 2 GB và bộ nhớ trong 16 GB có thể mở rộng qua thẻ nhớ đến 256 GB, giúp bạn thoải mái lưu trữ dữ liệu.\r\n\r\nDung lượng pin lớn\r\n\r\nPin dung lượng cao 3000mAh được MIUI tối ưu hóa năng lượng cấp hệ thống đem hiệu năng sử dụng cao. Bạn có thể thoải mái xem video đến 7 giờ và 6 giờ chơi game liên tục. Ngoài ra, điện thoại còn có 2 khe sim, hỗ trợ 4G giúp bạn truy cập internet một cách dễ dàng.', 'READY', 100, 1, 13, 1),
(4, 'IPHONE 5', '8400000', '', '', '', 'READY', 100, 1, 13, 2),
(5, 'Smart phone ASUS 4.0', '1999000', '', '', '', 'READY', 0, 1, 13, 8),
(6, 'IPHONE 6', '12999000', '', '', '', 'READY', 100, 1, 13, 2),
(7, 'Smart phone HTC Sliver 2.0', '3200000', '', '', '', 'READY', 5, 1, 13, 6),
(8, 'LENOVO Phone 2.0.0', '4000000', '', '', '', 'READY', 100, 1, 13, 5),
(9, 'IPHONE 7', '15900000', '', '', '', 'READY', 7, 1, 13, 2),
(10, 'Nokia lumia 520', '9999999', '', '', '', 'READY', 100, 1, 13, 6),
(11, 'PHONE OPPO 9.0', '2000000', '', '', '', 'READY', 95, 1, 13, 4),
(12, 'SAMSUNG GALAXY 9X', '2499989', '', '', '', 'READY', 95, 1, 13, 3),
(13, 'SONY LCD 3210', '2999999', '', '', '', 'READY', 100, 1, 13, 7),
(14, 'XIAOMI PHONE 2.0.C', '20000000', '', '', '', 'READY', 100, 1, 13, 1),
(15, 'Máy Ảnh Canon', '9600000', '', '', '', 'READY', 100, 1, 15, 14),
(16, 'Máy Ảnh Du Lịch', '11790000', '', '', '', 'READY', 100, 1, 15, 14);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name_type` varchar(200) DEFAULT NULL,
  `image` text,
  `id_group` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name_type`, `image`, `id_group`) VALUES
(1, 'Máy tính bảng', NULL, 1),
(2, 'Điện thoại phổ thông', NULL, 1),
(3, 'Phụ kiện điện thoại', NULL, 1),
(4, 'Smart Tivi', NULL, 2),
(5, 'Internet Tivi', NULL, 2),
(6, 'Tivi QLED', NULL, 2),
(7, 'Tivi OLED', NULL, 2),
(8, 'Tivi LED', NULL, 2),
(9, 'Tivi 4K', NULL, 2),
(10, 'Loa Thanh', NULL, 2),
(11, 'Loa Karaoke', NULL, 2),
(12, 'Amply Karaoke', NULL, 2),
(13, 'Điện thoại thông minh', NULL, 1),
(15, 'Máy Ảnh', 'assets/image/types/', 5),
(16, 'Ống kính - Lens', 'assets/image/types/', 5),
(17, 'Máy Quay Phim', 'assets/image/types/', 5),
(18, 'Phụ Kiện Máy Ảnh', 'assets/image/types/', 5),
(19, 'Vali & Balo', 'assets/image/types/', 11),
(20, 'Thời Trang Nữ', 'assets/image/types/', 11),
(21, 'Thời Trang Nam', 'assets/image/types/', 11),
(22, 'Đồ chơi sơ sinh', 'assets/image/types/', 9),
(23, 'Sữa & Thực Phẩm Cho Bé', 'assets/image/types/', 9),
(24, 'Xe Đẩy', 'assets/image/types/', 9),
(26, 'Đồ dùng cho mẹ trước và sau khi sinh', 'assets/image/types/', 9),
(27, 'Nồi cơm điện', 'assets/image/types/', 6),
(28, 'Tủ lạnh', 'assets/image/types/', 6),
(29, 'Lò vi sóng', 'assets/image/types/', 6),
(30, 'Máy nước nóng', 'assets/image/types/', 6),
(31, 'Máy lạnh - Máy điều hòa', 'assets/image/types/', 6);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id_product` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `date_start` varchar(45) DEFAULT NULL,
  `date_end` varchar(45) DEFAULT NULL,
  `id_promotion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=' \n  ';

-- --------------------------------------------------------

--
-- Table structure for table `promotion_type`
--

CREATE TABLE `promotion_type` (
  `id` int(11) NOT NULL,
  `name_promotion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `content` text,
  `stars` int(11) DEFAULT NULL,
  `time_rate` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `id_product`, `id_user`, `content`, `stars`, `time_rate`) VALUES
(1, 2, 1, 'Hehe', 5, '1525430854'),
(2, 2, 469, 'bad', 1, '1525430854'),
(3, 2, 467, 'Comment of admin', 5, '1525430854'),
(4, 3, 1, 'Comment of admin', 5, '1525430854'),
(5, 4, 1, 'Comment of admin', 2, '1525430854'),
(6, 2, 470, 'goood', 5, '1525509470547'),
(7, 3, 470, '', 4, '1525512774053'),
(8, 7, 470, 'good', 5, '1525519162048'),
(9, 6, 470, 'Not good', 2, '1525519610211'),
(10, 15, 470, 'exc', 5, '1525761201659'),
(11, 5, 470, '', 5, '1525761427927'),
(12, 4, 470, 'good', 5, '1526006134816'),
(13, 15, 472, 'Good. Thanks god!', 5, '1527508964721'),
(14, 2, 472, 'Bad', 1, '1527509059306');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id_user` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL COMMENT '   ',
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `birthdate` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `identify_number` varchar(45) DEFAULT NULL,
  `wallet` decimal(10,0) DEFAULT NULL,
  `is_social` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `token` varchar(80) DEFAULT NULL,
  `id_user_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `birthdate`, `phone`, `gender`, `identify_number`, `wallet`, `is_social`, `status`, `token`, `id_user_type`) VALUES
(1, 'Ken Hoang Admin', 'admin', 'XnCOFXzvzFGHXS/GZ5kVEZ9PAE2N+oCeqydK87yGuwo=', '01/01/2018', '01232954563', 'MALE', '192062873', '0', 'NO', 'ACTIVE', '', 1),
(467, 'duong', 'hoang.duongminh0223@gmail.com', '590600baaee606b3d714c2a3c729806f', '01/01/1990', '', 'MALE', '', '0', 'NO', 'ACTIVE', 'd382cbff59dac083d12f802dee05d58a', 3),
(469, 'Betty Warmanberg', 'ewdhfwagvg_1524913750@tfbnw.net', '04c98ac2cb73a7adf1fcf60cbd64e083', 'null', '', 'FEMALE', '', '0', 'FACEBOOK', 'ACTIVE', '', 3),
(470, 'Dương Minh Hoàng (Ken Hoàng)', 'hoang.duongminh0221@gmail.com', 'b91H/mQE9rrehWqVjVE9IDl42PyD+O8vNxQzfrWfGCk=', '01/01/1990', '', 'MALE', '', '0', 'GOOGLE', 'ACTIVE', 'b4def58c09370c42038b6edafca1c0ab', 3),
(471, 'Ken Nguyen', 'kennguyen@gmail.com', '590600baaee606b3d714c2a3c729806f', '01/01/1990', '', 'MALE', '', '0', 'NO', 'ACTIVE', '', 3),
(472, 'Sharecode', 'hoang.duongminh0224@gmail.com', '876dfefef3ef6f4548f48bbddd856cef', '01/01/1990', '', 'MALE', '', '0', 'NO', 'ACTIVE', '', 3),
(474, 'Ken', 'hoang02@gmail.com', '590600baaee606b3d714c2a3c729806f', '01/01/1990', '', 'MALE', '', '0', 'NO', 'ACTIVE', 'cbafc3b368edbd3862b4db623e44e462', 3),
(475, 'hoang', 'hoang03@gmail.com', '590600baaee606b3d714c2a3c729806f', '01/01/1990', '', 'MALE', '', '0', 'NO', 'ACTIVE', 'da0c17b8b616057864af4d46c645682c', 3),
(476, 'Ken', 'kenhoang01@gmail.com', '590600baaee606b3d714c2a3c729806f', '01/01/1990', '', 'MALE', '', '0', 'NO', 'ACTIVE', '22ced482609d30cd951b36e4b668a8e7', 3),
(477, 'Ken Hoang', 'kenhoang0221@gmail.com', '590600baaee606b3d714c2a3c729806f', '01/01/1990', '', 'MALE', '', '0', 'NO', 'ACTIVE', '', 3),
(478, 'Ken Hoang Client', 'client@gmail.com', 'b91H/mQE9rrehWqVjVE9IDl42PyD+O8vNxQzfrWfGCk=', '01/01/1990', '', 'MALE', '', '0', 'NO', 'ACTIVE', '', 3),
(479, 'hoang duong', 'hoang.duongminh0225@gmail.com', 'b91H/mQE9rrehWqVjVE9IDl42PyD+O8vNxQzfrWfGCk=', '01/01/1990', '', 'MALE', '', '0', 'NO', 'ACTIVE', '', 3),
(480, 'Ken Nguyen', 'hoang.duongminh0228@gmail.com', 'b91H/mQE9rrehWqVjVE9IDl42PyD+O8vNxQzfrWfGCk=', '01/01/1990', '', 'MALE', '', '0', 'NO', 'ACTIVE', 'ee982032fa36f555ee998de594c55d9f', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name_user_type` varchar(45) DEFAULT 'Client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name_user_type`) VALUES
(1, 'ADMIN'),
(2, 'PARTNER'),
(3, 'CLIENT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Comment_1_idx` (`id_user`),
  ADD KEY `fk_Comment_2_idx` (`id_product`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD KEY `fk_favorite_1_idx` (`id_product`),
  ADD KEY `fk_favorite_2_idx` (`id_user`);

--
-- Indexes for table `group_product_type`
--
ALTER TABLE `group_product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_brand`
--
ALTER TABLE `image_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_product`
--
ALTER TABLE `image_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_user`
--
ALTER TABLE `image_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notification_1_idx` (`id_user`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Order_1_idx` (`id_user`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD KEY `fk_Order_Detail_1_idx` (`id_order`),
  ADD KEY `fk_Order_Detail_2_idx` (`id_product`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payment_1_idx` (`id_user`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Product_1_idx` (`id_brand`),
  ADD KEY `fk_Product_3_idx` (`id_product_type`),
  ADD KEY `fk_Product_4_idx` (`add_by`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Product_Type_1_idx` (`id_group`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD KEY `fk_promotion_1_idx` (`id_product`),
  ADD KEY `fk_promotion_2_idx` (`id_promotion`);

--
-- Indexes for table `promotion_type`
--
ALTER TABLE `promotion_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Rating_1_idx` (`id_product`),
  ADD KEY `fk_Rating_2_idx` (`id_user`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD KEY `fk_report_1_idx` (`id_user`),
  ADD KEY `fk_report_2_idx` (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Users_1_idx` (`id_user_type`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `group_product_type`
--
ALTER TABLE `group_product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `image_brand`
--
ALTER TABLE `image_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `image_product`
--
ALTER TABLE `image_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `image_user`
--
ALTER TABLE `image_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `promotion_type`
--
ALTER TABLE `promotion_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_Comment_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Comment_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `fk_favorite_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_favorite_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_notification_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_Order_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_Order_Detail_1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Order_Detail_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_Product_1` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `fk_Product_3` FOREIGN KEY (`id_product_type`) REFERENCES `product_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Product_4` FOREIGN KEY (`add_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_type`
--
ALTER TABLE `product_type`
  ADD CONSTRAINT `fk_Product_Type_1` FOREIGN KEY (`id_group`) REFERENCES `group_product_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `fk_promotion_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_promotion_2` FOREIGN KEY (`id_promotion`) REFERENCES `promotion` (`id_product`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_Rating_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Rating_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_report_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_report_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_Users_1` FOREIGN KEY (`id_user_type`) REFERENCES `user_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

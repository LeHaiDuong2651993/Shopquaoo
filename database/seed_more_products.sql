-- phpMyAdmin SQL Dump
-- Chèn thêm sản phẩm mẫu vào database shop_quan_ao
-- Đảm bảo bạn đã chọn database `shop_quan_ao` trước khi chạy script này

USE `shop_quan_ao`;

-- Chèn thêm sản phẩm
INSERT INTO `products` (`category_id`, `name`, `description`, `price`, `stock`, `image`) VALUES
(1, 'Áo Thun Polo Cổ Bẻ Cao Cấp', 'Chất liệu cá sấu cotton 100%, co giãn 4 chiều, thấm hút mồ hôi cực tốt. Phù hợp mặc đi làm, đi chơi.', 250000.00, 100, ''),
(1, 'Áo Khoác Bomber Nam Nữ', 'Áo khoác bomber dù 2 lớp, chống nắng, chống gió tốt. Kiểu dáng trẻ trung năng động.', 350000.00, 50, ''),
(1, 'Áo Sơ Mi Nam Tay Dài Kẻ Sọc', 'Áo sơ mi nam chất lụa trượt mềm mịn, không nhăn. Form regular fit tôn dáng.', 280000.00, 75, ''),
(2, 'Quần Kaki Nam Dáng Slimfit', 'Quần kaki chất liệu cotton pha spandex co giãn, thoải mái vận động. Màu sắc trang nhã dễ phối đồ.', 320000.00, 80, ''),
(2, 'Quần Short Jean Nữ Cạp Cao', 'Quần short jean nữ tua rua cá tính, cạp cao tôn dáng, giúp kéo dài đôi chân.', 190000.00, 120, ''),
(2, 'Quần Tây Nam Công Sở', 'Quần tây nam form chuẩn, chất liệu vải tuyết mưa cao cấp, không bai xù.', 400000.00, 60, ''),
(3, 'Đầm Dự Tiệc Trễ Vai Chữ A', 'Váy đầm thiết kế trễ vai quyến rũ, dáng chữ A che khuyết điểm vòng 2 hoàn hảo.', 550000.00, 30, ''),
(3, 'Chân Váy Xếp Ly Dáng Dài', 'Chân váy xếp ly midi qua gối, phong cách vintage thanh lịch, nhẹ nhàng.', 220000.00, 90, ''),
(4, 'Túi Xách Da Đeo Chéo', 'Túi xách nữ chất liệu da PU cao cấp, thiết kế khóa kim loại sang trọng.', 380000.00, 45, ''),
(4, 'Thắt Lưng Nam Da Bò Thật', 'Thắt lưng nam mặt khóa tự động, chất liệu da bò 100% bền bỉ với thời gian.', 290000.00, 150, ''),
(4, 'Mũ Lưỡi Trai Unisex Trơn', 'Mũ lưỡi trai phong cách Hàn Quốc, 100% cotton thoáng khí, khóa điều chỉnh kích thước dễ dàng.', 99000.00, 200, '');

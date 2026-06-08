-- Cập nhật ảnh cho sản phẩm
USE `shop_quan_ao`;

-- Cập nhật ảnh cho các sản phẩm theo category
UPDATE products SET image = 'polo.png' WHERE name = 'Áo Thun Polo Cổ Bẻ Cao Cấp';
UPDATE products SET image = 'ao-khoac-bomber-nam.jpg' WHERE name = 'Áo Khoác Bomber Nam Nữ';
UPDATE products SET image = 'ao-so-mi-nam.jpg' WHERE name = 'Áo Sơ Mi Nam Tay Dài Kẻ Sọc';
UPDATE products SET image = 'quan-kaki-nam.jpg' WHERE name = 'Quần Kaki Nam Dáng Slimfit';
UPDATE products SET image = 'quan-short-nam.jfif' WHERE name = 'Quần Short Jean Nữ Cạp Cao';
UPDATE products SET image = 'Quan-Bo-Nam.jpg' WHERE name = 'Quần Tây Nam Công Sở';
UPDATE products SET image = 'vay-ngan.png' WHERE name = 'Đầm Dự Tiệc Trễ Vai Chữ A';
UPDATE products SET image = 'vay-ngan-2.png' WHERE name = 'Chân Váy Xếp Ly Dáng Dài';
UPDATE products SET image = 'phu-kien-1.png' WHERE name = 'Túi Xách Da Đeo Chéo';
UPDATE products SET image = 'phu-kien-2.png' WHERE name = 'Thắt Lưng Nam Da Bò Thật';
UPDATE products SET image = 'phu-kien-3.png' WHERE name = 'Mũ Lưỡi Trai Unisex Trơn';

-- Cập nhật cho các sản phẩm cũ
UPDATE products SET image = 'ao-so-mi-nam.jpg' WHERE name = 'Áo Sơ Mi Trắng Nữ';
UPDATE products SET image = 'Quan-Bo-Nam.jpg' WHERE name = 'Quần Jeans Xanh';
UPDATE products SET image = 'vay-ngan-3.png' WHERE name = 'Váy Hoa Nhí';
UPDATE products SET image = 'polo.png' WHERE name = 'Áo Thun Basic Nam';

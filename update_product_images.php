<?php
// Script to update product images in database - run this in browser
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

// Update images for products
$updates = [
    'Áo Thun Polo Cổ Bẻ Cao Cấp' => 'polo.png',
    'Áo Khoác Bomber Nam Nữ' => 'ao-khoac-bomber-nam.jpg',
    'Áo Sơ Mi Nam Tay Dài Kẻ Sọc' => 'ao-so-mi-nam.jpg',
    'Quần Kaki Nam Dáng Slimfit' => 'quan-kaki-nam.jpg',
    'Quần Short Jean Nữ Cạp Cao' => 'quan-short-nam.jfif',
    'Quần Tây Nam Công Sở' => 'Quan-Bo-Nam.jpg',
    'Đầm Dự Tiệc Trễ Vai Chữ A' => 'vay-ngan.png',
    'Chân Váy Xếp Ly Dáng Dài' => 'vay-ngan-2.png',
    'Túi Xách Da Đeo Chéo' => 'phu-kien-1.png',
    'Thắt Lưng Nam Da Bò Thật' => 'phu-kien-2.png',
    'Mũ Lưỡi Trai Unisex Trơn' => 'phu-kien-3.png',
    'Áo Sơ Mi Trắng Nữ' => 'ao-so-mi-nam.jpg',
    'Quần Jeans Xanh' => 'Quan-Bo-Nam.jpg',
    'Váy Hoa Nhí' => 'vay-ngan-3.png',
    'Áo Thun Basic Nam' => 'polo.png',
];

echo "<h2>Updating Product Images</h2>";
echo "<ul>";

foreach ($updates as $name => $image) {
    $query = "UPDATE products SET image = :image WHERE name = :name";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    echo "<li>Updated: $name -> $image</li>";
}

echo "</ul>";
echo "<p><strong>Image update completed!</strong></p>";
echo "<p><a href='/shop_quan_ao/product'>View Products</a></p>";
?>

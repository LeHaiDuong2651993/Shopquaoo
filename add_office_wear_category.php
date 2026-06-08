<?php
// Script to add office wear category and products
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

echo "<h2>Thêm danh mục Đồ Công Sở</h2>";

// Check if category already exists
$checkQuery = "SELECT * FROM categories WHERE id = 3";
$checkStmt = $conn->prepare($checkQuery);
$checkStmt->execute();
$exists = $checkStmt->fetch(PDO::FETCH_ASSOC);

if ($exists) {
    echo "<div style='color:orange'>Danh mục ID 3 đã tồn tại. Cập nhật tên thành 'Đồ Công Sơ'...</div>";
    $updateQuery = "UPDATE categories SET name = 'Đồ Công Sơ', description = 'Trang phục công sở chuyên nghiệp, sang trọng' WHERE id = 3";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->execute();
    echo "<div style='color:green'>✓ Đã cập nhật danh mục</div>";
} else {
    echo "<div style='color:blue'>Thêm danh mục mới...</div>";
    $insertQuery = "INSERT INTO categories (id, name, description) VALUES (3, 'Đồ Công Sơ', 'Trang phục công sở chuyên nghiệp, sang trọng')";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->execute();
    echo "<div style='color:green'>✓ Đã thêm danh mục Đồ Công Sơ</div>";
}

// Add office wear products
echo "<h3>Thêm sản phẩm Đồ Công Sơ</h3>";

$products = [
    [
        'name' => 'Áo Sơ Mi Trắng Cao Cấp',
        'description' => 'Áo sơ mi trắng chất liệu cotton cao cấp, thiết kế thanh lịch phù hợp môi trường công sở',
        'price' => 450000,
        'category_id' => 3,
        'stock' => 50,
        'image' => 'ao-so-mi-nam.jpg'
    ],
    [
        'name' => 'Áo Sơ Mi Xanh Navy',
        'description' => 'Áo sơ mi màu xanh navy, form dáng chuẩn, phù hợp cho nam giới văn phòng',
        'price' => 480000,
        'category_id' => 3,
        'stock' => 45,
        'image' => 'ao-so-mi-nam.jpg'
    ],
    [
        'name' => 'Quần Tây đen Classic',
        'description' => 'Quần tây đen classic, chất liệu vải cao cấp, form dáng đứng dáng',
        'price' => 550000,
        'category_id' => 3,
        'stock' => 40,
        'image' => 'Quan-Bo-Nam.jpg'
    ],
    [
        'name' => 'Quần Tây Xám',
        'description' => 'Quần tây màu xám thanh lịch, phù hợp nhiều hoàn cảnh công sở',
        'price' => 520000,
        'category_id' => 3,
        'stock' => 35,
        'image' => 'quan-kaki-nam.jpg'
    ],
    [
        'name' => 'Áo Vest Đen',
        'description' => 'Áo vest đen thiết kế hiện đại, mang lại vẻ ngoài chuyên nghiệp',
        'price' => 1200000,
        'category_id' => 3,
        'stock' => 25,
        'image' => 'ao-khoac-bomber-nam.jpg'
    ],
    [
        'name' => 'Áo Vest Xám',
        'description' => 'Áo vest màu xám sang trọng, phù hợp cho các cuộc họp quan trọng',
        'price' => 1350000,
        'category_id' => 3,
        'stock' => 20,
        'image' => 'ao-khoac-bomber-nam.jpg'
    ],
    [
        'name' => 'Váy Công Sở Đen',
        'description' => 'Váy công sở đen thanh lịch, thiết kế kín đáo phù hợp môi trường văn phòng',
        'price' => 680000,
        'category_id' => 3,
        'stock' => 30,
        'image' => 'vay-ngan.png'
    ],
    [
        'name' => 'Váy Công Sở Xanh',
        'description' => 'Váy công sở màu xanh dương, thiết kế hiện đại và nữ tính',
        'price' => 720000,
        'category_id' => 3,
        'stock' => 28,
        'image' => 'vay-ngan-2.png'
    ]
];

$addedCount = 0;
foreach ($products as $product) {
    // Check if product already exists
    $checkProdQuery = "SELECT * FROM products WHERE name = ?";
    $checkProdStmt = $conn->prepare($checkProdQuery);
    $checkProdStmt->bindParam(1, $product['name']);
    $checkProdStmt->execute();
    
    if (!$checkProdStmt->fetch(PDO::FETCH_ASSOC)) {
        $insertProdQuery = "INSERT INTO products (name, description, price, category_id, stock, image, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $insertProdStmt = $conn->prepare($insertProdQuery);
        $insertProdStmt->bindParam(1, $product['name']);
        $insertProdStmt->bindParam(2, $product['description']);
        $insertProdStmt->bindParam(3, $product['price']);
        $insertProdStmt->bindParam(4, $product['category_id']);
        $insertProdStmt->bindParam(5, $product['stock']);
        $insertProdStmt->bindParam(6, $product['image']);
        
        if ($insertProdStmt->execute()) {
            $addedCount++;
            echo "<div style='color:green'>✓ Đã thêm: " . htmlspecialchars($product['name']) . "</div>";
        }
    } else {
        echo "<div style='color:orange'>⚠ Đã tồn tại: " . htmlspecialchars($product['name']) . "</div>";
    }
}

echo "<h3>Kết quả</h3>";
echo "<div style='color:green'>Đã thêm $addedCount sản phẩm Đồ Công Sơ</div>";
echo "<p><a href='/shop_quan_ao/product/category/3'>Xem danh mục Đồ Công Sơ</a></p>";
?>

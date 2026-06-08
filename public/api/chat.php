<?php
/**
 * Chat API Endpoint
 * Nhận tin nhắn từ chatbox, phân tích từ khóa, trả về phản hồi + gợi ý sản phẩm
 */
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// Load config & models
require_once '../../config/database.php';
require_once '../../models/Product.php';

$input = json_decode(file_get_contents('php://input'), true);
$message = strtolower(trim($input['message'] ?? ''));

if (empty($message)) {
    echo json_encode(['reply' => 'Xin chào! Tôi có thể giúp gì cho bạn?', 'products' => []]);
    exit;
}

$productModel = new Product();

// --- Phân tích từ khóa & sinh phản hồi ---
$reply = '';
$products = [];

// Chào hỏi
if (preg_match('/\b(xin chào|hello|hi|chào|hey)\b/', $message)) {
    $reply = 'Xin chào! 👋 Chào mừng bạn đến với StyleShop. Tôi có thể giúp bạn tìm sản phẩm, hỏi về giá, hoặc tư vấn trang phục. Bạn cần gì nào?';
}
// Áo
elseif (preg_match('/\b(áo|shirt|thun|sơ mi|polo|hoodie|khoác|jacket)\b/', $message)) {
    $reply = '👕 Dưới đây là một số áo nổi bật tại StyleShop:';
    $products = $productModel->search('áo');
    if (empty($products)) $products = $productModel->search('shirt');
}
// Quần
elseif (preg_match('/\b(quần|jean|short|jogger|tây)\b/', $message)) {
    $reply = '👖 Đây là những mẫu quần đang hot tại StyleShop:';
    $products = $productModel->search('quần');
}
// Váy / đầm
elseif (preg_match('/\b(váy|đầm|dress|skirt)\b/', $message)) {
    $reply = '👗 Các mẫu váy đầm nữ tính đang có tại cửa hàng:';
    $products = $productModel->search('váy');
    if (empty($products)) $products = $productModel->search('đầm');
}
// Phụ kiện
elseif (preg_match('/\b(phụ kiện|mũ|nón|túi|thắt lưng|accessory)\b/', $message)) {
    $reply = '✨ Phụ kiện thời trang tại StyleShop:';
    $products = $productModel->search('phụ kiện');
}
// Giá / rẻ / sale
elseif (preg_match('/\b(giá|bao nhiêu|rẻ|sale|giảm giá|khuyến mãi|cheap)\b/', $message)) {
    $reply = '💰 Dưới đây là các sản phẩm đang có mức giá tốt nhất:';
    $products = $productModel->readAll(6);
    usort($products, fn($a, $b) => $a['price'] - $b['price']);
}
// Mới nhất
elseif (preg_match('/\b(mới|new|mới nhất|hàng mới|trending)\b/', $message)) {
    $reply = '🆕 Sản phẩm mới về tuần này tại StyleShop:';
    $products = $productModel->readAll(6);
}
// Gợi ý / tư vấn
elseif (preg_match('/\b(gợi ý|tư vấn|recommend|suggest|chọn|mặc gì)\b/', $message)) {
    $reply = '⭐ Đây là những sản phẩm được yêu thích nhất hiện tại:';
    $products = $productModel->readAll(6);
    shuffle($products);
}
// Tìm theo tên sản phẩm
else {
    $products = $productModel->search($message);
    if (!empty($products)) {
        $reply = '🔍 Tôi tìm thấy ' . count($products) . ' sản phẩm phù hợp với "' . htmlspecialchars($input['message']) . '":';
    } else {
        $reply = '😊 Xin lỗi, tôi chưa tìm thấy sản phẩm phù hợp. Bạn thử hỏi về: **áo**, **quần**, **váy**, **phụ kiện**, hoặc **hàng mới** nhé!';
    }
}

// Giới hạn 4 sản phẩm gợi ý
$products = array_slice($products, 0, 4);

// Chuẩn hóa dữ liệu trả về
$productData = array_map(function($p) {
    return [
        'id'    => $p['id'],
        'name'  => $p['name'],
        'price' => number_format($p['price'], 0, ',', '.') . ' đ',
        'image' => !empty($p['image']) ? '/shop_quan_ao/public/uploads/' . $p['image'] : null,
        'url'   => '/shop_quan_ao/product/detail/' . $p['id'],
    ];
}, $products);

echo json_encode([
    'reply'    => $reply,
    'products' => $productData
], JSON_UNESCAPED_UNICODE);

<?php require_once 'views/layouts/header.php'; ?>

<style>
/* Custom Styles for Home */
.hero-banner {
    position: relative;
    height: 80vh;
    min-height: 600px;
    background: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
}
.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
}
.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: #fff;
    max-width: 800px;
    padding: 0 20px;
}
.hero-title {
    font-size: 4rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 20px;
    animation: fadeInUp 1s ease;
}
.hero-subtitle {
    font-size: 1.2rem;
    font-weight: 300;
    margin-bottom: 30px;
    animation: fadeInUp 1s ease 0.2s;
    animation-fill-mode: both;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Marquee */
.marquee-container {
    background: #0a0a0a;
    color: #ff3b30;
    padding: 10px 0;
    overflow: hidden;
    white-space: nowrap;
    position: relative;
}
.marquee-content {
    display: inline-block;
    animation: marquee 20s linear infinite;
}
.marquee-content span {
    margin: 0 40px;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-size: 0.85rem;
}
@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* Editorial Category */
.editorial-card {
    position: relative;
    overflow: hidden;
    height: 450px;
    cursor: pointer;
}
.editorial-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
.editorial-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 50%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 30px;
}
.editorial-card:hover img {
    transform: scale(1.08);
}
.editorial-title {
    color: #fff;
    font-size: 2rem;
    margin-bottom: 10px;
    transform: translateY(20px);
    transition: transform 0.4s ease;
}
.editorial-card:hover .editorial-title {
    transform: translateY(0);
}
.editorial-btn {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease;
    align-self: flex-start;
    color: #fff;
    border-bottom: 1px solid #fff;
    padding-bottom: 3px;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 1px;
}
.editorial-card:hover .editorial-btn {
    opacity: 1;
    transform: translateY(0);
    transition-delay: 0.1s;
}

/* Lookbook */
.lookbook-section {
    background: #fbfbfb;
    padding: 80px 0;
}
.lookbook-img {
    height: 500px;
    width: 100%;
    object-fit: cover;
}
</style>

<!-- Marquee -->
<div class="marquee-container">
    <div class="marquee-content">
        <span><i class="fa-solid fa-truck-fast me-2"></i>Miễn phí giao hàng đơn từ 500k</span>
        <span><i class="fa-solid fa-rotate-left me-2"></i>Đổi trả miễn phí trong 7 ngày</span>
        <span><i class="fa-solid fa-star me-2"></i>Thiết kế độc quyền & Chất liệu cao cấp</span>
        <span><i class="fa-solid fa-gift me-2"></i>Thành viên mới giảm ngay 15%</span>
        <!-- Duplicate for infinite scroll -->
        <span><i class="fa-solid fa-truck-fast me-2"></i>Miễn phí giao hàng đơn từ 500k</span>
        <span><i class="fa-solid fa-rotate-left me-2"></i>Đổi trả miễn phí trong 7 ngày</span>
        <span><i class="fa-solid fa-star me-2"></i>Thiết kế độc quyền & Chất liệu cao cấp</span>
        <span><i class="fa-solid fa-gift me-2"></i>Thành viên mới giảm ngay 15%</span>
    </div>
</div>

<!-- Hero Banner -->
<div class="hero-banner">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="brand-font hero-title">Bộ Sưu Tập<br>Thu Đông 2026</h1>
        <p class="hero-subtitle">Định hình phong cách cá nhân với những thiết kế tinh tế, tối giản nhưng đậm chất hiện đại. Trải nghiệm sự sang trọng trong từng thớ vải.</p>
        <a href="/shop_quan_ao/product" class="btn btn-premium bg-white text-bright mt-3" style="font-size: 1rem; padding: 12px 30px;">Khám Phá Ngay</a>
    </div>
</div>

<div class="container my-5 py-5">
    <!-- Featured Products Section -->
    <div class="text-center mb-5">
        <h2 class="brand-font fw-bold mb-3">Sản Phẩm Nổi Bật</h2>
        <div style="width: 50px; height: 2px; background-color: var(--primary-color); margin: 0 auto;"></div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
        <?php if(!empty($data['products'])): ?>
            <?php foreach($data['products'] as $product): ?>
            <div class="col">
                <div class="card product-card shadow-none">
                    <div class="product-img-wrap">
                        <a href="/shop_quan_ao/product/detail/<?php echo $product['id']; ?>">
                            <?php $imgSrc = !empty($product['image']) ? '/shop_quan_ao/public/uploads/' . $product['image'] : 'https://via.placeholder.com/300x400.png?text=No+Image'; ?>
                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </a>
                    </div>
                    <div class="card-body px-0 py-3">
                        <h5 class="card-title fw-bold fs-6 mb-1 text-truncate">
                            <a href="/shop_quan_ao/product/detail/<?php echo $product['id']; ?>" class="text-decoration-none text-dark"><?php echo htmlspecialchars($product['name']); ?></a>
                        </h5>
                        <p class="card-text text-muted small mb-2 text-truncate"><?php echo htmlspecialchars(substr($product['description'], 0, 50)) . '...'; ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price-tag"><?php echo number_format($product['price'], 0, ',', '.'); ?> đ</span>
                            <a href="/shop_quan_ao/cart/add/<?php echo $product['id']; ?>" class="btn btn-outline-dark btn-sm rounded-circle" style="width: 35px; height: 35px; padding: 0; display: inline-flex; align-items: center; justify-content: center;" title="Thêm vào giỏ hàng">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">Chưa có sản phẩm nào.</p>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="text-center mb-5">
        <a href="/shop_quan_ao/product" class="btn btn-outline-premium">Xem Tất Cả Sản Phẩm</a>
    </div>
</div>

<!-- Editorial Categories -->
<div class="container-fluid px-0 mb-5 pb-5">
    <div class="text-center mb-5">
        <h2 class="brand-font fw-bold mb-3">Phong Cách & Danh Mục</h2>
        <div style="width: 50px; height: 2px; background-color: var(--primary-color); margin: 0 auto;"></div>
    </div>
    <div class="row g-0">
        <?php 
        $defaultImages = [
            'https://lapier.vn/wp-content/uploads/2023/05/web-293-scaled.jpg', // Áo (Shirts)
            'https://hmkeyewear.com/wp-content/uploads/2024/10/phu-kien-thoi-trang-8.jpg', // Quần (Pants)
            'https://down-vn.img.susercontent.com/file/sg-11134201-7rdxq-m1cidx84cpy51a_tn', // Váy (Dresses)
            'https://kenh14cdn.com/203336854389633024/2026/5/19/8-17790855677191207998485-1779089219860-17790892199931549452816-1779177420549-17791774208401456695225.jpg' // Phụ kiện (Accessories)
        ];
        ?>
        <?php foreach ($data['categories'] as $index => $category): ?>
        <div class="col-md-6 col-lg-3">
            <div class="editorial-card">
                <img src="<?php echo $defaultImages[$index % count($defaultImages)]; ?>" alt="<?php echo htmlspecialchars($category['name']); ?>">
                <div class="editorial-overlay">
                    <h3 class="brand-font editorial-title"><?php echo htmlspecialchars($category['name']); ?></h3>
                    <a href="/shop_quan_ao/product/category/<?php echo $category['id']; ?>" class="editorial-btn">Mua sắm ngay</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Lookbook / CTA Section -->
<div class="lookbook-section mb-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6 order-2 order-md-1">
                <h2 class="brand-font display-5 fw-bold mb-4">Elegance is an attitude</h2>
                <p class="text-muted fs-5 mb-4" style="line-height: 1.8;">Tạo điểm nhấn riêng biệt cho những buổi dạo phố cuối tuần với các set đồ mang âm hưởng cổ điển pha lẫn vẻ đẹp đương đại. Khám phá cách phối đồ hoàn hảo của chúng tôi.</p>
                <a href="/shop_quan_ao/product" class="btn btn-premium mt-2">Khám Phá Lookbook</a>
            </div>
            <div class="col-md-6 order-1 order-md-2">
                <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=2070&auto=format&fit=crop" alt="Lookbook" class="lookbook-img shadow-lg" style="border-radius: 0 40px 0 40px;">
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>

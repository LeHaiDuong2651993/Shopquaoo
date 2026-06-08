<?php require_once 'views/layouts/header.php'; ?>

<div class="container mb-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/shop_quan_ao/">Trang Chủ</a></li>
            <?php if (isset($data['category'])): ?>
                <li class="breadcrumb-item"><a href="/shop_quan_ao/product">Sản Phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($data['category']['name']); ?></li>
            <?php elseif (isset($data['search_query'])): ?>
                <li class="breadcrumb-item"><a href="/shop_quan_ao/product">Sản Phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tìm kiếm: "<?php echo htmlspecialchars($data['search_query']); ?>"</li>
            <?php else: ?>
                <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm</li>
            <?php endif; ?>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            <?php 
                if (isset($data['category'])) echo "Danh mục: " . htmlspecialchars($data['category']['name']);
                elseif (isset($data['search_query'])) echo "Kết quả tìm kiếm cho '" . htmlspecialchars($data['search_query']) . "'";
                else echo "Tất cả Sản Phẩm";
            ?>
        </h2>
        <span class="text-muted"><?php echo count($data['products']); ?> sản phẩm</span>
    </div>

    <?php if (empty($data['products'])): ?>
        <div class="alert alert-info text-center p-5 rounded-4 border-0">
            <i class="fa-solid fa-box-open fs-1 mb-3 text-secondary"></i>
            <h4>Không tìm thấy sản phẩm nào</h4>
            <p>Vui lòng thử danh mục hoặc từ khóa khác.</p>
            <a href="/shop_quan_ao/product" class="btn btn-primary mt-2">Xem tất cả sản phẩm</a>
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach($data['products'] as $product): ?>
            <div class="col">
                <div class="card product-card h-100 shadow-sm border-0">
                    <a href="/shop_quan_ao/product/detail/<?php echo $product['id']; ?>" class="text-decoration-none text-dark h-100 d-flex flex-column">
                        <div class="product-img-wrap">
                            <?php 
                                $imgSrc = !empty($product['image']) ? '/shop_quan_ao/public/uploads/' . $product['image'] : 'https://via.placeholder.com/300x400.png?text=No+Image';
                            ?>
                            <img src="<?php echo $imgSrc; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold fs-6 mb-2"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text text-muted small mb-3 text-truncate"><?php echo htmlspecialchars($product['description'] ?? ''); ?></p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="price-tag"><?php echo number_format($product['price'], 0, ',', '.'); ?> đ</span>
                                <object><a href="/shop_quan_ao/cart/add/<?php echo $product['id']; ?>" class="btn btn-outline-primary btn-sm rounded-circle" style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;" title="Thêm vào giỏ hàng">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </a></object>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'views/layouts/footer.php'; ?>

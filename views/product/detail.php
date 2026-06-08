<?php require_once 'views/layouts/header.php'; ?>
<?php $product = $data['product']; ?>

<div class="container mb-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/shop_quan_ao/">Trang Chủ</a></li>
            <li class="breadcrumb-item"><a href="/shop_quan_ao/product">Sản Phẩm</a></li>
            <?php if (!empty($product['category_name'])): ?>
                <li class="breadcrumb-item"><a href="/shop_quan_ao/product/category/<?php echo $product['category_id']; ?>"><?php echo htmlspecialchars($product['category_name']); ?></a></li>
            <?php endif; ?>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['name']); ?></li>
        </ol>
    </nav>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-4" style="min-height: 400px;">
                <?php 
                    $imgSrc = !empty($product['image']) ? '/shop_quan_ao/public/uploads/' . $product['image'] : 'https://via.placeholder.com/600x600.png?text=No+Image';
                ?>
                <img src="<?php echo $imgSrc; ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-height: 500px; object-fit: contain;">
            </div>
            <div class="col-md-7">
                <div class="card-body p-5">
                    <h1 class="card-title fw-bold mb-3"><?php echo htmlspecialchars($product['name']); ?></h1>
                    
                    <div class="mb-4">
                        <span class="fs-3 fw-bold text-danger"><?php echo number_format($product['price'], 0, ',', '.'); ?> đ</span>
                        <?php if ($product['stock'] > 0): ?>
                            <span class="badge bg-success ms-3 rounded-pill px-3 py-2">Còn hàng (<?php echo $product['stock']; ?>)</span>
                        <?php else: ?>
                            <span class="badge bg-danger ms-3 rounded-pill px-3 py-2">Hết hàng</span>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">Mô tả sản phẩm:</h6>
                        <p class="text-muted" style="line-height: 1.8;">
                            <?php echo nl2br(htmlspecialchars($product['description'] ?? 'Chưa có mô tả.')); ?>
                        </p>
                    </div>

                    <form action="/shop_quan_ao/cart/add/<?php echo $product['id']; ?>" method="POST" class="mt-4">
                        <div class="row align-items-center g-3 mb-4">
                            <div class="col-auto">
                                <label for="quantity" class="col-form-label fw-bold">Số lượng:</label>
                            </div>
                            <div class="col-auto">
                                <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" max="<?php echo max(1, $product['stock']); ?>" style="width: 100px;">
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-bold" <?php echo $product['stock'] <= 0 ? 'disabled' : ''; ?>>
                                <i class="fa-solid fa-cart-shopping me-2"></i> Thêm Vào Giỏ Hàng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>

<?php require_once 'views/layouts/header.php'; ?>

<div class="container mb-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/shop_quan_ao/">Trang Chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giỏ Hàng</li>
        </ol>
    </nav>

    <h2 class="fw-bold mb-4">Giỏ Hàng Của Bạn</h2>

    <?php if (empty($data['cartItems'])): ?>
        <div class="alert alert-info text-center p-5 rounded-4 border-0">
            <i class="fa-solid fa-cart-shopping fs-1 mb-3 text-secondary"></i>
            <h4>Giỏ hàng của bạn đang trống</h4>
            <p>Hãy khám phá thêm các sản phẩm tuyệt vời của chúng tôi nhé!</p>
            <a href="/shop_quan_ao/product" class="btn btn-primary mt-2">Tiếp Tục Mua Sắm</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <form id="cartForm" action="/shop_quan_ao/cart/update" method="POST">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 50%;">Sản Phẩm</th>
                                            <th scope="col" class="text-center">Đơn Giá</th>
                                            <th scope="col" class="text-center" style="width: 15%;">Số Lượng</th>
                                            <th scope="col" class="text-end">Tạm Tính</th>
                                            <th scope="col" class="text-center">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php foreach ($data['cartItems'] as $item): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <?php $imgSrc = !empty($item['image']) ? '/shop_quan_ao/public/uploads/' . $item['image'] : 'https://via.placeholder.com/80x80.png?text=No+Image'; ?>
                                                        <img src="<?php echo $imgSrc; ?>" class="rounded" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 60px; height: 60px; object-fit: cover;">
                                                        <div class="ms-3">
                                                            <h6 class="mb-0 fw-bold">
                                                                <a href="/shop_quan_ao/product/detail/<?php echo $item['id']; ?>" class="text-decoration-none text-dark">
                                                                    <?php echo htmlspecialchars($item['name']); ?>
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center text-muted"><?php echo number_format($item['price'], 0, ',', '.'); ?> đ</td>
                                                <td class="text-center">
                                                    <!-- Thêm class cart-qty-input để target bằng JS nếu cần -->
                                                    <input type="number" name="quantities[<?php echo $item['id']; ?>]" class="form-control form-control-sm text-center cart-qty-input" value="<?php echo $item['quantity']; ?>" min="1" max="<?php echo $item['stock'] > 0 ? $item['stock'] : 1; ?>">
                                                </td>
                                                <td class="text-end fw-bold text-danger"><?php echo number_format($item['subtotal'], 0, ',', '.'); ?> đ</td>
                                                <td class="text-center">
                                                    <a href="/shop_quan_ao/cart/remove/<?php echo $item['id']; ?>" class="text-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="/shop_quan_ao/product" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-2"></i>Tiếp Tục Mua Sắm</a>
                                <div>
                                    <a href="/shop_quan_ao/cart/clear" class="btn btn-outline-danger me-2" onclick="return confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm?');">Xóa Tất Cả</a>
                                    <button type="submit" name="update_cart" class="btn btn-outline-primary"><i class="fa-solid fa-rotate-right me-2"></i>Cập Nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Tóm Tắt Đơn Hàng</h5>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Tổng phụ</span>
                            <span class="fw-bold"><?php echo number_format($data['total'], 0, ',', '.'); ?> đ</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Giao hàng</span>
                            <span class="fw-bold text-success">Miễn phí</span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fs-5 fw-bold">Tổng Cộng</span>
                            <span class="fs-4 fw-bold text-danger"><?php echo number_format($data['total'], 0, ',', '.'); ?> đ</span>
                        </div>
                        
                        <a href="/shop_quan_ao/checkout" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold">Tiến Hành Thanh Toán <i class="fa-solid fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Script tự động submit form khi đổi số lượng (Tùy chọn) -->
<script>
document.querySelectorAll('.cart-qty-input').forEach(input => {
    input.addEventListener('change', function() {
        // Kiểm tra giá trị hợp lệ trước khi tự submit
        if(this.value < 1) this.value = 1;
        document.getElementById('cartForm').submit();
    });
});
</script>

<?php require_once 'views/layouts/footer.php'; ?>
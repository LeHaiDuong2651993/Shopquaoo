<?php require_once 'views/layouts/header.php'; ?>

<div class="container mb-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/shop_quan_ao/">Trang Chủ</a></li>
            <li class="breadcrumb-item"><a href="/shop_quan_ao/cart">Giỏ Hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thanh Toán</li>
        </ol>
    </nav>

    <h2 class="fw-bold mb-4">Thanh Toán Đơn Hàng</h2>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Thông Tin Giao Hàng</h5>
                    
                    <form action="/shop_quan_ao/checkout/process" method="POST" id="checkoutForm">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium">Họ và tên người nhận</label>
                            <input type="text" class="form-control" id="name" value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-medium">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required placeholder="Nhập số điện thoại của bạn">
                        </div>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label fw-medium">Địa chỉ giao hàng chi tiết</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required placeholder="Ví dụ: Số nhà, Tên đường, Phường/Xã, Quận/Huyện, Tỉnh/Thành phố"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="note" class="form-label fw-medium">Ghi chú cho đơn hàng (Tùy chọn)</label>
                            <textarea class="form-control" id="note" name="note" rows="2" placeholder="Ghi chú thêm về thời gian giao hàng, chỉ đường..."></textarea>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Phương Thức Thanh Toán</h5>
                    
                    <div class="form-check border rounded p-3 mb-3 bg-light">
                        <input class="form-check-input ms-1" type="radio" name="payment_method" id="paymentCOD" value="cod" checked form="checkoutForm">
                        <label class="form-check-label ms-2 fw-medium w-100 cursor-pointer" for="paymentCOD">
                            <i class="fa-solid fa-money-bill-wave text-success me-2"></i> Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>
                    
                    <div class="form-check border rounded p-3 mb-3">
                        <input class="form-check-input ms-1" type="radio" name="payment_method" id="paymentBank" value="bank" disabled form="checkoutForm">
                        <label class="form-check-label ms-2 fw-medium w-100 text-muted" for="paymentBank">
                            <i class="fa-solid fa-building-columns text-primary me-2"></i> Chuyển khoản ngân hàng (Đang bảo trì)
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 90px; z-index: 1;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Đơn Hàng Của Bạn (<?php echo count($data['cartItems']); ?> sản phẩm)</h5>
                    
                    <div class="d-flex flex-column gap-3 mb-4 max-h-300 overflow-auto pr-2">
                        <?php foreach ($data['cartItems'] as $item): ?>
                            <div class="d-flex align-items-center">
                                <?php $imgSrc = !empty($item['image']) ? '/shop_quan_ao/public/uploads/' . $item['image'] : 'https://via.placeholder.com/60x60.png?text=Img'; ?>
                                <img src="<?php echo $imgSrc; ?>" class="rounded border" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 60px; height: 60px; object-fit: cover;">
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-1 text-truncate" style="max-width: 200px;"><?php echo htmlspecialchars($item['name']); ?></h6>
                                    <small class="text-muted">SL: <?php echo $item['quantity']; ?> x <?php echo number_format($item['price'], 0, ',', '.'); ?> đ</small>
                                </div>
                                <div class="fw-bold text-end">
                                    <?php echo number_format($item['subtotal'], 0, ',', '.'); ?> đ
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tạm tính</span>
                        <span class="fw-medium"><?php echo number_format($data['total'], 0, ',', '.'); ?> đ</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Phí giao hàng</span>
                        <span class="fw-medium text-success">Miễn phí</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4 border-top pt-3">
                        <span class="fs-5 fw-bold">Tổng Cộng</span>
                        <span class="fs-4 fw-bold text-danger"><?php echo number_format($data['total'], 0, ',', '.'); ?> đ</span>
                    </div>
                    
                    <button type="submit" form="checkoutForm" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold">
                        Hoàn Tất Đặt Hàng <i class="fa-solid fa-check ms-2"></i>
                    </button>
                    
                    <div class="text-center mt-3">
                        <a href="/shop_quan_ao/cart" class="text-decoration-none text-muted small"><i class="fa-solid fa-arrow-left me-1"></i> Quay lại giỏ hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>

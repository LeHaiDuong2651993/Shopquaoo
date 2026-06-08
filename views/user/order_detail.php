<?php require_once 'views/layouts/header.php'; ?>

<div class="container mb-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/shop_quan_ao/">Trang Chủ</a></li>
            <li class="breadcrumb-item"><a href="/shop_quan_ao/user/orders">Đơn Hàng Của Tôi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi Tiết Đơn Hàng #<?php echo str_pad($data['order']['id'], 5, '0', STR_PAD_LEFT); ?></li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Chi Tiết Đơn Hàng #<?php echo str_pad($data['order']['id'], 5, '0', STR_PAD_LEFT); ?></h3>
        <a href="/shop_quan_ao/user/orders" class="btn btn-outline-secondary rounded-pill"><i class="fa-solid fa-arrow-left me-2"></i>Quay lại danh sách</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3">Danh Sách Sản Phẩm</h5>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="py-3 px-4 rounded-start">Sản phẩm</th>
                                    <th scope="col" class="py-3 text-center">Đơn giá</th>
                                    <th scope="col" class="py-3 text-center">Số lượng</th>
                                    <th scope="col" class="py-3 px-4 rounded-end text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['items'] as $item): ?>
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <?php $imgSrc = !empty($item['image']) ? '/shop_quan_ao/public/uploads/' . $item['image'] : 'https://via.placeholder.com/60x60.png?text=Img'; ?>
                                                <img src="<?php echo $imgSrc; ?>" class="rounded border" alt="<?php echo htmlspecialchars($item['product_name']); ?>" style="width: 60px; height: 60px; object-fit: cover;">
                                                <div class="ms-3">
                                                    <h6 class="mb-0 fw-medium"><a href="/shop_quan_ao/product/detail/<?php echo $item['product_id']; ?>" class="text-decoration-none text-dark"><?php echo htmlspecialchars($item['product_name']); ?></a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center text-muted"><?php echo number_format($item['price'], 0, ',', '.'); ?> đ</td>
                                        <td class="text-center"><?php echo $item['quantity']; ?></td>
                                        <td class="px-4 text-end fw-bold text-danger"><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?> đ</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-group-divider">
                                <tr>
                                    <td colspan="3" class="px-4 text-end py-3 text-muted">Tổng phụ</td>
                                    <td class="px-4 text-end fw-medium"><?php echo number_format($data['order']['total_amount'], 0, ',', '.'); ?> đ</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="px-4 text-end py-3 text-muted">Phí giao hàng</td>
                                    <td class="px-4 text-end fw-medium text-success">Miễn phí</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="px-4 text-end py-3 fs-5 fw-bold">Tổng Cộng</td>
                                    <td class="px-4 text-end fs-5 fw-bold text-danger"><?php echo number_format($data['order']['total_amount'], 0, ',', '.'); ?> đ</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 pb-2 border-bottom">Trạng Thái Đơn Hàng</h5>
                    <?php 
                        $statusClass = 'bg-warning text-dark';
                        $statusText = 'Chờ xử lý';
                        if ($data['order']['status'] == 'processing') { $statusClass = 'bg-info text-dark'; $statusText = 'Đang chuẩn bị hàng'; }
                        if ($data['order']['status'] == 'shipping') { $statusClass = 'bg-primary'; $statusText = 'Đang giao hàng'; }
                        if ($data['order']['status'] == 'completed') { $statusClass = 'bg-success'; $statusText = 'Hoàn thành'; }
                        if ($data['order']['status'] == 'cancelled') { $statusClass = 'bg-danger'; $statusText = 'Đã hủy'; }
                    ?>
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge <?php echo $statusClass; ?> rounded-pill px-3 py-2 fs-6 me-3"><?php echo $statusText; ?></span>
                        <span class="text-muted small">Cập nhật lúc: <?php echo date('d/m/Y H:i', strtotime($data['order']['created_at'])); ?></span>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 pb-2 border-bottom">Thông Tin Giao Hàng</h5>
                    <div class="mb-3">
                        <span class="text-muted d-block small mb-1">Người nhận:</span>
                        <span class="fw-medium"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted d-block small mb-1">Số điện thoại:</span>
                        <span class="fw-medium"><?php echo htmlspecialchars($data['order']['phone']); ?></span>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted d-block small mb-1">Địa chỉ:</span>
                        <span class="fw-medium"><?php echo htmlspecialchars($data['order']['shipping_address']); ?></span>
                    </div>
                    <?php if (!empty($data['order']['note'])): ?>
                    <div class="mb-3">
                        <span class="text-muted d-block small mb-1">Ghi chú:</span>
                        <span class="fw-medium"><?php echo htmlspecialchars($data['order']['note']); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="mb-0">
                        <span class="text-muted d-block small mb-1">Phương thức thanh toán:</span>
                        <span class="fw-medium">Thanh toán khi nhận hàng (COD)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>

<?php require_once 'views/layouts/header.php'; ?>

<div class="container mb-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/shop_quan_ao/">Trang Chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tài Khoản</li>
            <li class="breadcrumb-item active" aria-current="page">Đơn Hàng Của Tôi</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2.5rem;">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <h5 class="fw-bold"><?php echo htmlspecialchars($_SESSION['username']); ?></h5>
                    </div>
                    <div class="list-group list-group-flush border-top pt-3">
                        <a href="/shop_quan_ao/user/orders" class="list-group-item list-group-item-action active rounded border-0 mb-2 fw-medium"><i class="fa-solid fa-box text-white me-2"></i> Đơn hàng của tôi</a>
                        <a href="/shop_quan_ao/user/logout" class="list-group-item list-group-item-action text-danger rounded border-0 fw-medium"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <h4 class="fw-bold mb-4">Lịch Sử Đơn Hàng</h4>

                    <?php if (empty($data['orders'])): ?>
                        <div class="alert alert-info text-center p-5 rounded-4 border-0">
                            <i class="fa-solid fa-box-open fs-1 mb-3 text-secondary"></i>
                            <h5>Bạn chưa có đơn hàng nào</h5>
                            <p class="text-muted">Hãy mua sắm để lấp đầy lịch sử đơn hàng của bạn nhé!</p>
                            <a href="/shop_quan_ao/product" class="btn btn-primary mt-2 rounded-pill px-4">Bắt đầu mua sắm</a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="py-3 px-4 rounded-start">Mã ĐH</th>
                                        <th scope="col" class="py-3">Ngày đặt</th>
                                        <th scope="col" class="py-3">Tổng tiền</th>
                                        <th scope="col" class="py-3">Trạng thái</th>
                                        <th scope="col" class="py-3 px-4 rounded-end text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['orders'] as $order): ?>
                                        <tr>
                                            <td class="px-4 fw-medium text-primary">#<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                                            <td class="fw-bold text-danger"><?php echo number_format($order['total_amount'], 0, ',', '.'); ?> đ</td>
                                            <td>
                                                <?php 
                                                    $statusClass = 'bg-warning text-dark';
                                                    $statusText = 'Chờ xử lý';
                                                    if ($order['status'] == 'processing') { $statusClass = 'bg-info text-dark'; $statusText = 'Đang chuẩn bị hàng'; }
                                                    if ($order['status'] == 'shipping') { $statusClass = 'bg-primary'; $statusText = 'Đang giao hàng'; }
                                                    if ($order['status'] == 'completed') { $statusClass = 'bg-success'; $statusText = 'Hoàn thành'; }
                                                    if ($order['status'] == 'cancelled') { $statusClass = 'bg-danger'; $statusText = 'Đã hủy'; }
                                                ?>
                                                <span class="badge <?php echo $statusClass; ?> rounded-pill px-3 py-2"><?php echo $statusText; ?></span>
                                            </td>
                                            <td class="px-4 text-center">
                                                <a href="/shop_quan_ao/user/orderDetail/<?php echo $order['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">Xem chi tiết</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>

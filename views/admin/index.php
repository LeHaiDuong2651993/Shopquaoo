<?php require_once 'views/layouts/header.php'; ?>

<div class="container-fluid mb-5">
    <div class="row">
        <?php require_once 'views/layouts/admin_sidebar.php'; ?>

        <!-- Admin Content -->
        <div class="col-md-9 col-lg-9 ms-sm-auto px-md-4 mt-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h2 class="fw-bold">Tổng quan Dashboard</h2>
            </div>

            <!-- Stats cards -->
            <div class="row g-4 mb-5">
                <div class="col-sm-6 col-xl-3">
                    <div class="card stat-card bg-white h-100">
                        <div class="card-body p-4 position-relative overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-uppercase fw-bold m-0" style="color: var(--text-muted); font-size: 0.8rem; letter-spacing: 1px;">Doanh thu</h6>
                                <div class="p-2 rounded-circle" style="background: rgba(212, 175, 55, 0.1);">
                                    <i class="fa-solid fa-dollar-sign fs-4" style="color: var(--accent-color);"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-0" style="color: var(--primary-color);"><?php echo number_format($data['total_revenue'], 0, ',', '.'); ?> đ</h3>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6 col-xl-3">
                    <div class="card stat-card bg-white h-100">
                        <div class="card-body p-4 position-relative overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-uppercase fw-bold m-0" style="color: var(--text-muted); font-size: 0.8rem; letter-spacing: 1px;">Tổng đơn hàng</h6>
                                <div class="p-2 rounded-circle" style="background: rgba(15, 23, 42, 0.05);">
                                    <i class="fa-solid fa-bag-shopping fs-4" style="color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-0" style="color: var(--primary-color);"><?php echo $data['orders_count']; ?></h3>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card stat-card bg-white h-100">
                        <div class="card-body p-4 position-relative overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-uppercase fw-bold m-0" style="color: var(--text-muted); font-size: 0.8rem; letter-spacing: 1px;">Sản phẩm</h6>
                                <div class="p-2 rounded-circle" style="background: rgba(15, 23, 42, 0.05);">
                                    <i class="fa-solid fa-shirt fs-4" style="color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-0" style="color: var(--primary-color);"><?php echo $data['products_count']; ?></h3>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card stat-card bg-white h-100">
                        <div class="card-body p-4 position-relative overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-uppercase fw-bold m-0" style="color: var(--text-muted); font-size: 0.8rem; letter-spacing: 1px;">Khách hàng</h6>
                                <div class="p-2 rounded-circle" style="background: rgba(15, 23, 42, 0.05);">
                                    <i class="fa-solid fa-users fs-4" style="color: var(--primary-color);"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-0" style="color: var(--primary-color);"><?php echo $data['users_count']; ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card stat-card bg-white">
                <div class="card-header bg-white border-0 p-4 pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 brand-font">Đơn hàng gần đây</h5>
                    <a href="/shop_quan_ao/admin/orders" class="btn btn-sm btn-outline-premium">Xem tất cả</a>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap">
                            <thead class="text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px; color: var(--text-muted);">
                                <tr>
                                    <th scope="col" class="py-3 border-0 px-4">Mã ĐH</th>
                                    <th scope="col" class="py-3 border-0">Khách hàng</th>
                                    <th scope="col" class="py-3 border-0">Ngày đặt</th>
                                    <th scope="col" class="py-3 border-0">Tổng tiền</th>
                                    <th scope="col" class="py-3 border-0 text-end px-4">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                <?php foreach ($data['recent_orders'] as $order): ?>
                                    <tr>
                                        <td class="px-4 py-3 fw-bold" style="color: var(--primary-color);">#<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></td>
                                        <td class="py-3"><?php echo htmlspecialchars($order['username']); ?></td>
                                        <td class="py-3 text-muted"><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></td>
                                        <td class="py-3 fw-bold"><?php echo number_format($order['total_amount'], 0, ',', '.'); ?> đ</td>
                                        <td class="px-4 py-3 text-end">
                                            <?php 
                                                $statusStyle = 'background: #f1f5f9; color: #475569;';
                                                $statusText = 'Chờ xử lý';
                                                if ($order['status'] == 'processing') { $statusStyle = 'background: #e0f2fe; color: #0369a1;'; $statusText = 'Đang chuẩn bị'; }
                                                if ($order['status'] == 'shipping') { $statusStyle = 'background: #fef3c7; color: #b45309;'; $statusText = 'Đang giao'; }
                                                if ($order['status'] == 'completed') { $statusStyle = 'background: #dcfce7; color: #15803d;'; $statusText = 'Hoàn thành'; }
                                                if ($order['status'] == 'cancelled') { $statusStyle = 'background: #fee2e2; color: #b91c1c;'; $statusText = 'Đã hủy'; }
                                            ?>
                                            <span class="badge rounded-pill px-3 py-2 fw-medium" style="<?php echo $statusStyle; ?>"><?php echo $statusText; ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($data['recent_orders'])): ?>
                                    <tr><td colspan="5" class="text-center py-5 text-muted">Chưa có đơn hàng nào.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php require_once 'views/layouts/footer.php'; ?>

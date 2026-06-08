<?php require_once 'views/layouts/header.php'; ?>

<div class="container-fluid mb-5">
    <div class="row">
        <?php require_once 'views/layouts/admin_sidebar.php'; ?>

        <!-- Admin Content -->
        <div class="col-md-9 col-lg-9 ms-sm-auto px-md-4 mt-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h2 class="fw-bold">Quản Lý Đơn Hàng</h2>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="py-3 rounded-start px-4">Mã ĐH</th>
                                    <th scope="col" class="py-3">Khách hàng</th>
                                    <th scope="col" class="py-3">Sản phẩm</th>
                                    <th scope="col" class="py-3">Ngày đặt</th>
                                    <th scope="col" class="py-3">Tổng tiền</th>
                                    <th scope="col" class="py-3">Trạng thái</th>
                                    <th scope="col" class="py-3 rounded-end px-4 text-center">Cập nhật</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['orders'] as $order): ?>
                                    <tr>
                                        <td class="px-4 fw-medium text-primary">#<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></td>
                                        <td>
                                            <div class="fw-medium"><?php echo htmlspecialchars($order['username']); ?></div>
                                            <small class="text-muted"><?php echo htmlspecialchars($order['phone']); ?></small>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column gap-1">
                                                <?php foreach ($order['items'] as $item): ?>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <?php if ($item['image']): ?>
                                                            <img src="/shop_quan_ao/public/uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                        <?php else: ?>
                                                            <div style="width: 40px; height: 40px; background: #f0f0f0; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-image text-muted"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div>
                                                            <div class="fw-medium" style="font-size: 0.85rem;"><?php echo htmlspecialchars($item['product_name']); ?></div>
                                                            <small class="text-muted">x<?php echo $item['quantity']; ?> - <?php echo number_format($item['price'], 0, ',', '.'); ?> đ</small>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                                        <td class="fw-bold text-danger"><?php echo number_format($order['total_amount'], 0, ',', '.'); ?> đ</td>
                                        <td>
                                            <?php
                                                $statusClass = 'bg-warning text-dark';
                                                $statusText = 'Chờ xử lý';
                                                if ($order['status'] == 'processing') { $statusClass = 'bg-info text-dark'; $statusText = 'Đang chuẩn bị'; }
                                                if ($order['status'] == 'shipping') { $statusClass = 'bg-primary'; $statusText = 'Đang giao'; }
                                                if ($order['status'] == 'completed') { $statusClass = 'bg-success'; $statusText = 'Hoàn thành'; }
                                                if ($order['status'] == 'cancelled') { $statusClass = 'bg-danger'; $statusText = 'Đã hủy'; }
                                            ?>
                                            <span class="badge <?php echo $statusClass; ?> rounded-pill px-3 py-2"><?php echo $statusText; ?></span>
                                        </td>
                                        <td class="px-4">
                                            <form action="/shop_quan_ao/admin/orderStatus/<?php echo $order['id']; ?>" method="POST" class="d-flex gap-2 justify-content-center">
                                                <select name="status" class="form-select form-select-sm rounded-pill" style="width: auto;">
                                                    <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Chờ xử lý</option>
                                                    <option value="processing" <?php echo $order['status'] == 'processing' ? 'selected' : ''; ?>>Đang chuẩn bị</option>
                                                    <option value="shipping" <?php echo $order['status'] == 'shipping' ? 'selected' : ''; ?>>Đang giao</option>
                                                    <option value="completed" <?php echo $order['status'] == 'completed' ? 'selected' : ''; ?>>Hoàn thành</option>
                                                    <option value="cancelled" <?php echo $order['status'] == 'cancelled' ? 'selected' : ''; ?>>Đã hủy</option>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Lưu</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($data['orders'])): ?>
                                    <tr><td colspan="7" class="text-center py-4 text-muted">Chưa có đơn hàng nào.</td></tr>
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

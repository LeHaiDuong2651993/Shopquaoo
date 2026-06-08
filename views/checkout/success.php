<?php require_once 'views/layouts/header.php'; ?>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mt-5">
            <div class="card border-0 shadow-sm rounded-4 p-5">
                <div class="mb-4">
                    <i class="fa-solid fa-circle-check text-success" style="font-size: 80px;"></i>
                </div>
                
                <h1 class="fw-bold mb-3">Đặt Hàng Thành Công!</h1>
                <p class="text-muted fs-5 mb-4">Cảm ơn bạn đã mua sắm tại StyleShop. Đơn hàng của bạn đã được ghi nhận.</p>
                
                <div class="alert alert-light border rounded-3 d-inline-block text-start mb-4 p-4 mx-auto">
                    <p class="mb-2"><strong>Mã đơn hàng:</strong> <span class="text-primary fw-bold">#<?php echo str_pad($data['order_id'], 5, '0', STR_PAD_LEFT); ?></span></p>
                    <p class="mb-2"><strong>Thời gian đặt:</strong> <?php echo date('d/m/Y H:i'); ?></p>
                    <p class="mb-0"><strong>Trạng thái:</strong> <span class="badge bg-warning text-dark">Chờ xử lý</span></p>
                </div>
                
                <p class="mb-5">Chúng tôi sẽ sớm liên hệ với bạn để xác nhận đơn hàng và tiến hành giao hàng. Vui lòng giữ liên lạc qua số điện thoại đã đăng ký.</p>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="/shop_quan_ao/" class="btn btn-primary rounded-pill px-4 py-2">Trở về Trang chủ</a>
                    <a href="/shop_quan_ao/user/orders" class="btn btn-outline-secondary rounded-pill px-4 py-2">Xem Đơn hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>

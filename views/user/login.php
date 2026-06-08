<?php require_once 'views/layouts/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-circle-user text-primary" style="font-size: 4rem;"></i>
                    <h2 class="fw-bold mt-3">Đăng Nhập</h2>
                    <p class="text-muted">Chào mừng bạn trở lại với StyleShop</p>
                </div>

                <?php if (isset($data['error'])): ?>
                    <div class="alert alert-danger rounded-3"><?php echo htmlspecialchars($data['error']); ?></div>
                <?php endif; ?>
                <?php if (isset($data['success'])): ?>
                    <div class="alert alert-success rounded-3"><?php echo htmlspecialchars($data['success']); ?></div>
                <?php endif; ?>

                <form action="/shop_quan_ao/user/login" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-medium">Tên đăng nhập</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-user text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 bg-light" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium">Mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                            <input type="password" class="form-control border-start-0 bg-light" id="password" name="password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold mb-3">Đăng Nhập</button>
                    <div class="text-center text-muted">
                        Chưa có tài khoản? <a href="/shop_quan_ao/user/register" class="text-decoration-none fw-bold">Đăng ký ngay</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>

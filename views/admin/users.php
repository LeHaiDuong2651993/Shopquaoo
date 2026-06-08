<?php require_once 'views/layouts/header.php'; ?>

<div class="container-fluid mb-5">
    <div class="row">
        <?php require_once 'views/layouts/admin_sidebar.php'; ?>

        <!-- Admin Content -->
        <div class="col-md-9 col-lg-9 ms-sm-auto px-md-4 mt-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h2 class="fw-bold">Quản Lý Người Dùng</h2>
                <span class="badge rounded-pill px-3 py-2 fw-medium" style="background:#f1f5f9;color:#475569;font-size:0.85rem;">
                    Tổng: <?php echo count($data['users']); ?> tài khoản
                </span>
            </div>

            <?php if(isset($_GET['msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    <?php echo htmlspecialchars($_GET['msg']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card stat-card bg-white">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap">
                            <thead class="text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px; color: var(--text-muted);">
                                <tr>
                                    <th scope="col" class="py-3 border-0 px-4">ID</th>
                                    <th scope="col" class="py-3 border-0">Tên đăng nhập</th>
                                    <th scope="col" class="py-3 border-0">Email</th>
                                    <th scope="col" class="py-3 border-0">Ngày đăng ký</th>
                                    <th scope="col" class="py-3 border-0">Vai trò</th>
                                    <th scope="col" class="py-3 border-0">Trạng thái</th>
                                    <th scope="col" class="py-3 border-0 text-end px-4">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                <?php foreach ($data['users'] as $user): ?>
                                    <tr class="<?php echo ($user['is_locked'] ?? 0) ? 'table-row-locked' : ''; ?>">
                                        <td class="px-4 py-3 fw-bold" style="color:var(--text-muted);">#<?php echo $user['id']; ?></td>
                                        <td class="py-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="user-avatar rounded-circle d-flex align-items-center justify-content-center flex-shrink-0
                                                    <?php echo ($user['is_locked'] ?? 0) ? 'avatar-locked' : ''; ?>"
                                                    style="width:38px;height:38px;background:<?php echo ($user['is_locked'] ?? 0) ? 'rgba(185,28,28,0.1)' : 'rgba(212,175,55,0.12)'; ?>">
                                                    <i class="fa-solid fa-user" style="color:<?php echo ($user['is_locked'] ?? 0) ? '#b91c1c' : 'var(--accent-color)'; ?>;font-size:0.85rem;"></i>
                                                </div>
                                                <span class="fw-semibold"><?php echo htmlspecialchars($user['username']); ?></span>
                                            </div>
                                        </td>
                                        <td class="py-3" style="color:var(--text-muted);"><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td class="py-3" style="color:var(--text-muted);"><?php echo date('d/m/Y', strtotime($user['created_at'])); ?></td>
                                        <td class="py-3">
                                            <?php if($user['role'] === 'admin'): ?>
                                                <span class="badge rounded-pill px-3 py-2 fw-medium" style="background:rgba(212,175,55,0.15);color:#92700a;">
                                                    <i class="fa-solid fa-crown me-1" style="font-size:0.7rem;"></i>Quản trị viên
                                                </span>
                                            <?php else: ?>
                                                <span class="badge rounded-pill px-3 py-2 fw-medium" style="background:#f1f5f9;color:#475569;">
                                                    <i class="fa-solid fa-user me-1" style="font-size:0.7rem;"></i>Khách hàng
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-3">
                                            <?php if($user['role'] === 'admin'): ?>
                                                <span class="badge rounded-pill px-3 py-2 fw-medium" style="background:#dcfce7;color:#15803d;">
                                                    <i class="fa-solid fa-shield-halved me-1"></i>Bảo vệ
                                                </span>
                                            <?php elseif(!empty($user['is_locked']) && $user['is_locked']): ?>
                                                <span class="badge rounded-pill px-3 py-2 fw-medium" style="background:#fee2e2;color:#b91c1c;">
                                                    <i class="fa-solid fa-lock me-1"></i>Đã khóa
                                                </span>
                                            <?php else: ?>
                                                <span class="badge rounded-pill px-3 py-2 fw-medium" style="background:#dcfce7;color:#15803d;">
                                                    <i class="fa-solid fa-circle-check me-1"></i>Hoạt động
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 py-3 text-end">
                                            <?php if($user['role'] !== 'admin'): ?>
                                                <?php if(!empty($user['is_locked']) && $user['is_locked']): ?>
                                                    <!-- Nút Mở khóa -->
                                                    <form action="/shop_quan_ao/admin/userLock/<?php echo $user['id']; ?>" method="POST" class="d-inline">
                                                        <input type="hidden" name="action" value="unlock">
                                                        <button type="submit" class="btn btn-sm rounded-pill fw-medium px-3"
                                                            style="background:#dcfce7;color:#15803d;border:none;"
                                                            title="Mở khóa tài khoản này"
                                                            onclick="return confirm('Mở khóa tài khoản <?php echo htmlspecialchars($user['username']); ?>?')">
                                                            <i class="fa-solid fa-lock-open me-1"></i>Mở khóa
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <!-- Nút Khóa -->
                                                    <form action="/shop_quan_ao/admin/userLock/<?php echo $user['id']; ?>" method="POST" class="d-inline">
                                                        <input type="hidden" name="action" value="lock">
                                                        <button type="submit" class="btn btn-sm rounded-pill fw-medium px-3"
                                                            style="background:#fee2e2;color:#b91c1c;border:none;"
                                                            title="Khóa tài khoản này"
                                                            onclick="return confirm('Khóa tài khoản <?php echo htmlspecialchars($user['username']); ?>? Người dùng sẽ không thể đăng nhập.')">
                                                            <i class="fa-solid fa-lock me-1"></i>Khóa
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <button class="btn btn-sm rounded-pill fw-medium px-3" style="background:#f1f5f9;color:#94a3b8;border:none;cursor:default;" disabled>
                                                    <i class="fa-solid fa-shield-halved me-1"></i>Không thể khóa
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($data['users'])): ?>
                                    <tr><td colspan="7" class="text-center py-5 text-muted">Chưa có người dùng nào.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table-row-locked td { opacity: 0.7; }
.table-row-locked { background: #fffafa; }
</style>

<?php require_once 'views/layouts/footer.php'; ?>

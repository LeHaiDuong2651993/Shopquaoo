<?php require_once 'views/layouts/header.php'; ?>

<div class="container-fluid mb-5">
    <div class="row">
        <?php require_once 'views/layouts/admin_sidebar.php'; ?>

        <!-- Admin Content -->
        <div class="col-md-9 col-lg-9 ms-sm-auto px-md-4 mt-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h2 class="fw-bold">Quản Lý Danh Mục</h2>
                <a href="/shop_quan_ao/admin/categoryAdd" class="btn btn-primary rounded-pill fw-medium">
                    <i class="fa-solid fa-plus me-2"></i>Thêm Danh Mục
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="py-3 rounded-start px-4">ID</th>
                                    <th scope="col" class="py-3">Tên danh mục</th>
                                    <th scope="col" class="py-3">Mô tả</th>
                                    <th scope="col" class="py-3 rounded-end px-4 text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['categories'] as $category): ?>
                                    <tr>
                                        <td class="px-4 fw-medium text-muted">#<?php echo $category['id']; ?></td>
                                        <td class="fw-bold"><?php echo htmlspecialchars($category['name']); ?></td>
                                        <td><?php echo htmlspecialchars(substr($category['description'], 0, 50)) . '...'; ?></td>
                                        <td class="px-4 text-center">
                                            <a href="/shop_quan_ao/admin/categoryEdit/<?php echo $category['id']; ?>" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 32px; height: 32px; padding: 0; line-height: 30px;" title="Sửa"><i class="fa-solid fa-pen"></i></a>
                                            <form action="/shop_quan_ao/admin/categoryDelete/<?php echo $category['id']; ?>" method="POST" class="d-inline" onsubmit="return confirm('Xóa danh mục này có thể ảnh hưởng đến sản phẩm. Bạn chắc chắn chứ?');">
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle ms-1" style="width: 32px; height: 32px; padding: 0;" title="Xóa"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($data['categories'])): ?>
                                    <tr><td colspan="4" class="text-center py-4 text-muted">Chưa có danh mục nào.</td></tr>
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

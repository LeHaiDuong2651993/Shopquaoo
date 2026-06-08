<?php require_once 'views/layouts/header.php'; ?>

<div class="container-fluid mb-5">
    <div class="row">
        <?php require_once 'views/layouts/admin_sidebar.php'; ?>

        <!-- Admin Content -->
        <div class="col-md-9 col-lg-9 ms-sm-auto px-md-4 mt-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h2 class="fw-bold">Sửa Danh Mục</h2>
                <a href="/shop_quan_ao/admin/categories" class="btn btn-outline-secondary rounded-pill fw-medium">
                    <i class="fa-solid fa-arrow-left me-2"></i>Quay Lại
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-5">
                    <form action="/shop_quan_ao/admin/categoryEdit/<?php echo $data['category']['id']; ?>" method="POST">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="mb-4">
                                    <label for="name" class="form-label fw-bold">Tên danh mục</label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name" required value="<?php echo htmlspecialchars($data['category']['name']); ?>">
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="form-label fw-bold">Mô tả danh mục</label>
                                    <textarea class="form-control" id="description" name="description" rows="5"><?php echo htmlspecialchars($data['category']['description']); ?></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold fs-5 shadow-sm">
                                    <i class="fa-solid fa-save me-2"></i> Cập Nhật
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php require_once 'views/layouts/footer.php'; ?>

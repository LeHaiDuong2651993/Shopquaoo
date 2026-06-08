<?php require_once 'views/layouts/header.php'; ?>

<div class="container-fluid mb-5">
    <div class="row">
        <?php require_once 'views/layouts/admin_sidebar.php'; ?>

        <!-- Admin Content -->
        <div class="col-md-9 col-lg-9 ms-sm-auto px-md-4 mt-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h2 class="fw-bold">Thêm Sản Phẩm Mới</h2>
                <a href="/shop_quan_ao/admin/products" class="btn btn-outline-secondary rounded-pill fw-medium">
                    <i class="fa-solid fa-arrow-left me-2"></i>Quay Lại
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-5">
                    <form action="/shop_quan_ao/admin/productAdd" method="POST" enctype="multipart/form-data">
                        <div class="row g-4">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Nhập tên sản phẩm...">
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label fw-bold">Mô tả sản phẩm</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Mô tả chi tiết sản phẩm..."></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="price" class="form-label fw-bold">Giá bán (VNĐ)</label>
                                        <input type="number" class="form-control" id="price" name="price" required min="0" placeholder="0">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="stock" class="form-label fw-bold">Số lượng trong kho</label>
                                        <input type="number" class="form-control" id="stock" name="stock" required min="0" value="0">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label for="category_id" class="form-label fw-bold">Danh mục</label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        <?php foreach($data['categories'] as $category): ?>
                                            <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Hình ảnh sản phẩm</label>
                                    <div class="border rounded p-3 text-center bg-light">
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        <small class="text-muted d-block mt-2">Định dạng hỗ trợ: JPG, PNG, GIF</small>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold fs-5 shadow-sm">
                                    <i class="fa-solid fa-save me-2"></i> Lưu Sản Phẩm
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

<?php require_once 'views/layouts/header.php'; ?>

<div class="container-fluid mb-5">
    <div class="row">
        <?php require_once 'views/layouts/admin_sidebar.php'; ?>

        <!-- Admin Content -->
        <div class="col-md-9 col-lg-9 ms-sm-auto px-md-4 mt-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h2 class="fw-bold">Quản Lý Sản Phẩm</h2>
                <a href="/shop_quan_ao/admin/productAdd" class="btn btn-primary rounded-pill fw-medium">
                    <i class="fa-solid fa-plus me-2"></i>Thêm Sản Phẩm Mới
                </a>
            </div>

            <!-- Search Bar -->
            <div class="mb-3 position-relative">
                <div class="input-group" style="max-width: 400px;">
                    <span class="input-group-text border-end-0 bg-white" style="border-radius: 50px 0 0 50px; border-color: #e2e8f0;">
                        <i class="fa-solid fa-magnifying-glass" style="color: var(--text-muted);"></i>
                    </span>
                    <input type="text" id="adminProductSearch" class="form-control border-start-0 shadow-none"
                        style="border-radius: 0 50px 50px 0; border-color: #e2e8f0;"
                        placeholder="Tìm theo tên sản phẩm hoặc danh mục..."
                        onkeyup="filterAdminProducts()" autocomplete="off">
                </div>
                <div id="searchResultCount" class="mt-2 text-muted" style="font-size: 0.82rem; display: none;">
                    <!-- filled by JS -->
                </div>
            </div>

            <div class="card stat-card bg-white">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap" id="adminProductTable">
                            <thead class="text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px; color: var(--text-muted);">
                                <tr>
                                    <th scope="col" class="py-3 border-0 px-4" style="width: 80px;">Ảnh</th>
                                    <th scope="col" class="py-3 border-0">Tên sản phẩm</th>
                                    <th scope="col" class="py-3 border-0">Danh mục</th>
                                    <th scope="col" class="py-3 border-0">Giá bán</th>
                                    <th scope="col" class="py-3 border-0">Kho</th>
                                    <th scope="col" class="py-3 border-0 text-center px-4">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="border-top" id="adminProductTbody">
                                <?php foreach ($data['products'] as $product): ?>
                                    <tr class="product-row">
                                        <td class="px-4 py-3">
                                            <?php $imgSrc = !empty($product['image']) ? '/shop_quan_ao/public/uploads/' . $product['image'] : 'https://via.placeholder.com/60x60.png?text=Img'; ?>
                                            <img src="<?php echo $imgSrc; ?>" class="rounded border" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 50px; height: 50px; object-fit: cover;">
                                        </td>
                                        <td class="py-3 product-name">
                                            <div class="fw-semibold text-truncate" style="max-width: 250px;">
                                                <a href="/shop_quan_ao/product/detail/<?php echo $product['id']; ?>" target="_blank" class="text-decoration-none text-dark">
                                                    <?php echo htmlspecialchars($product['name']); ?>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="py-3 product-category">
                                            <span class="badge rounded-pill px-3 py-2 fw-medium" style="background:#f1f5f9;color:#475569;">
                                                <?php echo htmlspecialchars($product['category_name']); ?>
                                            </span>
                                        </td>
                                        <td class="py-3 fw-bold" style="color: var(--accent-color);"><?php echo number_format($product['price'], 0, ',', '.'); ?> đ</td>
                                        <td class="py-3">
                                            <?php if($product['stock'] > 10): ?>
                                                <span class="badge rounded-pill px-3 py-2" style="background:#dcfce7;color:#15803d;"><?php echo $product['stock']; ?></span>
                                            <?php elseif($product['stock'] > 0): ?>
                                                <span class="badge rounded-pill px-3 py-2" style="background:#fef3c7;color:#b45309;"><?php echo $product['stock']; ?></span>
                                            <?php else: ?>
                                                <span class="badge rounded-pill px-3 py-2" style="background:#fee2e2;color:#b91c1c;">Hết</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="/shop_quan_ao/admin/productEdit/<?php echo $product['id']; ?>" class="btn btn-sm btn-outline-primary rounded-circle me-1" style="width: 32px; height: 32px; padding: 0; line-height: 30px;" title="Sửa"><i class="fa-solid fa-pen"></i></a>
                                            <form action="/shop_quan_ao/admin/productDelete/<?php echo $product['id']; ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" style="width: 32px; height: 32px; padding: 0;" title="Xóa"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($data['products'])): ?>
                                    <tr id="emptyRow"><td colspan="6" class="text-center py-5 text-muted">Chưa có sản phẩm nào.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <!-- Hiển thị khi không tìm thấy kết quả -->
                        <div id="noSearchResult" class="text-center py-5" style="display:none;">
                            <i class="fa-solid fa-magnifying-glass fa-2x mb-3" style="color:#cbd5e1;"></i>
                            <p class="text-muted mb-0">Không tìm thấy sản phẩm nào phù hợp.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function filterAdminProducts() {
    const input = document.getElementById('adminProductSearch');
    const filter = input.value.toLowerCase().trim();
    const rows = document.querySelectorAll('#adminProductTbody .product-row');
    const noResult = document.getElementById('noSearchResult');
    const countDiv = document.getElementById('searchResultCount');

    let visibleCount = 0;

    rows.forEach(row => {
        const name = row.querySelector('.product-name')?.textContent.toLowerCase() || '';
        const category = row.querySelector('.product-category')?.textContent.toLowerCase() || '';
        const match = name.includes(filter) || category.includes(filter);
        row.style.display = match ? '' : 'none';
        if (match) visibleCount++;
    });

    // Thông báo số kết quả
    if (filter.length > 0) {
        countDiv.style.display = 'block';
        countDiv.innerHTML = `<i class="fa-solid fa-filter me-1"></i>Hiển thị <strong>${visibleCount}</strong> / <strong>${rows.length}</strong> sản phẩm`;
        noResult.style.display = visibleCount === 0 ? 'block' : 'none';
    } else {
        countDiv.style.display = 'none';
        noResult.style.display = 'none';
    }
}

// Xóa tìm kiếm khi nhấn Escape
document.getElementById('adminProductSearch').addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        this.value = '';
        filterAdminProducts();
    }
});
</script>

<?php require_once 'views/layouts/footer.php'; ?>

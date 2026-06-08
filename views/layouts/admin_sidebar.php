<?php 
$current_uri = $_SERVER['REQUEST_URI'];
$base_path = '/shop_quan_ao/admin';
?>
<!-- Admin Sidebar -->
<div class="col-md-3 col-lg-2 d-md-block admin-sidebar shadow rounded-4 mt-4 ms-3 me-2" style="min-height: calc(100vh - 150px);">
    <div class="position-sticky pt-4 px-2">
        <h5 class="fw-bold px-3 mb-4 text-white brand-font fs-4"><i class="fa-solid fa-shield-halved me-2" style="color: var(--accent-color);"></i>Quản Trị</h5>
        <ul class="nav flex-column gap-2">
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_uri == $base_path || $current_uri == $base_path . '/') ? 'active' : ''; ?> px-3 py-2" href="<?php echo $base_path; ?>">
                    <i class="fa-solid fa-gauge-high me-2 w-20px"></i> Tổng quan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($current_uri, $base_path . '/orders') !== false) ? 'active' : ''; ?> px-3 py-2" href="<?php echo $base_path; ?>/orders">
                    <i class="fa-solid fa-box me-2 w-20px"></i> Đơn hàng
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($current_uri, $base_path . '/product') !== false) ? 'active' : ''; ?> px-3 py-2" href="<?php echo $base_path; ?>/products">
                    <i class="fa-solid fa-tags me-2 w-20px"></i> Sản phẩm
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($current_uri, $base_path . '/categor') !== false) ? 'active' : ''; ?> px-3 py-2" href="<?php echo $base_path; ?>/categories">
                    <i class="fa-solid fa-layer-group me-2 w-20px"></i> Danh mục
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($current_uri, $base_path . '/user') !== false) ? 'active' : ''; ?> px-3 py-2" href="<?php echo $base_path; ?>/users">
                    <i class="fa-solid fa-users me-2 w-20px"></i> Người dùng
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($current_uri, $base_path . '/chat') !== false) ? 'active' : ''; ?> px-3 py-2" href="<?php echo $base_path; ?>/chat">
                    <i class="fa-solid fa-comments me-2 w-20px"></i> Chat với khách
                </a>
            </li>
        </ul>
    </div>
</div>

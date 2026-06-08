<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleShop - Bút Tích Thời Trang</title>
    <!-- Google Fonts: Inter & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/shop_quan_ao/public/css/style.css">
    <style>
        /* Enhanced Header Styles */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            letter-spacing: -0.5px;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.02);
        }
        
        .nav-link {
            font-weight: 500;
            color: #1a1a1a !important;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: #d4af37 !important;
            background: rgba(212, 175, 55, 0.1);
        }
        
        .search-input {
            border: 1px solid #e2e8f0;
            border-radius: 25px;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            background: #f8fafc;
            transition: all 0.3s ease;
            width: 200px;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #d4af37;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
            width: 250px;
        }
        
        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }
        
        .search-input:focus + .search-icon {
            color: #d4af37;
        }
        
        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            color: #1a1a1a;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .icon-btn:hover {
            background: #1a1a1a;
            color: #fff;
            border-color: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .cart-badge {
            background: linear-gradient(135deg, #d4af37, #f0d060);
            color: #fff;
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 50%;
            position: absolute;
            top: -5px;
            right: -5px;
            font-weight: 600;
        }
        
        .btn-premium {
            background: linear-gradient(135deg, #1a1a1a, #333);
            color: #fff;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-premium:hover {
            background: linear-gradient(135deg, #d4af37, #f0d060);
            color: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }
        
        .dropdown-menu {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 0.5rem;
        }
        
        .dropdown-item {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background: #f8fafc;
            color: #d4af37;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="bg-dark text-white py-2" style="font-size: 0.85rem;">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4">
                <span><i class="fa-solid fa-phone me-2"></i>0947824689</span>
                <span><i class="fa-solid fa-envelope me-2"></i>changkhothuychung2651993@gmail.com</span>
            </div>
            <div class="d-flex gap-3">
                <a href="https://www.facebook.com/Changkhothuychung2651993" class="text-white text-decoration-none hover:text-warning" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                
                <a href="https://www.tiktok.com/@nguyenvanle2651993" class="text-white text-decoration-none hover:text-warning" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
            </div>
        </div>
    </div>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top py-3" style="background: rgba(255,255,255,0.98); backdrop-filter: blur(10px); box-shadow: 0 2px 20px rgba(0,0,0,0.06);">
        <div class="container">
            <a class="navbar-brand fs-3" href="/shop_quan_ao/" style="color: #32c725; font-family: 'Playfair Display', serif;">
                <i class="fa-solid fa-shirt" style="color: #1bd43a;"></i> StyleShop
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="color: #1a1a1a;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/shop_quan_ao/product"><i class="fa-solid fa-bag-shopping me-1"></i> Sản Phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/shop_quan_ao/product/category/1"><i class="fa-solid fa-shirt me-1"></i> Áo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/shop_quan_ao/product/category/2"><i class="fa-solid fa-person me-1"></i> Quần</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/shop_quan_ao/product/category/3"><i class="fa-solid fa-briefcase me-1"></i> Váy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/shop_quan_ao/product/category/4"><i class="fa-solid fa-briefcase me-1"></i> Phụ Kiện</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <!-- Search -->
                    <form class="position-relative" action="/shop_quan_ao/product/search" method="GET">
                        <input class="search-input" type="search" name="q" placeholder="Tìm kiếm..." required>
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    </form>

                    <!-- Cart -->
                    <a href="/shop_quan_ao/cart" class="icon-btn position-relative text-decoration-none">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="cart-badge"><?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : '0'; ?></span>
                    </a>

                    <!-- User -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="dropdown">
                            <a class="btn btn-premium text-decoration-none" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fa-regular fa-user me-2"></i><?php echo htmlspecialchars($_SESSION['username']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <li><a class="dropdown-item" href="/shop_quan_ao/admin"><i class="fa-solid fa-shield-halved me-2"></i>Quản trị</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="/shop_quan_ao/user/orders"><i class="fa-solid fa-box-open me-2"></i>Đơn hàng</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="/shop_quan_ao/user/logout"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Đăng xuất</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="/shop_quan_ao/user/login" class="btn btn-premium">Đăng Nhập</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1 bg-light">

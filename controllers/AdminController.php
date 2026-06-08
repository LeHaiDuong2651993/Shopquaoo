<?php
class AdminController extends Controller {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if user is admin
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: /shop_quan_ao/");
            exit();
        }
    }

    public function index() {
        $orderModel = $this->model('Order');
        $productModel = $this->model('Product');
        $userModel = $this->model('User');

        $orders = $orderModel->getAllOrders();
        $products = $productModel->readAll();
        $users = $userModel->getAllUsers();

        // Calculate some stats
        $total_revenue = 0;
        $pending_orders = 0;
        foreach ($orders as $o) {
            if ($o['status'] === 'completed') {
                $total_revenue += $o['total_amount'];
            }
            if ($o['status'] === 'pending') {
                $pending_orders++;
            }
        }

        $this->view('admin/index', [
            'orders_count' => count($orders),
            'products_count' => count($products),
            'users_count' => count($users),
            'total_revenue' => $total_revenue,
            'pending_orders' => $pending_orders,
            'recent_orders' => array_slice($orders, 0, 5) // top 5 recent orders
        ]);
    }

    public function orders() {
        $orderModel = $this->model('Order');
        $orders = $orderModel->getAllOrders();

        // Lấy chi tiết sản phẩm cho mỗi đơn hàng
        foreach ($orders as &$order) {
            $order['items'] = $orderModel->getOrderItems($order['id']);
        }

        $this->view('admin/orders', ['orders' => $orders]);
    }

    public function orderStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
            $orderModel = $this->model('Order');
            $orderModel->updateStatus($id, $_POST['status']);
        }
        header("Location: /shop_quan_ao/admin/orders");
        exit();
    }

    public function products() {
        $productModel = $this->model('Product');
        $products = $productModel->readAll();
        
        $this->view('admin/products', ['products' => $products]);
    }

    public function users() {
        $userModel = $this->model('User');
        $users = $userModel->getAllUsers();
        
        $this->view('admin/users', ['users' => $users]);
    }

    public function productAdd() {
        $categoryModel = $this->model('Category');
        $categories = $categoryModel->readAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name']),
                'category_id' => $_POST['category_id'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock'],
                'description' => trim($_POST['description']),
                'image' => ''
            ];

            // Image upload handling
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload_dir = 'public/uploads/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                $file_name = time() . '_' . basename($_FILES['image']['name']);
                $target_file = $upload_dir . $file_name;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $data['image'] = $file_name;
                }
            }

            $productModel = $this->model('Product');
            if ($productModel->create($data)) {
                header("Location: /shop_quan_ao/admin/products");
                exit();
            }
        }

        $this->view('admin/product_add', ['categories' => $categories]);
    }

    public function productEdit($id = null) {
        if (!$id) {
            header("Location: /shop_quan_ao/admin/products");
            exit();
        }

        $productModel = $this->model('Product');
        $categoryModel = $this->model('Category');

        $product = $productModel->readOne($id);
        $categories = $categoryModel->readAll();

        if (!$product) {
            header("Location: /shop_quan_ao/admin/products");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name']),
                'category_id' => $_POST['category_id'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock'],
                'description' => trim($_POST['description'])
            ];

            // Image upload handling
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload_dir = 'public/uploads/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                $file_name = time() . '_' . basename($_FILES['image']['name']);
                $target_file = $upload_dir . $file_name;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $data['image'] = $file_name;
                }
            }

            if ($productModel->update($id, $data)) {
                header("Location: /shop_quan_ao/admin/products");
                exit();
            }
        }

        $this->view('admin/product_edit', ['product' => $product, 'categories' => $categories]);
    }

    public function productDelete($id = null) {
        if ($id && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $productModel = $this->model('Product');
            $productModel->delete($id);
        }
        header("Location: /shop_quan_ao/admin/products");
        exit();
    }

    public function categories() {
        $categoryModel = $this->model('Category');
        $categories = $categoryModel->readAll();
        
        $this->view('admin/categories', ['categories' => $categories]);
    }

    public function categoryAdd() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description'])
            ];

            $categoryModel = $this->model('Category');
            if ($categoryModel->create($data)) {
                header("Location: /shop_quan_ao/admin/categories");
                exit();
            }
        }
        $this->view('admin/category_add');
    }

    public function categoryEdit($id = null) {
        if (!$id) {
            header("Location: /shop_quan_ao/admin/categories");
            exit();
        }

        $categoryModel = $this->model('Category');
        $category = $categoryModel->readOne($id);

        if (!$category) {
            header("Location: /shop_quan_ao/admin/categories");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description'])
            ];

            if ($categoryModel->update($id, $data)) {
                header("Location: /shop_quan_ao/admin/categories");
                exit();
            }
        }

        $this->view('admin/category_edit', ['category' => $category]);
    }

    public function categoryDelete($id = null) {
        if ($id && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoryModel = $this->model('Category');
            $categoryModel->delete($id);
        }
        header("Location: /shop_quan_ao/admin/categories");
        exit();
    }

    public function userLock($id = null) {
        if ($id && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            $action = $_POST['action'] ?? '';
            if ($action === 'lock') {
                $userModel->lockUser($id);
            } elseif ($action === 'unlock') {
                $userModel->unlockUser($id);
            }
        }
        header("Location: /shop_quan_ao/admin/users");
        exit();
    }

    public function chat() {
        $this->view('admin/chat');
    }
}
?>

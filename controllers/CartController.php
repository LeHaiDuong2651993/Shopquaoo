<?php
class CartController extends Controller {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function index() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header("Location: /shop_quan_ao/user/login");
            exit();
        }

        $cart = $_SESSION['cart'];
        $productModel = $this->model('Product');

        $cartItems = [];
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $product = $productModel->readOne($id);
            if ($product) {
                $product['quantity'] = $quantity;
                $product['subtotal'] = $product['price'] * $quantity;
                $total += $product['subtotal'];
                $cartItems[] = $product;
            }
        }

        $this->view('cart/index', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function add($id = null) {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header("Location: /shop_quan_ao/user/login");
            exit();
        }

        if (!$id) {
            header("Location: /shop_quan_ao/product");
            exit();
        }

        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        if ($quantity < 1) $quantity = 1;

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] += $quantity;
        } else {
            $_SESSION['cart'][$id] = $quantity;
        }

        header("Location: /shop_quan_ao/cart");
        exit();
    }

    public function update() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header("Location: /shop_quan_ao/user/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantities'])) {
            foreach ($_POST['quantities'] as $id => $quantity) {
                if ($quantity > 0) {
                    $_SESSION['cart'][$id] = $quantity;
                } else {
                    unset($_SESSION['cart'][$id]);
                }
            }
        }
        header("Location: /shop_quan_ao/cart");
        exit();
    }

    public function remove($id = null) {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header("Location: /shop_quan_ao/user/login");
            exit();
        }

        if ($id && isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header("Location: /shop_quan_ao/cart");
        exit();
    }

    public function clear() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header("Location: /shop_quan_ao/user/login");
            exit();
        }

        $_SESSION['cart'] = [];
        header("Location: /shop_quan_ao/cart");
        exit();
    }
}
?>

<?php
class UserController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            $user = $userModel->login($_POST['username'], $_POST['password']);

            if ($user === 'locked') {
                $error = "Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.";
                $this->view('user/login', ['error' => $error]);
                return;
            } elseif ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                header("Location: /shop_quan_ao/");
                exit();
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
                $this->view('user/login', ['error' => $error]);
                return;
            }
        }
        $this->view('user/login');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            if ($userModel->register($_POST['username'], $_POST['password'], $_POST['email'])) {
                $success = "Đăng ký thành công! Vui lòng đăng nhập.";
                $this->view('user/login', ['success' => $success]);
                return;
            } else {
                $error = "Tên đăng nhập hoặc email đã tồn tại.";
                $this->view('user/register', ['error' => $error]);
                return;
            }
        }
        $this->view('user/register');
    }

    public function logout() {
        session_destroy();
        header("Location: /shop_quan_ao/");
        exit();
    }

    public function orders() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /shop_quan_ao/user/login");
            exit();
        }

        $orderModel = $this->model('Order');
        $orders = $orderModel->getOrdersByUserId($_SESSION['user_id']);

        $this->view('user/orders', ['orders' => $orders]);
    }

    public function orderDetail($order_id = null) {
        if (!isset($_SESSION['user_id']) || !$order_id) {
            header("Location: /shop_quan_ao/user/login");
            exit();
        }

        $orderModel = $this->model('Order');
        // Simple security check to make sure the order belongs to the user
        $orders = $orderModel->getOrdersByUserId($_SESSION['user_id']);
        $valid_order = false;
        $order_info = null;

        foreach ($orders as $o) {
            if ($o['id'] == $order_id) {
                $valid_order = true;
                $order_info = $o;
                break;
            }
        }

        if (!$valid_order) {
            header("Location: /shop_quan_ao/user/orders");
            exit();
        }

        $items = $orderModel->getOrderItems($order_id);

        $this->view('user/order_detail', [
            'order' => $order_info,
            'items' => $items
        ]);
    }
}
?>

<?php
class CheckoutController extends Controller {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        // Require login to checkout
        if (!isset($_SESSION['user_id'])) {
            header("Location: /shop_quan_ao/user/login?redirect=checkout");
            exit();
        }

        // Check if cart is empty
        if (empty($_SESSION['cart'])) {
            header("Location: /shop_quan_ao/cart");
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

        $this->view('checkout/index', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['cart']) || !isset($_SESSION['user_id'])) {
            header("Location: /shop_quan_ao/cart");
            exit();
        }

        $shipping_address = trim($_POST['address'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $note = trim($_POST['note'] ?? '');

        if (empty($shipping_address) || empty($phone)) {
            // Should add error flash message here
            header("Location: /shop_quan_ao/checkout");
            exit();
        }

        $productModel = $this->model('Product');
        $orderModel = $this->model('Order');

        // Calculate total again for security
        $total = 0;
        $orderItemsData = [];

        foreach ($_SESSION['cart'] as $id => $quantity) {
            $product = $productModel->readOne($id);
            if ($product) {
                $price = $product['price'];
                $total += $price * $quantity;
                $orderItemsData[] = [
                    'product_id' => $id,
                    'quantity' => $quantity,
                    'price' => $price
                ];
            }
        }

        // Create Order
        $order_id = $orderModel->createOrder($_SESSION['user_id'], $total, $shipping_address, $phone, $note);

        if ($order_id) {
            // Create Order Items
            foreach ($orderItemsData as $item) {
                $orderModel->createOrderItem($order_id, $item['product_id'], $item['quantity'], $item['price']);
            }

            // Clear Cart
            unset($_SESSION['cart']);

            // Redirect to success page
            header("Location: /shop_quan_ao/checkout/success/" . $order_id);
            exit();
        } else {
            // Failed to create order
            header("Location: /shop_quan_ao/checkout");
            exit();
        }
    }

    public function success($order_id = null) {
        if (!$order_id || !isset($_SESSION['user_id'])) {
            header("Location: /shop_quan_ao/");
            exit();
        }

        $this->view('checkout/success', ['order_id' => $order_id]);
    }
}
?>

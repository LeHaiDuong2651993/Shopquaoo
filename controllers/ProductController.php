<?php
class ProductController extends Controller {
    public function index() {
        $productModel = $this->model('Product');
        $products = $productModel->readAll();
        
        $this->view('product/index', ['products' => $products]);
    }

    public function detail($id = null) {
        if (!$id) {
            header("Location: /shop_quan_ao/product");
            exit();
        }

        $productModel = $this->model('Product');
        $product = $productModel->readOne($id);

        if (!$product) {
            header("Location: /shop_quan_ao/product");
            exit();
        }

        $this->view('product/detail', ['product' => $product]);
    }

    public function category($id = null) {
        if (!$id) {
            header("Location: /shop_quan_ao/product");
            exit();
        }

        $productModel = $this->model('Product');
        $categoryModel = $this->model('Category');
        
        $products = $productModel->readByCategory($id);
        $category = $categoryModel->readOne($id);

        $this->view('product/index', [
            'products' => $products,
            'category' => $category
        ]);
    }

    public function search() {
        $keywords = isset($_GET['q']) ? trim($_GET['q']) : '';
        
        $productModel = $this->model('Product');
        $products = $productModel->search($keywords);

        $this->view('product/index', [
            'products' => $products,
            'search_query' => $keywords
        ]);
    }
}
?>

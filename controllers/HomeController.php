<?php
class HomeController extends Controller {
    public function index() {
        $productModel = $this->model('Product');
        $categoryModel = $this->model('Category');
        
        $products = $productModel->readAll(8);
        $categories = $categoryModel->readAll();
        
        $this->view('home/index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
?>

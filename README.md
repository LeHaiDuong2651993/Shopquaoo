# StyleShop - Website Bán Quần Áo Thời Trang

## Giới thiệu

StyleShop là website thương mại điện tử chuyên kinh doanh các sản phẩm thời trang như áo, quần, váy và phụ kiện. Hệ thống được xây dựng bằng PHP theo mô hình MVC, sử dụng MySQL để quản lý dữ liệu và Bootstrap 5 để thiết kế giao diện.

## Tính năng chính

### Khách hàng

* Xem danh sách sản phẩm
* Tìm kiếm sản phẩm
* Xem chi tiết sản phẩm
* Lọc sản phẩm theo danh mục
* Đăng ký tài khoản
* Đăng nhập / Đăng xuất
* Quản lý giỏ hàng
* Đặt hàng trực tuyến
* Xem lịch sử đơn hàng

### Quản trị viên

* Quản lý sản phẩm
* Quản lý danh mục
* Quản lý đơn hàng
* Quản lý người dùng
* Thống kê dữ liệu bán hàng

## Công nghệ sử dụng

* PHP 8.x
* MySQL
* HTML5
* CSS3
* Bootstrap 5
* JavaScript


## Cấu trúc thư mục

```text
shop_quan_ao/
│
├── config/
│   └── database.php
│
├── controllers/
│
├── core/
│
├── database/
│   └── shop_quan_ao.sql
│
├── models/
│
├── public/
│   ├── css/
│   ├── js/
│   └── uploads/
│
├── views/
│
├── .htaccess
├── index.php
└── README.md
```

## Cài đặt trên Localhost (XAMPP)

### Bước 1: Clone dự án

```bash
git clone https://github.com/your-username/styleshop.git
```

### Bước 2: Copy vào thư mục htdocs

```text
C:\xampp\htdocs\shop_quan_ao
```

### Bước 3: Tạo Database

Truy cập phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Tạo database:

```sql
shop_quan_ao
```

Import file:

```text
database/shop_quan_ao.sql
```

### Bước 4: Cấu hình Database

Mở file:

```php
config/database.php
```

Chỉnh sửa:

```php
private $host = "localhost";
private $db_name = "shop_quan_ao";
private $username = "root";
private $password = "";
```

### Bước 5: Chạy website

```text
http://styleshop.blog/

```

## Triển khai Hosting AwardSpace

Cấu hình kết nối database:

```php
private $host = "fdb1032.awardspace.net";
private $db_name = "4764680_shopquanao";
private $username = "4764680_shopquanao";
private $password = "Thu15112002@";
```

Upload toàn bộ source code lên thư mục hosting.

Import file SQL vào phpMyAdmin của AwardSpace.

## Tài khoản quản trị

Tạo tài khoản Admin trực tiếp trong cơ sở dữ liệu hoặc thông qua chức năng quản trị của hệ thống.

## Tác giả

* Họ tên: Nguyễn Văn Lẽ
        : Lê Văn Thứ
* Trường: Đại học Thành Đông
* Chuyên ngành: Công nghệ Thông tin

## Giấy phép

Dự án được xây dựng phục vụ mục đích học tập, nghiên cứu và phát triển kỹ năng lập trình web.

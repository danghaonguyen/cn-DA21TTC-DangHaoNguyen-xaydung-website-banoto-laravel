<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');

use App\Models\Product;
use App\Models\Article;

Route::get('/', function () {
    $products = Product::take(8)->get();
    $articles = Article::take(3)->get();  // Lấy tất cả sản phẩm từ cơ sở dữ liệu
    return view('home', compact('products', 'articles'));  // Truyền dữ liệu sản phẩm vào view
});

use App\Http\Controllers\ArticleController;

// Hiển thị trang bài viết article.blade.php
Route::get('article', [ArticleController::class, 'index'])->name('article');

Route::get('admin/manager-article', [ArticleController::class, 'show'])->name('admin.manager-article');

// Thêm bài viết và lưu vào cơ sở dữ liệu
Route::post('/admin/manager-article', [ArticleController::class, 'store'])->name('admin.manager-article.store');

// Upload hình ảnh trong mục "content"
Route::post('/admin/manager-article/upload', [ArticleController::class, 'upload'])->name('admin.manager-article.upload');

// Sửa bài viết
Route::get('/admin/manager-article/{id}', [ArticleController::class, 'edit'])->name('admin.manager-article.edit');

// Cập nhật bài viết
Route::put('/admin/manager-article/{id}', [ArticleController::class, 'update'])->name('admin.manager-article.update');

// Xóa bài viết
Route::delete('admin/list-article/{id}', [ArticleController::class, 'destroy'])->name('admin.list-article.destroy');

// Hiển thị danh sách bài viết trong admin/list-article.blade.php
Route::get('/admin/list-article', [ArticleController::class, 'list'])->name('admin.list-article');

// Hiển thị chi tiết bài viết ở trang article-details.blade.php
Route::get('/article-details/{id}', [ArticleController::class, 'viewDetails'])->name('article-details');

// Tìm kiếm bài viết trong admin/list-article.blade.php
Route::get('/admin/list-article', [ArticleController::class, 'search'])->name('admin.list-article');

/* ------------------------------------------------------------------------------------ */
use App\Http\Controllers\SalesController;
//Hiển thị trang khuyến mãi sales.blade.php
Route::get('sales', [SalesController::class, 'index'])->name('sales');

// Hiển thị trang liên hệ contact.blade.php
use App\Http\Controllers\ContactController;
Route::get('\contact', [ContactController::class, 'index'])->name('contact');

/* ------------------------------------------------------------------------------------ */

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Hiển thị trang login.blade.php & register.blade.php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [LoginController::class, 'login'])->name('login');


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

/* ------------------------------------------------------------------------------------ */

// Kết nối phân quyền Admin -> Trang Admin Dashboard
use App\Http\Controllers\DashboardController;


Route::middleware('auth')->get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Hiện thị trang home-dashboard.blade.php
Route::get('/admin/home-dashboard', [DashboardController::class, 'home'])->name('admin.home-dashboard');

/* ------------------------------------------------------------------------------------ */

use Illuminate\Support\Facades\Auth;

// Trang hồ sơ tài khoản - sẽ phát triển sau.
Route::post('/profile', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('profile');


// Xử lý đăng xuất 
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

/* ------------------------------------------------------------------------------------ */

use App\Http\Controllers\ProductController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Hiển thị các trang sản phẩm thuộc danh mục Hãng xe (Toyota, Honda, Hyunda)
Route::get('/products/toyota', [ProductController::class, 'toyota'])->name('products.toyota');
Route::get('/products/hyundai', [ProductController::class, 'hyundai'])->name('products.hyundai');
Route::get('/products/honda', [ProductController::class, 'honda'])->name('products.honda');


// Hiển thị trang thông tin chi tiết sản phẩm Toyota, Honda, Hyundai từ id 
Route::get('/products/details/{id}', [ProductController::class, 'show'])->name('layouts.show');


/* ------------------------------------------------------------------------------------ */

// manager-product.blade.php - Trang Quản lý sản phẩm

// Upload hình ảnh ở mục description ở manager-product.blade.php
Route::post('/admin/manager-product/upload', [ProductController::class, 'upload'])->name('admin.manager-product.upload');


// Hiển thị trang manager-product.blade.php để thêm sản phẩm
Route::get('/admin/manager-product', [ProductController::class, 'create'])->name('admin.manager-product');

// Hiển thị trang manager-product.blade.php để lưu sản phẩm đã thêm vào cơ sở dữ liệu.
Route::post('/admin/manager-product', [ProductController::class, 'store'])->name('admin.manager-product');

// Hiển thị trang để sửa sản phẩm
Route::get('admin/manager-product/{id}', [ProductController::class, 'edit'])->name('admin.manager-product.edit');

// Hiển thị trang để cập nhật sản phẩm
Route::put('admin/manager-product/{id}', [ProductController::class, 'update'])->name('admin.manager-product.update');


/* ------------------------------------------------------------------------------------ */

// list-product.blade.php - Trang Danh sách sản phẩm

// Hiển thị trang list-product.blade.php
Route::get('/admin/list-product', [ProductController::class, 'list'])->name('admin.list-product');

//Hiển thị trang list-product.blade.php để tìm kiếm sản phẩm
Route::get('/admin/list-product', [ProductController::class, 'search'])->name('admin.list-product');

// Hiển thị trang list-product.blade.php để sử dựng method('DELETE') để xóa sản phẩm
Route::delete('admin/list-product/{id}', [ProductController::class, 'destroy'])->name('admin.list-product.destroy');

/* ------------------------------------------------------------------------------------ */


// Thư mục resources/service/.... -> Quản lý các trang dịch vụ (Bảo hành, Phụ tùng và phụ kiện,.....)
use App\Http\Controllers\ServiceController;

// warranty.balde.php - Trang chính sách bảo hành
Route::get('/service/warranty', [ServiceController::class, 'warranty'])->name('service.warranty'); 

// accessories.balde.php - Trang phụ tùng và phụ kiện
Route::get('/service/accessories', [ServiceController::class, 'accessories'])->name('service.accessories');

// test-drive.balde.php - Trang đăng ký lái thử
Route::get('/service/test-drive', [ServiceController::class, 'testDrive'])->name('service.test-drive');

// installment.balde.php - Trang mua xe trả góp
Route::get('/service/installment', [ServiceController::class, 'installment'])->name('service.installment');

// cost-estimation.balde.php - Trang dự toán chi phí
Route::get('/service/cost-estimation', [ServiceController::class, 'costEstimation'])->name('service.cost-estimation');


// Lưu thông tin khách hàng khi đăng ký vào Form ở test-drive.blade.php
Route::post('/service/test-drive', [ServiceController::class, 'storeTestDrive'])->name('service.test-drive');

// Hiển thị danh sách các đơn đăng ký lái thử trong admin/list-testdrive
Route::get('/admin/list-testdrive', [ServiceController::class, 'showTestDrive'])->name('admin.list-testdrive');

// Gọi phương thức để xóa bài viết
Route::delete('/admin/test-drives/{id}', [ServiceController::class, 'destroyTestDrive'])->name('admin.list-testdrive.destroyTestDrive');


/* ------------------------------------------------------------------------------------ */

// Đăng ký mua xe trả góp (service/installment.blade.php)

// Hiển thị trang đăng ký mua trả góp trong mục service/installment.blade.php
Route::get('/service/installment', [ServiceController::class, 'show'])->name('service.installment');

// Gọi phương thức post khi bấm nút Submit để đăng ký
Route::post('/service/installment', [ServiceController::class, 'submit'])->name('service.installment.submit');

/* ------------------------------------------------------------------------------------ */

// Hiển thị danh sách khách hàng trong trang list-installment.blade.php
Route::get('/admin/list-installment', [ServiceController::class, 'display'])->name('admin.list-installment');

Route::delete('/admin/list-installment/{id}', [ServiceController::class, 'destroyInstallments'])->name('admin.list-installment.destroyInstallments');

// Để xử lý việc thay đổi trạng thái của form đăng ký của khách hàng - approve (đã duyệt)
Route::put('admin/installment/approve/{id}', [ServiceController::class, 'approve'])->name('admin.list-installment.approve');

// Để xử lý việc thay đổi trạng thái của form đăng ký của khách hàng - pending (chưa duyệt)
Route::put('admin/installment/pending/{id}', [ServiceController::class, 'pending'])->name('admin.list-installment.pending');

/* ------------------------------------------------------------------------------------ */

// Hiện trên form của trang service.cost-estimation.blade.php
Route::get('service/cost-estimation', [ServiceController::class, 'showForm'])->name('service.cost-estimation');

// Xử lý phần dự toán chi phí cho trang service.cost-estimation.blade.php
Route::post('service/cost-estimation', [ServiceController::class, 'calculate'])->name('service.cost-estimation.calculate');

// Route Ajax của javascript lấy danh sách xe dựa vào hãng xe cho trang service.cost-estimation.blade.php
Route::get('/get-products/{brand}', [ServiceController::class, 'getProducts'])->name('get-products');


/* ------------------------------------------------------------------------------------ */


/* use App\Http\Controllers\ZaloPayController;

Route::post('/payment', [ZaloPayController::class, 'createOrder'])->name('payment.create'); */

/* use App\Http\Controllers\ZaloPayController;

// Đường dẫn cho tạo đơn hàng thanh toán
Route::post('payment/create/{productId}', [ZaloPayController::class, 'createOrder'])->name('payment.create'); */

/* ------------------------------------------------------------------------------------ */

// Xử lý tích hợp thanh toán với ZaloPay

use App\Http\Controllers\PaymentController;

Route::post('/payment/{product_id}', [PaymentController::class, 'createPayment'])->name('payment.create');

// Route xử lý callback từ ZaloPay
Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

// Nếu bạn có cần kiểm tra trạng thái thanh toán, bạn có thể thêm route GET
Route::get('/check-payment-status/{apptransid}', [PaymentController::class, 'checkPaymentStatus'])->name('payment.checkStatus');

/* ------------------------------------------------------------------------------------ */

use App\Http\Controllers\OrderController;

// Hiển thị trang list-orders.blade.php
Route::get('/admin/list-orders', [OrderController::class, 'listOrders'])->name('admin.list-orders');

 // Xem chi tiết đơn hàng trong admin/view-orders.blade.php
Route::get('/admin/view-orders/{orderId}', [OrderController::class, 'viewOrder'])->name('admin.view-orders');

// Xóa đơn hàng
Route::delete('/admin/list-orders/{id}', [OrderController::class, 'destroy'])->name('admin.list-orders.destroy');

/* ------------------------------------------------------------------------------------ */

// Xử lý phần bình luận
use App\Http\Controllers\CommentController;

// Khi user bình luận sẽ lưu vào cơ sở dữ liệu
Route::post('/comments/{articleId}', [CommentController::class, 'store'])->name('comments.store');


// Các tính năng khác như Sửa - Cập nhật - Xóa bình luận => Phát triển sau
Route::get('comments/{comment}', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

/* ------------------------------------------------------------------------------------ */

// Xử lý tích hợp thanh toán với Momo 

// Định nghĩa momo-payment
Route::get('/momo/payment/', [PaymentController::class, 'momo_payment'])->name('momo-payment');

// Lấy sản phẩm theo id để thanh toán
Route::post('/momo/payment/{product_id}', [PaymentController::class, 'momo_payment'])->name('momo-payment');

/* ------------------------------------------------------------------------------------ */

// Xử lý Thống kê doanh thu bằng dạng biểu đồ

use App\Http\Controllers\RevenueController;

// Định nghĩa admin.revenue-statistics và hiển thị biểu đồ thông kê trong phần admin
Route::get('/admin/revenue', [RevenueController::class, 'showRevenueChart'])->name('admin.revenue-statistics');



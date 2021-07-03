<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\categoryProductController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\productController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\SliderBannerController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryNewsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// font - end => danh cho người dung => UI

Route::get('/auth', function () {
    return view('auth.login');
});

Route::get('/trang-chu', [\App\http\Controllers\trangchuController::class,'index']); //=> trang-chu => cai ten 

//trang tim kie san pham
Route::post('/search-product', [\App\http\Controllers\SearchController::class,'search']); //=> trang-chu =>  theo cai ten 

//tim kiếm trong trang admin
Route::post('/search-product-admin', [\App\http\Controllers\SearchController::class,'search_product_page_admin']); //=> trang admin => cai ten 




//show trang chu
Route::get('/',[\App\http\Controllers\trangchuController::class,'index']); //=> gọi hàm index từ controller trang chủ

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// thiết lập load danh muc san phâm trang trang chủ
Route::get('/danh-muc-san-pham/{id}', [\App\http\Controllers\categoryProductController::class,'Show_category_home']);

// thiết lập load thương hiệu cho sản phẩm
Route::get('/thuong-hieu-san-pham/{product_id}', [\App\http\Controllers\brandController::class,'Show_brand_home']);

//chi tiết sản phẩm












// back-end => dành cho admin => UX
Route::get('/admincp', [\App\http\Controllers\AdminControlller::class,'index']); //=> floder admincp

Route::get('/admincp/quantri', [\App\http\Controllers\AdminControlller::class,'show_dashbord']); // admincp/quantri => thu muc

Route::any('/admin-dashbord', [\App\http\Controllers\AdminControlller::class,'dashbordone']); //=> duong dan trong action

Route::get('/logout', [\App\http\Controllers\AdminControlller::class, 'logout']);


// category product 
Route::resource('/categoryproduct', categoryProductController::class);

// cai dat status cho catagory product
Route::get('/unactive-category-product/{id}',[\App\http\Controllers\categoryProductController::class,'Unactive_category_product']);
Route::get('/active-category-product/{id}',[\App\http\Controllers\categoryProductController::class,'Active_category_product']);

// Thương hiệu
Route::resource('/brand', brandController::class);

// cai dạt trang thái hiên thị cho thương hiệu
Route::get('/unactive-brand-product/{id}',[\App\http\Controllers\brandController::class,'Unactive_brand_product']);

Route::get('/active-brand-product/{id}',[\App\http\Controllers\brandController::class,'Active_brand_product']);

// product => admin
Route::resource('/product', productController::class);

// trang chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{product_id}', [\App\http\Controllers\productController::class,'details_product']);

//  an hien san pham = product status
Route::get('/unactive-product/{product_id}',[\App\http\Controllers\productController::class,'Unactive_product']);
Route::get('/active-product/{product_id}',[\App\http\Controllers\productController::class,'Active_product']);

// đánh giá sao cho sản phẩm
Route::post('insert-rating', [\App\http\Controllers\productController::class,'insert_rating']); 


// Slider banner
Route::resource('/slider', SliderBannerController::class);

// trang thai an hien slider
Route::get('/unactive-slider/{slider_id}',[\App\http\Controllers\SliderBannerController::class,'unactive_slider']);

Route::get('/active-slider/{slider_id}',[\App\http\Controllers\SliderBannerController::class,'active_slider']);

// danh mục tin tức
Route::resource('/categorynew', CategoryNewsController::class);

// trang thái danh mục bài đang tin tức
Route::get('/unactive-cate-new/{cate_news_id}',[\App\http\Controllers\CategoryNewsController::class,'unactive_cate_new']);

Route::get('/active-cate-new/{cate_news_id}',[\App\http\Controllers\CategoryNewsController::class,'active_cate_new']);

// News => tin tức
Route::resource('/news', NewsController::class);

// trang thái bài đang tin tức
Route::get('/unactive-news/{news_id}',[\App\http\Controllers\NewsController::class,'unactive_news']);

Route::get('/active-news/{news_id}',[\App\http\Controllers\NewsController::class,'active_news']);

// sử lý bài viết bên ngoài người dùng 
Route::get('/show-cate-news/{cate_news_id}',[\App\http\Controllers\NewsController::class,'show_cate_news']);

// xem chi tiết bai viết /xem-bai-viet
Route::get('/view-news/{news_id}',[\App\http\Controllers\NewsController::class,'view_news']);










// show tat ca san pham
Route::get('/show-all-product',[\App\http\Controllers\productController::class,'show_all_product']);


// quan ly don hang trong admin
Route::get('/manager-order-products',[\App\http\Controllers\checkoutcontrller::class,'manager_order_products']);

// phê duyêt đơn hàng => order_status = 0
Route::get('/active-order/{order_id}',[\App\http\Controllers\checkoutcontrller::class,'active_order']);

// không phê duyệt đơn hàng => order_status = 1
Route::get('/unactive-order/{order_id}',[\App\http\Controllers\checkoutcontrller::class,'unactive_order']);

// xem chi tiết đơn hàng
Route::get('/view-order-details-product/{orderId}',[\App\http\Controllers\checkoutcontrller::class,'view_order_details_product']);

// xem đơn hàng danh cho người mua hàng
Route::get('/customer-order-details',[\App\http\Controllers\checkoutcontrller::class,'customer_order_details']);

// method xoa đơn hang cho khác Hàng /delete-order-details
Route::post('/delete-order-details/{order_details_id}',[\App\http\Controllers\checkoutcontrller::class,'delete_order_details']);

// method xóa đơn hang trong trang admin
Route::post('/delete-order-admin/{order_id}',[\App\http\Controllers\checkoutcontrller::class,'delete_order_admin']);





// font - end => danh cho người dung => UI =>Route Cart
// function save-cart
Route::post('/save-cart', [\App\http\Controllers\cartcontroller::class,'save_cart']);

//update cart quantity => update so luong san pham
Route::post('/update-cart-qty', [\App\http\Controllers\cartcontroller::class,'update_cart_qty']);

// show cart 
Route::get('/Show-cart', [\App\http\Controllers\cartController::class,'Show_cart']);

//delete cart
Route::get('/delete-to-cart/{rowId}', [\App\http\Controllers\cartController::class,'delete_to_cart']);

// đang ký cho ngươi mua hang và thanh toán tiên mua hang 
Route::get('/login-checkout', [\App\http\Controllers\checkoutcontrller::class,'login_checkout']);

// đang nhập khi có tài khoản rồi
Route::post('/login-account-customer', [\App\http\Controllers\checkoutcontrller::class,'login_account_customer']);

// đang xuất
Route::get('/logout-checkout', [\App\http\Controllers\checkoutcontrller::class,'logout_checkout']);



// đăng ký tài khoản khach hàng => register customer
Route::post('/add-customer', [\App\http\Controllers\checkoutcontrller::class,'add_customer']);

//kiem tra đang nhap chưa nếu đang nhập rồi thi chuyến đến thanh toán
Route::get('/checkout', [\App\http\Controllers\checkoutcontrller::class,'checkout_customer']);

// lưu thông tin đặt hàng
Route::post('/save-cart-checkout', [\App\http\Controllers\checkoutcontrller::class,'save_cart_checkout']);

//chon hinh thuc thanh toan
Route::get('/payment', [\App\http\Controllers\checkoutcontrller::class,'payment']);

// code xu ly hinh thuc thanh toan
Route::post('/payment-method-order', [\App\http\Controllers\checkoutcontrller::class,'payment_method_order']);

// sử lý thư viên hình ảnh => gallery
Route::get('/add-gallery/{product_id}', [\App\http\Controllers\galleryController::class,'add_gallery']);

Route::post('select-gallery', [\App\http\Controllers\galleryController::class,'select_gallery']); 


// insert  thư viên ảnh /insert-gallery-image

Route::post('/insert-gallery-image/{prod_id}', [\App\http\Controllers\galleryController::class,'insert_gallery_image']); 

// update ten tung hinh anh trong thu vien /update-name-img-gallery
Route::post('/update-name-img-gallery', [\App\http\Controllers\galleryController::class,'update_name_img_gallery']); 

//xóa ảnh trong thư viên ảnh delete-gallery
Route::post('delete-gallery', [\App\http\Controllers\galleryController::class,'delete_gallery']); 
// update image in trong thu vien update-gallery
Route::post('update-gallery', [\App\http\Controllers\galleryController::class,'update_gallery']); 

// add wishlist
Route::post('/add-wishlist/{product_id}',[\App\http\Controllers\WishlistController::class,'add_wishlist']);
// show wishlist
Route::get('/show-wishlist',[\App\http\Controllers\WishlistController::class,'show_wishlist']);


/// code cho upload ckeditor
Route::post('/uploads-ckeditor',[\App\http\Controllers\ckeditorController::class,'ckeditor_images']);

// đang làm => do ko có mạng nên chưa chạy được
Route::get('/file-browser',[\App\http\Controllers\ckeditorController::class,'file_browser']);



// tạo liện hiệ
Route::get('/view-contact',[\App\http\Controllers\ContactController::class,'view_contact']);

// show trang admin contact
Route::get('/show-contact-page-admin',[\App\http\Controllers\ContactController::class,'show_contact_page_admin']);

// lưu thông tin liên hệ của khách hàng
Route::post('/sent-info-shop',[\App\http\Controllers\ContactController::class,'sent_info_shop']);

// Xóa liên hệ /delete-contact
Route::post('/delete-contact/{contact_id}',[\App\http\Controllers\ContactController::class,'delete_contact']);
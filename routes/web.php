<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\AddtocartController;
use App\Http\Controllers\CoupunController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SslCommerzPaymentController;




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
//generates AdmonController
Route::get('/', [AdminController::class, 'start'])->name('home');
Route::get('contact', [AdminController::class, 'contact'])->name('contact');
Route::get('service', [AdminController::class, 'service']);
Route::get('single/product/{product_id}', [AdminController::class, 'singleProduct'])->name('single_product');
Route::get('shop', [AdminController::class, 'shop'])->name('shop');
Route::get('shop/single/category/{category_id}', [AdminController::class, 'singleShop'])->name('singleShop');
Route::post('checkout/post', [AdminController::class, 'checkoutPost'])->name('checkout_post');
Route::get('customer/login', [AdminController::class, 'customerLogin'])->name('customer_login');
Route::post('customer/login/post', [AdminController::class, 'customerLoginPost'])->name('customerLogin.post');





//generates CategoryController
Route::get('category', [CategoryController::class, 'category']);
Route::post('category/post', [CategoryController::class, 'categoryPost']);
Route::get('category/update/{category_id}', [CategoryController::class, 'categoryUpdate'])->name('category_update');
Route::get('category/delete/{category_id}', [CategoryController::class, 'categoryDelete'])->name('category_delete');
Route::post('category/post/update', [CategoryController::class, 'categoryUpdatePost']);
Route::post('category/checked_delete', [CategoryController::class, 'categoryCheckedDelete'])->name('checked_delete');
Route::get('category/restore/{category_id}', [CategoryController::class, 'categoryRestore'])->name('category_restore');
Route::get('category/forcedelete/{category_id}', [CategoryController::class, 'categoryForceDelete'])->name('category_force_delete');









//generates productController
Route::get('product', [ProductController::class, 'product'])->name('product_index');
Route::post('product/post', [ProductController::class, 'productPost'])->name('product_post');
Route::get('product/update/{product_id}', [ProductController::class, 'productUpdate'])->name('update_product_name');
Route::get('product/delete/{product_id}', [ProductController::class, 'productDelete'])->name('product_delete');
Route::post('product/checked_delete', [ProductController::class, 'productCheckedDelete'])->name('product_checked_delete');
Route::post('product/post/update', [ProductController::class, 'productUpdatePost'])->name('product_update_post');
Route::get('product/restore/{product_id}', [ProductController::class, 'productRestore'])->name('product_restore');
Route::get('product/force/delete/{product_id}', [ProductController::class, 'productForceDelete'])->name('product_force_delete');
Route::get('subcategory/post/{category_id}', [ProductController::class, 'subcategoryPost']);


//generates FAQController
Route::get('faq', [FaqController::class, 'faq'])->name('faq');
Route::post('faq/post', [FaqController::class, 'faqPost'])->name('faqpost');
Route::get('faq/delete{faq_id}', [FaqController::class, 'faqDelete'])->name('faqdelete');
Route::get('faq', [FaqController::class, 'faq'])->name('faq');


//generates TESTIMONIALController
Route::get('testimonial', [TestimonialController::class, 'index'])->name('testimonial');
Route::post('testimonial/post', [TestimonialController::class, 'testimonialPost'])->name('testimonialpost');


//generates FormController
Route::post('form/post', [FormController::class, 'formPost'])->name('formPost');


// generates SettingController;er
Route::get('slider', [SliderController::class, 'slider'])->name('slider');
Route::post('slider/post', [SliderController::class, 'sliderPost'])->name('sliderpost');



// generates SettingController
Route::get('setting', [SettingController::class, 'setting'])->name('setting');
Route::post('setting/post', [SettingController::class, 'settingpost'])->name('settingpost');


// generates SubCategoryController
Route::get('sub/category', [SubcategoryController::class, 'subCategory'])->name('subCategory');
Route::post('sub/category/post', [SubcategoryController::class, 'subCategoryPost'])->name('subcategory_post');







// generates AddToCartCategoryController
Route::post('add/to/cart/{product_id}', [AddtocartController::class, 'addcart'])->name('add_cart');
Route::get('cart/delete/{cart_id}', [AddtocartController::class, 'cartDelete'])->name('cart_delete');
Route::post('cart/update', [AddtocartController::class, 'cartUpdate'])->name('cart_update');
Route::get('cart', [AddtocartController::class, 'cart'])->name('cart');
Route::get('cart/{coupun_name}', [AddtocartController::class, 'cart'])->name('cart_coupun');
Route::get('checkout', [AddtocartController::class, 'checkOut'])->name('checkout');
Route::post('city/post', [AddtocartController::class, 'cityPost']);
Route::post('checkout/billing/post', [AddtocartController::class, 'billingPost'])->name('billing.post');




// generates google authentication login
Route::get('auth/redirect', [SocialController::class, 'redirect']);
Route::get('callback/google', 'App\Http\Controllers\SocialController@callback');






// generates CoupunController
Route::resource('coupun', CoupunController::class);





// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END






Auth::routes();


//generates HomeController
Route::get('/home', [HomeController::class, 'index']);
Route::get('invoice/download/{orderid}', [HomeController::class, 'invoiceDownload'])->name('invoice.download');


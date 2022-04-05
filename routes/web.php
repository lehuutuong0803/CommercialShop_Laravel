<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\EditingController;
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



Route::get('/quan-tri/dang-nhap', function () {
    return view('admin.login');
});
Route::post('/quan-tri/dang-nhap',[AdminController::class,'loginPost'])->name('admin.loginPost');
Route::get('/quan-tri/dang-xuat',[AdminController::class,'logout'])->name('admin.logout');

Route::middleware(['admin']) ->group(function (){
    Route::get('/quan-tri/trang-chu',[AdminController::class,'home'])->name('admin.home');
    Route::get('/quan-tri/thong-ke',[AdminController::class,'statistic'])->name('admin.statistic');
    Route::get('/quan-tri/danh-sach/{model}',[ListingController::class,'index'])->name('listing.index');
    Route::post('/quan-tri/danh-sach/{model}',[ListingController::class,'index'])->name('listing.index');
    Route::get('/quan-tri/cap-nhat/{model}',[EditingController::class,'create'])->name('editing.create');
    Route::post('/quan-tri/cap-nhat/{model}',[EditingController::class,'store'])->name('editing.store');

    Route::get('/quan-tri/chinh-sua/{model}/{id}',[EditingController::class,'update'])->name('editing.update');
    Route::post('/quan-tri/chinh-sua/{model}/{id}',[EditingController::class,'updating'])->name('editing.updating');

    Route::get('/quan-tri/xoa/{model}/{id}',[EditingController::class,'deleting'])->name('editing.deleting');
});


Route::get('/',[\App\Http\Controllers\Client\HomeController::class,'index'])->name('home.index')->middleware('web');

Route::get('/thong-tin',[\App\Http\Controllers\Client\HomeController::class,'about'])->name('home.about')->middleware('web');
Route::get('/san-pham',[\App\Http\Controllers\Client\HomeController::class,'gallery'])->name('home.gallery')->middleware('web');
Route::post('/san-pham',[\App\Http\Controllers\Client\HomeController::class,'gallery'])->name('home.gallery')->middleware('web');
Route::get('/chi-tiet-san-pham/{id}',[\App\Http\Controllers\Client\HomeController::class,'gallery_details'])->name('home.gallery_details')->middleware('web');
Route::get('/gio-hang',[\App\Http\Controllers\Client\CartController::class,'index'])->name('cart.index')->middleware('web');
Route::get('/them-sp-gio-hang/{id}',[\App\Http\Controllers\Client\CartController::class,'addcart'])->name('cart.addcart')->middleware('web');
Route::get('/xoa-sp-gio-hang/{id}',[\App\Http\Controllers\Client\CartController::class,'deleteitemcart'])->name('cart.deleteitemcart')->middleware('web');
Route::get('/cap-nhat-sp-gio-hang/{id}/{quanty}',[\App\Http\Controllers\Client\CartController::class,'updateitemcart'])->name('cart.updateitemcart')->middleware('web');
Route::get('/thanh-toan',[\App\Http\Controllers\Client\CartController::class,'checkout'])->name('cart.checkout')->middleware('web');
Route::get('/lich-su',[\App\Http\Controllers\Client\HomeController::class,'payment_history'])->name('cart.payment_history')->middleware('web');
Route::get('/chi-tiet-hoa-don/{id}',[\App\Http\Controllers\Client\HomeController::class,'detailed_payment'])->name('cart.detailed_payment')->middleware('web');
Route::get('/thong-tin-tai-khoan',[\App\Http\Controllers\Client\HomeController::class,'profile'])->name('home.profile')->middleware('web');
Route::get('/chinh-sua-tai-khoan',[\App\Http\Controllers\Client\HomeController::class,'editing_profile'])->name('home.editing_profile')->middleware('web');
Route::post('/chinh-sua-tai-khoan',[\App\Http\Controllers\Client\HomeController::class,'editing_profile_active'])->name('home.editing_profile_active')->middleware('web');
Route::post('/binh-luan/{id}',[\App\Http\Controllers\Client\HomeController::class,'comment'])->name('home.comment')->middleware('web');

Route::get('/dashboard',[\App\Http\Controllers\Client\HomeController::class,'index'])->name('home.index1')->middleware('web');


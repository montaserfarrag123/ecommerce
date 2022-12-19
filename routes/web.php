<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\order;
use App\Http\Controllers\userController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\wishlistController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/' , [FrontendController::class,'frontend']);
Route::get('/category' , [FrontendController::class,'category']);
Route::get('/viewCategory/{slug}' , [FrontendController::class,'viewCategory']);
Route::get('/viewCategory/{cat_slug}/{prod_slug}' , [FrontendController::class,'viewproduct']);

Auth::routes();
Route::get('/load-cart-data',[cartController::class,'cartCount']);
Route::post('/add-to-cart',[cartController::class,'addproduct']);
Route::post('/delete-cart-item',[cartController::class,'deleteproduct']);
Route::post('/cart-update',[cartController::class,'cartUpdate']);
Route::post('/add-to-wishlist' , [wishlistController::class,'add']);
Route::post('/remove-wishlist-item' , [wishlistController::class,'destroy']);
Route::get('/load-wishlist-data' , [wishlistController::class,'wishlistCount']);


//Routs With Auth
Route::middleware(['auth'])->group(function () {
  Route::get('cart' , [cartController::class , 'index']);
  Route::get('checkout' , [checkoutController::class , 'index']);
  Route::post('place-order' , [checkoutController::class , 'placeOrder']);
  Route::get('/my-order' , [userController::class,'index']);
  Route::get('/view-orders/{id}' , [userController::class,'view']);
  Route::get('/wishlist' , [wishlistController::class,'index']);
  Route::post('/proceed-to-pay' , [checkoutController::class,'razorpayCheck']);


  });
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//   -------------Routs Of Admin--------------
 Route::middleware(['auth' , 'isAdmin'])->group(function(){

    Route::get('/dashboard', [FrontendController::class,'index'] );

    //routs category
    Route::get('/categories'    ,  [CategoryController::class,'index']);
    Route::get('/createCat'     ,  [CategoryController::class,'create']);
    Route::post('/storeCat'     ,  [CategoryController::class,'store']);
    Route::get('/editCat/{id}'  ,  [CategoryController::class,'edit']);
    Route::put('updateCat/{id}' ,  [CategoryController::class,'update']);
    Route::delete('deleteCat/{id}' ,  [CategoryController::class,'destroy']);

    //routes product
    Route::get('/products'       ,  [ProductController::class,'index']);
    Route::get('/createproduct'  ,  [ProductController::class,'create']);
    Route::post('/storeproduct'     ,  [ProductController::class,'store']);
    Route::get('/editproduct/{id}'  ,  [ProductController::class,'edit']);
    Route::put('updateproduct/{id}' ,  [ProductController::class,'update']);
    Route::delete('deleteproduct/{id}' ,  [ProductController::class,'destroy']);

    // routs Orders
    Route::get('orders', [orderController::class,'index']);
    Route::get('admin/view-orders/{id}', [orderController::class,'view']);
    Route::put('update-order/{id}', [orderController::class,'updateOrder']);
    Route::get('order-history', [orderController::class,'orderHistory']);

        //routs Users
    Route::get('users', [dashboardController::class,'users']);
    Route::get('view-user/{id}', [dashboardController::class,'viewUser']);



 });

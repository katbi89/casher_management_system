<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductsController;

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

// admin and casher can access this routes
Route::middleware('auth')->group(function () {
    // home page route
    Route::get('/', [HomeController::class, 'index']);

    // create order route
    Route::post('/create-order', [OrderController::class, 'create']);

    // profile routes
    Route::get('/profile', [UserController::class, 'readSingle']);
    Route::post('/update-user', [UserController::class, 'update']);
});

// only admin can access this routes
Route::middleware('admin')->group(function () {

    // orders routes
    Route::get('/all-orders', [OrderController::class, 'read']);
    Route::get('/order-details/{order_id}', [OrderController::class, 'readSigle']);
    Route::get('/product-back/{product_id}/{order_id}/{price}', [OrderController::class, 'product_back']);
    Route::post('/delete-order', [OrderController::class, 'delete']);

    // users routes (create & delete & read)
    Route::get('/add-user', function () {
        return view('add_user');
    });
    Route::post('/add-user', [UserController::class, 'create']);
    Route::get('/all-users', [UserController::class, 'read']);
    Route::post('/delete-user', [UserController::class, 'delete']);

    // products routes
    Route::get('/add-product', function () {
        return view('add_product');
    });

    Route::get('/add-details-for-product', function () {
        return view('add_details_for_product');
    });

    Route::get('/out-of-stock', function () {
        return view('out_of_stock');
    });

    Route::post('/add-product', [ProductsController::class, 'create']);
    Route::post('/add-details-for-product', [ProductsController::class, 'addDetails']);
    Route::get('/all-products', [ProductsController::class, 'read']);
    Route::post('/delete-product', [ProductsController::class, 'delete']);
    Route::get('/update-product/{id}/{product_id}', [ProductsController::class, 'readSingle']);
    Route::post('/update-product', [ProductsController::class, 'update']);
    Route::get('/out-of-stock/{quantity}', [ProductsController::class, 'out_of_stock']);

    // Discounts routes
    Route::get('/make-discount', function () {
        return view('make_discount');
    });

    Route::post('/make-discount', [DiscountController::class, 'product']);
    Route::get('/all-discounts', [DiscountController::class, 'read']);
    Route::post('/delete-discount', [DiscountController::class, 'delete']);

    // customers routes (read & delete) create customer is done when make order
    Route::get('/special-customers', function () {
        return view('special_customers');
    });

    Route::get('/customers', [CustomersController::class, 'read']);
    Route::get('/special-customers/{cost}', [CustomersController::class, 'special']);
    Route::post('/delete-customer', [CustomersController::class, 'delete']);
});

// auth routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

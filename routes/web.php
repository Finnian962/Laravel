<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderRowController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home', [
            'categories' => Category::withCount('products')->get(),
        ]);
    })->name('home');

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::get('/categories/{category}', [CategoryController::class, 'show'])
        ->name('categories.show');

    Route::post('/categories/create', [CategoryController::class, 'create'])
        ->name('categories.create');

    Route::delete('/categories/delete/{category}', [CategoryController::class, 'delete'])
        ->name('categories.delete');

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::post('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::delete('/products/delete/{product}', [ProductController::class, 'delete'])
        ->name('products.delete');

    Route::get('/prices', [PriceController::class, 'index'])
        ->name('prices.index');

    Route::post('/prices/create', [PriceController::class, 'create'])
        ->name('prices.create');

    Route::delete('/prices/delete/{price}', [PriceController::class, 'delete'])
        ->name('prices.delete');

    Route::get('/roles', [RoleController::class, 'index'])
        ->name('roles.index');

    Route::post('/roles/create', [RoleController::class, 'create'])
        ->name('roles.create');

    Route::delete('/roles/delete/{role}', [RoleController::class, 'delete'])
        ->name('roles.delete');

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::post('/users/create', [UserController::class, 'create'])
        ->name('users.create');

    Route::delete('/users/delete/{user}', [UserController::class, 'delete'])
        ->name('users.delete');

    Route::get('/reviews', [ReviewController::class, 'index'])
        ->name('reviews.index');

    Route::post('/reviews/create', [ReviewController::class, 'create'])
        ->name('reviews.create');

    Route::delete('/reviews/delete/{review}', [ReviewController::class, 'delete'])
        ->name('reviews.delete');

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::post('/orders/create', [OrderController::class, 'create'])
        ->name('orders.create');

    Route::delete('/orders/delete/{order}', [OrderController::class, 'delete'])
        ->name('orders.delete');

    Route::get('/orderrows', [OrderRowController::class, 'index'])
        ->name('orderrows.index');

    Route::post('/orderrows/create', [OrderRowController::class, 'create'])
        ->name('orderrows.create');

    Route::delete('/orderrows/delete/{orderrow}', [OrderRowController::class, 'delete'])
        ->name('orderrows.delete');
});

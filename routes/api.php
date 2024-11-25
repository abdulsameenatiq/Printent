<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\DirectOrdersController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\TrackOrderController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;


Route::group(['middleware' => 'api'], function () {
    // Auth
    Route::post('register', [AuthController::class, 'create']);
    Route::get('verifyEmail/{id}', [AuthController::class, 'verify']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('changePassword', [AuthController::class, 'changePassword']);
    Route::post('profileUpdate', [AuthController::class, 'profileUpdate']);
    Route::get('profile', [AuthController::class, 'profile']);


    Route::get('getAllCategories', [CategoryController::class, 'show']);


    route::post('addAddress', [AddressController::class, 'store']);
    route::get('getAddress', [AddressController::class, 'show']);
    route::get('getAllSubcategory', [SubcategoryController::class, 'show']);
    route::get('getSubCategoryProducts/{id}', [SubcategoryController::class, 'SubCategoryProducts']);
    route::get('getSubcategoriesByCategory/{id}', [SubcategoryController::class, 'getSubcategoriesByCategory']);
    
    route::get('trackOrder', [TrackOrderController::class, 'track']);
    
    Route::get('getAllCategories', [CategoryController::class, 'show']);
    Route::get('getCategoryProducts/{id}', [CategoryController::class, 'CategoryProducts']);
    
    Route::get('getAllProducts', [ProductController::class, 'show']);
    Route::post('updateProduct/{id}', [ProductController::class, 'update']);
    Route::get('getSingleProduct/{id}', [ProductController::class, 'index']);
    Route::get('SearchProduct', [ProductController::class, 'searchProduct']);
    
    Route::post('cart', [CartController::class, 'store']);
    Route::delete('deleteCart/{id}', [CartController::class, 'destroy']);
    Route::post('updateCart/{id}', [CartController::class, 'update']);
    Route::get('getCart', [CartController::class, 'show']);
    
    
    Route::post('quote', [QuoteController::class, 'store']);
    Route::delete('deleteQuote/{id}', [QuoteController::class, 'destroy']);
    
    
    
    Route::post('directOrder', [DirectOrdersController::class, 'store']);
    Route::get('getAllDirectOrders', [DirectOrdersController::class, 'show']);
    Route::delete('deleteDirectOrder/{id}', [DirectOrdersController::class, 'destroy']);
    
    Route::post('design', [DesignController::class, 'store']);
    Route::get('getAllDesign', [DesignController::class, 'show']);
    Route::get('getsingleDesign', [DesignController::class, 'index']);
    
    
    Route::post('placeOrder', [OrdersController::class, 'store']);
    Route::get('getOrder', [OrdersController::class, 'show']);
    
    
    Route::group(['middleware' => ['api']], function () {
        //Category
        Route::post('category', [CategoryController::class, 'create'])->middleware(RoleMiddleware::class . ':1');
        Route::post('updateCategory/{id}', [CategoryController::class, 'update'])->middleware(RoleMiddleware::class . ':1');
        Route::delete('deleteCategory/{id}', [CategoryController::class, 'destroy'])->middleware(RoleMiddleware::class . ':1');
        
        //Product
        Route::post('product', [ProductController::class, 'store'])->middleware(RoleMiddleware::class . ':1');
        Route::delete('deleteProduct/{id}', [ProductController::class, 'destroy'])->middleware(RoleMiddleware::class . ':1');
        
        //Subcategory
        route::delete('deleteSubCategory/{id}', [SubcategoryController::class, 'destroy'])->middleware(RoleMiddleware::class . ':1');
        route::post('updateSubCategory/{id}', [SubcategoryController::class, 'update'])->middleware(RoleMiddleware::class . ':1');
        route::post('addSubcategory', [SubcategoryController::class, 'create'])->middleware(RoleMiddleware::class . ':1');
        Route::delete('deleteDesign/{id}', [DesignController::class, 'destroy'])->middleware(RoleMiddleware::class . ':1');
        Route::get('getAllquotes', [QuoteController::class, 'show'])->middleware(RoleMiddleware::class . ':1');
        Route::get('getAllOrder', [OrdersController::class, 'index'])->middleware(RoleMiddleware::class . ':1');
    });
});

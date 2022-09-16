<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth_Api\{
    AuthController,
    UpdateProfileController
};
use App\Http\Controllers\{
    CategoryController,
    OrderController,
    SupplierController,
    CustomerController,
    PermissionController,
    ColorController,
    ShippingListController,
    PaymentListController,
    SizeListController,
    ConfirmOrderController,
    OrderOutOfStockController,
    ListNotificationController,
    UserNotificationController,
    UpdateUserDetailController,
    UserController,
    ListRuleController,
    RoleController,
    SaveProductQuantityController,
    UpdateProductAvailableController,
    ProductColorPictureController,
    DeleteManyPictureController,
    DeleteManyProductController,
    ProductController
};
use App\Http\Controllers\Home\FrontendProductController;
use App\Http\Controllers\Admin\AdminDashboard;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout']);
    Route::put('update/{user}', UpdateProfileController::class);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::get('shippings', ShippingListController::class);
Route::get('payments', PaymentListController::class);

Route::apiResource('categories', CategoryController::class);
Route::group([
    'namespace' => 'Home',
], function () {
    Route::get('getAllProducts', [FrontendProductController::class,'getAllProducts']);
    Route::get('fetchProdsByKey', [FrontendProductController::class,'fetchProdsByKey']);
    Route::get('getProductsNewRelease', [FrontendProductController::class,'getProductsNewRelease']);
    Route::get('getRelatedProducts/{product}', [FrontendProductController::class,'getRelatedProducts']);
    Route::get('filterProductsBySize', [FrontendProductController::class,'filterProductsBySize1']);
    Route::get('getProduct/{product}', [FrontendProductController::class,'getProduct']);
});

Route::get('fetchOrders/{uid}', [OrderController::class,'fetchOrdersByUserID']);

Route::apiResource('colors', ColorController::class);

Route::get('sizes', SizeListController::class);
Route::post('register', [AuthController::class,'register']);
Route::group(['middleware' => 'auth.api'], function () {
    Route::prefix('admin/dashboard')->group(function() {
        Route::get('/', [AdminDashboard::class,'index']);
        Route::get('/customer', [AdminDashboard::class,'filterCustomerBtwDate']);
        Route::get('/supplier', [AdminDashboard::class,'filterSupplierBtwDate']);
        Route::get('/order', [AdminDashboard::class,'filterOrderBtwDate']);
    });

    Route::post('confirmOrder/{madh}', ConfirmOrderController::class);
    Route::post('outOfStock/{madh}', OrderOutOfStockController::class);
    Route::apiResource('orders',OrderController::class)->only(['store','index','destroy']);

    Route::get('notifications', ListNotificationController::class);
    Route::delete('deleteNotify/{user}/{notifyID}', [UserNotificationController::class,'delete']);
    Route::get('markAsRead/{user}/{notifyID}', [UserNotificationController::class,'markAsRead']);

    Route::put('userDetail/{userDetail}', UpdateUserDetailController::class);

    Route::apiResource('users', UserController::class);
    Route::get('rules', ListRuleController::class);
    Route::apiResource('roles', RoleController::class);


    Route::prefix('products')->group(function() {
        Route::put('saveQuantity/{color_size}', SaveProductQuantityController::class);
        Route::put('updateProdStatus/{product}', UpdateProductAvailableController::class);
        Route::prefix("{product}/colors/{color}/pictures")->group(function() {
            Route::apiResource("/", ProductColorPictureController::class)->only(['index','store']);
        });
        Route::post('pictures/deleteSelectedItem', DeleteManyPictureController::class);
        Route::apiResource("/", ProductController::class);
    });

    Route::post('deleteItems', DeleteManyProductController::class);

    Route::apiResource("suppliers", SupplierController::class);

    Route::apiResource("customers", CustomerController::class);

    Route::apiResource('permissions', PermissionController::class);
});

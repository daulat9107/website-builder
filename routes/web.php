<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\DataTable\PurchaserController;
use App\Http\Controllers\DataTable\SupplierController;
use App\Http\Controllers\DataTable\TransportController;
use App\Http\Controllers\DataTable\ProductController;
use App\Http\Controllers\DataTable\AddressController;
use App\Http\Controllers\DataTable\FirmController;
use App\Http\Controllers\DataTable\AgencyController;
use App\Http\Controllers\DataTable\GroupController;
use App\Http\Controllers\DataTable\AccountController;
use App\Http\Controllers\DataTable\PageController;
use App\Http\Controllers\DataTable\OrdersController;
use App\Http\Controllers\DataTable\TrackOrdersStatusController;
use App\Http\Controllers\DataTable\OrderProductsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TradingPlanController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/themes', function () {
        return Inertia::render('Themes');
    })->name('themes');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/ui', function () {
    return Inertia::render('UI');
})->name('ui');
Route::middleware(['auth:sanctum', 'verified'])->get('/files', [FileController::class,'index'])->name('files');

/**
 * Purchasers
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/purchasers', PurchaserController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/purchasers', function () {
        return Inertia::render('Purchasers');
    })->name('purchasers');
});

/**
 * Suppliers
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/suppliers', SupplierController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/suppliers', function () {
        return Inertia::render('Suppliers');
    })->name('suppliers');
});


/**
 * Transports
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/transports', TransportController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/transports', function (Request $request) {
        return Inertia::render('Transports',['group_id'=> $request->group_id]);
    })->name('transports');
});

/**
 * Orders
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/orders', OrdersController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/orders', function (Request $request) {
        return Inertia::render('Orders',['id'=> $request->id]);
    })->name('orders');
});

/**
 * track-orders-status
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/track-orders-status', TrackOrdersStatusController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/track-orders-status', function () {
        return Inertia::render('TrackOrdersStatus');
    })->name('track-orders-status');
});


/**
 * order-products
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/order-products', OrderProductsController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/order-products', function (Request $request) {
        return Inertia::render('OrderProducts',['order_id' => $request->order_id]);
    })->name('order-products');
});


/**
 * Products
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/products', ProductController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/products', function () {
        return Inertia::render('Products');
    })->name('products');
    Route::get('/products-by-supplier', [ProductController::class,'getProductBySupplier'])->name('products-by-supplier');
});


/**
 * addresses
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/addresses', AddressController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/addresses', function (Request $request) {
        return Inertia::render('Addresses',['group_id'=> $request->group_id]);
    })->name('addresses');
});


/**
 * firms
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/firms', FirmController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/firms', function () {
        return Inertia::render('Firms');
    })->name('firms');
});

/**
 * agencies
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/agencies', AgencyController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/agencies', function () {
        return Inertia::render('Agencies');
    })->name('agencies');
});


/**
 * groups
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/groups', GroupController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/groups', function () {
        return Inertia::render('Groups');
    })->name('groups');
});

/**
 * accounts
 */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/accounts', AccountController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/accounts', function (Request $request) {
        return Inertia::render('Accounts',['group_id'=> $request->group_id]);
    })->name('accounts');
});

/**
 * pages
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->resource('datatable/pages', PageController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/pages', function () {
        return Inertia::render('Pages');
    })->name('pages');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/invoice', [InvoiceController::class,'create'])->name('invoice');
});

Route::get('/trading', [TradingPlanController::class,'index'])->name('trading');

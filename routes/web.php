<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\Delivery\DeliveryController;
use App\Http\Controllers\Dryers\DryerController;
use App\Http\Controllers\Orders\Orders;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\ScladController;
use App\Http\Controllers\Sclads\ScladDriesController;
use App\Http\Controllers\Sclads\ScladRawController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [ScladController::class, 'allmaterial'])->name('dashboard');
    Route::get('/sclad-raws', [ScladRawController::class, 'index'])->name('sclad_of_raws');
    Route::get('/sclad-dries', [ScladDriesController::class, 'index'])->name('sclad_of_dries');
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [Orders::class, 'index'])->name('orders.index');
        Route::resource('orders', Orders::class)->only([
            'store',
            'show',
            'destroy',
        ]);
        Route::put('/confirm-order/{id}', [Orders::class, 'confirmOrder'])->name('orders.confirm');
        Route::get('/order-history', [Orders::class, 'getOrderHistory'])->name('orders.history');
        Route::get('/get-materials', [Orders::class, 'getMaterialsForModal'])->name('orders.materials');
        Route::put('/update-order', [Orders::class, 'updateOrder'])->name('orders.update');
    });
    Route::group(['middleware' => 'check_role', 'prefix' => 'delivery'], function () {
        Route::resource('supplies', DeliveryController::class)->except([
            'edit',
            'update',
        ]);
        Route::delete('/deleteAll', [DeliveryController::class, 'destroyAllDelivery'])->name('supplies.delete');
    });

    Route::group(['middleware' => 'check_role', 'prefix' => 'sclad-dries'], function () {
        Route::put('/update', [ScladDriesController::class, 'update'])->name('sclad_of_dries.update');
        Route::get('/find-material/{id}', [ScladDriesController::class, 'findMaterialAmount'])->name(
            'sclad_of_dries.find'
        );
        Route::get('/drying-history', [ScladDriesController::class, 'getDryingHistory'])->name(
            'sclad_of_dries.history'
        );
    });

    Route::group(['middleware' => 'check_role', 'prefix' => 'sclad-raws'], function () {
        Route::post('/store-dryers', [ScladRawController::class, 'store'])->name('sclad_of_raws.store');
        Route::get('/find-material/{id}', [ScladRawController::class, 'find'])->name('sclad_of_raws.find');
        Route::put('/update', [ScladRawController::class, 'update'])->name('sclad_of_raw.update');
        Route::get('/get-raw-materials-for-modal', [ScladRawController::class, 'getRawMaterialsForModal'])->name(
            'sclad_of_raw.formodal'
        );
    });
    Route::group(['middleware' => 'check_role', 'prefix' => 'sclad-dryers'], function () {
        Route::get('/', [DryerController::class, 'index'])->name('dryer.index');
        Route::resource('dryer', DryerController::class)->except([
            'create',
            'index',
            'store',
            'destroy',
        ]);
    });

    Route::group(['middleware' => 'check_role', 'prefix' => 'revision'], function () {
        Route::get('/', [RevisionController::class, 'index'])->name('revision.index');
        Route::get('/create_revision', [RevisionController::class, 'createRevision'])->name('revisions.create');
        Route::get('/show-revision/{id}', [RevisionController::class, 'showRevision'])->name('revision.show');
        Route::post('/store-revision', [RevisionController::class, 'storeRevision'])->name('revision.store');
        Route::put('/confirm-revision/{id}', [RevisionController::class, 'confirmRevision'])->name('revision.confirm');
        Route::get('/history-revision', [RevisionController::class, 'getRevisionHistory'])->name('revision.history');
         Route::delete('/delete-revision/{id}', [RevisionController::class, 'deleteRevision'])->name('revision.destroy');
    });

    Route::group(['middleware' => 'admin', 'prefix' => 'admin-panel'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin_panel.index');
        Route::get('/edit-user/{id}', [AdminController::class, 'edit'])->name('admin_panel.edit');
        Route::post('/create-user', [AdminController::class, 'store'])->name('admin_panel.store');
        Route::delete('/delete-user/{user}', [AdminController::class, 'destroy'])->name(
            'admin_panel.destroy'
        );
        Route::put('/update-user', [AdminController::class, 'update'])->name('admin_panel.update');

        Route::get('/materials-edit/{id}', [AdminController::class, 'materialsEdit'])->name(
            'materials.edit'
        );
        Route::delete('/materials-delete/{materials}', [AdminController::class, 'materialsDelete'])->name(
            'materials.destroy'
        );
        Route::post('/materials-create', [AdminController::class, 'materialsStore'])->name(
            'materials.store'
        );
        Route::put('/materials-update', [AdminController::class, 'materialsUpdate'])->name(
            'materials.update'
        );

        Route::get('/admin-panel/dryers-edit/{id}', [AdminController::class, 'dryersEdit'])->name('dryers.edit');
        Route::delete('/admin-panel/dryers-delete/{dryers}', [AdminController::class, 'dryersDelete'])->name(
            'dryers.destroy'
        );
        Route::post('/admin-panel/dryers-create', [AdminController::class, 'dryersStore'])->name('dryers.store');
        Route::put('/admin-panel/dryers-update', [AdminController::class, 'dryersUpdate'])->name('dryers.update');
    });
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [LoginController::class, 'create'])->name('login');
    Route::post('/', [LoginController::class, 'store'])->name('login.post')->middleware('throttle:login');
});




<?php

use App\Http\Controllers\admin\DryersController;
use App\Http\Controllers\admin\MaterialsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrerController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\delivery\DeliveryController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Dryers\DryerController;
use App\Http\Controllers\Orders\Orders;
use App\Http\Controllers\ScladController;
use App\Http\Controllers\Sclads\MaterialDrieController;
use App\Http\Controllers\Sclads\MaterialRawController;
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
Route::group(['middleware' => 'auth'],function (){
    Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
    Route::get('/dashboard',[ScladController::class,'allmaterial'])-> name('dashboard');
    Route::get('/sclad_raws',[ScladRawController::class,'index'])-> name('sclad_of_raws');
    Route::get('/sclad_dries',[ScladDriesController::class,'index'])-> name('sclad_of_dries');
    Route::resource('orders',Orders::class)->only([
       'index',
    ]);
    Route::group(['middleware'=>'check_role','prefix'=>'delivery'],function (){
    Route::resource('supplies',DeliveryController::class)->except([
        'edit', 'update',
    ]);
    });

    Route::group(['middleware'=>'check_role','prefix'=>'sclad_dries'],function (){
        Route::resource('drie_materials',MaterialDrieController::class)->only([
            'edit', 'update',
        ]);
    });

    Route::group(['middleware' => 'check_role','prefix' => 'sclad_raws'],function () {
        Route::resource('raw_material', MaterialRawController::class)->only([
            'edit', 'update', 'create', 'store'
        ]);
    });
        Route::group(['middleware' => 'check_role','prefix' => 'sclad_dryers'],function () {
            Route::resource('dryer', DryerController::class)->except([
                'create','store','destroy',
            ]);
        });
    Route::group(['middleware' => 'admin','prefix'=>'admin'],function(){
        Route::resource('materials',MaterialsController::class)->only([
            'edit', 'update','store','destroy',
        ]);
        Route::resource('dryers',DryersController::class)->only([
            'edit', 'update','store','destroy',
        ]);
        Route::resource('admin_panel',AdminController::class)->except([
            'show', 'create',
        ]);
    });
});

Route::group(['middleware' => 'guest'],function(){
    Route::get('/',[LoginController::class,'create'])->name('login');
    Route::post('/',[LoginController::class,'store'])->name('login.post');
});




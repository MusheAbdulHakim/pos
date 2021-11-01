<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerTypeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\FilemanagerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\CustomerType;

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

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('',[DashboardController::class,'index']);
    Route::post('logout',[LoginController::class,'logout'])->name('logout');
    Route::get('login/locked', [LoginController::class,'locked'])->name('lockscreen');
    Route::post('login/locked', [LoginController::class,'unlock'])->name('login.unlock');

    Route::get('brand',[BrandController::class,'index'])->name('brand');
    Route::post('brand',[BrandController::class,'store']);
    Route::put('brand',[BrandController::class,'update']);
    Route::delete('brand',[BrandController::class,'destroy']);

    Route::get('tax',[TaxController::class,'index'])->name('tax');
    Route::post('tax',[TaxController::class,'store']);
    Route::put('tax',[TaxController::class,'update']);
    Route::delete('tax',[TaxController::class,'destroy']);

    Route::get('unit',[UnitController::class,'index'])->name('unit');
    Route::post('unit',[UnitController::class,'store']);
    Route::put('unit',[UnitController::class,'update']);
    Route::delete('unit',[UnitController::class,'destroy']);

    Route::get('customer-type',[CustomerTypeController::class,'index'])->name('customer-type');
    Route::post('customer-type',[CustomerTypeController::class,'store']);
    Route::put('customer-type',[CustomerTypeController::class,'update']);
    Route::delete('customer-type',[CustomerTypeController::class,'destroy']);

    Route::get('expense-category',[ExpenseCategoryController::class,'index'])->name('expense.category');
    Route::post('expense-category',[ExpenseCategoryController::class,'store']);
    Route::put('expense-category',[ExpenseCategoryController::class,'update']);
    Route::delete('expense-category',[ExpenseCategoryController::class,'destroy']);

    Route::get('permissions',[PermissionController::class,'index'])->name('permissions');
    Route::post('permissions',[PermissionController::class,'store']);
    Route::put('permissions',[PermissionController::class,'update']);
    Route::delete('permission',[PermissionController::class,'destroy'])->name('permission.destroy');


    Route::get('profile',[UserController::class,'profile'])->name('profile');
    Route::post('profile/{user}/update-profile',[UserController::class,'updateProfile'])->name('profile.update');
    Route::post('profile/{user}/change-password',[UserController::class,'updatePassword'])->name('profile.updatePassword');

    Route::resource('roles', RoleController::class);
    Route::resource('users',UserController::class);
    Route::resource('customers',CustomerController::class);
    Route::resource('suppliers',SupplierController::class);
    Route::resource('expenses',ExpenseController::class);

    Route::get('settings',[SettingController::class,'index'])->name('settings');

    Route::get('backup', [BackupController::class,'index'])->name('backup.index');
    Route::put('backup/create', [BackupController::class,'create'])->name('backup.store');
    Route::get('backup/download/{file_name?}', [BackupController::class,'download'])->name('backup.download');
    Route::delete('backup/delete/{file_name?}', [BackupController::class,'destroy'])->where('file_name', '(.*)')->name('backup.destroy');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware(['guest'])->group(function () {
    Route::get('login',[LoginController::class,'index'])->name('login');
    Route::post('login',[LoginController::class,'login']);
    Route::get('register',[RegisterController::class,'index'])->name('register');
    Route::post('register',[RegisterController::class,'store']);
    Route::get('forgot-password',[ForgotPasswordController::class,'index'])->name('forgot-password');
    Route::post('forgot-password',[ForgotPasswordController::class,'requestPassword']);
});


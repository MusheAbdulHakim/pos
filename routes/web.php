<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BackupController;
<<<<<<< HEAD
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerTypeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\FilemanagerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\CustomerType;
=======
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FilemanagerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
>>>>>>> e7e2e7a43cfaa6a7bd073ba9be0df634ee271e5a

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
<<<<<<< HEAD
    Route::get('',[DashboardController::class,'index']);
=======
>>>>>>> e7e2e7a43cfaa6a7bd073ba9be0df634ee271e5a
    Route::post('logout',[LoginController::class,'logout'])->name('logout');
    Route::get('login/locked', [LoginController::class,'locked'])->name('lockscreen');
    Route::post('login/locked', [LoginController::class,'unlock'])->name('login.unlock');

<<<<<<< HEAD
    Route::get('customer-type',[CustomerTypeController::class,'index'])->name('customer-type');
    Route::post('customer-type',[CustomerTypeController::class,'store']);
    Route::put('customer-type',[CustomerTypeController::class,'update']);
    Route::delete('customer-type',[CustomerTypeController::class,'destroy']);

    Route::get('expense-category',[ExpenseCategoryController::class,'index'])->name('expense.category');
    Route::post('expense-category',[ExpenseCategoryController::class,'store']);
    Route::put('expense-category',[ExpenseCategoryController::class,'update']);
    Route::delete('expense-category',[ExpenseCategoryController::class,'destroy']);

=======
>>>>>>> e7e2e7a43cfaa6a7bd073ba9be0df634ee271e5a
    Route::get('permissions',[PermissionController::class,'index'])->name('permissions');
    Route::post('permissions',[PermissionController::class,'store']);
    Route::put('permissions',[PermissionController::class,'update']);
    Route::delete('permission',[PermissionController::class,'destroy'])->name('permission.destroy');

<<<<<<< HEAD
=======
    Route::get('users',[UserController::class,'index'])->name('users.index');
    Route::get('users/create',[UserController::class,'create'])->name('users.create');
    Route::post('users',[UserController::class,'store'])->name('users.store');
    Route::get('users/{user}/edit',[UserController::class,'edit'])->name('user.edit');
    Route::put('users/{user}/update',[UserController::class,'update'])->name('user.update');
    Route::delete('users',[UserController::class,'destroy'])->name('user.destroy');
>>>>>>> e7e2e7a43cfaa6a7bd073ba9be0df634ee271e5a

    Route::get('profile',[UserController::class,'profile'])->name('profile');
    Route::post('profile/{user}/update-profile',[UserController::class,'updateProfile'])->name('profile.update');
    Route::post('profile/{user}/change-password',[UserController::class,'updatePassword'])->name('profile.updatePassword');

    Route::resource('roles', RoleController::class);
<<<<<<< HEAD
    Route::resource('users',UserController::class);
    Route::resource('customers',CustomerController::class);
    Route::resource('suppliers',SupplierController::class);
    Route::resource('expenses',ExpenseController::class);
=======
>>>>>>> e7e2e7a43cfaa6a7bd073ba9be0df634ee271e5a

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

<<<<<<< HEAD

=======
Route::get('/', function () {
    return view('welcome');
});
>>>>>>> e7e2e7a43cfaa6a7bd073ba9be0df634ee271e5a

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Common\SettingsController;
use App\Http\Controllers\Common\BlogController;
use App\Http\Controllers\Common\CategoryController;
use App\Http\Controllers\Common\PagesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\MenuController;

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

Route::get('/', function () {
    return view('welcome');
});
// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Email Verification
Route::get('/verification', [AuthController::class, 'verificationNotice'])->name('verification.notice')->middleware(['auth', 'shouldVerifyEmail']);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/admin')->with(['msg' => 'Thanks for registration', 'msg_type' => 'success']);
})->middleware(['auth', 'signed', 'shouldVerifyEmail'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1', 'shouldVerifyEmail'])->name('verification.send');

// Forogot Password
Route::get('/forgot-password', [AuthController::class, 'forgetPassword'])->middleware(['guest', 'shouldPasswordReset'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgetPasswordEmail'])->middleware(['guest', 'shouldPasswordReset'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPaassword'])->middleware(['guest', 'shouldPasswordReset'])->name('password.reset');
Route::post('/reset-password',[AuthController::class, 'paasswordUpdate'])->middleware(['guest', 'shouldPasswordReset'])->name('password.update');

// Registration
Route::middleware(['AllowedRegistration'])->group( function () {
    Route::view('/register','auth.register')->name('register');
    Route::post('/user/register',[AuthController::class, 'register'])->name('register.user');
});

// File manager
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Admin
Route::middleware(['auth', 'verified', 'CanAccessDashboard'])->prefix('admin')->group( function () {
    // Dashboard
    Route::get('/', [AuthController::class, 'dashboard'])->name('admin');

    // Settings
    Route::get('/settings/{type}', [SettingsController::class, 'index'])->name('settings')->middleware('role:accessSettings');
    Route::post('/settings/save', [SettingsController::class, 'save'])->name('settings.save')->middleware('role:accessSettings');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('role:viewUsers');
    Route::get('/users/get', [UserController::class, 'getUsers'])->name('users.get')->middleware('role:viewUsers');
    Route::get('/users/add', [UserController::class, 'addUsers'])->name('users.add')->middleware('role:addUsers');
    Route::post('/users/store', [UserController::class, 'storeUser'])->name('users.store')->middleware('role:addUsers');    
    Route::get('/users/{user:id}/edit', [UserController::class, 'editUsers'])->name('users.edit')->middleware('role:updateUsers');
    Route::post('/users/update', [UserController::class, 'updateUsers'])->name('users.update')->middleware('role:updateUsers');
    Route::get('/users/{id}/delete', [UserController::class, 'deleteuser'])->name('users.delete')->middleware('role:deleteUsers');

    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles')->middleware('role:viewRoles');
    Route::get('/roles/get', [RoleController::class, 'getRoles'])->name('roles.get')->middleware('role:viewRoles');
    Route::get('/roles/add', [RoleController::class, 'create'])->name('roles.add')->middleware('role:addRoles');
    Route::post('/roles/add', [RoleController::class, 'store'])->name('roles.store')->middleware('role:addRoles');
    Route::get('/roles/{id}/edit/', [RoleController::class, 'edit'])->name('roles.edit')->middleware('role:updateRoles');
    Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('role:updateRoles');
    Route::get('/roles/{id}/delete', [RoleController::class, 'destroy'])->name('roles.delete')->middleware('role:deleteRoles');

    // Pages
    Route::get('/pages', [PagesController::class, 'index'])->name('pages')->middleware('role:viewPages');
    Route::get('/pages/get', [PagesController::class, 'getPages'])->name('pages.get')->middleware('role:viewPages');
    Route::get('/pages/add', [PagesController::class, 'create'])->name('pages.add')->middleware('role:addPages');
    Route::post('/pages/add', [PagesController::class, 'store'])->name('pages.store')->middleware('role:addPages');
    Route::get('/pages/{pages:id}/edit/', [PagesController::class, 'edit'])->name('pages.edit')->middleware('role:updatePages');
    Route::post('/pages/{pages:id}/update/', [PagesController::class, 'update'])->name('pages.update')->middleware('role:updatePages');
    Route::get('/pages/{pages:id}/delete', [PagesController::class, 'destroy'])->name('pages.delete')->middleware('role:deletePages');

    // Menus    
    Route::get('/menus/{type}', [MenuController::class, 'index'])->name('menus')->middleware('role:viewMenus');
    Route::post('/menus/add', [MenuController::class, 'store'])->name('menus.store')->middleware('role:addMenus');

    // Blogs
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs')->middleware('role:viewBlogs');
    Route::get('/blogs/get', [BlogController::class, 'getBlogs'])->name('blogs.get')->middleware('role:viewBlogs');
    Route::get('/blogs/add', [BlogController::class, 'create'])->name('blogs.add')->middleware('role:addBlogs');
    Route::post('/blogs/add', [BlogController::class, 'store'])->name('blogs.store')->middleware('role:addBlogs');
    Route::get('/blogs/{blog:id}/edit/', [BlogController::class, 'edit'])->name('blogs.edit')->middleware('role:updateBlogs');
    Route::post('/blogs/{blog:id}/update/', [BlogController::class, 'update'])->name('blogs.update')->middleware('role:updateBlogs');
    Route::get('/blogs/{blog:id}/delete', [BlogController::class, 'destroy'])->name('blogs.delete')->middleware('role:deleteBlogs');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories')->middleware('role:viewCategories');
    Route::get('/categories/get', [CategoryController::class, 'getCategory'])->name('categories.get')->middleware('role:viewCategories');
    Route::post('/categories/add', [CategoryController::class, 'store'])->name('categories.store')->middleware('role:addCategories');
    Route::get('/categories/{category:id}/edit/', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('role:updateCategories');
    Route::post('/categories/{category:id}/update/', [CategoryController::class, 'update'])->name('categories.update')->middleware('role:updateCategories');
    Route::get('/categories/{category:id}/delete', [CategoryController::class, 'destroy'])->name('categories.delete')->middleware('role:deleteCategories');
});


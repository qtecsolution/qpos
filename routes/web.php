<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserManagementController;
use App\Http\Controllers\Backend\WebsiteSettingController;

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

// ====================== FRONTEND ======================

// homepage
Route::get('/', function () {
    return to_route('login');
})->name('frontend.home');

//authentication
Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], 'sign-up', [AuthController::class, 'register'])->name('signup');
Route::match(['get', 'post'], 'forget-password', [AuthController::class, 'forgetPassword'])->name('forget.password');
Route::match(['get', 'post'], 'new-password', [AuthController::class, 'newPassword'])->name('new.password');
Route::match(['get', 'post'], 'password-reset', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::get('resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');

// google auth
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.handle.callback');

// ====================== /FRONTEND =====================

// ====================== BACKEND =======================

Route::prefix('admin')->as('backend.admin.')->middleware(['admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // profile
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('profile/update', [AuthController::class, 'update'])->name('profile.update');

    // user management
    Route::prefix('users')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('users');
        Route::get('suspend/{id}/{status}', [UserManagementController::class, 'suspend'])->name('user.suspend');
        Route::match(['get', 'post'], 'create', [UserManagementController::class, 'create'])->name('user.create');
        Route::match(['get', 'post'], 'edit/{id}', [UserManagementController::class, 'edit'])->name('user.edit');
        Route::get('delete/{id}', [UserManagementController::class, 'delete'])->name('user.delete');
    });

    // settings
    Route::prefix('settings')->group(function () {
        // website settings
        Route::prefix('website')->group(function () {
            Route::controller(WebsiteSettingController::class)->prefix('general')->group(function () {
                Route::get('/', 'websiteGeneral')->name('settings.website.general');
                Route::post('update-info', 'websiteInfoUpdate')->name('settings.website.info.update');
                Route::post('update-contacts', 'websiteContactsUpdate')->name('settings.website.contacts.update');
                Route::post('update-social-links', 'websiteSocialLinkUpdate')->name('settings.website.social.link.update');
                Route::post('update-style-settings', 'websiteStyleSettingsUpdate')->name('settings.website.style.settings.update');
                Route::post('update-custom-css', 'websiteCustomCssUpdate')->name('settings.website.custom.css.update');
                Route::post('update-notification-settings', 'websiteNotificationSettingsUpdate')->name('settings.website.notification.settings.update');
                Route::post('update-website-status', 'websiteStatusUpdate')->name('settings.website.status.update');
            });

            Route::controller(RoleController::class)->prefix('roles')->group(function () {
                Route::get('/', 'index')->name('roles');
                Route::post('create', 'store')->name('roles.create');
                Route::get('show/{id}', 'show')->name('roles.show');
                Route::put('update/{id}', 'update')->name('roles.update');
                Route::get('delete/{id}', 'destroy')->name('roles.delete');
                Route::post('role-permission/{id}', 'updatePermission')->name('update.role-permissions');
                Route::get('role-wise-permissions/{id?}', 'roleWisePermissions')->name('role-wise-permissions');
            });

            Route::controller(PermissionController::class)->prefix('permissions')->group(function () {
                Route::get('/', 'index')->name('permissions');
                Route::post('create', 'store')->name('permissions.store');
                // Route::get('show/{id}', 'show')->name('roles.show');
                Route::put('update/{id}', 'update')->name('permissions.update');
                Route::get('delete/{id}', 'destroy')->name('permissions.delete');
            });
        });
    });
});

// ====================== /BACKEND ======================

Route::get('clear-all', function () {
    Artisan::call('optimize:clear');
    return redirect()->back();
});

Route::get('storage-link', function () {
    Artisan::call('storage:link');
    return redirect()->back();
});

Route::get('test', [TestController::class, 'test'])->name('test');

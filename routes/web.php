<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LanggananController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware('auth')->group( function () {
    $controller_path = 'App\Http\Controllers';
    
    Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
    Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
    Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
    Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
    Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
    Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');


    Route::resource('/langganan', LanggananController::class);
    
    // authentication
    Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
    Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
    Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');
    
    Route::get('/logout', [LoginController::class, 'logout']);
});
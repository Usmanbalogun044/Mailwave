<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BulkEmailController;
use App\Http\Controllers\CampaignController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('user.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/subscriber', function(){
        return view('user.dashboard.subscribe');
    })->name('subscribe');
    // Route::get('/campaigns', function(){
    //     return view('user.dashboard.campaigns');
    // })->name('cam');
    Route::get('/settings', function(){
        return view('user.dashboard.settings');
    })->name('settings');
    Route::get('/bulk-email', function(){
        return view('user.dashboard.bulk-email');
    })->name('bulk-email');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  
    Route::resource('campaigns', CampaignController::class);
Route::post('/bulk-email/send', [BulkEmailController::class, 'sendBulkEmail'])->name('bulk-email.send');

});

require __DIR__.'/auth.php';

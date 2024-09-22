<?php
use Illuminate\Support\Facades\Route;
use Mimachh\LikeIt\Http\Controllers\LikeController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/{type}/{id}/like', [LikeController::class, 'like'])->name('like');
    Route::delete('/{type}/{id}/unlike', [LikeController::class, 'unlike'])->name('unlike');
    Route::post('/{type}/{id}/toggle-like', [LikeController::class, 'toggleLike'])->name('toggle-like');
    Route::get('/{type}/{id}/has-like', [LikeController::class, 'hasLike']);
});
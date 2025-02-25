<?php

use App\Http\Controllers\Api\QuranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('juz', [QuranController::class, 'juz']);
Route::get('surah', [QuranController::class, 'surah']);
Route::get('juz/{id}', [QuranController::class, 'detailjuz']);
Route::get('surah/{id}', [QuranController::class, 'detailsurah']);

Route::get('doa', [QuranController::class, 'doa']);
Route::get('doa/{id}', [QuranController::class, 'detaildoa']);

Route::get('asmaul', [QuranController::class, 'asmaul']);

Route::get('hadist', [QuranController::class, 'hadist']);
Route::get('hadist/{name}/{page}', [QuranController::class, 'hadistName']);
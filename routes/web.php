<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ConnectionController;
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

Route::get('/get/content', [App\Http\Controllers\HomeController::class, 'getContent'])->name('get.content');

Route::get('/get/sent-requests', [RequestController::class, 'getSentRequests']);
Route::get('/sent-requests/{id}', [RequestController::class, 'storeSentRequests']);
Route::get('/withdraw-request/{id}', [RequestController::class, 'withdrawRequest']);
Route::get('/received-requests', [RequestController::class, 'getReceivedRequests']);
Route::get('/accept-request/{id}', [RequestController::class, 'acceptRequest']);
Route::get('/connections', [ConnectionController::class, 'getConnections']);
Route::get('/remove-connection/{id}', [ConnectionController::class, 'removeConnection']);
Route::get('/connections-in-common/{id}', [ConnectionController::class, 'getConnectionsInCommon']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\AdminController;

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

// Route to display the STK Push form
Route::get('/stkpush', function () {
    return view('stkpush');
});

// Route for initiating MPESA STK Push
Route::post('/mpesa/stkpush', [MpesaController::class, 'stkPush'])->name('mpesa.stkpush');

// Callback route to handle MPESA response
Route::post('/mpesa/callback', [MpesaController::class, 'handleCallback'])->name('mpesa.callback');

// Route for Admin to view transactions
Route::get('/admin/transactions', [AdminController::class, 'index'])->name('admin.transactions.index');

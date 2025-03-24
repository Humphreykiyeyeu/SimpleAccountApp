<?php
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TransactionController::class, 'dashboard'])->middleware('auth');
Route::get('/register',[TransactionController::class, 'register'])->name('login');
Route::post('/registeruser',[TransactionController::class, 'registeruser']);
Route::get('/login',[TransactionController::class, 'login'])->name('login');
Route::post('/loginuser',[TransactionController::class, 'loginuser']);
Route::get('/logout',[TransactionController::class, 'logout'])->middleware('auth');
Route::get('/deposit',[TransactionController::class, 'deposit'])->middleware('auth');
Route::post('/userdeposit',[TransactionController::class, 'userdeposit']);
Route::get('/withdraw',[TransactionController::class, 'withdraw'])->middleware('auth');
Route::post('/userwithdraw',[TransactionController::class, 'userwithdraw']);
Route::get('/transfer',[TransactionController::class, 'transfer'])->middleware('auth');
Route::post('/userTransferMoney',[TransactionController::class, 'userTransferMoney']);
Route::get('/search', [TransactionController::class, 'dashboard'])->middleware('auth');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\HomeController;
/*
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('download/excel', [App\Http\Controllers\InvoicesController::class, 'export'])->middleware(['auth']);;
Route::post('/download/{id}', [App\Http\Controllers\DownloadsController::class, 'PDFDownloader'])->middleware(['auth']);;
Route::post('search/invoices', [App\Http\Controllers\ReportsController::class, 'search'])->middleware(['auth']);;
Route::get('show/reports', [App\Http\Controllers\ReportsController::class, 'index'])->middleware(['auth']);;
Route::get('invoices/paid', [App\Http\Controllers\InvoicesController::class, 'paid'])->middleware(['auth']);;
Route::resource('customers', App\Http\Controllers\CustomersController::class)->middleware(['auth']);;


Route::get('invoices/unpaid', [App\Http\Controllers\InvoicesController::class, 'unpaid'])->middleware(['auth']);;
Route::get('invoices/partial', [App\Http\Controllers\InvoicesController::class, 'partial'])->middleware(['auth']);;
Route::get('invoices/print/{id}', [App\Http\Controllers\InvoicesController::class, 'print'])->middleware(['auth']);;
Route::resource('/invoices', App\Http\Controllers\InvoicesController::class)->middleware(['auth']);;
Route::resource('/services', App\Http\Controllers\ServicesController::class)->middleware(['auth']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth']);
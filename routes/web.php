<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!p
|
*/

Route::get('/', function () {

    return view('welcome');
});

Route::get('/export', [ProductController::class, 'export'])->name('export');
Route::get('/import', [ProductController::class, 'import'])->name('import');


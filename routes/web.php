<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExcelController;

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
    return view('merge_form');
});

Route::post('/excel/merge', [ExcelController::class, 'merge'])->name('excel.merge');

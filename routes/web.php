<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;


Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/filter', [NewsController::class, 'filter'])->name('news.filter');
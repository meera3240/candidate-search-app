<?php

use Illuminate\Support\Facades\Route;



//Search
Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');


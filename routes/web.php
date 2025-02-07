<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\LogRequest;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::get('/jobs/edit/{job}', [JobController::class, 'edit'])->name('jobs.edit');
Route::put('/jobs/edit/{job}', [JobController::class, 'update'])->name('jobs.update');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

//Route::resource('jobs', JobController::class);

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware(LogRequest::class);
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

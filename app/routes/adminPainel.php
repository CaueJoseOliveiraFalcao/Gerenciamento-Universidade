<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddAdminPermission;

use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::get('/login' , [AuthenticatedSessionController::class , 'create'])->name('login');
Route::post('/login' , [AuthenticatedSessionController::class , 'store'])->name('store');
?>
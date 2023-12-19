<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddAdminPermission;



Route::get('/givePermissionToAdmin' , [AddAdminPermission::class , 'showLoginAdminForm'])->name('showLoginAdminForm');
Route::post('/acessPermissionAdminPainel' , [AddAdminPermission::class , 'store'])->name('acessPermissionAdminPainel');
?>
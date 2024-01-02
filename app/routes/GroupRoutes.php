<?php

use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::post('/storeGroup', [GroupController::class, 'store'])->name('storeGroup');

})


?>
<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* ------------------------ ADMIN ------------------------------ */
Route::prefix('admin')->group(function (){
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin_login_form');
    Route::post('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard')
    ->middleware('admin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
});

Route::prefix('manager')->group(function (){
    Route::get('/login', [ManagerController::class, 'loginForm'])->name('manager_login_form');
    Route::post('/login', [ManagerController::class, 'login'])->name('manager_login');
    Route::get('/dashboard', [ManagerController::class, 'dashboard'])->name('manager_dashboard')
        ->middleware('manager');
    Route::get('/logout', [ManagerController::class, 'logout'])->name('manager_logout');

});

require __DIR__.'/auth.php';

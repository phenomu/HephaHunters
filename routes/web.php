<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BugReportController;
use App\Http\Controllers\ProfileController;

Route::get('/redirect-by-role', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'hunter') {
        return redirect()->route('hunter.dashboard');
    }

    abort(403, 'Role tidak dikenal.');
})->middleware(['auth'])->name('redirect.role');

/*
|--------------------------------------------------------------------------
| Halaman awal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard utama (redirect sesuai role)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    return $user->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('hunter.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Dashboard admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');

    Route::get('/admin/bugs', [BugReportController::class, 'all'])
        ->name('admin.bugs');
});

/*
|--------------------------------------------------------------------------
| Dashboard hunter
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isHunter'])->group(function () {
    Route::get('/hunter/dashboard', [DashboardController::class, 'hunter'])
        ->name('hunter.dashboard');

    Route::get('/bugs', [BugReportController::class, 'index'])
        ->name('bugs.index');
});

/*
|--------------------------------------------------------------------------
| Profile (default Breeze) Disable dulu sementara, kemungkinan kedepannya bakal buat profile khusus admin & hunter sendiri..
|--------------------------------------------------------------------------
*/
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

/*
|--------------------------------------------------------------------------
| Auth routes Breeze
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BugReportController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Redirect by Role
|--------------------------------------------------------------------------
*/
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
})->name('welcome');



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
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');

    // 🔹 Admin: lihat semua laporan
    Route::get('/admin/bugs', [BugReportController::class, 'all'])
        ->name('admin.bugs');

    // 🔹 Admin: ubah status & bounty
    Route::post('/admin/bugs/{bug}/status', [BugReportController::class, 'updateStatus'])
        ->name('admin.bugs.updateStatus');
});

/*
|--------------------------------------------------------------------------
| Hunter Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isHunter'])->group(function () {
    Route::get('/hunter/dashboard', [DashboardController::class, 'hunter'])
        ->name('hunter.dashboard');

    // 🔹 CRUD laporan hunter
    Route::get('/bugs', [BugReportController::class, 'index'])->name('bugs.index');
    Route::get('/bugs/create', [BugReportController::class, 'create'])->name('bugs.create');
    Route::post('/bugs', [BugReportController::class, 'store'])->name('bugs.store');
    Route::get('/bugs/{bug}/edit', [BugReportController::class, 'edit'])->name('bugs.edit');
    Route::put('/bugs/{bug}', [BugReportController::class, 'update'])->name('bugs.update');
    Route::delete('/bugs/{bug}', [BugReportController::class, 'destroy'])->name('bugs.destroy');
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
| Auth routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

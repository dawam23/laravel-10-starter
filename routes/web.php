<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group( function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/', function () { return redirect()->route('dashboard'); });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Route::view('/users', 'users.index', ['total' => 6, 'users' => App\Models\User::orderBy('name')->paginate(12), 'search' => null])->name('users.index');
// Route::view('/users/create', 'users.create', ['total' => 6])->name('users.create');
// Route::view('/users/edit', 'users.edit', ['total' => 6])->name('users.edit');
// Route::view('/users/delete', 'users.delete', ['total' => 6])->name('users.delete');

Route::resource('users', UsersController::class);

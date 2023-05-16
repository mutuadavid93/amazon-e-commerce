<?php

use App\Http\Controllers\{
    CategoryController,
    ProductController,
    ProfileController,
    AddressController,
    AddressOptionsController
};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', fn() => Inertia::render('Dashboard'))->name('dashboard');

Route::get('/category/{id}', [CategoryController::class, 'index'])->name('category.index');
Route::get('/product/{id}', [ProductController::class, 'index'])->name('product.index');
Route::get('/address', [AddressController::class, 'index'])->name('address.index');

// NOTE: if controller name has two words, use underscore e.g. AddressOptions becomes address_options
Route::get('/address_options', [AddressOptionsController::class, 'index'])->name('address_options.index');
Route::post('/address_options', [AddressOptionsController::class, 'store'])->name('address_options.store');
Route::post('/address_options/{id}', [AddressOptionsController::class, 'destroy'])->name('address_options.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

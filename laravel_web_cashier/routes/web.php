<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegistersController;
use App\Http\Controllers\StrukController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    if (!auth()->id()) { // If not auth, redirect to login
        return redirect()->route('session.login');
    }

    $nickname = auth()->id() ? auth()->user()->nickname : "Anonymous";

    return view('index', ['nickname' => $nickname]);
})->name('home');

// General Resources
Route::resource('struk',     StrukController::class);
Route::get('struk.dropdown',[StrukController::class, 'dropdown'])->name('struk.dropdown');
Route::get('struk.remove',  [StrukController::class, 'remove'])->name('struk.remove');
Route::get('struk.search',  [StrukController::class, 'search'])->name('struk.search');
Route::get('struk.flush',   [StrukController::class, 'flush'])->name('struk.flush');
Route::post('struk.print',   [PdfController::class, 'struk'])->name('struk.print');

Route::resource('users',    UserController::class);
Route::get('users.search', [UserController::class, 'search'])->name('users.search');

Route::resource('items',    ItemController::class);
Route::get('items.search', [ItemController::class, 'search'])->name('items.search');

Route::resource('categories',    CategoryController::class);
Route::get('categories.search', [CategoryController::class, 'search'])->name('categories.search');

Route::resource('registers',     RegisterController::class);
Route::get('registers.search',  [RegisterController::class, 'search'])->name('registers.search');

// Session
Route::get('/login',    [UserController::class, 'index_2'])->name('session.login'); // main page
Route::get('/logout',   [UserController::class, 'logout'])->name('session.logout'); // logout
Route::post('/auth',    [UserController::class, 'auth'])->name('session.auth'); // auth

/**
 * DEPRECATED
 * Use {{ url()->previous() }} OR {{ URL::previous() }}
 */
Route::get('/previous', function () {
    return back();
});
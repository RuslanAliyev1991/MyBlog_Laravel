<?php

use App\Http\Controllers\admin\auth\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\PageController as AdminPageController;
use App\Http\Controllers\blog\HomeController;
use App\Http\Controllers\blog\PageController;
use App\Http\Controllers\blog\ContactController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('store');

Route::get('/{page}', [PageController::class, 'index'])->name('page');
Route::get('news/{categories}', [HomeController::class, 'index'])->name('categoryAbout');
Route::get('news/{categories}/{slug}', [HomeController::class, 'newsAbout'])->name('newsAbout');


// auth 
Route::prefix('admin')->name('admin.')->middleware('customAuth')->group(function () {

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('loginPost');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout')->withoutMiddleware('customAuth');
});
// admin
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::get('dashboard', [AdminHomeController::class, 'index'])->name('dashboard');

    // News Routes:
    Route::get('news/state', [NewsController::class, 'changeState'])->name('state');
    Route::get('news/trash/{number}',[NewsController::class, 'newsTrash'])->name('trashedNews');
    Route::get('news/trash', [NewsController::class, 'trash'])->name('trash');
    Route::get('news/delete/{number}', [NewsController::class, 'hardDelete'])->name('delete');
    Route::get('news/recovery', [NewsController::class, 'newsRecovery'])->name('recovery');
    Route::resources(['news' => NewsController::class]);

    // Categories Routes:
    Route::get('categories/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('categories/state', [CategoryController::class, 'changeState'])->name('category.state');
    Route::post('categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('categories/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('categories/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('categories/delete', [CategoryController::class, 'delete'])->name('category.delete');

    // Pages Routes:
    Route::get('pages/index', [AdminPageController::class, 'index'])->name('page.index');
    Route::get('pages/state', [AdminPageController::class, 'changeState'])->name('page.state');
    Route::get('pages/create', [AdminPageController::class, 'create'])->name('page.create');
    Route::post('pages/store', [AdminPageController::class, 'store'])->name('page.store');
    Route::get('pages/edit/{number}', [AdminPageController::class, 'edit'])->name('page.edit');
    Route::post('pages/update/{number}', [AdminPageController::class, 'update'])->name('page.update');
    // Route::get('news/recovery', [NewsController::class, 'newsRecovery'])->name('recovery');
    // Route::resources(['news' => NewsController::class]);
});
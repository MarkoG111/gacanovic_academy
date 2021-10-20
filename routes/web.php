<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\WishController;

use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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

Route::pattern('id', '^[0-9]+$');

Route::get('/', [FrontController::class, 'homePage'])->name('home')->middleware('RecordAccessToPage');
Route::get('/courses', [FrontController::class, 'coursesPage'])->name('courses')->middleware('RecordAccessToPage');
Route::get('/courses/{id}', [FrontController::class, 'singleCoursePage'])->middleware('RecordAccessToPage');

Route::get('/login', [FrontController::class, 'loginPage'])->name('login')->middleware('RecordAccessToPage');
Route::post('/login', [AuthController::class, 'doLogin'])->name('doLogin');
Route::get('/logout', [AuthController::class, 'doLogout'])->name('logout');
Route::post('/register', [AuthController::class, 'doRegister'])->name('register');

Route::get('/contact', [FrontController::class, 'contactPage'])->name('contactPage')->middleware('RecordAccessToPage');
Route::post('/contact', [ContactController::class, 'store']);

Route::get('/author', [FrontController::class, 'authorPage'])->name('author')->middleware('RecordAccessToPage');

Route::group(['middleware' => ['AuthoriseLogin']], function () {
    Route::get('/wishlist', [FrontController::class, 'wishesPage'])->middleware('RecordAccessToPage');

    Route::get('/cart', [FrontController::class, 'cartPage'])->middleware('RecordAccessToPage');

    Route::post('/cart', [CartController::class, 'insertInCart']);

    Route::get('/orders', [FrontController::class, 'ordersPage'])->middleware('RecordAccessToPage');
});

// ->
Route::get('/cart/showCourses', [CartController::class, 'getCoursesForCart']);

Route::group(['middleware' => ['Authorise404']], function () {
    Route::prefix('/api')->group(function () {
        Route::get('/wishlist', [WishController::class, 'getAllWishesForOneUser']);
        Route::post('/addWish', [WishController::class, 'addNewWish']);
        Route::delete('/deleteWish', [WishController::class, 'deleteWish']);
    });
});

// ->
Route::get('api/numberOfWishes', [WishController::class, 'numberOfWishes']);

Route::group(['middleware' => ['Admin']], function () {
    Route::prefix('/admin')->group(function () {
        Route::resources([
            '/courses' => CourseController::class,
            '/categories' => CategoryController::class,
            '/topics' => TopicController::class,
            '/users' => UserController::class,
            '/contact' => AdminContactController::class,
        ]);

        Route::get('/logs', [LogViewerController::class, 'index'])->name('logs');
    });
});

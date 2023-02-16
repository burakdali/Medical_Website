<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConsultantsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LogOutController;

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



Route::middleware(['auth'])->group(function () {


    #all users routes
    Route::get('/', [DashboardController::class, 'homeNavigator']);

    #admin Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/articles', [ArticlesController::class, 'index'])->name('articles');
    Route::get('/consultants', [ConsultantsController::class, 'index'])->name('consultants');
    Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors');
    Route::get('/addNewDoctor', [DoctorsController::class, 'addNewDoctor'])->name('addNewDoctor');
    Route::post('/storeDoctor', [DoctorsController::class, 'storeDoctor'])->name('storeDoctor');
    Route::get('/users', [UsersController::class, 'getUsers'])->name('getUsers');
    Route::get('/addNewArticle', [ArticlesController::class, 'addNew'])->name('addNewArticle');
    Route::post('/storeArticle', [ArticlesController::class, 'storeArticle'])->name('storeArticle');
    Route::get('/article', [ArticlesController::class, 'ArticleSpec'])->name('ArticleSpec');
    Route::post('/nextArticle', [ArticlesController::class, 'nextArticle'])->name('nextArticle');
    Route::get('/logOut', [LogOutController::class, 'perform'])->name('logOut');
    Route::post('/addNewCategory', [CategoryController::class, 'store'])->name('category_store');
    Route::get('/getCategories', [CategoryController::class, 'getCategories'])->name('getCategories');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/deleteCategory', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
    Route::post('/editCategory', [CategoryController::class, 'editCategory'])->name('editCategory');
    Route::post('/storeDepartment', [DepartmentController::class, 'storeDepartment'])->name('storeDepartment');
    Route::get('/getAllDepartments', [DepartmentController::class, 'getAllDepartments'])->name('getAllDepartments');
    Route::get('/getAllSpecializations', [DoctorsController::class, 'getAllSpecializations'])->name('getAllSpecializations');
    Route::post('/storeDoctorSpecializations', [DoctorsController::class, 'storeDoctorSpecializations'])->name('storeDoctorSpecializations');

    #users routes
    Route::get('/askForConsult', [ConsultantsController::class, 'askForConsult'])->name('askForConsult');
});


require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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




Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});


Route::group(['prefix'=>'dashboard', "middleware"=>"auth"], function(){
    //MAIN
    // route dashboard
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/dashboard', [DashboardController::class, "index"])->name("dashboard.index");
    // end route dashboard

    //route article
        Route::get('/article', [ArticleController::class, 'index'])->name("dashboard.article.index");
        Route::get('/article/category/{category}', [ArticleController::class, "showByCategory"])->name("dashboard.article.category");
        Route::get('/article/detail/{slug}', [ArticleController::class, "show"])->name("dashboard.article.detail");
    //end route article

    //MASTER
    // route news 
        Route::get('/news/manage/create', [NewsController::class, "create"])->name("dashboard.news.create");
        Route::get('/news/category', [NewsCategoryController::class, "index"])->name("news.category.index");
        Route::get('/news/category/{id}', [NewsCategoryController::class, "show"])->name("news.category.show");
        
        Route::get('/news/manage/{id}/edit', [NewsController::class, "edit"])->name("dashboard.news.edit");
        Route::get('/news', [NewsController::class, "index"])->name("dashboard.news.index");
        Route::put('/news/{id}/update', [NewsController::class, "update"])->name("dashboard.news.update");
        Route::delete('/news/{id}/destroy', [NewsController::class, "destroy"])->name("dashboard.news.destroy");
        Route::get('/news/{id}', [NewsController::class, "show"])->name("dashboard.news.show");
        Route::post('/news', [NewsController::class, "store"])->name("dashboard.news.store");

        Route::put('/news/category/{id}/update', [NewsCategoryController::class, "update"])->name("news.category.update");
        Route::delete('/news/category/{id}/destroy', [NewsCategoryController::class, "destroy"])->name("news.category.destroy");
        Route::post('/news/category', [NewsCategoryController::class, "store"])->name("news.category.store");
    // end route news 

    //SETTING
    // route user
        Route::get('/user', [UserController::class, "index"])->name("dashboard.user.index");
        Route::get('/user/getRole', [UserController::class, "getRole"])->name("dashboard.user.getrole");
        Route::put('/user/{id}/update', [UserController::class, "update"])->name("dashboard.user.update");
        Route::delete('/user/{id}/destroy', [UserController::class, "destroy"])->name("dashboard.user.destroy");
        Route::get('/user/{id}', [UserController::class, "show"])->name("dashboard.user.show");
        Route::post('/user', [UserController::class, "store"])->name("dashboard.user.store");
            //update profile
            Route::put('/user/{id}/update-profile', [UserController::class, "updateProfile"])->name("dashboard.user.update-profile");
            //update password
            Route::put('/user/{id}/update-password', [UserController::class, "updatePassword"])->name("dashboard.user.update-password");
    //end route user

    //route role & permission
        //role
        Route::get('/role', [RoleController::class, "index"])->name("dashboard.user.role.index");
        Route::put('/role/{id}/update', [RoleController::class, "update"])->name("dashboard.user.role.update");
        Route::delete('/role/{id}/destroy', [RoleController::class, "destroy"])->name("dashboard.user.role.destroy");
        Route::get('/role/{id}', [RoleController::class, "show"])->name("dashboard.user.role.show");
        Route::post('/role', [RoleController::class, "store"])->name("dashboard.user.role.store");

        //permission
        Route::get('/permission', [PermissionController::class, "index"])->name("dashboard.user.permission.index");
        Route::put('/permission/{id}/update', [PermissionController::class, "update"])->name("dashboard.user.permission.update");
        Route::delete('/permission/{id}/destroy', [PermissionController::class, "destroy"])->name("dashboard.user.permission.destroy");
        Route::get('/permission/{id}', [PermissionController::class, "show"])->name("dashboard.user.permission.show");
        Route::post('/permission', [PermissionController::class, "store"])->name("dashboard.user.permission.store");

        //profile
        Route::get('/profile', [ProfileController::class, 'index'])->name("dashboard.user.profile");
        Route::delete('/profile/{id}/delete-picture', [ProfileController::class, 'deletePhotoPic'])->name("dashboard.user.deletePhotoPic");
        Route::post('/profile/upload-picture', [ProfileController::class, 'uploadPhotoPic'])->name("dashboard.user.uploadPhotoPic");
        Route::get('/profile/password', function () {
            return view('dashboard.profile.password');
        });
    //end route role & permission


});

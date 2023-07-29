<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return redirect()->route('posts.index');
});
Route::get('/home',function() {
    return redirect()->route('posts.index');
});
Auth::routes();


Route::group(['middleware' => ['auth']], function(){
    Route::group(['prefix' => 'posts','as' => 'posts.'], function(){
        Route::get('/',[PostController::class,'index'])->name('index');
        Route::get('create',[PostController::class,'create'])->name('create');
        Route::get('/edit/{post}',[PostController::class,'edit'])->name('edit');
        Route::post('/',[PostController::class,'store'])->name('store');
        Route::patch('{post}/edit',[PostController::class,'update'])->name('update');
        Route::delete('{post}',[PostController::class,'destroy'])->name('destroy');
    });

    Route::middleware(['can:isAdmin'])->group(function(){ 
        Route::group(['prefix' => 'admin','as' => 'admin.'], function(){

            Route::group(['prefix' => 'posts','as' => 'posts.'], function(){
                Route::get('/',[AdminController::class,'index'])->name('index');
                Route::get('create',[AdminController::class,'create'])->name('create');
                Route::get('{post}',[AdminController::class,'show'])->name('show');
                Route::get('/edit/{post}',[AdminController::class,'edit'])->name('edit');
                Route::post('/',[AdminController::class,'store'])->name('store');
                Route::delete('{post}',[AdminController::class,'destroy'])->name('destroy');
            });
        });
    });

});

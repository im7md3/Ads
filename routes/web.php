<?php
use App\helper;
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

Route::get('/','AdsController@commonAds');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('search','AdsController@result')->name('search');

Route::resource('ads', 'AdsController');
Route::resource('categories', 'CategoriesController');
Route::resource('comments', 'CommentsController');
Route::resource('users', 'UserController');

Route::get('profile/{user}','UserController@profile')->name('profile')->middleware('auth');

Route::post('favorite/{ad}','FavoritesController@fav')->name('fav');
Route::get('myfav','FavoritesController@myfav')->name('myfav');

Route::post('send','SendMailController@sendMail')->name('send')->middleware('auth');

Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
    route::get('/','admin\dashboardController@dashboard')->name('dashboard');
    Route::resource('ad','admin\AdController');
    Route::resource('category','admin\CategoryController');
    Route::resource('user','admin\UserController');

});
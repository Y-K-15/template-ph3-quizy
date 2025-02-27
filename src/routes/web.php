<?php

use App\Http\Controllers\QuizController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// リダイレクト
Route::get('/', function () { return redirect('/quiz'); });

// // クイズ一覧
// // localhost/quizにアクセスしたら、QuizControllerのindexメソッドに。。そしてクイズ一覧表示
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');

// 東京と広島のそれぞれのページへ。
Route::get('/quiz/{id}', [QuizController::class, 'detail'])
// ->whereNumber('id')
->name('quiz.detail');
// whereNumber って何
//→laravel9でしか使えないです。

// // 管理者画面
// // https://qiita.com/yamotuki/items/b96978f8e379e285ecb6 
// Route::middleware(['auth'])->group(function(){
//     Route::get('/admin', 'AdminController@index');
    
// });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

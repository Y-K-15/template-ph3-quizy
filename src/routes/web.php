<?php

use App\Http\Controllers\QuizController;
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

// Route::get('/home', 'HomeController@index')->name('home');

// クソセキュリティのログイン後→アドミンのindexに遷移
Route::get('/home', function () { return redirect('/admin'); });

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/admin/big_question/add',[AdminController::class, 'bigQuestionAddIndex'] )->name('bq.add.index');

Route::post('/admin/big_question/add', [AdminController::class, 'bigQuestionAdd'] )->name('bq.add');

Route::get('/admin/big_question/remove/{big_question_id}',[AdminController::class, 'bigQuestionRemoveIndex'] )->name('bq.remove.index');

Route::post('/admin/big_question/remove/{big_question_id}',[AdminController::class, 'bigQuestionRemove'] )->name('bq.remove');


// 最後のurlパラメータのところが,$big_question_idって$がついてたから404になってた。
Route::get('/admin/big_question/edit/{big_question_id}',[AdminController::class, 'bigQuestionEditIndex'])->name('bq.title.edit.index');

Route::post('/admin/big_question/edit/{big_question_id}',[AdminController::class, 'bigQuestionEdit'])->name('bq.title.edit.');


Route::get('admin/quiz/add/{big_question_id}',[AdminController::class, 'QuizAddIndex'])->name('quiz.add.index');

Route::post('admin/quiz/add/{big_question_id}', [AdminController::class, 'QuizAdd'] )->name('quiz.add');

// 小問削除ボタンがあるページへ
Route::get('admin/quiz/remove/{big_question_id}/{question_id}',[AdminController::class, 'QuizRemoveIndex'] )->name('quiz.remove.index');
// 小問削除
Route::post('admin/quiz/remove/{big_question_id}/{question_id}',[AdminController::class, 'QuizRemove'] )->name('quiz.remove');

Route::get('admin/quiz/edit/{big_question_id}/{question_id}', [AdminController::class, 'QuizEditIndex'])->name('quiz.edit.index');

Route::post('admin/quiz/edit/{big_question_id}/{question_id}', [AdminController::class, 'QuizEdit'])->name('quiz.edit');

// 選択肢追加
Route::get('admin/quiz/choice_add/{big_question_id}/{question_id}',[AdminController::class, 'ChoiceAdd'])->name('choice.add');
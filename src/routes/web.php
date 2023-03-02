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


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


// ログイン済み
Route::middleware(['auth'])->group(function(){
  // クソセキュリティのログイン後→アドミンのindexに遷移
  // Route::get('/home', function () { return redirect('/admin'); });
  Route::prefix('admin')->group(function(){
    // アドミンのトップ
    Route::get('', [AdminController::class, 'index'])->name('admin.index');
    // 大問関連
    Route::prefix('big_question')->group(function(){
      // 大問追加
      Route::get('add',[AdminController::class, 'bigQuestionAddIndex'] )->name('bq.add.index');
      Route::post('add', [AdminController::class, 'bigQuestionAdd'] )->name('bq.add');
      // 大問削除
      Route::get('remove/{big_question_id}',[AdminController::class, 'bigQuestionRemoveIndex'] )->name('bq.remove.index');
      Route::post('remove/{big_question_id}',[AdminController::class, 'bigQuestionRemove'] )->name('bq.remove');
      // 大問編集画面 ここから小問をいじる機能へ飛べる
      // 最後のurlパラメータのところが,$big_question_idって$がついてたから404になってた。
      Route::get('edit/{big_question_id}',[AdminController::class, 'bigQuestionEditIndex'])->name('bq.title.edit.index');
      Route::post('edit/{big_question_id}',[AdminController::class, 'bigQuestionEdit'])->name('bq.title.edit.');
    });
    // 小問関連
    Route::prefix('quiz')->group(function(){
      // 小問追加
      Route::get('add/{big_question_id}',[AdminController::class, 'QuizAddIndex'])->name('quiz.add.index');
      Route::post('add/{big_question_id}', [AdminController::class, 'QuizAdd'] )->name('quiz.add');
      // 小問削除ボタンがあるページへ
      Route::get('remove/{big_question_id}/{question_id}',[AdminController::class, 'QuizRemoveIndex'] )->name('quiz.remove.index');
      // 小問削除
      Route::post('remove/{big_question_id}/{question_id}',[AdminController::class, 'QuizRemove'] )->name('quiz.remove');
      // 小問ならびかえ
      Route::post('sort/{big_question_id}', [AdminController::class, 'QuizSort'] )->name('quiz.sort');
      // 選択肢編集, いずれここに画像の変更も入れたい
      Route::get('edit/{big_question_id}/{question_id}', [AdminController::class, 'QuizEditIndex'])->name('quiz.edit.index');
      Route::post('edit/{big_question_id}/{question_id}', [AdminController::class, 'QuizEdit'])->name('quiz.edit');
      // 選択肢追加
      Route::get('choice_add/{big_question_id}/{question_id}',[AdminController::class, 'ChoiceAdd'])->name('choice.add');
    });
  });
});

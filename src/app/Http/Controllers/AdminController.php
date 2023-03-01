<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BigQuestion;
use App\Question;
use App\Choice;


class AdminController extends Controller
{
    //
    public function index(){
        $big_questions = BigQuestion::all();
        $questions = Question::all();
        return view('admin.index', compact('big_questions', 'questions'));
    }

    public function bigQuestionAddIndex(){
        return view('admin.big_question.add_bq');
    }

    public function bigQuestionAdd(Request $request){
        BigQuestion::create(
            ['name' => $request->title]
        );
        return redirect('/admin');
    }

    public function bigQuestionRemoveIndex($id){
        $big_question = BigQuestion::find($id);
        // ここの$idと〜〜Index ($id)の$idはidじゃなくても一致してればok
        return view('admin.big_question.remove_bq', compact('big_question'));
    }

    public function bigQuestionRemove(Request $request, $big_question_id){

        $target_big_question = BigQuestion::find($big_question_id);

        $questions = $target_big_question->questions;
        
        foreach ($questions as $question){
            $choices = $question->choices;
            foreach($choices as $choice){
                $choice->delete();
            }
            $question->delete();
        }
        $target_big_question->delete();
        
        return redirect('/admin');
    }

    public function QuizAddIndex($big_question_id){
        $big_question = BigQuestion::find($big_question_id);
        return view('admin.quiz.add', compact('big_question'));
    }

    public function QuizAdd(Request $request, $big_question_id){

        $file = $request->file;
        $fileName = $request->{'choice' . $request->valid} . '.png'; 
        // 正解.png
        // 正解のチェックした番号がchoiceの後についた文字列(choice2とか)がnameになってるところから入力された文字列を持ってきてそれをファイル名にして.pngで拡張子をつけている。
        $path = public_path('images');
        $file->move($path, $fileName);


        
        $count_questions = Question::all()->count();

        $question = new Question;
        $question->big_question_id = $big_question_id;
        $question->image = $fileName;
        $question->save();

        $question->choices()->saveMany([
            new Choice([
                'question_id' => $count_questions + 1,
                'name' => $request->choice1,
                'is_valid' => intval($request->valid) === 1,

                // フォームが送信されるとき、現在チェックされているラジオボタンのみがサーバーに送信され、報告される値は value 属性の値になります。
                // https://developer.mozilla.org/ja/docs/Web/HTML/Element/input/radio
                // intval()について
                // https://www.php.net/manual/ja/function.intval.php
            ]),
            new Choice([
                'question_id' => $count_questions + 1,
                'name' => $request->choice2,
                'is_valid' => intval($request->valid) === 2,
            ]),
            new Choice([
                'question_id' => $count_questions + 1,
                'name' => $request->choice3,
                'is_valid' => intval($request->valid) === 3,
            ]),
            
        ]);

        // https://cpoint-lab.co.jp/article/202002/14192/
        // https://readouble.com/laravel/6.x/ja/eloquent-relationships.html
        // saveメソッドは自動的に新しいCommentモデルのpost_idへ適した値を代入します。

        return redirect('/admin');
    }


}

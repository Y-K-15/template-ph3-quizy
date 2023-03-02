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


    public function bigQuestionEditIndex($big_question_id){
        $big_question = BigQuestion::find($big_question_id);
        $questions = Question::where('big_question_id', '=', $big_question_id)->orderBy('sort','asc')->get();
        $count = Question::where('big_question_id', '=', $big_question_id)->count();
        return view('admin.big_question.edit_bq', compact('big_question','questions','count'));
    }








    public function bigQuestionEdit(Request $request, $big_question_id){
        
        $big_question = BigQuestion::find($big_question_id);
        $big_question->name = $request->title;
        $big_question->save();

        return redirect('/admin');
    }

    public function QuizAddIndex($big_question_id){
        $big_question = BigQuestion::find($big_question_id);
        $count = Question::where('big_question_id', "=", $big_question_id)->count();
        return view('admin.quiz.add', compact('count','big_question'));
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
        $question->sort = $request->sort;
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

        return redirect('/admin/big_question/edit/'.$big_question_id);
    }

    // 小問削除
    public function QuizRemoveIndex($big_question_id,$question_id){
        $question = Question::find($question_id);
        return view('admin.quiz.remove_quiz', compact('question'));
    }
    public function QuizRemove(Request $request, $big_question_id, $question_id){

        $question = Question::find($question_id);
        // $choices = Choice::where('question_id', "=", $question_id);

        $choices = $question->choices;
        foreach($choices as $choice){
            $choice->delete();
        }
        $question->delete();

        return redirect('/admin/big_question/edit/'.$big_question_id);
    }

    public function QuizSort(Request $request, $big_question_id){
        // find では１行しか取れないっす
        $questions = Question::where('big_question_id', '=', $big_question_id)->orderBy('sort','asc')->get();
        foreach($questions as $loop => $question){
            $c = $loop + 1;
            $question->sort = $request->{'sort'.$c};
            $question->save();
        }
        return redirect('/admin/big_question/edit/'.$big_question_id);
    }



    public function QuizEditIndex($big_question_id,$question_id){
        $big_question = BigQuestion::find($big_question_id);
        $question = Question::with('choices')->find($question_id);
        // この二つ、１つにできないかな？
        return view('admin.quiz.edit', compact('big_question','question'));
    }

    public function QuizEdit(Request $request, $big_question_id,$question_id){
        
        $question = Question::find($question_id);
        // $fileName = '.png';
        // $question->image = $fileName;
        // $question->save();

        // dd($question->choices);
        foreach($question->choices as $index => $choice){
            $count = $index + 1;
            $choice->name = $request->{'choice' . $count};
            if(intval($request->valid) == $count){
                $choice->is_valid = true;
            }else{
                $choice->is_valid = false;
            }
            $choice->save();
        }

        return redirect('/admin');

    }

    public function ChoiceAdd($big_question_id, $question_id){
        $choice = new Choice;
        $choice->question_id = $question_id;
        $choice->name = "新しい選択肢";
        $choice->is_valid = false;
        $choice->save();
        return redirect('/admin/quiz/edit/'.$big_question_id."/".$question_id);
    }
}

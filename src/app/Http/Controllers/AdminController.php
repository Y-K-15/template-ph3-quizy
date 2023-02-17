<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BigQuestion;
use App\Question;


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

}

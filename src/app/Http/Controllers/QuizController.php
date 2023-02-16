<?php

namespace App\Http\Controllers;


// namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\BigQuestion;
// use App\Question;
// use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class QuizController extends Controller
{
    //
    public function index(Request $request){

        $bigQuestions = BigQuestion::all();
        return view('user.quiz.index', compact('bigQuestions'));
    }
    public function detail($id){
        // dd($Questions = BigQuestion::with('questions.choices')->find($id));
        $Questions = BigQuestion::with('questions.choices')->find($id);
        // $Questions = Question::all();
        return view('user.quiz.detail', compact('Questions'));
    }
}

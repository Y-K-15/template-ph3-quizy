<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\BigQuestion;
use App\Question;

class AdminContoroller extends Controller
{
    //
    public function index(){
        $big_questions = BigQuestion::all();
        $questions = Question::all();
        return view('admin.index', compact('big_questions', 'questions'));
    }
}

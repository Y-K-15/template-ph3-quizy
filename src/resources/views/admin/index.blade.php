@extends('layouts.app')
@section('content')
  <div><a href="/admin/big_question/add">大問追加</a></div>
  <p>-------ｷﾘﾄﾘ--------</p>
  <div>
    <h1>各大問ごとに編集</h1>
  </div>
  <div>
    @foreach($big_questions as $big_question)
      <h2>
        <a href="/admin/big_question/edit/{{$big_question->id}}">{{$big_question->name}}</a>
      </h2>
      <!-- 各大問ごとの小問(高輪とか亀戸とか)について -->
      <div>
        <!-- @foreach($questions->where('big_question_id', $big_question->id) as $question)
          <div>
            <h3>{{$loop->index + 1}}</h3>
            <a href="admin/quiz/edit/{{$big_question->id}}/{{$question->id}}"><img src="{{ asset( 'images/' . $question->image) }}" alt=""></a>
          </div>
        @endforeach -->
        <!-- 各大問の小問を追加したり消したり -->
        <!-- <ul>
          <li><a href="/admin/quiz/add/{{ $big_question->id }}">設問追加</a></li>
          <li><a href="/admin/big_question/remove/{{$big_question->id}}">大問削除</a></li>
        </ul> -->
      </div>
    @endforeach
  </div>

@endsection
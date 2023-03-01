@extends('layouts.app')
@section('content')

    <form action="/{{ request()->path() }}" method="POST">
      @csrf
      <h3>大問タイトル</h3>
      <input type="text" value="{{$big_question->name}}" name="title">
      <button type="submit">変更</button>
      <p>-------ｷﾘﾄﾘ--------</p>
      <h3>小問</h3>
        
      <pre>
        <?php 
        // var_dump($questions);

        // var_dump($big_question);
        ?>
      </pre>

      <div>
        @foreach($questions->where('big_question_id', $big_question->id) as $question)
          <div>
            <h3>{{$loop->index + 1}}</h3>
            <a href="/admin/quiz/remove/{{ $big_question->id }}/{{ $question->id }}">この小問を削除する</a>
            <a href="/admin/quiz/edit/{{$big_question->id}}/{{$question->id}}"><img src="{{ asset( 'images/' . $question->image) }}" alt=""></a>
          </div>
        @endforeach

        <!-- 各大問の小問を追加したり消したり -->
        <ul>
          <li><a href="/admin/quiz/add/{{ $big_question->id }}">設問追加</a></li>
          <li><a href="/admin/big_question/remove/{{$big_question->id}}">大問削除</a></li>
        </ul>
      </div>


    </form>
@endsection
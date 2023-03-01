@extends('layouts.app')
@section('content')
  <h1>設問編集</h1>
  <h2>{{$big_question->name}}</h2>

  <div><img src="{{ asset( 'images/' . $question->image) }}" alt=""></div>
  <form action="/{{ request() -> path() }}" method="POST" enctype="multipart/form-data">
    @csrf
    <table>
      <thead>
        <tr>
          <th>選択肢編集</th>
          <th>正解にチェックしてね</th>
        </tr>
      </thead>
      <tbody>

      @foreach($question->choices as $choice)
      <tr>
          <td><input type="text" name="choice{{$loop->iteration}}" value="{{$choice->name}}"></td>
          <!-- <td>{{$choice->is_valid}}</td> -->
          <td>
            <input type="radio" name="valid" value="{{$loop->iteration}}" 
            @if($choice->is_valid) checked @endif
            >
          </td>
      </tr>
      @endforeach

      </tbody>
    </table>
    <!-- とりあえず画像は後回し、サンプルコードにもなかったので -->
    <!-- <div>
      <h3>問題の画像</h3>
      <input type="file" name="file">
    </div> -->
    <a href="/admin/quiz/choice_add/{{$big_question->id}}/{{$question->id}}">＋ 選択肢を追加する</a>
    <div><button type="submit" value="">変更</button></div>
  </form>


@endsection
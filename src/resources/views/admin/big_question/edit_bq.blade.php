@extends('layouts.app')
@section('content')

<form action="/{{ request()->path() }}" method="POST">
  @csrf
  <h3>大問タイトルを変更</h3>
  <input type="text" value="{{$big_question->name}}" name="title">
  <button type="submit">変更</button>
</form>

<p>-------ｷﾘﾄﾘ--------</p>
<h3>小問</h3>

<div>
  <form action="/admin/quiz/sort/{{$big_question->id}}" method="POST">
  @csrf
    @foreach($questions->where('big_question_id', $big_question->id) as $question)
    <div>
      <h3>{{$loop->index + 1}}</h3>
      <a href="/admin/quiz/remove/{{ $big_question->id }}/{{ $question->id }}">この小問を削除する</a>
      <div>

        <p>表示順番</p>
        <select name="sort{{$loop->iteration}}" id="">
          @for ($i = 1; $i <= $count; $i++)
            <option value="{{$i}}" @if($i==$question->sort) selected @endif>
              {{$i}}番目に表示
            </option>
          @endfor
        </select>
      </div>
      <a href="/admin/quiz/edit/{{$big_question->id}}/{{$question->id}}"><img src="{{ asset( 'images/' . $question->image) }}" alt=""></a>
    </div>
    @endforeach

    <input type="submit" value="並び順更新">
  </form>

  <!-- 各大問の小問を追加したり消したり -->
  <ul>
    <li><a href="/admin/quiz/add/{{ $big_question->id }}">設問追加</a></li>
    <li><a href="/admin/big_question/remove/{{$big_question->id}}">大問削除</a></li>
  </ul>
</div>


@endsection
@extends('layouts.app')
@section('content')
<!-- ↑単数形です -->
  <h1>設問追加</h1>
  <h2>{{$big_question->name}}</h2>

  <form action="/{{ request() -> path() }}" method="POST" enctype="multipart/form-data">
    @csrf
    <table>
      <thead>
        <tr>
          <th>選択肢追加</th>
          <th>正解にチェックしてね</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="text" name="choice1"></td>
          <td><input type="radio" name="valid" value="1"></td>
        </tr>
        <tr>
          <td><input type="text" name="choice2"></td>
          <td><input type="radio" name="valid" value="2"></td>
        </tr>
        <tr>
          <td><input type="text" name="choice3"></td>
          <td><input type="radio" name="valid" value="3"></td>
        </tr>
      </tbody>
    </table>
    <div>
      <h3>問題の画像</h3>
      <input type="file" name="file">
    </div>
    <input type="hidden" name="sort" value="{{$count + 1}}">
    <button type="submit" value="">追加</button>
  </form>

@endsection
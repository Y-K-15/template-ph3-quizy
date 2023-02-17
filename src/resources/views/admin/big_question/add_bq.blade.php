@extends('layouts.app')
@section('content')
  <h1>大問追加</h1>
  <form action="/{{ request()->path() }}" method="POST">
    <!-- https://readouble.com/laravel/master/ja/requests.html -->
    <!-- リクエストURIの取得
pathメソッドはリクエストURIを返します。もしリクエストがhttp://domain.com/foo/barに送られたとすると、pathメソッドはfoo/barを返します。 -->
    @csrf
    <input type="text" name="title">
    <button type="submit">追加</button>
  </form>

@endsection
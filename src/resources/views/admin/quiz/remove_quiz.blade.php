@extends('layouts.app')
@section('content')
    <div>
      <img src="{{ asset( 'images/' . $question->image) }}" alt="">
    </div>
    <form action="/{{ request()->path() }}" method="POST">
      @csrf
      <button type="submit">削除</button>
    </form>
@endsection
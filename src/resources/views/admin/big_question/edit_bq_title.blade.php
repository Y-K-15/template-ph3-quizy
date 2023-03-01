@extends('layouts.app')
@section('content')

    <form action="/{{ request()->path() }}" method="POST">
      @csrf
      <input type="text" value="{{$big_question->name}}" name="title">
      <button type="submit">変更</button>
    </form>
@endsection
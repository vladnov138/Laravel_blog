@extends('layouts.app')

@section('content')
    <h1>Пользователь: {{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <a href="{{ url('/users/'.$user->id.'/edit') }}">Редактировать</a>
    <form action="{{ url('/users/delete', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Удалить</button>
    </form>
@endsection
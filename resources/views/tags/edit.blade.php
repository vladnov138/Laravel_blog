@extends('layouts.app')

@section('content')
    <h1>Редактирование пользователя: {{ $user->name }}</h1>

    <form action="{{ url('/users', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required>

        <button type="submit">Сохранить</button>
    </form>
    
    <a href="{{ url('/users/show', $user->id) }}">Отмена</a>
@endsection
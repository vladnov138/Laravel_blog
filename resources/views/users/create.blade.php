@extends('layouts.app')

@section('content')
    <h1>Добавление Пользователя</h1>
    <form action="{{ url()->current() }}" method="POST">
        @csrf
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Добавить</button>
    </form>
@endsection
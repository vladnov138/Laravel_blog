@extends('layouts.app')

@section('content')
    <h1>Добавление Тега</h1>
    <form action="{{ url()->current() }}" method="POST">
        @csrf
        <label for="name">Название:</label>
        <input type="text" name="name" id="name" required>
        
        <label for="description">Описание тега:</label>
        <input type="text" name="description" id="description" required>

        <button type="submit">Добавить</button>
    </form>
@endsection
@extends('layouts.app')

@section('content')
    <h1>Добавление Поста</h1>
    <form action="{{ url()->current() }}" method="POST">
        @csrf
        <label for="title">Заголовок:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="content">Контент:</label>
        <textarea name="content" id="content" required></textarea><br>

        <label for="tags">Выберите теги:</label>
        <select name="tags[]" id="tags" multiple>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select><br>

        <button type="submit">Добавить</button>
    </form>
@endsection
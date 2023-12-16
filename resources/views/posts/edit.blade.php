@extends('layouts.app')

@section('content')
    <h1>Редактирование поста: {{ $post->title }}</h1>

    <form action="{{ url('/posts/'.$post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Имя:</label>
        <input type="text" name="title" id="title" value="{{ $post->title }}" required>

        <label for="content">Содержание:</label>
        <input type="text" name="content" id="content" value="{{ $post->content }}" required>

        <label for="tags">Выберите теги:</label>
        <select name="tags[]" id="tags" multiple>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" @if ($selectedTags->pluck('id')->contains($tag->id)) selected @endif>{{ $tag->name }}</option>
            @endforeach
        </select>

        <button type="submit">Сохранить</button>
    </form>
    
    <a href="{{ url('/posts/'.$post->id) }}">Отмена</a>
@endsection
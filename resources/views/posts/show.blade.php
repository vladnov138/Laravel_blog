@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif
    <h1>Заголовок: {{ $post->title }}</h1>
    <p>Контент: {{ $post->content }}</p>
    <p>Автор: {{ $post->user->name }}</p>
    @if ($access)
        <a href="{{ url('/posts/'.$post->id.'/edit') }}">Редактировать</a>
        <form action="{{ url('/posts/'.$post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Удалить</button>
        </form>
        <form action="{{ url('/moder/posts/'.$post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Снять с публикации</button>
        </form>
    @endif
    <form action="{{ url('/posts/'.$post->id.'/comments') }}" method="POST">
        @csrf
        @method('POST')
        <textarea name="content" id="content" placeholder="Введите комментарий" required></textarea>
        <button type="submit">Отправить</button>
    </form>
    @if ($post->comment != null)
    @foreach ($post->comment as $comment)
        <div style="border: 1px solid black; margin: 20px;">
            <div>Author: {{ $comment->user->name }}</div>
            <div>{{ $comment->content }}</div>
        </div>
    @endforeach
    @endif
@endsection
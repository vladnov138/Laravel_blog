@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif
    <h1>Список постов</h1>
    <a href="{{ url('/posts/create') }}">Добавить новый пост</a>
    <table>
        <tr>
            <th>Название</th>
            <th>Контент</th>
            <th>Действие</th>
        </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>
                    <a href="{{ url('/posts/'.$post->id) }}">Просмотр</a>
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
                </td>
            </tr>
        @endforeach
    </table>
@endsection
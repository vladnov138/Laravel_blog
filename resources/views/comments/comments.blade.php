@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif
    <h1>Список комментариев</h1>
    <table>
        <tr>
            <th>Пост</th>
            <th>Комментарий</th>
            <th>Действие</th>
        </tr>
        @foreach ($comments as $comment)
            <tr>
                <td>{{ $comment->post->title }}</td>
                <td>{{ $comment->content }}</td>
                <td>
                  {{-- <a href="{{ url('/comments/'.$comment->id.'/edit') }}">Редактировать</a> --}}
                  <form action="{{ url('/moder/comments/'.$comment->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit">Удалить</button>
                  </form>
                  <form action="{{ url('/moder/comments/unpublished/'.$comment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">Опубликовать</button>
                </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
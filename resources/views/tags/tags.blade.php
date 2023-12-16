@extends('layouts.app')

@section('content')
    <h1>Список Тегов</h1>
    <a href="{{ url('/tags/create') }}">Добавить новый тег</a>
    <table>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Действие</th>
        </tr>
        @foreach ($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->description }}</td>
                <td>
                    <a href="{{ url('/tags/'.$tag->id.'/edit') }}">Редактировать</a>
                    <form action="{{ url('/tags', $tag->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
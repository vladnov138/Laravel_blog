@extends('layouts.app')

@section('content')
    <h1>Список Пользователей</h1>
    <a href="{{ url('/users/create') }}">Добавить нового пользователя</a>
    <table>
        <tr>
            <th>Имя</th>
            <th>Email</th>
            <th>Действия</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ url('/users', $user->id) }}">Просмотр</a>
                    <a href="{{ url('/users/'.$user->id.'/edit') }}">Редактировать</a>
                    <form action="{{ url('/users', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
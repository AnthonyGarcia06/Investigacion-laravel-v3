{{-- resources/views/users/index.blade.php --}}
@extends('layouts.app')

@section('content')
<h1>Lista de usuarios</h1>
<div class="container">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    
    </style>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Tareas asignadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>
                        @if(count($user['tasks']) > 0)
                            <ul>
                                @foreach ($user['tasks'] as $task)
                                    <li>{{ $task['title'] }}</li>
                                @endforeach
                            </ul>
                        @else
                            No tiene tareas asignadas.
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
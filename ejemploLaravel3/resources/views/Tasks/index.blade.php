
{{-- resources/views/tasks/index.blade.php --}}
@extends('layouts.app')

@section('content')
<h1>Lista de tareas</h1>
<div class="action-links">
    <a href="{{ route('tasks.create') }}" class="btn btn-green">Agregar nueva tarea</a>
    <a href="{{ route('users.active') }}" class="btn btn-green">Listar usuarios activos</a>
</div>
<br></br>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {background-color: #f9f9f9;}
    .btn, a.btn {
        padding: 8px 15px;
        text-decoration: none;
        color: white;
        background-color: #0056b3; /* Azul oscuro para editar */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    .btn:hover, a.btn:hover {
        background-color: #004488; /* Azul más oscuro al pasar el mouse */
    }
    .btn-danger {
        background-color: #dc3545; /* Rojo para eliminar */
    }
    .btn-danger:hover {
        background-color: #c82333; /* Rojo más oscuro al pasar el mouse */
    }
    .btn-green {
        background-color: #28a745; /* Verde para crear y listar */
    }
    .btn-green:hover {
        background-color: #218838; /* Verde más oscuro al pasar el mouse */
    }
    .action-links {
        display: flex;
        gap: 10px; /* Espacio entre los botones */
    }
</style>


<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha límite</th>
            <th>Progreso de la tarea</th>
            <th>Prioridad</th>
            <th>URL de la foto</th>
            <th>Horas</th>
            <th>Encargado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    @foreach($user["tasks"] as $task)
    <tr>
        <td>{{ $task['title'] }}</td>
        <td>{{ $task['description'] }}</td>
        <td>{{ $task['dueDate'] }}</td>
        <td>{{ $task['taskProgress'] }}</td>
        <td>{{ $task['priority'] }}</td>
        <td>{{ $task['photoUrl'] }}</td>
        <td>{{ $task['hours'] }}</td>
        <td>{{ $user['name'] ?? 'N/A' }}</td>
        <td>
            <a href="{{ route('tasks.edit', $task['id']) }}" class="btn">Editar</a>
            <form method="POST" action="{{ route('tasks.destroy', $task['id']) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </td>
    </tr>
 @endforeach
@endforeach
    </tbody>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('form[action^="{{ route("tasks.destroy", "") }}"] button');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                if (!confirm('¿Estás seguro de que deseas eliminar esta tarea?')) {
                    event.preventDefault();
                }
            });
        });
    });
</script>

@endsection
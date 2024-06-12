{{-- Extiende el layout principal --}}
@extends('layouts.app')

{{-- Define el contenido que se insertará en el layout principal --}}
@section('content')
<h1>Crear tarea</h1>

{{-- Estilos locales para el formulario y sus elementos --}}
<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    select,
    textarea {
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

{{-- Formulario para la creación de tareas con protección CSRF --}}
<form method="POST" action="{{ route('tasks.store') }}">
    @csrf

    {{-- Campo para el título de la tarea --}}
    <label for="title">Titulo:</label>
    <input type="text" name="task[title]" id="title" required>

    {{-- Área de texto para la descripción de la tarea --}}
    <label for="description">Descripción:</label>
    <textarea name="task[description]" id="description" required></textarea>

    {{-- Selector de fecha para la fecha límite de la tarea --}}
    <label for="dueDate">Fecha limite:</label>
    <input type="date" name="task[dueDate]" id="dueDate" required>

    {{-- Selector para el progreso de la tarea --}}
    <label for="taskProgress">Progreso de la tarea:</label>
    <select name="task[taskProgress]" id="taskProgress" required>
        <option value="PENDING">PENDING</option>
        <option value="IN_PROGRESS">IN_PROGRESS</option>
        <option value="DONE">DONE</option>
    </select>

    {{-- Selector para la prioridad de la tarea --}}
    <label for="priority">Prioridad:</label>
    <select name="task[priority]" id="priority" required>
        <option value="LOW">LOW</option>
        <option value="MID">MID</option>
        <option value="HIGH">HIGH</option>
    </select>

    {{-- Campo para la URL de la foto relacionada con la tarea --}}
    <label for="photoUrl">URL de la foto:</label>
    <input type="text" name="task[photoUrl]" id="photoUrl" required>

    {{-- Campo numérico para las horas estimadas para completar la tarea --}}
    <label for="hours">Horas:</label>
    <input type="number" name="task[hours]" id="hours" required>

    {{-- Selector para asignar un usuario responsable de la tarea --}}
    <label for="userid">Encargado:</label>
    <select name="userid" id="userid" required>
       @foreach ( $users as $user)
        <option value="{{$user['id']}}">{{$user['name']}}</option>
       @endforeach
    </select>

    {{-- Botón para enviar el formulario --}}
    <button type="submit">Crear tarea</button>
</form>

{{-- Script para confirmar la creación de la tarea antes de enviar el formulario --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form.addEventListener('submit', function (event) {
            if (!confirm('¿Estás seguro de que quieres agregar esta tarea?')) {
                event.preventDefault();
            }
        });
    });
</script>
@endsection

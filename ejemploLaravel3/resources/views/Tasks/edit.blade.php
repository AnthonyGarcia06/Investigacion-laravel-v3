@extends('layouts.app')

@section('content')
<h1>Editar tarea</h1>

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

@if(isset($task['id']))
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        
        <input type="hidden" name="task[id]" value="{{ $task['id'] }}" required>

        <label for="title">Titulo:</label>
        <input type="text" name="task[title]" id="title" value="{{ $task['title'] }}" required>

        <label for="description">Descripción:</label>
        <textarea name="task[description]" id="description" required>{{ $task['description'] }}</textarea>

        <label for="dueDate">Fecha limite:</label>
        <input type="date" name="task[dueDate]" id="dueDate" value="{{ $task['dueDate'] }}">

        <label for="taskProgress">Progreso de la tarea:</label>
        <select name="task[taskProgress]" id="taskProgress">
            <option value="PENDING" {{ $task['taskProgress'] == 'PENDING' ? 'selected' : '' }}>PENDING</option>
            <option value="IN_PROGRESS" {{ $task['taskProgress'] == 'IN_PROGRESS' ? 'selected' : '' }}>IN_PROGRESS</option>
            <option value="DONE" {{ $task['taskProgress'] == 'DONE' ? 'selected' : '' }}>DONE</option>
        </select>

        <label for="priority">Prioridad:</label>
        <select name="task[priority]" id="priority">
            <option value="LOW" {{ $task['priority'] == 'LOW' ? 'selected' : '' }}>LOW</option>
            <option value="MID" {{ $task['priority'] == 'MID' ? 'selected' : '' }}>MID</option>
            <option value="HIGH" {{ $task['priority'] == 'HIGH' ? 'selected' : '' }}>HIGH</option>
        </select>

        <label for="photoUrl">URL de la foto:</label>
        <input type="text" name="task[photoUrl]" id="photoUrl" value="{{ $task['photoUrl'] }}">

        <label for="hours">Horas:</label>
        <input type="number" name="task[hours]" id="hours" value="{{ $task['hours'] }}">


        <label for="userid">Encargado:</label>
    <select name="userid" id="userid" required>
       @foreach ( $users as $user)
        <option @if($user['id']==$task['user']['id']) selected @endif value="{{$user['id']}}">{{$user['name']}}</option>

       @endforeach

    </select>
        <button type="submit">Actulizar</button>

    </form>
@else
    <p>Task data is not available.</p>
@endif

@endsection

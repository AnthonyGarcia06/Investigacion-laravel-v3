<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Models\Task;
use Log;

/**
 * TaskController gestiona las solicitudes HTTP relacionadas con las tareas.
 */
class TaskController extends Controller
{
    /**
     * @var TaskService
     */
    protected $taskService;

    /**
     * Constructor que inyecta el TaskService en este controlador.
     * 
     * @param TaskService $taskService Servicio que gestiona la lógica de negocio de las tareas.
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Muestra la lista de todas las tareas.
     * 
     * @return \Illuminate\View\View Vista de índice de tareas.
     */
    public function index()
    {
        $users = $this->taskService->listTasks();
        return view('tasks.index', compact('users'));
    }

    /**
     * Lista los usuarios activos.
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View Redirige o muestra la vista de índice de usuarios.
     */
    public function listActiveUsers()
    {
        $users = $this->taskService->listActiveUsers();

        if (is_null($users)) {
            return redirect()->route('some_route')->with('error', 'Failed to retrieve users');
        }

        return view('users.index', ['users' => $users]);
    }

    /**
     * Muestra la vista para crear una nueva tarea.
     * 
     * @return \Illuminate\View\View Vista para crear tarea.
     */
    public function create()
    {
        $users = $this->taskService->listActiveUsers();
       
        return view('tasks.create' ,compact('users'));
    }

    /**
     * Almacena una nueva tarea en la base de datos.
     * 
     * @param Request $request Datos de la tarea a crear.
     * @return \Illuminate\Http\RedirectResponse Redirige al índice de tareas.
     */
    public function store(Request $request)
    {
        $this->taskService->createTask($request->all());
        return redirect()->route('tasks.index');
    }

    /**
     * Muestra la vista de edición para una tarea específica.
     * 
     * @param int $id ID de la tarea a editar.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View Redirige o muestra la vista de edición de tareas.
     */
    public function edit($id)
    {
        try {
            $task = $this->taskService->getTaskById($id);

            if (!$task) {
                return redirect()->route('tasks.index')->with('error', 'Task not found');
            }

            $users = $this->taskService->listActiveUsers();
       
            return view('tasks.edit', compact('task','users'));

        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'An error occurred while retrieving the task.');
        }
    }

    /**
     * Elimina una tarea específica.
     * 
     * @param int $id ID de la tarea a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirige al índice de tareas.
     */
    public function destroy($id)
    {
        $this->taskService->deleteTask($id);
        return redirect()->route('tasks.index');
    }

    /**
     * Muestra los detalles de una tarea específica.
     * 
     * @param int $id ID de la tarea.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con los detalles de la tarea.
     */
    public function show($id)
    {
        $task = $this->taskService->getTaskById($id);

        if (is_null($task)) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json(['task' => $task]);
    }
}

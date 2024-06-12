<?php

namespace App\Services;
use App\Models\Task;

use Illuminate\Support\Facades\Http;

/**
 * TaskService gestiona las interacciones con una API externa para operaciones relacionadas con tareas.
 */
class TaskService
{
    /**
     * Base URL para las llamadas API.
     */
    protected $baseUrl;

    /**
     * Constructor que inicializa la URL base de la API.
     */
    public function __construct()
    {
        $this->baseUrl = env('API_BASE_URL', 'http://localhost:8080/tasks');
    }

    /**
     * Obtiene una lista de todas las tareas (nótese que el endpoint sugiere que son usuarios; puede ser un error).
     * 
     * @return array Respuesta JSON de la API.
     */
    public function listTasks()
    {
        return Http::get("{$this->baseUrl}/allusers")->json();
    }

    /**
     * Crea una nueva tarea asociada a un usuario específico.
     * 
     * @param array $data Datos de la tarea incluyendo 'userid' y 'task'.
     * @return mixed Respuesta de la API.
     */
    public function createTask($data)
    {
        return Http::post("{$this->baseUrl}/createtask/{$data['userid']}", $data['task']);
    }

    /**
     * Elimina una tarea basada en su ID.
     * 
     * @param int $id ID de la tarea a eliminar.
     * @return mixed Respuesta de la API.
     */
    public function deleteTask($id)
    {
        return Http::delete("{$this->baseUrl}/deletetask/{$id}");
    }

  
    /**
     * Obtiene una tarea por ID y maneja posibles errores en la solicitud.
     * 
     * @param int $id ID de la tarea.
     * @return mixed Detalles de la tarea o null si hay un error.
     */
    public function getTaskById($id)
    {
        $response = Http::get("{$this->baseUrl}/taskbyid/{$id}");

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['task'])) {
                return $data['task'];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * Lista usuarios activos (posible error en el endpoint si debería ser tareas).
     * 
     * @return mixed Lista de usuarios activos o null si falla la solicitud.
     */
    public function listActiveUsers()
    {
        $response = Http::get("{$this->baseUrl}/activeuser");

        if ($response->successful()) {
            return $response->json();
        } else {    
            return null;
        }
    }
}

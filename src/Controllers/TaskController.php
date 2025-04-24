<?php

namespace App\Controllers;
use App\Core\Response;
use App\Core\Request;
use App\Models\TaskModel;
use Exception;

class TaskController
{
    public function index()
    {
        return Response::json([
            'message' => 'Lista de tasks',
            'data' => TaskModel::getAll()
        ]);
    }

    public function show($id)
    {
        
    }

    public function create()
    {
        // Pega os dados do corpo da requisição JSON
        $task = Request::input('task'); 
        $description = Request::input('description'); 

        // Valida os dados
        if ($task === '') {
            throw new Exception(Response::json(['error' => 'O nome da task não pode ser vazio'], 400));
        }

        // Cria a tarefa
        return Response::json([
            'message' => 'Task criada com sucesso',
            'data' => TaskModel::create([
                'task' => $task,
                'description' => $description,
                'status' => 1 // Define o status como ativo
            ])
        ]);

    }

    public function update($id)
    {
        
    }

    public function delete($id)
    {
       
    }
}
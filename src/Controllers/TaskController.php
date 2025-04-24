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
        // Verifica se o ID é válido
        if (!is_numeric($id)) {
            throw new Exception(Response::json(['error' => 'ID inválido'], 400));
        }

        // Verifica se a task existe
        if (TaskModel::getById($id) === null) {
            throw new Exception(Response::json(['error' => 'Task não encontrada'], 404));
        }

        // Retorna a task
        return Response::json([
            'message' => 'Task encontrada',
            'data' => TaskModel::getById($id)
        ]);
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
        $data = Request::json(); // Pega todos os dados do corpo da requisição JSON

        if(!isset($id)){
            throw new Exception(Response::json(['error' => 'ID não informado'], 400));
        }

        if (!is_numeric($id)) {
            throw new Exception(Response::json(['error' => 'ID inválido'], 400));
        }

        // Verifica se a task existe
        if (TaskModel::getById($id) === null) {
            throw new Exception(Response::json(['error' => 'Task não encontrada'], 404));
        }

        //retornar os campos que podem ser atualizados
        $fillable = (new TaskModel())->getFillable();

        foreach ($data as $column => $value) {
            if (!in_array($column, $fillable)) {
                throw new \Exception(Response::json("Coluna $column não permitida para atualização", 400));
            }
        }

        // Atualiza a tarefa
        return Response::json([
            'message' => 'Task atualizada com sucesso',
            'data' => TaskModel::updateTask($id, $data)
        ]);


    }

    public function delete($id)
    {
       
    }
}
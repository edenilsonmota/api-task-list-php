<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Response;
class TaskModel extends Model
{
    protected $table = 'tasks'; // Nome da tabela
    protected $fillable = ['task', 'description', 'status']; // Campos
    public $timestamps = true; // Habilita os timestamps (created_at e updated_at)
    protected $guarded = ['id', 'created_at']; //não permitir a atribuição dos campos id e created_at

    public static function getAll()
    {
        return self::select('id', 'task', 'description', 'status', 'created_at', 'updated_at')
            ->orderBy('created_at', 'desc') // Ordena pela data de criação (mais recente primeiro)
            //->where('status', 1) // Filtra apenas usuários ativos
            ->get();
    }

    public static function getById(int $id)
    {
        return self::select('id', 'task', 'description', 'status', 'created_at', 'updated_at')
            ->where('id', $id)
            ->first();
    }

    public static function create(array $data)
    {
        $task = new self();

        $task->task = $data['task'];
        $task->description = $data['description'];
        $task->status = 1; // Define o status como ativo

        if (!$task->save()) {
            throw new \Exception(Response::json(["error" => "Erro ao criar task"], 500));
        }

        return $task;
    }
    // public static function update($id, $data)
    // {
    //     // Aqui você pode implementar a lógica para atualizar uma tarefa no banco de dados
    //     // Exemplo: UPDATE tasks SET task = $data['task'], description = $data['description'], status = $data['status'] WHERE id = $id
    //     return [];
    // }
    // public static function delete($id)
    // {
    //     // Aqui você pode implementar a lógica para deletar uma tarefa no banco de dados
    //     // Exemplo: DELETE FROM tasks WHERE id = $id
    //     return [];
    // }
}
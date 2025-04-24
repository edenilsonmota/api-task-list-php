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
    public static function updateTask(int $id, array $data)
    {
        $task = self::find($id);

        if (!$task) {
            throw new \Exception(Response::json(['error' => 'Task não encontrado'], 404));
        }

        // Atualiza os campos permitidos
        foreach ($data as $key => $value) {
            if (in_array($key, $task->getFillable())) {
                $task->$key = $value;
            }
        }

        if (!$task->save()) {
            throw new \Exception(Response::json(['error' => 'Erro ao atualizar task'], 500));
        }

        return $task;
    }

    public static function deleteTask(int $id)
    {
        $deleted = self::destroy($id);
        if (!$deleted) {
            throw new \Exception(Response::json(['error' => 'Erro ao deletar task'], 500));
        }

        return true;
    }
}
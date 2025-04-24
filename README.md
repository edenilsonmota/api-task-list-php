# 📝 API de Tarefas

API simples para gerenciamento de tarefas (CRUD), utilizando **PHP 8.4**, **PostgreSQL** e **Composer**.

## ✅ Requisitos

- PHP 8.2
- Composer
- PostgreSQL (precisa modulo php ``pdo_pgsql e pgsql``)

## 🚀 Como rodar o projeto localmente

1. Configure a conexão com o banco de dados PostgreSQL, criando um arquivo `.env` igual ao arquivo `.env.example`
2. Instale o autoload do Composer:

```bash
composer dump-autoload
```

3. Inicie o servidor PHP:

```bash
php -S localhost:8000 -t public
```

## 🗃️ Criação da Tabela `tasks`

Execute a query abaixo no seu banco PostgreSQL:

```sql
CREATE TABLE tasks (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 📚 Documentação dos Endpoints

### 🔹 `GET /tasks`

**Descrição:** Lista todas as tarefas.

**Resposta:**
```json
{
    "message": "Lista de tasks",
    "data": [
        {
            "id": 2,
            "title": "task 2",
            "description": "description 2",
            "status": true,
            "created_at": "2025-04-24T23:01:04.000000Z",
            "updated_at": "2025-04-24T23:01:04.000000Z"
        },
        {
            "id": 1,
            "title": "task 1",
            "description": "description 1",
            "status": true,
            "created_at": "2025-04-24T22:58:11.000000Z",
            "updated_at": "2025-04-24T22:58:11.000000Z"
        }
    ]
}
```

### 🔹 `GET /tasks/{id}`

**Descrição:** Retorna uma tarefa específica pelo ID.

**Exemplo:** `/tasks/1`

**Resposta:**
```json
{
    "message": "Task encontrada",
    "data": {
        "id": 1,
        "title": "task 1",
        "description": "description 1",
        "status": true,
        "created_at": "2025-04-24T22:58:11.000000Z",
        "updated_at": "2025-04-24T22:58:11.000000Z"
    }
}
```

### 🔹 `POST /tasks`

**Descrição:** Cria uma nova tarefa.

**Corpo da requisição:**
```json
{
  "title": "Nova tarefa",
  "description": "Descrição opcional"
}
```

**Resposta:**
```json
{
    "message": "Task criada com sucesso",
    "data": {
        "title": "task 2",
        "description": "description 2",
        "status": 1,
        "updated_at": "2025-04-24T23:01:04.000000Z",
        "created_at": "2025-04-24T23:01:04.000000Z",
        "id": 2
    }
}
```

### 🔹 `PATCH /tasks/{id}`

**Descrição:** Atualiza campos específicos da tarefa.

**Corpo da requisição:**
```json
{
    "title": "task 1 atualizada",
    "status" : 0 //concluida
}
```

**Resposta:**
```json
{
    "message": "Task atualizada com sucesso",
    "data": {
        "id": 1,
        "title": "task 1 atualizada",
        "description": "description 1",
        "status": 0,
        "created_at": "2025-04-24T22:58:11.000000Z",
        "updated_at": "2025-04-24T23:03:15.000000Z"
    }
}
```

### 🔹 `DELETE /tasks/{id}`

**Descrição:** Remove uma tarefa pelo ID.

**Resposta:**
```json
{
    "message": "Task deletada com sucesso"
}
```

## 📎 Observações

- Todos os dados devem ser enviados em formato JSON.
- Use ferramentas como **Postman** ou **Insomnia** para testar os endpoints.
- Verifique as credenciais do banco de dados e o autoload para garantir o funcionamento correto da API.


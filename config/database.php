<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// Configuração do Eloquent ORM
$capsule = new Capsule;

// Adiciona a conexão com o banco de dados
$capsule->addConnection([
    'driver' => $_ENV['DB_CONNECTION'],
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'database' => $_ENV['DB_DATABASE'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'UTF8',
    'collation' => null,
]);

// Configurar o Eloquent ORM para usar o banco de dados
$capsule->setAsGlobal();
$capsule->bootEloquent();
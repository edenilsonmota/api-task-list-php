<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

// Carrega o arquivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load(); 

// Carrega a configuração do banco de dados (inicializa o Eloquent)
require __DIR__ . '/../config/database.php';

// Carrega as rotas
require __DIR__ . '/../src/Routes/api.php';
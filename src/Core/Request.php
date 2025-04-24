<?php

namespace App\Core;

class Request
{
    private static ?array $json = null;


    /**
     * Retorna o corpo da requisição (JSON) como array associativo para manipular os dados.
     * @return array|null
     */
    public static function json(): array
    {
        if(self::$json === null){
            $body = file_get_contents('php://input');
            self::$json = json_decode($body, true) ?? [];
        }

        return self::$json;
    }

    /**
     * Retorna o valor de um parâmetro específico do corpo da requisição (JSON).
     * @param string $key
     * @return mixed|null
     */
    public static function input(string $key, $default = null)
    {
        $json = self::json();
        return $json[$key] ?? $default;
    }

    /**
     * Retorna o valor de um parâmetro específico da URL.
     * @param string $key
     * @param mixed $default
     */
    public static function query(string $key = null, $default = null)
    {
        if ($key) {
            return $_GET[$key] ?? $default;
        }
    
        return $_GET;
    }

    /**
     * Retorna o metodo da requisição (GET, POST, PUT, DELETE, etc.).
     * @param string $key
     * @return mixed|null
     */
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    /**
     * Retorna a URI da requisição.
     * @return array|bool|int|string|null
     */
    public static function uri(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * Ler o valor de um header específico da requisição.
     * @param string $key
     */
    public static function header(string $key): ?string
    {
        $headers = getallheaders();
        return $headers[$key] ?? null;
    }

}
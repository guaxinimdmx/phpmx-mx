<?php

namespace PhpMx;

/** Classe para acesso aos dados da requisição HTTP atual. */
abstract class Request
{
    protected static ?array $SERVER = null;
    protected static ?string $TYPE = null;
    protected static ?array $HEADER = null;
    protected static ?bool $SSL = null;
    protected static ?string $HOST = null;
    protected static ?array $PATH = null;
    protected static ?array $QUERY = null;
    protected static ?array $BODY = null;
    protected static array $ROUTE = [];
    protected static ?array $FILE = null;

    /**
     * Retorna um ou todos os parâmetros server da requisição atual.
     * @param ?string $parameter Nome do parâmetro (opcional).
     * @return mixed
     */
    static function server(?string $parameter = null): mixed
    {
        self::$SERVER = self::$SERVER ?? self::current_server();

        if (!is_null($parameter)) return self::$SERVER[$parameter] ?? null;

        return self::$SERVER;
    }

    /**
     * Retorna ou compara o tipo da requisição atual (GET, POST, PUT, DELETE, OPTIONS).
     * @param ?string $type Tipo a comparar (opcional). Retorna bool quando informado.
     * @return string|bool
     */
    static function type(?string $type = null): string|bool
    {
        self::$TYPE = self::$TYPE ?? self::current_type();

        if (!is_null($type)) return self::$TYPE == strtoupper($type);

        return self::$TYPE;
    }

    /**
     * Retorna um ou todos os parâmetros header da requisição atual.
     * @param string $parameter Nome do parâmetro (opcional).
     * @return mixed
     */
    static function header(?string $parameter = null): mixed
    {
        self::$HEADER = self::$HEADER ?? self::current_header();

        if (!is_null($parameter)) return self::$HEADER[$parameter] ?? null;

        return self::$HEADER;
    }

    /**
     * Retorna ou compara o status de utilização SSL da requisição atual.
     * @param ?bool $ssl Valor a comparar (opcional). Retorna bool quando informado.
     * @return bool
     */
    static function ssl(?bool $ssl = null): bool
    {
        self::$SSL = self::$SSL ?? self::current_ssl();

        if (!is_null($ssl)) return self::$SSL == $ssl;

        return self::$SSL;
    }

    /**
     * Retorna o host da requisição atual.
     * @return string
     */
    static function host(): string
    {
        self::$HOST = self::$HOST ?? self::current_host();
        return self::$HOST;
    }

    /**
     * Retorna um ou todos os segmentos de caminho da URI da requisição atual.
     * @param ?int $index Índice do segmento (opcional).
     * @return null|array|string
     */
    static function path(?int $index = null): null|array|string
    {
        self::$PATH = self::$PATH ?? self::current_path();

        if (!is_null($index)) return self::$PATH[$index] ?? null;

        return self::$PATH;
    }

    /**
     * Retorna um ou todos os parâmetros passados via query string na requisição atual.
     * @param ?string $parameter Nome do parâmetro (opcional).
     * @return mixed
     */
    static function query(?string $parameter = null): mixed
    {
        self::$QUERY = self::$QUERY ?? self::current_query();

        if (!is_null($parameter)) return self::$QUERY[$parameter] ?? null;

        return self::$QUERY;
    }

    /**
     * Retorna um ou todos os dados enviados no corpo da requisição atual.
     * @param ?string $parameter Nome do parâmetro (opcional).
     * @return mixed
     */
    static function body(?string $parameter = null): mixed
    {
        self::$BODY = self::$BODY ?? self::current_body();

        if (!is_null($parameter)) return self::$BODY[$parameter] ?? null;

        return self::$BODY;
    }

    /**
     * Retorna um ou todos os dados enviados via rota para a requisição atual.
     * @param ?string $parameter Nome do parâmetro (opcional).
     * @return mixed
     */
    static function route(?string $parameter = null): mixed
    {
        if (!is_null($parameter)) return self::$ROUTE[$parameter] ?? null;

        return self::$ROUTE;
    }

    /**
     * Retorna um ou todos os dados capturados pela requisição atual via route, query, body ou file.
     * @param ?string $parameter Nome do parâmetro (opcional).
     * @return mixed
     */
    static function data(?string $parameter = null): mixed
    {
        $data = [...self::route(), ...self::query(), ...self::body(), ...self::file()];

        if (!is_null($parameter)) return $data[$parameter] ?? null;

        return $data;
    }

    /**
     * Retorna um ou todos os arquivos enviados na requisição atual.
     * @param ?string $name Nome do arquivo (opcional).
     * @return array
     */
    static function file(?string $name = null): array
    {
        self::$FILE = self::$FILE ?? self::current_file();

        $return = self::$FILE;

        if (!is_null($name)) $return = $return[$name] ?? [];

        return $return;
    }

    #==| SET |==#

    /**
     * Define o valor de um parâmetro header da requisição atual.
     * @param string|int $name Nome do parâmetro.
     * @param mixed $value Valor a definir.
     */
    static function set_header(string|int $name, mixed $value): void
    {
        self::$HEADER = self::$HEADER ?? self::current_header();
        self::$HEADER[$name] = $value;
    }

    /**
     * Define o valor de um parâmetro query da requisição atual.
     * @param string|int $name Nome do parâmetro.
     * @param mixed $value Valor a definir.
     */
    static function set_query(string|int $name, mixed $value): void
    {
        self::$QUERY = self::$QUERY ?? self::current_query();
        self::$QUERY[$name] = $value;
    }

    /**
     * Define o valor de um parâmetro do corpo da requisição atual.
     * @param string|int $name Nome do parâmetro.
     * @param mixed $value Valor a definir.
     */
    static function set_body(string|int $name, mixed $value): void
    {
        self::$BODY = self::$BODY ?? self::current_body();
        self::$BODY[$name] = $value;
    }

    /**
     * Define o valor de um parâmetro de rota da requisição atual.
     * @param string|int $name Nome do parâmetro.
     * @param mixed $value Valor a definir.
     */
    static function set_route(string|int $name, mixed $value): void
    {
        self::$ROUTE[$name] = $value;
    }

    /** @ignore */
    protected static function current_server(): array
    {
        return $_SERVER;
    }

    /** @ignore */
    protected static function current_header(): array
    {
        return IS_TERMINAL ? [] : getallheaders();
    }

    /** @ignore */
    protected static function current_type(): string
    {
        if (IS_TERMINAL) return 'TERMINAL';

        return self::server('REQUEST_METHOD') ?? 'UNDEFINED';
    }

    /** @ignore */
    protected static function current_ssl(): bool
    {
        if (IS_TERMINAL)
            return env('FORCE_SSL');

        return env('FORCE_SSL') || strtolower(self::server('HTTPS') ?? '') == 'on';
    }

    /** @ignore */
    protected static function current_host(): string
    {
        if (self::server('HTTP_HOST')) return self::server('HTTP_HOST');

        $parse = parse_url(env('TERMINAL_URL') ?? 'http://localhost:8888');

        $host = $parse['host'];

        if (isset($parse['port']))
            $host = "$host:" . $parse['port'];

        return $host;
    }

    /** @ignore */
    protected static function current_path(): array
    {
        $path = urldecode(self::server('REQUEST_URI') ?? '');
        $path = explode('?', $path);
        $path = array_shift($path);
        $path = trim($path, '/');
        $path = explode('/', $path);
        $path = array_filter($path, fn($path) => !is_blank($path));

        return $path ?? [];
    }

    /** @ignore */
    protected static function current_query(): array
    {
        $query = self::server('REQUEST_URI') ?? '';

        $query = parse_url($query)['query'] ?? '';

        parse_str($query, $query);

        $query = array_map(fn($v) => urldecode($v), (array) $query);

        return array_map(fn($var) => str_get_var($var), $query);
    }

    /** @ignore */
    protected static function current_body(): array
    {
        $data = [];

        $inputData = file_get_contents('php://input');

        if (is_json($inputData)) {
            $data = json_decode($inputData, true);
        } elseif (self::type('POST')) {
            $data = $_POST;
        } else if (self::type('GET') || self::type('PUT') || self::type('DELETE')) {
            parse_str($inputData, $data);
        }

        array_walk_recursive($data, fn(&$v) => $v = str_get_var($v));

        return $data;
    }

    /** @ignore */
    protected static function current_file(): array
    {
        if (IS_TERMINAL) return [];

        $files = [];

        foreach ($_FILES as $name => $file) {
            if (is_array($file['error'])) {
                for ($i = 0; $i < count($file['error']); $i++) {
                    $files[$name][] = [
                        'name' => $file['name'][$i],
                        'full_path' => $file['full_path'][$i],
                        'type' => $file['type'][$i],
                        'tmp_name' => $file['tmp_name'][$i],
                        'error' => $file['error'][$i],
                        'size' => $file['size'][$i],
                    ];
                }
            } else {
                $files[$name][] = [
                    'name' => $file['name'],
                    'full_path' => $file['full_path'],
                    'type' => $file['type'],
                    'tmp_name' => $file['tmp_name'],
                    'error' => $file['error'],
                    'size' => $file['size'],
                ];
            }
        }

        foreach ($files as &$file)
            $file = array_shift($file);

        return $files;
    }
}

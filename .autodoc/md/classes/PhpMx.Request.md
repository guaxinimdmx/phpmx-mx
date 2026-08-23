# `PhpMx\Request`

[← Classes](../classes.md) · [← Index](../../autodoc.md)

**Type:** `abstract class`

Classe para acesso aos dados da requisição HTTP atual.

## Properties

- `protected static $SERVER` `?array` —
- `protected static $TYPE` `?string` —
- `protected static $HEADER` `?array` —
- `protected static $SSL` `?bool` —
- `protected static $HOST` `?string` —
- `protected static $PATH` `?array` —
- `protected static $QUERY` `?array` —
- `protected static $BODY` `?array` —
- `protected static $ROUTE` `array` —
- `protected static $FILE` `?array` —

## Methods

---

### `public static server(parameter)`

Retorna um ou todos os parâmetros server da requisição atual.

```php
Request::server()
Request::server($parameter)
```

- `$parameter` `?string` — Nome do parâmetro (opcional).

**Returns:** `mixed`

---

### `public static type(type)`

Retorna ou compara o tipo da requisição atual (GET, POST, PUT, DELETE, OPTIONS).

```php
Request::type()
Request::type($type)
```

- `$type` `?string` — Tipo a comparar (opcional). Retorna bool quando informado.

**Returns:** `string|bool`

---

### `public static header(parameter)`

Retorna um ou todos os parâmetros header da requisição atual.

```php
Request::header()
Request::header($parameter)
```

- `$parameter` `?string` — Nome do parâmetro (opcional).

**Returns:** `mixed`

---

### `public static ssl(ssl)`

Retorna ou compara o status de utilização SSL da requisição atual.

```php
Request::ssl()
Request::ssl($ssl)
```

- `$ssl` `?bool` — Valor a comparar (opcional). Retorna bool quando informado.

**Returns:** `bool`

---

### `public static host()`

Retorna o host da requisição atual.

```php
Request::host()
```

**Returns:** `string`

---

### `public static path(index)`

Retorna um ou todos os segmentos de caminho da URI da requisição atual.

```php
Request::path()
Request::path($index)
```

- `$index` `?int` — Índice do segmento (opcional).

**Returns:** `array|string|null`

---

### `public static query(parameter)`

Retorna um ou todos os parâmetros passados via query string na requisição atual.

```php
Request::query()
Request::query($parameter)
```

- `$parameter` `?string` — Nome do parâmetro (opcional).

**Returns:** `mixed`

---

### `public static body(parameter)`

Retorna um ou todos os dados enviados no corpo da requisição atual.

```php
Request::body()
Request::body($parameter)
```

- `$parameter` `?string` — Nome do parâmetro (opcional).

**Returns:** `mixed`

---

### `public static route(parameter)`

Retorna um ou todos os dados enviados via rota para a requisição atual.

```php
Request::route()
Request::route($parameter)
```

- `$parameter` `?string` — Nome do parâmetro (opcional).

**Returns:** `mixed`

---

### `public static data(parameter)`

Retorna um ou todos os dados capturados pela requisição atual via route, query, body ou file.

```php
Request::data()
Request::data($parameter)
```

- `$parameter` `?string` — Nome do parâmetro (opcional).

**Returns:** `mixed`

---

### `public static file(name)`

Retorna um ou todos os arquivos enviados na requisição atual.

```php
Request::file()
Request::file($name)
```

- `$name` `?string` — Nome do arquivo (opcional).

**Returns:** `array`

---

### `public static set_header(name, value)`

Define o valor de um parâmetro header da requisição atual.

```php
Request::set_header($name, $value)
```

- `$name` `string|int` — Nome do parâmetro.
- `$value` `mixed` — Valor a definir.

**Returns:** `void`

---

### `public static set_query(name, value)`

Define o valor de um parâmetro query da requisição atual.

```php
Request::set_query($name, $value)
```

- `$name` `string|int` — Nome do parâmetro.
- `$value` `mixed` — Valor a definir.

**Returns:** `void`

---

### `public static set_body(name, value)`

Define o valor de um parâmetro do corpo da requisição atual.

```php
Request::set_body($name, $value)
```

- `$name` `string|int` — Nome do parâmetro.
- `$value` `mixed` — Valor a definir.

**Returns:** `void`

---

### `public static set_route(name, value)`

Define o valor de um parâmetro de rota da requisição atual.

```php
Request::set_route($name, $value)
```

- `$name` `string|int` — Nome do parâmetro.
- `$value` `mixed` — Valor a definir.

**Returns:** `void`
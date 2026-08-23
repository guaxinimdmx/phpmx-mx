# `PhpMx\Router`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe responsável pelo registro, organização e resolução de rotas HTTP.

## Methods

---

### `public static add(route, response, middlewares)`

Adiciona uma rota para responder por requisições GET e POST.

```php
Router::add($route, $response)
Router::add($route, $response, $middlewares)
```

- `$route` `string` — Template da rota (ex: 'users/[#id]').
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static full(route, response, middlewares)`

Adiciona uma rota para responder por requisições GET, POST, PUT e DELETE.

```php
Router::full($route, $response)
Router::full($route, $response, $middlewares)
```

- `$route` `string` — Template da rota.
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static get(route, response, middlewares)`

Adiciona uma rota para responder por requisições GET.

```php
Router::get($route, $response)
Router::get($route, $response, $middlewares)
```

- `$route` `string` — Template da rota.
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static post(route, response, middlewares)`

Adiciona uma rota para responder por requisições POST.

```php
Router::post($route, $response)
Router::post($route, $response, $middlewares)
```

- `$route` `string` — Template da rota.
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static put(route, response, middlewares)`

Adiciona uma rota para responder por requisições PUT.

```php
Router::put($route, $response)
Router::put($route, $response, $middlewares)
```

- `$route` `string` — Template da rota.
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static delete(route, response, middlewares)`

Adiciona uma rota para responder por requisições DELETE.

```php
Router::delete($route, $response)
Router::delete($route, $response, $middlewares)
```

- `$route` `string` — Template da rota.
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static path(path, wrapper)`

Define um prefixo de caminho para um conjunto de rotas declaradas no Closure.

```php
Router::path($path, $wrapper)
```

- `$path` `string` — Prefixo de caminho a ser aplicado.
- `$wrapper` `Closure` — Função contendo as declarações de rotas.

**Returns:** `void`

---

### `public static middleware(middlewares, wrapper)`

Define middlewares padrão para um conjunto de rotas declaradas no Closure.

```php
Router::middleware($middlewares, $wrapper)
```

- `$middlewares` `array` — Lista de middlewares a aplicar.
- `$wrapper` `Closure` — Função contendo as declarações de rotas.

**Returns:** `void`

---

### `public static group(path, middlewares, wrapper)`

Define caminho e middlewares padrão para um conjunto de rotas declaradas no Closure.

```php
Router::group($path, $middlewares, $wrapper)
```

- `$path` `string` — Prefixo de caminho a ser aplicado.
- `$middlewares` `array` — Lista de middlewares a aplicar.
- `$wrapper` `Closure` — Função contendo as declarações de rotas.

**Returns:** `void`

---

### `public static solve(GLOBAL_MIDDLEWARES)`

Resolve a requisição atual, executa os middlewares e envia a resposta ao cliente.

```php
Router::solve()
Router::solve($GLOBAL_MIDDLEWARES)
```

- `$GLOBAL_MIDDLEWARES` `array` — Middlewares globais executados antes dos middlewares de rota.

**Returns:** `mixed`
# `PhpMx\Router`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe responsável pelo registro, organização e resolução de rotas HTTP.

## Methods

---

### `public static add(route, response, middlewares)`

Adiciona uma rota para responder por requisições GET e POST.

- `$route` `string` — Template da rota (ex: 'users/[#id]').
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static full(route, response, middlewares)`

Adiciona uma rota para responder por requisições GET, POST, PUT e DELETE.

- `$route` `string` — Template da rota.
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static get(route, response, middlewares)`

Adiciona uma rota para responder por requisições GET.

- `$route` `string` — Template da rota.
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static post(route, response, middlewares)`

Adiciona uma rota para responder por requisições POST.

- `$route` `string` — Template da rota.
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static put(route, response, middlewares)`

Adiciona uma rota para responder por requisições PUT.

- `$route` `string` — Template da rota.
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static delete(route, response, middlewares)`

Adiciona uma rota para responder por requisições DELETE.

- `$route` `string` — Template da rota.
- `$response` `array|string|int` — Classe, array [classe, método] ou status HTTP de resposta.
- `$middlewares` `array` — Lista de middlewares da rota.

**Returns:** `void`

---

### `public static path(path, wrapper)`

Define um prefixo de caminho para um conjunto de rotas declaradas no Closure.

- `$path` `string` — Prefixo de caminho a ser aplicado.
- `$wrapper` `Closure` — Função contendo as declarações de rotas.

**Returns:** `void`

---

### `public static middleware(middlewares, wrapper)`

Define middlewares padrão para um conjunto de rotas declaradas no Closure.

- `$middlewares` `array` — Lista de middlewares a aplicar.
- `$wrapper` `Closure` — Função contendo as declarações de rotas.

**Returns:** `void`

---

### `public static group(path, middlewares, wrapper)`

Define caminho e middlewares padrão para um conjunto de rotas declaradas no Closure.

- `$path` `string` — Prefixo de caminho a ser aplicado.
- `$middlewares` `array` — Lista de middlewares a aplicar.
- `$wrapper` `Closure` — Função contendo as declarações de rotas.

**Returns:** `void`

---

### `public static solve(GLOBAL_MIDDLEWARES)`

Resolve a requisição atual, executa os middlewares e envia a resposta ao cliente.

- `$GLOBAL_MIDDLEWARES` `array` — Middlewares globais executados antes dos middlewares de rota.

**Returns:** `mixed`
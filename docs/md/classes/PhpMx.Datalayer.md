# `PhpMx\Datalayer`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Gerencia conexões reutilizáveis com múltiplos bancos de dados.

## Properties

- `protected static $instance` `mixed` —
- `protected static $type` `array` —

## Methods

---

### `public static get(dbName)`

Retorna a conexão ativa com o banco de dados, registrando-a na primeira chamada.

- `$dbName` `string` — Nome do banco de dados.

**Returns:** `PhpMx\Datalayer\Connection\BaseConnection`

---

### `public static register(dbName, data)`

Registra uma nova conexão com o banco de dados.

- `$dbName` `string` — Nome do banco de dados.
- `$data` `array` — Dados de configuração da conexão (opcional, usa variáveis de ambiente por padrão).

**Returns:** `void`

---

### `public static unregister(dbName)`

Remove o registro de uma conexão com o banco de dados.

- `$dbName` `string` — Nome do banco de dados.

**Returns:** `void`

---

### `public static internalName(name)`

Converte um nome para o formato interno de uso no banco de dados (snake_case).

- `$name` `string` — Nome a converter.

**Returns:** `string`

---

### `public static externalName(name, prefix)`

Converte um nome para o formato externo de uso no código (camelCase).

- `$name` `string` — Nome a converter.
- `$prefix` `?string` — Prefixo a concatenar ao nome (opcional).

**Returns:** `string`
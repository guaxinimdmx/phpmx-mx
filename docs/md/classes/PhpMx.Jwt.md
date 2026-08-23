# `PhpMx\Jwt`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe utilitária criação e leitura de JWT.

## Methods

---

### `public static on(payload, key)`

Retorna o token JWT

- `$payload` `mixed` — Dados que deve estar no JWT
- `$key` `?string` — Chave para criação do token (caso vazio, usa a chave padrão)

**Returns:** `string`

---

### `public static off(token, key)`

Retorna o token conteúdo de um token JWT

- `$token` `mixed` — Dados contidos no JWT
- `$key` `?string` — Chave para verificação do token (caso vazio, usa a chave padrão)

**Returns:** `mixed`

---

### `public static check(var, key)`

Verifica se uma variavel é um token JWT válido

- `$var` `mixed` — Variavel que deve ser verificada
- `$key` `?string` — Chave para verificação do token (caso vazio, usa a chave padrão)

**Returns:** `mixed`
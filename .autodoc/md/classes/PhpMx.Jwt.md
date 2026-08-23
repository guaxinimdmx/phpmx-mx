# `PhpMx\Jwt`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `abstract class`

Classe utilitária criação e leitura de JWT.











## Methods

---

### `public static on(payload, key)`



Retorna o token JWT

```php
Jwt::on($payload)
Jwt::on($payload, $key)
```

- `$payload` `mixed` — Dados que deve estar no JWT
- `$key` `?string` — Chave para criação do token (caso vazio, usa a chave padrão)

**Returns:** `string`

---

### `public static off(token, key)`



Retorna o token conteúdo de um token JWT

```php
Jwt::off($token)
Jwt::off($token, $key)
```

- `$token` `mixed` — Dados contidos no JWT
- `$key` `?string` — Chave para verificação do token (caso vazio, usa a chave padrão)

**Returns:** `mixed`

---

### `public static check(var, key)`



Verifica se uma variavel é um token JWT válido

```php
Jwt::check($var)
Jwt::check($var, $key)
```

- `$var` `mixed` — Variavel que deve ser verificada
- `$key` `?string` — Chave para verificação do token (caso vazio, usa a chave padrão)

**Returns:** `mixed`
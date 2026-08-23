# `PhpMx\Datalayer\Driver\Field\FEmail`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `class`

Campo de e-mail, com sanitização, normalização e validação de formato automáticas.

**Extends:** `PhpMx\Datalayer\Driver\Field\FVarchar`

## Methods

---

### `public set(value)`

Define o valor do campo normalizando para minúsculas, removendo acentos e sanitizando o e-mail.

```php
$fEmail->set($value)
```

- `$value` `mixed` — Valor a definir.

**Returns:** `static`

---

### `protected validade(value)`

Valida se o valor é um endereço de e-mail válido.

- `$value` `mixed` — Valor a validar.

**Returns:** `void`
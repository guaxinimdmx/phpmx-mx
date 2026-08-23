# `PhpMx\Input\InputFieldScheme`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `class`

Campo de input para validação e decodificação de esquemas JSON. Aceita arrays ou strings JSON, decodificando automaticamente para array após validação.

**Extends:** `PhpMx\Input\InputField`









## Methods

---

### `public __construct(name, alias, value)`





```php
new InputFieldScheme($name)
new InputFieldScheme($name, $alias)
new InputFieldScheme($name, $alias, $value)
```

- `$name` `string` — Nome do campo.
- `$alias` `?string` — Rótulo amigável para mensagens de erro.
- `$value` `mixed` — Valor inicial (array ou string JSON).

**Returns:** `mixed`
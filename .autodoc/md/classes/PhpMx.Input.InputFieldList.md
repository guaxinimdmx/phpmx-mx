# `PhpMx\Input\InputFieldList`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `class`

Campo de input para listas representadas como string separada por vírgulas. Converte automaticamente arrays recebidos para string antes de aplicar as regras herdadas.

**Extends:** `PhpMx\Input\InputField`

## Methods

---

### `public __construct(name, alias, value)`

```php
new InputFieldList($name)
new InputFieldList($name, $alias)
new InputFieldList($name, $alias, $value)
```

- `$name` `string` — Nome do campo.
- `$alias` `?string` — Rótulo amigável para mensagens de erro.
- `$value` `mixed` — Valor inicial (array é convertido automaticamente para string CSV).

**Returns:** `mixed`
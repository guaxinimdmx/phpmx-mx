# `PhpMx\Input\InputFieldBool`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `class`

Campo de input especializado para valores booleanos. Converte automaticamente o valor recebido para bool antes de aplicar as regras herdadas.

**Extends:** `PhpMx\Input\InputField`









## Methods

---

### `public __construct(name, alias, value)`





```php
new InputFieldBool($name)
new InputFieldBool($name, $alias)
new InputFieldBool($name, $alias, $value)
```

- `$name` `string` — Nome do campo.
- `$alias` `?string` — Rótulo amigável para mensagens de erro.
- `$value` `mixed` — Valor inicial convertido automaticamente para bool.

**Returns:** `mixed`
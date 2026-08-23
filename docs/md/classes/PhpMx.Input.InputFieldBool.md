# `PhpMx\Input\InputFieldBool`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Campo de input especializado para valores booleanos. Converte automaticamente o valor recebido para bool antes de aplicar as regras herdadas.

**Extends:** `PhpMx\Input\InputField`

## Methods

---

### `public __construct(name, alias, value)`

- `$name` `string` — Nome do campo.
- `$alias` `?string` — Rótulo amigável para mensagens de erro.
- `$value` `mixed` — Valor inicial convertido automaticamente para bool.

**Returns:** `mixed`
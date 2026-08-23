# `PhpMx\Input\InputFieldCaptcha`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Campo de input para validação de captchas com cifra e hash. Aplica automaticamente validação do código recebido contra a chave cifrada.

**Extends:** `PhpMx\Input\InputField`

## Methods

---

### `public __construct(name, alias, value)`

- `$name` `string` — Nome do campo.
- `$alias` `?string` — Rótulo amigável para mensagens de erro.
- `$value` `mixed` — Valor inicial do campo (código captcha recebido).

**Returns:** `mixed`
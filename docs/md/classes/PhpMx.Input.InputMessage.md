# `PhpMx\Input\InputMessage`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe utilitária para gerenciamento de mensagens de erro de inputs. Centraliza as mensagens padrão para regras de validação, permitindo personalização global.

## Methods

---

### `public static set(type, message)`

Define ou altera uma mensagem padrão para um tipo de validação.

```php
InputMessage::set($type, $message)
```

- `$type` `string|int` — Constante FILTER_VALIDATE_* ou chave textual (ex: 'required', 'equal').
- `$message` `?string` — Mensagem a associar ao tipo (suporta tags de prepare como [#name]).

**Returns:** `mixed`

---

### `public static get(type)`

Retorna a mensagem padrão para um tipo de validação.

```php
InputMessage::get($type)
```

- `$type` `string` — Constante FILTER_VALIDATE_* ou chave textual.

**Returns:** `string|null`
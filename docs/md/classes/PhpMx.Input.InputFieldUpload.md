# `PhpMx\Input\InputFieldUpload`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Campo de input para validação de arquivos enviados via upload. Verifica automaticamente erros de envio, tamanho e integridade do arquivo recebido.

**Extends:** `PhpMx\Input\InputField`

## Methods

---

### `public __construct(name, alias, value)`

- `$name` `string` — Nome do campo.
- `$alias` `?string` — Rótulo amigável para mensagens de erro.
- `$value` `mixed` — Valor inicial (array de arquivo do $_FILES).

**Returns:** `mixed`
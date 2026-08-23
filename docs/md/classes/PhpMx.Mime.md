# `PhpMx\Mime`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe utilitária para detecção, tradução e validação de MIME types.

## Properties

- `protected static $MIMETYPE` `array` —

## Methods

---

### `public static getExMime(mime)`

Retorna a extensão correspondente a um MIME type.

- `$mime` `string` — O MIME type para busca (ex: 'text/html').

**Returns:** `?string`

---

### `public static getMimeEx(ex)`

Retorna o MIME type correspondente a uma extensão.

- `$ex` `string` — A extensão para busca (ex: 'jpg').

**Returns:** `?string`

---

### `public static getMimeFile(file)`

Identifica o MIME type de um arquivo físico baseado em seu conteúdo.

- `$file` `string` — Caminho para o arquivo.

**Returns:** `?string`

---

### `public static checkMimeEx(ex, compare)`

Verifica se uma extensão corresponde a um ou mais MIME types ou outras extensões.

- `$ex` `string` — Extensão base.
- `$compare` `string` — MIME types ou extensões para comparar.

**Returns:** `bool`

---

### `public static checkMimeMime(mime, compare)`

Compara um MIME type contra uma lista de outros MIME types ou extensões.

- `$mime` `string` — MIME type base.
- `$compare` `string` — MIME types ou extensões para comparar.

**Returns:** `bool`

---

### `public static checkMimeFile(file, compare)`

Verifica se o MIME type real de um arquivo corresponde aos tipos fornecidos.

- `$file` `string` — Caminho para o arquivo.
- `$compare` `string` — MIME types ou extensões para comparar.

**Returns:** `bool`
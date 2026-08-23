# `PhpMx\Assets`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe utilitária para envio e download de arquivos via resposta HTTP.

## Methods

---

### `public static send(path)`

Envia um arquivo do projeto como resposta da requisição.

- `$path` `string` — Partes do caminho do arquivo.

**Returns:** `void`

---

### `public static download(path)`

Realiza o download de um arquivo do projeto como resposta da requisição.

- `$path` `string` — Partes do caminho do arquivo.

**Returns:** `void`

---

### `public static load(path)`

Carrega um arquivo do projeto na resposta da requisição.

- `$path` `string` — Partes do caminho do arquivo.

**Returns:** `void`
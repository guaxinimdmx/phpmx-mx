# `PhpMx\Path`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe utilitária para gerenciamento, normalização e busca de caminhos.

## Methods

---

### `public static origin(path)`

Identifica o pacote de origem de um diretório ou arquivo.

- `$path` `string` — Caminho para análise.

**Returns:** `string`

---

### `public static format(segments)`

Formata e normaliza um ou mais segmentos de caminho. Remove redundâncias, converte barras invertidas e limpa o caminho relativo ao root.

- `$segments` `string` — Segmentos do caminho (aceita múltiplos argumentos).

**Returns:** `string`

---

### `public static register(path)`

Registra um novo diretório na pilha de busca para importação de arquivos.

- `$path` `string` — Diretório a ser registrado.

**Returns:** `void`

---

### `public static registred()`

Retorna a lista de caminhos registrados para busca, em ordem inversa (prioridade do último registrado).

**Returns:** `array`

---

### `public static seekForFile(segments)`

Busca o primeiro arquivo existente percorrendo os caminhos registrados.

- `$segments` `string` — Segmentos do nome/caminho do arquivo.

**Returns:** `?string`

---

### `public static seekForFiles(segments)`

Busca e retorna todos os arquivos correspondentes encontrados nos caminhos registrados.

- `$segments` `string` — Segmentos do nome/caminho do arquivo.

**Returns:** `array`

---

### `public static seekForDir(segments)`

Busca o primeiro diretório existente percorrendo os caminhos registrados.

- `$segments` `string` — Segmentos do nome/caminho do diretório.

**Returns:** `?string`

---

### `public static seekForDirs(segments)`

Busca e retorna todos os diretórios correspondentes encontrados nos caminhos registrados.

- `$segments` `string` — Segmentos do nome/caminho do diretório.

**Returns:** `array`
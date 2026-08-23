# `PhpMx\Import`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe utilitária para importar arquivos e extrair valores.

## Methods

---

### `public static only(filePath, once)`

Importa um arquivo PHP.

- `$filePath` `string` — Caminho do arquivo.
- `$once` `bool` — Define se deve usar require_once ou require.

**Returns:** `bool`

---

### `public static content(filePath, prepare)`

Retorna o conteúdo de um arquivo com suporte a processamento de template.

- `$filePath` `string` — Caminho do arquivo.
- `$prepare` `array|string` — Dados para substituição via prepare.

**Returns:** `string`

---

### `public static return(filePath, params)`

Retorna o valor retornado (return) por um arquivo PHP.

- `$filePath` `string` — Caminho do arquivo PHP.
- `$params` `array` — Variáveis a serem extraídas para o escopo do arquivo.

**Returns:** `mixed`

---

### `public static var(filePath, varName, params)`

Retorna o valor de uma variável específica definida dentro de um arquivo PHP.

- `$filePath` `string` — Caminho do arquivo PHP.
- `$varName` `string` — Nome da variável a ser extraída.
- `$params` `array` — Variáveis de contexto para o arquivo.

**Returns:** `mixed`

---

### `public static output(filePath, params)`

Retorna a saída de texto (buffer) gerada pela execução de um arquivo.

- `$filePath` `string` — Caminho do arquivo.
- `$params` `array` — Variáveis de contexto para o arquivo.

**Returns:** `string`
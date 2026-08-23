# `PhpMx\Trait\TerminalInstallTrait`

[← Classes](../classes.md) · [← Index](../../autodoc.md)

**Type:** `trait`

Facilita a criação de arquivos de instalação via php mx make.install

## Methods

---

### `protected promote(pathFile)`

Copia um arquivo do sistema para o diretório local se ele ainda não existir.

- `$pathFile` `string` — Caminho do arquivo.

**Returns:** `mixed`

---

### `protected createDir(pathDir)`

Cria um diretório no projeto se ele não for encontrado.

- `$pathDir` `string` — Caminho da pasta.

**Returns:** `mixed`

---

### `protected createFile(pathFile, contentLines)`

Cria um arquivo com o conteúdo fornecido (array de linhas).

- `$pathFile` `string` — Caminho do arquivo.
- `$contentLines` `array` — Linhas de conteúdo.

**Returns:** `mixed`

---

### `protected blockFile(pathFile, blockName, contentLines)`

Insere um bloco de texto identificado por um comentário em um arquivo. Evita duplicidade verificando a existência da tag "# blockName".

- `$pathFile` `string` — Destino.
- `$blockName` `string` — Identificador do bloco.
- `$contentLines` `array` — Conteúdo a ser inserido.

**Returns:** `mixed`
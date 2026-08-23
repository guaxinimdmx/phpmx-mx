# `PhpMx\Path`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `abstract class`

Classe utilitária para gerenciamento, normalização e busca de caminhos.











## Methods

---

### `public static origin(path)`



Identifica o pacote de origem de um diretório ou arquivo.

```php
Path::origin($path)
```

- `$path` `string` — Caminho para análise.

**Returns:** `string`

---

### `public static format(segments)`



Formata e normaliza um ou mais segmentos de caminho. Remove redundâncias, converte barras invertidas e limpa o caminho relativo ao root.

```php
Path::format()
Path::format(...$segments)
```

- `$segments` `string` — Segmentos do caminho (aceita múltiplos argumentos).

**Returns:** `string`

---

### `public static register(path)`



Registra um novo diretório na pilha de busca para importação de arquivos.

```php
Path::register($path)
```

- `$path` `string` — Diretório a ser registrado.

**Returns:** `void`

---

### `public static registred()`



Retorna a lista de caminhos registrados para busca, em ordem inversa (prioridade do último registrado).

```php
Path::registred()
```



**Returns:** `array`

---

### `public static seekForFile(segments)`



Busca o primeiro arquivo existente percorrendo os caminhos registrados.

```php
Path::seekForFile()
Path::seekForFile(...$segments)
```

- `$segments` `string` — Segmentos do nome/caminho do arquivo.

**Returns:** `?string`

---

### `public static seekForFiles(segments)`



Busca e retorna todos os arquivos correspondentes encontrados nos caminhos registrados.

```php
Path::seekForFiles()
Path::seekForFiles(...$segments)
```

- `$segments` `string` — Segmentos do nome/caminho do arquivo.

**Returns:** `array`

---

### `public static seekForDir(segments)`



Busca o primeiro diretório existente percorrendo os caminhos registrados.

```php
Path::seekForDir()
Path::seekForDir(...$segments)
```

- `$segments` `string` — Segmentos do nome/caminho do diretório.

**Returns:** `?string`

---

### `public static seekForDirs(segments)`



Busca e retorna todos os diretórios correspondentes encontrados nos caminhos registrados.

```php
Path::seekForDirs()
Path::seekForDirs(...$segments)
```

- `$segments` `string` — Segmentos do nome/caminho do diretório.

**Returns:** `array`
# `PhpMx\File`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `abstract class`

Classe utilitária para manipulação de arquivos.

## Methods

---

### `public static create(path, content, recreate)`

Cria um arquivo de texto.

```php
File::create($path, $content)
File::create($path, $content, $recreate)
```

- `$path` `string` — Caminho do arquivo.
- `$content` `string` — Conteúdo a ser gravado.
- `$recreate` `bool` — Se deve sobrescrever o arquivo caso ele já exista.

**Returns:** `?bool`

---

### `public static remove(path)`

Remove um arquivo físico.

```php
File::remove($path)
```

- `$path` `string` — Caminho do arquivo.

**Returns:** `?bool`

---

### `public static copy(path_from, path_to, replace)`

Cria uma cópia de um arquivo.

```php
File::copy($path_from, $path_to)
File::copy($path_from, $path_to, $replace)
```

- `$path_from` `string` — Caminho de origem.
- `$path_to` `string` — Caminho de destino.
- `$replace` `bool` — Se deve substituir o arquivo de destino caso ele já exista.

**Returns:** `?bool`

---

### `public static move(path_from, path_to, replace)`

Altera o local ou o nome de um arquivo (move/rename).

```php
File::move($path_from, $path_to)
File::move($path_from, $path_to, $replace)
```

- `$path_from` `string` — Caminho de origem.
- `$path_to` `string` — Caminho de destino.
- `$replace` `bool` — Se deve substituir o arquivo de destino caso ele já exista.

**Returns:** `?bool`

---

### `public static getOnly(path)`

Retorna apenas o nome do arquivo com a sua respectiva extensão.

```php
File::getOnly($path)
```

- `$path` `string` — Caminho do arquivo.

**Returns:** `string`

---

### `public static getName(path)`

Retorna apenas o nome do arquivo, removendo a extensão.

```php
File::getName($path)
```

- `$path` `string` — Caminho do arquivo.

**Returns:** `string`

---

### `public static getEx(path)`

Retorna apenas a extensão do arquivo em letras minúsculas.

```php
File::getEx($path)
```

- `$path` `string` — Caminho do arquivo.

**Returns:** `string`

---

### `public static setEx(path, extension)`

Define ou altera a extensão de um caminho de arquivo.

```php
File::setEx($path)
File::setEx($path, $extension)
```

- `$path` `string` — Caminho original.
- `$extension` `string` — Nova extensão (padrão 'php').

**Returns:** `string`

---

### `public static check(path)`

Verifica se um arquivo existe no caminho especificado.

```php
File::check($path)
```

- `$path` `string` — Caminho do arquivo.

**Returns:** `bool`

---

### `public static getSize(path, human)`

Retorna o tamanho do arquivo em bytes ou formato legível (human-readable).

```php
File::getSize($path)
File::getSize($path, $human)
```

- `$path` `string` — Caminho do arquivo.
- `$human` `bool` — Se true, retorna formatado (ex: '10 kb'). Se false, retorna bytes.

**Returns:** `string|int`

---

### `public static getLastModified(path)`

Retorna o timestamp da última modificação do arquivo.

```php
File::getLastModified($path)
```

- `$path` `string` — Caminho do arquivo.

**Returns:** `?int`
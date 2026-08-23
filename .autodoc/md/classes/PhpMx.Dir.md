# `PhpMx\Dir`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `abstract class`

Classe utilitária para manipulação de diretórios.

## Methods

---

### `public static create(path)`

Cria um diretório de forma recursiva.

```php
Dir::create($path)
```

- `$path` `string` — Caminho do diretório.

**Returns:** `?bool`

---

### `public static remove(path, recursive)`

Remove um diretório e seu conteúdo.

```php
Dir::remove($path)
Dir::remove($path, $recursive)
```

- `$path` `string` — Caminho do diretório.
- `$recursive` `bool` — Se true, remove subdiretórios e arquivos recursivamente.

**Returns:** `?bool`

---

### `public static copy(path_from, path_to, replace)`

Cria uma cópia de um diretório.

```php
Dir::copy($path_from, $path_to)
Dir::copy($path_from, $path_to, $replace)
```

- `$path_from` `string` — Caminho de origem.
- `$path_to` `string` — Caminho de destino.
- `$replace` `bool` — Se deve substituir arquivos existentes no destino.

**Returns:** `?bool`

---

### `public static move(path_from, path_to)`

Altera o local ou nome de um diretório.

```php
Dir::move($path_from, $path_to)
```

- `$path_from` `string` — Caminho de origem.
- `$path_to` `string` — Caminho de destino.

**Returns:** `?bool`

---

### `public static seekForFile(path, recursive)`

Lista apenas os arquivos contidos em um diretório.

```php
Dir::seekForFile($path)
Dir::seekForFile($path, $recursive)
```

- `$path` `string` — Caminho do diretório.
- `$recursive` `bool` — Se true, busca arquivos em subdiretórios.

**Returns:** `array`

---

### `public static seekForDir(path, recursive)`

Lista apenas os diretórios contidos em um diretório.

```php
Dir::seekForDir($path)
Dir::seekForDir($path, $recursive)
```

- `$path` `string` — Caminho do diretório.
- `$recursive` `bool` — Se true, busca subdiretórios recursivamente.

**Returns:** `array`

---

### `public static seekForAll(path, recursive)`

Lista todos os arquivos e diretórios contidos em um caminho.

```php
Dir::seekForAll($path)
Dir::seekForAll($path, $recursive)
```

- `$path` `string` — Caminho do diretório.
- `$recursive` `bool` — Se true, vasculha de forma profunda.

**Returns:** `array`

---

### `public static getOnly(path)`

Retorna o caminho do diretório pai, removendo o nome do arquivo se presente.

```php
Dir::getOnly($path)
```

- `$path` `string` — Caminho original.

**Returns:** `string`

---

### `public static check(path)`

Verifica se o caminho informado é um diretório válido.

```php
Dir::check($path)
```

- `$path` `string` — O caminho a verificar.

**Returns:** `bool`
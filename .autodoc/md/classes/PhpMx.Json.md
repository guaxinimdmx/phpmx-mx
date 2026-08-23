# `PhpMx\Json`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `abstract class`

Classe utilitária para importar e exportar arquivos JSON.











## Methods

---

### `public static import(path)`



Importa o conteúdo de um arquivo json para um array

```php
Json::import($path)
```

- `$path` `string` — Caminho do arquivo (extensão .json adicionada automaticamente se omitida).

**Returns:** `?array`

---

### `public static export(path, array, merge)`



Exporta um array para um arquivo json

```php
Json::export($path, $array)
Json::export($path, $array, $merge)
```

- `$path` `string` — Caminho do arquivo de destino (extensão .json adicionada automaticamente se omitida).
- `$array` `array` — Dados a serem exportados.
- `$merge` `bool` — Se deve mesclar com o conteúdo já existente no arquivo.

**Returns:** `void`
# `PhpMx\Reflection\ReflectionMiddlewareFile`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `abstract class`

Extrai o esquema de reflexão de um arquivo de middleware.







## Constants

- `public const PRIMITIVES` —  _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_



## Methods

---

### `public static scheme(file)`



Retorna o esquema de metadados de um arquivo de middleware.

```php
ReflectionMiddlewareFile::scheme($file)
```

- `$file` `string` — Caminho absoluto do arquivo de middleware.

**Returns:** `array`

---

### `protected static mergeDoc(primary, secondary)`

 _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_





- `$primary` `array` —
- `$secondary` `array` —

**Returns:** `array`
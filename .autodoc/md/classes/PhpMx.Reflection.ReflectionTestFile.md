# `PhpMx\Reflection\ReflectionTestFile`

[← Classes](../classes.md) · [← Index](../../autodoc.md)

**Type:** `abstract class`

Extrai o esquema de reflexão de um arquivo de teste.

## Constants

- `public const PRIMITIVES` —  _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_

## Methods

---

### `public static scheme(file)`

Retorna o esquema de um arquivo de teste, extraindo nome e documentação.

```php
ReflectionTestFile::scheme($file)
```

- `$file` `string` — Caminho do arquivo de teste.

**Returns:** `array`

---

### `protected static mergeDoc(primary, secondary)`

 _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_

- `$primary` `array` —
- `$secondary` `array` —

**Returns:** `array`
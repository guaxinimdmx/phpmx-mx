# `PhpMx\Reflection\ReflectionHelperFile`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Extrai o esquema de reflexão de um arquivo de helper.

## Constants

- `public const PRIMITIVES` —  _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_

## Methods

---

### `public static scheme(file)`

Retorna o esquema completo de um arquivo helper (constantes, funções e variáveis de ambiente).

- `$file` `string` — Caminho do arquivo.

**Returns:** `array`

---

### `public static schemeConstants(file)`

Extrai e retorna os esquemas de todas as constantes definidas em um arquivo.

- `$file` `string` — Caminho do arquivo.

**Returns:** `array`

---

### `public static schemeFunctions(file)`

Extrai e retorna os esquemas de todas as funções definidas em um arquivo.

- `$file` `string` — Caminho do arquivo.

**Returns:** `array`

---

### `public static schemeEnvironments(file)`

Extrai e retorna os esquemas de todas as variáveis de ambiente configuradas via Env::default em um arquivo.

- `$file` `string` — Caminho do arquivo.

**Returns:** `array`

---

### `protected static mergeDoc(primary, secondary)`

 _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_

- `$primary` `array` —
- `$secondary` `array` —

**Returns:** `array`
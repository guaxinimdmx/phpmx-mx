# `PhpMx\Reflection\ReflectionRouterFile`

[← Classes](../classes.md) · [← Index](../../autodoc.md)

**Type:** `abstract class`

Extrai o esquema de reflexão de um arquivo de rotas.

## Constants

- `public const PRIMITIVES` —  _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_

## Methods

---

### `public static scheme(file)`

Retorna o esquema de metadados de todas as rotas declaradas em um arquivo de rotas.

```php
ReflectionRouterFile::scheme($file)
```

- `$file` `string` — Caminho absoluto do arquivo de rotas.

**Returns:** `array`

---

### `protected static extractRouteResponse(response)`

Extrai e estrutura as informações de resposta de uma rota (status HTTP, classe e método).

- `$response` `int|string|array` — Valor da resposta registrado na rota.

**Returns:** `array`

---

### `protected static mergeDoc(primary, secondary)`

 _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_

- `$primary` `array` —
- `$secondary` `array` —

**Returns:** `array`
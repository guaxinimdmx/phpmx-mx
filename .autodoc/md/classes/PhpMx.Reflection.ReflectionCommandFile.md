# `PhpMx\Reflection\ReflectionCommandFile`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `abstract class`

Extrai o esquema de reflexão de um arquivo de comando.

## Constants

- `public const PRIMITIVES` —  _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_

## Methods

---

### `public static scheme(file)`

Retorna o esquema de um arquivo de comando de terminal, extraindo nome, parâmetros e documentação.

```php
ReflectionCommandFile::scheme($file)
```

- `$file` `string` — Caminho do arquivo de comando.

**Returns:** `array`

---

### `public static variations(params)`

Retorna as combinações válidas de argumentos para chamar um comando, a partir do seu esquema de parâmetros.

```php
ReflectionCommandFile::variations($params)
```

- `$params` `array` — Esquema de parâmetros do comando (com 'name', 'optional' e 'variadic').

**Returns:** `array`

---

### `protected static mergeDoc(primary, secondary)`

 _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_

- `$primary` `array` —
- `$secondary` `array` —

**Returns:** `array`
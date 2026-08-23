# `PhpMx\Reflection\ReflectionSourceFile`

[← Classes](../classes.md) · [← Index](../../autodoc.md)

**Type:** `class`

Extrai o esquema de reflexão de um arquivo de classe, trait ou interface.

## Constants

- `public const PRIMITIVES` —  _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_

## Methods

---

### `public static scheme(file)`

Retorna o esquema completo de uma classe, trait, interface ou enum de um arquivo PHP.

```php
ReflectionSourceFile::scheme($file)
```

- `$file` `string` — Caminho do arquivo fonte.

**Returns:** `array`

---

### `protected static isHiddenClass(reflection)`

Verifica se uma classe refletida está marcada com @ignore ou @internal em seu docblock.

- `$reflection` `ReflectionClass` — Instância de ReflectionClass da classe alvo.

**Returns:** `bool`

---

### `protected static extractConstantsReflection(reflection)`

Extrai as constantes definidas diretamente na classe refletida.

- `$reflection` `ReflectionClass` — Instância de ReflectionClass da classe alvo.

**Returns:** `array`

---

### `protected static extractPropertiesReflection(reflect, docProperties)`

Extrai as propriedades definidas diretamente na classe refletida, mesclando com dados do docblock.

- `$reflect` `ReflectionClass` — Instância de ReflectionClass da classe alvo.
- `$docProperties` `array` — Propriedades documentadas no docblock da classe.

**Returns:** `array`

---

### `protected static extractMethodsReflection(reflect, docMethods)`

Extrai os métodos definidos diretamente na classe refletida, mesclando com dados do docblock.

- `$reflect` `ReflectionClass` — Instância de ReflectionClass da classe alvo.
- `$docMethods` `array` — Métodos documentados no docblock da classe.

**Returns:** `array`

---

### `protected static mergeDoc(primary, secondary)`

 _(herdado de `PhpMx\Reflection\BaseReflectionFile`)_

- `$primary` `array` —
- `$secondary` `array` —

**Returns:** `array`
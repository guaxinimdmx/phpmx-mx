# `PhpMx\Snap`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `class`

Captura e restaura o estado de propriedades estáticas de classes registradas.









## Properties

- `protected static $groups` `array` —
- `protected static $snaps` `array` —
- `protected static $props` `array` —

## Methods

---

### `public static register(snap, classes)`



Registra uma ou mais classes em um grupo de snap.

```php
Snap::register($snap)
Snap::register($snap, ...$classes)
```

- `$snap` `string` — Nome do snap
- `$classes` `string|string[]` — Classes a registrar

**Returns:** `void`

---

### `public static capture(snap, classes)`



Captura o estado atual das propriedades estáticas de todas as classes registradas no snap. Os objetos ReflectionProperty são criados aqui e reutilizados em restore(). Opcionalmente registra classes antes de capturar.

```php
Snap::capture($snap)
Snap::capture($snap, ...$classes)
```

- `$snap` `string` — Nome do snap a criar
- `$classes` `string|string[]` — Classes a registrar antes de capturar (opcional)

**Returns:** `void`

---

### `public static restore(snap)`



Restaura o estado das classes ao que foi capturado no snap. Usa os objetos ReflectionProperty criados no create() — sem custo de Reflection.

```php
Snap::restore($snap)
```

- `$snap` `string` — Nome do snap a restaurar

**Returns:** `void`
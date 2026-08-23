# `PhpMx\Datalayer\Driver\Field\FInt`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Campo inteiro (INT), com suporte a valor mínimo, máximo e arredondamento configuráveis.

## Properties

- `protected $NAME` `string` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $VALUE` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $SETTINGS` `array` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $DEFAULT` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $NULLABLE` `bool` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_

## Methods

---

### `public set(value)`

Define o valor inteiro do campo, aplicando intervalo min/max e arredondamento configurados. Valores não numéricos são convertidos para null.

```php
$fInt->set($value)
```

- `$value` `mixed` — Valor a definir.

**Returns:** `static`

---

### `public get()`

 _(herdado de `PhpMx\Datalayer\Driver\Field`)_

Retorna o valor do campo para ser usado no sistema.

```php
$fInt->get()
```

**Returns:** `mixed`

---

### `public __internalValue(validate)`

 _(herdado de `PhpMx\Datalayer\Driver\Field`)_

Retorna o valor do campo formatado para persistência no banco de dados.

- `$validate` `bool` — Se verdadeiro valida o valor antes de retornar.

**Returns:** `mixed`

---

### `protected validade(value)`

 _(herdado de `PhpMx\Datalayer\Driver\Field`)_

Valida se o valor pode ser inserido no banco de dados. Lança Exception se o campo não aceitar nulos e o valor for null.

- `$value` `mixed` — Valor a validar.

**Returns:** `void`
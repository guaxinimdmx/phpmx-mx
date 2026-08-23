# `PhpMx\Datalayer\Driver\Field\FBoolean`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `class`

Campo booleano (BOOLEAN), com conversão automática para inteiro ao persistir no banco de dados.

## Properties

- `protected $NAME` `string` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $VALUE` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $SETTINGS` `array` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $DEFAULT` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $NULLABLE` `bool` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_

## Methods

---

### `public set(value)`

Define o valor booleano do campo, convertendo qualquer não-nulo para bool.

```php
$fBoolean->set($value)
```

- `$value` `mixed` — Valor a definir.

**Returns:** `static`

---

### `public get()`

 _(herdado de `PhpMx\Datalayer\Driver\Field`)_

Retorna o valor do campo para ser usado no sistema.

```php
$fBoolean->get()
```

**Returns:** `mixed`

---

### `public __internalValue(validate)`

Retorna o valor como inteiro (0 ou 1) para persistência no banco de dados.

- `$validate` `bool` — Se verdadeiro valida o valor antes de retornar.

**Returns:** `mixed`

---

### `protected validade(value)`

 _(herdado de `PhpMx\Datalayer\Driver\Field`)_

Valida se o valor pode ser inserido no banco de dados. Lança Exception se o campo não aceitar nulos e o valor for null.

- `$value` `mixed` — Valor a validar.

**Returns:** `void`
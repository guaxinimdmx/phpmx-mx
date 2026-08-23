# `PhpMx\Datalayer\Driver\Field\FDatetime`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Campo de data e hora (DATETIME), no formato Y-m-d H:i:s, sem microsegundos.

## Properties

- `protected $NAME` `string` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $VALUE` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $SETTINGS` `array` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $DEFAULT` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $NULLABLE` `bool` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_

## Methods

---

### `public set(value)`

Define o valor de data e hora. Aceita true ou 'CURRENT_TIMESTAMP' (momento atual), timestamp numérico (convertido para Y-m-d H:i:s) ou false (null).

- `$value` `mixed` — Valor a definir.

**Returns:** `static`

---

### `public get(format)`

Retorna o valor de data e hora. Com $format null retorna a string Y-m-d H:i:s, true retorna float timestamp, false retorna int timestamp, ou string formata via date().

- `$format` `null|bool|string` — Formato de retorno.

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
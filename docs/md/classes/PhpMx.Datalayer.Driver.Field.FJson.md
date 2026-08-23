# `PhpMx\Datalayer\Driver\Field\FJson`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Campo JSON, com conversão automática entre array e string JSON para armazenamento e uso no sistema.

## Properties

- `protected $NAME` `string` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $VALUE` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $SETTINGS` `array` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $DEFAULT` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $NULLABLE` `bool` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_

## Methods

---

### `public set(value)`

Define o valor JSON do campo. Strings são decodificadas para array; não-arrays são convertidos para null.

```php
$fJson->set($value)
```

- `$value` `mixed` — Valor a definir (array ou string JSON).

**Returns:** `static`

---

### `public get()`

 _(herdado de `PhpMx\Datalayer\Driver\Field`)_

Retorna o valor do campo para ser usado no sistema.

```php
$fJson->get()
```

**Returns:** `mixed`

---

### `public __internalValue(validate)`

Retorna o valor codificado como string JSON para persistência no banco de dados.

- `$validate` `bool` — Se verdadeiro valida o valor antes de retornar.

**Returns:** `mixed`

---

### `protected validade(value)`

 _(herdado de `PhpMx\Datalayer\Driver\Field`)_

Valida se o valor pode ser inserido no banco de dados. Lança Exception se o campo não aceitar nulos e o valor for null.

- `$value` `mixed` — Valor a validar.

**Returns:** `void`
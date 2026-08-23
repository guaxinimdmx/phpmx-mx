# `PhpMx\Datalayer\Driver\Field\FVarchar`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `class`

Campo de texto com tamanho variável (VARCHAR), com suporte a corte automático e validação de tamanho máximo.









## Properties

- `protected $NAME` `string` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $VALUE` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $SETTINGS` `array` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $DEFAULT` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $NULLABLE` `bool` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_

## Methods

---

### `public set(value)`



Define o valor do campo como string, aplicando corte se configurado e removendo espaços nas extremidades.

```php
$fVarchar->set($value)
```

- `$value` `mixed` — Valor a definir.

**Returns:** `static`

---

### `public get()`

 _(herdado de `PhpMx\Datalayer\Driver\Field`)_

Retorna o valor do campo para ser usado no sistema.

```php
$fVarchar->get()
```



**Returns:** `mixed`

---

### `protected validade(value)`



Valida se o valor não excede o tamanho máximo configurado para o campo.



- `$value` `mixed` — Valor a validar.

**Returns:** `void`

---

### `public __internalValue(validate)`

 _(herdado de `PhpMx\Datalayer\Driver\Field`)_

Retorna o valor do campo formatado para persistência no banco de dados.



- `$validate` `bool` — Se verdadeiro valida o valor antes de retornar.

**Returns:** `mixed`
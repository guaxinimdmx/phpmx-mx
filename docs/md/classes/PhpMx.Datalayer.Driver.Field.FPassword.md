# `PhpMx\Datalayer\Driver\Field\FPassword`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Campo de senha (PASSWORD), com hash automático via bcrypt e verificação de valor.

## Properties

- `protected $NAME` `string` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $VALUE` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $SETTINGS` `array` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $DEFAULT` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $NULLABLE` `bool` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_

## Methods

---

### `public set(value)`

Define a senha do campo gerando hash bcrypt automaticamente se o valor não for já um hash.

```php
$fPassword->set($value)
```

- `$value` `mixed` — Valor a definir (texto simples ou hash bcrypt).

**Returns:** `static`

---

### `public compare(value)`

Verifica se um valor corresponde ao hash de senha armazenado.

```php
$fPassword->compare($value)
```

- `$value` `mixed` — Valor a comparar.

**Returns:** `bool`

---

### `public get()`

 _(herdado de `PhpMx\Datalayer\Driver\Field`)_

Retorna o valor do campo para ser usado no sistema.

```php
$fPassword->get()
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
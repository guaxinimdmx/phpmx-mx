# `PhpMx\Datalayer\Driver\Field\FIdx`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Campo de índice de referência (IDX / foreign key), com acesso direto ao registro referenciado.

## Properties

- `protected $RECORD` `mixed` —
- `protected $NAME` `string` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $VALUE` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $SETTINGS` `array` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $DEFAULT` `mixed` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_
- `protected $NULLABLE` `bool` —  _(herdado de `PhpMx\Datalayer\Driver\Field`)_

## Methods

---

### `public set(value)`

Define o ID do registro referenciado. Aceita: ID numérico, true (usa o registro ativo), false/null (limpa), ou objeto Record.

- `$value` `mixed` — ID numérico, bool, null ou instância de Record.

**Returns:** `static`

---

### `public _record()`

Retorna o objeto de registro referenciado pelo campo.

**Returns:** `PhpMx\Datalayer\Driver\Record`

---

### `public _save()`

Salva o registro referenciado no banco de dados e atualiza o ID armazenado.

**Returns:** `static`

---

### `public id()`

Retorna a chave de identificação numérica do registro referenciado.

**Returns:** `int|null`

---

### `public idKey()`

Retorna a chave de identificação cifrada do registro referenciado.

**Returns:** `?string`

---

### `public _checkLoad()`

Verifica se o objeto referenciado foi carregado em memória.

**Returns:** `bool`

---

### `public _checkSave()`

Verifica se o registro referenciado pode ser salvo no banco de dados.

**Returns:** `bool`

---

### `public _checkInDb(deleted)`

Verifica se o registro referenciado existe no banco de dados (id > 0).

- `$deleted` `?bool` — NULL: ignora estado de deleção (sem SELECT), FALSE: apenas ativos, TRUE: apenas deletados.

**Returns:** `bool`

---

### `public __get(name)`

Acesso mágico a propriedades: retorna id, idKey ou delega ao registro referenciado.

- `$name` `string` — Nome da propriedade.

**Returns:** `mixed`

---

### `public __call(name, arguments)`

Chamada mágica de método: delega ao registro referenciado.

- `$name` `string` — Nome do método.
- `$arguments` `array` — Argumentos da chamada.

**Returns:** `mixed`

---

### `public get()`

 _(herdado de `PhpMx\Datalayer\Driver\Field`)_

Retorna o valor do campo para ser usado no sistema.

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
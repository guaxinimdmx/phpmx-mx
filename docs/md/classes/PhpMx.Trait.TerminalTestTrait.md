# `PhpMx\Trait\TerminalTestTrait`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract trait`

Trait para criação de baterias de testes via terminal

## Properties

- `protected $successes` `int` —
- `protected $fails` `int` —
- `protected $error` `?string` —

## Methods

---

### `protected isEqual(label, fn, expected)`

Verifica se o retorno do callable é idêntico ao valor esperado

- `$label` `string` — Descrição do teste
- `$fn` `callable` — Callable a ser executado
- `$expected` `mixed` — Valor esperado

**Returns:** `void`

---

### `protected isNotEqual(label, fn, expected)`

Verifica se o retorno do callable é diferente do valor informado

- `$label` `string` — Descrição do teste
- `$fn` `callable` — Callable a ser executado
- `$expected` `mixed` — Valor que não deve ser retornado

**Returns:** `void`

---

### `protected isTrue(label, fn)`

Verifica se o retorno do callable é estritamente true

- `$label` `string` — Descrição do teste
- `$fn` `callable` — Callable a ser executado

**Returns:** `void`

---

### `protected isFalse(label, fn)`

Verifica se o retorno do callable é estritamente false

- `$label` `string` — Descrição do teste
- `$fn` `callable` — Callable a ser executado

**Returns:** `void`

---

### `protected isNull(label, fn)`

Verifica se o retorno do callable é null

- `$label` `string` — Descrição do teste
- `$fn` `callable` — Callable a ser executado

**Returns:** `void`

---

### `protected isInstanceOf(label, fn, class)`

Verifica se o retorno do callable é uma instância da classe ou interface informada

- `$label` `string` — Descrição do teste
- `$fn` `callable` — Callable a ser executado
- `$class` `string` — Classe ou interface esperada

**Returns:** `void`

---

### `protected isCount(label, fn, expected)`

Verifica se o retorno do callable (array ou Countable) tem a quantidade esperada de itens

- `$label` `string` — Descrição do teste
- `$fn` `callable` — Callable a ser executado
- `$expected` `int` — Quantidade esperada de itens

**Returns:** `void`

---

### `protected isContains(label, fn, needle)`

Verifica se o retorno do callable (array) contém o valor informado

- `$label` `string` — Descrição do teste
- `$fn` `callable` — Callable a ser executado
- `$needle` `mixed` — Valor que deve estar presente no array

**Returns:** `void`

---

### `protected isThrow(label, fn, expected)`

Verifica se o callable lança uma exception

- `$label` `string` — Descrição do teste
- `$fn` `callable` — Callable a ser executado
- `$expected` `string|int|null` — Classe esperada, código STS_* esperado, ou null para qualquer exception

**Returns:** `void`

---

### `protected isNotThrow(label, fn, expected)`

Verifica se o callable não lança uma exception

- `$label` `string` — Descrição do teste
- `$fn` `callable` — Callable a ser executado
- `$expected` `string|int|null` — Classe que não deve ser lançada, código STS_* que não deve ocorrer, ou null para nenhuma exception

**Returns:** `void`
# `PhpMx\Trace`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe utilitária para registro estruturado de traces e escopos.

## Methods

---

### `public static useTrace(useTrace)`

Habilita ou desabilita o registro de traces.

- `$useTrace` `bool` — True para habilitar, false para desabilitar.

**Returns:** `void`

---

### `public static add(typeScope, message, scope)`

Adiciona uma linha de trace ou abre um escopo de execução via Closure.

- `$typeScope` `string` — Categoria do trace.
- `$message` `string` — Mensagem do trace.
- `$scope` `?Closure` — Closure opcional para criar um escopo de trace.

**Returns:** `mixed`

---

### `public static changeScope(newType, message)`

Altera os dados da linha do escopo que está aberto no momento.

- `$newType` `string` — Novo tipo/categoria.
- `$message` `string` — Nova mensagem.

**Returns:** `void`

---

### `public static exception(e)`

Registra uma exceção detalhada no trace.

- `$e` `Throwable` — A exceção a ser registrada.

**Returns:** `void`

---

### `public static get()`

Retorna o trace processado com contadores de categorias.

**Returns:** `array`

---

### `public static getArray()`

Retorna o trace formatado em um array de strings.

**Returns:** `array`

---

### `public static getString()`

Retorna o trace formatado como uma string completa.

**Returns:** `string`
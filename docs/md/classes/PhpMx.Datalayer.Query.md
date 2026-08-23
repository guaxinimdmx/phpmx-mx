# `PhpMx\Datalayer\Query`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Factory para criação de queries SQL (Select, Insert, Update, Delete).

## Methods

---

### `public static delete(table)`

Retorna uma instância de query do tipo Delete.

- `$table` `array|string|null` — Tabela alvo da query.

**Returns:** `PhpMx\Datalayer\Query\Delete`

---

### `public static insert(table)`

Retorna uma instância de query do tipo Insert.

- `$table` `array|string|null` — Tabela alvo da query.

**Returns:** `PhpMx\Datalayer\Query\Insert`

---

### `public static select(table)`

Retorna uma instância de query do tipo Select.

- `$table` `array|string|null` — Tabela alvo da query.

**Returns:** `PhpMx\Datalayer\Query\Select`

---

### `public static update(table)`

Retorna uma instância de query do tipo Update.

- `$table` `array|string|null` — Tabela alvo da query.

**Returns:** `PhpMx\Datalayer\Query\Update`
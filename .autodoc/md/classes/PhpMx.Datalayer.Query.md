# `PhpMx\Datalayer\Query`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `abstract class`

Factory para criação de queries SQL (Select, Insert, Update, Delete).

## Methods

---

### `public static delete(table)`

Retorna uma instância de query do tipo Delete.

```php
Query::delete()
Query::delete($table)
```

- `$table` `array|string|null` — Tabela alvo da query.

**Returns:** `PhpMx\Datalayer\Query\Delete`

---

### `public static insert(table)`

Retorna uma instância de query do tipo Insert.

```php
Query::insert()
Query::insert($table)
```

- `$table` `array|string|null` — Tabela alvo da query.

**Returns:** `PhpMx\Datalayer\Query\Insert`

---

### `public static select(table)`

Retorna uma instância de query do tipo Select.

```php
Query::select()
Query::select($table)
```

- `$table` `array|string|null` — Tabela alvo da query.

**Returns:** `PhpMx\Datalayer\Query\Select`

---

### `public static update(table)`

Retorna uma instância de query do tipo Update.

```php
Query::update()
Query::update($table)
```

- `$table` `array|string|null` — Tabela alvo da query.

**Returns:** `PhpMx\Datalayer\Query\Update`
# `PhpMx\Datalayer\Query\Delete`

[← Classes](../classes.md) · [← Index](../../autodoc.md)

**Type:** `class`

Monta e executa instruções SQL do tipo DELETE com suporte a cláusulas WHERE e ORDER BY.

**Extends:** `PhpMx\Datalayer\Query\BaseQuery`

## Properties

- `protected $order` `array` —
- `protected $where` `array` —

## Methods

---

### `public query()`

Retorna o array de dados necessários para execução da query DELETE.

```php
$delete->query()
```

**Returns:** `array`

---

### `public run(dbName)`

Executa a query DELETE no banco de dados.

```php
$delete->run()
$delete->run($dbName)
```

- `$dbName` `?string` — Nome do banco de dados (opcional, usa 'main' por padrão).

**Returns:** `bool`

---

### `public order(fields, asc)`

Define a ordenação dos registros a deletar.

```php
$delete->order($fields)
$delete->order($fields, $asc)
```

- `$fields` `array|string` — Campo ou array associativo [campo => asc].
- `$asc` `bool` — Se verdadeiro ordena de forma crescente (padrão).

**Returns:** `static`

---

### `public where(expression, values)`

Adiciona uma cláusula WHERE à query.

```php
$delete->where($expression)
$delete->where($expression, ...$values)
```

- `$expression` `string` — Expressão da condição.
- `$values` `mixed` — Valores a substituir os placeholders '?' da expressão.

**Returns:** `static`

---

### `public whereIn(field, ids)`

Adiciona uma cláusula WHERE verificando se um campo está contido em uma lista de IDs inteiros.

```php
$delete->whereIn($field, $ids)
```

- `$field` `string` — Nome do campo.
- `$ids` `array|string` — Lista de IDs ou string separada por vírgulas.

**Returns:** `static`

---

### `public whereNull(campo, status)`

Adiciona uma cláusula WHERE verificando se um campo é nulo ou não.

```php
$delete->whereNull($campo)
$delete->whereNull($campo, $status)
```

- `$campo` `string` — Nome do campo.
- `$status` `bool` — Se verdadeiro verifica IS NULL, se falso verifica IS NOT NULL.

**Returns:** `static`
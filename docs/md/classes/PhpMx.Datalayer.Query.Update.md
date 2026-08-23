# `PhpMx\Datalayer\Query\Update`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Monta e executa instruções SQL do tipo UPDATE com suporte a cláusulas WHERE, whereIn e whereNull.

**Extends:** `PhpMx\Datalayer\Query\BaseQuery`

## Properties

- `protected $values` `array` —
- `protected $where` `array` —

## Methods

---

### `public query()`

Retorna o array de dados necessários para execução da query UPDATE.

```php
$update->query()
```

**Returns:** `array`

---

### `public run(dbName)`

Executa a query UPDATE no banco de dados.

```php
$update->run()
$update->run($dbName)
```

- `$dbName` `?string` — Nome do banco de dados (opcional, usa 'main' por padrão).

**Returns:** `bool`

---

### `public values(array)`

Define os campos e valores a serem alterados.

```php
$update->values($array)
```

- `$array` `array` — Array associativo [campo => valor] com os dados a atualizar.

**Returns:** `static`

---

### `public where(expression, values)`

Adiciona uma cláusula WHERE à query.

```php
$update->where($expression)
$update->where($expression, ...$values)
```

- `$expression` `string` — Expressão da condição.
- `$values` `mixed` — Valores a substituir os placeholders '?' da expressão.

**Returns:** `static`

---

### `public whereIn(field, ids)`

Adiciona uma cláusula WHERE verificando se um campo está contido em uma lista de IDs inteiros.

```php
$update->whereIn($field, $ids)
```

- `$field` `string` — Nome do campo.
- `$ids` `array|string` — Lista de IDs ou string separada por vírgulas.

**Returns:** `static`

---

### `public whereNull(campo, status)`

Adiciona uma cláusula WHERE verificando se um campo é nulo ou não.

```php
$update->whereNull($campo)
$update->whereNull($campo, $status)
```

- `$campo` `string` — Nome do campo.
- `$status` `bool` — Se verdadeiro verifica IS NULL, se falso verifica IS NOT NULL.

**Returns:** `static`
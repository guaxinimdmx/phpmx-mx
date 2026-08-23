# `PhpMx\Datalayer\Query\Select`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Monta e executa instruções SQL do tipo SELECT com suporte a fields, where, order, group, joins e paginação.

**Extends:** `PhpMx\Datalayer\Query\BaseQuery`

## Properties

- `protected $fields` `array` —
- `protected $limit` `string|int` —
- `protected $order` `array` —
- `protected $group` `string` —
- `protected $where` `array` —
- `protected $joins` `array` —
- `protected $distinct` `bool` —

## Methods

---

### `public query()`

Retorna o array de dados necessários para execução da query SELECT.

**Returns:** `array`

---

### `public run(dbName)`

Executa a query SELECT e retorna os registros encontrados.

- `$dbName` `?string` — Nome do banco de dados (opcional, usa 'main' por padrão).

**Returns:** `array|bool`

---

### `public count()`

Executa um COUNT e retorna o total de registros correspondentes à query.

**Returns:** `int`

---

### `public distinct(distinct)`

Define se o SELECT deve usar DISTINCT para evitar registros duplicados.

- `$distinct` `bool` — Se verdadeiro aplica DISTINCT.

**Returns:** `static`

---

### `public fields(fields)`

Define os campos a serem retornados no SELECT.

- `$fields` `array|string|null` — Campo, array [campo => alias] ou null para retornar todos.

**Returns:** `static`

---

### `public limit(limit)`

Define o limite máximo de registros retornados.

- `$limit` `int` — Número máximo de registros.

**Returns:** `static`

---

### `public page(page, limit)`

Define a paginação da query com limite e offset calculado pela página.

- `$page` `int` — Número da página (mínimo 1).
- `$limit` `int` — Quantidade de registros por página.

**Returns:** `static`

---

### `public group(field)`

Define o agrupamento dos resultados da query.

- `$field` `string` — Campo a ser usado no GROUP BY.

**Returns:** `static`

---

### `public order(fields, asc)`

Define a ordenação dos resultados da query.

- `$fields` `array|string` — Campo ou array associativo [campo => asc].
- `$asc` `bool` — Se verdadeiro ordena de forma crescente (padrão).

**Returns:** `static`

---

### `public orderField(field, orderValues)`

Define a ordenação por uma lista específica de valores de um campo.

- `$field` `string` — Nome do campo a ordenar.
- `$orderValues` `array` — Lista de valores na ordem desejada.

**Returns:** `static`

---

### `public where(expression, values)`

Adiciona uma cláusula WHERE à query.

- `$expression` `string` — Expressão da condição.
- `$values` `mixed` — Valores a substituir os placeholders '?' da expressão.

**Returns:** `static`

---

### `public whereIn(field, ids)`

Adiciona uma cláusula WHERE verificando se um campo está contido em uma lista de IDs inteiros.

- `$field` `string` — Nome do campo.
- `$ids` `array|string` — Lista de IDs ou string separada por vírgulas.

**Returns:** `static`

---

### `public whereNull(campo, status)`

Adiciona uma cláusula WHERE verificando se um campo é nulo ou não.

- `$campo` `string` — Nome do campo.
- `$status` `bool` — Se verdadeiro verifica IS NULL, se falso verifica IS NOT NULL.

**Returns:** `static`

---

### `public join(table, condition, type)`

Adiciona um JOIN à query.

- `$table` `string` — Nome da tabela a unir.
- `$condition` `string` — Condição do JOIN.
- `$type` `string` — Tipo do JOIN (INNER, LEFT, RIGHT).

**Returns:** `static`

---

### `public leftJoin(table, condition)`

Atalho para adicionar um LEFT JOIN à query.

- `$table` `string` — Nome da tabela a unir.
- `$condition` `string` — Condição do JOIN.

**Returns:** `static`

---

### `public rightJoin(table, condition)`

Atalho para adicionar um RIGHT JOIN à query.

- `$table` `string` — Nome da tabela a unir.
- `$condition` `string` — Condição do JOIN.

**Returns:** `static`

---

### `public innerJoin(table, condition)`

Atalho para adicionar um INNER JOIN à query.

- `$table` `string` — Nome da tabela a unir.
- `$condition` `string` — Condição do JOIN.

**Returns:** `static`
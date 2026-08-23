# `PhpMx\Datalayer\Query\BaseQuery`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe base para todos os query builders. Fornece tabela, dbName, execução e montagem de SQL.

## Properties

- `protected $data` `array` —
- `protected $dbName` `?string` —
- `protected $table` `array|string|null` —
- `protected $sqlKeywords` `array` —

## Methods

---

### `public abstract query()`

Retorna o array de dados necessários para execução da query.

**Returns:** `array`

---

### `protected check(dataCheck)`

Verifica se os campos obrigatórios da query foram definidos.

- `$dataCheck` `array` — Lista de propriedades a verificar.

**Returns:** `void`

---

### `public run(dbName)`

Executa a query no banco de dados e retorna o resultado.

- `$dbName` `?string` — Nome do banco de dados (opcional, usa 'main' por padrão).

**Returns:** `mixed`

---

### `public dbName(dbName)`

Define o banco de dados que deve receber a query.

- `$dbName` `?string` — Nome do banco de dados.

**Returns:** `static`

---

### `public table(table)`

Define a tabela alvo da query.

- `$table` `array|string|null` — Nome da tabela (string), array name=>alias, ou null.

**Returns:** `static`

---

### `protected mountTable()`

Monta a cláusula FROM da query aplicando backtick-quoting. Suporta tabela simples, tabela com alias (array), notação schema.tabela e tabela com alias inline.

**Returns:** `string`
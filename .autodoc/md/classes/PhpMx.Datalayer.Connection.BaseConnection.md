# `PhpMx\Datalayer\Connection\BaseConnection`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `abstract class`

Base para drivers de conexão.









## Properties

- `protected $data` `array` —

## Methods

---

### `public getHash()`



Retorna o hash MD5 dos dados de configuração da conexão. Útil para verificar se dois dbNames apontam para a mesma conexão.

```php
$baseConnection->getHash()
```



**Returns:** `string`

---

### `public getConfigGroup(group)`



Retorna todas as configurações de um grupo armazenadas no banco.

```php
$baseConnection->getConfigGroup($group)
```

- `$group` `string` — Nome do grupo de configurações.

**Returns:** `array`

---

### `public setConfigGroup(group, values)`



Armazena ou substitui todas as configurações de um grupo no banco.

```php
$baseConnection->setConfigGroup($group, $values)
```

- `$group` `string` — Nome do grupo de configurações.
- `$values` `array` — Array associativo [nome => valor] a armazenar.

**Returns:** `mixed`

---

### `public executeQuery(query, data)`



Executa uma query SQL ou objeto BaseQuery e retorna o resultado.

```php
$baseConnection->executeQuery($query)
$baseConnection->executeQuery($query, $data)
```

- `$query` `PhpMx\Datalayer\Query\BaseQuery|string` — Query SQL ou objeto de query.
- `$data` `array` — Parâmetros a vincular na query (opcional).

**Returns:** `mixed`

---

### `public executeQueryList(queryList, transaction)`



Executa uma lista de queries, opcionalmente dentro de uma transação.

```php
$baseConnection->executeQueryList()
$baseConnection->executeQueryList($queryList)
$baseConnection->executeQueryList($queryList, $transaction)
```

- `$queryList` `array` — Lista de queries ou arrays [query, params] a executar.
- `$transaction` `bool` — Se verdadeiro envolve a execução em uma transação.

**Returns:** `array`

---

### `public executeSchemeQuery(schemeQueryList)`



Executa uma lista de queries de esquema (create, alter, drop, index).

```php
$baseConnection->executeSchemeQuery($schemeQueryList)
```

- `$schemeQueryList` `array` — Lista de operações de esquema a aplicar.

**Returns:** `void`

---

### `protected abstract load()`



Carrega as configurações da conexão a partir das variáveis de ambiente e inicializa o DSN.





**Returns:** `mixed`

---

### `protected abstract pdo()`



Retorna a instância PDO da conexão, criando-a na primeira chamada.





**Returns:** `PDO`

---

### `protected abstract schemeQueryCreateTable(name, comment, fields)`



Retorna as queries SQL necessárias para criar uma tabela com os campos informados.



- `$name` `string` — Nome da tabela.
- `$comment` `?string` — Comentário da tabela.
- `$fields` `array` — Campos a incluir na criação.

**Returns:** `array`

---

### `protected abstract schemeQueryAlterTable(name, comment, fields)`



Retorna as queries SQL necessárias para alterar uma tabela existente.



- `$name` `string` — Nome da tabela.
- `$comment` `?string` — Comentário da tabela.
- `$fields` `array` — Campos a adicionar, alterar ou remover.

**Returns:** `array`

---

### `protected abstract schemeQueryDropTable(name)`



Retorna as queries SQL necessárias para remover uma tabela.



- `$name` `string` — Nome da tabela.

**Returns:** `array`

---

### `protected abstract schemeQueryUpdateTableIndex(name, index)`



Retorna as queries SQL necessárias para criar ou remover índices de uma tabela.



- `$name` `string` — Nome da tabela.
- `$index` `array` — Mapa de índices [indexName => [campo, unique] | false].

**Returns:** `array`

---

### `protected abstract initConfig()`



Garante que a tabela __config exista no banco de dados, criando-a se necessário.





**Returns:** `void`
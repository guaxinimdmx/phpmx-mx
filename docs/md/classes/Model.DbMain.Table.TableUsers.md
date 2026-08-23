# `Model\DbMain\Table\TableUsers`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Usuários cadastrados no sistema

## Properties

- `protected $DATALAYER` `string` —  _(herdado de `Model\DbMain\Driver\DriverTableUsers`)_
- `protected $TABLE` `string` —  _(herdado de `Model\DbMain\Driver\DriverTableUsers`)_
- `protected $CLASS_RECORD` `string` —  _(herdado de `Model\DbMain\Driver\DriverTableUsers`)_
- `protected $CACHE` `array` —  _(herdado de `PhpMx\Datalayer\Driver\Table`)_
- `protected $CACHE_STATUS` `?bool` —  _(herdado de `PhpMx\Datalayer\Driver\Table`)_
- `protected $ACTIVE` `PhpMx\Datalayer\Driver\Record|string` —  _(herdado de `PhpMx\Datalayer\Driver\Table`)_
- `protected $SHOW_DELETED` `?bool` —  _(herdado de `PhpMx\Datalayer\Driver\Table`)_

## Methods

---

### `public final showDeleted(showDeleted)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Define se na próxima consulta os dados maracados como removidos deve ser exibidos.

- `$showDeleted` `?bool` — TRUE: Apenas removidos, FLASE: Apenas não removidos, NULL: Mostrar ambos

**Returns:** `self`

---

### `public final getAll_scheme(scheme, args)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna os esquemas dos registros encontrados pela consulta.

- `$scheme` `array` — Campos do esquema a retornar.
- `$args` `mixed` — Parâmetros de consulta.

**Returns:** `array`

---

### `public final getOne_scheme(scheme, args)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna o esquema de um único registro encontrado pela consulta.

- `$scheme` `array` — Campos do esquema a retornar.
- `$args` `mixed` — Parâmetros de consulta.

**Returns:** `array`

---

### `public final getOneKey_scheme(scheme, idKey, errMessage, errCode)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna o esquema de um registro buscado por idKey.

- `$scheme` `array` — Campos do esquema a retornar.
- `$idKey` `?string` — IdKey do registro.
- `$errMessage` `string|int|null` — Mensagem de erro, código HTTP (usa mensagem padrão do env STM_*), ou null para não lançar erro.
- `$errCode` `int` — Código HTTP do erro (padrão 404).

**Returns:** `mixed`

---

### `public final getAll_schemeAll(fieldsRemove, args)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna os esquemas completos dos registros encontrados pela consulta.

- `$fieldsRemove` `array` — Campos a remover do esquema completo.
- `$args` `mixed` — Parâmetros de consulta.

**Returns:** `array`

---

### `public final getOne_schemeAll(fieldsRemove, args)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna o esquema completo de um único registro encontrado pela consulta.

- `$fieldsRemove` `array` — Campos a remover do esquema completo.
- `$args` `mixed` — Parâmetros de consulta.

**Returns:** `array`

---

### `public final getOneKey_schemeAll(fieldsRemove, idKey, errMessage, errCode)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna o esquema completo de um registro buscado por idKey.

- `$fieldsRemove` `array` — Campos a remover do esquema completo.
- `$idKey` `?string` — IdKey do registro.
- `$errMessage` `?string` — Mensagem de erro caso o registro não seja encontrado.
- `$errCode` `int` — Código HTTP do erro (padrão 404).

**Returns:** `array`

---

### `public final active(record)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna ou define o registro marcado como ativo na tabela.

- `$record` `?PhpMx\Datalayer\Driver\Record` — Sem argumentos retorna o ativo atual. Com argumentos define o novo registro ativo.

**Returns:** `mixed`

---

### `public final count(args)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna o número de registros encontrados pela consulta.

- `$args` `mixed` — Parâmetros de consulta.

**Returns:** `int`

---

### `public final check(args)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Verifica se existe ao menos um registro que corresponde à consulta.

- `$args` `mixed` — Parâmetros de consulta.

**Returns:** `bool`

---

### `public final getAll(args)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna um array de objetos de registro encontrados pela consulta.

- `$args` `mixed` — Parâmetros de consulta.

**Returns:** `array`

---

### `public final getOne(args)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna um único objeto de registro encontrado pela consulta. Aceita: sem args (novo), null/false (nulo), true (ativo), idKey, id numérico, where string ou array.

- `$args` `mixed` — Parâmetros de consulta.

**Returns:** `mixed`

---

### `public final getOneKey(idKey, errMessage, errCode)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna um registro buscado por idKey, lançando Exception se não encontrado e errMessage for informado.

- `$idKey` `?string` — IdKey do registro.
- `$errMessage` `string|int|null` — Mensagem de erro, código HTTP (usa mensagem padrão do env STM_*), ou null para não lançar erro.
- `$errCode` `int` — Código HTTP do erro (padrão 404).

**Returns:** `mixed`

---

### `public final getNew()`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna um objeto de registro novo (id = 0).

**Returns:** `mixed`

---

### `public final getNull()`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna um objeto de registro nulo (id = null).

**Returns:** `mixed`

---

### `public final idToIdkey(id)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Converte um ID numérico em idKey cifrado.

- `$id` `?int` — ID do registro.

**Returns:** `string`

---

### `public final idKeyToId(idKey)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Converte um idKey cifrado em ID numérico.

- `$idKey` `?string` — IdKey do registro.

**Returns:** `?int`

---

### `public final _convert(arrayRecord)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Converte um array de resultados de consulta em um array de objetos de registro.

- `$arrayRecord` `array` — Array de arrays de dados.

**Returns:** `array`

---

### `public __cacheSet(id, record)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Armazena um objeto de registro no cache da tabela.

- `$id` `int` — ID do registro.
- `$record` `PhpMx\Datalayer\Driver\Record` — Objeto de registro a armazenar.

**Returns:** `void`

---

### `public __cacheRemove(id)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Remove um objeto de registro do cache da tabela.

- `$id` `int` — ID do registro a remover.

**Returns:** `void`

---

### `public _cacheStatus(status)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Ativa ou desativa o uso do cache na tabela.

- `$status` `?bool` — Se verdadeiro ativa o cache.

**Returns:** `void`

---

### `public __cacheCheck()`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Verifica se o cache está ativo.

**Returns:** `bool`

---

### `protected autoQuery(args)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Constrói uma query Select a partir dos argumentos fornecidos usando typeQuery() para determinar o modo.

- `$args` `mixed` — Parâmetros de consulta.

**Returns:** `PhpMx\Datalayer\Query\Select`

---

### `protected typeQuery(args)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Determina o tipo de consulta com base nos argumentos: 1=all, 2=by id, 3=by where string, 4=by array, 5=by Select.

- `$args` `mixed` — Parâmetros de consulta.

**Returns:** `int`

---

### `protected arrayToRecord(array)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Converte um array de dados em um objeto Record, usando cache quando disponível.

- `$array` `array` — Dados do registro (deve conter 'id').

**Returns:** `PhpMx\Datalayer\Driver\Record`

---

### `protected inCache(id)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Verifica se um registro com o ID informado está presente no cache da tabela.

- `$id` `int` — ID do registro.

**Returns:** `bool`

---

### `protected recordCache(array)`

 _(herdado de `PhpMx\Datalayer\Driver\Table`)_

Retorna o Record do cache se existir, ou cria e armazena um novo a partir do array.

- `$array` `array` — Dados do registro.

**Returns:** `PhpMx\Datalayer\Driver\Record`
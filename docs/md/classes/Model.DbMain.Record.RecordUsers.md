# `Model\DbMain\Record\RecordUsers`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Usuários cadastrados no sistema

## Properties

- `protected $DATALAYER` `string` —  _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_
- `protected $TABLE` `string` —  _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_
- `public $name` `\PhpMx\Datalayer\Driver\Field\FVarchar` — Nome completo do usuário _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_
- `public $email` `\PhpMx\Datalayer\Driver\Field\FEmail` — E-mail de login, único por usuário _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_
- `public $password` `\PhpMx\Datalayer\Driver\Field\FPassword` — Hash da senha do usuário _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_
- `public $active` `\PhpMx\Datalayer\Driver\Field\FBoolean` — Se o usuário pode fazer login _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_
- `public $userGroup` `\Model\DbMain\Record\RecordUserGroup` — Grupo ao qual o usuário pertence _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_
- `protected $FIELD` `array` —  _(herdado de `PhpMx\Datalayer\Driver\Record`)_
- `protected $ID` `?int` —  _(herdado de `PhpMx\Datalayer\Driver\Record`)_
- `protected $INITIAL` `array` —  _(herdado de `PhpMx\Datalayer\Driver\Record`)_
- `protected $DELETE` `bool` —  _(herdado de `PhpMx\Datalayer\Driver\Record`)_
- `protected $UNDELETE` `bool` —  _(herdado de `PhpMx\Datalayer\Driver\Record`)_
- `protected $HARD_DELETE` `bool` —  _(herdado de `PhpMx\Datalayer\Driver\Record`)_
- `protected $HASH` `string` —  _(herdado de `PhpMx\Datalayer\Driver\Record`)_
- `public $id` `int|null` — Chave de identificação numérica do registro. _(herdado de `PhpMx\Datalayer\Driver\Record`)_

## Methods

---

### `public name()`

 _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_

Nome completo do usuário

```php
$recordUsers->name()
```

**Returns:** `$this|string`

---

### `public email()`

 _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_

E-mail de login, único por usuário

```php
$recordUsers->email()
```

**Returns:** `$this|string`

---

### `public password()`

 _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_

Hash da senha do usuário

```php
$recordUsers->password()
```

**Returns:** `$this|string`

---

### `public active()`

 _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_

Se o usuário pode fazer login

```php
$recordUsers->active()
```

**Returns:** `$this|bool`

---

### `public userGroup()`

 _(herdado de `Model\DbMain\Driver\DriverRecordUsers`)_

Grupo ao qual o usuário pertence

```php
$recordUsers->userGroup()
```

**Returns:** `$this|int`

---

### `public final id()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Retorna a chave de identificação numérica do registro.

```php
$recordUsers->id()
```

**Returns:** `?int`

---

### `public final idKey()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Retorna a chave de identificação cifrada (idKey) do registro.

```php
$recordUsers->idKey()
```

**Returns:** `?string`

---

### `public final _created()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Retorna o momento em que o registro foi criado.

```php
$recordUsers->_created()
```

**Returns:** `?string`

---

### `public final _updated()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Retorna o momento da última atualização do registro.

```php
$recordUsers->_updated()
```

**Returns:** `?string`

---

### `public final _changed()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Retorna o momento da última mudança do registro (criação ou atualização).

```php
$recordUsers->_changed()
```

**Returns:** `?string`

---

### `public final _deleted()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Retorna o momento em que o registro foi marcado como removido.

```php
$recordUsers->_deleted()
```

**Returns:** `?string`

---

### `public final _schemeValue(field)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Retorna o valor do esquema de um campo do registro.

```php
$recordUsers->_schemeValue($field)
```

- `$field` `string` — Nome do campo.

**Returns:** `mixed`

---

### `public final _scheme(fields)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Retorna os campos solicitados do registro tratados em forma de array de esquema.

```php
$recordUsers->_scheme($fields)
```

- `$fields` `array` — Campos a retornar, podendo ser strings, arrays associativos [alias => callable] ou callables.

**Returns:** `array`

---

### `public final _schemeAll(fieldsRemove)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Retorna todos os campos e esquemas personalizados do registro em forma de array.

```php
$recordUsers->_schemeAll()
$recordUsers->_schemeAll($fieldsRemove)
```

- `$fieldsRemove` `array` — Campos a excluir do retorno.

**Returns:** `array`

---

### `public final _makeActive()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Marca o registro como ativo na tabela correspondente.

```php
$recordUsers->_makeActive()
```

**Returns:** `static`

---

### `public final _array(fields)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Retorna os campos do registro em forma de array.

```php
$recordUsers->_array()
$recordUsers->_array(...$fields)
```

- `$fields` `string` — Campos a retornar (opcional, retorna todos por padrão).

**Returns:** `mixed`

---

### `public final _arraySet(scheme)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Define os valores dos campos do registro com base em um array.

```php
$recordUsers->_arraySet($scheme)
```

- `$scheme` `mixed` — Array associativo [campo => valor].

**Returns:** `static`

---

### `public final _arrayChange(changes)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Aplica um array de mudanças incrementais aos campos do registro.

```php
$recordUsers->_arrayChange($changes)
```

- `$changes` `array` — Array de mudanças a aplicar.

**Returns:** `static`

---

### `public final _checkInDb(deleted)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Verifica se o registro existe no banco de dados (id > 0).

```php
$recordUsers->_checkInDb()
$recordUsers->_checkInDb($deleted)
```

- `$deleted` `?bool` — NULL: ignora estado de deleção, FALSE: apenas ativos, TRUE: apenas deletados.

**Returns:** `bool`

---

### `public final _checkChange(fields)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Verifica se algum dos campos fornecidos foi alterado desde o último carregamento.

```php
$recordUsers->_checkChange()
$recordUsers->_checkChange(...$fields)
```

- `$fields` `string` — Campos a verificar (opcional, verifica todos por padrão).

**Returns:** `bool`

---

### `public final _checkSave()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Verifica se o registro pode ser salvo no banco de dados (id não nulo).

```php
$recordUsers->_checkSave()
```

**Returns:** `bool`

---

### `public final _delete(delete)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Prepara o registro para ser marcado como excluído no próximo _save().

```php
$recordUsers->_delete($delete)
```

- `$delete` `bool` — Se verdadeiro marca para exclusão.

**Returns:** `static`

---

### `public final _undelete(undelete)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Prepara o registro para ser desmarcado como excluído no próximo _save().

```php
$recordUsers->_undelete($undelete)
```

- `$undelete` `bool` — Se verdadeiro marca para recuperação.

**Returns:** `static`

---

### `public final _hardDelete(hardDelete)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Prepara o registro para ser removido permanentemente do banco no próximo _save().

```php
$recordUsers->_hardDelete($hardDelete)
```

- `$hardDelete` `bool` — Se verdadeiro marca para remoção permanente.

**Returns:** `static`

---

### `public final _save(forceUpdate)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Salva o registro no banco de dados, disparando create, update, delete ou undelete conforme o estado atual (definido por _delete(), _undelete() e _hardDelete()). Não faz nada se o registro for nulo.

```php
$recordUsers->_save()
$recordUsers->_save($forceUpdate)
```

- `$forceUpdate` `bool` — Se verdadeiro força o UPDATE mesmo sem alterações detectadas.

**Returns:** `static`

---

### `protected _onCreate()`

**Returns:** `mixed`

---

### `protected _onUpdate()`

**Returns:** `mixed`

---

### `protected _onDelete()`

**Returns:** `mixed`

---

### `protected final _scheme__changed()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Retorna o esquema de _changed

**Returns:** `mixed`

---

### `protected final __runSaveIdx()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Salva todos os campos FIdx com registros carregados antes de persistir o registro principal.

**Returns:** `mixed`

---

### `protected final __runCreate()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Executa a criação do registro no banco de dados e atualiza o ID e cache. Dispara o hook _onCreate(); retorna false ou callable para abortar/pós-processamento.

**Returns:** `mixed`

---

### `protected final __runUpdate(forceUpdate)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Executa a atualização do registro no banco de dados, enviando apenas os campos alterados. Dispara o hook _onUpdate(); retorna false ou callable para abortar/pós-processamento.

- `$forceUpdate` `bool` — Se verdadeiro força o UPDATE mesmo sem alterações detectadas.

**Returns:** `mixed`

---

### `protected final __runDelete()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Executa a exclusão lógica do registro (soft-delete) preenchendo o campo _deleted. Dispara o hook _onDelete(); retorna false ou callable para abortar/pós-processamento.

**Returns:** `mixed`

---

### `protected final __runHardDelete()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Executa a remoção permanente do registro no banco de dados (hard-delete). Dispara o hook _onHardDelete(); retorna false ou callable para abortar/pós-processamento.

**Returns:** `mixed`

---

### `protected final __runUndelete()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Restaura um registro excluído logicamente limpando o campo _deleted. Dispara o hook _onUndelete(); retorna false ou callable para abortar/pós-processamento.

**Returns:** `mixed`

---

### `public final __get(name)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Acesso mágico a propriedades: retorna o ID, idKey ou o objeto Field pelo nome.

- `$name` `string` — Nome da propriedade ('id', 'idKey' ou nome de campo).

**Returns:** `mixed`

---

### `public final __call(name, arguments)`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Chamada mágica de método: sem argumentos retorna o valor do campo; com argumentos define o valor.

- `$name` `string` — Nome do campo.
- `$arguments` `array` — Argumentos passados na chamada.

**Returns:** `mixed|static`

---

### `protected _onUndelete()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Hook chamado antes de restaurar um registro excluído logicamente. Retorne false para abortar a restauração, ou um callable para executar após a restauração.

**Returns:** `mixed`

---

### `protected _onHardDelete()`

 _(herdado de `PhpMx\Datalayer\Driver\Record`)_

Hook chamado antes de remover permanentemente o registro do banco de dados. Retorne false para abortar a remoção, ou um callable para executar após a remoção.

**Returns:** `mixed`
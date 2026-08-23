# `PhpMx\Datalayer\Query\Insert`

[← Classes](../classes.md) · [← Index](../../autodoc.md)

**Type:** `class`

Monta e executa instruções SQL do tipo INSERT com suporte a múltiplos registros e parâmetros nomeados.

**Extends:** `PhpMx\Datalayer\Query\BaseQuery`

## Properties

- `protected $columns` `array` —
- `protected $values` `array` —

## Methods

---

### `public query()`

Retorna o array de dados necessários para execução da query INSERT.

```php
$insert->query()
```

**Returns:** `array`

---

### `public run(dbName)`

Executa a query INSERT e retorna o ID inserido ou false em caso de falha.

```php
$insert->run()
$insert->run($dbName)
```

- `$dbName` `?string` — Nome do banco de dados (opcional, usa 'main' por padrão).

**Returns:** `int|bool`

---

### `public values(registers)`

Define os registros a serem inseridos.

```php
$insert->values()
$insert->values(...$registers)
```

- `$registers` `array` — Um ou mais arrays associativos [campo => valor] a inserir.

**Returns:** `static`
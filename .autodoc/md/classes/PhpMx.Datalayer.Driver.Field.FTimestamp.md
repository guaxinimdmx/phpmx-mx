# `PhpMx\Datalayer\Driver\Field\FTimestamp`

[← Classes](../classes.md) · [← Index](../../autodoc.md)

**Type:** `class`

Campo de timestamp (TIMESTAMP), com microsegundos no formato Y-m-d H:i:s.u. Retorna float (microtime) por padrão.

**Extends:** `PhpMx\Datalayer\Driver\Field\FDatetime`

## Methods

---

### `public set(value)`

Define o valor de timestamp com microsegundos. Aceita true ou 'CURRENT_TIMESTAMP' (microtime atual), int (sem micros) ou float (com micros), ou false (null).

```php
$fTimestamp->set($value)
```

- `$value` `mixed` — Valor a definir.

**Returns:** `static`

---

### `public get(format)`

Retorna o valor de timestamp. Com $format true (padrão) retorna float com microsegundos, false retorna int, null retorna a string Y-m-d H:i:s.u, ou string formata via DateTime::format().

```php
$fTimestamp->get()
$fTimestamp->get($format)
```

- `$format` `null|bool|string` — Formato de retorno.

**Returns:** `mixed`
# `PhpMx\Datalayer\Driver\Field\FTime`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `class`

Campo de tempo (TIME), com conversão automática de timestamp inteiro para string no formato H:i:s.

**Extends:** `PhpMx\Datalayer\Driver\Field\FDate`









## Methods

---

### `public set(value)`



Define o valor de tempo. Aceita timestamp inteiro (convertido para H:i:s) ou false (null).

```php
$fTime->set($value)
```

- `$value` `mixed` — Valor a definir.

**Returns:** `static`

---

### `public get(format)`



Retorna o valor de tempo. Com $format null retorna a string H:i:s, true retorna float timestamp, false retorna int timestamp, ou string formata via date().

```php
$fTime->get()
$fTime->get($format)
```

- `$format` `null|bool|string` — Formato de retorno.

**Returns:** `mixed`
# `PhpMx\Mx5`

[← Classes](../classes.md) · [← Index](../../autodoc.md)

**Type:** `abstract class`

Classe utilitária para codificação e verificação com hash MX5.

## Properties

- `protected static $KEY` `?array` —
- `protected static $HEX_CHARS` `array` —
- `protected static $MX_CHARS` `array` —

## Methods

---

### `public static on(var)`

Converte uma variável ou um MD5 comum para o formato MX5. Se a variável não for uma string/MD5, ela será serializada antes da conversão.

```php
Mx5::on($var)
```

- `$var` `mixed` — Variável, string ou hash MD5 para codificar.

**Returns:** `string`

---

### `public static off(var)`

Decodifica um hash MX5 de volta para o seu valor MD5 original. Se o valor passado não for um MX5, ele será convertido em um antes da decodificação.

```php
Mx5::off($var)
```

- `$var` `mixed` — Hash MX5 para decodificar.

**Returns:** `string`

---

### `public static check(var)`

Verifica se uma variável string segue o padrão e o alfabeto de um hash MX5.

```php
Mx5::check($var)
```

- `$var` `mixed` — Variável para verificação.

**Returns:** `bool`

---

### `public static compare(initial, compare)`

Compara se múltiplas variáveis resultam no mesmo hash MX5. Útil para validar senhas ou tokens sem expor o MD5 real no comparativo.

```php
Mx5::compare($initial)
Mx5::compare($initial, ...$compare)
```

- `$initial` `mixed` — Valor base para comparação.
- `$compare` `mixed` — Outros valores para comparar com o inicial.

**Returns:** `bool`
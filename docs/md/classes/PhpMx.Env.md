# `PhpMx\Env`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe utilitária para gerenciamento de variáveis de ambiente.

## Properties

- `protected static $DEFAULT` `array` —

## Methods

---

### `public static loadFile(filePath)`

Carrega variáveis de ambiente a partir de um arquivo de texto para o sistema.

- `$filePath` `string` — Caminho do arquivo (ex: .env).

**Returns:** `bool`

---

### `public static set(name, value)`

Define o valor de uma variável de ambiente no escopo global $_ENV.

- `$name` `string` — Nome da variável.
- `$value` `mixed` — Valor a ser atribuído.

**Returns:** `void`

---

### `public static get(name)`

Recupera o valor de uma variável de ambiente ou o seu valor padrão.

- `$name` `string` — Nome da variável.

**Returns:** `mixed`

---

### `public static default(name, value)`

Define um valor padrão para uma variável de ambiente caso ela não tenha sido declarada.

- `$name` `string` — Nome da variável.
- `$value` `mixed` — Valor padrão.

**Returns:** `void`
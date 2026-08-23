# `PhpMx\Cif`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe utilitária para cifrar e decifrar variáveis de forma segura.

## Constants

- `public const BASE` —

## Properties

- `protected static $ENSURE` `array` —
- `protected static $CURRENT_ID_KEY` `?int` —
- `protected static $CIF` `?array` —

## Methods

---

### `public static on(var, charKey)`

Converte uma variável em uma string cifrada.

- `$var` `mixed` — Variável de qualquer tipo para cifrar.
- `$charKey` `?string` — Chave de caractere específica para forçar um índice de cifra.

**Returns:** `string`

---

### `public static off(var)`

Decifra uma string e retorna o valor original da variável.

- `$var` `mixed` — String cifrada para processamento.

**Returns:** `mixed`

---

### `public static check(var)`

Verifica se uma variável atende aos requisitos estruturais para ser uma cifra MX.

- `$var` `mixed` — Variável para verificação.

**Returns:** `bool`

---

### `public static compare(initial, compare)`

Compara múltiplas variáveis para verificar se resultam na mesma cifra.

- `$initial` `mixed` — Valor base para comparação.
- `$compare` `mixed` — Outros valores para comparar.

**Returns:** `bool`

---

### `protected static replace(string, in, out)`

Substitui caracteres posicionalmente conforme os alfabetos de entrada e saída.

- `$string` `string` — String a ser transformada.
- `$in` `string` — Alfabeto de origem.
- `$out` `string` — Alfabeto de destino.

**Returns:** `string`

---

### `protected static getUseIdKey(charKey)`

Retorna o índice de chave a usar na cifra, aleatório ou fixado pelo $charKey.

- `$charKey` `?string` — Caractere que força um índice fixo, ou null para usar o atual/aleatório.

**Returns:** `int`

---

### `protected static getEncapsChar(idKey, reverse)`

Retorna o caractere de encapsulamento para o índice de chave informado.

- `$idKey` `int` — Índice da chave.
- `$reverse` `bool` — Se true, inverte o índice (61 - $idKey) para gerar o par de fechamento.

**Returns:** `string`

---

### `protected static checkEncapsChar(string)`

Verifica se o primeiro e o último caractere de uma string formam um par de encapsulamento válido.

- `$string` `string` — String cujo encapsulamento deve ser verificado.

**Returns:** `bool`

---

### `protected static __load()`

Inicializa o estado interno carregando o certificado CIF caso ainda não esteja carregado.

**Returns:** `void`
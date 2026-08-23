# `PhpMx\Prepare`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe utilitária para substituição de templates em textos.

## Methods

---

### `public static prepare(string, prepare)`

Prepara um texto substituindo ocorrências do template pelos dados fornecidos. Aceita: - Sequencial: `[#]` - Referência: `[#key]` ou `[#user.name]` (Dot Notation) - Funções: `[#key:param1,param2]` (Executa closures no array de dados)

```php
Prepare::prepare($string)
Prepare::prepare($string, $prepare)
```

- `$string` `?string` — Texto base contendo as tags.
- `$prepare` `array|string` — Dados para substituição.

**Returns:** `string`

---

### `public static tags(string)`

Retorna as tags prepare existentes em uma string (sem os colchetes).

```php
Prepare::tags($string)
```

- `$string` `string` — O texto a ser analisado.

**Returns:** `array`

---

### `public static keys(prepare)`

Retorna as chaves disponíveis em um array de prepare processado.

```php
Prepare::keys($prepare)
```

- `$prepare` `array|string` — Os dados de prepare a serem analisados.

**Returns:** `array`

---

### `public static scape(string, prepare)`

Escapa as tags prepare para evitar que sejam processadas.

```php
Prepare::scape($string)
Prepare::scape($string, $prepare)
```

- `$string` `string` — Texto original.
- `$prepare` `?array` — Se informado, escapa apenas chaves específicas.

**Returns:** `string`

---

### `protected static resolve(string, tags, prepare)`

Executa as substituições de todas as tags encontradas no texto.

- `$string` `string` — Texto com as tags a serem substituídas.
- `$tags` `array` — Lista de tags encontradas no texto.
- `$prepare` `array` — Dados de substituição já normalizados.

**Returns:** `string`

---

### `protected static getTagValue(tag, ppN, ppR, runClosure)`

Resolve o valor correspondente a uma tag individual (sequencial, por referência ou função closure).

- `$tag` `string` — Nome da tag sem os colchetes.
- `$ppN` `array` — Referência ao array de valores sequenciais (consumidos por posição).
- `$ppR` `array` — Array de valores por referência (chave nomeada).
- `$runClosure` `bool` — Se deve executar closures automaticamente ao resolver.

**Returns:** `mixed`

---

### `protected static separePrepare(prepare)`

Separa um array de dados em dois grupos: sequenciais (chaves numéricas) e por referência (chaves string).

- `$prepare` `array` — Array de dados a separar.

**Returns:** `array`

---

### `protected static combinePrepare(prepare)`

Normaliza e expande o array de dados, convertendo subarrays em entradas com chaves dot notation.

- `$prepare` `array|string` — Dados de entrada a normalizar.

**Returns:** `array`

---

### `protected static getPrepareTags(string)`

Extrai todas as tags [#...] presentes em uma string usando regex.

- `$string` `string` — Texto a ser analisado.

**Returns:** `array`
# `PhpMx\Input\InputField`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Classe para definição, validação e sanitização de campos de input. Gerencia obrigatoriedade, prevenção de tags HTML, regras de validação e formatação do valor recebido.

## Methods

---

### `public __construct(name, alias, value)`

- `$name` `string` — Nome do campo.
- `$alias` `?string` — Rótulo amigável para mensagens de erro.
- `$value` `mixed` — Valor inicial do campo.

**Returns:** `mixed`

---

### `public send(message, status, prepare)`

Lança uma Exception em nome do campo com mensagem e status HTTP definidos.

- `$message` `string` — Mensagem de erro (suporta chaves de InputMessage e tags de prepare).
- `$status` `int|bool` — Status HTTP (false usa STS_BAD_REQUEST, true usa STS_OK).
- `$prepare` `array` — Variáveis adicionais para interpolação na mensagem.

**Returns:** `void`

---

### `public required(required, errorMessage, errorStatus)`

Define se o campo é obrigatório.

- `$required` `bool` — Se o campo é obrigatório.
- `$errorMessage` `?string` — Mensagem de erro personalizada.
- `$errorStatus` `?int` — Status HTTP do erro.

**Returns:** `static`

---

### `public get()`

Aplica as regras de validação e sanitização e retorna o valor do campo.

**Returns:** `mixed`

---

### `public validate(rule, errorMessage, errorStatus)`

Adiciona uma regra de validação ao campo.

- `$rule` `Closure|PhpMx\Input\InputField|int` — Constante FILTER_VALIDATE_*, Closure ou outro InputField para comparação de igualdade.
- `$errorMessage` `?string` — Mensagem de erro personalizada.
- `$errorStatus` `?int` — Status HTTP do erro.

**Returns:** `static`

---

### `public sanitize(rule)`

Adiciona uma regra de sanitização ao campo.

- `$rule` `Closure|int` — Constante FILTER_SANITIZE_* ou Closure de transformação.

**Returns:** `static`

---

### `public recived()`

Verifica se o campo foi recebido na requisição, lançando Exception se obrigatório e ausente.

**Returns:** `bool`

---

### `public preventTag(preventTag, errorMessage, errorStatus)`

Define se o valor do campo deve ser protegido contra tags HTML.

- `$preventTag` `bool` — Se a proteção está ativa.
- `$errorMessage` `?string` — Mensagem de erro personalizada.
- `$errorStatus` `?int` — Status HTTP do erro.

**Returns:** `static`

---

### `public scapePrepare(scapePrepare)`

Define quais tags de prepare o campo deve escapar.

- `$scapePrepare` `array|bool` — True para escapar todas, false para nenhuma, array para tags específicas.

**Returns:** `static`
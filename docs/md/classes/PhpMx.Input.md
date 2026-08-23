# `PhpMx\Input`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `class`

Classe para gerenciamento de campos e validação de inputs da requisição.

## Properties

- `protected $dataField` `array` —

## Methods

---

### `public __construct(dataValue)`

- `$dataValue` `?array` — Dados de entrada (opcional, usa Request::data() por padrão).

**Returns:** `mixed`

---

### `public field(name, alias, default)`

Retorna o objeto de um campo de input genérico.

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputField`

---

### `public fieldBool(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber um valor booleano.

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldBool`

---

### `public fieldList(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber um valor de lista.

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldList`

---

### `public fieldUpload(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber um arquivo de upload.

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldUpload`

---

### `public fieldUploadImage(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber uma imagem em base64.

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldUploadImage`

---

### `public fieldCaptcha(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber um código Captcha.

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldCaptcha`

---

### `public fieldScheme(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber um array scheme.

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldScheme`

---

### `public get(fieldName)`

Retorna o valor verificado e sanitizado de um campo do input.

- `$fieldName` `string` — Nome do campo.

**Returns:** `mixed`

---

### `public check()`

Verifica se todos os campos do input passam na validação, lançando Exception em caso de falha.

**Returns:** `bool`

---

### `public data(nameFields)`

Retorna os valores validados dos campos do input em forma de array.

- `$nameFields` `?array` — Lista de campos a retornar (opcional, retorna todos por padrão).

**Returns:** `array`

---

### `public dataReceived(nameFields)`

Retorna apenas os valores dos campos efetivamente recebidos na requisição.

- `$nameFields` `?array` — Lista de campos a considerar (opcional, considera todos por padrão).

**Returns:** `array`

---

### `public send(message, status)`

Lança uma Exception em nome do input com mensagem e status HTTP definidos.

- `$message` `string` — Mensagem de erro.
- `$status` `int|bool` — Status HTTP (false usa STS_BAD_REQUEST, true usa STS_OK).

**Returns:** `void`
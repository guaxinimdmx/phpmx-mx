# `PhpMx\Response`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe para construção e envio de respostas HTTP.

## Properties

- `protected static $HEADER` `array` —
- `protected static $STATUS` `?int` —
- `protected static $TYPE` `?string` —
- `protected static $CONTENT` `mixed` —
- `protected static $CACHE` `?string` —
- `protected static $DOWNLOAD` `bool` —
- `protected static $DOWNLOAD_NAME` `?string` —

## Methods

---

### `public static status(status, replace)`

Define o status HTTP da resposta.

- `$status` `?int` — Código de status HTTP.
- `$replace` `bool` — Se falso, mantém o status já definido.

**Returns:** `mixed`

---

### `public static header(name, value)`

Define um cabeçalho para a resposta.

- `$name` `array|string` — Nome do cabeçalho ou array associativo de cabeçalhos.
- `$value` `?string` — Valor do cabeçalho (ignorado quando $name é array).

**Returns:** `mixed`

---

### `public static type(type, replace)`

Define o Content-Type da resposta a partir de uma extensão ou mime type.

- `$type` `?string` — Extensão ou mime type desejado.
- `$replace` `bool` — Se falso, mantém o tipo já definido.

**Returns:** `mixed`

---

### `public static content(content, replace)`

Define o conteúdo da resposta.

- `$content` `mixed` — Conteúdo a ser enviado.
- `$replace` `bool` — Se falso, mantém o conteúdo já definido.

**Returns:** `mixed`

---

### `public static cache(strToTime)`

Define se e por quanto tempo a resposta deve ser armazenada em cache.

- `$strToTime` `string|bool|null` — String de tempo (ex: '+1 hour'), false para desativar ou null para usar o padrão.

**Returns:** `void`

---

### `public static download(download)`

Define se o navegador deve fazer download da resposta.

- `$download` `string|bool|null` — True para forçar download, string para definir o nome do arquivo.

**Returns:** `void`

---

### `public static send()`

Envia a resposta ao navegador do cliente encerrando a execução.

**Returns:** `void`

---

### `public static getStatus()`

Retorna o status HTTP atual da resposta.

**Returns:** `?int`

---

### `public static getContent()`

Retorna o conteúdo atual da resposta.

**Returns:** `mixed`

---

### `public static checkType(types)`

Verifica se o tipo da resposta corresponde a um dos tipos informados.

- `$types` `string` — Tipos a verificar.

**Returns:** `bool`
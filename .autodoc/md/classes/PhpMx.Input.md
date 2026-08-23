# `PhpMx\Input`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `class`

Classe para gerenciamento de campos e validação de inputs da requisição.

## Properties

- `protected $dataField` `array` —

## Methods

---

### `public __construct(dataValue)`

```php
new Input()
new Input($dataValue)
```

- `$dataValue` `?array` — Dados de entrada (opcional, usa Request::data() por padrão).

**Returns:** `mixed`

---

### `public field(name, alias, default)`

Retorna o objeto de um campo de input genérico.

```php
$input->field($name)
$input->field($name, $alias)
$input->field($name, $alias, $default)
```

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputField`

---

### `public fieldBool(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber um valor booleano.

```php
$input->fieldBool($name)
$input->fieldBool($name, $alias)
$input->fieldBool($name, $alias, $default)
```

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldBool`

---

### `public fieldList(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber um valor de lista.

```php
$input->fieldList($name)
$input->fieldList($name, $alias)
$input->fieldList($name, $alias, $default)
```

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldList`

---

### `public fieldUpload(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber um arquivo de upload.

```php
$input->fieldUpload($name)
$input->fieldUpload($name, $alias)
$input->fieldUpload($name, $alias, $default)
```

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldUpload`

---

### `public fieldUploadImage(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber uma imagem em base64.

```php
$input->fieldUploadImage($name)
$input->fieldUploadImage($name, $alias)
$input->fieldUploadImage($name, $alias, $default)
```

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldUploadImage`

---

### `public fieldCaptcha(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber um código Captcha.

```php
$input->fieldCaptcha($name)
$input->fieldCaptcha($name, $alias)
$input->fieldCaptcha($name, $alias, $default)
```

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldCaptcha`

---

### `public fieldScheme(name, alias, default)`

Retorna o objeto de um campo de input preparado para receber um array scheme.

```php
$input->fieldScheme($name)
$input->fieldScheme($name, $alias)
$input->fieldScheme($name, $alias, $default)
```

- `$name` `string` — Nome do campo.
- `$alias` `string|null` — Rótulo amigável para mensagens de erro.
- `$default` `mixed` — Valor padrão caso o campo não seja recebido.

**Returns:** `PhpMx\Input\InputFieldScheme`

---

### `public get(fieldName)`

Retorna o valor verificado e sanitizado de um campo do input.

```php
$input->get($fieldName)
```

- `$fieldName` `string` — Nome do campo.

**Returns:** `mixed`

---

### `public check()`

Verifica se todos os campos do input passam na validação, lançando Exception em caso de falha.

```php
$input->check()
```

**Returns:** `bool`

---

### `public data(nameFields)`

Retorna os valores validados dos campos do input em forma de array.

```php
$input->data()
$input->data($nameFields)
```

- `$nameFields` `?array` — Lista de campos a retornar (opcional, retorna todos por padrão).

**Returns:** `array`

---

### `public dataReceived(nameFields)`

Retorna apenas os valores dos campos efetivamente recebidos na requisição.

```php
$input->dataReceived()
$input->dataReceived($nameFields)
```

- `$nameFields` `?array` — Lista de campos a considerar (opcional, considera todos por padrão).

**Returns:** `array`

---

### `public send(message, status)`

Lança uma Exception em nome do input com mensagem e status HTTP definidos.

```php
$input->send($message)
$input->send($message, $status)
```

- `$message` `string` — Mensagem de erro.
- `$status` `int|bool` — Status HTTP (false usa STS_BAD_REQUEST, true usa STS_OK).

**Returns:** `void`
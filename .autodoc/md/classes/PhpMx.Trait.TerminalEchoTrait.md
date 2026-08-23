# `PhpMx\Trait\TerminalEchoTrait`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `trait`

Camada de exibição de dados no terminal











## Methods

---

### `public static echol(text, prepare)`



Exibe uma linha de texto no terminal com quebra de linha.

```php
TerminalEchoTrait::echol()
TerminalEchoTrait::echol($text)
TerminalEchoTrait::echol($text, $prepare)
```

- `$text` `string` — Texto que deve ser exibido
- `$prepare` `array|string` — Dados prepare para compor o texto

**Returns:** `void`

---

### `public static echod(text, prepare)`



Exibe uma linha de texto dinâmica, substituindo a escrita anterior do echod. Guardar o tamanho do último texto exibido para limpar corretamente na próxima chamada.

```php
TerminalEchoTrait::echod()
TerminalEchoTrait::echod($text)
TerminalEchoTrait::echod($text, $prepare)
```

- `$text` `string` — Texto que deve ser exibido
- `$prepare` `array|string` — Dados prepare para compor o texto

**Returns:** `void`

---

### `public static echo(text, prepare)`



Exibe uma linha de texto no terminal sem quebra de linha.

```php
TerminalEchoTrait::echo()
TerminalEchoTrait::echo($text)
TerminalEchoTrait::echo($text, $prepare)
```

- `$text` `string` — Texto que deve ser exibido
- `$prepare` `array|string` — Dados prepare para compor o texto

**Returns:** `void`

---

### `public static confirm(text, prepare, default)`



Solicita confirmação do usuário (y/n)

```php
TerminalEchoTrait::confirm()
TerminalEchoTrait::confirm($text)
TerminalEchoTrait::confirm($text, $prepare)
TerminalEchoTrait::confirm($text, $prepare, $default)
```

- `$text` `string` — Mensagem de texto que deve ser exibida
- `$prepare` `array|string` — Dados prepare para compor o texto
- `$default` `?bool` — Valor retornado por padrão. Se não informado, o terminal vai entrar em loop ate receber um valor válido.

**Returns:** `bool`

---

### `public static input(text, prepare, default, required)`



Solicita entrada de texto do usuário

```php
TerminalEchoTrait::input()
TerminalEchoTrait::input($text)
TerminalEchoTrait::input($text, $prepare)
TerminalEchoTrait::input($text, $prepare, $default)
TerminalEchoTrait::input($text, $prepare, $default, $required)
```

- `$text` `string` — Mensagem de texto que deve ser exibida
- `$prepare` `array|string` — Dados prepare para compor o texto
- `$default` `?string` — Valor retornado por padrão.
- `$required` `bool` — Se o terminal deve entrar em loop ate receber um valor válido.

**Returns:** `string`

---

### `public static password(text, prepare, expected, required)`



Solicita entrada de senha (texto oculto)

```php
TerminalEchoTrait::password()
TerminalEchoTrait::password($text)
TerminalEchoTrait::password($text, $prepare)
TerminalEchoTrait::password($text, $prepare, $expected)
TerminalEchoTrait::password($text, $prepare, $expected, $required)
```

- `$text` `string` — Mensagem de texto que deve ser exibida
- `$prepare` `array|string` — Dados prepare para compor o texto
- `$expected` `?string` — Valor experado para validação rápida
- `$required` `bool` — Se o terminal deve entrar em loop ate receber o valor experado

**Returns:** `string`

---

### `public static select(text, prepare, options, default)`



Solicita uma escolha entre opções numeradas

```php
TerminalEchoTrait::select()
TerminalEchoTrait::select($text)
TerminalEchoTrait::select($text, $prepare)
TerminalEchoTrait::select($text, $prepare, $options)
TerminalEchoTrait::select($text, $prepare, $options, $default)
```

- `$text` `string` — Mensagem de texto que deve ser exibida
- `$prepare` `array|string` — Dados prepare para compor o texto
- `$options` `array` — Valores para composição da lista ['option'=>'value']
- `$default` `mixed` — Valor retornado por padrão.

**Returns:** `mixed`

---

### `public static progress(text, prepare, current, total)`



Exibe uma barra de progresso

```php
TerminalEchoTrait::progress()
TerminalEchoTrait::progress($text)
TerminalEchoTrait::progress($text, $prepare)
TerminalEchoTrait::progress($text, $prepare, $current)
TerminalEchoTrait::progress($text, $prepare, $current, $total)
```

- `$text` `string` — Mensagem de texto que deve ser exibida
- `$prepare` `array|string` — Dados prepare para compor o texto
- `$current` `int` — Valor atual da barra
- `$total` `int` — Valor total da barra

**Returns:** `void`

---

### `public static table(data, hasHeader)`



Exibe uma tabela a partir de uma matriz

```php
TerminalEchoTrait::table($data)
TerminalEchoTrait::table($data, $hasHeader)
```

- `$data` `array` — Dados da tabela
- `$hasHeader` `bool` — Se a primeira linha da tabela deve ser tratada como cabeçalho

**Returns:** `void`

---

### `public static echoThrow(e)`



Exibe os detalhes de uma exception (tipo, mensagem e stack trace).

```php
TerminalEchoTrait::echoThrow($e)
```

- `$e` `Throwable` — Exception a ser exibida

**Returns:** `void`
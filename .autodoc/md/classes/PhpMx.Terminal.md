# `PhpMx\Terminal`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `abstract class`

Classe base para criação e execução de comandos de terminal.

**Uses:** `PhpMx\Trait\TerminalEchoTrait`

## Methods

---

### `public static final run(commandLine)`

Executa uma linha de comando

```php
Terminal::run()
Terminal::run(...$commandLine)
```

- `$commandLine` `mixed` — Comando que deve ser executado

**Returns:** `bool`

---

### `public static final exec(commandLine)`

Executa um comando no terminal do sistema.

```php
Terminal::exec($commandLine)
```

- `$commandLine` `string` — Linha de comando que deve ser executada

**Returns:** `void`

---

### `public static echol(text, prepare)`

Exibe uma linha de texto no terminal com quebra de linha.

```php
Terminal::echol()
Terminal::echol($text)
Terminal::echol($text, $prepare)
```

- `$text` `string` — Texto que deve ser exibido
- `$prepare` `array|string` — Dados prepare para compor o texto

**Returns:** `void`

---

### `public static echod(text, prepare)`

Exibe uma linha de texto dinâmica, substituindo a escrita anterior do echod. Guardar o tamanho do último texto exibido para limpar corretamente na próxima chamada.

```php
Terminal::echod()
Terminal::echod($text)
Terminal::echod($text, $prepare)
```

- `$text` `string` — Texto que deve ser exibido
- `$prepare` `array|string` — Dados prepare para compor o texto

**Returns:** `void`

---

### `public static echo(text, prepare)`

Exibe uma linha de texto no terminal sem quebra de linha.

```php
Terminal::echo()
Terminal::echo($text)
Terminal::echo($text, $prepare)
```

- `$text` `string` — Texto que deve ser exibido
- `$prepare` `array|string` — Dados prepare para compor o texto

**Returns:** `void`

---

### `public static confirm(text, prepare, default)`

Solicita confirmação do usuário (y/n)

```php
Terminal::confirm()
Terminal::confirm($text)
Terminal::confirm($text, $prepare)
Terminal::confirm($text, $prepare, $default)
```

- `$text` `string` — Mensagem de texto que deve ser exibida
- `$prepare` `array|string` — Dados prepare para compor o texto
- `$default` `?bool` — Valor retornado por padrão. Se não informado, o terminal vai entrar em loop ate receber um valor válido.

**Returns:** `bool`

---

### `public static input(text, prepare, default, required)`

Solicita entrada de texto do usuário

```php
Terminal::input()
Terminal::input($text)
Terminal::input($text, $prepare)
Terminal::input($text, $prepare, $default)
Terminal::input($text, $prepare, $default, $required)
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
Terminal::password()
Terminal::password($text)
Terminal::password($text, $prepare)
Terminal::password($text, $prepare, $expected)
Terminal::password($text, $prepare, $expected, $required)
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
Terminal::select()
Terminal::select($text)
Terminal::select($text, $prepare)
Terminal::select($text, $prepare, $options)
Terminal::select($text, $prepare, $options, $default)
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
Terminal::progress()
Terminal::progress($text)
Terminal::progress($text, $prepare)
Terminal::progress($text, $prepare, $current)
Terminal::progress($text, $prepare, $current, $total)
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
Terminal::table($data)
Terminal::table($data, $hasHeader)
```

- `$data` `array` — Dados da tabela
- `$hasHeader` `bool` — Se a primeira linha da tabela deve ser tratada como cabeçalho

**Returns:** `void`

---

### `public static echoThrow(e)`

Exibe os detalhes de uma exception (tipo, mensagem e stack trace).

```php
Terminal::echoThrow($e)
```

- `$e` `Throwable` — Exception a ser exibida

**Returns:** `void`
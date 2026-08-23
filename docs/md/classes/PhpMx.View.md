# `PhpMx\View`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe responsável por renderizar views e aplicar lógica de apresentação.

## Properties

- `public static $RENDER_CLASS` `array` —

## Methods

---

### `public static render(ref, data, params)`

Renderiza uma view e retorna seu conteúdo em forma de string.

- `$ref` `string` — Referência da view (namespace ou caminho relativo).
- `$data` `array|string` — Dados disponíveis como variáveis na view.
- `$params` `array` — Parâmetros adicionais de renderização.

**Returns:** `string`

---

### `public static renderString(viewContent, data)`

Renderiza uma string aplicando os prepares globais.

- `$viewContent` `string` — Conteúdo a ser processado.
- `$data` `array|string` — Dados disponíveis como variáveis na string.

**Returns:** `string`

---

### `public static mediaStyle(media, queries)`

Define media queries dinâmicas para folhas de estilo.

- `$media` `string` — Identificador da media query (ex: 'mobile').
- `$queries` `string` — Valor real da media query (ex: 'max-width: 768px').

**Returns:** `void`

---

### `public static globalPrepare(tag, action)`

Define uma tag de prepare disponível em todas as views.

- `$tag` `string` — Nome da tag de prepare.
- `$action` `mixed` — Valor ou callable associado à tag.

**Returns:** `void`
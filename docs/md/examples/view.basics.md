[← Examples](../examples.md) · [← Index](../../index.md)

# Renderizando views

Views ficam em `system/view/`, mesmo lugar onde o próprio framework guarda as suas. Pacotes e projeto convivem no mesmo namespace de views.

mx não é um framework fullstack, é backend. `View` não é pensado pra aplicação monolítica: usar pra isso significa implementar sua própria solução de sessão/cookies, já que o framework não traz uma pronta. Não é recomendado, embora nada impeça tecnicamente; só não é reativo, é renderização de servidor pura. O foco real é construção de **artefatos**: e-mails, relatórios, documentos, qualquer HTML/CSS/JS/MD autocontido. O próprio `autodoc` deste framework é construído inteiramente com `View`.

Crie um arquivo de view pelo terminal (padrão `.html`, mas aceita `.php`, `.css`, `.js` também):

```bash
php mx make.view card/card
php mx make.view card/card.css
```

## Renderizando

```php
use PhpMx\View;

$html = View::render('card/card', ['title' => 'Olá']);
```

`View::render()` recebe a referência da view e um array de dados. Os dados ficam disponíveis como tags `[#...]` no arquivo da view:

```html
<p>Card: [#title]</p>
```

## Tags de substituição (Prepare)

- `[#]`: sequencial, consome o próximo valor com chave numérica.
- `[#chave]` ou `[#objeto.chave]`: referência direta, com dot notation pra arrays aninhados.
- `[#funcao:#chave]`: executa uma closure do array de dados, passando o valor resolvido como argumento.

```php
View::render('card/card', [
    'user' => ['name' => 'Ricardo'],
    'upper' => fn($v) => strtoupper($v),
]);
```

```html
[#user.name] em maiúsculo: [#upper:#user.name]
```

## Nome de arquivo igual nome de pasta vira atalho

Se o arquivo estiver em `pasta/nome/nome.ext` (pasta e arquivo com o mesmo nome), dá pra referenciar só por `pasta/nome`, sem repetir. `system/view/card/card/card.php` fica acessível tanto como `card/card/card` quanto como `card/card`.

Por padrão a referência sem extensão devolve `.php`/`.html`/`.css`/`.js` combinados como um fragmento só. `.md` fica de fora desse grupo: pra renderizar uma view `.md`, use a extensão explícita na referência (`View::render('card/card.md', ...)`).

## Componente: html + css + js juntos

A referência sem extensão não só é atalho, ela também **junta** todos os arquivos irmãos com o mesmo nome num fragmento só. Se `widget/widget/` tiver `widget.html`, `widget.css` e `widget.js`, renderizar `widget/widget` devolve os três combinados, css dentro de `<style>` e js dentro de `<script>`.

## `__scope` isola estilo entre instâncias

Use o token literal `__scope` no HTML, CSS e JS do componente. Ele vira o mesmo hash único em todos os arquivos, gerado por renderização:

```html
<div class="__scope">Widget</div>
```

```css
.__scope { color: red; }
```

```js
console.log("__scope loaded");
```

Isso evita colisão de estilo/classe quando o mesmo componente é renderizado mais de uma vez na mesma página.

## CSS aninhado nativamente

`View` entende nesting tipo SCSS, incluindo `&` pra referenciar o seletor pai:

```css
.card {
  color: blue;

  &:hover {
    color: red;
  }

  .title {
    font-weight: bold;
  }
}
```

Vira, ao renderizar:

```css
.card { color: blue; }
.card:hover { color: red; }
.card .title { font-weight: bold; }
```

## Markdown para HTML, e CSS inline pra e-mail

Duas helpers globais, fora do `View::render()`, pra quem constrói e-mail ou documento autocontido:

```php
$html = mdToHtml("# Título\n\nTexto em **negrito**.");

$emailReady = htmlToInlineCss('<style>p { color: red; }</style><p>Oi</p>');
// <p style="color: red">Oi</p>
```

`htmlToInlineCss()` move cada regra do `<style>` pro atributo `style` de cada elemento correspondente e remove o bloco `<style>`. É exatamente o que a maioria dos clientes de e-mail exige, já que eles ignoram `<style>` solto.
# `Controller\MxServer\Captcha`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `class`

Controler para desafios alfanumérico

## Methods

---

### `public __invoke(color, background)`

Gera um desafio de captcha alfanumérico com imagem em base64 e chave criptografada

```php
$captcha()
$captcha($color)
$captcha($color, $background)
```

- `$color` `string` — Cor das letras do captcha
- `$background` `string` — Cor de fundo do captcha

**Returns:** `mixed`
# `PhpMx\Input\InputFieldUploadImage`

[← Index](../../autodoc.md) · [← Classes](../classes.md)

**Type:** `class`

Campo de input para validação de imagens enviadas em formato base64. Aceita apenas imagens nos formatos PNG, JPG, JPEG e WEBP.

**Extends:** `PhpMx\Input\InputField`









## Methods

---

### `public __construct(name, alias, value)`





```php
new InputFieldUploadImage($name)
new InputFieldUploadImage($name, $alias)
new InputFieldUploadImage($name, $alias, $value)
```

- `$name` `string` — Nome do campo.
- `$alias` `?string` — Rótulo amigável para mensagens de erro.
- `$value` `mixed` — Valor inicial (string de imagem em base64).

**Returns:** `mixed`

---

### `public recived()`



Verifica se o input foi recebido como uma imagem base64 válida.

```php
$inputFieldUploadImage->recived()
```



**Returns:** `bool`
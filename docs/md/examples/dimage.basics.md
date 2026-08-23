[← Examples](../examples.md) · [← Index](../../index.md)

# DImage

## Exemplos

```php
use PhpMx\DImage;

// Imagem sólida (placeholder), depois salva no disco
DImage::_color('#3366ff', [400, 200])->save('library/tmp/placeholder');
```

```php
// Carrega um arquivo local, corrige rotação via EXIF automaticamente
$img = DImage::_file('library/upload/foto.jpg');
$img->resize(800)->save();
```

```php
// Carrega de uma URL
$img = DImage::_url('https://exemplo.com/foto.jpg');
```

```php
// Recorta pra 16:9 (o primeiro número da razão é sempre a base da largura)
$img->ratio(16.9)->save('library/tmp/thumb');
```

```php
// Converte formato e devolve em base64, pronto pra <img src="...">
$img->convert('webp');
echo $img->getB64();
```

```php
// Marca d'água: sobrepõe outra DImage
$logo = DImage::_color('fff', 40);
$img->stamp($logo, position: 8); // 8 = canto inferior direito
```

## Considerações

`DImage` exige as extensões `gd` e `exif` (`ext-gd` está como sugestão no `composer.json`, não obrigatória).

Toda instância nasce por um dos três construtores estáticos (`_color()`, `_url()`, `_file()`), nunca `new DImage()` direto.

`save()` sem argumento reusa o `path` já definido. Pra imagem vinda de `_file()`, isso é o diretório de origem. Pra `_color()`/`_url()`, que não têm origem em disco, o padrão é `.`: chamar `save()` sem argumento nessas salva direto na raiz do projeto, sem avisar. Sempre passe o caminho explícito nesses casos.

Métodos como `resize()`, `crop()`, `convert()`, `stamp()` alteram o objeto atual e retornam `$this` (fluente); `copy()` existe pra quando você precisa de uma cópia independente antes de alterar.
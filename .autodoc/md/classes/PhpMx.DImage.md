# `PhpMx\DImage`

[← Classes](../classes.md) · [← Index](../../autodoc.md)

**Type:** `class`

Motor de manipulação de imagens (GD) com suporte a BMP, JPEG, GIF, PNG e WEBP.

**Implements:** `Stringable`

## Properties

- `protected $gd` `?GdImage` —
- `protected $color` `array` —
- `protected $size` `array` —
- `protected $imageType` `int` —
- `protected $quality` `int` —
- `protected $name` `string` —
- `protected $path` `string` —

## Methods

---

### `public static _color(color, size)`

Cria uma nova imagem monocromática.

```php
DImage::_color()
DImage::_color($color)
DImage::_color($color, $size)
```

- `$color` `array|string` — Cor em Hexadecimal (ex: 'fff', '#ffffff') ou Array RGB.
- `$size` `array|int` — Tamanho único (quadrado) ou Array [largura, altura].

**Returns:** `PhpMx\DImage`

---

### `public static _url(url)`

Instancia a classe a partir de uma URL ou caminho remoto.

```php
DImage::_url($url)
```

- `$url` `string` — Endereço da imagem.

**Returns:** `PhpMx\DImage`

---

### `public static _file(path)`

Carrega uma imagem a partir de um arquivo local, corrigindo a rotação via metadados EXIF.

```php
DImage::_file($path)
```

- `$path` `string` — Caminho completo do arquivo no disco.

**Returns:** `PhpMx\DImage`

---

### `public save(path)`

Exporta e salva a imagem no disco utilizando o formato e qualidade definidos.

```php
$dImage->save()
$dImage->save($path)
```

- `$path` `?string` — Caminho do diretório (opcional, usa o path original por padrão).

**Returns:** `static`

---

### `public copy()`

Gera uma cópia independente (clone) do objeto de imagem atual.

```php
$dImage->copy()
```

**Returns:** `PhpMx\DImage`

---

### `public getName(ex)`

Retorna o nome da imagem, opcionalmente incluindo a extensão.

```php
$dImage->getName()
$dImage->getName($ex)
```

- `$ex` `bool` — Se verdadeiro, concatena a extensão ao nome.

**Returns:** `string`

---

### `public getPath()`

Retorna o caminho da imagem no disco

```php
$dImage->getPath()
```

**Returns:** `?string`

---

### `public getGd()`

Retorna a imagem GD gerada pela classe

```php
$dImage->getGd()
```

**Returns:** `GdImage`

---

### `public getSize()`

Retorna o array de dimensão da imagem

```php
$dImage->getSize()
```

**Returns:** `array`

---

### `public getWidth()`

Retorna a largura da imagem

```php
$dImage->getWidth()
```

**Returns:** `int`

---

### `public getHeight()`

Retorna a altura da imagem

```php
$dImage->getHeight()
```

**Returns:** `int`

---

### `public getExtension()`

Retorna a extensao da imagem

```php
$dImage->getExtension()
```

**Returns:** `string`

---

### `public getFileSize()`

Retorna o tamanho do arquivo da imagem

```php
$dImage->getFileSize()
```

**Returns:** `float`

---

### `public getHash()`

Captura o Hash Md5 gerado pelo binario da imagem

```php
$dImage->getHash()
```

**Returns:** `string`

---

### `public getBin()`

Retorna o binario da imagem

```php
$dImage->getBin()
```

**Returns:** `string`

---

### `public getB64()`

Retorna a imagem codificada em base64

```php
$dImage->getB64()
```

**Returns:** `string`

---

### `public quality(quality)`

Ajusta o nível de compressão/qualidade da imagem (0 a 100).

```php
$dImage->quality($quality)
```

- `$quality` `int` — Valor da qualidade.

**Returns:** `static`

---

### `public rename(name)`

Define o nome do arquivo, removendo automaticamente extensões pré-existentes.

```php
$dImage->rename($name)
```

- `$name` `string` — Novo nome para o arquivo.

**Returns:** `static`

---

### `public path()`

Define o diretório de destino aceitando múltiplos argumentos para compor o caminho.

```php
$dImage->path()
```

**Returns:** `static`

---

### `public color(color)`

Define a cor base ou de preenchimento para operações na imagem.

```php
$dImage->color($color)
```

- `$color` `array|string` — Hexadecimal ou Array RGB.

**Returns:** `static`

---

### `public ratio(ratio, position)`

Recorta a imagem para um aspect-ratio específico (ex: 1.1 para 1:1, 16.9 para 16:9).

```php
$dImage->ratio()
$dImage->ratio($ratio)
$dImage->ratio($ratio, $position)
```

- `$ratio` `?float` — Proporção desejada.
- `$position` `int` — Ponto de ancoragem para o corte.

**Returns:** `static`

---

### `public convert(ex)`

Converte o formato de saída da imagem (jpg, png, webp, etc) e gerencia a transparência.

```php
$dImage->convert($ex)
```

- `$ex` `string` — Extensão desejada.

**Returns:** `static`

---

### `public resize(size)`

Redimensiona mantendo a proporção. Valores negativos definem o limite mínimo.

```php
$dImage->resize($size)
```

- `$size` `array|int` — Tamanho alvo ou limite.

**Returns:** `static`

---

### `public resizeFree(size)`

Redimensiona a imagem ignorando a proporção original (distorção controlada).

```php
$dImage->resizeFree($size)
```

- `$size` `array|int` — Largura e altura alvo.

**Returns:** `static`

---

### `public rotate(graus, transparent)`

Rotaciona a imagem no sentido horário.

```php
$dImage->rotate($graus)
$dImage->rotate($graus, $transparent)
```

- `$graus` `int` — Ângulo de rotação.
- `$transparent` `bool` — Se deve preservar/converter para transparência.

**Returns:** `static`

---

### `public flipH()`

Inverte a imagem horizontalmente (espelhamento lateral).

```php
$dImage->flipH()
```

**Returns:** `static`

---

### `public flipV()`

Inverte a imagem verticalmente (de ponta-cabeça).

```php
$dImage->flipV()
```

**Returns:** `static`

---

### `public stamp(imgSpamt, position)`

Sobrepõe uma outra instância de DImage sobre a imagem atual (Marca d'água).

```php
$dImage->stamp($imgSpamt)
$dImage->stamp($imgSpamt, $position)
```

- `$imgSpamt` `PhpMx\DImage` — Imagem a ser aplicada.
- `$position` `int` — Posição do carimbo.

**Returns:** `static`

---

### `public crop(size, position)`

Corta uma área específica da imagem com base em uma posição.

```php
$dImage->crop($size)
$dImage->crop($size, $position)
```

- `$size` `array|int` — Dimensões do recorte.
- `$position` `int` — Alinhamento (Centro, Topo, etc).

**Returns:** `static`

---

### `public framing(size)`

Redimensiona e centraliza a imagem dentro de um novo quadro preenchido com a cor base.

```php
$dImage->framing($size)
```

- `$size` `array|int` — Tamanho do quadro final.

**Returns:** `static`

---

### `public filter(filter)`

Aplica um filtro nativo do PHP GD à imagem.

```php
$dImage->filter($filter)
```

- `$filter` `int` — Constante do filtro (ex: IMG_FILTER_GRAYSCALE).

**Returns:** `static`
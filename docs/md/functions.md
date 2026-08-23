# Functions

[← Index](../index.md)

---

### `cache(cacheName, action)`

Armazena e recupera o retorno de uma Closure em /library/cache.

```php
cache($cacheName, $action)
```

- `$cacheName` `string` — Nome identificador do cache.
- `$action` `Closure` — Função que gera o valor caso o cache não exista ou esteja em DEV.

**Returns:** `mixed`

---

### `cacheTime(cacheName, seconds, action)`

Armazena e recupera o retorno de uma Closure em /library/cache por um período determinado.

```php
cacheTime($cacheName, $seconds, $action)
```

- `$cacheName` `string` — Nome identificador do cache.
- `$seconds` `int` — Tempo de vida do cache em segundos.
- `$action` `Closure` — Função que gera o valor caso o cache tenha expirado.

**Returns:** `mixed`

---

### `applyChanges(array, changes)`

Aplica mudanças em um array de forma recursiva.

```php
applyChanges($array, $changes)
```

- `$array` `array` — Array original que receberá as alterações (passado por referência).
- `$changes` `array` — Mapa de alterações a serem aplicadas.

**Returns:** `void`

---

### `getChanges(changed, original)`

Compara dois arrays e retorna as diferenças estruturais.

```php
getChanges($changed, $original)
```

- `$changed` `array` — Array com as versões novas dos dados.
- `$original` `array` — Array com os dados originais.

**Returns:** `array`

---

### `colorRGB(color)`

Converte uma string de cor Hexadecimal (com ou sem #) em uma string RGB separada por vírgulas. Suporta formatos de 6, 3 ou 1 caractere (ex: 'FF0000', 'F00', 'F').

```php
colorRGB($color)
```

- `$color` `string` — A cor em hexadecimal ou já em formato RGB.

**Returns:** `string`

---

### `colorHex(color)`

Converte uma string de cor RGB (separada por vírgulas) em Hexadecimal de 6 caracteres.

```php
colorHex($color)
```

- `$color` `string` — Valores RGB (ex: '255,0,0') ou hexadecimal.

**Returns:** `string`

---

### `d(params)`

Realiza o var_dump de múltiplas variáveis com configurações otimizadas de profundidade e exibição.

```php
d()
d(...$params)
```

- `$params` `mixed` — Variáveis para depuração.

**Returns:** `void`

---

### `dd(params)`

Exibe os dados das variáveis (dump) e encerra a execução do sistema (die).

```php
dd()
dd(...$params)
```

- `$params` `mixed` — Variáveis para depuração.

**Returns:** `void`

---

### `dpre(params)`

Realiza o var_dump de variáveis dentro de uma tag HTML pre.

```php
dpre()
dpre(...$params)
```

- `$params` `mixed` — Variáveis para depuração.

**Returns:** `void`

---

### `ddpre(params)`

Realiza o var_dump de variáveis dentro de uma tag HTML pre encerrando a execução do sistema.

```php
ddpre()
ddpre(...$params)
```

- `$params` `mixed` — Variáveis para depuração.

**Returns:** `void`

---

### `env(name)`

Recupera o valor de uma variável de ambiente carregada pelo Env.

```php
env($name)
```

- `$name` `string` — Nome da variável de ambiente.

**Returns:** `mixed`

---

### `htmlToInlineCss(html)`

Converte os estilos CSS de blocos <style> para atributos style inline em cada elemento HTML. Seletores com pseudo-classes (:hover, :focus) e @media são ignorados. Estilos inline já existentes nos elementos têm prioridade sobre os do <style>.

```php
htmlToInlineCss($html)
```

- `$html` `string` — HTML de entrada com blocos <style> (fragmento ou página completa).

**Returns:** `string`

---

### `idKeyType(idKey)`

Retorna o tipo de um idKey (nome da tabela associada ao registro).

```php
idKeyType($idKey)
```

- `$idKey` `string` — IdKey a ser decodificado.

**Returns:** `?string`

---

### `idKeyId(idKey)`

Retorna o id numérico de um idKey.

```php
idKeyId($idKey)
```

- `$idKey` `string` — IdKey a ser decodificado.

**Returns:** `?int`

---

### `is_base64(var)`

Verifica se uma variável é uma string codificada em Base64 válida.

```php
is_base64($var)
```

- `$var` `mixed` — A variável a ser verificada.

**Returns:** `bool`

---

### `is_blank(var)`

Verifica se uma variável é nula, vazia ou composta apenas de espaços em branco. Diferente de empty(), retorna false para números (0) e booleanos.

```php
is_blank($var)
```

- `$var` `mixed` — A variável a ser verificada.

**Returns:** `bool`

---

### `is_class(object, class)`

Verifica se um objeto ou string de classe é exatamente a classe informada ou a estende.

```php
is_class($object, $class)
```

- `$object` `mixed` — Objeto ou nome da classe para verificar.
- `$class` `object|string` — Classe de referência.

**Returns:** `bool`

---

### `is_cif(var)`

Atalho para verificar se uma variável é uma cifra MX válida (via Cif::check).

```php
is_cif($var)
```

- `$var` `mixed` — A variável a ser verificada.

**Returns:** `bool`

---

### `is_closure(var)`

Verifica se uma variável é uma função anônima ou um objeto invocável (callable).

```php
is_closure($var)
```

- `$var` `mixed` — A variável a ser verificada.

**Returns:** `bool`

---

### `is_extend(object, class)`

Verifica especificamente se um objeto ou classe estende uma classe pai.

```php
is_extend($object, $class)
```

- `$object` `mixed` — Objeto ou nome da classe a verificar.
- `$class` `object|string` — Classe pai de referência.

**Returns:** `bool`

---

### `is_idKey(idKey)`

Verifica se uma variável é um idKey válido.

```php
is_idKey($idKey)
```

- `$idKey` `mixed` — Variável a verificar.

**Returns:** `bool`

---

### `is_image_base64(var)`

Verifica se uma string é uma URL de imagem codificada em Base64 (data:image/...).

```php
is_image_base64($var)
```

- `$var` `mixed` — A variável a ser verificada.

**Returns:** `bool`

---

### `is_implement(object, interface)`

Verifica se um objeto ou classe implementa uma interface específica.

```php
is_implement($object, $interface)
```

- `$object` `mixed` — Objeto ou nome da classe a verificar.
- `$interface` `object|string` — Interface de referência.

**Returns:** `bool`

---

### `is_json(var)`

Verifica se uma string é um JSON válido.

```php
is_json($var)
```

- `$var` `mixed` — A variável a ser verificada.

**Returns:** `bool`

---

### `is_httpStatus(var)`

Verifica se uma variável corresponde a um status HTTP válido (100~599).

```php
is_httpStatus($var)
```

- `$var` `mixed` — Variável a verificar.

**Returns:** `bool`

---

### `is_httpStatusError(var)`

Verifica se uma variável corresponde a um status de erro HTTP (400~599).

```php
is_httpStatusError($var)
```

- `$var` `mixed` — Variável a verificar.

**Returns:** `bool`

---

### `is_md5(var)`

Verifica se uma string possui o formato hexadecimal de 32 caracteres de um MD5.

```php
is_md5($var)
```

- `$var` `mixed` — A variável a ser verificada.

**Returns:** `bool`

---

### `is_password(value)`

Verifica se uma string é um hash de senha BCRYPT válido de 60 caracteres.

```php
is_password($value)
```

- `$value` `string` — O hash a ser verificado.

**Returns:** `bool`

---

### `is_mx5(var)`

Atalho para verificar se uma variável é um hash MX5 válido.

```php
is_mx5($var)
```

- `$var` `mixed` — A variável a ser verificada.

**Returns:** `bool`

---

### `is_serialized(var, strict)`

Verifica se uma variável corresponde a uma string serializada pelo PHP.

```php
is_serialized($var)
is_serialized($var, $strict)
```

- `$var` `mixed` — Váriavel que deve ser serializada
- `$strict` `bool` — Se deve realizar uma verificação rigorosa de fim de linha.

**Returns:** `bool`

---

### `is_stringable(var)`

Verifica se uma variável pode ser convertida para string (string, número ou objeto com __toString).

```php
is_stringable($var)
```

- `$var` `mixed` — A variável a ser verificada.

**Returns:** `bool`

---

### `is_trait(object, trait)`

Verifica se um objeto ou classe utiliza uma Trait específica (incluindo herança).

```php
is_trait($object, $trait)
```

- `$object` `mixed` — Objeto ou nome da classe a verificar.
- `$trait` `object|string|null` — Nome da Trait de referência.

**Returns:** `bool`

---

### `mdToHtml(md)`

Converte uma string Markdown em HTML. Suporta títulos, parágrafos, listas, blockquotes, blocos de código, links, imagens e formatação inline.

```php
mdToHtml($md)
```

- `$md` `string` — Conteúdo em formato Markdown.

**Returns:** `string`

---

### `mx5(var)`

Atalho para converter uma variável em um hash MX5.

```php
mx5($var)
```

- `$var` `mixed` — Variável para codificação.

**Returns:** `string`

---

### `num_format(number, decimals, roundType)`

Formata um número para o tipo float com controle de casas decimais e tipo de arredondamento.

```php
num_format($number)
num_format($number, $decimals)
num_format($number, $decimals, $roundType)
```

- `$number` `string|int|float` — O número a ser formatado.
- `$decimals` `int` — Quantidade de casas decimais.
- `$roundType` `int` — Tipo de arredondamento (-1: baixo, 0: comum, 1: cima).

**Returns:** `float`

---

### `num_round(number, roundType)`

Arredonda um número de acordo com o tipo especificado.

```php
num_round($number)
num_round($number, $roundType)
```

- `$number` `string|int|float` — O número para arredondar.
- `$roundType` `int` — -1 para baixo (floor), 0 para comum (round), 1 para cima (ceil).

**Returns:** `int`

---

### `num_interval(number, min, max)`

Garante que um número esteja contido dentro de um intervalo mínimo e máximo.

```php
num_interval($number)
num_interval($number, $min)
num_interval($number, $min, $max)
```

- `$number` `string|int|float` — O valor base.
- `$min` `string|int|float` — Valor mínimo permitido.
- `$max` `string|int|float` — Valor máximo permitido.

**Returns:** `int|float`

---

### `num_positive(number)`

Retorna o valor absoluto (positivo) de um número.

```php
num_positive($number)
```

- `$number` `string|int|float` — O número de entrada.

**Returns:** `int|float`

---

### `num_negative(number)`

Retorna a representação negativa de um número.

```php
num_negative($number)
```

- `$number` `string|int|float` — O número de entrada.

**Returns:** `int|float`

---

### `path(segments)`

Formata e normaliza um caminho de diretório a partir de um ou mais segmentos.

```php
path()
path(...$segments)
```

- `$segments` `string` — Segmentos do caminho (ex: 'pasta', 'sub', 'arquivo.php').

**Returns:** `string`

---

### `phpex(extension, throw)`

Verifica se uma extensão do PHP está ativa e carregada no servidor.

```php
phpex($extension)
phpex($extension, $throw)
```

- `$extension` `string` — Nome da extensão (ex: 'mbstring', 'gd', 'xdebug').
- `$throw` `bool` — Se deve lançar uma exceção caso a extensão não esteja ativa.

**Returns:** `bool`

---

### `prepare(string, prepare)`

Processa uma string de template, substituindo as tags pelos valores fornecidos.

```php
prepare($string)
prepare($string, $prepare)
```

- `$string` `?string` — O texto original contendo as tags de template.
- `$prepare` `array|string` — Os dados para substituição (array associativo ou valor único).

**Returns:** `string`

---

### `redirect(pathParams)`

Lança uma Exception de redirecionamento para a URL composta pelos argumentos fornecidos.

```php
redirect()
redirect(...$pathParams)
```

- `$pathParams` `string` — Partes da URL de destino.

**Returns:** `void`

---

### `remove_accents(string)`

Remove a acentuação e caracteres especiais de uma string utilizando um mapa de normalização.

```php
remove_accents($string)
```

- `$string` `string` — O texto original com acentos.

**Returns:** `string`

---

### `str_get_var(var)`

Extrai e converte um valor de dentro de uma string para seu tipo real (bool, int, float ou null).

```php
str_get_var($var)
```

- `$var` `mixed` — O valor a ser analisado e convertido.

**Returns:** `mixed`

---

### `str_replace_all(search, replace, subject, loop)`

Substitui repetidamente as ocorrências de uma string até que não haja mais mudanças ou atinja o limite.

```php
str_replace_all($search, $replace, $subject)
str_replace_all($search, $replace, $subject, $loop)
```

- `$search` `array|string` — Valor(es) a buscar na string.
- `$replace` `array|string` — Valor(es) de substituição.
- `$subject` `string` — A string alvo da substituição.
- `$loop` `int` — Limite de iterações para evitar loops infinitos.

**Returns:** `string`

---

### `str_replace_first(search, replace, subject)`

Substitui apenas a primeira ocorrência encontrada da string de pesquisa.

```php
str_replace_first($search, $replace, $subject)
```

- `$search` `array|string` — Valor(es) a buscar na string.
- `$replace` `array|string` — Valor(es) de substituição.
- `$subject` `string` — A string alvo da substituição.

**Returns:** `string`

---

### `str_replace_last(search, replace, subject)`

Substitui apenas a última ocorrência encontrada da string de pesquisa.

```php
str_replace_last($search, $replace, $subject)
```

- `$search` `array|string` — Valor(es) a buscar na string.
- `$replace` `array|string` — Valor(es) de substituição.
- `$subject` `string` — A string alvo da substituição.

**Returns:** `string`

---

### `str_trim(string, substring, characters)`

Remove espaços ou caracteres específicos do entorno de uma substring dentro de uma string maior.

```php
str_trim($string, $substring)
str_trim($string, $substring, $characters)
```

- `$string` `string` — O texto completo.
- `$substring` `array|string` — A parte que deve ser limpa.
- `$characters` `array|string` — Caracteres a serem removidos.

**Returns:** `string`

---

### `mb_str_replace(search, replace, subject, count)`

Versão multibyte segura da função str_replace.

```php
mb_str_replace($search, $replace, $subject)
mb_str_replace($search, $replace, $subject, $count)
```

- `$search` `array|string` — Valor(es) a buscar na string.
- `$replace` `array|string` — Valor(es) de substituição.
- `$subject` `string` — A string alvo da substituição.
- `$count` `int` — Referência para contagem de substituições.

**Returns:** `string`

---

### `mb_str_replace_all(search, replace, subject, loop)`

Versão multibyte segura da função str_replace_all.

```php
mb_str_replace_all($search, $replace, $subject)
mb_str_replace_all($search, $replace, $subject, $loop)
```

- `$search` `array|string` — Valor(es) a buscar na string.
- `$replace` `array|string` — Valor(es) de substituição.
- `$subject` `string` — A string alvo da substituição.
- `$loop` `int` — Limite de iterações para evitar loops infinitos.

**Returns:** `string`

---

### `strToCamelCase(string)`

Converte uma string para o formato camelCase.

```php
strToCamelCase($string)
```

- `$string` `string` — A string a ser convertida.

**Returns:** `string`

---

### `strToKebabCase(string)`

Converte uma string para o formato kebab-case.

```php
strToKebabCase($string)
```

- `$string` `string` — A string a ser convertida.

**Returns:** `string`

---

### `strToPascalCase(string)`

Converte uma string para o formato PascalCase.

```php
strToPascalCase($string)
```

- `$string` `string` — A string a ser convertida.

**Returns:** `string`

---

### `strToSnakeCase(string)`

Converte uma string para o formato snake_case.

```php
strToSnakeCase($string)
```

- `$string` `string` — A string a ser convertida.

**Returns:** `string`

---

### `url(params)`

Retorna uma string de URL composta pelos argumentos fornecidos. Argumentos em array ou iniciados com '?' são tratados como query string. URLs relativas são resolvidas automaticamente com base no host e protocolo da requisição atual.

```php
url()
url(...$params)
```

- `$params` `array|string` — Partes da URL ou arrays/strings de query string.

**Returns:** `string`

---

### `uuid()`

Gera uma string de identificação única curta e personalizada.

```php
uuid()
```

**Returns:** `string`
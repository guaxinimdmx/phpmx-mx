[← Examples](../examples.md) · [← Index](../../index.md)

# Router

## Exemplos

Rotas ficam em `system/router/*`, qualquer nome de arquivo, quantos arquivos você quiser, organizados como preferir. Pelo terminal, cria a rota direto no arquivo, e ainda oferece gerar o controller junto:

```bash
php mx make.route get "users/[#id]" User.show
```

Ou declara direto, um método HTTP por vez:

```php
use PhpMx\Router;

Router::get('users/[#id]', [\Controller\User::class, 'show']);
Router::post('users', \Controller\User::class);
Router::put('users/[#id]', [\Controller\User::class, 'update']);
Router::delete('users/[#id]', [\Controller\User::class, 'destroy']);
```

```php
// add() é atalho pra GET + POST
Router::add('contact', \Controller\Contact::class);

// full() é atalho pra GET + POST + PUT + DELETE
Router::full('posts/[#id]', \Controller\Post::class);

// a resposta também pode ser só um status HTTP, sem controller nenhum
Router::get('health', STS_OK);
```

Middleware direto na rota, terceiro argumento:

```php
Router::get('perfil', \Controller\Profile::class, ['auth.token']);
```

`path()` prefixa o caminho de tudo que for declarado dentro do Closure:

```php
Router::path('api', function () {
    Router::get('ping', \Controller\Ping::class);
    Router::get('users', \Controller\User::class);
});
// registra: api/ping e api/users
```

`middleware()` aplica os middlewares a tudo que for declarado dentro do Closure:

```php
Router::middleware(['cors'], function () {
    Router::get('users', \Controller\User::class);
    Router::post('users', \Controller\User::class);
});
// as duas rotas recebem 'cors', sem precisar repetir no terceiro argumento
```

`group()` é `path()` + `middleware()` num só:

```php
Router::group('api', ['cors'], function () {
    Router::get('ping', \Controller\Ping::class);
});
```

Exatamente equivalente a:

```php
Router::path('api', function () {
    Router::middleware(['cors'], function () {
        Router::get('ping', \Controller\Ping::class);
    });
});
```

`path()`, `middleware()` e `group()` aninham livremente, em qualquer ordem e profundidade:

```php
Router::group('api', ['cors'], function () {

    Router::get('ping', \Controller\Ping::class);

    // middleware() dentro de group(): herda 'cors' e soma 'auth.token'
    Router::middleware(['auth.token'], function () {
        Router::path('users', function () {
            Router::get('', \Controller\User::class);
            Router::get('[#id]', [\Controller\User::class, 'show'], ['throttle']);
        });
    });

    // path() dentro de group(), com middleware() dentro dele
    Router::path('admin', function () {
        Router::middleware(['auth.admin'], function () {
            Router::get('stats', \Controller\Stats::class);
        });
    });

    // group() dentro de group(): soma caminho e middleware dos dois níveis
    Router::group('reports', ['log.access'], function () {
        Router::get('daily', \Controller\ReportDaily::class);
    });
});
```

Resultado, testado ao vivo (rota, middlewares finais):

```php
// api/ping                => ['cors']
// api/users               => ['cors', 'auth.token']
// api/users/[#id]         => ['cors', 'auth.token', 'throttle']
// api/admin/stats         => ['cors', 'auth.admin']
// api/reports/daily       => ['cors', 'log.access']
```

Captura livre com `...`:

```php
Router::get('blog', \Controller\Blog::class);     // casa só '/blog'
Router::get('blog...', \Controller\Blog::class);  // casa '/blog' e qualquer coisa depois
```

O dado da requisição é injetado pelo nome do parâmetro, não pela posição:

```php
class User
{
    function show($id)
    {
        // $id já vem preenchido com o valor de [#id] na URL
    }
}
```

Lista todas as rotas registradas, do projeto e de pacotes instalados:

```bash
php mx helper.router
```

## Considerações

`add()` e `full()` só chamam os métodos individuais por baixo, `get`/`post` ou `get`/`post`/`put`/`delete`, na mesma ordem. Não existe comportamento extra além disso.

`group($path, $middlewares, $wrapper)` é literalmente `path($path, fn() => middleware($middlewares, $wrapper))` por dentro, não tem lógica própria além de combinar os dois.

Dentro de `path()`/`middleware()`/`group()` aninhados, os efeitos acumulam: o caminho final é a concatenação de todos os prefixos ativos, e a lista de middlewares final é sempre `[..middlewares herdados de fora pra dentro, ..middleware próprio da rota]`, nessa ordem. Uma rota declarada fora de qualquer `path`/`middleware`/`group` não herda nada deles.

O parâmetro do controller é injetado pelo nome do parâmetro (via Reflection), não pela posição. Se o método espera `$id`, o nome tem que bater com o `[#id]` da rota.

Ordem de declaração das rotas quase nunca importa: elas são reorganizadas automaticamente por especificidade antes de resolver a requisição. Só importa quando duas rotas realmente colidem no mesmo padrão, aí a mais específica ganha.

Pacotes instalados também podem ter seu próprio `system/router`. Se o projeto declarar o mesmo template que um pacote, a rota do projeto sobrescreve a dele.

Fora de modo `DEV`, as rotas escaneadas ficam em cache (`library/cache/routes.json`), evitando reescanear os arquivos a cada requisição. Em `DEV` o cache é sempre ignorado.
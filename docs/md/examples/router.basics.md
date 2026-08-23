[← Examples](../examples.md) · [← Index](../../index.md)

# Router

`Router` é estático, como quase tudo no framework. Ele guarda as rotas declaradas, resolve qual delas corresponde à requisição atual e executa a fila de middlewares e o controller.

## Declarando rotas

Basta criar um arquivo em `system/router`, qualquer nome, e você pode ter quantos arquivos quiser, organizados como preferir.

```php
use PhpMx\Router;

Router::get('users/[#id]', [\Controller\User::class, 'show']);
Router::post('users', \Controller\User::class);
Router::full('health', STS_OK);
```

`get`, `post`, `put` e `delete` registram pra um método HTTP só. `full()` é atalho pra registrar os quatro de uma vez.

Pelo terminal, `make.route` cria a rota direto em `system/router/autorouter.php` e ainda pergunta se você quer gerar o controller junto:

```bash
php mx make.route get "users/[#id]" User.show
```

## Middlewares

Direto na rota (terceiro argumento) ou em grupo com `Router::group()`/`Router::middleware()`.

## Parâmetros injetados por nome

O dado da requisição (rota, query, body) é passado pro controller **por nome de parâmetro**. Se o método precisa de um `id`, basta declarar `$id`:

```php
class User
{
    function show($id)
    {
        // $id já vem preenchido com o valor de [#id] na URL
    }
}
```

## Ordem não importa (quase nunca)

As rotas são organizadas automaticamente por especificidade: a ordem em que você declara não afeta qual rota casa com qual URL, exceto quando duas rotas realmente se sobrepõem (aí a mais específica ganha).

## Pacotes também declaram rotas

Qualquer pacote instalado pode ter seu próprio `system/router`. Rotas do seu projeto têm prioridade: se o seu projeto declarar o mesmo template de rota que um pacote, a sua sobrescreve a dele. Veja todas as rotas registradas (do projeto e dos pacotes) com:

```bash
php mx helper.router
```

## Cache em produção

Fora de modo `DEV`, as rotas escaneadas ficam em cache num JSON (`library/cache/routes.json`), evitando reescanear todos os arquivos de rota a cada requisição. Em `DEV`, o cache é ignorado e as rotas são sempre escaneadas de novo. O script de deploy deste projeto já limpa `library/cache` a cada deploy.

## Captura livre com `...`

```php
Router::get('blog', \Controller\Blog::class);       // casa só '/blog'
Router::get('blog...', \Controller\Blog::class);     // casa '/blog' e qualquer coisa depois
```
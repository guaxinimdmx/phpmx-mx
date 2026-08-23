[← Examples](../examples.md) · [← Index](../../index.md)

# Criando um middleware customizado

Um middleware fica em `system/middleware/`. Crie um com:

```bash
php mx make.middleware nome
```

Use ponto pra organizar em subpastas: `php mx make.middleware auth.token` cria `system/middleware/auth/token.php`.

## Estrutura

O arquivo retorna uma classe anônima com `__invoke(Closure $next)`. É uma classe normal: pode ter outros métodos e propriedades além do `__invoke`.

```php
<?php

use PhpMx\Request;

return new class {

    function __invoke(Closure $next)
    {
        if (!Request::header('Authorization'))
            throw new Exception('unauthorized', STS_UNAUTHORIZED);

        return $next();
    }
};
```

## `$next` não é automático

`$next` continua a fila: pro próximo middleware, ou pra rota em si, se for o último. Chamar `$next()` **não é automático**: se o middleware não chamar e não retornar nada, a cadeia para exatamente ali. A rota nunca roda, e quem chamou recebe `null` como resposta.

É assim que um middleware barra a requisição de propósito, como no exemplo acima, que lança uma `Exception` e nem chega a chamar `$next()`.

## Usando o middleware

Numa rota específica ou grupo de rotas (veja `router.basics`):

```php
Router::get('perfil', \Controller\Profile::class, ['auth.token']);
```

Globalmente, em `index.php`, na chamada de `Router::solve()`:

```php
Router::solve(['cors', 'encaps']);
```
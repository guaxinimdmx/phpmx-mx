# Controlando a resposta HTTP com Response

`Response` é estático: existe uma única resposta por requisição em todo o projeto. Isso foge do padrão comum (PSR tende a usar objetos, não estado estático), mas funciona bem aqui porque o PHP já isola cada requisição no seu próprio processo: o estado estático nunca vaza entre requisições.

## Montando a resposta

```php
use PhpMx\Response;

Response::status(STS_OK);
Response::header('X-Custom', 'valor');
Response::content(['ok' => true]);
```

`status()` aceita as constantes `STS_*` ou um número direto, são a mesma coisa. `header()` define um cabeçalho (ou vários, passando um array associativo). `content()` define o corpo da resposta.

## Enviando

```php
Response::send();
```

`send()` envia a resposta e **mata o processo na hora**. Qualquer middleware que estivesse esperando o retorno de `$next()` pra continuar processando nunca chega a rodar essa parte: a cadeia é interrompida ali.

## O middleware encaps

O `encaps` já vem registrado por padrão (globalmente, em `index.php`). Com ele, normalmente você não precisa chamar `Response` manualmente:

- Qualquer `Throwable` lançado dentro de um controller é capturado e vira o status HTTP correto automaticamente (o código da exception, ou `400`/`500` como padrão).
- O retorno do controller (array, string, o que for) é padronizado num envelope `{ "info": {...}, "data": ... }`, e o tipo de conteúdo já sai como JSON.

Na maioria dos casos, o controller só precisa `return` o dado ou `throw` uma `Exception`. O `encaps` cuida do resto.

[← Examples](../examples.md) · [← Index](../../index.md)

# Validando input com Input

`Input` valida e sanitiza os dados da requisição (query, body, rota). Cada campo é configurado com regras, então o valor final sai com `->get()` (um campo por vez) ou `->data()` (todos os campos configurados de uma vez, como no exemplo abaixo).

```php
use PhpMx\Input;

class UserStore
{
    function __invoke()
    {
        $input = new Input();

        $input->field('name')->required(true, 'Informe o nome');

        $input->field('email', 'E-mail')
            ->validate(FILTER_VALIDATE_EMAIL, 'E-mail inválido')
            ->sanitize(FILTER_SANITIZE_EMAIL);

        $input->fieldBool('active', default: true);

        $input->field('bio')->required(false);

        return $input->data();
    }
}
```

## Proteção contra XSS por padrão

Todo campo rejeita automaticamente valores com tag HTML, mesmo sem chamar nada explicitamente. `$input->field('site')->get()` já lança exceção se o valor vier como `<b>oi</b>`. Pra desligar (quando o campo realmente precisa aceitar HTML), use `->preventTag(false)`.

## Validar acontece antes de sanitizar

`validate()` roda sobre o valor **bruto**, antes de qualquer `sanitize()`. Um e-mail com espaço nas pontas (`" nome@x.com "`) falha em `FILTER_VALIDATE_EMAIL` mesmo que o `sanitize(FILTER_SANITIZE_EMAIL)` fosse limpar isso depois: a ordem de checagem é sempre validar primeiro, sanitizar depois, nessa sequência fixa.

## Erros já vêm prontos pro encaps

Quando uma regra falha, o campo lança a exceção sozinho, com status HTTP e corpo já formatados: `{"field": "email", "message": "..."}`. O middleware `encaps` (veja `response.basics`) reconhece esse formato e devolve exatamente essa estrutura pro cliente. O controller não precisa tratar validação manualmente, só declarar as regras.

## Mensagens padrão

As mensagens de erro automáticas já vêm prontas (`O campo [#name] precisa ser um email`, etc), configuráveis globalmente com `InputMessage::set()`.

## Só os campos recebidos

`->data()` devolve todos os campos configurados, mesmo os que vieram vazios ou só no default. `->dataReceived()` devolve só os que realmente vieram na requisição, útil pra update parcial onde ausência de campo deve significar "não mexe nisso".
<?php

use PhpMx\Response;
use PhpMx\Snap;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Response */
return new class {

    use TerminalTestTrait;

    function run()
    {
        Snap::capture('response', Response::class);

        // status
        Response::status(200);
        $this->isEqual('status: define', fn() => Response::getStatus(), 200);

        Response::status(404, false);
        $this->isEqual('status: replace false mantém', fn() => Response::getStatus(), 200);

        Response::status(null);
        Response::status(404, false);
        $this->isEqual('status: replace false define quando null', fn() => Response::getStatus(), 404);

        Response::status(999);
        $this->isNull('status: código inválido retorna null', fn() => Response::getStatus());

        // content
        Response::content('hello');
        $this->isEqual('content: define', fn() => Response::getContent(), 'hello');

        Response::content('world', false);
        $this->isEqual('content: replace false mantém', fn() => Response::getContent(), 'hello');

        Response::content(null);
        Response::content('world', false);
        $this->isEqual('content: replace false define quando null', fn() => Response::getContent(), 'world');

        // type: converte extensão para mime
        Response::type('jpg');
        $this->isTrue('type: extensão vira mime', fn() => Response::checkType('image/jpeg'));

        Response::type('png', false);
        $this->isTrue('type: replace false mantém', fn() => Response::checkType('image/jpeg'));

        Response::type('html');
        $this->isTrue('type: checkType via extensão', fn() => Response::checkType('html'));
        $this->isFalse('type: checkType errado', fn() => Response::checkType('image/png'));

        // header
        Response::header('X-Foo', 'bar');
        Response::header(['X-A' => '1', 'X-B' => '2']);
        $this->isTrue('header: individual', fn() => true); // sem getter, só não pode lançar

        // cache
        Response::cache('+1 hour');
        $this->isTrue('cache: string aceita', fn() => true);

        Response::cache(false);
        $this->isTrue('cache: false aceita', fn() => true);

        // download
        Response::download(true);
        $this->isTrue('download: bool true', fn() => true);

        Response::download('relatorio.pdf');
        $this->isTrue('download: string define nome', fn() => true);

        Response::download(false);
        $this->isTrue('download: false desativa', fn() => true);

        Snap::restore('response');

        // após restore
        $this->isNull('restore: status limpo', fn() => Response::getStatus());
        $this->isNull('restore: content limpo', fn() => Response::getContent());
    }
};

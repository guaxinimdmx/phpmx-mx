<?php

use PhpMx\View;
use PhpMx\Snap;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe View */
return new class {

    use TerminalTestTrait;

    function run()
    {
        Snap::capture('view', View::class);

        // renderString: aplica prepare sobre o conteúdo
        $this->isEqual('renderString: substitui tag', fn() => View::renderString('Olá [#name]', ['name' => 'mundo']), 'Olá mundo');
        $this->isEqual('renderString: sem dados mantém texto', fn() => View::renderString('texto'), 'texto');
        $this->isEqual('renderString: tag ausente mantida', fn() => View::renderString('[#nao_existe]'), '[#nao_existe]');
        $this->isEqual('renderString: dados como string vira CONTENT', fn() => View::renderString('[#CONTENT]', 'valor'), 'valor');

        // globalPrepare: tag disponível em todas as renderStrings
        View::globalPrepare('_TEST_VIEW_APP', 'PhpMx');
        $this->isEqual('globalPrepare: disponível em renderString', fn() => View::renderString('[#_TEST_VIEW_APP]'), 'PhpMx');

        // globalPrepare com closure
        View::globalPrepare('_TEST_VIEW_NOW', fn() => 'agora');
        $this->isEqual('globalPrepare: closure executada', fn() => View::renderString('[#_TEST_VIEW_NOW]'), 'agora');

        // global vence dado local
        View::globalPrepare('_TEST_VIEW_KEY', 'global');
        $this->isEqual('globalPrepare: global vence dado local', fn() => View::renderString('[#_TEST_VIEW_KEY]', ['_TEST_VIEW_KEY' => 'local']), 'global');

        // mediaStyle: aceita definição sem lançar
        $this->isNotThrow('mediaStyle: aceita definição', fn() => View::mediaStyle('mobile', 'max-width: 768px'));

        Snap::restore('view');

        // após restore, globalPrepare limpo
        $this->isNotEqual('restore: global prepare limpo', fn() => View::renderString('[#_TEST_VIEW_APP]'), 'PhpMx');
    }
};

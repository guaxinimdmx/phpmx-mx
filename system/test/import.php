<?php

use PhpMx\Dir;
use PhpMx\File;
use PhpMx\Import;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Import */
return new class {

    use TerminalTestTrait;

    function run()
    {
        $dir = 'library/tmp/test_import';
        Dir::create($dir);

        // arquivos temporários para os testes
        File::create("$dir/only.php",    '<?php',                    true);
        File::create("$dir/content.php", 'Olá [#nome]',              true);
        File::create("$dir/return.php",  '<?php return 42;',          true);
        File::create("$dir/var.php",     '<?php $resultado = "achei";', true);
        File::create("$dir/output.php",  '<?php echo "saida";',       true);

        // only: carrega o arquivo sem retornar conteúdo relevante (retorna 1 ou true)
        $this->isNotThrow('only: arquivo existente não lança', fn() => Import::only("$dir/only"));
        $this->isFalse('only: arquivo inexistente retorna false', fn() => Import::only("$dir/nao_existe"));

        // content: lê conteúdo com prepare
        $this->isEqual('content: lê texto', fn() => Import::content("$dir/content.php"), 'Olá [#nome]');
        $this->isEqual('content: com prepare', fn() => Import::content("$dir/content.php", ['nome' => 'PhpMx']), 'Olá PhpMx');
        $this->isEqual('content: arquivo inexistente retorna vazio', fn() => Import::content("$dir/nao_existe.php"), '');

        // return: obtém o valor retornado pelo arquivo
        $this->isEqual('return: valor do return', fn() => Import::return("$dir/return"), 42);
        $this->isNull('return: arquivo inexistente retorna null', fn() => Import::return("$dir/nao_existe"));

        // var: extrai variável específica do arquivo
        $this->isEqual('var: variável existente', fn() => Import::var("$dir/var", 'resultado'), 'achei');
        $this->isNull('var: variável inexistente', fn() => Import::var("$dir/var", 'nao_existe'));
        $this->isNull('var: arquivo inexistente', fn() => Import::var("$dir/nao_existe", 'resultado'));

        // output: captura o echo do arquivo
        $this->isEqual('output: captura echo', fn() => Import::output("$dir/output.php"), 'saida');
        $this->isEqual('output: arquivo inexistente retorna vazio', fn() => Import::output("$dir/nao_existe.php"), '');

        Dir::remove($dir);
    }
};

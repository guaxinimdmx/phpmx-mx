<?php

use PhpMx\Prepare;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Prepare e o helper prepare() */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // helper prepare(): substituição sequencial [#]
        $this->isEqual('sequencial simples', fn() => prepare('Olá [#]', ['mundo']), 'Olá mundo');
        $this->isEqual('sequencial múltiplo', fn() => prepare('[#] e [#]', ['A', 'B']), 'A e B');

        // helper prepare(): referência por chave [#key]
        $this->isEqual('referência por chave', fn() => prepare('Olá [#nome]', ['nome' => 'PhpMx']), 'Olá PhpMx');

        // helper prepare(): dot notation [#obj.key]
        $this->isEqual('dot notation', fn() => prepare('[#user.name]', ['user' => ['name' => 'Ricardo']]), 'Ricardo');

        // helper prepare(): closure [#fn:param]
        $this->isEqual('closure com parâmetro', fn() => prepare('[#fn:hello]', ['fn' => fn($v) => strtoupper($v)]), 'HELLO');

        // helper prepare(): sem dados
        $this->isEqual('sem prepare', fn() => prepare('texto puro'), 'texto puro');
        $this->isEqual('null retorna vazio', fn() => prepare(null), '');
        $this->isEqual('tag inexistente mantida', fn() => prepare('[#inexistente]', ['outro' => 'x']), '[#inexistente]');

        // Prepare::tags(): extrai as tags de uma string
        $this->isEqual('tags: extrai tags', fn() => Prepare::tags('[#name] e [#age]'), ['name', 'age']);
        $this->isEqual('tags: sem tags retorna vazio', fn() => Prepare::tags('texto simples'), []);
        $this->isEqual('tags: tag duplicada conta uma vez', fn() => Prepare::tags('[#a] [#a]'), ['a']);

        // Prepare::keys(): retorna as chaves de um array de prepare
        $this->isTrue('keys: chave simples', fn() => in_array('name', Prepare::keys(['name' => 'x'])));
        $this->isTrue('keys: dot notation de subarray', fn() => in_array('data.sub', Prepare::keys(['data' => ['sub' => 'y']])));

        // Prepare::scape(): escapa tags
        $this->isEqual('scape: escapa [#]', fn() => Prepare::scape('[#name]'), '[&#35name]');
        $this->isEqual('scape: sem tags mantém', fn() => Prepare::scape('texto'), 'texto');

        $scaped = Prepare::scape('[#name]');
        $this->isEqual('scape: escapado não é processado', fn() => prepare($scaped, ['name' => 'joao']), $scaped);

        $result = Prepare::scape('[#name] [#age]', ['name' => '']);
        $this->isTrue('scape: com array escapa chave informada', fn() => str_contains($result, '[&#35name]'));
        $this->isTrue('scape: com array mantém outras tags', fn() => str_contains($result, '[#age]'));
    }
};

<?php

use PhpMx\Json;
use PhpMx\File;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Json */
return new class {

    use TerminalTestTrait;

    const TMP = 'library/tmp/test_json';

    function run()
    {
        $this->isTrue('export: cria arquivo', function () {
            Json::export(self::TMP, ['a' => 1]);
            return File::check(self::TMP . '.json');
        });

        $this->isEqual('import: lê dados corretos', fn() => Json::import(self::TMP), ['a' => 1]);

        $this->isTrue('export: merge adiciona chaves', function () {
            Json::export(self::TMP, ['b' => 2], true);
            $data = Json::import(self::TMP);
            return ($data['a'] ?? null) === 1 && ($data['b'] ?? null) === 2;
        });

        $this->isTrue('export: sem merge sobrescreve', function () {
            Json::export(self::TMP, ['c' => 3]);
            $data = Json::import(self::TMP);
            return !isset($data['a']) && ($data['c'] ?? null) === 3;
        });

        $this->isNull('import: arquivo inexistente retorna null ou vazio', fn() => Json::import('library/tmp/nao_existe') ?: null);

        // limpeza
        File::remove(self::TMP . '.json');
    }
};

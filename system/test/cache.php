<?php

use PhpMx\Trait\TerminalTestTrait;

/** Testa os helpers cache e cacheTime */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // sem USE_CACHE_FILE, executa a action diretamente
        $this->isEqual('cache: retorna resultado da action', fn() => cache('_test_cache', fn() => 42), 42);
        $this->isEqual('cache: string', fn() => cache('_test_cache_str', fn() => 'ok'), 'ok');
        $this->isEqual('cache: array', fn() => cache('_test_cache_arr', fn() => [1, 2, 3]), [1, 2, 3]);
        $this->isNull('cache: null', fn() => cache('_test_cache_null', fn() => null));

        // action que lança exception re-lança
        $this->isThrow('cache: re-lança exception da action', fn() => cache('_test_cache_ex', fn() => throw new \Exception('falha')));

        // cacheTime: sem USE_CACHE_FILE, executa a action diretamente
        $this->isEqual('cacheTime: retorna resultado', fn() => cacheTime('_test_cache_time', 60, fn() => 'valor'), 'valor');
        $this->isThrow('cacheTime: re-lança exception', fn() => cacheTime('_test_cache_time_ex', 60, fn() => throw new \Exception('falha')));
    }
};

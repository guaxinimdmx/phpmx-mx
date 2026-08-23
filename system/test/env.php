<?php

use PhpMx\Env;
use PhpMx\File;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Env */
return new class {

    use TerminalTestTrait;

    const TMP_ENV = 'library/tmp/test_env.env';

    function run()
    {
        // set / get
        Env::set('_TEST_ENV_STR', 'hello');
        $this->isEqual('set/get: string', fn() => Env::get('_TEST_ENV_STR'), 'hello');

        Env::set('_TEST_ENV_INT', '42');
        $this->isEqual('set/get: inteiro', fn() => Env::get('_TEST_ENV_INT'), 42);

        Env::set('_TEST_ENV_BOOL', 'true');
        $this->isTrue('set/get: bool true', fn() => Env::get('_TEST_ENV_BOOL') === true);

        // set não sobrescreve existente
        Env::set('_TEST_ENV_LOCK', 'primeiro');
        Env::set('_TEST_ENV_LOCK', 'segundo');
        $this->isEqual('set: não sobrescreve existente', fn() => Env::get('_TEST_ENV_LOCK'), 'primeiro');

        // get variável não definida
        $this->isNull('get: não definida', fn() => Env::get('_TEST_ENV_NAO_EXISTE_XYZ'));

        // default
        Env::default('_TEST_ENV_DEFAULT', 'padrao');
        $this->isEqual('default: retorna padrão', fn() => Env::get('_TEST_ENV_DEFAULT'), 'padrao');

        Env::set('_TEST_ENV_DEFAULT', 'definido');
        $this->isEqual('default: definida prevalece', fn() => Env::get('_TEST_ENV_DEFAULT'), 'definido');

        // loadFile
        File::create(self::TMP_ENV, "_TEST_ENV_FILE_A=valor_a\n_TEST_ENV_FILE_B=123\n# comentario\n", true);
        Env::loadFile(self::TMP_ENV);
        $this->isEqual('loadFile: string', fn() => Env::get('_TEST_ENV_FILE_A'), 'valor_a');
        $this->isEqual('loadFile: inteiro', fn() => Env::get('_TEST_ENV_FILE_B'), 123);
        $this->isFalse('loadFile: arquivo inexistente', fn() => Env::loadFile('library/tmp/nao_existe.env'));

        // limpeza
        File::remove(self::TMP_ENV);
    }
};

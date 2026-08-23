<?php

use PhpMx\Dir;
use PhpMx\File;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Dir */
return new class {

    use TerminalTestTrait;

    const TMP = 'library/tmp/test_dir';
    const TMP_COPY = 'library/tmp/test_dir_copy';

    function run()
    {
        // create / check
        $this->isTrue('create: cria diretório', fn() => Dir::create(self::TMP) === true);
        $this->isTrue('check: existe', fn() => Dir::check(self::TMP));
        $this->isNull('create: não recria existente', fn() => Dir::create(self::TMP));

        // seekForFile / seekForDir
        File::create(self::TMP . '/a.txt', 'a');
        File::create(self::TMP . '/sub/b.txt', 'b');

        $this->isTrue('seekForFile: lista arquivos', fn() => in_array('a.txt', Dir::seekForFile(self::TMP)));
        $this->isFalse('seekForFile: não recursivo ignora sub', fn() => in_array('sub/b.txt', Dir::seekForFile(self::TMP)));
        $this->isTrue('seekForFile: recursivo encontra sub', fn() => in_array('sub/b.txt', Dir::seekForFile(self::TMP, true)));
        $this->isTrue('seekForDir: encontra subdir', fn() => in_array('sub', Dir::seekForDir(self::TMP)));

        // copy
        $this->isTrue('copy: copia diretório', fn() => Dir::copy(self::TMP, self::TMP_COPY) === true);
        $this->isTrue('copy: destino existe', fn() => Dir::check(self::TMP_COPY));
        $this->isTrue('copy: arquivos copiados', fn() => File::check(self::TMP_COPY . '/a.txt'));

        // remove
        $this->isTrue('remove: remove com conteúdo', fn() => Dir::remove(self::TMP, true) === true);
        $this->isFalse('check: não existe mais', fn() => Dir::check(self::TMP));
        $this->isNull('remove: diretório inexistente', fn() => Dir::remove(self::TMP));

        // limpeza
        Dir::remove(self::TMP_COPY, true);
    }
};

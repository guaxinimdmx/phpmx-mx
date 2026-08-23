<?php

use PhpMx\Path;
use PhpMx\File;
use PhpMx\Dir;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Path */
return new class {

    use TerminalTestTrait;

    const TMP = 'library/tmp/test_path';

    function run()
    {
        // format
        $this->isEqual('format: segmento único', fn() => Path::format('a/b/c'), 'a/b/c');
        $this->isEqual('format: múltiplos segmentos', fn() => Path::format('a', 'b', 'c'), 'a/b/c');
        $this->isEqual('format: normaliza barras duplas', fn() => Path::format('a//b'), 'a/b');
        $this->isEqual('format: barra invertida', fn() => Path::format('a\\b'), 'a/b');
        $this->isEqual('format: remove barra inicial', fn() => Path::format('/a/b'), 'a/b');

        // origin
        $this->isEqual('origin: projeto atual', fn() => Path::origin('system/test'), 'current-project');
        $this->isEqual('origin: vendor', fn() => Path::origin('vendor/phpMx/core/class'), 'phpmx-core');

        // register / seek
        Dir::create(self::TMP . '/subdir');
        File::create(self::TMP . '/seek.txt', 'x');
        Path::register(self::TMP);

        $this->isEqual('seekForFile: encontra', fn() => Path::seekForFile('seek.txt'), self::TMP . '/seek.txt');
        $this->isNull('seekForFile: não existe', fn() => Path::seekForFile('nao_existe_xyz.txt'));
        $this->isTrue('seekForFiles: retorna array com resultado', fn() => in_array(self::TMP . '/seek.txt', Path::seekForFiles('seek.txt')));

        $this->isEqual('seekForDir: encontra', fn() => Path::seekForDir('subdir'), self::TMP . '/subdir');
        $this->isNull('seekForDir: não existe', fn() => Path::seekForDir('nao_existe_xyz'));
        $this->isTrue('seekForDirs: retorna array com resultado', fn() => in_array(self::TMP . '/subdir', Path::seekForDirs('subdir')));

        // limpeza
        Dir::remove(self::TMP, true);
    }
};

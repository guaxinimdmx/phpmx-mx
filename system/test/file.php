<?php

use PhpMx\File;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe File */
return new class {

    use TerminalTestTrait;

    const TMP = 'library/tmp/test_file.txt';
    const TMP_COPY = 'library/tmp/test_file_copy.txt';
    const TMP_MOVE = 'library/tmp/test_file_move.txt';

    function run()
    {
        // getEx / getName / setEx (sem I/O)
        $this->isEqual('getEx', fn() => File::getEx('pasta/arquivo.TXT'), 'txt');
        $this->isEqual('getName', fn() => File::getName('pasta/arquivo.txt'), 'arquivo');
        $this->isEqual('setEx: troca extensão', fn() => File::setEx('arquivo.php', 'txt'), 'arquivo.txt');
        $this->isEqual('setEx: adiciona extensão', fn() => File::setEx('arquivo', 'php'), 'arquivo.php');
        $this->isEqual('setEx: não duplica', fn() => File::setEx('arquivo.php', 'php'), 'arquivo.php');
        $this->isEqual('setEx: não confunde ponto de pasta oculta com extensão', fn() => File::setEx('.autodoc/autodoc', 'json'), '.autodoc/autodoc.json');
        $this->isEqual('setEx: pasta oculta com extensão já presente', fn() => File::setEx('.autodoc/autodoc.md', 'md'), '.autodoc/autodoc.md');

        // create / check
        $this->isTrue('create: cria arquivo', fn() => File::create(self::TMP, 'conteúdo') === true);
        $this->isTrue('check: existe', fn() => File::check(self::TMP));
        $this->isNull('create: não recria sem flag', fn() => File::create(self::TMP, 'novo'));
        $this->isTrue('create: recria com flag', fn() => File::create(self::TMP, 'atualizado', true) === true);

        // copy
        $this->isTrue('copy: copia arquivo', fn() => File::copy(self::TMP, self::TMP_COPY) === true);
        $this->isTrue('copy: destino existe', fn() => File::check(self::TMP_COPY));
        $this->isNull('copy: não substitui sem flag', fn() => File::copy(self::TMP, self::TMP_COPY));

        // move
        $this->isTrue('move: move arquivo', fn() => File::move(self::TMP_COPY, self::TMP_MOVE) === true);
        $this->isTrue('move: destino existe', fn() => File::check(self::TMP_MOVE));
        $this->isFalse('move: origem sumiu', fn() => File::check(self::TMP_COPY));

        // remove
        $this->isTrue('remove: remove arquivo', fn() => File::remove(self::TMP) === true);
        $this->isFalse('check: não existe mais', fn() => File::check(self::TMP));
        $this->isNull('remove: arquivo inexistente', fn() => File::remove(self::TMP));

        // limpeza
        File::remove(self::TMP_MOVE);
    }
};

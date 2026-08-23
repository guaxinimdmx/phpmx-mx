<?php

use PhpMx\Dir;
use PhpMx\Reflection\ReflectionCommandFile;
use PhpMx\Terminal;
use PhpMx\Trait\TerminalHelperTrait;

/**
 * Lista e todos os comandos disponíveis no terminal.
 * @param string $filter Nome ou parte do nome de um comando para filtrar a busca.
 */
return new class {

    use TerminalHelperTrait;

    function __invoke(?string $filter = null)
    {
        $this->handle(
            'system/terminal',
            $filter,
            function ($item) {
                Terminal::echol('   [#c:p,#name] [#c:sd,#_file][#c:sd,:][#c:sd,#_line]', $item);
                foreach ($item['description'] ?? [] as $description)
                    Terminal::echol("      $description");
                foreach ($item['variations'] as $variation)
                    Terminal::echol('         [#c:dd,php] mx [#] [#c:dd,#]', [$item['name'], $variation]);
            }
        );
    }

    protected function scan(string $path)
    {
        $items = [];
        foreach (Dir::seekForFile($path, true) as $item) {
            $scheme = ReflectionCommandFile::scheme(path($path, $item));
            if (!empty($scheme)) {
                $scheme['variations'] = ReflectionCommandFile::variations($scheme['params'] ?? []);
                $items[] = $scheme;
            }
        }

        return $items;
    }
};

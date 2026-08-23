<?php

use PhpMx\Dir;
use PhpMx\Import;
use PhpMx\Terminal;
use PhpMx\Trait\TerminalHelperTrait;

/**
 * Lista todos os arquivos de exemplo do projeto.
 * @param string $filter Parte do nome do arquivo para filtrar a busca.
 */
return new class {

    use TerminalHelperTrait;

    function __invoke(?string $filter = null)
    {
        $show = function ($item) {
            Terminal::echol('   [#c:p,#name] [#c:sd,#_file]', $item);
            Terminal::echol('      [#]', $item['title']);
        };

        $this->handle(
            'library/example',
            $filter,
            $show,
            $show,
        );
    }

    protected function scan(string $path): array
    {
        $items = [];

        foreach (Dir::seekForFile($path, true) as $item) {
            $file = path($path, $item);

            $name = explode('library/example/', str_replace('\\', '/', $file));
            $name = substr(array_pop($name), 0, -3);
            $name = str_replace('/', '.', $name);

            $title = strtok(Import::content($file), "\n") ?: '';
            $title = trim(ltrim(trim($title), '# '));

            $items[] = [
                '_key' => md5("example:$name"),
                'name' => $name,
                'title' => $title,
                '_file' => $file,
            ];
        }

        return $items;
    }
};

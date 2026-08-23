<?php

use PhpMx\Dir;
use PhpMx\File;
use PhpMx\Reflection\ReflectionTestFile;
use PhpMx\Terminal;

/**
 * Lista todos os arquivos de teste disponíveis em system/test
 * @param string $filter Nome ou parte do nome do teste para filtrar a busca.
 */
return new class {

    function __invoke(string $filter = '')
    {
        $found = false;

        foreach (Dir::seekForFile('system/test', true) as $file) {
            $path = path('system/test', $file);

            if (File::getEx($path) !== 'php') continue;

            $scheme = ReflectionTestFile::scheme($path);

            if (empty($scheme)) continue;
            if ($filter && $scheme['name'] !== $filter && !str_starts_with($scheme['name'], "$filter.")) continue;

            $found = true;

            Terminal::echol('   [#c:p,#name] [#c:sd,#_file][#c:sd,:][#c:sd,#_line]', $scheme);

            foreach ($scheme['description'] ?? [] as $description)
                Terminal::echol("      $description");

            Terminal::echol('         [#c:dd,php] mx test [#]', [$scheme['name']]);
            Terminal::echol();
        }

        if (!$found) Terminal::echol('[#c:dd,- empty -]');
    }
};

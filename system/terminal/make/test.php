<?php

use PhpMx\File;
use PhpMx\Import;
use PhpMx\Path;
use PhpMx\Terminal;

/**
 * Cria um novo arquivo de teste em system/test
 * @param string $test Nome do teste a ser criado.
 */
return new class {

    function __invoke(string $test)
    {
        $test = remove_accents($test);
        $test = strtolower($test);

        $file = explode('.', $test);
        $file = array_map(fn($v) => strtolower($v), $file);
        $file = path('system/test', ...$file);
        $file = File::setEx($file, 'php');

        if (File::check($file))
            throw new Exception("Test [$test] already exists in project");

        $template = Path::seekForFile('library/template/terminal/test.txt');
        $template = Import::content($template, ['test' => $test]);

        File::create($file, $template);

        Terminal::echol("File [#c:p,#] created successfully", $file);
        Terminal::echol();
        Terminal::echol("   [#c:s,php mx] [#c:s,test] [#c:s,#]", [$test]);
    }
};

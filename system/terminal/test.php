<?php

use PhpMx\Dir;
use PhpMx\File;
use PhpMx\Import;
use PhpMx\Terminal;

/** Executa todos os arquivos de teste em system/test e exibe o resultado consolidado. */
return new class {

    /**
     * @param string $filter Nome parcial do arquivo de teste para filtrar a execução
     */
    function __invoke(string $filter = '')
    {
        $suites = ['total' => 0, 'passed' => 0, 'failed' => 0, 'error' => 0];
        $tests = ['successes' => 0, 'fails' => 0];

        $found = false;

        foreach (Dir::seekForFile('system/test', true) as $relative) {
            $testFile = path('system/test', $relative);
            if (File::getEx($testFile) == 'php') {
                $name = rtrim(str_replace(['/', '\\'], '.', File::setEx($relative, '')), '.');
                if ($filter && $name !== $filter && !str_starts_with($name, "$filter.")) continue;
                $found = true;
                Terminal::echol('[#c:p,#] [#c:dd,#]', [$name, $testFile]);
                $runner = Import::return($testFile);
                list($successes, $fails, $error) = $runner();

                $suites['total']++;

                if ($error) {
                    $suites['error']++;
                    continue;
                }

                $fails ? $suites['failed']++ : $suites['passed']++;

                $tests['successes'] += $successes;
                $tests['fails'] += $fails;
            }
        }

        if (!$found && $filter) throw new Exception("Test [$filter] not found");

        Terminal::echol(
            'Suites: [#c:p,#] total, [#c:s,#] passed, [#c:w,#] failed, [#c:e,#] error',
            [$suites['total'], $suites['passed'], $suites['failed'], $suites['error']]
        );
        Terminal::echol(
            'Tests:  [#c:p,#] total, [#c:s,#] passed, [#c:w,#] failed',
            [$tests['successes'] + $tests['fails'], $tests['successes'], $tests['fails']]
        );

        if ($tests['fails'] || $suites['error']) return false;
    }
};

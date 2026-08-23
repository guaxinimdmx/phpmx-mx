<?php

use PhpMx\File;
use PhpMx\Terminal;

/**
 * Gera um novo arquivo de exemplo em library/example.
 * @param string $name Nome do exemplo, use pontos para subpastas (ex: router.basicRoutes).
 */
return new class {

    function __invoke(string $name)
    {
        $name = remove_accents($name);

        $parts = explode('.', $name);
        $parts = array_map(fn($v) => strToCamelCase($v), $parts);

        $file = path('library/example', ...$parts);
        $file = File::setEx($file, 'md');

        if (File::check($file))
            throw new Exception("Example [$name] already exists in project");

        $content = implode("\n", [
            "# $name",
            '',
            'Descreva aqui o que este exemplo demonstra.',
            '',
        ]);

        File::create($file, $content);

        Terminal::echol("File [#c:p,#] created successfully", $file);
    }
};

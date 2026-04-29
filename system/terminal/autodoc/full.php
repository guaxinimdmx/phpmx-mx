<?php

use PhpMx\Terminal;

/** Cria a documentação de API, banco de dados e desenvolvimento do projeto atual */
return new class {

    function __invoke()
    {
        Terminal::echol('[#c:pb,API]');
        Terminal::run('autodoc.api');
        Terminal::echol();
        Terminal::echol('[#c:pb,DATABASE]');
        Terminal::run('autodoc.database');
        Terminal::echol();
        Terminal::echol('[#c:pb,DEV]');
        Terminal::run('autodoc.dev');
    }
};

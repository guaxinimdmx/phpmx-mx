<?php

use PhpMx\File;
use PhpMx\Terminal;
use PhpMx\Trait\AutodocTrait;
use PhpMx\View;

/** Gera docs/index.html a partir dos dados do projeto */
return new class {

    use AutodocTrait;

    function __invoke()
    {
        $index = View::render('autodoc/html/index', [
            'project' => $this->exportProject(),
        ]);

        File::create('docs/index.html', $index, true);

        Terminal::echol('Exported to [#c:p,#]', 'docs/index.html');
    }

};

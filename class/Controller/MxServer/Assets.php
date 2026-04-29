<?php

namespace Controller\MxServer;

use PhpMx\Path;
use PhpMx\Request;

/** Controller de acesso a arquivos em library/assets */
class Assets
{
    /** Gerencia e serve arquivos estáticos (assets) localizados na biblioteca do framework ou do projeto */
    function __invoke()
    {
        $file = Path::seekForFile('library/assets', ...Request::route());
        \PhpMx\Assets::send($file);
    }
}

<?php

namespace Controller\MxServer;

use PhpMx\Path;
use PhpMx\Request;

/** Controller de download a arquivos em library/download */
class Download
{
    /** Gerencia e força o download de arquivos localizados na pasta de downloads da biblioteca */
    function __invoke()
    {
        $file = Path::seekForFile('library/download', ...Request::route());
        \PhpMx\Assets::download($file);
    }
}

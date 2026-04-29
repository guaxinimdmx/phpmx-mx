<?php

namespace Controller\MxServer;

use PhpMx\Assets;
use PhpMx\File;
use PhpMx\Path;
use PhpMx\Response;

/** Entrega de favicon padrão */
class Favicon
{
    /** Gerencia a entrega do ícone do site buscando primeiro no projeto local e depois no framework */
    function __invoke()
    {
        $file = path('library/assets/favicon.ico');

        if (!File::check($file)) {
            Response::cache(false);
            $file = Path::seekForFile('library/assets/favicon.ico');
        }

        Assets::send($file);
    }
}

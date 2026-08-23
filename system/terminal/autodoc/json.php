<?php

use PhpMx\Json;
use PhpMx\Terminal;
use PhpMx\Trait\AutodocTrait;

/** Exporta a documentação pública do projeto para .autodoc/autodoc.json */
return new class {

    use AutodocTrait;

    function __invoke()
    {
        $doc = array_filter([
            'project' => $this->exportProject(),
            'constants' => $this->exportConstants(),
            'functions' => $this->exportFunctions(),
            'environment' => $this->exportEnvironment(),
            'middleware' => $this->exportMiddleware(),
            'terminal' => $this->exportTerminal(),
            'routes' => $this->exportRoutes(),
            'classes' => $this->exportClasses(),
            'tests' => $this->exportTests(),
            'database' => $this->exportDatabase(),
        ]);

        Json::export('.autodoc/autodoc', $doc);

        Terminal::echol('Exported to [#c:p,#]', '.autodoc/autodoc.json');
    }

};

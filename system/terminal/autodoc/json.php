<?php

use PhpMx\Json;
use PhpMx\Terminal;
use PhpMx\Trait\AutodocTrait;

/** Exporta a documentação pública do projeto para docs/autodoc.json */
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
            'examples' => $this->exportExamples(),
            'database' => $this->exportDatabase(),
        ]);

        Json::export('docs/autodoc', $doc);

        $this->ensureDocLink('README.md', 'docs/autodoc.json', 'Documentação json `docs/autodoc.json`');
        $this->ensureDocLink('CLAUDE.md', 'docs/autodoc.json', 'Documentação json `docs/autodoc.json`', createIfMissing: true);

        Terminal::echol('Exported to [#c:p,#]', 'docs/autodoc.json');
    }

};

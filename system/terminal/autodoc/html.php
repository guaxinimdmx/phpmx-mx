<?php

use PhpMx\Dir;
use PhpMx\File;
use PhpMx\Terminal;
use PhpMx\Trait\AutodocTrait;
use PhpMx\View;

/** Gera docs/index.html e docs/html a partir dos dados do projeto */
return new class {

    use AutodocTrait;

    function __invoke()
    {
        Dir::remove('docs/html', true);

        $project = $this->exportProject();

        $constants = $this->exportConstants();
        $functions = $this->exportFunctions();
        $environment = $this->exportEnvironment();
        $middleware = $this->exportMiddleware();
        $terminal = $this->exportTerminal();
        $routes = $this->exportRoutes();
        $classes = $this->exportClasses();
        $examples = $this->exportExamples();
        $database = $this->exportDatabase();

        $sections = [
            ['label' => 'Constants', 'link' => 'constants.html', 'count' => count($constants)],
            ['label' => 'Functions', 'link' => 'functions.html', 'count' => count($functions)],
            ['label' => 'Environment', 'link' => 'environment.html', 'count' => count($environment)],
            ['label' => 'Middleware', 'link' => 'middleware.html', 'count' => count($middleware)],
            ['label' => 'Terminal Commands', 'link' => 'terminal.html', 'count' => count($terminal)],
            ['label' => 'Routes', 'link' => 'routes.html', 'count' => count($routes)],
            ['label' => 'Classes', 'link' => 'classes.html', 'count' => count($classes)],
            ['label' => 'Examples', 'link' => 'examples.html', 'count' => count($examples)],
            ['label' => 'Database', 'link' => 'database.html', 'count' => count($database)],
        ];

        $index = View::render('autodoc/html/index', [
            'project' => $project,
            'title' => $project['name'] ?? '',
            'home' => 'index.html',
            'nav' => $this->renderNav($sections, 'html/'),
            'content' => '',
        ]);
        $this->save('docs/index.html', $index);

        $constantsContent = View::render('autodoc/html/constants', [
            'home' => '../index.html',
            'constants' => $this->renderConstants($constants),
        ]);
        $constantsPage = View::render('autodoc/html/index', [
            'project' => $project,
            'title' => 'Constants · ' . ($project['name'] ?? ''),
            'home' => '../index.html',
            'nav' => $this->renderNav($sections),
            'content' => $constantsContent,
        ]);
        $this->save('docs/html/constants.html', $constantsPage);

        Terminal::echol('Exported to [#c:p,#]', 'docs/');
    }

    protected function save(string $path, string $content): void
    {
        File::create($path, $content, true);
        Terminal::echol('  [#c:p,#]', $path);
    }

    protected function renderNav(array $sections, string $base = ''): string
    {
        $lines = [];

        foreach ($sections as $section)
            if ($section['count'] > 0)
                $lines[] = View::render('autodoc/html/nav/item.html', [
                    'label' => $section['label'],
                    'link' => $base . $section['link'],
                    'count' => $section['count'],
                ]);

        return implode("\n", $lines);
    }

    protected function renderConstants(array $items): string
    {
        $lines = [];

        foreach ($items as $item)
            $lines[] = View::render('autodoc/html/constants/item.html', [
                'name' => $item['name'] ?? '',
                'description' => $this->joinDescription($item['description'] ?? []),
            ]);

        return implode("\n", $lines);
    }

    protected function joinDescription(array|string $description): string
    {
        return is_array($description) ? implode(' ', $description) : $description;
    }

};

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
        $project['name'] = $this->esc($project['name'] ?? '');
        $project['description'] = $this->esc($project['description'] ?? '');

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
        $this->save('docs/html/constants.html', $this->renderPage('Constants', $project, $sections, $constantsContent));

        $functionsContent = View::render('autodoc/html/functions', [
            'home' => '../index.html',
            'functions' => $this->renderFunctions($functions),
        ]);
        $this->save('docs/html/functions.html', $this->renderPage('Functions', $project, $sections, $functionsContent));

        Terminal::echol('Exported to [#c:p,#]', 'docs/');
    }

    protected function save(string $path, string $content): void
    {
        File::create($path, $content, true);
        Terminal::echol('  [#c:p,#]', $path);
    }

    protected function esc(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    protected function renderPage(string $title, array $project, array $sections, string $content): string
    {
        return View::render('autodoc/html/index', [
            'project' => $project,
            'title' => $title . ' · ' . ($project['name'] ?? ''),
            'home' => '../index.html',
            'nav' => $this->renderNav($sections),
            'content' => $content,
        ]);
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
                'name' => $this->esc($item['name'] ?? ''),
                'description' => $this->esc($this->joinDescription($item['description'] ?? [])),
            ]);

        return implode("\n", $lines);
    }

    protected function renderFunctions(array $items): string
    {
        $lines = [];

        foreach ($items as $item) {
            $params = $item['params'] ?? [];

            $lines[] = View::render('autodoc/html/functions/item.html', [
                'name' => $this->esc($item['name'] ?? ''),
                'paramNames' => $this->esc(implode(', ', array_column($params, 'name'))),
                'description' => $this->esc($this->joinDescription($item['description'] ?? [])),
                'usage' => $this->functionUsage($item['name'] ?? '', $params),
                'params' => $this->renderFunctionParams($params),
                'return' => $this->esc($item['return'] ?? 'mixed'),
            ]);
        }

        return implode("\n", $lines);
    }

    protected function renderFunctionParams(array $params): string
    {
        $lines = [];

        foreach ($params as $param)
            $lines[] = View::render('autodoc/html/functions/param.html', [
                'name' => $this->esc($param['name'] ?? ''),
                'type' => $this->esc($param['type'] ?? 'mixed'),
                'description' => $this->esc($this->joinDescription($param['description'] ?? [])),
            ]);

        return implode("\n", $lines);
    }

};

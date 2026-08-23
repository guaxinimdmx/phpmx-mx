<?php

use PhpMx\Dir;
use PhpMx\File;
use PhpMx\Reflection\ReflectionCommandFile;
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
            'searchIndex' => 'html/search-index.js',
            'searchBase' => 'html/',
            'content' => '<h1>' . $project['name'] . '</h1><p>' . $project['description'] . '</p>',
        ]);
        $this->save('docs/index.html', $index);

        $constantsContent = View::render('autodoc/html/constants', [
            'constants' => $this->renderSimpleList($constants, 'autodoc/html/constants/item.html'),
        ]);
        $this->save('docs/html/constants.html', $this->renderPage('Constants', $project, $sections, $constantsContent));

        $functionsContent = View::render('autodoc/html/functions', [
            'functions' => $this->renderFunctions($functions),
        ]);
        $this->save('docs/html/functions.html', $this->renderPage('Functions', $project, $sections, $functionsContent));

        $environmentContent = View::render('autodoc/html/environment', [
            'environment' => $this->renderSimpleList($environment, 'autodoc/html/environment/item.html'),
        ]);
        $this->save('docs/html/environment.html', $this->renderPage('Environment', $project, $sections, $environmentContent));

        $middlewareContent = View::render('autodoc/html/middleware', [
            'middleware' => $this->renderSimpleList($middleware, 'autodoc/html/middleware/item.html'),
        ]);
        $this->save('docs/html/middleware.html', $this->renderPage('Middleware', $project, $sections, $middlewareContent));

        $terminalContent = View::render('autodoc/html/terminal', [
            'terminal' => $this->renderTerminal($terminal),
        ]);
        $this->save('docs/html/terminal.html', $this->renderPage('Terminal Commands', $project, $sections, $terminalContent));

        $routesContent = View::render('autodoc/html/routes', [
            'routes' => $this->renderRoutes($routes),
        ]);
        $this->save('docs/html/routes.html', $this->renderPage('Routes', $project, $sections, $routesContent));

        $classesContent = View::render('autodoc/html/classes', [
            'classes' => $this->renderClassesIndex($classes),
        ]);
        $this->save('docs/html/classes.html', $this->renderPage('Classes', $project, $sections, $classesContent));

        $this->writeClassPages($classes, $project, $sections);

        $examplesContent = View::render('autodoc/html/examples', [
            'examples' => $this->renderExamplesIndex($examples),
        ]);
        $this->save('docs/html/examples.html', $this->renderPage('Examples', $project, $sections, $examplesContent));

        $this->writeExamplePages($examples, $project, $sections);

        $databaseContent = View::render('autodoc/html/database', [
            'database' => $this->renderDatabaseIndex($database),
        ]);
        $this->save('docs/html/database.html', $this->renderPage('Database', $project, $sections, $databaseContent));

        $this->writeDatabasePages($database, $project, $sections);

        $this->writeSearchIndex($constants, $functions, $environment, $middleware, $terminal, $routes, $classes, $examples, $database);

        Terminal::echol('Exported to [#c:p,#]', 'docs/');
    }

    protected function save(string $path, string $content): void
    {
        $content = $this->resolveCodeMarkers($content);

        File::create($path, $content, true);
        Terminal::echol('  [#c:p,#]', $path);
    }

    protected function esc(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Empacota código-fonte bruto num marcador opaco que atravessa incólume as
     * várias passagens de View::render() aninhadas (cada uma reformata/reescapa
     * o HTML de novo). Só é expandido em <pre><code> real, com escaping único,
     * por resolveCodeMarkers() na etapa final de save().
     */
    protected function codeMarker(string $raw, string $class = ''): string
    {
        if ($raw === '') return '';

        return '@@CODE:' . $class . ':' . base64_encode($raw) . '@@';
    }

    protected function resolveCodeMarkers(string $html): string
    {
        return preg_replace_callback(
            '/@@CODE:([a-zA-Z0-9_-]*):([A-Za-z0-9+\/=]+)@@/',
            function ($m) {
                $class = $m[1] !== '' ? ' class="' . htmlspecialchars($m[1], ENT_QUOTES, 'UTF-8') . '"' : '';
                $code = htmlspecialchars(base64_decode($m[2]), ENT_NOQUOTES | ENT_SUBSTITUTE, 'UTF-8');
                return "<pre><code$class>$code</code></pre>";
            },
            $html
        );
    }

    protected function renderPage(string $title, array $project, array $sections, string $content, string $home = '../index.html', string $navBase = ''): string
    {
        return View::render('autodoc/html/index', [
            'project' => $project,
            'title' => $title . ' · ' . ($project['name'] ?? ''),
            'home' => $home,
            'nav' => $this->renderNav($sections, $navBase),
            'searchIndex' => $navBase . 'search-index.js',
            'searchBase' => $navBase,
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

    protected function renderSimpleList(array $items, string $viewPath): string
    {
        $lines = [];

        foreach ($items as $item)
            $lines[] = View::render($viewPath, [
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
                'usage' => $this->codeMarker($this->functionUsage($item['name'] ?? '', $params)),
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

    protected function renderTerminal(array $items): string
    {
        $lines = [];

        foreach ($items as $item) {
            $params = $item['params'] ?? [];
            $name = $item['name'] ?? '';

            $lines[] = View::render('autodoc/html/terminal/item.html', [
                'name' => $this->esc($name),
                'description' => $this->esc($this->joinDescription($item['description'] ?? [])),
                'usage' => $this->usageBlock($name, $params),
                'params' => $this->renderTerminalParams($params),
            ]);
        }

        return implode("\n", $lines);
    }

    protected function usageBlock(string $name, array $params): string
    {
        $variations = ReflectionCommandFile::variations($params);

        $lines = array_map(fn($variation) => trim("php mx $name $variation"), $variations);

        return $this->codeMarker(implode("\n", $lines));
    }

    protected function renderTerminalParams(array $params): string
    {
        $lines = [];

        foreach ($params as $param)
            $lines[] = View::render('autodoc/html/terminal/param.html', [
                'name' => $this->esc($param['name'] ?? ''),
                'type' => $this->esc($param['type'] ?? 'mixed'),
                'description' => $this->esc($this->joinDescription($param['description'] ?? [])),
            ]);

        return implode("\n", $lines);
    }

    protected function renderRoutes(array $items): string
    {
        $lines = [];

        foreach ($items as $item) {
            $middlewares = $item['middlewares'] ?? [];

            $lines[] = View::render('autodoc/html/routes/item.html', [
                'method' => $this->esc($item['method'] ?? ''),
                'path' => $this->esc($item['path'] ?? ''),
                'response' => $this->renderRouteResponse($item['response'] ?? []),
                'middlewares' => $middlewares
                    ? '<p class="middlewares"><strong>Middlewares:</strong> ' . implode(', ', array_map(fn($m) => '<code>' . $this->esc($m) . '</code>', $middlewares)) . '</p>'
                    : '',
            ]);
        }

        return implode("\n", $lines);
    }

    protected function renderRouteResponse(array $response): string
    {
        if (($response['type'] ?? '') === 'status')
            return View::render('autodoc/html/routes/response-status.html', [
                'code' => $this->esc($response['code'] ?? ''),
            ]);

        return View::render('autodoc/html/routes/response-class.html', [
            'class' => $this->esc($response['class'] ?? ''),
            'method' => $this->esc($response['method'] ?? '__invoke'),
            'description' => $this->esc($this->joinDescription($response['description'] ?? [])),
        ]);
    }

    protected function renderClassesIndex(array $items): string
    {
        $groups = [];

        foreach ($items as $item) {
            $name = $item['name'] ?? '';
            $parts = explode('\\', $name);
            array_pop($parts);
            $ns = implode('\\', $parts) ?: '(root)';
            $groups[$ns][] = $item;
        }

        ksort($groups);

        $blocks = [];
        foreach ($groups as $ns => $classes) {
            $lines = ['<h2>' . $this->esc($ns) . '</h2>', '<ul class="item-list">'];

            foreach ($classes as $item) {
                $name = $item['name'] ?? '';

                $lines[] = View::render('autodoc/html/classes/link.html', [
                    'name' => $this->esc($name),
                    'link' => 'classes/' . $this->classFilename($name, 'html'),
                    'description' => $this->esc($this->joinDescription($item['description'] ?? [])),
                ]);
            }

            $lines[] = '</ul>';

            $blocks[] = implode("\n", $lines);
        }

        return implode("\n", $blocks);
    }

    protected function writeClassPages(array $items, array $project, array $sections): void
    {
        foreach ($items as $item) {
            $name = $item['name'] ?? '';
            $type = $item['type'] ?? 'class';
            $badge = trim((!empty($item['abstract']) ? 'abstract ' : '') . (!empty($item['final']) ? 'final ' : '') . $type);

            $content = View::render('autodoc/html/classes/item.html', [
                'name' => $this->esc($name),
                'badge' => $this->esc($badge),
                'description' => $this->esc($this->joinDescription($item['description'] ?? [])),
                'extends' => !empty($item['extends']) ? '<p><strong>Extends:</strong> <code>' . $this->esc($item['extends']) . '</code></p>' : '',
                'interface' => !empty($item['interface']) ? '<p><strong>Implements:</strong> <code>' . implode('</code>, <code>', array_map(fn($v) => $this->esc($v), (array)$item['interface'])) . '</code></p>' : '',
                'traits' => !empty($item['traits']) ? '<p><strong>Uses:</strong> <code>' . implode('</code>, <code>', array_map(fn($v) => $this->esc($v), (array)$item['traits'])) . '</code></p>' : '',
                'constants' => $this->renderClassConstants($item['constants'] ?? []),
                'properties' => $this->renderClassProperties($item['properties'] ?? []),
                'methods' => $this->renderClassMethods($item['methods'] ?? [], $name),
            ]);

            $this->save('docs/html/classes/' . $this->classFilename($name, 'html'), $this->renderPage($name, $project, $sections, $content, '../../index.html', '../'));
        }
    }

    protected function renderClassConstants(array $constants): string
    {
        if (empty($constants)) return '';

        $lines = ['<h2>Constants</h2>', '<ul class="item-list">'];
        foreach ($constants as $const)
            $lines[] = View::render('autodoc/html/classes/constant.html', [
                'visibility' => $this->esc($const['visibility'] ?? 'public'),
                'name' => $this->esc($const['name'] ?? ''),
                'description' => $this->esc($this->joinDescription($const['description'] ?? [])),
                'inherited' => $this->inheritedNote($const),
            ]);
        $lines[] = '</ul>';

        return implode("\n", $lines);
    }

    protected function renderClassProperties(array $properties): string
    {
        if (empty($properties)) return '';

        $lines = ['<h2>Properties</h2>', '<ul class="item-list">'];
        foreach ($properties as $prop)
            $lines[] = View::render('autodoc/html/classes/property.html', [
                'visibility' => $this->esc($prop['visibility'] ?? 'public'),
                'static' => !empty($prop['static']) ? 'static ' : '',
                'type' => $this->esc($prop['type'] ?? 'mixed'),
                'name' => $this->esc($prop['name'] ?? ''),
                'description' => $this->esc($this->joinDescription($prop['description'] ?? [])),
                'inherited' => $this->inheritedNote($prop),
            ]);
        $lines[] = '</ul>';

        return implode("\n", $lines);
    }

    protected function inheritedNote(array $item): string
    {
        return !empty($item['inheritedFrom']) ? '<em>(herdado de <code>' . $this->esc($item['inheritedFrom']) . '</code>)</em>' : '';
    }

    protected function renderClassMethods(array $methods, string $className): string
    {
        if (empty($methods)) return '';

        $priority = function ($method) {
            $name = $method['name'] ?? '';
            if ($name === '__construct') return 0;
            if ($name === '__invoke') return 1;
            $isLate = ($method['visibility'] ?? 'public') === 'protected' || str_starts_with($name, '__');
            return $isLate ? 3 : 2;
        };

        usort($methods, fn($a, $b) => $priority($a) <=> $priority($b));

        $lines = ['<h2>Methods</h2>'];
        foreach ($methods as $method) {
            $params = $method['params'] ?? [];
            $name = $method['name'] ?? '';
            $isPublic = ($method['visibility'] ?? 'public') === 'public';
            $isMagic = str_starts_with($name, '__');
            $isPrimaryMagic = $name === '__construct' || $name === '__invoke';

            $modifiers = trim(
                ($method['visibility'] ?? 'public') . ' ' .
                    (!empty($method['static']) ? 'static ' : '') .
                    (!empty($method['abstract']) ? 'abstract ' : '') .
                    (!empty($method['final']) ? 'final ' : '')
            );

            $usage = ($isPublic && (!$isMagic || $isPrimaryMagic)) ? $this->classMethodUsage($className, $name, $params, !empty($method['static'])) : '';

            $lines[] = View::render('autodoc/html/classes/method.html', [
                'modifiers' => $this->esc($modifiers),
                'name' => $this->esc($name),
                'paramNames' => $this->esc(implode(', ', array_column($params, 'name'))),
                'description' => $this->esc($this->joinDescription($method['description'] ?? [])),
                'usage' => $this->codeMarker($usage),
                'params' => $this->renderClassMethodParams($params),
                'return' => $this->esc($method['return'] ?? 'mixed'),
                'inherited' => $this->inheritedNote($method),
            ]);
        }

        return implode("\n", $lines);
    }

    protected function renderClassMethodParams(array $params): string
    {
        $lines = [];

        foreach ($params as $param)
            $lines[] = View::render('autodoc/html/classes/param.html', [
                'name' => $this->esc($param['name'] ?? ''),
                'type' => $this->esc($param['type'] ?? 'mixed'),
                'description' => $this->esc($this->joinDescription($param['description'] ?? [])),
            ]);

        return implode("\n", $lines);
    }

    protected function classFilename(string $name, string $ex): string
    {
        return str_replace('\\', '.', $name) . ".$ex";
    }

    protected function renderExamplesIndex(array $items): string
    {
        $groups = [];

        foreach ($items as $item) {
            $name = $item['name'] ?? '';
            $parts = explode('.', $name);
            array_pop($parts);
            $group = implode('.', $parts) ?: '(root)';
            $groups[$group][] = $item;
        }

        ksort($groups);

        $blocks = [];
        foreach ($groups as $group => $examples) {
            $lines = ['<h2>' . $this->esc($group) . '</h2>', '<ul class="item-list">'];

            foreach ($examples as $item) {
                $name = $item['name'] ?? '';

                $lines[] = View::render('autodoc/html/examples/link.html', [
                    'name' => $this->esc($name),
                    'link' => 'examples/' . $this->exampleFilename($name),
                    'description' => $this->esc($this->exampleSummary($item['content'] ?? '')),
                ]);
            }

            $lines[] = '</ul>';

            $blocks[] = implode("\n", $lines);
        }

        return implode("\n", $blocks);
    }

    protected function exampleSummary(string $content): string
    {
        $first = strtok($content, "\n") ?: '';

        return trim(ltrim(trim($first), '# '));
    }

    protected function writeExamplePages(array $items, array $project, array $sections): void
    {
        foreach ($items as $item) {
            $name = $item['name'] ?? '';

            $htmlContent = $this->markMdCodeBlocks(mdToHtml($item['content'] ?? ''));

            $content = View::render('autodoc/html/examples/item.html', [
                'content' => $htmlContent,
            ]);

            $title = $this->exampleSummary($item['content'] ?? '');
            $this->save('docs/html/examples/' . $this->exampleFilename($name), $this->renderPage($title, $project, $sections, $content, '../../index.html', '../'));
        }
    }

    protected function markMdCodeBlocks(string $html): string
    {
        return preg_replace_callback(
            '#<pre[^>]*><code([^>]*)>(.*?)</code></pre>#is',
            function ($m) {
                preg_match('/class="([^"]*)"/', $m[1], $classMatch);
                $class = $classMatch[1] ?? '';
                $raw = html_entity_decode($m[2], ENT_QUOTES, 'UTF-8');
                return $this->codeMarker($raw, $class);
            },
            $html
        );
    }

    protected function exampleFilename(string $name): string
    {
        return "$name.html";
    }

    protected function renderDatabaseIndex(array $database): string
    {
        $blocks = [];

        foreach ($database as $dbName => $db) {
            $lines = ['<h2>' . $this->esc($dbName) . '</h2>', '<ul class="item-list">'];

            foreach ($db['tables'] ?? [] as $tableName => $table)
                $lines[] = View::render('autodoc/html/database/link.html', [
                    'name' => $this->esc($tableName),
                    'link' => 'database/' . $this->databaseFilename($dbName, $tableName),
                    'comment' => $this->esc($table['comment'] ?? ''),
                ]);

            $lines[] = '</ul>';

            $blocks[] = implode("\n", $lines);
        }

        return implode("\n", $blocks);
    }

    protected function writeDatabasePages(array $database, array $project, array $sections): void
    {
        foreach ($database as $dbName => $db) {
            foreach ($db['tables'] ?? [] as $tableName => $table) {
                $content = View::render('autodoc/html/database/table.html', [
                    'name' => $this->esc($tableName),
                    'comment' => $this->esc($table['comment'] ?? ''),
                    'fields' => $this->renderDatabaseFields($table['fields'] ?? [], $dbName),
                ]);

                $this->save('docs/html/database/' . $this->databaseFilename($dbName, $tableName), $this->renderPage($tableName, $project, $sections, $content, '../../index.html', '../'));
            }
        }
    }

    protected function databaseFilename(string $dbName, string $tableName): string
    {
        return "$dbName.$tableName.html";
    }

    protected function renderDatabaseFields(array $fields, string $dbName): string
    {
        $lines = [];

        foreach ($fields as $name => $field)
            $lines[] = View::render('autodoc/html/database/field.html', [
                'name' => $this->esc($name),
                'type' => $this->esc($this->formatDatabaseType($field, $dbName)),
                'null' => ($field['null'] ?? true) ? 'sim' : 'não',
                'default' => $this->esc($this->formatDatabaseDefault($field['default'] ?? null, $field['type'] ?? '')),
                'comment' => $this->esc($field['comment'] ?? ''),
            ]);

        return implode("\n", $lines);
    }

    protected function formatDatabaseType(array $field, string $dbName): string
    {
        $type = $field['type'] ?? 'mixed';
        $references = $field['references'] ?? null;

        if (empty($references)) return $type;

        $table = $references['table'] ?? '';
        $database = $references['database'] ?? '';
        $target = ($database && $database !== $dbName) ? "$database.$table" : $table;

        return "$type → $target";
    }

    protected function formatDatabaseDefault(mixed $default, string $type): string
    {
        if (is_null($default)) return '-';
        if ($type === 'boolean') return boolval($default) ? 'true' : 'false';
        return (string) $default;
    }

    protected function writeSearchIndex(
        array $constants,
        array $functions,
        array $environment,
        array $middleware,
        array $terminal,
        array $routes,
        array $classes,
        array $examples,
        array $database
    ): void {
        $index = [];

        foreach ($examples as $item) {
            $name = $item['name'] ?? '';
            $title = $this->exampleSummary($item['content'] ?? '') ?: $name;
            $index[] = ['key' => $title, 'type' => 'example', 'link' => 'examples/' . $this->exampleFilename($name)];
        }

        foreach ($constants as $item)
            $index[] = ['key' => $item['name'] ?? '', 'type' => 'constant', 'link' => 'constants.html'];

        foreach ($functions as $item)
            $index[] = ['key' => $item['name'] ?? '', 'type' => 'function', 'link' => 'functions.html'];

        foreach ($environment as $item)
            $index[] = ['key' => $item['name'] ?? '', 'type' => 'environment', 'link' => 'environment.html'];

        foreach ($middleware as $item)
            $index[] = ['key' => $item['name'] ?? '', 'type' => 'middleware', 'link' => 'middleware.html'];

        foreach ($terminal as $item)
            $index[] = ['key' => $item['name'] ?? '', 'type' => 'terminal', 'link' => 'terminal.html'];

        foreach ($routes as $item)
            $index[] = ['key' => trim(($item['method'] ?? '') . ' ' . ($item['path'] ?? '')), 'type' => 'route', 'link' => 'routes.html'];

        foreach ($classes as $item) {
            $name = $item['name'] ?? '';
            $link = 'classes/' . $this->classFilename($name, 'html');

            $index[] = ['key' => $name, 'type' => 'class', 'link' => $link];

            foreach ($item['constants'] ?? [] as $const)
                $index[] = ['key' => $name . '::' . ($const['name'] ?? ''), 'type' => 'constant', 'link' => $link];

            foreach ($item['properties'] ?? [] as $prop)
                $index[] = ['key' => $name . '::$' . ($prop['name'] ?? ''), 'type' => 'property', 'link' => $link];

            foreach ($item['methods'] ?? [] as $method)
                $index[] = ['key' => $name . '::' . ($method['name'] ?? '') . '()', 'type' => 'method', 'link' => $link];
        }

        foreach ($database as $dbName => $db) {
            foreach ($db['tables'] ?? [] as $tableName => $table) {
                $link = 'database/' . $this->databaseFilename($dbName, $tableName);

                $index[] = ['key' => $tableName, 'type' => 'database', 'link' => $link];

                foreach ($table['fields'] ?? [] as $fieldName => $field)
                    $index[] = ['key' => "$tableName.$fieldName", 'type' => 'field', 'link' => $link];
            }
        }

        $json = json_encode($index, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $this->save('docs/html/search-index.js', "var MX_SEARCH = $json;\n");
    }

};

<?php

use PhpMx\Dir;
use PhpMx\File;
use PhpMx\Reflection\ReflectionCommandFile;
use PhpMx\Terminal;
use PhpMx\Trait\AutodocTrait;
use PhpMx\View;

/** Gera docs/md a partir dos dados do projeto */
return new class {

    use AutodocTrait;

    function __invoke()
    {
        Dir::remove('docs/md', true);

        $constants = $this->exportConstants();
        $functions = $this->exportFunctions();
        $environment = $this->exportEnvironment();
        $middleware = $this->exportMiddleware();
        $terminal = $this->exportTerminal();
        $routes = $this->exportRoutes();
        $classes = $this->exportClasses();
        $examples = $this->exportExamples();
        $database = $this->exportDatabase();

        $index = View::render('autodoc/index.md', [
            'project' => $this->exportProject(),
            'sections' => $this->renderIndexSections([
                ['label' => 'Constants', 'link' => 'md/constants.md', 'count' => count($constants)],
                ['label' => 'Functions', 'link' => 'md/functions.md', 'count' => count($functions)],
                ['label' => 'Environment', 'link' => 'md/environment.md', 'count' => count($environment)],
                ['label' => 'Middleware', 'link' => 'md/middleware.md', 'count' => count($middleware)],
                ['label' => 'Terminal Commands', 'link' => 'md/terminal.md', 'count' => count($terminal)],
                ['label' => 'Routes', 'link' => 'md/routes.md', 'count' => count($routes)],
                ['label' => 'Classes', 'link' => 'md/classes.md', 'count' => count($classes)],
                ['label' => 'Examples', 'link' => 'md/examples.md', 'count' => count($examples)],
                ['label' => 'Database', 'link' => 'md/database.md', 'count' => count($database)],
            ]),
        ]);
        $this->save('docs/index.md', $index);

        $constantsPage = View::render('autodoc/constants.md', [
            'constants' => $this->renderConstants($constants),
        ]);
        $this->save('docs/md/constants.md', $constantsPage);

        $functionsPage = View::render('autodoc/functions.md', [
            'functions' => $this->renderFunctions($functions),
        ]);
        $this->save('docs/md/functions.md', $functionsPage);

        $environmentPage = View::render('autodoc/environment.md', [
            'environment' => $this->renderEnvironment($environment),
        ]);
        $this->save('docs/md/environment.md', $environmentPage);

        $middlewarePage = View::render('autodoc/middleware.md', [
            'middleware' => $this->renderMiddleware($middleware),
        ]);
        $this->save('docs/md/middleware.md', $middlewarePage);

        $terminalPage = View::render('autodoc/terminal.md', [
            'terminal' => $this->renderTerminal($terminal),
        ]);
        $this->save('docs/md/terminal.md', $terminalPage);

        $routesPage = View::render('autodoc/routes.md', [
            'routes' => $this->renderRoutes($routes),
        ]);
        $this->save('docs/md/routes.md', $routesPage);

        $classesPage = View::render('autodoc/classes.md', [
            'classes' => $this->renderClassesIndex($classes),
        ]);
        $this->save('docs/md/classes.md', $classesPage);

        $this->writeClassPages($classes);

        $examplesPage = View::render('autodoc/examples.md', [
            'examples' => $this->renderExamplesIndex($examples),
        ]);
        $this->save('docs/md/examples.md', $examplesPage);

        $this->writeExamplePages($examples);

        $databasePage = View::render('autodoc/database.md', [
            'database' => $this->renderDatabaseIndex($database),
        ]);
        $this->save('docs/md/database.md', $databasePage);

        $this->writeDatabasePages($database);

        $this->ensureDocLink('README.md', 'docs/index.md', 'Documentação em markdown [docs/index.md](docs/index.md)');

        Terminal::echol('Exported to [#c:p,#]', 'docs/');
    }

    protected function save(string $path, string $content): void
    {
        $content = preg_replace('/\n{3,}/', "\n\n", $content);

        File::create($path, $content, true);
        Terminal::echol('  [#c:p,#]', $path);
    }

    protected function renderIndexSections(array $sections): string
    {
        $lines = [];

        foreach ($sections as $section)
            if ($section['count'] > 0)
                $lines[] = View::render('autodoc/index/section.md', $section);

        return implode("\n\n", $lines);
    }

    protected function renderConstants(array $items): string
    {
        $lines = [];

        foreach ($items as $item)
            $lines[] = View::render('autodoc/constants/item.md', [
                'name' => $item['name'] ?? '',
                'description' => $this->joinDescription($item['description'] ?? []),
            ]);

        return implode("\n", $lines);
    }

    protected function renderFunctions(array $items): string
    {
        $lines = [];

        foreach ($items as $item) {
            $params = $item['params'] ?? [];

            $lines[] = View::render('autodoc/functions/item.md', [
                'name' => $item['name'] ?? '',
                'paramNames' => implode(', ', array_column($params, 'name')),
                'description' => $this->joinDescription($item['description'] ?? []),
                'params' => $this->renderFunctionParams($params),
                'return' => $item['return'] ?? 'mixed',
            ]);
        }

        return implode("\n\n", $lines);
    }

    protected function renderFunctionParams(array $params): string
    {
        $lines = [];

        foreach ($params as $param)
            $lines[] = View::render('autodoc/functions/param.md', [
                'name' => $param['name'] ?? '',
                'type' => $param['type'] ?? 'mixed',
                'description' => $this->joinDescription($param['description'] ?? []),
            ]);

        return implode("\n", $lines);
    }

    protected function renderEnvironment(array $items): string
    {
        $lines = [];

        foreach ($items as $item)
            $lines[] = View::render('autodoc/environment/item.md', [
                'name' => $item['name'] ?? '',
                'description' => $this->joinDescription($item['description'] ?? []),
            ]);

        return implode("\n", $lines);
    }

    protected function renderMiddleware(array $items): string
    {
        $lines = [];

        foreach ($items as $item)
            $lines[] = View::render('autodoc/middleware/item.md', [
                'name' => $item['name'] ?? '',
                'description' => $this->joinDescription($item['description'] ?? []),
            ]);

        return implode("\n", $lines);
    }

    protected function renderTerminal(array $items): string
    {
        $lines = [];

        foreach ($items as $item) {
            $params = $item['params'] ?? [];
            $name = $item['name'] ?? '';

            $lines[] = View::render('autodoc/terminal/item.md', [
                'name' => $name,
                'usage' => $this->usageBlock($name, $params),
                'description' => $this->joinDescription($item['description'] ?? []),
                'params' => $this->renderTerminalParams($params),
            ]);
        }

        return implode("\n\n", $lines);
    }

    protected function usageBlock(string $name, array $params): string
    {
        $variations = ReflectionCommandFile::variations($params);

        $lines = array_map(fn($variation) => trim("php mx $name $variation"), $variations);

        return implode("\n", $lines);
    }

    protected function renderTerminalParams(array $params): string
    {
        $lines = [];

        foreach ($params as $param)
            $lines[] = View::render('autodoc/terminal/param.md', [
                'name' => $param['name'] ?? '',
                'type' => $param['type'] ?? 'mixed',
                'description' => $this->joinDescription($param['description'] ?? []),
            ]);

        return implode("\n", $lines);
    }

    protected function renderRoutes(array $items): string
    {
        $lines = [];

        foreach ($items as $item) {
            $middlewares = $item['middlewares'] ?? [];

            $lines[] = View::render('autodoc/routes/item.md', [
                'method' => $item['method'] ?? '',
                'path' => $item['path'] ?? '',
                'response' => $this->renderRouteResponse($item['response'] ?? []),
                'middlewares' => $middlewares ? '**Middlewares:** ' . implode(', ', array_map(fn($m) => "`$m`", $middlewares)) : '',
            ]);
        }

        return implode("\n\n", $lines);
    }

    protected function renderRouteResponse(array $response): string
    {
        if (($response['type'] ?? '') === 'status')
            return View::render('autodoc/routes/response-status.md', [
                'code' => $response['code'] ?? '',
            ]);

        return View::render('autodoc/routes/response-class.md', [
            'class' => $response['class'] ?? '',
            'method' => $response['method'] ?? '__invoke',
            'description' => $this->joinDescription($response['description'] ?? []),
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
            $lines = ["### $ns", ''];

            foreach ($classes as $item) {
                $name = $item['name'] ?? '';

                $lines[] = View::render('autodoc/classes/link.md', [
                    'name' => $name,
                    'link' => 'classes/' . $this->classFilename($name),
                    'description' => $this->joinDescription($item['description'] ?? []),
                ]);
            }

            $blocks[] = implode("\n", $lines);
        }

        return implode("\n\n", $blocks);
    }

    protected function writeClassPages(array $items): void
    {
        foreach ($items as $item) {
            $name = $item['name'] ?? '';
            $type = $item['type'] ?? 'class';
            $badge = trim((!empty($item['abstract']) ? 'abstract ' : '') . (!empty($item['final']) ? 'final ' : '') . $type);

            $content = View::render('autodoc/classes/item.md', [
                'name' => $name,
                'badge' => $badge,
                'description' => $this->joinDescription($item['description'] ?? []),
                'extends' => !empty($item['extends']) ? "**Extends:** `{$item['extends']}`" : '',
                'interface' => !empty($item['interface']) ? '**Implements:** `' . implode('`, `', (array)$item['interface']) . '`' : '',
                'traits' => !empty($item['traits']) ? '**Uses:** `' . implode('`, `', (array)$item['traits']) . '`' : '',
                'constants' => $this->renderClassConstants($item['constants'] ?? []),
                'properties' => $this->renderClassProperties($item['properties'] ?? []),
                'methods' => $this->renderClassMethods($item['methods'] ?? []),
            ]);

            $this->save('docs/md/classes/' . $this->classFilename($name), $content);
        }
    }

    protected function renderClassConstants(array $constants): string
    {
        if (empty($constants)) return '';

        $lines = [];
        foreach ($constants as $const)
            $lines[] = View::render('autodoc/classes/constant.md', [
                'visibility' => $const['visibility'] ?? 'public',
                'name' => $const['name'] ?? '',
                'description' => $this->joinDescription($const['description'] ?? []),
                'inherited' => $this->inheritedNote($const),
            ]);

        return "## Constants\n\n" . implode("\n", $lines);
    }

    protected function renderClassProperties(array $properties): string
    {
        if (empty($properties)) return '';

        $lines = [];
        foreach ($properties as $prop)
            $lines[] = View::render('autodoc/classes/property.md', [
                'visibility' => $prop['visibility'] ?? 'public',
                'static' => !empty($prop['static']) ? 'static ' : '',
                'type' => $prop['type'] ?? 'mixed',
                'name' => $prop['name'] ?? '',
                'description' => $this->joinDescription($prop['description'] ?? []),
                'inherited' => $this->inheritedNote($prop),
            ]);

        return "## Properties\n\n" . implode("\n", $lines);
    }

    protected function inheritedNote(array $item): string
    {
        return !empty($item['inheritedFrom']) ? " _(herdado de `{$item['inheritedFrom']}`)_" : '';
    }

    protected function renderClassMethods(array $methods): string
    {
        if (empty($methods)) return '';

        $lines = [];
        foreach ($methods as $method) {
            $params = $method['params'] ?? [];

            $modifiers = trim(
                ($method['visibility'] ?? 'public') . ' ' .
                    (!empty($method['static']) ? 'static ' : '') .
                    (!empty($method['abstract']) ? 'abstract ' : '') .
                    (!empty($method['final']) ? 'final ' : '')
            );

            $lines[] = View::render('autodoc/classes/method.md', [
                'modifiers' => $modifiers,
                'name' => $method['name'] ?? '',
                'paramNames' => implode(', ', array_column($params, 'name')),
                'description' => $this->joinDescription($method['description'] ?? []),
                'params' => $this->renderClassMethodParams($params),
                'return' => $method['return'] ?? 'mixed',
                'inherited' => $this->inheritedNote($method),
            ]);
        }

        return "## Methods\n\n" . implode("\n\n", $lines);
    }

    protected function renderClassMethodParams(array $params): string
    {
        $lines = [];

        foreach ($params as $param)
            $lines[] = View::render('autodoc/classes/param.md', [
                'name' => $param['name'] ?? '',
                'type' => $param['type'] ?? 'mixed',
                'description' => $this->joinDescription($param['description'] ?? []),
            ]);

        return implode("\n", $lines);
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
            $lines = ["### $group", ''];

            foreach ($examples as $item) {
                $name = $item['name'] ?? '';

                $lines[] = View::render('autodoc/examples/link.md', [
                    'name' => $name,
                    'link' => 'examples/' . $this->exampleFilename($name),
                    'description' => $this->exampleSummary($item['content'] ?? ''),
                ]);
            }

            $blocks[] = implode("\n", $lines);
        }

        return implode("\n\n", $blocks);
    }

    protected function exampleSummary(string $content): string
    {
        $first = strtok($content, "\n") ?: '';

        return trim(ltrim(trim($first), '# '));
    }

    protected function writeExamplePages(array $items): void
    {
        foreach ($items as $item) {
            $name = $item['name'] ?? '';

            $content = View::render('autodoc/examples/item.md', [
                'content' => $item['content'] ?? '',
            ]);

            $this->save('docs/md/examples/' . $this->exampleFilename($name), $content);
        }
    }

    protected function exampleFilename(string $name): string
    {
        return "$name.md";
    }

    protected function renderDatabaseIndex(array $database): string
    {
        $blocks = [];

        foreach ($database as $dbName => $db) {
            $lines = ["### $dbName", ''];

            foreach ($db['tables'] ?? [] as $tableName => $table)
                $lines[] = View::render('autodoc/database/link.md', [
                    'name' => $tableName,
                    'link' => 'database/' . $this->databaseFilename($dbName, $tableName),
                    'comment' => $table['comment'] ?? '',
                ]);

            $blocks[] = implode("\n", $lines);
        }

        return implode("\n\n", $blocks);
    }

    protected function writeDatabasePages(array $database): void
    {
        foreach ($database as $dbName => $db) {
            foreach ($db['tables'] ?? [] as $tableName => $table) {
                $content = View::render('autodoc/database/table.md', [
                    'name' => $tableName,
                    'comment' => $table['comment'] ?? '',
                    'fields' => $this->renderDatabaseFields($table['fields'] ?? [], $dbName),
                ]);

                $this->save('docs/md/database/' . $this->databaseFilename($dbName, $tableName), $content);
            }
        }
    }

    protected function databaseFilename(string $dbName, string $tableName): string
    {
        return "$dbName.$tableName.md";
    }

    protected function renderDatabaseFields(array $fields, string $dbName): string
    {
        $lines = [];

        foreach ($fields as $name => $field)
            $lines[] = View::render('autodoc/database/field.md', [
                'name' => $this->escapeTableCell($name),
                'type' => $this->escapeTableCell($this->formatDatabaseType($field, $dbName)),
                'null' => ($field['null'] ?? true) ? 'sim' : 'não',
                'default' => $this->escapeTableCell($this->formatDatabaseDefault($field['default'] ?? null, $field['type'] ?? '')),
                'comment' => $this->escapeTableCell($field['comment'] ?? ''),
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
        if (is_null($default)) return '—';
        if ($type === 'boolean') return boolval($default) ? 'true' : 'false';
        return (string) $default;
    }

    protected function escapeTableCell(string $value): string
    {
        return str_replace('|', '\|', $value);
    }

    protected function classFilename(string $name): string
    {
        return str_replace('\\', '.', $name) . '.md';
    }

    protected function joinDescription(array|string $description): string
    {
        return is_array($description) ? implode(' ', $description) : $description;
    }
};

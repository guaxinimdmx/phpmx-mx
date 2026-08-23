<?php

namespace PhpMx\Trait;

use PhpMx\Datalayer;
use PhpMx\Datalayer\Scheme\SchemeMap;
use PhpMx\Dir;
use PhpMx\File;
use PhpMx\Json;
use PhpMx\Reflection\ReflectionCommandFile;
use PhpMx\Reflection\ReflectionHelperFile;
use PhpMx\Reflection\ReflectionMiddlewareFile;
use PhpMx\Reflection\ReflectionRouterFile;
use PhpMx\Reflection\ReflectionSourceFile;
use PhpMx\Reflection\ReflectionTestFile;

/** @ignore */
trait AutodocTrait
{
    protected function getRouteFiles()
    {
        $scheme = [];

        foreach (Dir::seekForFile('system/router', true) as $file)
            $scheme[] = path('system/router', $file);

        return $scheme;
    }

    protected function getDatabaseNames()
    {
        $scheme = [];

        foreach (Dir::seekForDir('system/datalayer') as $dbName) {
            $dbName = Datalayer::internalName($dbName);
            $envName = strtoupper($dbName);
            if (env("DB_{$envName}_TYPE") ?? false)
                $scheme[] = $dbName;
        }

        return $scheme;
    }

    protected function getRootFileFiles()
    {
        $scheme = [];

        $scheme['.conf'] = File::check('.conf');
        $scheme['deploy'] = File::check('deploy');
        $scheme['index.php'] = File::check('index.php');
        $scheme['install'] = File::check('install');

        return $scheme;
    }

    protected function getPsr4Files()
    {
        $scheme = [];

        foreach (Dir::seekForFile('class', true) as $file)
            $scheme[] = path('class', $file);

        return $scheme;
    }

    protected function getTestFiles()
    {
        $scheme = [];

        foreach (Dir::seekForFile('system/test', true) as $file)
            $scheme[] = path('system/test', $file);

        return $scheme;
    }

    protected function getMigrationFiles()
    {
        $scheme = [];

        foreach (Dir::seekForFile('system/migration', true) as $file)
            $scheme[] = path('system/migration', $file);

        return $scheme;
    }

    protected function getMiddlewareFiles()
    {
        $scheme = [];

        foreach (Dir::seekForFile('system/middleware', true) as $file)
            $scheme[] = path('system/middleware', $file);

        return $scheme;
    }

    protected function getTerminalFiles()
    {
        $scheme = [];

        foreach (Dir::seekForFile('system/terminal', true) as $file)
            $scheme[] = path('system/terminal', $file);

        return $scheme;
    }

    protected function getHelperFiles()
    {
        $scheme = [];

        foreach (Dir::seekForFile('system/helper/constant', true) as $file)
            $scheme['constant'][] = path('system/helper/constant', $file);

        foreach (Dir::seekForFile('system/helper/function', true) as $file)
            $scheme['function'][] = path('system/helper/function', $file);

        foreach (Dir::seekForFile('system/helper/script', true) as $file)
            $scheme['script'][] = path('system/helper/script', $file);

        return $scheme;
    }

    protected function getComposerScheme(?string $file = null)
    {
        $scheme = [];
        $dependences = is_null($file);
        $file = $file ?? 'composer.json';

        $composer = Json::import($file);

        $scheme['name'] = $composer['name'] ?? null;
        $scheme['description'] = $composer['description'] ?? null;
        $scheme['version'] = $composer['version'] ?? null;
        $scheme['homepage'] = $composer['homepage'] ?? null;

        if ($dependences) {
            $scheme['require'] = $composer['require'] ?? [];
            $scheme['suggest'] = $composer['suggest'] ?? [];

            foreach (array_keys($scheme['require']) as $package) {;
                $packageComposer = path('vendor', $package, 'composer.json');
                if (File::check($packageComposer))
                    $scheme['requiredPackages'][$package] = $this->getComposerScheme($packageComposer);
            }

            foreach (array_keys($scheme['suggest']) as $package) {;
                $packageComposer = path('vendor', $package, 'composer.json');
                if (File::check($packageComposer))
                    $scheme['suggestedPackages'][$package] = $this->getComposerScheme($packageComposer);
            }
        }

        return $scheme;
    }

    protected function isPublic(array $item): bool
    {
        return !($item['ignore'] ?? false) && !($item['internal'] ?? false);
    }

    protected function pick(array $item, array $keys): array
    {
        $result = [];
        foreach ($keys as $alias => $key) {
            if (is_int($alias)) $alias = $key;
            if (isset($item[$key])) $result[$alias] = $item[$key];
        }
        return $result;
    }

    protected function joinDescription(array|string $description): string
    {
        return is_array($description) ? implode(' ', $description) : $description;
    }

    protected function functionUsage(string $name, array $params): string
    {
        return $this->callVariations($name, $params);
    }

    protected function classMethodUsage(string $className, string $method, array $params, bool $static): string
    {
        $short = str_contains($className, '\\') ? substr($className, strrpos($className, '\\') + 1) : $className;

        if ($method === '__construct')
            return $this->callVariations("new $short", $params);

        if ($method === '__invoke')
            return $this->callVariations('$' . lcfirst($short), $params);

        $caller = $static ? "$short::" : '$' . lcfirst($short) . '->';

        return $this->callVariations("$caller$method", $params);
    }

    protected function callVariations(string $prefix, array $params): string
    {
        $args = [];
        $requiredCount = 0;

        foreach ($params as $param) {
            $argPrefix = !empty($param['variadic']) ? '...' : '';
            $args[] = $argPrefix . '$' . ($param['name'] ?? '');
            if (empty($param['optional'])) $requiredCount++;
        }

        $total = count($args);
        $lines = [];

        for ($i = $requiredCount; $i <= $total; $i++)
            $lines[] = "$prefix(" . implode(', ', array_slice($args, 0, $i)) . ")";

        if (empty($lines)) $lines[] = "$prefix()";

        return implode("\n", array_values(array_unique($lines)));
    }

    protected function exportProject(): array
    {
        $composer = $this->getComposerScheme();

        $project = array_filter([
            'name' => $composer['name'] ?? null,
            'description' => $composer['description'] ?? null,
            'version' => $composer['version'] ?? null,
            'homepage' => $composer['homepage'] ?? null,
        ]);

        foreach ($composer['requiredPackages'] ?? [] as $package => $info)
            $project['require'][$package] = array_filter([
                'name' => $info['name'] ?? null,
                'description' => $info['description'] ?? null,
                'version' => $info['version'] ?? null,
                'homepage' => $info['homepage'] ?? null,
            ]);

        foreach ($composer['suggestedPackages'] ?? [] as $package => $info)
            $project['suggest'][$package] = array_filter([
                'name' => $info['name'] ?? null,
                'description' => $info['description'] ?? null,
                'version' => $info['version'] ?? null,
                'homepage' => $info['homepage'] ?? null,
            ]);

        return $project;
    }

    protected function exportConstants(): array
    {
        $result = [];

        if (!env('AUTODOC_CONSTANTS')) return $result;

        foreach ($this->getHelperFiles()['constant'] ?? [] as $file)
            foreach (ReflectionHelperFile::schemeConstants($file) as $item)
                if ($this->isPublic($item))
                    $result[] = $this->pick($item, ['name', 'file' => '_file', 'description', 'deprecated', 'see']);

        return $result;
    }

    protected function exportEnvironment(): array
    {
        $result = [];

        if (!env('AUTODOC_ENVIRONMENT')) return $result;

        foreach ($this->getHelperFiles()['script'] ?? [] as $file)
            foreach (ReflectionHelperFile::schemeEnvironments($file) as $item)
                if ($this->isPublic($item))
                    $result[] = $this->pick($item, ['name', 'file' => '_file', 'description', 'deprecated', 'see']);

        return $result;
    }

    protected function exportFunctions(): array
    {
        $result = [];

        if (!env('AUTODOC_FUNCTIONS')) return $result;

        foreach ($this->getHelperFiles()['function'] ?? [] as $file)
            foreach (ReflectionHelperFile::schemeFunctions($file) as $item)
                if ($this->isPublic($item))
                    $result[] = $this->pickCallable($item);

        return $result;
    }

    protected function pickCallable(array $item, array $extra = []): array
    {
        $entry = $this->pick($item, array_merge(['name', 'file' => '_file', 'description', 'return', 'deprecated', 'see', 'example'], $extra));

        $params = [];
        foreach ($item['params'] ?? [] as $param)
            if ($this->isPublic($param))
                $params[] = array_filter($this->pick($param, ['name', 'type', 'description', 'optional', 'variadic', 'default']));

        if (!empty($params)) $entry['params'] = $params;

        return $entry;
    }

    protected function exportMiddleware(): array
    {
        $result = [];

        if (!env('AUTODOC_MIDDLEWARE')) return $result;

        foreach ($this->getMiddlewareFiles() as $file) {
            $item = ReflectionMiddlewareFile::scheme($file);
            if (!empty($item) && $this->isPublic($item))
                $result[] = $this->pick($item, ['name', 'file' => '_file', 'description', 'deprecated', 'see']);
        }

        return $result;
    }

    protected function exportTerminal(): array
    {
        $result = [];

        if (!env('AUTODOC_TERMINAL')) return $result;

        foreach ($this->getTerminalFiles() as $file) {
            $item = ReflectionCommandFile::scheme($file);
            if (!empty($item) && $this->isPublic($item))
                $result[] = $this->pickCallable($item);
        }

        return $result;
    }

    protected function exportRoutes(): array
    {
        $result = [];

        if (!env('AUTODOC_ROUTES')) return $result;

        foreach ($this->getRouteFiles() as $file) {
            foreach (ReflectionRouterFile::scheme($file) as $item) {
                $response = $item['response'] ?? [];

                $entry = array_filter([
                    'path' => $item['path'],
                    'method' => $item['method'],
                    'file' => $item['_file'],
                    'middlewares' => $item['middlewares'] ?: null,
                ]);

                if (($response['type'] ?? '') === 'status') {
                    $entry['response'] = ['type' => 'status', 'code' => $response['code']];
                } else {
                    $entry['response'] = array_filter([
                        'type' => 'class',
                        'class' => $response['class'] ?? null,
                        'method' => $response['method'] ?? null,
                        'description' => $response['description'] ?? null,
                        'file' => $response['_file'] ?? null,
                    ]);
                }

                $result[] = $entry;
            }
        }

        return $result;
    }

    protected function exportClasses(): array
    {
        $result = [];

        if (!env('AUTODOC_CLASSES')) return $result;

        foreach ($this->getPsr4Files() as $file) {
            $item = ReflectionSourceFile::scheme($file);
            if (empty($item) || !$this->isPublic($item)) continue;

            $entry = $this->pick($item, ['name', 'file' => '_file', 'description', 'abstract', 'final', 'extends', 'interface', 'traits', 'deprecated', 'see', 'example']);
            $entry['type'] = $item['_type'];

            $entry['constants'] = [];
            foreach ($item['constants'] ?? [] as $const)
                if ($this->isPublic($const) && ($const['visibility'] ?? 'public') !== 'private')
                    $entry['constants'][] = $this->pick($const, ['name', 'visibility', 'description', 'deprecated', 'see', 'inheritedFrom']);

            $entry['properties'] = [];
            foreach ($item['properties'] ?? [] as $prop)
                if ($this->isPublic($prop) && ($prop['visibility'] ?? 'public') !== 'private')
                    $entry['properties'][] = $this->pick($prop, ['name', 'type', 'visibility', 'static', 'description', 'deprecated', 'see', 'inheritedFrom']);

            $entry['methods'] = [];
            foreach ($item['methods'] ?? [] as $method)
                if ($this->isPublic($method) && ($method['visibility'] ?? 'public') !== 'private')
                    $entry['methods'][] = $this->pickCallable($method, ['visibility', 'static', 'abstract', 'final', 'inheritedFrom']);

            $result[] = array_filter($entry);
        }

        return $result;
    }

    protected function exportTests(): array
    {
        $result = [];

        foreach ($this->getTestFiles() as $file) {
            $item = ReflectionTestFile::scheme($file);
            if (!empty($item) && $this->isPublic($item))
                $result[] = $this->pick($item, ['name', 'file' => '_file', 'description']);
        }

        return $result;
    }

    protected function exportDatabase(): array
    {
        $result = [];

        if (!env('AUTODOC_DATABASE')) return $result;

        $isSet = fn($v) => !is_null($v);

        foreach ($this->getDatabaseNames() as $dbName) {
            $tables = [];
            foreach ((new SchemeMap($dbName))->get() as $tableName => $tableScheme) {
                $fields = [];
                foreach ($tableScheme['fields'] as $fieldName => $fieldScheme)
                    $fields[$fieldName] = array_filter([
                        'type' => $fieldScheme['type'] ?? null,
                        'comment' => $fieldScheme['comment'] ?? null,
                        'null' => $fieldScheme['null'] ?? null,
                        'default' => $fieldScheme['default'] ?? null,
                        'references' => ($fieldScheme['type'] ?? null) === 'idx' ? array_filter([
                            'database' => $fieldScheme['settings']['datalayer'] ?? null,
                            'table' => $fieldScheme['settings']['table'] ?? null,
                        ], $isSet) : null,
                    ], $isSet);

                $tables[$tableName] = array_filter([
                    'comment' => $tableScheme['comment'] ?? null,
                    'fields' => $fields,
                ], $isSet);
            }
            $result[$dbName] = ['tables' => $tables];
        }

        return $result;
    }
}

<?php

use PhpMx\Datalayer\Scheme\SchemeMap;
use PhpMx\Reflection\ReflectionCommandFile;
use PhpMx\Reflection\ReflectionHelperFile;
use PhpMx\Reflection\ReflectionMiddlewareFile;
use PhpMx\Reflection\ReflectionSourceFile;
use PhpMx\Terminal;
use PhpMx\Trait\AutodocTrait;

/** Verifica o status da documentação do projeto atual */
return new class {

    use AutodocTrait;

    protected int $count = 0;
    protected array $error = [];

    function __invoke()
    {
        // $this->scanComposer();
        // $this->scanHelper();
        // $this->scanTerminal();
        // $this->scanMiddleware();
        $this->scanPsr4();
        $this->scanDatabase();

        Terminal::progress('documentation', current: $this->count, total: count($this->error) + $this->count);

        if (!is_blank($this->error)) {
            Terminal::echol();
            Terminal::echol();
        }

        foreach ($this->error as $error) {
            list($type, $name, $file, $line) = $error;
            $file = !is_blank($line) ? "$file:$line" : $file;
            Terminal::echol("[#c:dd,#] [#c:p,#] [#c:wd,#]", [$type, $name, $file]);
        }
    }

    function scanDatabase()
    {
        foreach ($this->getDatabaseNames() as $dbName) {
            $scheme = new SchemeMap($dbName);
            foreach ($scheme->get() as $tableName => $tableScheme)
                $this->check_dbTableMode($tableScheme, "main", $tableName);
        }
    }

    function scanPsr4()
    {
        foreach ($this->getPsr4Files() as $file) {
            $item = ReflectionSourceFile::scheme($file);
            $this->check_classMode($item, $item['_type'], $item['name'], $item['_file'], $item['_line']);
        }
    }

    function scanMiddleware()
    {
        foreach ($this->getMiddlewareFiles() as $file) {
            $item = ReflectionMiddlewareFile::scheme($file);
            $this->check_simpleMode($item, 'middleware', $item['name'], $item['_file'], $item['_line']);
        }
    }

    function scanTerminal()
    {
        foreach ($this->getTerminalFiles() as $file) {
            $item = ReflectionCommandFile::scheme($file);
            $this->check_simpleMode($item, 'command', $item['name'], $item['_file'], $item['_line']);
        }
    }

    function scanHelper()
    {
        $scheme = $this->getHelperFiles();

        foreach ($scheme['constant'] as $file)
            foreach (ReflectionHelperFile::schemeConstants($file) as $item)
                $this->check_simpleMode($item, 'helper.constant', $item['name'], $item['_file'], $item['_line']);

        foreach ($scheme['function'] as $file)
            foreach (ReflectionHelperFile::schemeFunctions($file) as $item)
                $this->check_functionMode($item, 'helper.function', $item['name'], $item['_file'], $item['_line']);

        foreach ($scheme['script'] as $file)
            foreach (ReflectionHelperFile::schemeEnvironments($file) as $item)
                $this->check_simpleMode($item, 'helper.script', $item['name'], $item['_file'], $item['_line']);
    }

    function scanComposer()
    {
        $this->check_simpleMode($this->getComposerScheme(), 'composer', 'description', 'composer.json');
    }

    function check_simpleMode(array $item, string $group, string $name, string $file, ?string $line = null)
    {
        if ($item['ignore'] ?? false) return;
        if (str_ends_with($group, '.param') && is_null($line)) return;

        $this->count++;
        if (is_blank($item['description']))
            $this->error[] = [$group, $name, $file, $line];
    }

    function check_functionMode(array $item, string $group, string $name, string $file, ?string $line = null)
    {
        if ($item['ignore'] ?? false) return;

        if (!str_ends_with($name, '.__construct')) {
            $this->count++;
            if (is_blank($item['description']))
                $this->error[] = [$group, $name, $file, $line];
        }

        foreach ($item['params'] ?? [] as $param)
            $this->check_simpleMode($param, "$group.param", "$name.$param[name]", $file, $line);
    }

    function check_classMode(array $item, string $group, string $name, string $file, ?string $line = null)
    {
        if ($item['ignore'] ?? false) return;

        $this->count++;
        if (is_blank($item['description']))
            $this->error[] = [$group, $name, $file, $line];

        foreach ($item['methods'] ?? [] as $method)
            $this->check_functionMode($method, "$group.method", "$name.$method[name]", $file, $method['line']);
    }

    function check_dbTableMode(array $tableScheme, string $database, string $tableName)
    {
        $this->count++;
        if (is_blank($tableScheme['comment']))
            $this->error[] = ['db.table', $tableName, $database, null];

        foreach ($tableScheme['fields'] as $fieldName => $fieldScheme) {
            $this->count++;
            if (is_blank($fieldScheme['comment']))
                $this->error[] = ['db.table.field', "$tableName.$fieldName", $database, null];
        }
    }
};

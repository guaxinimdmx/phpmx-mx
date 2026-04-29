<?php

namespace PhpMx\Trait;

use PhpMx\Datalayer;
use PhpMx\Dir;
use PhpMx\File;
use PhpMx\Json;

trait AutoReflectionTrait
{
    protected function getSchemeRoute()
    {
        $scheme = [];

        foreach (Dir::seekForFile('system/router', true) as $file)
            $scheme[] = path('system/router', $file);

        return $scheme;
    }

    protected function getSchemeDatabase()
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

    protected function getSchemeRootFile()
    {
        $scheme = [];

        $scheme['.conf'] = File::check('.conf');
        $scheme['deploy'] = File::check('deploy');
        $scheme['index.php'] = File::check('index.php');
        $scheme['install'] = File::check('install');

        return $scheme;
    }

    protected function getSchemePsr4()
    {
        $scheme = [];

        foreach (Dir::seekForFile('class', true) as $file)
            $scheme[] = path('class', $file);

        return $scheme;
    }

    protected function getSchemeMigration()
    {
        $scheme = [];

        foreach (Dir::seekForFile('system/migration', true) as $file)
            $scheme[] = path('system/migration', $file);

        return $scheme;
    }

    protected function getSchemeMiddleware()
    {
        $scheme = [];

        foreach (Dir::seekForFile('system/middleware', true) as $file)
            $scheme[] = path('system/middleware', $file);

        return $scheme;
    }

    protected function getSchemeTerminal()
    {
        $scheme = [];

        foreach (Dir::seekForFile('system/terminal', true) as $file)
            $scheme[] = path('system/terminal', $file);

        return $scheme;
    }

    protected function getSchemeHelper()
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

    protected function getSchemeComposer(?string $file = null)
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
                    $scheme['requiredPackages'][$package] = $this->getSchemeComposer($packageComposer);
            }

            foreach (array_keys($scheme['suggest']) as $package) {;
                $packageComposer = path('vendor', $package, 'composer.json');
                if (File::check($packageComposer))
                    $scheme['suggestedPackages'][$package] = $this->getSchemeComposer($packageComposer);
            }
        }

        return $scheme;
    }
}

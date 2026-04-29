<?php

use PhpMx\Trace;

class_exists(Trace::class);

$registeredLoaders = spl_autoload_functions();

foreach ($registeredLoaders as $loader) spl_autoload_unregister($loader);

spl_autoload_register(fn($class) => Trace::add('autoload', $class, function () use ($class, $registeredLoaders) {
    foreach ($registeredLoaders as $loader) {
        $loader($class);
        if (class_exists($class, false)) return;
    }
}));

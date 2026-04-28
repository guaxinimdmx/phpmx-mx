<?php

use PhpMx\Trace;

class_exists(Trace::class);

$composerLoader = spl_autoload_functions()[0];

foreach (spl_autoload_functions() as $loader) spl_autoload_unregister($loader);

spl_autoload_register(fn($class) => Trace::add('autoload', $class, fn() => $composerLoader($class)));

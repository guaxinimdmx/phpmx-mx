<?php

namespace PhpMx;

use Exception;
use PhpMx\Trait\TerminalEchoTrait;
use ReflectionMethod;
use Throwable;

/** Classe base para criação e execução de comandos de terminal. */
abstract class Terminal
{
    use TerminalEchoTrait;

    /**
     * Executa uma linha de comando
     * @param mixed ...$commandLine Comando que deve ser executado
     * @example Terminal::run('make.command teste') Equivalente a php mx make.command teste
     * @example Terminal::run('make.command', 'teste') Equivalente a php mx make.command teste
     */
    final static function run(...$commandLine): bool
    {
        $commandLine = implode(' ', $commandLine);
        $commandLine = explode(' ', $commandLine);

        $showTrace = false;

        $commandLine = array_map(fn($v) => trim($v), $commandLine);
        $commandLine = array_filter($commandLine, fn($v) => boolval($v));

        if (!empty($commandLine) && str_starts_with($commandLine[0], '+')) {
            $showTrace = true;
            $commandLine[0] = substr($commandLine[0], 1);
            if (empty($commandLine[0])) unset($commandLine[0]);
        }

        if (empty($commandLine)) $commandLine = ['logo'];
        $result = Trace::add('mx', 'terminal ' . implode(' ', $commandLine), function () use ($commandLine) {
            try {
                $command = array_shift($commandLine);
                $params = $commandLine;

                $commandFile = remove_accents($command);
                $commandFile = strtolower($commandFile);

                $commandFile = explode('.', $commandFile);
                $commandFile = array_map(fn($v) => strtolower($v), $commandFile);
                $commandFile = path('system/terminal', ...$commandFile);
                $commandFile = File::setEx($commandFile, 'php');

                $commandFile = Path::seekForFile($commandFile);

                if (!$commandFile)
                    throw new Exception("Command [$command] not found");

                $action = Import::return($commandFile);

                if (!is_object($action) || !is_callable($action))
                    throw new Exception("Command [$command] not is object callable");

                $reflection = new ReflectionMethod($action, '__invoke');

                $countParams = count($params);
                foreach ($reflection->getparameters() as $required) {
                    if ($countParams) {
                        $countParams--;
                    } elseif (!$required->isDefaultValueAvailable() && !$required->isVariadic()) {
                        $name = $required->getName();
                        throw new Exception("Parameter [$name] is required in [$command]");
                    }
                }

                return boolval($action(...$params) ?? true);
            } catch (Throwable $e) {
                self::echoThrow($e);
                Trace::exception($e);
                return false;
            }
        });

        if (env('DEV') && $showTrace) {
            self::echo();
            self::echo(Trace::getString());
        }

        return $result;
    }

    /**
     * Executa um comando no terminal do sistema.
     * @param string $commandLine Linha de comando que deve ser executada  
     * @return void
     */
    final static function exec(string $commandLine): void
    {
        self::echol('Running [#c:s,#]', $commandLine);
        if (self::checkANSI()) putenv('FORCE_COLOR=1');
        passthru($commandLine);
    }
}

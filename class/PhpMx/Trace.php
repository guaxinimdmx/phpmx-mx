<?php

namespace PhpMx;

use Closure;
use Throwable;

/** Classe utilitária para registro estruturado de traces e escopos. */
abstract class Trace
{
    /** @ignore */
    protected static array $trace = [];

    /** @ignore */
    protected static array $scope = [];

    /** @ignore */
    protected static bool $useTrace = true;

    /**
     * Habilita ou desabilita o registro de traces.
     * @param bool $useTrace True para habilitar, false para desabilitar.
     * @return void
     */
    static function useTrace(bool $useTrace): void
    {
        self::$useTrace = $useTrace;
    }

    /**
     * Adiciona uma linha de trace ou abre um escopo de execução via Closure.
     * @param string $typeScope Categoria do trace.
     * @param string $message Mensagem do trace.
     * @param Closure|null $scope Closure opcional para criar um escopo de trace.
     * @return mixed Retorno do Closure ou o resultado do trace.
     */
    static function add(string $typeScope, string $message, ?Closure $scope = null): mixed
    {
        if (!self::$useTrace)
            return $scope();

        if (is_null($scope)) {
            self::set($typeScope, $message);
            return null;
        }

        try {
            self::openScope($typeScope, $message);
            $result = $scope();
            self::closeScope();
            return $result;
        } catch (Throwable $e) {
            self::exception($e);
            self::closeScope();
            throw $e;
        }
    }

    /**
     * Altera os dados da linha do escopo que está aberto no momento.
     * @param string $newType Novo tipo/categoria.
     * @param string $message Nova mensagem.
     * @return void
     */
    static function changeScope(string $newType, string $message): void
    {
        if (!self::$useTrace) return;

        if (count(self::$scope)) {
            $scopeKey = end(self::$scope);
            self::$trace[$scopeKey][0] = $newType;
            self::$trace[$scopeKey][1] = $message;
        }
    }

    /**
     * Registra uma exceção detalhada no trace.
     * @param Throwable $e A exceção a ser registrada.
     * @return void
     */
    static function exception(Throwable $e): void
    {
        if (!self::$useTrace) return;

        $type = $e::class;
        $message = $e->getMessage();
        $file = path($e->getFile());
        $line = $e->getLine();

        self::set($type, "$message $file ($line)");
    }

    /**
     * Retorna o trace processado com contadores de categorias.
     * @return array ['trace' => array, 'count' => array]
     */
    static function get(): array
    {
        $currentTrace = self::$trace;
        $currentScope = self::$scope;
        $encapsLine = ['mx', 'trace', -1, memory_get_peak_usage(true)];

        while (count($currentScope)) {
            $scopeKey = array_pop($currentScope);
            self::closeLine($currentTrace[$scopeKey]);
        }

        array_unshift($currentTrace, $encapsLine);
        $count = [];

        foreach ($currentTrace as $pos => $line) {
            list($type, $message, $scope, $memory) = $line;
            $type = strToCamelCase($type);
            $message = str_replace('\\', '.', $message);
            $scope += 1;
            $memory = self::formatMemory($memory);
            $count[$type] = $count[$type] ?? 0;
            $count[$type]++;

            $currentTrace[$pos] = [
                $type,
                $message,
                $scope,
                $memory,
            ];
        }

        ksort($count);
        if (isset($count['mx'])) {
            $count = ['mx' => $count['mx']] + $count;
        }

        return [
            'trace' => $currentTrace,
            'count' => $count
        ];
    }

    /**
     * Retorna o trace formatado em um array de strings.
     * @return array
     */
    static function getArray(): array
    {
        $traceData = self::get();
        $lines = $traceData['trace'];
        $count = $traceData['count'];
        $output = [];

        foreach ($lines as $line) {
            list($type, $message, $scope, $memory) = $line;

            $info = [];

            if ($memory) $info[] = $memory;

            $infoText = count($info) ? ' [' . implode('|', $info) . ']' : '';

            $output[] = str_repeat('| ', $scope) . "[$type] $message$infoText";
        }

        $output[] = $count;
        return $output;
    }

    /**
     * Retorna o trace formatado como uma string completa.
     * @return string
     */
    static function getString(): string
    {
        $traceData = self::get();
        $lines = $traceData['trace'];
        $count = $traceData['count'];
        $output = "-------------------------\n";

        foreach ($lines as $line) {
            list($type, $message, $scope, $memory) = $line;

            $info = [];

            if ($memory) $info[] = $memory;

            $info = count($info) ? ' [' . implode('|', $info) . ']' : '';

            $output .= str_repeat('| ', $scope) . "[$type] $message$info" . "\n";
        }

        $output .= "-------------------------\n";

        foreach ($count as $type => $qty)
            $output .= "[$qty] $type\n";

        $output .= "-------------------------\n";

        return trim($output);
    }

    /** @ignore */
    protected static function set(string $type, ?string $message = null, bool $isScope = false)
    {
        $scope = count(self::$scope);
        self::$trace[] = [$type, $message, $scope, null];
    }


    /** @ignore */
    protected static function openScope(string $type, ?string $message = null)
    {
        self::set($type, $message);
        $index = count(self::$trace) - 1;
        self::$trace[$index][3] = memory_get_peak_usage(true);
        self::$scope[] = $index;
    }

    /** @ignore */
    protected static function closeScope()
    {
        if (count(self::$scope)) {
            $scopeKey = array_pop(self::$scope);
            self::closeLine(self::$trace[$scopeKey]);
        }
    }

    /** @ignore */
    protected static function closeLine(&$line)
    {
        $line[3] = $line[3] ? memory_get_peak_usage(true) - $line[3] : null;
    }

    /** @ignore */
    protected static function formatMemory(?int $bytes): ?string
    {
        if (is_null($bytes)) return null;

        if ($bytes < 1) return null;

        if ($bytes < 1024) return $bytes . 'b';
        if ($bytes < 1048576) return round($bytes / 1024, 2) . 'kb';
        if ($bytes < 1073741824) return round($bytes / 1048576, 2) . 'mb';
        return round($bytes / 1073741824, 2) . 'gb';
    }
}

<?php

namespace PhpMx\Trait;

use PhpMx\Terminal;
use Throwable;

/** Trait para criação de baterias de testes via terminal */
trait TerminalTestTrait
{
    protected int $successes = 0;
    protected int $fails = 0;
    protected ?string $error = null;

    /** @ignore */
    final function __invoke()
    {
        try {
            $this->run();
        } catch (Throwable $e) {
            Terminal::echoThrow($e);
            $this->error = $e->getMessage();
        }

        Terminal::echol();

        return [$this->successes, $this->fails, $this->error];
    }

    /** @ignore */
    abstract function run();

    /**
     * Verifica se o retorno do callable é idêntico ao valor esperado
     * @param string $label Descrição do teste
     * @param callable $fn Callable a ser executado
     * @param mixed $expected Valor esperado
     */
    protected function isEqual(string $label, callable $fn, mixed $expected): void
    {
        Terminal::echod('  [#] [#c:dd,(...)]', [$label]);

        try {
            $result = $fn();
            $passed = $result === $expected;
            $reason = $passed ? null : prepare(
                'esperado [#], obtido [#]',
                [var_export($expected, true), var_export($result, true)]
            );
        } catch (Throwable $e) {
            $passed = false;
            $reason = $e->getMessage();
        }

        $this->_assert($label, $passed, $reason);
    }

    /**
     * Verifica se o retorno do callable é diferente do valor informado
     * @param string $label Descrição do teste
     * @param callable $fn Callable a ser executado
     * @param mixed $expected Valor que não deve ser retornado
     */
    protected function isNotEqual(string $label, callable $fn, mixed $expected): void
    {
        Terminal::echod('  [#] [#c:dd,(...)]', [$label]);

        try {
            $result = $fn();
            $passed = $result !== $expected;
            $reason = $passed ? null : prepare(
                'obtido [#], igual ao não esperado',
                [var_export($result, true)]
            );
        } catch (Throwable $e) {
            $passed = false;
            $reason = $e->getMessage();
        }

        $this->_assert($label, $passed, $reason);
    }

    /**
     * Verifica se o retorno do callable é estritamente true
     * @param string $label Descrição do teste
     * @param callable $fn Callable a ser executado
     */
    protected function isTrue(string $label, callable $fn): void
    {
        Terminal::echod('  [#] [#c:dd,(...)]', [$label]);

        try {
            $result = $fn();
            $passed = $result === true;
            $reason = $passed ? null : prepare(
                'obtido [#], esperado true',
                [var_export($result, true)]
            );
        } catch (Throwable $e) {
            $passed = false;
            $reason = $e->getMessage();
        }

        $this->_assert($label, $passed, $reason);
    }

    /**
     * Verifica se o retorno do callable é estritamente false
     * @param string $label Descrição do teste
     * @param callable $fn Callable a ser executado
     */
    protected function isFalse(string $label, callable $fn): void
    {
        Terminal::echod('  [#] [#c:dd,(...)]', [$label]);

        try {
            $result = $fn();
            $passed = $result === false;
            $reason = $passed ? null : prepare(
                'obtido [#], esperado false',
                [var_export($result, true)]
            );
        } catch (Throwable $e) {
            $passed = false;
            $reason = $e->getMessage();
        }

        $this->_assert($label, $passed, $reason);
    }

    /**
     * Verifica se o retorno do callable é null
     * @param string $label Descrição do teste
     * @param callable $fn Callable a ser executado
     */
    protected function isNull(string $label, callable $fn): void
    {
        Terminal::echod('  [#] [#c:dd,(...)]', [$label]);

        try {
            $result = $fn();
            $passed = $result === null;
            $reason = $passed ? null : prepare(
                'obtido [#], esperado null',
                [var_export($result, true)]
            );
        } catch (Throwable $e) {
            $passed = false;
            $reason = $e->getMessage();
        }

        $this->_assert($label, $passed, $reason);
    }

    /**
     * Verifica se o retorno do callable é uma instância da classe ou interface informada
     * @param string $label Descrição do teste
     * @param callable $fn Callable a ser executado
     * @param string $class Classe ou interface esperada
     */
    protected function isInstanceOf(string $label, callable $fn, string $class): void
    {
        Terminal::echod('  [#] [#c:dd,(...)]', [$label]);

        try {
            $result = $fn();
            $passed = $result instanceof $class;
            $reason = $passed ? null : prepare(
                'esperado instância de [#], obtido [#]',
                [$class, is_object($result) ? $result::class : gettype($result)]
            );
        } catch (Throwable $e) {
            $passed = false;
            $reason = $e->getMessage();
        }

        $this->_assert($label, $passed, $reason);
    }

    /**
     * Verifica se o retorno do callable (array ou Countable) tem a quantidade esperada de itens
     * @param string $label Descrição do teste
     * @param callable $fn Callable a ser executado
     * @param int $expected Quantidade esperada de itens
     */
    protected function isCount(string $label, callable $fn, int $expected): void
    {
        Terminal::echod('  [#] [#c:dd,(...)]', [$label]);

        try {
            $result = $fn();
            $count = count($result);
            $passed = $count === $expected;
            $reason = $passed ? null : prepare(
                'esperado [#] itens, obtido [#]',
                [$expected, $count]
            );
        } catch (Throwable $e) {
            $passed = false;
            $reason = $e->getMessage();
        }

        $this->_assert($label, $passed, $reason);
    }

    /**
     * Verifica se o retorno do callable (array) contém o valor informado
     * @param string $label Descrição do teste
     * @param callable $fn Callable a ser executado
     * @param mixed $needle Valor que deve estar presente no array
     */
    protected function isContains(string $label, callable $fn, mixed $needle): void
    {
        Terminal::echod('  [#] [#c:dd,(...)]', [$label]);

        try {
            $result = $fn();
            $passed = in_array($needle, $result, true);
            $reason = $passed ? null : prepare(
                '[#] não encontrado em [#]',
                [var_export($needle, true), var_export($result, true)]
            );
        } catch (Throwable $e) {
            $passed = false;
            $reason = $e->getMessage();
        }

        $this->_assert($label, $passed, $reason);
    }

    /**
     * Verifica se o callable lança uma exception
     * @param string $label Descrição do teste
     * @param callable $fn Callable a ser executado
     * @param string|int|null $expected Classe esperada, código STS_* esperado, ou null para qualquer exception
     */
    protected function isThrow(string $label, callable $fn, string|int|null $expected = null): void
    {
        Terminal::echod('  [#] [#c:dd,(...)]', [$label]);

        try {
            $fn();
            $passed = false;
            $reason = 'não lançou nenhuma exception';
        } catch (Throwable $e) {
            if ($expected === null) {
                $passed = true;
                $reason = null;
            } elseif (is_string($expected)) {
                $passed = is_class($e, $expected);
                $reason = $passed ? null : prepare('esperado [#], obtido [#]', [$expected, $e::class]);
            } else {
                $passed = $e->getCode() === $expected;
                $reason = $passed ? null : prepare('esperado código [#], obtido [#]', [$expected, $e->getCode()]);
            }
        }

        $this->_assert($label, $passed, $reason);
    }

    /**
     * Verifica se o callable não lança uma exception
     * @param string $label Descrição do teste
     * @param callable $fn Callable a ser executado
     * @param string|int|null $expected Classe que não deve ser lançada, código STS_* que não deve ocorrer, ou null para nenhuma exception
     */
    protected function isNotThrow(string $label, callable $fn, string|int|null $expected = null): void
    {
        Terminal::echod('  [#] [#c:dd,(...)]', [$label]);

        try {
            $fn();
            $passed = true;
            $reason = null;
        } catch (Throwable $e) {
            if ($expected === null) {
                $passed = false;
                $reason = prepare('lançou [#]', [$e::class]);
            } elseif (is_string($expected)) {
                $passed = !is_class($e, $expected);
                $reason = $passed ? null : prepare('lançou [#]', [$e::class]);
            } else {
                $passed = $e->getCode() !== $expected;
                $reason = $passed ? null : prepare('lançou exception com código [#]', [$e->getCode()]);
            }
        }

        $this->_assert($label, $passed, $reason);
    }

    /** @ignore */
    private function _assert(string $label, bool $passed, ?string $reason = null): void
    {
        if ($passed) {
            $this->successes++;
            Terminal::echod('  [#c:s,#] [#c:sd,(ok)]', [$label]);
        } else {
            $this->fails++;
            Terminal::echod('  [#c:w,#] [#c:wd,(failed)]', [$label]);
        }

        Terminal::echol();

        if ($reason) Terminal::echol('    [#c:dd,#]', $reason);
    }
}

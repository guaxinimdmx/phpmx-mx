<?php

namespace PhpMx\Datalayer\Driver\Field;

use DateTime;

/** Campo de timestamp (TIMESTAMP), com microsegundos no formato Y-m-d H:i:s.u. Retorna float (microtime) por padrão. */
class FTimestamp extends FDatetime
{
    /**
     * Define o valor de timestamp com microsegundos. Aceita true ou 'CURRENT_TIMESTAMP' (microtime atual), int (sem micros) ou float (com micros), ou false (null).
     * @param mixed $value Valor a definir.
     * @return static
     */
    function set($value): static
    {
        if ($value === true || $value === 'CURRENT_TIMESTAMP') $value = microtime(true);
        if ($value === false) $value = null;
        if (is_int($value)) $value = date('Y-m-d H:i:s', $value) . '.000000';
        if (is_float($value)) {
            $sec = (int)$value;
            $micro = sprintf('%06d', (int)round(($value - $sec) * 1_000_000));
            $value = date('Y-m-d H:i:s', $sec) . '.' . $micro;
        }
        return parent::set($value);
    }

    /**
     * Retorna o valor de timestamp. Com $format true (padrão) retorna float com microsegundos, false retorna int, null retorna a string Y-m-d H:i:s.u, ou string formata via DateTime::format().
     * @param null|bool|string $format Formato de retorno.
     */
    function get($format = true)
    {
        $value = parent::get(null);
        if (is_null($format) || is_null($value)) return $value;
        $dt = DateTime::createFromFormat('Y-m-d H:i:s.u', $value) ?: DateTime::createFromFormat('Y-m-d H:i:s', $value);
        if ($format === true) return (float)$dt->format('U') + (int)$dt->format('u') / 1_000_000;
        if ($format === false) return (int)$dt->format('U');
        return $dt->format($format);
    }
}

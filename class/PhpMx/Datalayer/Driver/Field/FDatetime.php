<?php

namespace PhpMx\Datalayer\Driver\Field;

use DateTime;
use PhpMx\Datalayer\Driver\Field;

/** Campo de data e hora (DATETIME), com suporte a microsegundos no formato Y-m-d H:i:s.u. */
class FDatetime extends Field
{
    /**
     * Define o valor de data e hora. Aceita float (microtime), int (timestamp), true/CURRENT_TIMESTAMP (hora atual com microsegundos), false (null) ou string formatada.
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

    function get($format = null)
    {
        $value = parent::get();
        if (is_null($format) || is_null($value)) return $value;
        $dt = DateTime::createFromFormat('Y-m-d H:i:s.u', $value) ?: DateTime::createFromFormat('Y-m-d H:i:s', $value);
        if ($format === true) return (float)$dt->format('U') + (int)$dt->format('u') / 1_000_000;
        if ($format === false) return (int)$dt->format('U');
        return $dt->format($format);
    }
}

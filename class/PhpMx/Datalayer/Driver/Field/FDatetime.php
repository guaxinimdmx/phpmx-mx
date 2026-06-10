<?php

namespace PhpMx\Datalayer\Driver\Field;

use PhpMx\Datalayer\Driver\Field;

/** Campo de data e hora (DATETIME), no formato Y-m-d H:i:s, sem microsegundos. */
class FDatetime extends Field
{
    function set($value): static
    {
        if ($value === true || $value === 'CURRENT_TIMESTAMP') $value = time();
        if ($value === false) $value = null;
        if (is_int($value) || is_float($value)) $value = date('Y-m-d H:i:s', (int)$value);
        return parent::set($value);
    }

    function get($format = null)
    {
        $value = parent::get();
        if (is_null($format) || is_null($value)) return $value;
        $timestamp = strtotime($value);
        if ($format === true) return (float)$timestamp;
        if ($format === false) return (int)$timestamp;
        return date($format, $timestamp);
    }
}

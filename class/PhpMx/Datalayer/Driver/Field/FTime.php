<?php

namespace PhpMx\Datalayer\Driver\Field;

/** Campo de tempo (TIME), com conversão automática de timestamp inteiro para string no formato H:i:s. */
class FTime extends FDate
{
    function set($value): static
    {
        if ($value === false) $value = null;
        if (is_int($value) || is_float($value)) $value = date('H:i:s', (int)$value);
        return parent::set($value);
    }

    function get($format = null)
    {
        return parent::get($format);
    }
}

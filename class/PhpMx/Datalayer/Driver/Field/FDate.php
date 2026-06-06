<?php

namespace PhpMx\Datalayer\Driver\Field;

use PhpMx\Datalayer\Driver\Field;

/** Campo de data (DATE), com conversão automática de timestamp inteiro para string no formato Y-m-d. */
class FDate extends Field
{
    /**
     * Define o valor de data. Aceita timestamp inteiro (convertido para Y-m-d) ou false (null).
     * @param mixed $value Valor a definir.
     * @return static
     */
    function set($value): static
    {
        if ($value === false) $value = null;
        if (is_int($value) || is_float($value)) $value = date('Y-m-d', $value);
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

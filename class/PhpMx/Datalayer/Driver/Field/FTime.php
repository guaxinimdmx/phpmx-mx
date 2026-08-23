<?php

namespace PhpMx\Datalayer\Driver\Field;

/** Campo de tempo (TIME), com conversão automática de timestamp inteiro para string no formato H:i:s. */
class FTime extends FDate
{
    /**
     * Define o valor de tempo. Aceita timestamp inteiro (convertido para H:i:s) ou false (null).
     * @param mixed $value Valor a definir.
     * @return static
     */
    function set($value): static
    {
        if ($value === false) $value = null;
        if (is_int($value) || is_float($value)) $value = date('H:i:s', (int)$value);
        return parent::set($value);
    }

    /**
     * Retorna o valor de tempo. Com $format null retorna a string H:i:s, true retorna float timestamp, false retorna int timestamp, ou string formata via date().
     * @param null|bool|string $format Formato de retorno.
     */
    function get($format = null)
    {
        return parent::get($format);
    }
}

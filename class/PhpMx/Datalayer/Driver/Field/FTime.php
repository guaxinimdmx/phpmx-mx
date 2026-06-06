<?php

namespace PhpMx\Datalayer\Driver\Field;

/** Campo de tempo (TIME), com conversão automática de timestamp inteiro para string no formato H:i:s. Retorna int sem microsegundos por padrão. */
class FTime extends FDate
{
    function get($format = false)
    {
        return parent::get($format);
    }
}

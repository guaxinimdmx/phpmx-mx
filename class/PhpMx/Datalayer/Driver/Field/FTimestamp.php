<?php

namespace PhpMx\Datalayer\Driver\Field;

/** Campo de timestamp (TIMESTAMP). Retorna float com microsegundos por padrão. */
class FTimestamp extends FDatetime
{
    function get($format = true)
    {
        return parent::get($format);
    }
}

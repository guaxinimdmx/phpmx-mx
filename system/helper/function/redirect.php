<?php

if (!function_exists('redirect')) {

    /**
     * Lança uma Exception de redirecionamento para a URL composta pelos argumentos fornecidos.
     * @param string ...$pathParams Partes da URL de destino.
     * @return void
     */
    function redirect(string ...$pathParams): void
    {
        throw new Exception(url(...$pathParams), STS_REDIRECT);
    }
}

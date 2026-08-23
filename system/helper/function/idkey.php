<?php

use PhpMx\Cif;

if (!function_exists('idKeyType')) {

    /**
     * Retorna o tipo de um idKey (nome da tabela associada ao registro).
     * @param string $idKey IdKey a ser decodificado.
     * @return string|null
     */
    function idKeyType(string $idKey): ?string
    {
        try {
            $decoded = Cif::off($idKey);
            return is_array($decoded) ? $decoded[0] : null;
        } catch (Throwable) {
            return null;
        }
    }
}

if (!function_exists('idKeyId')) {

    /**
     * Retorna o id numérico de um idKey.
     * @param string $idKey IdKey a ser decodificado.
     * @return int|null
     */
    function idKeyId(string $idKey): ?int
    {
        try {
            $decoded = Cif::off($idKey);
            return is_array($decoded) ? $decoded[1] : null;
        } catch (Throwable) {
            return null;
        }
    }
}

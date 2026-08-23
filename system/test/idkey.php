<?php

use PhpMx\Cif;
use PhpMx\Trait\TerminalTestTrait;

/** Testa os helpers idKeyType e idKeyId */
return new class {

    use TerminalTestTrait;

    function run()
    {
        $idKey = Cif::on(['users', 42]);

        $this->isEqual('idKeyType: retorna tipo', fn() => idKeyType($idKey), 'users');
        $this->isEqual('idKeyId: retorna id', fn() => idKeyId($idKey), 42);

        // outro tipo
        $idKey2 = Cif::on(['products', 7]);
        $this->isEqual('idKeyType: outro tipo', fn() => idKeyType($idKey2), 'products');
        $this->isEqual('idKeyId: outro id', fn() => idKeyId($idKey2), 7);

        // idKey inválido retorna null
        $this->isNull('idKeyType: inválido retorna null', fn() => idKeyType('nao-e-idkey'));
        $this->isNull('idKeyId: inválido retorna null', fn() => idKeyId('nao-e-idkey'));
    }
};

<?php

use PhpMx\Request;
use PhpMx\Trait\TerminalTestTrait;

/** Testa o helper url() */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // URL absoluta passthrough
        $this->isEqual('absoluta: mantém https://', fn() => url('https://example.com'), 'https://example.com');
        $this->isEqual('absoluta: mantém http://', fn() => url('http://example.com'), 'http://example.com');

        // múltiplos segmentos
        $this->isEqual('segmentos: junta com /', fn() => url('https://example.com', 'api', 'v1'), 'https://example.com/api/v1');

        // query string via array
        $result = url('https://example.com', ['a' => 1, 'b' => 2]);
        $this->isTrue('query: via array contém ?', fn() => str_contains($result, '?'));
        $this->isTrue('query: via array contém a=1', fn() => str_contains($result, 'a=1'));
        $this->isTrue('query: via array contém b=2', fn() => str_contains($result, 'b=2'));

        // query string via string ?key=val
        $result2 = url('https://example.com', '?x=10&y=20');
        $this->isTrue('query: via string ?', fn() => str_contains($result2, 'x=10'));
        $this->isTrue('query: via string y', fn() => str_contains($result2, 'y=20'));

        // URL relativa: usa host/ssl de Request (propriedades protected, acesso via Reflection)
        $ref = new ReflectionClass(Request::class);
        $snapHost = $ref->getProperty('HOST');
        $snapSsl  = $ref->getProperty('SSL');
        $prevHost = $snapHost->getValue(null);
        $prevSsl  = $snapSsl->getValue(null);

        $snapHost->setValue(null, 'meusite.com.br');
        $snapSsl->setValue(null, false);
        $this->isEqual('relativa: monta com host', fn() => url('pagina'), 'http://meusite.com.br/pagina');

        $snapSsl->setValue(null, true);
        $this->isEqual('relativa: ssl true vira https', fn() => url('admin'), 'https://meusite.com.br/admin');

        $snapHost->setValue(null, $prevHost);
        $snapSsl->setValue(null, $prevSsl);

        // sem barras duplas no resultado
        $this->isFalse('sem barras duplas', fn() => str_contains(url('https://example.com', 'a', 'b'), '//a'));
    }
};

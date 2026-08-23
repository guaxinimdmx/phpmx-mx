<?php

use PhpMx\Datalayer\Driver\Field\FInt;
use PhpMx\Datalayer\Driver\Field\FFloat;
use PhpMx\Datalayer\Driver\Field\FVarchar;
use PhpMx\Datalayer\Driver\Field\FText;
use PhpMx\Datalayer\Driver\Field\FBoolean;
use PhpMx\Datalayer\Driver\Field\FJson;
use PhpMx\Datalayer\Driver\Field\FEmail;
use PhpMx\Datalayer\Driver\Field\FMd5;
use PhpMx\Datalayer\Driver\Field\FPassword;
use PhpMx\Datalayer\Driver\Field\FDate;
use PhpMx\Datalayer\Driver\Field\FTime;
use PhpMx\Datalayer\Driver\Field\FDatetime;
use PhpMx\Datalayer\Driver\Field\FTimestamp;
use PhpMx\Trait\TerminalTestTrait;

/** Testa os tipos de campo do Datalayer (sem banco de dados) */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // === Field base ===
        // null em não-nullable usa default
        $f = new FInt('f', false, 99, []);
        $f->set(null);
        $this->isEqual('Field: null não-nullable usa default', fn() => $f->get(), 99);

        // null em nullable aceita null
        $fn = new FInt('f', true, null, []);
        $fn->set(null);
        $this->isNull('Field: null nullable aceita null', fn() => $fn->get());

        // __internalValue(true) com null em não-nullable lança
        $fv = new FInt('f', false, null, []);
        $this->isThrow('Field: __internalValue(true) null não-nullable lança', fn() => $fv->__internalValue(true));

        // === FInt ===
        $fi = new FInt('f', false, 0, []);
        $this->isEqual('FInt: inteiro', fn() => $fi->set(42)->get(), 42);
        $this->isEqual('FInt: não-numérico vira default', fn() => $fi->set('abc')->get(), 0);
        $this->isEqual('FInt: float arredonda', fn() => $fi->set(3.9)->get(), 4);

        $fi2 = new FInt('f', false, 0, ['min' => 0, 'max' => 100]);
        $this->isEqual('FInt: clamp max', fn() => $fi2->set(200)->get(), 100);
        $this->isEqual('FInt: clamp min', fn() => $fi2->set(-5)->get(), 0);

        $fi3 = new FInt('f', false, 0, ['round' => -1]);
        $this->isEqual('FInt: round floor', fn() => $fi3->set(3.9)->get(), 3);

        // === FFloat ===
        $ff = new FFloat('f', true, null, []);
        $this->isEqual('FFloat: float', fn() => $ff->set(3.14)->get(), 3.14);
        $this->isNull('FFloat: não-numérico vira null', fn() => $ff->set('abc')->get());

        $ff2 = new FFloat('f', false, 0, ['min' => 0.0, 'max' => 1.2]);
        $this->isEqual('FFloat: clamp max', fn() => $ff2->set(5.0)->get(), 1.2);

        // === FVarchar ===
        $fvc = new FVarchar('f', false, '', ['size' => 10, 'crop' => false]);
        $this->isEqual('FVarchar: string', fn() => $fvc->set('hello')->get(), 'hello');
        $this->isEqual('FVarchar: inteiro vira string', fn() => $fvc->set(42)->get(), '42');
        $this->isEqual('FVarchar: trim', fn() => $fvc->set('  oi  ')->get(), 'oi');
        $this->isThrow('FVarchar: excede tamanho lança', fn() => $fvc->set('12345678901')->__internalValue(true));

        $fvc2 = new FVarchar('f', false, '', ['size' => 5, 'crop' => true]);
        $this->isEqual('FVarchar: crop corta', fn() => $fvc2->set('toolong')->get(), 'toolo');

        // === FText ===
        $ft = new FText('f', true, null, []);
        $this->isEqual('FText: string', fn() => $ft->set('texto longo')->get(), 'texto longo');
        $this->isEqual('FText: int vira string', fn() => $ft->set(7)->get(), '7');
        $this->isNull('FText: null nullable', fn() => $ft->set(null)->get());

        // === FBoolean ===
        $fb = new FBoolean('f', false, false, []);
        $this->isTrue('FBoolean: true', fn() => $fb->set(true)->get());
        $this->isFalse('FBoolean: false', fn() => $fb->set(false)->get());
        $this->isTrue('FBoolean: 1 vira true', fn() => $fb->set(1)->get());
        $this->isFalse('FBoolean: 0 vira false', fn() => $fb->set(0)->get());
        $this->isEqual('FBoolean: __internalValue true = 1', fn() => $fb->set(true)->__internalValue(), 1);
        $this->isEqual('FBoolean: __internalValue false = 0', fn() => $fb->set(false)->__internalValue(), 0);

        // === FJson ===
        $fj = new FJson('f', true, null, []);
        $this->isEqual('FJson: array', fn() => $fj->set(['a' => 1])->get(), ['a' => 1]);
        $this->isEqual('FJson: JSON string decodifica', fn() => $fj->set('{"x":2}')->get(), ['x' => 2]);
        $this->isNull('FJson: não-array vira null', fn() => $fj->set('nao-json')->get());
        $this->isEqual('FJson: __internalValue codifica', fn() => $fj->set(['k' => 'v'])->__internalValue(), '{"k":"v"}');

        // === FEmail ===
        $fe = new FEmail('f', false, '', ['size' => 255]);
        $this->isEqual('FEmail: normaliza minúscula', fn() => $fe->set('USER@EXAMPLE.COM')->get(), 'user@example.com');
        $this->isNotThrow('FEmail: email válido não lança', fn() => $fe->set('a@b.com')->__internalValue(true));
        $this->isThrow('FEmail: email inválido lança', fn() => $fe->set('nao-email')->__internalValue(true));

        // === FMd5 ===
        $fm = new FMd5('f', true, null, []);
        $hash = md5('hello');
        $this->isEqual('FMd5: string vira md5', fn() => $fm->set('hello')->get(), $hash);
        $this->isEqual('FMd5: md5 existente mantém', fn() => $fm->set($hash)->get(), $hash);
        $this->isTrue('FMd5: compare correto', fn() => $fm->set('hello')->compare('hello'));
        $this->isFalse('FMd5: compare errado', fn() => $fm->set('hello')->compare('world'));

        // === FPassword ===
        $fp = new FPassword('f', true, null, []);
        $this->isTrue('FPassword: gera hash bcrypt', fn() => str_starts_with($fp->set('secret')->get(), '$2y$'));
        $this->isTrue('FPassword: compare correto', fn() => $fp->set('secret')->compare('secret'));
        $this->isFalse('FPassword: compare errado', fn() => $fp->set('secret')->compare('wrong'));

        // === FDate ===
        $ts = mktime(0, 0, 0, 6, 15, 2023);
        $fd = new FDate('f', true, null, []);
        $this->isEqual('FDate: timestamp vira Y-m-d', fn() => $fd->set($ts)->get(), '2023-06-15');
        $this->isNull('FDate: false vira null', fn() => $fd->set(false)->get());
        $this->isEqual('FDate: get com formato', fn() => $fd->set($ts)->get('d/m/Y'), '15/06/2023');

        // === FTime ===
        $fti = new FTime('f', true, null, []);
        $this->isEqual('FTime: timestamp vira H:i:s', fn() => $fti->set(mktime(14, 30, 0))->get(), '14:30:00');
        $this->isNull('FTime: false vira null', fn() => $fti->set(false)->get());

        // === FDatetime ===
        $fdt = new FDatetime('f', true, null, []);
        $this->isEqual('FDatetime: timestamp vira Y-m-d H:i:s', fn() => $fdt->set(mktime(10, 0, 0, 1, 1, 2023))->get(), '2023-01-01 10:00:00');
        $this->isNull('FDatetime: false vira null', fn() => $fdt->set(false)->get());
        $this->isTrue('FDatetime: true vira datetime atual', fn() => is_string($fdt->set(true)->get()) && strlen($fdt->get()) == 19);

        // === FTimestamp ===
        $fts = new FTimestamp('f', true, null, []);
        $this->isTrue('FTimestamp: true vira float > 0', fn() => $fts->set(true)->get() > 0);
        $this->isNull('FTimestamp: false vira null', fn() => $fts->set(false)->get());
        $this->isTrue('FTimestamp: get retorna float', fn() => is_float($fts->set(microtime(true))->get()));
    }
};

<?php

use PhpMx\Input\InputField;
use PhpMx\Input\InputFieldBool;
use PhpMx\Input\InputFieldCaptcha;
use PhpMx\Input\InputFieldList;
use PhpMx\Input\InputFieldScheme;
use PhpMx\Input\InputFieldUpload;
use PhpMx\Input\InputFieldUploadImage;
use PhpMx\Cif;
use PhpMx\Env;
use PhpMx\Mx5;
use PhpMx\Trait\TerminalTestTrait;

/** Testa as subclasses de InputField */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // === InputField base ===

        // get: retorna valor
        $f = new InputField('nome', null, 'Ricardo');
        $this->isEqual('InputField: get retorna valor', fn() => $f->get(), 'Ricardo');

        // required: ausente lança exception
        $f2 = new InputField('nome', null, null);
        $this->isThrow('InputField: required ausente lança', fn() => $f2->get());

        // required false: ausente retorna null
        $f3 = new InputField('nome', null, null);
        $f3->required(false);
        $this->isNull('InputField: required false retorna null', fn() => $f3->get());

        // validate: closure válida passa
        $f4 = new InputField('num', null, '5');
        $f4->validate(fn($v) => $v > 0, 'deve ser positivo');
        $this->isEqual('InputField: validate válida passa', fn() => $f4->get(), 5);

        // validate: closure inválida lança
        $f5 = new InputField('num', null, '-1');
        $f5->validate(fn($v) => $v > 0, 'deve ser positivo');
        $this->isThrow('InputField: validate inválida lança', fn() => $f5->get());

        // validate: FILTER_VALIDATE_EMAIL válido
        $f6 = new InputField('email', null, 'teste@exemplo.com');
        $f6->validate(FILTER_VALIDATE_EMAIL);
        $this->isEqual('InputField: email válido passa', fn() => $f6->get(), 'teste@exemplo.com');

        // validate: FILTER_VALIDATE_EMAIL inválido lança
        $f7 = new InputField('email', null, 'nao-e-email');
        $f7->validate(FILTER_VALIDATE_EMAIL);
        $this->isThrow('InputField: email inválido lança', fn() => $f7->get());

        // sanitize: transforma valor
        $f8 = new InputField('nome', null, 'Ricardo');
        $f8->sanitize(fn($v) => strtoupper($v));
        $this->isEqual('InputField: sanitize transforma', fn() => $f8->get(), 'RICARDO');

        // preventTag: bloqueia HTML por padrão
        $f9 = new InputField('campo', null, '<b>texto</b>');
        $this->isThrow('InputField: preventTag bloqueia HTML', fn() => $f9->get());

        // preventTag false: permite HTML
        $f10 = new InputField('campo', null, '<b>texto</b>');
        $f10->preventTag(false);
        $this->isEqual('InputField: preventTag false permite HTML', fn() => $f10->get(), '<b>texto</b>');

        // send: lança Exception com JSON
        $f11 = new InputField('campo', null, 'x');
        $this->isThrow('InputField: send lança exception', fn() => $f11->send('erro'));

        // === InputFieldBool ===

        $this->isTrue('InputFieldBool: true', fn() => (new InputFieldBool('f', null, 'true'))->get());
        $this->isTrue('InputFieldBool: 1', fn() => (new InputFieldBool('f', null, '1'))->get());
        $this->isFalse('InputFieldBool: false', fn() => (new InputFieldBool('f', null, 'false'))->get());
        $this->isFalse('InputFieldBool: 0', fn() => (new InputFieldBool('f', null, '0'))->get());

        // === InputFieldList ===

        $this->isEqual('InputFieldList: array vira CSV', fn() => (new InputFieldList('f', null, ['a', 'b', 'c']))->get(), 'a,b,c');
        $this->isEqual('InputFieldList: string mantém', fn() => (new InputFieldList('f', null, 'x,y'))->get(), 'x,y');

        // === InputFieldScheme ===

        $json = '{"key":"valor"}';
        $this->isEqual('InputFieldScheme: JSON decodificado', fn() => (new InputFieldScheme('f', null, $json))->get(), ['key' => 'valor']);
        $this->isEqual('InputFieldScheme: array mantém', fn() => (new InputFieldScheme('f', null, ['a' => 1]))->get(), ['a' => 1]);
        $this->isThrow('InputFieldScheme: JSON inválido lança', fn() => (new InputFieldScheme('f', null, 'nao-json'))->get());

        // === InputFieldUpload ===

        $validFile = ['error' => 0, 'tmp_name' => 'x', 'size' => 100];
        $this->isEqual('InputFieldUpload: arquivo válido retorna array', fn() => (new InputFieldUpload('f', null, $validFile))->get(), $validFile);

        $this->isThrow('InputFieldUpload: error=1 (fileSize) lança', fn() => (new InputFieldUpload('f', null, ['error' => 1, 'tmp_name' => '', 'size' => 0]))->get());
        $this->isThrow('InputFieldUpload: error=2 (fileSize) lança', fn() => (new InputFieldUpload('f', null, ['error' => 2, 'tmp_name' => '', 'size' => 0]))->get());
        $this->isThrow('InputFieldUpload: error=3 lança', fn() => (new InputFieldUpload('f', null, ['error' => 3, 'tmp_name' => '', 'size' => 0]))->get());
        $this->isThrow('InputFieldUpload: não é array lança', fn() => (new InputFieldUpload('f', null, 'nao-array'))->get());

        // === InputFieldUploadImage ===

        $validB64 = 'data:image/png;base64,' . base64_encode('fake-png-data');
        $this->isEqual('InputFieldUploadImage: base64 válido retorna valor', fn() => (new InputFieldUploadImage('f', null, $validB64))->get(), $validB64);

        $invalidB64 = 'data:application/pdf;base64,' . base64_encode('fake');
        $this->isThrow('InputFieldUploadImage: mime inválido lança', fn() => (new InputFieldUploadImage('f', null, $invalidB64))->get());

        $this->isThrow('InputFieldUploadImage: ausente lança', fn() => (new InputFieldUploadImage('f', null, null))->get());

        // === InputFieldCaptcha ===

        Env::set('CAPTCHA_TIME', 60);
        $code = 'ABC123';
        $key = Mx5::on(strtoupper($code));
        $cif = Cif::on([$key, time()]);
        $captchaInput = "$cif|$code";

        $this->isTrue('InputFieldCaptcha: captcha válido retorna true', fn() => (new InputFieldCaptcha('f', null, $captchaInput))->get());
        $this->isThrow('InputFieldCaptcha: código errado lança', fn() => (new InputFieldCaptcha('f', null, $cif . '|ERRADO'))->get());
        $this->isThrow('InputFieldCaptcha: ausente lança', fn() => (new InputFieldCaptcha('f', null, null))->get());
    }
};

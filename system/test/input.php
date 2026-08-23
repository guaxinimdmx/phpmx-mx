<?php

use PhpMx\Input;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe Input */
return new class {

    use TerminalTestTrait;

    function run()
    {
        $input = new Input(['name' => 'joao', 'age' => '30', 'email' => 'JOAO@EXAMPLE.COM']);

        // get básico
        $this->isEqual('get: string', fn() => $input->get('name'), 'joao');
        $this->isEqual('get: str_get_var converte inteiro', fn() => $input->get('age'), 30);

        // campo ausente e obrigatório lança exception
        $this->isThrow('required: ausente lança exception', fn() => $input->get('nao_existe'), STS_BAD_REQUEST);

        // campo ausente e opcional retorna null
        $this->isNull('required: false retorna null', function () use ($input) {
            return $input->field('opcional')->required(false)->get();
        });

        // validate: email válido passa
        $this->isNotThrow('validate: email válido', function () use ($input) {
            $input->field('email')->validate(FILTER_VALIDATE_EMAIL)->get();
        });

        // validate: email inválido lança exception
        $input2 = new Input(['email' => 'nao-e-email']);
        $this->isThrow('validate: email inválido lança exception', function () use ($input2) {
            $input2->field('email')->validate(FILTER_VALIDATE_EMAIL)->get();
        }, STS_BAD_REQUEST);

        // sanitize: strtolower via closure
        $this->isEqual('sanitize: closure', function () use ($input) {
            return $input->field('email')->sanitize(fn($v) => strtolower($v))->get();
        }, 'joao@example.com');

        // data: retorna array com campos declarados
        $input3 = new Input(['a' => '1', 'b' => '2']);
        $input3->field('a');
        $input3->field('b');
        $this->isEqual('data: retorna array', fn() => $input3->data(), ['a' => 1, 'b' => 2]);

        // dataReceived: ignora campos não enviados
        $input4 = new Input(['a' => '1']);
        $input4->field('a');
        $input4->field('b')->required(false);
        $this->isEqual('dataReceived: só campos enviados', fn() => $input4->dataReceived(), ['a' => 1]);

        // send: lança exception com STS_BAD_REQUEST
        $this->isThrow('send: lança exception', fn() => $input->send('erro'), STS_BAD_REQUEST);
        $this->isThrow('send: lança com status customizado', fn() => $input->send('erro', STS_NOT_FOUND), STS_NOT_FOUND);
    }
};

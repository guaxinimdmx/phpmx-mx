<?php

use PhpMx\Trait\TerminalTestTrait;

/** Testa as funções helper str_* e strTo* */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // str_get_var
        $this->isNull('str_get_var: null', fn() => str_get_var('null'));
        $this->isTrue('str_get_var: true', fn() => str_get_var('true') === true);
        $this->isTrue('str_get_var: false', fn() => str_get_var('false') === false);
        $this->isEqual('str_get_var: inteiro', fn() => str_get_var('42'), 42);
        $this->isEqual('str_get_var: float', fn() => str_get_var('3.14'), 3.14);
        $this->isEqual('str_get_var: string', fn() => str_get_var('hello'), 'hello');

        // str_replace_first
        $this->isEqual('str_replace_first: substitui só a primeira', fn() => str_replace_first('a', 'X', 'abab'), 'Xbab');

        // str_replace_last
        $this->isEqual('str_replace_last: substitui só a última', fn() => str_replace_last('a', 'X', 'abab'), 'abXb');

        // str_replace_all
        $this->isEqual('str_replace_all: substitui repetidamente', fn() => str_replace_all('aa', 'a', 'aaaa'), 'a');

        // strToCamelCase
        $this->isEqual('strToCamelCase', fn() => strToCamelCase('hello world'), 'helloWorld');
        $this->isEqual('strToCamelCase: acentos', fn() => strToCamelCase('ação direta'), 'acaoDireta');

        // strToKebabCase
        $this->isEqual('strToKebabCase', fn() => strToKebabCase('Hello World'), 'hello-world');

        // strToPascalCase
        $this->isEqual('strToPascalCase', fn() => strToPascalCase('hello world'), 'HelloWorld');

        // strToSnakeCase
        $this->isEqual('strToSnakeCase', fn() => strToSnakeCase('Hello World'), 'hello_world');
    }
};

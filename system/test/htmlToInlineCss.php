<?php

use PhpMx\Trait\TerminalTestTrait;

/** Testa o helper htmlToInlineCss() */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // sem <style>: retorna HTML original
        $this->isEqual('sem style: mantém HTML', fn() => htmlToInlineCss('<p>texto</p>'), '<p>texto</p>');

        // aplica estilo de <style> como inline
        $html = '<style>p { color: red; }</style><p>texto</p>';
        $result = htmlToInlineCss($html);
        $this->isTrue('aplica color inline', fn() => str_contains($result, 'color: red'));
        $this->isFalse('remove bloco <style>', fn() => str_contains($result, '<style>'));

        // estilo inline existente tem prioridade sobre <style>
        $html2 = '<style>p { color: red; }</style><p style="color: blue">texto</p>';
        $result2 = htmlToInlineCss($html2);
        $this->isTrue('inline existente vence: blue', fn() => str_contains($result2, 'color: blue'));

        // múltiplos seletores: classe
        $html3 = '<style>.destaque { font-weight: bold; }</style><span class="destaque">ok</span>';
        $result3 = htmlToInlineCss($html3);
        $this->isTrue('seletor de classe aplicado', fn() => str_contains($result3, 'font-weight: bold'));

        // pseudo-classes são ignoradas
        $html4 = '<style>a:hover { color: red; }</style><a>link</a>';
        $result4 = htmlToInlineCss($html4);
        $this->isFalse('pseudo-classe ignorada', fn() => str_contains($result4, 'color: red'));

        // seletor por id
        $html5 = '<style>#titulo { font-size: 20px; }</style><h1 id="titulo">T</h1>';
        $result5 = htmlToInlineCss($html5);
        $this->isTrue('seletor #id aplicado', fn() => str_contains($result5, 'font-size: 20px'));

        // múltiplas propriedades no mesmo seletor
        $html6 = '<style>p { color: green; margin: 0; }</style><p>x</p>';
        $result6 = htmlToInlineCss($html6);
        $this->isTrue('múltiplas props: color', fn() => str_contains($result6, 'color: green'));
        $this->isTrue('múltiplas props: margin', fn() => str_contains($result6, 'margin: 0'));
    }
};

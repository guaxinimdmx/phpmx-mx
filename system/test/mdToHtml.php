<?php

use PhpMx\Trait\TerminalTestTrait;

/** Testa o helper mdToHtml */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // headings
        $this->isTrue('h1', fn() => str_contains(mdToHtml('# Título'), '<h1>Título</h1>'));
        $this->isTrue('h2', fn() => str_contains(mdToHtml('## Sub'), '<h2>Sub</h2>'));
        $this->isTrue('h6', fn() => str_contains(mdToHtml('###### Mini'), '<h6>Mini</h6>'));

        // parágrafo
        $this->isTrue('parágrafo', fn() => str_contains(mdToHtml('Texto simples'), '<p>Texto simples</p>'));

        // negrito e itálico
        $this->isTrue('bold **', fn() => str_contains(mdToHtml('**negrito**'), '<strong>negrito</strong>'));
        $this->isTrue('italic *', fn() => str_contains(mdToHtml('*italico*'), '<em>italico</em>'));
        $this->isTrue('bold+italic ***', fn() => str_contains(mdToHtml('***ambos***'), '<strong><em>ambos</em></strong>'));

        // lista não-ordenada
        $this->isTrue('ul: contém <ul>', fn() => str_contains(mdToHtml("- a\n- b"), '<ul>'));
        $this->isTrue('ul: contém <li>', fn() => str_contains(mdToHtml("- item"), '<li>item</li>'));

        // lista ordenada
        $this->isTrue('ol: contém <ol>', fn() => str_contains(mdToHtml("1. x\n2. y"), '<ol>'));
        $this->isTrue('ol: contém <li>', fn() => str_contains(mdToHtml("1. primeiro"), '<li>primeiro</li>'));

        // blockquote
        $this->isTrue('blockquote', fn() => str_contains(mdToHtml('> citação'), '<blockquote>'));

        // link
        $this->isTrue('link href', fn() => str_contains(mdToHtml('[texto](https://example.com)'), 'href="https://example.com"'));
        $this->isTrue('link label', fn() => str_contains(mdToHtml('[texto](https://example.com)'), '>texto</a>'));

        // código inline
        $this->isTrue('inline code', fn() => str_contains(mdToHtml('`código`'), '<code>código</code>'));

        // bloco de código
        $this->isTrue('code block', fn() => str_contains(mdToHtml("```\necho 'hi';\n```"), '<pre><code>'));

        // hr
        $this->isTrue('hr ---', fn() => str_contains(mdToHtml('---'), '<hr>'));
        $this->isTrue('hr ***', fn() => str_contains(mdToHtml('***'), '<hr>'));

        // strikethrough
        $this->isTrue('del ~~', fn() => str_contains(mdToHtml('~~riscado~~'), '<del>riscado</del>'));
    }
};

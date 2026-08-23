<?php

use PhpMx\Datalayer\Scheme\SchemeField;
use PhpMx\Trait\TerminalTestTrait;

/** Testa SchemeField sem banco de dados */
return new class {

    use TerminalTestTrait;

    function run()
    {
        // === getName ===
        $f = new SchemeField('=meuCampo');
        $this->isEqual('getName: = prefix preserva nome', fn() => $f->getName(), 'meuCampo');

        // internalName transforma camelCase → snake_case
        $f2 = new SchemeField('meuCampo');
        $this->isEqual('getName: sem = aplica internalName', fn() => $f2->getName(), 'meu_campo');

        // === drop ===
        $fd = new SchemeField('=f', ['type' => 'int']);
        $fd->drop();
        $this->isFalse('drop: getMap retorna false', fn() => $fd->getMap());

        $fd2 = new SchemeField('=f', ['type' => 'int']);
        $fd2->drop()->drop(false);
        $this->isNotEqual('drop(false): getMap não é false', fn() => $fd2->getMap(), false);

        // === null / comment ===
        $fc = new SchemeField('=f', ['type' => 'int']);
        $fc->null(true)->comment('meu comentário');
        $map = $fc->getMap();
        $this->isTrue('null(true): map[null] é true', fn() => $map['null']);
        $this->isEqual('comment: map[comment] correto', fn() => $map['comment'], 'meu comentário');

        // === index / unique ===
        $fi = new SchemeField('=f', ['type' => 'int']);
        $fi->index(true);
        $map = $fi->getMap();
        $this->isTrue('index(true): map[index] é true', fn() => $map['index']);
        $this->isFalse('index(true): unique ainda false', fn() => $map['unique']);

        $fu = new SchemeField('=f', ['type' => 'int']);
        $fu->index(true, true);
        $map = $fu->getMap();
        $this->isTrue('index(true,true): map[unique] é true', fn() => $map['unique']);

        $fu2 = new SchemeField('=f', ['type' => 'int']);
        $fu2->unique(true);
        $map = $fu2->getMap();
        $this->isTrue('unique(true): map[unique] é true', fn() => $map['unique']);
        $this->isTrue('unique(true): map[index] ativado', fn() => $map['index']);

        // index proibido em text/blob
        $this->isThrow('index em text lança', fn() => (new SchemeField('=f', ['type' => 'text']))->index(true));
        $this->isThrow('unique em blob lança', fn() => (new SchemeField('=f', ['type' => 'blob']))->unique(true));

        // === size (char/varchar apenas) ===
        $fs = new SchemeField('=f', ['type' => 'varchar']);
        $fs->size(50);
        $this->isEqual('size: varchar size=50', fn() => $fs->getMap()['size'], 50);

        $this->isThrow('size em int lança', fn() => (new SchemeField('=f', ['type' => 'int']))->size(10));
        $this->isThrow('size em text lança', fn() => (new SchemeField('=f', ['type' => 'text']))->size(10));

        // === crop (char/varchar apenas) ===
        $fcr = new SchemeField('=f', ['type' => 'varchar']);
        $fcr->crop(true);
        $this->isTrue('crop: settings[crop] true', fn() => $fcr->getMap()['settings']['crop']);

        $this->isThrow('crop em int lança', fn() => (new SchemeField('=f', ['type' => 'int']))->crop(true));

        // === min / max (numérico apenas) ===
        $fmm = new SchemeField('=f', ['type' => 'int']);
        $fmm->min(0)->max(100);
        $map = $fmm->getMap();
        $this->isEqual('min: settings[min]=0', fn() => $map['settings']['min'], 0);
        $this->isEqual('max: settings[max]=100', fn() => $map['settings']['max'], 100);

        $this->isThrow('min em varchar lança', fn() => (new SchemeField('=f', ['type' => 'varchar']))->min(0));
        $this->isThrow('max em text lança', fn() => (new SchemeField('=f', ['type' => 'text']))->max(100));

        // === round (int apenas) ===
        $fr = new SchemeField('=f', ['type' => 'int']);
        $fr->round(-1);
        $this->isEqual('round: settings[round]=-1', fn() => $fr->getMap()['settings']['round'], -1);

        $this->isThrow('round em decimal lança', fn() => (new SchemeField('=f', ['type' => 'decimal']))->round(1));
        $this->isThrow('round em varchar lança', fn() => (new SchemeField('=f', ['type' => 'varchar']))->round(1));

        // === precision (decimal apenas) ===
        $fp = new SchemeField('=f', ['type' => 'decimal']);
        $fp->precision(4);
        $this->isEqual('precision: settings[precision]=4', fn() => $fp->getMap()['settings']['precision'], 4);

        $this->isThrow('precision em int lança', fn() => (new SchemeField('=f', ['type' => 'int']))->precision(2));

        // === default (proibido em text/blob/json/password) ===
        $this->isThrow('default em text lança', fn() => (new SchemeField('=f', ['type' => 'text']))->default('x'));
        $this->isThrow('default em blob lança', fn() => (new SchemeField('=f', ['type' => 'blob']))->default('x'));
        $this->isThrow('default em json lança', fn() => (new SchemeField('=f', ['type' => 'json']))->default('x'));
        $this->isThrow('default em password lança', fn() => (new SchemeField('=f', ['type' => 'password']))->default('x'));

        // default null ativa null(true)
        $fdn = new SchemeField('=f', ['type' => 'int']);
        $fdn->default(null);
        $this->isTrue('default(null): null ativado', fn() => $fdn->getMap()['null']);

        // === getMap: boolean ===
        $fb = new SchemeField('=f', ['type' => 'boolean']);
        $this->isEqual('boolean: size=1', fn() => $fb->getMap()['size'], 1);

        $fb2 = new SchemeField('=f', ['type' => 'boolean', 'default' => true]);
        $this->isEqual('boolean: default true → 1', fn() => $fb2->getMap()['default'], 1);

        $fb3 = new SchemeField('=f', ['type' => 'boolean', 'default' => false, 'null' => false]);
        $this->isEqual('boolean: default false → 0', fn() => $fb3->getMap()['default'], 0);

        // === getMap: int default ===
        $fid = new SchemeField('=f', ['type' => 'int', 'default' => '5']);
        $this->isEqual('int: default string → int', fn() => $fid->getMap()['default'], 5);

        // === getMap: varchar size padrão ===
        $fv = new SchemeField('=f', ['type' => 'varchar']);
        $this->isEqual('varchar: size padrão=255', fn() => $fv->getMap()['size'], 255);

        // === getMap: decimal ===
        $fdec = new SchemeField('=f', ['type' => 'decimal']);
        $map = $fdec->getMap();
        $this->isEqual('decimal: precision padrão=2', fn() => $map['settings']['precision'], 2);
        $this->isEqual('decimal: size >= precision+1', fn() => $map['size'] >= 3, true);

        // === getMap: datetime bool ===
        $fdt = new SchemeField('=f', ['type' => 'datetime', 'default' => true]);
        $this->isEqual('datetime: default true → CURRENT_TIMESTAMP', fn() => $fdt->getMap()['default'], 'CURRENT_TIMESTAMP');

        $fdt2 = new SchemeField('=f', ['type' => 'datetime', 'default' => false]);
        $this->isNull('datetime: default false → null', fn() => $fdt2->getMap()['default']);

        // === getMap: date bool=true lança ===
        $this->isThrow('date: default true lança', fn() => (new SchemeField('=f', ['type' => 'date', 'default' => true]))->getMap());

        // === getMap: email ===
        $fem = new SchemeField('=f', ['type' => 'email', 'default' => 'USER@EXAMPLE.COM']);
        $this->isEqual('email: default normalizado lowercase', fn() => $fem->getMap()['default'], 'user@example.com');
        $this->isEqual('email: size=254', fn() => $fem->getMap()['size'], 254);

        $this->isThrow('email: default inválido lança', fn() => (new SchemeField('=f', ['type' => 'email', 'default' => 'nao-email']))->getMap());

        // === getMap: md5 ===
        $fmd5 = new SchemeField('=f', ['type' => 'md5', 'default' => 'hello']);
        $this->isEqual('md5: default hasheia string', fn() => $fmd5->getMap()['default'], md5('hello'));

        $existingHash = md5('world');
        $fmd5b = new SchemeField('=f', ['type' => 'md5', 'default' => $existingHash]);
        $this->isEqual('md5: default md5 existente mantém', fn() => $fmd5b->getMap()['default'], $existingHash);
        $this->isEqual('md5: size=32', fn() => $fmd5b->getMap()['size'], 32);

        // === getMap: password ===
        $fpw = new SchemeField('=f', ['type' => 'password', 'default' => 'qualquer']);
        $this->isNull('password: default forçado null', fn() => $fpw->getMap()['default']);
        $this->isEqual('password: size=255', fn() => $fpw->getMap()['size'], 255);

        // === getMap: tipo inválido lança ===
        $this->isThrow('tipo inválido lança', fn() => (new SchemeField('=f', ['type' => 'invalido']))->getMap());
    }
};

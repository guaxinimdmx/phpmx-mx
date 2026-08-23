<?php

use PhpMx\DImage;
use PhpMx\Trait\TerminalTestTrait;

/** Testa a classe DImage (requer extensões gd e exif) */
return new class {

    use TerminalTestTrait;

    function run()
    {
        if (!phpex('gd', false) || !phpex('exif', false)) {
            $this->isTrue('DImage: extensões gd/exif não disponíveis — testes ignorados', fn() => true);
            return;
        }

        // _color: cria imagem monocromática
        $img = DImage::_color('ff0000', 100);
        $this->isTrue('_color: retorna DImage', fn() => $img instanceof DImage);
        $this->isEqual('_color: largura', fn() => $img->getWidth(), 100);
        $this->isEqual('_color: altura', fn() => $img->getHeight(), 100);
        $this->isEqual('_color: getSize', fn() => $img->getSize(), [100, 100]);

        // extensão padrão é jpg
        $this->isEqual('getExtension: padrão jpg', fn() => $img->getExtension(), 'jpg');

        // getName
        $this->isTrue('getName: retorna string', fn() => is_string($img->getName()));

        // getBin / getHash
        $this->isTrue('getBin: retorna string', fn() => is_string($img->getBin()) && strlen($img->getBin()) > 0);
        $this->isTrue('getHash: retorna md5', fn() => strlen($img->getHash()) === 32);

        // getB64
        $this->isTrue('getB64: começa com data:', fn() => str_starts_with($img->getB64(), 'data:'));

        // quality
        $img2 = DImage::_color('fff', 50);
        $img2->quality(90);
        $this->isTrue('quality: retorna static', fn() => $img2 instanceof DImage);

        // rename
        $img3 = DImage::_color('000', 10);
        $img3->rename('minha-foto.jpg');
        $this->isEqual('rename: remove extensão', fn() => $img3->getName(), 'minha-foto');

        // rename sem extensão
        $img4 = DImage::_color('000', 10);
        $img4->rename('sem-extensao');
        $this->isEqual('rename: sem extensão mantém', fn() => $img4->getName(), 'sem-extensao');

        // convert para png
        $img5 = DImage::_color('00ff00', [200, 100]);
        $img5->convert('png');
        $this->isEqual('convert: png', fn() => $img5->getExtension(), 'png');
        $this->isEqual('convert: largura mantida', fn() => $img5->getWidth(), 200);
        $this->isEqual('convert: altura mantida', fn() => $img5->getHeight(), 100);

        // convert para webp
        $img6 = DImage::_color('0000ff', 80);
        $img6->convert('webp');
        $this->isEqual('convert: webp', fn() => $img6->getExtension(), 'webp');

        // resize
        $img7 = DImage::_color('fff', 200);
        $img7->resize(100);
        $this->isEqual('resize: largura', fn() => $img7->getWidth(), 100);
        $this->isEqual('resize: altura', fn() => $img7->getHeight(), 100);

        // resize retangular
        $img8 = DImage::_color('fff', [400, 200]);
        $img8->resize([200, 0]);
        $this->isEqual('resize: retangular largura', fn() => $img8->getWidth(), 200);

        // copy: clone independente
        $imgA = DImage::_color('fff', 50);
        $imgB = $imgA->copy();
        $this->isTrue('copy: retorna DImage', fn() => $imgB instanceof DImage);
        $this->isEqual('copy: mesmo hash', fn() => $imgA->getHash(), $imgB->getHash());

        // flipH / flipV não lançam exception
        $imgF = DImage::_color('fff', 50);
        $this->isNotThrow('flipH: não lança exception', fn() => $imgF->flipH());
        $this->isNotThrow('flipV: não lança exception', fn() => $imgF->flipV());

        // filter: grayscale
        $imgG = DImage::_color('ff0000', 50);
        $this->isNotThrow('filter: grayscale', fn() => $imgG->filter(IMG_FILTER_GRAYSCALE));

        // _color: tamanho array [w, h]
        $imgRect = DImage::_color('fff', [300, 150]);
        $this->isEqual('_color: array [w,h] largura', fn() => $imgRect->getWidth(), 300);
        $this->isEqual('_color: array [w,h] altura', fn() => $imgRect->getHeight(), 150);
    }
};

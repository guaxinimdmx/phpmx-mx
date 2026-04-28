<?php

namespace PhpMx;

use Exception;

/**
 * Classe utilitária para envio e download de arquivos via resposta HTTP.
 * Os métodos aceitam múltiplos argumentos que são combinados para compor o caminho do arquivo.
 */
abstract class Assets
{
    /**
     * Envia um arquivo do projeto como resposta da requisição.
     * @param string ...$path Partes do caminho do arquivo.
     */
    static function send(string ...$path): void
    {
        self::load(...$path);
        Response::send();
    }

    /**
     * Realiza o download de um arquivo do projeto como resposta da requisição.
     * @param string ...$path Partes do caminho do arquivo.
     */
    static function download(string ...$path): void
    {
        self::load(...$path);
        Response::download(true);
        Response::send();
    }

    /**
     * Carrega um arquivo do projeto na resposta da requisição.
     * @param string ...$path Partes do caminho do arquivo.
     */
    static function load(string ...$path): void
    {
        $file = path(...$path);
        self::loadResponse($file);
        Response::download(false);
    }

    protected static function loadResponse(string $file): void
    {
        if (!File::check($file))
            throw new Exception("File not found", STS_NOT_FOUND);

        Response::content(Import::content($file));
        Response::type(File::getEx($file));
        Response::download(File::getOnly($file));
        Response::status(STS_OK);
    }
}

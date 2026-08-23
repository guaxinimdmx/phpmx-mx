<?php

namespace PhpMx\Reflection;

use PhpMx\Import;
use PhpMx\Path;

/** Extrai o esquema de reflexão de um arquivo de teste. */
abstract class ReflectionTestFile extends BaseReflectionFile
{
    /**
     * Retorna o esquema de um arquivo de teste, extraindo nome e documentação.
     * @param string $file Caminho do arquivo de teste.
     * @return array Esquema do teste ou array vazio se o arquivo não contiver um teste válido.
     */
    static function scheme(string $file): array
    {
        $content = Import::content($file);

        preg_match('/(?:return|.*?=)\s*new\s+class/i', $content, $match, PREG_OFFSET_CAPTURE);

        if (!$match) return [];

        $pos = $match[0][1];

        $docScheme = self::parseDocBlock(self::docBlockBefore($content, $pos));

        $name = explode('system/test/', str_replace('\\', '/', $file));
        $name = substr(array_pop($name), 0, -4);
        $name = str_replace('/', '.', $name);

        return array_filter([
            '_key'    => md5("test:$name"),
            '_file'   => path($file),
            '_line'   => substr_count(substr($content, 0, $pos), "\n") + 1,
            '_origin' => Path::origin($file),

            'name'    => $name,
            ...$docScheme,
        ]);
    }
}

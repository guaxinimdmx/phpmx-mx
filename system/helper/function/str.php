<?php

if (!function_exists('str_get_var')) {

    /**
     * Extrai e converte um valor de dentro de uma string para seu tipo real (bool, int, float ou null).
     * @param mixed $var O valor a ser analisado e convertido.
     * @return mixed
     */
    function str_get_var(mixed $var): mixed
    {
        if (!is_string($var))
            return $var;

        if ($var === 'null' || $var === 'NULL' || $var === '')
            return null;

        if ($var == 'true' || $var === 'TRUE')
            return true;

        if ($var === 'false' || $var === 'FALSE')
            return false;

        if (strval(intval($var)) === $var)
            return intval($var);

        if (strval(floatval($var)) === $var)
            return floatval($var);

        return $var;
    }
}

if (!function_exists('str_replace_all')) {

    /**
     * Substitui repetidamente as ocorrências de uma string até que não haja mais mudanças ou atinja o limite.
     * @param array|string $search Valor(es) a buscar na string.
     * @param array|string $replace Valor(es) de substituição.
     * @param string $subject A string alvo da substituição.
     * @param int $loop Limite de iterações para evitar loops infinitos.
     * @return string
     */
    function str_replace_all(array|string $search, array|string $replace, string $subject, int $loop = 10): string
    {
        $count = 0;
        $subject = str_replace($search, $replace, $subject, $count);
        while ($loop && $count) {
            $subject = str_replace($search, $replace, $subject, $count);
            $loop--;
        }
        return $subject;
    }
}

if (!function_exists('str_replace_first')) {

    /**
     * Substitui apenas a primeira ocorrência encontrada da string de pesquisa.
     * @param array|string $search Valor(es) a buscar na string.
     * @param array|string $replace Valor(es) de substituição.
     * @param string $subject A string alvo da substituição.
     * @return string
     */
    function str_replace_first(array|string $search, array|string $replace, string $subject): string
    {
        $pos = strpos($subject, $search);
        if ($pos !== false) {
            return substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }
}

if (!function_exists('str_replace_last')) {

    /**
     * Substitui apenas a última ocorrência encontrada da string de pesquisa.
     * @param array|string $search Valor(es) a buscar na string.
     * @param array|string $replace Valor(es) de substituição.
     * @param string $subject A string alvo da substituição.
     * @return string
     */
    function str_replace_last(array|string $search, array|string $replace, string $subject): string
    {
        $pos = strrpos($subject, $search);
        if ($pos !== false) {
            return substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }
}

if (!function_exists('str_trim')) {

    /**
     * Remove espaços ou caracteres específicos do entorno de uma substring dentro de uma string maior.
     * @param string $string O texto completo.
     * @param array|string $substring A parte que deve ser limpa.
     * @param array|string $characters Caracteres a serem removidos.
     * @return string
     */
    function str_trim(string $string, array|string $substring, array|string $characters = " \t\n\r\0\x0B"): string
    {
        $charactersArray = [];
        $substringArray = [];

        $characters = is_array($characters) ? $characters : [$characters];
        $substring = is_array($substring) ? $substring : [$substring];

        foreach ($substring as $vs)
            foreach ($characters as $vt) {
                $charactersArray[] = "$vs$vt";
                $charactersArray[] = "$vt$vs";
                $substringArray[] = $vs;
                $substringArray[] = $vs;
            }

        $string = mb_str_replace_all($charactersArray, $substringArray, $string);

        return $string;
    }
}

if (!function_exists('mb_str_replace')) {

    /**
     * Versão multibyte segura da função str_replace.
     * @param array|string $search Valor(es) a buscar na string.
     * @param array|string $replace Valor(es) de substituição.
     * @param string $subject A string alvo da substituição.
     * @param int $count Referência para contagem de substituições.
     * @return string
     */
    function mb_str_replace(array|string $search, array|string $replace, string $subject, &$count = 0): string
    {
        if (!is_array($subject)) {
            $searches = is_array($search) ? array_values($search) : array($search);
            $replacements = is_array($replace) ? array_values($replace) : array($replace);
            $replacements = array_pad($replacements, count($searches), '');
            foreach ($searches as $key => $itemSearch) {
                $parts = mb_split(preg_quote($itemSearch), $subject);
                $count += count($parts) - 1;
                $subject = implode($replacements[$key], $parts);
            }
        } else {
            foreach ($subject as $key => $value)
                $subject[$key] = mb_str_replace($search, $replace, $value, $count);
        }
        return $subject;
    }
}

if (!function_exists('mb_str_replace_all')) {

    /**
     * Versão multibyte segura da função str_replace_all.
     * @param array|string $search Valor(es) a buscar na string.
     * @param array|string $replace Valor(es) de substituição.
     * @param string $subject A string alvo da substituição.
     * @param int $loop Limite de iterações para evitar loops infinitos.
     * @return string
     */
    function mb_str_replace_all(array|string $search, array|string $replace, string $subject, int $loop = 10): string
    {
        $pre = $subject;
        $subject = mb_str_replace($search, $replace, $subject);
        while ($loop && $pre != $subject) {
            $pre = $subject;
            $subject = mb_str_replace($search, $replace, $subject);
            $loop--;
        }
        return $subject;
    }
}

if (!function_exists('strToCamelCase')) {

    /**
     * Converte uma string para o formato camelCase.
     * @param string $string A string a ser convertida.
     * @return string
     */
    function strToCamelCase(string $string): string
    {
        $string = remove_accents($string);
        $string = preg_replace('/[^a-zA-Z0-9]+/', ' ', $string);
        $string = preg_split('/(?<=[a-z0-9])(?=[A-Z])|\s+/', $string);
        $string = array_filter(array_map(fn($v) => ucfirst(strtolower(trim($v))), $string), fn($v) => !is_blank($v));
        $string = implode('', $string);
        $string = lcfirst($string);
        return $string;
    }
}

if (!function_exists('strToKebabCase')) {

    /**
     * Converte uma string para o formato kebab-case.
     * @param string $string A string a ser convertida.
     * @return string
     */
    function strToKebabCase(string $string): string
    {
        $string = remove_accents($string);
        $string = preg_replace('/[^a-zA-Z0-9]+/', ' ', $string);
        $string = preg_split('/(?<=[a-z0-9])(?=[A-Z])|\s+/', $string);
        $string = array_filter(array_map(fn($v) => strtolower(trim($v)), $string), fn($v) => !is_blank($v));
        $string = implode('-', $string);
        return $string;
    }
}

if (!function_exists('strToPascalCase')) {

    /**
     * Converte uma string para o formato PascalCase.
     * @param string $string A string a ser convertida.
     * @return string
     */
    function strToPascalCase(string $string): string
    {
        $string = remove_accents($string);
        $string = preg_replace('/[^a-zA-Z0-9]+/', ' ', $string);
        $string = preg_split('/(?<=[a-z0-9])(?=[A-Z])|\s+/', $string);
        $string = array_filter(array_map(fn($v) => ucfirst(strtolower(trim($v))), $string), fn($v) => !is_blank($v));
        $string = implode('', $string);
        return $string;
    }
}

if (!function_exists('strToSnakeCase')) {

    /**
     * Converte uma string para o formato snake_case.
     * @param string $string A string a ser convertida.
     * @return string
     */
    function strToSnakeCase(string $string): string
    {
        $string = remove_accents($string);
        $string = preg_replace('/[^a-zA-Z0-9]+/', ' ', $string);
        $string = preg_split('/(?<=[a-z0-9])(?=[A-Z])|\s+/', $string);
        $string = array_filter(array_map(fn($v) => strtolower(trim($v)), $string), fn($v) => !is_blank($v));
        $string = implode('_', $string);
        return $string;
    }
}

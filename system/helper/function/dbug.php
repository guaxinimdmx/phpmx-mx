<?php

if (!function_exists('d')) {

    /**
     * Realiza o var_dump de múltiplas variáveis com configurações otimizadas de profundidade e exibição.
     * @param mixed ...$params Variáveis para depuração.
     * @return void
     */
    function d(mixed ...$params): void
    {
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');

        foreach ($params as $param)
            var_dump($param);
    }
}

if (!function_exists('dd')) {

    /**
     * Exibe os dados das variáveis (dump) e encerra a execução do sistema (die).
     * @param mixed ...$params Variáveis para depuração.
     * @return void
     */
    function dd(mixed ...$params): void
    {
        d(...$params);
        die;
    }
}

if (!function_exists('dpre')) {

    /**
     * Realiza o var_dump de variáveis dentro de uma tag HTML pre.
     * @param mixed ...$params Variáveis para depuração.
     * @return void
     */
    function dpre(mixed ...$params): void
    {
        echo '<pre>';
        d(...$params);
        echo '</pre>';
    }
}

if (!function_exists('ddpre')) {

    /**
     * Realiza o var_dump de variáveis dentro de uma tag HTML pre encerrando a execução do sistema.
     * @param mixed ...$params Variáveis para depuração.
     * @return void
     */
    function ddpre(mixed ...$params): void
    {
        dpre(...$params);
        die;
    }
}

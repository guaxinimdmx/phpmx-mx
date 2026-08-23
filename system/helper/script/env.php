<?php

use PhpMx\Env;

Env::loadFile('./.env');

Env::loadFile('./.conf');

/** Define se o sistema está em modo de desenvolvimento (exibe erros detalhados) */
Env::default('DEV', false);

/** Define o certificado padrão utilizado pelo motor de criptografia Cif */
Env::default('CIF', 'base');

/** Chave de segurança utilizada para a geração de hashes MX5 */
Env::default('MX5_KEY', 'mx5key');

/** Habilita ou desabilita o armazenamento de cache em arquivos físicos */
Env::default('USE_CACHE_FILE', true);

/** Obriga o redirecionamento de todas as requisições para HTTPS */
Env::default('FORCE_SSL', true);

/** Chave secreta utilizada para assinatura e validação de tokens JWT */
Env::default('JWT_KEY', 'jwtkey');

/** Tempo de expiração global para o sistema de cache */
Env::default('CACHE', null);

/** Tempo de cache no navegador para arquivos Javascript (.js) */
Env::default('CACHE_JS', '+30 days');

/** Tempo de cache no navegador para arquivos de folha de estilo (.css) */
Env::default('CACHE_CSS', '+30 days');

/** Tempo de cache no navegador para ícones de favoritos (.ico) */
Env::default('CACHE_ICO', '+30 days');

/** Tempo de cache no navegador para imagens PNG */
Env::default('CACHE_PNG', '+30 days');

/** Tempo de cache no navegador para imagens JPG/JPEG */
Env::default('CACHE_JPG', '+30 days');

/** Tempo de cache no navegador para imagens BMP */
Env::default('CACHE_BMP', '+30 days');

/** Tempo de cache no navegador para imagens GIF */
Env::default('CACHE_GIF', '+30 days');

/** Tempo de cache no navegador para imagens de formato WEBP */
Env::default('CACHE_WEBP', '+30 days');

/** Tempo de cache no navegador para arquivos de áudio MP3 */
Env::default('CACHE_MP3', '+30 days');

/** Tempo de cache no navegador para arquivos de vídeo MP4 */
Env::default('CACHE_MP4', '+30 days');

/** Tempo em segundos que um captcha é válido */
Env::default('CAPTCHA_TIME', '60');

/** Mensagem padrão para status HTTP 200 (Success) */
Env::default('STM_200', 'ok');

/** Mensagem padrão para status HTTP 201 (Created) */
Env::default('STM_201', 'created');

/** Mensagem padrão para status HTTP 202 (Accepted) */
Env::default('STM_202', 'accepted');

/** Mensagem padrão para status HTTP 204 (No Content) */
Env::default('STM_204', 'no content');

/** Mensagem padrão para status HTTP 301 (Moved Permanently) */
Env::default('STM_301', 'moved permanently');

/** Mensagem padrão para status HTTP 302 (Found) */
Env::default('STM_302', 'found');

/** Mensagem padrão para status HTTP 303 (See Other/Redirect) */
Env::default('STM_303', 'redirect');

/** Mensagem padrão para status HTTP 304 (Not Modified) */
Env::default('STM_304', 'not modified');

/** Mensagem padrão para status HTTP 400 (Bad Request) */
Env::default('STM_400', 'bad request');

/** Mensagem padrão para status HTTP 401 (Unauthorized) */
Env::default('STM_401', 'unauthorized');

/** Mensagem padrão para status HTTP 403 (Forbidden) */
Env::default('STM_403', 'forbidden');

/** Mensagem padrão para status HTTP 404 (Not Found) */
Env::default('STM_404', 'not found');

/** Mensagem padrão para status HTTP 405 (Method Not Allowed) */
Env::default('STM_405', 'method not allowed');

/** Mensagem padrão para status HTTP 409 (Conflict) */
Env::default('STM_409', 'conflict');

/** Mensagem padrão para status HTTP 422 (Unprocessable Entity) */
Env::default('STM_422', 'unprocessable entity');

/** Mensagem padrão para status HTTP 429 (Too Many Requests) */
Env::default('STM_429', 'too many requests');

/** Mensagem padrão para status HTTP 500 (Internal Server Error) */
Env::default('STM_500', 'internal server error');

/** Mensagem padrão para status HTTP 501 (Not Implemented) */
Env::default('STM_501', 'not implemented');

/** Mensagem padrão para status HTTP 502 (Bad Gateway) */
Env::default('STM_502', 'bad gateway');

/** Mensagem padrão para status HTTP 503 (Service Unavailable) */
Env::default('STM_503', 'service unavailable');

/** Mensagem padrão para status HTTP 504 (Gateway Timeout) */
Env::default('STM_504', 'gateway timeout');

/** Inclui constantes públicas na documentação gerada pelo autodoc */
Env::default('AUTODOC_CONSTANTS', true);

/** Inclui funções públicas na documentação gerada pelo autodoc */
Env::default('AUTODOC_FUNCTIONS', true);

/** Inclui variáveis de ambiente públicas na documentação gerada pelo autodoc */
Env::default('AUTODOC_ENVIRONMENT', true);

/** Inclui middlewares na documentação gerada pelo autodoc */
Env::default('AUTODOC_MIDDLEWARE', true);

/** Inclui comandos de terminal na documentação gerada pelo autodoc */
Env::default('AUTODOC_TERMINAL', true);

/** Inclui rotas na documentação gerada pelo autodoc */
Env::default('AUTODOC_ROUTES', true);

/** Inclui classes públicas na documentação gerada pelo autodoc */
Env::default('AUTODOC_CLASSES', true);

/** Inclui exemplos na documentação gerada pelo autodoc */
Env::default('AUTODOC_EXAMPLES', true);

/** Inclui o esquema do banco de dados na documentação gerada pelo autodoc (expõe nomes de tabela, campo e relacionamentos) */
Env::default('AUTODOC_DATABASE', false);

<?php

/** Sucesso (HTTP 200) */
define('STS_OK', 200);

/** Criado (HTTP 201) */
define('STS_CREATED', 201);

/** Aceito para processamento assíncrono (HTTP 202) */
define('STS_ACCEPTED', 202);

/** Sem conteúdo (HTTP 204) */
define('STS_NO_CONTENT', 204);

/** Movido permanentemente (HTTP 301) */
define('STS_MOVED_PERMANENTLY', 301);

/** Redirecionamento temporário (HTTP 302) */
define('STS_FOUND', 302);

/** Redirecionamento (HTTP 303) */
define('STS_REDIRECT', 303);

/** Não modificado, usar cache (HTTP 304) */
define('STS_NOT_MODIFIED', 304);

/** Sintaxe incorreta (HTTP 400) */
define('STS_BAD_REQUEST', 400);

/** Requer autenticação (HTTP 401) */
define('STS_UNAUTHORIZED', 401);

/** Proibido (HTTP 403) */
define('STS_FORBIDDEN', 403);

/** Não encontrado (HTTP 404) */
define('STS_NOT_FOUND', 404);

/** Método não permitido (HTTP 405) */
define('STS_METHOD_NOT_ALLOWED', 405);

/** Conflito com estado atual do recurso (HTTP 409) */
define('STS_CONFLICT', 409);

/** Entidade não processável (HTTP 422) */
define('STS_UNPROCESSABLE_ENTITY', 422);

/** Requisições em excesso (HTTP 429) */
define('STS_TOO_MANY_REQUESTS', 429);

/** Erro interno do servidor (HTTP 500) */
define('STS_INTERNAL_SERVER_ERROR', 500);

/** Não implementado (HTTP 501) */
define('STS_NOT_IMPLEMENTED', 501);

/** Gateway inválido (HTTP 502) */
define('STS_BAD_GATEWAY', 502);

/** Serviço indisponível (HTTP 503) */
define('STS_SERVICE_UNAVAILABLE', 503);

/** Timeout do gateway (HTTP 504) */
define('STS_GATEWAY_TIMEOUT', 504);

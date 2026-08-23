# Routes

[← Index](../index.md)

---

### `GET` `assets/...`

**Response:** `Controller\MxServer\Assets::__invoke`

Gerencia e serve arquivos estáticos (assets) localizados na biblioteca do framework ou do projeto

---

### `GET` `download/...`

**Response:** `Controller\MxServer\Download::__invoke`

Gerencia e força o download de arquivos localizados na pasta de downloads da biblioteca

---

### `GET` `favicon.ico/`

**Response:** `Controller\MxServer\Favicon::__invoke`

Gerencia a entrega do ícone do site buscando primeiro no projeto local e depois no framework

---

### `GET` `robots.txt/`

**Response:** `Controller\MxServer\Robots::__invoke`

Configura as instruções para motores de busca bloqueando a indexação de todo o site

---

### `GET` `sitemap.xml/`

**Response:** `Controller\MxServer\Sitemap::__invoke`

Gera a estrutura inicial do mapa do site para indexação em motores de busca

---

### `GET` `captcha/`

**Response:** `Controller\MxServer\Captcha::__invoke`

Gera um desafio de captcha alfanumérico com imagem em base64 e chave criptografada

---

### `GET` `/`

**Response:** HTTP `200`
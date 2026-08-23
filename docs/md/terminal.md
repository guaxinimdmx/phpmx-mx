# Terminal Commands

[← Index](../index.md)

---

### `autodoc.html`

Gera docs/index.html e docs/html a partir dos dados do projeto

```bash
php mx autodoc.html
```

---

### `autodoc.json`

Exporta a documentação pública do projeto para docs/autodoc.json

```bash
php mx autodoc.json
```

---

### `autodoc.md`

Gera docs/md a partir dos dados do projeto

```bash
php mx autodoc.md
```

---

### `autodoc.scan`

Verifica o status da documentação publicada do projeto atual

```bash
php mx autodoc.scan
```

---

### `cif.off`

Descriptografa e exibe no terminal o valor original de uma cifra.

```bash
php mx cif.off <cif>
```

- `$cif` `string` — A string cifrada.

---

### `cif.on`

Criptografa uma string ou um conjunto de argumentos utilizando o motor Cif.

```bash
php mx cif.on ...<content>
```

- `$content` `string[]` — Texto ou termos que serão cifrados.

---

### `composer`

Gerencia o mapeamento automático do Composer para o framework.

```bash
php mx composer <forceDev>
```

- `$forceDev` `int` — Define se deve forçar o dump em modo desenvolvimento (0 ou 1).

---

### `db.driver`

Gera infraestrutura de classes de Model e Drivers baseados no mapeamento do banco de dados.

```bash
php mx db.driver
php mx db.driver <dbName>
```

- `$dbName` `string` — Nome do banco de dados alvo (opcional, usa 'main' por padrão).

---

### `db.export`

Exporta os dados das tabelas mapeadas no dbmap para um arquivo JSON de sementes.

```bash
php mx db.export
php mx db.export <dbName>
php mx db.export <dbName> <tables>
```

- `$dbName` `string` — Nome do banco de dados alvo (opcional, usa 'main' por padrão).
- `$tables` `string` — Tabelas a exportar separadas por vírgula, ou '*' para todas (opcional).

---

### `db.import`

Importa dados de um arquivo JSON para o banco de dados, realizando a sincronização de registros via Insert ou Update.

```bash
php mx db.import
php mx db.import <dbName>
php mx db.import <dbName> <tables>
```

- `$dbName` `string` — Nome do banco de dados alvo (opcional, usa 'main' por padrão).
- `$tables` `string` — Tabelas a importar separadas por vírgula, ou '*' para todas (opcional).

---

### `db.map`

Exporta o mapeamento da estrutura do banco de dados para um arquivo JSON de esquema.

```bash
php mx db.map
php mx db.map <dbName>
```

- `$dbName` `string` — Nome do banco de dados alvo (opcional, usa 'main' por padrão).

---

### `deploy`

Executa os scripts de deploy de todos os pacotes mx registrados.

```bash
php mx deploy
```

---

### `helper.constant`

Lista todas as helpers de constantes no sistema.

```bash
php mx helper.constant
php mx helper.constant <filter>
```

- `$filter` `?string` — Nome ou parte do nome de uma constante para filtrar a busca.

---

### `helper.function`

Lista todas as helpers de funções registradas no sistema.

```bash
php mx helper.function
php mx helper.function <filter>
```

- `$filter` `?string` — Nome ou parte do nome de uma função para filtrar a busca.

---

### `helper.library`

Lista todos os arquivos e recursos registrados no diretório library do projeto.

```bash
php mx helper.library
php mx helper.library <filter>
```

- `$filter` `?string` — Parte do nome ou caminho do arquivo para filtrar a busca.

---

### `helper.middleware`

Lista as middlewares registradas no projeto.

```bash
php mx helper.middleware
php mx helper.middleware <filter>
```

- `$filter` `?string` — Nome ou parte do nome de uma middleware para filtrar a busca.

---

### `helper.migration`

Lista a situação das migrations de uma conexão com banco de dados.

```bash
php mx helper.migration
php mx helper.migration <dbName>
```

- `$dbName` `string` — Nome do banco de dados alvo (opcional, usa 'main' por padrão).

---

### `helper.router`

Lista as rotas registradas no projeto.

```bash
php mx helper.router
php mx helper.router <match>
php mx helper.router <match> <method>
```

- `$match` `?string` — Template ou parte do template para filtrar as rotas exibidas.
- `$method` `?string` — Método HTTP para filtrar as rotas exibidas (get, post, put, delete).

---

### `helper.test`

Lista todos os arquivos de teste disponíveis em system/test

```bash
php mx helper.test
php mx helper.test <filter>
```

- `$filter` `string` — Nome ou parte do nome do teste para filtrar a busca.

---

### `helper.view`

Lista e detalha todas as views disponíveis no projeto

```bash
php mx helper.view
php mx helper.view <filter>
```

- `$filter` `?string` —

---

### `helper`

Lista e todos os comandos disponíveis no terminal.

```bash
php mx helper
php mx helper <filter>
```

- `$filter` `?string` — Nome ou parte do nome de um comando para filtrar a busca.

---

### `install`

Executa os scripts de instalação de pacotes mx externos.

```bash
php mx install
```

---

### `logo`

Orgulhosamente exibe a logo do PhpMX

```bash
php mx logo
```

---

### `make.cif`

Gera um novo arquivo de certificado (.crt) para o motor de criptografia Cif em library/certificate

```bash
php mx make.cif <cifName>
```

- `$cifName` `string` — Nome do arquivo de certificado sem extensão.

---

### `make.command`

Cria um novo arquivo de comando para o terminal em system/terminal

```bash
php mx make.command <command>
```

- `$command` `string` — Nome do comando a ser criado.

---

### `make.controller`

Gera um novo arquivo de Controller com namespace e estrutura baseados no caminho informado.

```bash
php mx make.controller <controller>
php mx make.controller <controller> <method>
```

- `$controller` `string` — Nome do controller em dot.notation ou com separadores de caminho.
- `$method` `?string` — Nome do método inicial a ser gerado no controller.

---

### `make.deploy`

Cria o arquivo de script "deploy" na raiz do projeto para automatizar rotinas de deploy.

```bash
php mx make.deploy
```

---

### `make.installer`

Cria o arquivo de script "install" na raiz do projeto para automatizar instalação de pacotes.

```bash
php mx make.installer
```

---

### `make.middleware`

Cria um novo arquivo de middleware no diretório do sistema com base em um template padrão.

```bash
php mx make.middleware <middleware>
```

- `$middleware` `string` — Nome do middleware em dot.notation.

---

### `make.migration`

Cria um novo arquivo de migration com timestamp único e template base no banco especificado.

```bash
php mx make.migration <migrationName>
php mx make.migration <migrationName> <dbName>
```

- `$migrationName` `string` — Nome descritivo da migration.
- `$dbName` `string` — Nome do banco de dados alvo (opcional, usa 'main' por padrão).

---

### `make.route`

Cria uma rota no final do arquivo system/router/autorouter.php.

```bash
php mx make.route <method> <template> <response>
php mx make.route <method> <template> <response> <responseMethod>
```

- `$method` `string` — Método HTTP da rota (get, post, put, delete, full, add).
- `$template` `string` — Template da rota (ex: 'users/[#id]').
- `$response` `string` — Classe de resposta em dot.notation ou status HTTP.
- `$responseMethod` `?string` — Método da classe de resposta (opcional).

---

### `make.test`

Cria um novo arquivo de teste em system/test

```bash
php mx make.test <test>
```

- `$test` `string` — Nome do teste a ser criado.

---

### `make.view`

Cria um novo arquivo de view em: system/view

```bash
php mx make.view <view>
```

- `$view` `string` —

---

### `migration.clean`

Reverte todas as migrations executadas no banco de dados, retornando-o ao estado inicial

```bash
php mx migration.clean
php mx migration.clean <dbName>
```

- `$dbName` `string` —

---

### `migration.down`

Reverte a última migration executada no banco de dados especificado

```bash
php mx migration.down
php mx migration.down <dbName>
```

- `$dbName` `string` —

---

### `migration.lock`

Trava todas as migrations executadas em um novo nível de proteção

```bash
php mx migration.lock
php mx migration.lock <dbName>
```

- `$dbName` `string` —

---

### `migration.run`

Executa todas as migrations pendentes no banco de dados até que o esquema esteja atualizado

```bash
php mx migration.run
php mx migration.run <dbName>
```

- `$dbName` `string` —

---

### `migration.unlock`

Remove o nível de trava mais alto das migrations aplicadas no banco de dados

```bash
php mx migration.unlock
php mx migration.unlock <dbName>
```

- `$dbName` `string` —

---

### `migration.up`

Executa a próxima migration pendente no banco de dados especificado

```bash
php mx migration.up
php mx migration.up <dbName>
```

- `$dbName` `string` —

---

### `promote`

Promove um arquivo do sistema para o diretório local do projeto.

```bash
php mx promote <file>
```

- `$file` `string` — O caminho relativo do arquivo a ser promovido.

---

### `server`

Inicia o servidor embutido do PHP para rodar o projeto localmente.

```bash
php mx server
php mx server <port>
```

- `$port` `?int` — Porta do servidor (opcional, usa a definida em TERMINAL_URL ou 8888 por padrão).

---

### `test`

Executa todos os arquivos de teste em system/test e exibe o resultado consolidado.

```bash
php mx test
php mx test <filter>
```

- `$filter` `string` — Nome parcial do arquivo de teste para filtrar a execução
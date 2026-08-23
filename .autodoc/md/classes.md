# Classes

[← Index](../autodoc.md)

### Controller\MxServer

- [Controller\MxServer\Assets](classes/Controller.MxServer.Assets.md) — Controller de acesso a arquivos em library/assets
- [Controller\MxServer\Captcha](classes/Controller.MxServer.Captcha.md) — Controler para desafios alfanumérico
- [Controller\MxServer\Download](classes/Controller.MxServer.Download.md) — Controller de download a arquivos em library/download
- [Controller\MxServer\Favicon](classes/Controller.MxServer.Favicon.md) — Entrega de favicon padrão
- [Controller\MxServer\Robots](classes/Controller.MxServer.Robots.md) — Entrega de robots.txt padrão
- [Controller\MxServer\Sitemap](classes/Controller.MxServer.Sitemap.md) — Entrega de sitemap.xml padrão

### PhpMx

- [PhpMx\Assets](classes/PhpMx.Assets.md) — Classe utilitária para envio e download de arquivos via resposta HTTP.
- [PhpMx\Cif](classes/PhpMx.Cif.md) — Classe utilitária para cifrar e decifrar variáveis de forma segura.
- [PhpMx\DImage](classes/PhpMx.DImage.md) — Motor de manipulação de imagens (GD) com suporte a BMP, JPEG, GIF, PNG e WEBP.
- [PhpMx\Datalayer](classes/PhpMx.Datalayer.md) — Gerencia conexões reutilizáveis com múltiplos bancos de dados.
- [PhpMx\Dir](classes/PhpMx.Dir.md) — Classe utilitária para manipulação de diretórios.
- [PhpMx\Env](classes/PhpMx.Env.md) — Classe utilitária para gerenciamento de variáveis de ambiente.
- [PhpMx\File](classes/PhpMx.File.md) — Classe utilitária para manipulação de arquivos.
- [PhpMx\Import](classes/PhpMx.Import.md) — Classe utilitária para importar arquivos e extrair valores.
- [PhpMx\Input](classes/PhpMx.Input.md) — Classe para gerenciamento de campos e validação de inputs da requisição.
- [PhpMx\Json](classes/PhpMx.Json.md) — Classe utilitária para importar e exportar arquivos JSON.
- [PhpMx\Jwt](classes/PhpMx.Jwt.md) — Classe utilitária criação e leitura de JWT.
- [PhpMx\Middleware](classes/PhpMx.Middleware.md) — Classe responsável pela execução encadeada de middlewares.
- [PhpMx\Mime](classes/PhpMx.Mime.md) — Classe utilitária para detecção, tradução e validação de MIME types.
- [PhpMx\Mx5](classes/PhpMx.Mx5.md) — Classe utilitária para codificação e verificação com hash MX5.
- [PhpMx\Path](classes/PhpMx.Path.md) — Classe utilitária para gerenciamento, normalização e busca de caminhos.
- [PhpMx\Prepare](classes/PhpMx.Prepare.md) — Classe utilitária para substituição de templates em textos.
- [PhpMx\Request](classes/PhpMx.Request.md) — Classe para acesso aos dados da requisição HTTP atual.
- [PhpMx\Response](classes/PhpMx.Response.md) — Classe para construção e envio de respostas HTTP.
- [PhpMx\Router](classes/PhpMx.Router.md) — Classe responsável pelo registro, organização e resolução de rotas HTTP.
- [PhpMx\Snap](classes/PhpMx.Snap.md) — Captura e restaura o estado de propriedades estáticas de classes registradas.
- [PhpMx\Terminal](classes/PhpMx.Terminal.md) — Classe base para criação e execução de comandos de terminal.
- [PhpMx\Trace](classes/PhpMx.Trace.md) — Classe utilitária para registro estruturado de traces e escopos.
- [PhpMx\View](classes/PhpMx.View.md) — Classe responsável por renderizar views e aplicar lógica de apresentação.

### PhpMx\Datalayer

- [PhpMx\Datalayer\Query](classes/PhpMx.Datalayer.Query.md) — Factory para criação de queries SQL (Select, Insert, Update, Delete).

### PhpMx\Datalayer\Connection

- [PhpMx\Datalayer\Connection\BaseConnection](classes/PhpMx.Datalayer.Connection.BaseConnection.md) — Base para drivers de conexão.

### PhpMx\Datalayer\Driver\Field

- [PhpMx\Datalayer\Driver\Field\FBigint](classes/PhpMx.Datalayer.Driver.Field.FBigint.md) — Campo inteiro de 8 bytes (BIGINT).
- [PhpMx\Datalayer\Driver\Field\FBlob](classes/PhpMx.Datalayer.Driver.Field.FBlob.md) — Campo de dados binários (BLOB).
- [PhpMx\Datalayer\Driver\Field\FBoolean](classes/PhpMx.Datalayer.Driver.Field.FBoolean.md) — Campo booleano (BOOLEAN), com conversão automática para inteiro ao persistir no banco de dados.
- [PhpMx\Datalayer\Driver\Field\FChar](classes/PhpMx.Datalayer.Driver.Field.FChar.md) — Campo de caractere fixo (CHAR).
- [PhpMx\Datalayer\Driver\Field\FDate](classes/PhpMx.Datalayer.Driver.Field.FDate.md) — Campo de data (DATE), com conversão automática de timestamp inteiro para string no formato Y-m-d.
- [PhpMx\Datalayer\Driver\Field\FDatetime](classes/PhpMx.Datalayer.Driver.Field.FDatetime.md) — Campo de data e hora (DATETIME), no formato Y-m-d H:i:s, sem microsegundos.
- [PhpMx\Datalayer\Driver\Field\FDecimal](classes/PhpMx.Datalayer.Driver.Field.FDecimal.md) — Campo decimal de ponto fixo (DECIMAL).
- [PhpMx\Datalayer\Driver\Field\FDouble](classes/PhpMx.Datalayer.Driver.Field.FDouble.md) — Campo de ponto flutuante de precisão dupla (DOUBLE).
- [PhpMx\Datalayer\Driver\Field\FEmail](classes/PhpMx.Datalayer.Driver.Field.FEmail.md) — Campo de e-mail, com sanitização, normalização e validação de formato automáticas.
- [PhpMx\Datalayer\Driver\Field\FFloat](classes/PhpMx.Datalayer.Driver.Field.FFloat.md) — Campo de ponto flutuante (FLOAT), com suporte a valor mínimo e máximo configuráveis.
- [PhpMx\Datalayer\Driver\Field\FIdx](classes/PhpMx.Datalayer.Driver.Field.FIdx.md) — Campo de índice de referência (IDX / foreign key), com acesso direto ao registro referenciado.
- [PhpMx\Datalayer\Driver\Field\FInt](classes/PhpMx.Datalayer.Driver.Field.FInt.md) — Campo inteiro (INT), com suporte a valor mínimo, máximo e arredondamento configuráveis.
- [PhpMx\Datalayer\Driver\Field\FJson](classes/PhpMx.Datalayer.Driver.Field.FJson.md) — Campo JSON, com conversão automática entre array e string JSON para armazenamento e uso no sistema.
- [PhpMx\Datalayer\Driver\Field\FMd5](classes/PhpMx.Datalayer.Driver.Field.FMd5.md) — Campo hash MD5, com conversão automática do valor e verificação de igualdade.
- [PhpMx\Datalayer\Driver\Field\FMediumint](classes/PhpMx.Datalayer.Driver.Field.FMediumint.md) — Campo inteiro de 3 bytes (MEDIUMINT).
- [PhpMx\Datalayer\Driver\Field\FPassword](classes/PhpMx.Datalayer.Driver.Field.FPassword.md) — Campo de senha (PASSWORD), com hash automático via bcrypt e verificação de valor.
- [PhpMx\Datalayer\Driver\Field\FSmallint](classes/PhpMx.Datalayer.Driver.Field.FSmallint.md) — Campo inteiro de 2 bytes (SMALLINT).
- [PhpMx\Datalayer\Driver\Field\FText](classes/PhpMx.Datalayer.Driver.Field.FText.md) — Campo de texto longo (TEXT), com conversão automática do valor para string.
- [PhpMx\Datalayer\Driver\Field\FTime](classes/PhpMx.Datalayer.Driver.Field.FTime.md) — Campo de tempo (TIME), com conversão automática de timestamp inteiro para string no formato H:i:s.
- [PhpMx\Datalayer\Driver\Field\FTimestamp](classes/PhpMx.Datalayer.Driver.Field.FTimestamp.md) — Campo de timestamp (TIMESTAMP), com microsegundos no formato Y-m-d H:i:s.u. Retorna float (microtime) por padrão.
- [PhpMx\Datalayer\Driver\Field\FTinyint](classes/PhpMx.Datalayer.Driver.Field.FTinyint.md) — Campo inteiro de 1 byte (TINYINT).
- [PhpMx\Datalayer\Driver\Field\FVarchar](classes/PhpMx.Datalayer.Driver.Field.FVarchar.md) — Campo de texto com tamanho variável (VARCHAR), com suporte a corte automático e validação de tamanho máximo.

### PhpMx\Datalayer\Query

- [PhpMx\Datalayer\Query\BaseQuery](classes/PhpMx.Datalayer.Query.BaseQuery.md) — Classe base para todos os query builders. Fornece tabela, dbName, execução e montagem de SQL.
- [PhpMx\Datalayer\Query\Delete](classes/PhpMx.Datalayer.Query.Delete.md) — Monta e executa instruções SQL do tipo DELETE com suporte a cláusulas WHERE e ORDER BY.
- [PhpMx\Datalayer\Query\Insert](classes/PhpMx.Datalayer.Query.Insert.md) — Monta e executa instruções SQL do tipo INSERT com suporte a múltiplos registros e parâmetros nomeados.
- [PhpMx\Datalayer\Query\Select](classes/PhpMx.Datalayer.Query.Select.md) — Monta e executa instruções SQL do tipo SELECT com suporte a fields, where, order, group, joins e paginação.
- [PhpMx\Datalayer\Query\Update](classes/PhpMx.Datalayer.Query.Update.md) — Monta e executa instruções SQL do tipo UPDATE com suporte a cláusulas WHERE, whereIn e whereNull.

### PhpMx\Input

- [PhpMx\Input\InputField](classes/PhpMx.Input.InputField.md) — Classe para definição, validação e sanitização de campos de input. Gerencia obrigatoriedade, prevenção de tags HTML, regras de validação e formatação do valor recebido.
- [PhpMx\Input\InputFieldBool](classes/PhpMx.Input.InputFieldBool.md) — Campo de input especializado para valores booleanos. Converte automaticamente o valor recebido para bool antes de aplicar as regras herdadas.
- [PhpMx\Input\InputFieldCaptcha](classes/PhpMx.Input.InputFieldCaptcha.md) — Campo de input para validação de captchas com cifra e hash. Aplica automaticamente validação do código recebido contra a chave cifrada.
- [PhpMx\Input\InputFieldList](classes/PhpMx.Input.InputFieldList.md) — Campo de input para listas representadas como string separada por vírgulas. Converte automaticamente arrays recebidos para string antes de aplicar as regras herdadas.
- [PhpMx\Input\InputFieldScheme](classes/PhpMx.Input.InputFieldScheme.md) — Campo de input para validação e decodificação de esquemas JSON. Aceita arrays ou strings JSON, decodificando automaticamente para array após validação.
- [PhpMx\Input\InputFieldUpload](classes/PhpMx.Input.InputFieldUpload.md) — Campo de input para validação de arquivos enviados via upload. Verifica automaticamente erros de envio, tamanho e integridade do arquivo recebido.
- [PhpMx\Input\InputFieldUploadImage](classes/PhpMx.Input.InputFieldUploadImage.md) — Campo de input para validação de imagens enviadas em formato base64. Aceita apenas imagens nos formatos PNG, JPG, JPEG e WEBP.
- [PhpMx\Input\InputMessage](classes/PhpMx.Input.InputMessage.md) — Classe utilitária para gerenciamento de mensagens de erro de inputs. Centraliza as mensagens padrão para regras de validação, permitindo personalização global.

### PhpMx\Reflection

- [PhpMx\Reflection\ReflectionCommandFile](classes/PhpMx.Reflection.ReflectionCommandFile.md) — Extrai o esquema de reflexão de um arquivo de comando.
- [PhpMx\Reflection\ReflectionHelperFile](classes/PhpMx.Reflection.ReflectionHelperFile.md) — Extrai o esquema de reflexão de um arquivo de helper.
- [PhpMx\Reflection\ReflectionMiddlewareFile](classes/PhpMx.Reflection.ReflectionMiddlewareFile.md) — Extrai o esquema de reflexão de um arquivo de middleware.
- [PhpMx\Reflection\ReflectionRouterFile](classes/PhpMx.Reflection.ReflectionRouterFile.md) — Extrai o esquema de reflexão de um arquivo de rotas.
- [PhpMx\Reflection\ReflectionSourceFile](classes/PhpMx.Reflection.ReflectionSourceFile.md) — Extrai o esquema de reflexão de um arquivo de classe, trait ou interface.
- [PhpMx\Reflection\ReflectionTestFile](classes/PhpMx.Reflection.ReflectionTestFile.md) — Extrai o esquema de reflexão de um arquivo de teste.

### PhpMx\Trait

- [PhpMx\Trait\TerminalEchoTrait](classes/PhpMx.Trait.TerminalEchoTrait.md) — Camada de exibição de dados no terminal
- [PhpMx\Trait\TerminalInstallTrait](classes/PhpMx.Trait.TerminalInstallTrait.md) — Facilita a criação de arquivos de instalação via php mx make.install
- [PhpMx\Trait\TerminalTestTrait](classes/PhpMx.Trait.TerminalTestTrait.md) — Trait para criação de baterias de testes via terminal
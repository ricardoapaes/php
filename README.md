# PHP

Um container com PHP-FPM, para utilizar use o seguinte comando:

```
docker run -v ${PWD}:/var/www/ -p 9000:9000 likesistemas/php:latest
```

## Environment Vars
```
PHP_NAME: Nome do pool do PHP-FPM (opcional)
PHP_USER: Usuário que será usado no PHP-FPM (opcional)
PHP_GROUP: Grupo que será usado no PHP-FPM (opcional)
MEMORY_LIMIT: Define a memoria do PHP (opcional) - Padrão é 512MB
SHOW_ERRORS: Define se é para mostrar os erros do PHP (opcional)
DB_HOST: Aguarda o host do banco de dados iniciar, timaout 30 segundos. (opcional)
DB_PORT: Porta do banco de dados. (opcional, padrão 3306)
DB_MIGRATE: Informar true para executar o migrate depois da checagem do banco de dados (opcional)
DB_SEED: Informar true para executar o seed depois da checagem do banco de dados (opcional)
INSTALL_COMPOSER: Instala o composer no container antes de iniciar (opcional, boolean)
COMPOSER_INSTALL: Executa o comando do composer install ao iniciar (opcional, boolean)
COMPOSER_INSTALL_PARAMS: Parametros que serão passados ao composer install (opcional, padrão: -a --no-dev)
COMPOSER_FOLDER: Define a pasta raiz do composer (opcional)
```

### Dynamic
Irá iniciar 4 processos, irá ficar no minimo 2 processos inativos e pode ficar com até 8 processos inativos.

```
PHP_PM=dynamic
PHP_PM_MAX_CHILDREN=8
PHP_PM_START_SERVERS=4
PHP_PM_MIN_SPARE_SERVERS=2
PHP_PM_MAX_SPARE_SERVERS=4
PHP_PM_MAX_REQUESTS=500
```

### On demand
Não irá iniciar vários processos, irá iniciar de acordo com a carga se necessário, máximo 128 processos e morre depois de 5 minutos que não recebe mais conexões.

```
PHP_PM=ondemand
PHP_PM_MAX_CHILDREN=8
PHP_PM_PROCESS_IDLE_TIMEOUT=500
```

### Como calcular?
Você pode executar o seguinte comando no serviço que está em execução:

```
ps -ylC php-fpm
```

A coluna RSS contém o uso médio da memória em kilobytes por processo. Obs.: É mostrado em kilobytes, então deve-se converter para Mb.

Obs: Caso você estiver dentro de um container você pode instalar o comando ps usando o seguinte comando:

```
apt-get install -y procps
```

Um exemplo: 
Se nosso container possui 512 Mb de RAM e a média de uso de memoria for 60 Mb.

```
pm.max_children nos leva a 512 Mb / 60 Mb = 8
```

Explicação retirada do site: <a href="https://www.kinamo.be/en/support/faq/determining-the-correct-number-of-child-processes-for-php-fpm-on-nginx">Determining the correct number of child processes for PHP-FPM on NGinx</a>

### XDebug
Existe um script sh que faz a instalação dele, ele será instalado automaticamente na variante dev do container.

Para ativar segue as variaveis de ambiente

```
XDEBUG=Informar true para ativa-lo.
XDEBUG_HOST=Informar o host do XDEBUG, segue docs: https://xdebug.org/docs/all_settings#remote_host
XDEBUG_IDEKEY=Se não informado será utilizado a env PHP_NAME como padrão. Segue docs: https://xdebug.org/docs/all_settings#xdebug.idekey
XDEBUG_PROFILER=Se informado será ativado o profile e será salvo na pasta: /var/xdebug/.
XDEBUG_CONFIG=Variavel do próprio XDEBUG. Segue docs: https://xdebug.org/docs/remote
```
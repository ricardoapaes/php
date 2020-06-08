# PHP

Um container com PHP-FPM, para utilizar use o seguinte comando:

```
docker run -v ${PWD}:/var/www/public/ -p 9000:9000 likesistemas/php:latest
```

## Environment Vars
```
PHP_NAME: Nome do pool do PHP-FPM (opcional)
PHP_USER: Usuário que será usado no PHP-FPM (opcional)
PHP_GROUP: Grupo que será usado no PHP-FPM (opcional)
DB_HOST: Aguarda o host do banco de dados iniciar, timaout 30 segundos. (opcional)
DB_PORT: Porta do banco de dados. (opcional, padrão 3306)
DB_MIGRATE: Informar true para fazer executar depois da checagem do banco de dados (opcional)
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

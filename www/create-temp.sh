#!/bin/bash
mkdir -p temp/
chown -v www-data:www-data temp/

cd /var/www/
chmod +x cli.php
run-as-www cli.php
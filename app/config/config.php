<?php
date_default_timezone_set('America/Sao_Paulo');

define('BASE', '/social-sebo/');
define('HOST', 'http://localhost/social-sebo/');
define('DATE_TIME', 'd/m/Y H:i:s');

define('SECURITY_REDIRECT', '/social-sebo/login');

define('REMOVE_INDEX_COUNT', 1); //Quantidade de indices a serem removidos

//DATABASE
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'social-sebo');

//EMAIL
define('MAIL_USER', ''); //E-mail de login
define('MAIL_PASS', ''); //Senha de login
define('MAIL_HOST', ''); //Servidor de saída
define('MAIL_PORT', 000); //Porta de saída
define('MAIL_MAIL', ''); //E-mail do remetente
define('MAIL_NAME', ''); //Nome do remetente

define('IMAGE_PATH', 'resources/thumb/');
define('MAX_UPLOAD_SIZE', 50); //MB
define('MIME_TYPE_UPLOAD', [
    'image/gif',
    'image/png',
    'image/jpeg',
    'image/bmp',
    'image/webp'
]);

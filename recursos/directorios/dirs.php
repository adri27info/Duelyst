<?php
/* ------------ RUTAS ABSOLUTAS ------------ */
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . "/apps/php/Duelyst/");
define('CONTROLLER_PATH', ROOT_PATH . 'recursos/controlador/');
define('MODEL_PATH', ROOT_PATH . 'recursos/modelo/');
define('CONNECTION_PATH', ROOT_PATH . 'recursos/conectividad/');
define('MAILER_PATH', ROOT_PATH . 'recursos/PHPMailer/');
define('ROUTER_PATH', ROOT_PATH . 'recursos/enrutador/');
/* ------------ RUTAS RELATIVAS ------------ */
define('CHILD_ROOT_PATH', "/apps/php/Duelyst/");
define('URL_ROUTER', substr($_SERVER["REQUEST_URI"], strlen(dirname($_SERVER["SCRIPT_NAME"]))));
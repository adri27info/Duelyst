<?php
session_start();
require_once("recursos/directorios/dirs.php");
require_once(ROUTER_PATH . "router.php");
$router = new Router();
$router->ejecutar();